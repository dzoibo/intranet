<?php

 include "../modele/modele3.php";

 			function Me_conversion_date($date)
		{
				if($date==date('Y-m-d',time()-3600*24))
				{
					return "Hier";
				}
				else
				{
					list($year, $month, $day) = explode("-", $date);
		

				$months = array("jan", "fev", "mars", "avr", "mai", "juin",
	    		"juil", "août", "sept", "oct", "nov", "dec");

	    		return $day." ".$months[$month-1]." ".$year;// ajouter ceci si on veut aussi afficher les heures." à ".$hour."h".$min."min"
				}
				 
		}

		 	function Me_Ajax_rechercher_Msg($bdd,$id,$search)
				{
					$users =$bdd->query('SELECT * FROM utilisateur where (Nom_utilisateur like "%'.$search.'%" or Prenom_utilisateur like "%'.$search.'%")  and idUtilisateur !='.$id .' ORDER BY Nom_utilisateur asc ');


						if (!$users-> rowCount())
						{
							echo "<strong>Aucun résultat</strong>";
						}
						while ($user=$users->fetch()) 
						{
							$message_finals=$bdd->prepare('SELECT  idMessage as id_msg ,Contenu as contenu ,idExpediteur as idEx, idRecepteur as idRec,date_envoie, date(date_envoie) as jour,time (date_envoie) as heure FROM message WHERE  (idExpediteur = :idRec and idRecepteur=:idEx) or (idExpediteur=:idEx and idRecepteur=:idRec) order by idMessage DESC limit 1');

							$message_finals->bindValue(":idRec",$user['idUtilisateur'],PDO::PARAM_INT);
							$message_finals->bindValue(":idEx",$id,PDO::PARAM_INT);
							$message_finals->execute();

							$message_final=$message_finals->fetch();

							$msg_non_lu= $bdd->prepare('SELECT COUNT(*) as nbr FROM message WHERE  ((idExpediteur=:idEx and idRecepteur=:idRec) or (idExpediteur=:idRec and idRecepteur=:idEx)) and statut!="lu"');
							$msg_non_lu->bindValue(":idRec",$user['idUtilisateur'],PDO::PARAM_INT);
							$msg_non_lu->bindValue(":idEx",$id,PDO::PARAM_INT);
							$msg_non_lu->execute();
							$nbr_non_lu=$msg_non_lu->fetch();


							if($message_finals->rowcount()==0)
							{

							 echo '<a href="Message.php?id_contact='.$user['idUtilisateur'].'"> 	
										<div class="AC_Me_box1b1">';
                                        Me_show_user2($user['idUtilisateur']);
                                        
								echo'</div>
										<div class="AC_Me_box1b2">
											<div class="AC_Me_name_contact">
												'.$user['Nom_utilisateur'].' '.$user['Prenom_utilisateur'].'
											</div>

											<div class="AC_Me_aucun_message">
												 <em>//Aucun message</em>
											</div>
									   </div>
								   </a>';

								   continue;


							}
							if($nbr_non_lu['nbr']>0)
							{
								$afficher_nbre='<div class="AC_Me_nouveau_message">
													<span>'.$nbr_non_lu['nbr'].'</span>
												</div>';
								$couleur_date=' style="color:  #0B8CB8"';
							}
							else
							{
								$afficher_nbre='';
								$couleur_date='';
							}

							if($message_final['jour']==date("Y-m-d"))
							{
								$heure=$message_final['heure'];
							}
							else
							{
								$heure=Me_conversion_date($message_final['jour']);
							}


					if($message_final['idEx']==$id)
					{
						$id_to_select=$message_final['idRec'];
						$precision="Vous :";

					}
					else
					{	

						$id_to_select=$message_final['idEx'];
						$precision="";
					}
						$conversations=$bdd->prepare('SELECT * from conversation where last_message = '.$message_final['id_msg'].'');
						$conversations->execute();
						$conversation=$conversations->fetch();
						$archiv_span='';
						$pin_span='';
						if($conversation['archiver']=="oui" or $conversation['archiver']==$id)
						{
							$archiv_span='<span class="AC_Me_arch_indication">
												(Archivée)
										  </span>';
							
						}
						elseif($conversation['epingler']=="oui" or $conversation['epingler']==$id)
						{
							$pin_span='<div class="AC_Me_pin_icon"><i class="fas fa-thumbtack"></i></div>';
							
						}

						$utilisateurs=$bdd->query('SELECT * FROM utilisateur where idUtilisateur = '.$id_to_select);
						$utilisateur=$utilisateurs->fetch();
						echo '<a href="Message.php?id_contact='.$utilisateur['idUtilisateur'].'#ME_repere"> 	
									<div class="AC_Me_box1b1">';
                                       Me_show_user2($utilisateur['idUtilisateur']);
                                        
								echo'</div>
									<div class="AC_Me_box1b2" >
										<div class="AC_Me_name_contact">
											'.$utilisateur['Nom_utilisateur'].' '.$utilisateur['Prenom_utilisateur'].'
											'.$archiv_span.'
											<span class="AC_Me_heure" '.$couleur_date.'>
												'.$heure.'
											</span>
										</div>

										<div class="AC_Me_dernier_message">
											<strong>'.$precision.'</strong>  '.CoupePhrase($message_final['contenu'],70).'
										</div>
										 '.$afficher_nbre.'
								   </div>
								   '.$pin_span.'
							   </a>';
	
				}

			echo '<input type="hidden" id="ME_id_last_message" name="" value=' . get_last_message($id,$bdd).' >';			

			}



function Me_epingler_desepingler($bdd,$id,$id_convers,$action)
{
	$id_convers=substr($id_convers,10);
	$epinglers=$bdd->prepare('SELECT * from conversation where id_conversation='.$id_convers.'');
	$epinglers->execute();

	$epingler=$epinglers->fetch();

	if($action=="epingler") 
	{
		if($epingler['epingler']=="non")// cela signifie que personne des deux n'a deja epinglé cette conversation
		{
			$value_of_pin= $id;// on fait cette concatenation pour s'assurer que notre variable contiendra une chaine de caractére...
		}
		else
		{
			$value_of_pin="oui";
		}
	}
	else// dans le cas ou c'est plutot "retirer"
	{
		if($epingler['epingler']=="oui")
		{
			if( $epingler['user1']==$id)
			{
				$value_of_pin=$epingler['user2'];
			}
			else
			{
				$value_of_pin=$epingler['user2'];
			}
		}
		else
		{
			$value_of_pin="non";
		}
	}

	$insertion=$bdd->prepare('UPDATE conversation set epingler ="'.$value_of_pin.'" where  id_conversation='.$id_convers.'');
	$insertion->execute();
}
function Me_archiv_desarchiv($bdd,$id,$id_convers,$action)
{
	$id_convers=substr($id_convers,10);
	$archivers=$bdd->prepare('SELECT * from conversation where id_conversation='.$id_convers.'');
	$archivers->execute();

	$archiver=$archivers->fetch();
	if($action=="archiver") 
	{
		if($archiver['archiver']=="non")
		{
			$value_of_pin= $id;
		}
		else
		{
			$value_of_pin="oui";
		}
	}
	else
	{
		if($archiver['archiver']=="oui")
		{
			if( $archiver['user1']==$id)
			{
				$value_of_pin=$archiver['user2'];
			}
			else
			{
				$value_of_pin=$archiver['user2'];
			}
		}
		else
		{
			$value_of_pin="non";
		}
	}
	$insertion=$bdd->prepare('UPDATE conversation set archiver ="'.$value_of_pin.'" where  id_conversation='.$id_convers.'');
	$insertion->execute();

}

function Me_rechercher_contact($bdd,$id,$motcle)
{
     $nombre=$bdd->prepare("SELECT Nom_utilisateur,Prenom_utilisateur ,idUtilisateur,photo,Statut_utilisateur from utilisateur WHERE idutilisateur!=".$id." and  Nom_utilisateur LIKE '%".$motcle."%' ");
    $nombre->execute();


     if (!$nombre->rowCount())
     {

        echo '
                <div class="ME_box1b">
                    <div class="ME_box1b2">
                        <div class="Me_name_contact">
                            Aucun nom trouvé
                        </div>
                        <div class="Me_statut_contact">
                                        
                         </div> 
                    </div>
                 </div>';
     }
     else
     {
      
        while ($donnees = $nombre->fetch() )
                {
                    echo '<a href = "index.php?module=utilisateur&action=message&id_contact='.$donnees['idUtilisateur'].'#ME_repere">
							<div class="ME_box1b">
								<div class="ME_box1b1">';
                                        Me_show_user2($donnees['idUtilisateur'], "AC_Me_box1b1");
                                        
								echo'</div>
								<div class="ME_box1b2">
									<div class="Me_name_contact">
									'.$donnees['Nom_utilisateur'].' '.CoupePhrase($donnees['Prenom_utilisateur'],10).'
									</div>
									<div onload="Me_statut_change(\''.$donnees['idUtilisateur'].'\')" class="Me_statut_contact" id="Me_statut_contact'.$donnees['idUtilisateur'].'">
										'.$donnees['Statut_utilisateur'].'
									</div> 
								</div>
						  </div>
						 </a>';
                }
              
     }
     $nombre->closeCursor();
}
function Me_actualiser_message($bdd,$id,$idEx,$idRec,$date_send)
	{
		$recuperation=$bdd->prepare('SELECT idMessage as id_msg, Contenu as contenu ,idExpediteur as idEx,idRecepteur as idRec,time(date_envoie) as heure ,date(date_envoie) as date_send,statut FROM message WHERE idMessage>:id and ((idExpediteur=:idEx and idRecepteur=:idRec) OR(idExpediteur=:idRec and idRecepteur=:idEx)) and statut!="lu"');
		$recuperation->bindValue(':idEx',$idEx,PDO::PARAM_INT);
		$recuperation->bindValue(':idRec',$idRec,PDO::PARAM_INT);
		$recuperation->bindValue(':id',$id,PDO::PARAM_INT);
		$recuperation->execute();

		while ($data=$recuperation->fetch())
	    	{
	    		// Cette partie modifie le statut du message en fonction du fait qu'il ait deja eté affiché chez le recepteur ou chez l'envoyeur ou chez les deux

		    		if( $data['idEx'] == $idEx )
		    		{
		    			if ( $data['statut'] == "non_lu")
		    		    {
		    				$statut='envoyer'; 
		    			}
		    			elseif ( $data['statut'] == "recu")
		    		    {
		    				$statut='lu';
		    			}
		    			else
		    			{
		    				continue;
		    			}	
		    		}

		    		else 
		    		{
		    			if ( $data['statut'] == "non_lu")
		    		    {
		    				$statut='recu';
		    			}
		    			elseif ( $data['statut'] == "envoyer")
		    		    {
		    				$statut='lu';
		    			}
		    			else
		    			{
		    				continue;
		    			}
		    		}
		    		$bdd->query('UPDATE message SET statut="'.$statut.'" where idMessage='.$data['id_msg'].'');

		    		if($date_send!=$data['date_send'])
		    		{
		    			echo'<div class="Me_date_send"> Aujourd\'hui</div> ';
		    			echo"<script>
		    					$('#ME_last_message_date').val('".$data['date_send']."');
		    				 </script>" ;// ce bout de code permet de modifier la date du denier message dans la page message.php...
		    		}
		    		
					 	$nombre2=$bdd->prepare('SELECT id_fichier as id_file, nom ,URL , type, taille FROM fichier where id_message=:id_message');
					 	$nombre2->bindValue(":id_message",$data['id_msg'],PDO::PARAM_INT);
					 	$nombre2->execute();
					 	if($data['idEx']==$idEx)

					 	{	
					 		echo '<div class=Me_shaw_file>';
					 		while ($shawfile=$nombre2->fetch())
						 		 {
						 		 	$type_file='';
						 		 	$Me_file_image_contener='Me_file_contener';// par defaut on met cette valeur qu'on ne changera que si le fichier est une image car c'est le seul type dont l'affichage est différent...
						 		 	
						 		 	if($shawfile['type']=='image')
						 		 	{
						 		 		$Me_file_image_contener='Me_image_contener';
						 		 		$type_file='<img src="'.$shawfile['URL'].'"/>';
						 		 	}
						 		 	elseif($shawfile['type']=="pdf")
						 		 	{
						 		 		$type_file='<i class="fas fa-file-pdf"></i>';
						 		 	}
						 		 	elseif($shawfile['type']=="document")
						 		 	{
						 		 		$type_file='<i class="far fa-file-word"></i>';
						 		 	}
						 		 	elseif($shawfile['type']=="audio")
						 		 	{
						 		 		$type_file='<i class="fas fa-file-audio"></i>';
						 		 	}
						 		 	elseif($shawfile['type']=="video")
						 		 	{
						 		 		$type_file='<i class="far fa-file-video"></i>';
						 		 	}
						 		 	else
						 		 	{
						 		 		$type_file='<i class="fas fa-file"></i>';
						 		 	}



						 		 	echo'<div class="'.$Me_file_image_contener.'">
											<a href="'.$shawfile['URL'].'">
												'.$type_file.'
											</a><br/>
											<span>'.$shawfile['nom'].'</span>
						 				 </div>';
						 			
						 		}
						 		echo'</div>';

					 			echo'<div class="Me_msg_div">
										<div class="ME_box2b">
											'. htmlspecialchars($data['contenu']).'
											<div class="Me_space_contenu"></div>
											<span class="Me_afficher_heure_envoie">
												'.substr($data['heure'], 0,-3).'
											</span>
										</div>

									</div>';

					 	}

					 	else
					 	{
					 		echo '<div class=Me_shaw_file2>';
					 		while ($shawfile=$nombre2->fetch())
						 		 {
						 		 	$type_file='';
						 		 	$Me_file_image_contener='Me_file_contener2';
						 		 	
						 		 	if($shawfile['type']=='image')
						 		 	{
						 		 		$Me_file_image_contener='Me_image_contener2';
						 		 		$type_file='<img src="'.$shawfile['URL'].'"/>';
						 		 	}
						 		 	elseif($shawfile['type']=="pdf")
						 		 	{
						 		 		$type_file='<i class="fas fa-file-pdf"></i>';
						 		 	}
						 		 	elseif($shawfile['type']=="document")
						 		 	{
						 		 		$type_file='<i class="far fa-file-word"></i>';
						 		 	}
						 		 	elseif($shawfile['type']=="audio")
						 		 	{
						 		 		$type_file='<i class="fas fa-file-audio"></i>';
						 		 	}
						 		 	elseif($shawfile['type']=="video")
						 		 	{
						 		 		$type_file='<i class="far fa-file-video"></i>';
						 		 	}
						 		 	else
						 		 	{
						 		 		$type_file='<i class="fas fa-file"></i>';
						 		 	}
						 		 	echo'<div class="'.$Me_file_image_contener.'">
											<a href="'.$shawfile['URL'].'">
												'.$type_file.'
											</a><br/>
											<span>'.$shawfile['nom'].'</span>
						 				 </div>';
						 			
						 		}
						 		echo '</div>';

					 			echo'<div class="Me_msg_div">
										<div class="ME_box2a">
											'. htmlspecialchars($data['contenu']).'
											<div class="Me_space_contenu"></div>
											<span class="Me_afficher_heure_envoie">
												'.substr($data['heure'], 0,-3).'
											</span>
										</div>

									</div>';	
					 	}
						
					

			}
	}
function afficher_archiv($bdd,$id)
{
	$Archives=$bdd->prepare('SELECT * from conversation where (iduser1 ='.$id.' or iduser2 ='.$id.') and (archiver = "oui" or archiver="'.$id.'") ORDER by last_message DESC');
	$Archives->execute();
	if(!$Archives->rowCount())
	{
		echo "Aucune discussion archivée ";
		echo '<input type="hidden" id="ME_id_last_message" name="" value=' . get_last_message($id,$bdd).' >';
		exit();
	}
	while ($archive=$Archives->fetch())
	{
		$message_finals=$bdd->query('SELECT  idMessage as id_msg ,Contenu as contenu ,idExpediteur as idEx, idRecepteur as idRec,date_envoie, date(date_envoie) as jour,time (date_envoie) as heure FROM message WHERE idMessage='.$archive['last_message'].'');
		$message_final=$message_finals->fetch();
					//on compte maintenant tout les nouveaux messages de la meme conversation que celle-ci...
					if($message_final['idEx']==$id)
					{
						$msg_non_lu= $bdd->query('SELECT COUNT(*) as nbr from message where (idExpediteur='.$message_final['idRec'].' and idRecepteur='.$id.') and statut!="lu" ');
					}
					else
					{
						$msg_non_lu= $bdd->query('SELECT COUNT(*) as nbr from message where (idExpediteur='.$message_final['idEx'].' and idRecepteur='.$id.') and statut!="lu" ');
					}

					$nbr_non_lu=$msg_non_lu->fetch();


					if($nbr_non_lu['nbr']>0)
					{
						$afficher_nbre='<div class="AC_Me_nouveau_message">
											<span>'.$nbr_non_lu['nbr'].'</span>
										</div>';
						$couleur_date=' style="color:  #0B8CB8"';
					}
					else
					{
						$afficher_nbre='';
						$couleur_date=''; 
					}

					if($message_final['jour']==date("Y-m-d"))
					{
						$heure=$message_final['heure'];
					}
					else
					{
						$heure=Me_conversion_date($message_final['jour']);
					}
					if($message_final['idEx']==$id)
					{
						$id_to_select=$message_final['idRec'];
						$precision="Vous: ";

					}
					else
					{	

						$id_to_select=$message_final['idEx'];
						$precision="";
					}
					$utilisateurs=$bdd->query('SELECT * FROM utilisateur where idUtilisateur = '.$id_to_select);
					$utilisateur=$utilisateurs->fetch();

					echo '<a onmouseleave="enrouler(\'#AC_Me_deroulant_'.$archive['id_conversation'].'\')" id="Me_conver_'.$archive['id_conversation'].'" href="index.php?module=utilisateur&action=message&id_contact='.$utilisateur['idUtilisateur'].'#ME_repere"> 	
									<div class="AC_Me_box1b1">';
                                       Me_show_user2($utilisateur['idUtilisateur']);
                                        
								echo'</div>
									<div class="AC_Me_box1b2" >
										<div class="AC_Me_name_contact">
											'.$utilisateur['Nom_utilisateur'].' '.$utilisateur['Prenom_utilisateur'].' 
											<span class="AC_Me_arch_indication">
												(Archivée)
											</span>
											<span class="AC_Me_heure" '.$couleur_date.'>
												'.$heure.'
											</span>
										</div>

										<div class="AC_Me_dernier_message">
											<strong>'.$precision.'</strong> '.CoupePhrase($message_final['contenu'],70).'
										</div>
										 '.$afficher_nbre.'
								   </div>
								   <div class="AC_Me_option" id="AC_Me_option_'.$archive['id_conversation'].'" onclick="option(\'#AC_Me_option_'.$archive['id_conversation'].'\') "><i class="fas fa-ellipsis-v"></i></div>
								   <div class="AC_Me_deroulant" tabindex="-1" id="AC_Me_deroulant_'.$archive['id_conversation'].'" onmouseleave="enrouler(\'#AC_Me_deroulant_'.$archive['id_conversation'].'\')">
								   		<span onclick="archiver_desarchiver(\'Me_conver_'.$archive['id_conversation'].'\',\'retirer\')">>Retirer
								   		</span>
								   </div>
							   </a>';
	}
	echo '<input type="hidden" id="ME_id_last_message" name="" value=' . get_last_message($id,$bdd).' >';
}
function Me_ajax_Acceuil_Msg_c($bdd,$id,$id_last,$pin_unpin=false)//en utilisant la table conversation
{
	if ( $id_last == get_last_message($id,$bdd) and $pin_unpin==false)

	{
		echo "Rien";
		exit();
	}

		$tab_user= array();
		$conversations_ep=$bdd->prepare('SELECT * from conversation where (iduser1 ='.$id.' or iduser2 ='.$id.') and (epingler = "oui" or epingler="'.$id.'")ORDER by last_message DESC');// si la colonne épinglée est à "oui" ca signifie que les deux ont épinglé et si ca porte l'id de notre user alors c'est épinglé seulement de son coté
		$conversations_ep->execute();

		while($conversation_ep=$conversations_ep->fetch())// on affiche d'abord les conversations épinglées...
		{

			$message_finals=$bdd->query('SELECT  idMessage as id_msg ,Contenu as contenu ,idExpediteur as idEx, idRecepteur as idRec,date_envoie, date(date_envoie) as jour,time (date_envoie) as heure FROM message WHERE idMessage='.$conversation_ep['last_message'].'');


			$message_final=$message_finals->fetch();
					//on compte maintenant tout les nouveaux messages de la meme conversation que celle-ci...
					if($message_final['idEx']==$id)
					{
						$msg_non_lu= $bdd->query('SELECT COUNT(*) as nbr from message where (idExpediteur='.$message_final['idRec'].' and idRecepteur='.$id.') and statut!="lu" ');
					}
					else
					{
						$msg_non_lu= $bdd->query('SELECT COUNT(*) as nbr from message where (idExpediteur='.$message_final['idEx'].' and idRecepteur='.$id.') and statut!="lu" ');
					}

					$nbr_non_lu=$msg_non_lu->fetch();


					if($nbr_non_lu['nbr']>0)
					{
						$afficher_nbre='<div class="AC_Me_nouveau_message">
											<span>'.$nbr_non_lu['nbr'].'</span>
										</div>';
						$couleur_date=' style="color:  #0B8CB8"';
					}
					else
					{
						$afficher_nbre='';
						$couleur_date=''; 
					}

					if($message_final['jour']==date("Y-m-d"))
					{
						$heure=$message_final['heure'];
					}
					else
					{
						$heure=Me_conversion_date($message_final['jour']);
					}
					if($message_final['idEx']==$id)
					{
						$id_to_select=$message_final['idRec'];
						$precision="Vous: ";

					}
					else
					{	

						$id_to_select=$message_final['idEx'];
						$precision="";
					}
						$utilisateurs=$bdd->query('SELECT * FROM utilisateur where idUtilisateur = '.$id_to_select);
						$utilisateur=$utilisateurs->fetch();
						echo '<a onmouseleave="enrouler(\'#AC_Me_deroulant_'.$conversation_ep['id_conversation'].'\')" href="index.php?module=utilisateur&action=message&id_contact='.$utilisateur['idUtilisateur'].'#ME_repere"> 	
									<div class="AC_Me_box1b1">';
                                       Me_show_user2($utilisateur['idUtilisateur']);
                                        
								echo'</div>
									<div class="AC_Me_box1b2" >
										<div class="AC_Me_name_contact">
											'.$utilisateur['Nom_utilisateur'].' '.$utilisateur['Prenom_utilisateur'].'
											<span class="AC_Me_heure" '.$couleur_date.'>
												'.$heure.'
											</span>
										</div>

										<div class="AC_Me_dernier_message">
											<strong>'.$precision.'</strong> '.CoupePhrase($message_final['contenu'],70).'
										</div>
										 '.$afficher_nbre.'
								   </div>
								   <div class="AC_Me_pin_icon"><i class="fas fa-thumbtack"></i></div>
								   <div class="AC_Me_option" id="AC_Me_option_'.$conversation_ep['id_conversation'].'" onclick="option(\'#AC_Me_option_'.$conversation_ep['id_conversation'].'\') "><i class="fas fa-ellipsis-v"></i></div>
								   <div class="AC_Me_deroulant" tabindex="-1" id="AC_Me_deroulant_'.$conversation_ep['id_conversation'].'" onmouseleave="enrouler(\'#AC_Me_deroulant_'.$conversation_ep['id_conversation'].'\')">
								   		<span onclick="epingler_desepingler(\'Me_conver_'.$conversation_ep['id_conversation'].'\',\'retirer\')">>Retirer
								   		</span>
								   </div>
							   </a>';


							   $tab_user[]=$utilisateur['idUtilisateur'];//on recupere les id qu'on a deja affiché  pour afficher  ceux qu'on a pas affiché
	
		}



		$conversations=$bdd->prepare('SELECT * from conversation where (iduser1 ='.$id.' or iduser2 ='.$id.') and (epingler != "oui" and epingler!="'.$id.'") and (archiver != "oui" and archiver!="'.$id.'") ORDER by last_message DESC');
		$conversations->execute();
		while($conversation=$conversations->fetch())// on affiche maintenant les conversations qui ne sont ni épinglées ni archivées...
		{

			$message_finals=$bdd->query('SELECT  idMessage as id_msg ,Contenu as contenu ,idExpediteur as idEx, idRecepteur as idRec,date_envoie, date(date_envoie) as jour,time (date_envoie) as heure FROM message WHERE idMessage='.$conversation['last_message'].'');


			$message_final=$message_finals->fetch();
					//on compte maintenant tout les nouveaux messages de la meme conversation que celle-ci...
					if($message_final['idEx']==$id)
					{
						$msg_non_lu= $bdd->query('SELECT COUNT(*) as nbr from message where (idExpediteur='.$message_final['idRec'].' and idRecepteur='.$id.') and statut!="lu" ');
					}
					else
					{
						$msg_non_lu= $bdd->query('SELECT COUNT(*) as nbr from message where (idExpediteur='.$message_final['idEx'].' and idRecepteur='.$id.') and statut!="lu" ');
					}

					$nbr_non_lu=$msg_non_lu->fetch();


					if($nbr_non_lu['nbr']>0)
					{
						$afficher_nbre='<div class="AC_Me_nouveau_message">
											<span>'.$nbr_non_lu['nbr'].'</span>
										</div>';
						$couleur_date=' style="color:  #0B8CB8"';
					}
					else
					{
						$afficher_nbre='';
						$couleur_date=''; 
					}

					if($message_final['jour']==date("Y-m-d"))
					{
						$heure=$message_final['heure'];
					}
					else
					{
						$heure=Me_conversion_date($message_final['jour']);
					}
					if($message_final['idEx']==$id)
					{
						$id_to_select=$message_final['idRec'];
						$precision="Vous: ";

					}
					else
					{	

						$id_to_select=$message_final['idEx'];
						$precision="";
					}
						$utilisateurs=$bdd->query('SELECT * FROM utilisateur where idUtilisateur = '.$id_to_select);
						$utilisateur=$utilisateurs->fetch();
						echo '<a onmouseleave="enrouler(\'#AC_Me_deroulant_'.$conversation['id_conversation'].'\') " href="index.php?module=utilisateur&action=message&id_contact='.$utilisateur['idUtilisateur'].'#ME_repere"> 	
									<div class="AC_Me_box1b1">';
                                       Me_show_user2($utilisateur['idUtilisateur']);
                                        
								echo'</div>
									<div class="AC_Me_box1b2" >
										<div class="AC_Me_name_contact">
											'.$utilisateur['Nom_utilisateur'].' '.$utilisateur['Prenom_utilisateur'].'
											<span class="AC_Me_heure" '.$couleur_date.'>
												'.$heure.'
											</span>
										</div>

										<div class="AC_Me_dernier_message">
											<strong>'.$precision.'</strong> '.CoupePhrase($message_final['contenu'],70).'
										</div>
										 '.$afficher_nbre.'
								   </div>
								   <div class="AC_Me_option" id="AC_Me_option_'.$conversation['id_conversation'].'" onclick="option(\'#AC_Me_option_'.$conversation['id_conversation'].'\') " >
								   		<i class="fas fa-ellipsis-v"></i>
								   	</div>
								   <div class="AC_Me_deroulant" tabindex="-1" id="AC_Me_deroulant_'.$conversation['id_conversation'].'" onmouseleave="enrouler(\'#AC_Me_deroulant_'.$conversation['id_conversation'].'\') ">
								   		<span onclick="epingler_desepingler(\'Me_conver_'.$conversation['id_conversation'].'\',\'epingler\')">
								   			>Épingler
								   		 </span>
								   		<span onclick="archiver_desarchiver(\'Me_conver_'.$conversation['id_conversation'].'\',\'archiver\')">
								   			>Archiver
								   		</span>
								   </div>
							   </a>';


							   $tab_user[]=$utilisateur['idUtilisateur'];//on recupere les id qu'on a deja affiché  pour afficher  ceux qu'on a pas affiché
	
				}
		utilisateur_restant($tab_user,$id,$bdd);

		echo '<input type="hidden" id="ME_id_last_message" name="" value=' . get_last_message($id,$bdd).' >';// this line will be use to refresh our page the next times...
}


// Cette fonction n'est plus utile celle d'en haut la remplace parfaitement...

/*function Me_ajax_Acceuil_Msg($bdd,$id,$id_last)
	{	
		if ( $id_last == get_last_message($id,$bdd))
		{
			echo "Rien";
			exit();
		}
		
		$messages=$bdd->query('SELECT * FROM message where idExpediteur='.$id.' or idRecepteur='.$id.' ORDER BY idMessage DESC');
				$i=0;
				$tab[]='';
				$tab_user=array();


				while($message=$messages->fetch())
				{
					
					$id_emeteur=$message['idExpediteur'];//control shift D
					$id_recepteur=$message['idRecepteur'];
					$utilisateurs=$bdd->prepare('SELECT  idMessage as id_msg ,Contenu as contenu ,idExpediteur as idEx, idRecepteur as idRec,date_envoie, date(date_envoie) as jour,time (date_envoie) as heure FROM `message` WHERE (idExpediteur='.$id_emeteur.' AND idRecepteur='.$id_recepteur.') OR (idExpediteur='.$id_recepteur.' AND idRecepteur ='.$id_emeteur.') ORDER BY idMessage DESC LIMIT 1');
					$utilisateurs->execute();
					$count = $utilisateurs->rowCount();
					$utilisateur=$utilisateurs->fetch();

					if($count>0) 
					{
						//echo $utilisateur['id_msg'].'<br/>';
						$tab[$i]=$utilisateur['id_msg'];
					}
					$i=$i+1;
				}

				$var = array_unique($tab);
				foreach ($var as $key ) 
				{

					$message_finals=$bdd->query('SELECT  idMessage as id_msg ,Contenu as contenu ,idExpediteur as idEx, idRecepteur as idRec,date_envoie, date(date_envoie) as jour,time (date_envoie) as heure FROM message WHERE idMessage='.$key);

					$message_final=$message_finals->fetch();
					//on selectionne maintenant tout les nouveaux messages de la meme conversation que celle-ci...
					if($message_final['idEx']==$id)
					{
						$msg_non_lu= $bdd->query('SELECT COUNT(*) as nbr from message where (idExpediteur='.$message_final['idRec'].' and idRecepteur='.$id.') and statut!="lu" ');
					}
					else
					{
						$msg_non_lu= $bdd->query('SELECT COUNT(*) as nbr from message where (idExpediteur='.$message_final['idEx'].' and idRecepteur='.$id.') and statut!="lu" ');
					}

					$nbr_non_lu=$msg_non_lu->fetch();


					if($nbr_non_lu['nbr']>0)
					{
						$afficher_nbre='<div class="AC_Me_nouveau_message">
											<span>'.$nbr_non_lu['nbr'].'</span>
										</div>';
						$couleur_date=' style="color:  #0B8CB8"';
					}
					else
					{
						$afficher_nbre='';
						$couleur_date='';
					}

					if($message_final['jour']==date("Y-m-d"))
					{
						$heure=$message_final['heure'];
					}
					else
					{
						$heure=Me_conversion_date($message_final['jour']);
					}

					//On recupére l'id de l'interlocuteur de notre utilisateur...

					if($message_final['idEx']==$id)
					{
						$id_to_select=$message_final['idRec'];
						$precision="Vous :";

					}
					else
					{	

						$id_to_select=$message_final['idEx'];
						$precision="";
					}
						$utilisateurs=$bdd->query('SELECT * FROM utilisateur where idUtilisateur = '.$id_to_select);
						$utilisateur=$utilisateurs->fetch();
						echo '<a href="Message.php?id_contact='.$utilisateur['idUtilisateur'].'#ME_repere"> 	
									<div class="AC_Me_box1b1">';
                                       Me_show_user2($utilisateur['idUtilisateur']);
                                        
								echo'</div>
									<div class="AC_Me_box1b2" >
										<div class="AC_Me_name_contact">
											'.$utilisateur['Nom_utilisateur'].' '.$utilisateur['Prenom_utilisateur'].'
											<span class="AC_Me_heure" '.$couleur_date.'>
												'.$heure.'
											</span>
										</div>

										<div class="AC_Me_dernier_message">
											<strong>'.$precision.'</strong>  '.CoupePhrase($message_final['contenu'],80).'
										</div>
										 '.$afficher_nbre.'
								   </div>
								   <div class="AC_Me_option"><i class="fas fa-ellipsis-v"></i></div>
								   <div class="AC_Me_deroulant">
								   		<span>>Épingler</span>
								   		<span>>Archiver</span>
								   </div>
							   </a>';


							   $tab_user[]=$utilisateur['idUtilisateur'];//on recupere les id qu'on a deja affiché  pour afficher  ceux qu'on a pas affiché
	
				}


				utilisateur_restant($tab_user,$id,$bdd);

				echo '<input type="hidden" id="ME_id_last_message" name="" value=' . get_last_message($_POST['id_user'],$bdd).' >';// this line will be use to refresh our page the next times...
	}*/ 





// ici on procéde à des tests pour savoir quels blocs sera exécuté en fonction des données recu...

			if(isset($_POST['id_user_recherche']) and isset($_POST['recherche'])) //recherche message
			{	
				$id=$_POST['id_user_recherche'];
				$search=$_POST['recherche'];
				Me_Ajax_rechercher_Msg($bdd,$id,$search);
				exit();
			}
			
			if (isset($_POST['id_user']) and isset($_POST['id_message']) and !isset($_POST['action'])) // actualisation de la pge d'acceuil
			{
				 Me_ajax_Acceuil_Msg_c($bdd,$_POST['id_user'],$_POST['id_message']);
				exit();
			}

			if (isset($_POST['id_user']) and isset($_POST['id_message']) and isset($_POST['action']) and isset($_POST['id_convers']) )//epingler et desepingler...
			{
				Me_epingler_desepingler($bdd,$_POST['id_user'],$_POST['id_convers'],$_POST['action']);
				Me_ajax_Acceuil_Msg_c($bdd,$_POST['id_user'],$_POST['id_message'],true);
				exit();
				
			}
			if (isset($_POST['id_user']) and isset($_POST['id_message']) and isset($_POST['action']) and isset($_POST['id_convers_to_archive']) )//archiver
			{
				Me_archiv_desarchiv($bdd,$_POST['id_user'],$_POST['id_convers_to_archive'],$_POST['action']);
				Me_ajax_Acceuil_Msg_c($bdd,$_POST['id_user'],$_POST['id_message'],true);
				exit();
				
			}
			if(isset($_POST['id_statut'])) // actualisation du statut
			{
				$statuts=$bdd->query('SELECT * from utilisateur where idUtilisateur='.$_POST['id_statut']);
				$statut=$statuts->fetch();
				echo $statut['Statut_utilisateur'];
				exit();
			}
			if(isset($_POST['id_user_archiv']))
			{
				afficher_archiv($bdd,$_POST['id_user_archiv']);
			}

			if (isset($_POST['id_user_nbre_msg']))
			{
				GET_nbre_converse($_POST['id_user_nbre_msg'],$bdd);
				exit();
			}

			if (isset($_POST['id']) and isset($_POST['date']) and isset($_POST['idEx']) and isset($_POST['idRec']) )   // ajax actualisation de message 
			{
				Me_actualiser_message($bdd,$_POST['id'],$_POST['idEx'],$_POST['idRec'],$_POST['date']);
				exit();
			}

			if (isset($_POST['rechercher_contact']) and isset($_POST['id'])) // rechercher contact
			{
				Me_rechercher_contact($bdd,$_POST['id'],$_POST['rechercher_contact']);
				exit();
			}
 