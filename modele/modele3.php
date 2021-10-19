<?php // Ce fichier contient les fonctions pour tout le module message et notification

	try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=seinova;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));// ce dernier paramettre permet d'afficher les erreurs SQL
		}
		catch (Exception $e)
		{
		        die('Erreur : ' . $e->getMessage());
		}

	function Me_show_user2($id)
{
    $bdd = new PDO('mysql:host=localhost;dbname=seinova;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	$donne=$bdd->query('SELECT * from utilisateur where idUtilisateur ='.$id);
	$PP=$donne->fetch();
	if($PP['Photo']=='')
	{
		echo '<div class="Me_show_user2_ico"><i class="fa fa-user-alt fa-3x"></i></div>';
	}
	else
	{
		echo '<img src ="./'.$PP['Photo'].'" />';
	}
}
	function get_last_message($id_user,$bdd)// cette fonction permet de retourner l'id du dernier message envoyer ou recu par l'Utilisateur et qui sera utilisé plutard pour verifier si l'utilisateura un nouveau message pour pouvoir recharger la page d'accueil
	{
		$last=$bdd->prepare('SELECT max(idMessage) as maxi FROM `message` WHERE (idExpediteur=:id or idRecepteur=:id)');
		$last->bindValue(':id',$id_user,PDO::PARAM_INT);
		$last->execute();
		$last_message=$last->fetch();
		return $last_message['maxi'];
	}

	/*function Me_conversion_date($date)
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
				 
		} on a mis cette fonction en commentaire car cela créait un conflit*/

	function CoupePhrase($txt, $long = 50)
	{
					 if(strlen($txt) <= $long)
					 {
					       return $txt;
					 } else
					 {
					 	$txt = substr($txt, 0, $long);
					 	$post=strrpos($txt, ' ');
					 	if($post!==false)
					 	{
					 		return substr($txt, 0, strrpos($txt, ' ')).'...';
					 	}
					 	else
					 	{
					 		return  $txt.'...';
					 	}
					 }
					 
	}
	function GET_nbre_converse($id,$bdd)
	{
		$message=$bdd->query('SELECT DISTINCT idExpediteur from message where idRecepteur='.$id.' and (statut="non_lu" or statut="envoyer")');
		if($message->rowCount())
		{
			echo $message->rowCount();
		}
		else
		{
			echo "";
		}
	}
	function Me_afficher_Recepteur($idRec,$bdd)
	{
		$nombre=$bdd->prepare('SELECT * from utilisateur where idUtilisateur=:id');
		$nombre->bindValue(':id',$idRec,PDO::PARAM_INT);
		$nombre->execute();
		$donnees=$nombre->fetch();
		        echo 	'<a href="../'.$donnees['Photo'].'"> 
		        			<div class="Me_afficher_recepteur">
								<div class="ME_box1b1">';
                                        Me_show_user2($donnees['idUtilisateur'], "ME_box1b1");
                                        
								echo'</div>
								<div class="ME_box1b2">
									<div class="Me_name_contact">
									'.$donnees['Nom_utilisateur'].' '.CoupePhrase($donnees['Prenom_utilisateur'],10).'
									</div>
									<div class="Me_statut_contact" id="Me_statut_receptr'.$donnees['idUtilisateur'].'">
										'.$donnees['Statut_utilisateur'].'
									</div> 
								</div>
						  </div>
						 </a>'
						  ;
	}

	function Me_Acceuil_Msg_recent($bdd,$id)
	{
		$conversations_ep=$bdd->prepare('SELECT * from conversation where (iduser1 ='.$id.' or iduser2 ='.$id.') and (epingler = "oui" or epingler="'.$id.'") ORDER by last_message DESC');// si la colonne épinglée est à "oui" ca signifie que les deux ont épinglé et si ca porte l'id de notre user alors c'est épinglé seulement de son coté
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
						$heure=Me_conversion_date2($message_final['jour']);
					}
					if($message_final['idEx']==$id)
					{
						$id_to_select=$message_final['idRec'];
						$precision="Vous:";

					}
					else
					{	

						$id_to_select=$message_final['idEx'];
						$precision="";
					}
						$utilisateurs=$bdd->query('SELECT * FROM utilisateur where idUtilisateur = '.$id_to_select);
						$utilisateur=$utilisateurs->fetch();
						echo '<a  href="index.php?module=utilisateur&action=message&id_contact='.$utilisateur['idUtilisateur'].'#ME_repere"> 	
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
											<strong>'.$precision.'</strong>  '.CoupePhrase($message_final['contenu'],70).'
										</div>
										 '.$afficher_nbre.'
								   </div>
								   <div class="AC_Me_pin_icon"><i class="fas fa-thumbtack"></i></div>
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
						$heure=Me_conversion_date2($message_final['jour']);
					}
					if($message_final['idEx']==$id)
					{
						$id_to_select=$message_final['idRec'];
						$precision="Vous:";

					}
					else
					{	

						$id_to_select=$message_final['idEx'];
						$precision="";
					}
						$utilisateurs=$bdd->query('SELECT * FROM utilisateur where idUtilisateur = '.$id_to_select);
						$utilisateur=$utilisateurs->fetch();
						echo '<a  href="index.php?module=utilisateur&action=message&id_contact='.$utilisateur['idUtilisateur'].'#ME_repere"> 	
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
											<strong>'.$precision.'</strong>'.CoupePhrase($message_final['contenu'],70).'
										</div>
										 '.$afficher_nbre.'
								   </div>
								   
							   </a>';
	
				}

}
	function Me_Acceuil_Msg_c($bdd,$id)//en utilisant la table conversation
{
		$tab_user=array();

		$conversations_ep=$bdd->prepare('SELECT * from conversation where (iduser1 ='.$id.' or iduser2 ='.$id.') and (epingler = "oui" or epingler="'.$id.'") ORDER by last_message DESC');// si la colonne épinglée est à "oui" ca signifie que les deux ont épinglé et si ca porte l'id de notre user alors c'est épinglé seulement de son coté
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
						$heure=Me_conversion_date2($message_final['jour']);
					}
					if($message_final['idEx']==$id)
					{
						$id_to_select=$message_final['idRec'];
						$precision="Vous:";

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
											<strong>'.$precision.'</strong>  '.CoupePhrase($message_final['contenu'],70).'
										</div>
										 '.$afficher_nbre.'
								   </div>
								   <div class="AC_Me_pin_icon"><i class="fas fa-thumbtack"></i></div>
								   <div class="AC_Me_option" id="AC_Me_option_'.$conversation_ep['id_conversation'].'" onclick="option(\'#AC_Me_option_'.$conversation_ep['id_conversation'].'\') "><i class="fas fa-ellipsis-v"></i></div>
								   <div class="AC_Me_deroulant" id="AC_Me_deroulant_'.$conversation_ep['id_conversation'].'" tabindex="-1" onmouseleave="enrouler(\'#AC_Me_deroulant_'.$conversation_ep['id_conversation'].'\')">
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
						$heure=Me_conversion_date2($message_final['jour']);
					}
					if($message_final['idEx']==$id)
					{
						$id_to_select=$message_final['idRec'];
						$precision="Vous:";

					}
					else
					{	

						$id_to_select=$message_final['idEx'];
						$precision="";
					}
						$utilisateurs=$bdd->query('SELECT * FROM utilisateur where idUtilisateur = '.$id_to_select);
						$utilisateur=$utilisateurs->fetch();
						echo '<a onmouseleave="enrouler(\'#AC_Me_deroulant_'.$conversation['id_conversation'].'\') "id="Me_conver_'.$message_final['id_msg'].'" href="index.php?module=utilisateur&action=message&id_contact='.$utilisateur['idUtilisateur'].'#ME_repere"> 	
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
											<strong>'.$precision.'</strong>'.CoupePhrase($message_final['contenu'],70).'
										</div>
										 '.$afficher_nbre.'
								   </div>
								   <div class="AC_Me_option" id="AC_Me_option_'.$conversation['id_conversation'].'" onclick="option(\'#AC_Me_option_'.$conversation['id_conversation'].'\') "><i class="fas fa-ellipsis-v"></i></div>
								   <div class="AC_Me_deroulant" id="AC_Me_deroulant_'.$conversation['id_conversation'].'" tabindex="-1" onmouseleave="enrouler(\'#AC_Me_deroulant_'.$conversation['id_conversation'].'\') ">
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

}

	/*	function Me_afficher_Acceuil_Msg($bdd,$id)
	{
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
						$msg_non_lu= $bdd->query(' SELECT COUNT(*) as nbr from message where (idExpediteur='.$message_final['idRec'].' and idRecepteur='.$id.') and statut!="lu" ');
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
						$precision="Vous";

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
											<strong>'.$precision.'</strong> : '.CoupePhrase($message_final['contenu'],70).'
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
	

				utilisateur_restant($tab_user,$id,$bdd);// fonction utilisée pour afficher les utilisateurs qui n'ont aucune conversation...
	} */

 	function utilisateur_restant(array $tab_user,$id,$bdd)
 	{
 		$utilisateur_restants=$bdd->query('SELECT * from utilisateur where idUtilisateur !='.$id);
 		while($utilisateur_restant=$utilisateur_restants->fetch())
				{
					if(!in_array($utilisateur_restant['idUtilisateur'], $tab_user))
					{
						$user2=$utilisateur_restant['idUtilisateur'] ;
						$convers_non_archiv=$bdd->prepare('SELECT * from conversation where (iduser1 =:id and iduser2 =:id2) or (iduser1 =:id2 and iduser2 =:id) ');
						$convers_non_archiv->bindValue(":id",$id,PDO::PARAM_INT);
						$convers_non_archiv->bindValue(":id2",$user2,PDO::PARAM_INT);
						$convers_non_archiv->execute();

						if(!$convers_non_archiv->rowCount())// On n'agit que si la conversation n'existe pas car si elle existe ce qu'elle est achiver donc on ne l'affiche pas
						{
							echo '<a href="index.php?module=utilisateur&action=message&id_contact='.$utilisateur_restant['idUtilisateur'].'"> 	
									<div class="AC_Me_box1b1">';
                                        Me_show_user2($utilisateur_restant['idUtilisateur'], "AC_Me_box1b1");
                                        
								echo'</div>
									<div class="AC_Me_box1b2" >
										<div class="AC_Me_name_contact">
											'.$utilisateur_restant['Nom_utilisateur'].' '.$utilisateur_restant['Prenom_utilisateur'].'
										</div>

										<div class="AC_Me_aucun_message">
											 <em>//Aucun message</em>
										</div>
								   </div>
							   </a>';
						}
					}
				}
 	}

	function Me_afficher_contact($bdd,$id)
	{
		$nombre=$bdd->query('SELECT * from utilisateur where idUtilisateur!='.$id.' order by Nom_utilisateur asc');
				
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
				$nombre->closeCursor();
	}


	//en attendant l'id d'envoie
	function Me_afficher_message($bdd,$id_sender,$id_receiver)
	{
		$date_send=$bdd->prepare('SELECT DISTINCT date(date_envoie) as date_envoie from message where (idExpediteur= :id  and idRecepteur= :id_receiver) or  (idExpediteur= :id_receiver  and idRecepteur= :id) order by idMessage asc');
		$date_send->bindValue(":id",$id_sender,PDO::PARAM_INT);
		$date_send->bindValue(":id_receiver",$id_receiver,PDO::PARAM_INT);
		$date_send->execute();
		$ajax_date='';
		$ajax_id=0;
			while($donnees = $date_send->fetch())
			{ 
				$ajax_date=$donnees['date_envoie'];//on va s'en servir avec ajax plutard;
				if($ajax_date==date('Y-m-d'))
				{
					$date_final='Aujourd\'hui';
				}
				else
				{
					$date_final=Me_conversion_date2($ajax_date);
				}

				echo'<div class="Me_date_send">
						'.$date_final.'
					 </div> ';
				$nombre=$bdd->prepare('SELECT message.idMessage as id_msg ,message.Contenu as contenu ,message.idExpediteur as idEx,message.idRecepteur as idRec,time(message.date_envoie) as heure, statut FROM message WHERE date(message.date_envoie) =:date_send and ((message.idExpediteur=:idEx and message.idRecepteur=:idRec) OR( message.idExpediteur=:idRec and message.idRecepteur=:idEx))  ORDER BY message.idMessage ASC');
					$nombre->bindValue(":date_send",date($donnees['date_envoie']),PDO::PARAM_STR);
					$nombre->bindValue(":idEx",$id_sender,PDO::PARAM_INT);
					$nombre->bindValue(":idRec",$id_receiver,PDO::PARAM_INT);
					$nombre->execute();
					while ($data=$nombre->fetch())
					 { 
					 	$ajax_id=$data['id_msg'];//on va s'en servir avec ajax plutard;


					 		

					 	$nombre2=$bdd->prepare('SELECT id_fichier as id_file, nom ,URL , type, taille FROM fichier where id_message=:id_message');
					 		$nombre2->bindValue(":id_message",$data['id_msg'],PDO::PARAM_INT);
					 		$nombre2->execute();

					 	if($data['idEx']==$id_sender)

					 	{	
					 		echo '<div class=Me_shaw_file>';
					 		while ($shawfile=$nombre2->fetch())
						 		 {
						 		 	if($shawfile['type']=='image')
						 		 	{
						 		 		echo'<div class="Me_image_contener">
													<a href="'.$shawfile['URL'].'">
														<img src="'.$shawfile['URL'].'"/>
													</a><br/>
														<span>'.$shawfile['nom'].'</span>
												</div>';
						 		 	}
						 		 	elseif($shawfile['type']=="pdf")
						 		 	{
						 		 		echo'<div class="Me_file_contener">
													<a href="'.$shawfile['URL'].'">
													<i class="fas fa-file-pdf"></i>
												</a><br/>
													<span>'.$shawfile['nom'].'</span>
												</div>';
						 		 	}
						 		 	elseif($shawfile['type']=="document")
						 		 	{
						 		 		echo'<div class="Me_file_contener">
														<a href="'.$shawfile['URL'].'">
															<i class="far fa-file-word"></i>
														</a><br/>
															<span>'.$shawfile['nom'].'</span>
												</div>';
						 		 	}
						 		 	elseif($shawfile['type']=="audio")
						 		 	{
						 		 		echo'<div class="Me_file_contener">
													<a href="'.$shawfile['URL'].'">
														<i class="fas fa-file-audio"></i>
													</a><br/>
														<span>'.$shawfile['nom'].'</span>
							   					 </div>
						   					 ';
						 		 	}
						 		 	elseif($shawfile['type']=="video")
						 		 	{
						 		 		echo'<div class="Me_file_contener">
													<a href="'.$shawfile['URL'].'">
														<i class="far fa-file-video"></i>
													</a><br/>
														<span>'.$shawfile['nom'].'</span>
						   					 </div>
											
						   					 ';
						 		 	}
						 		 	else
						 		 	{
						 		 		echo'<div class="Me_file_contener">
													<a href="'.$shawfile['URL'].'">
														<i class="fas fa-file"></i>
														
													</a><br/>
												<span>'.$shawfile['nom'].'</span>
											</div>
						   					 ';
						 		 	}

						 			
						 		}
						 		echo '</div>';

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
					 		$statut_set=$bdd->query('UPDATE message set statut="lu" where idMessage='.$data['id_msg']);
					 		echo '<div class=Me_shaw_file2>';
					 		while ($shawfile=$nombre2->fetch())
						 		 {
						 		 	if($shawfile['type']=='image')
						 		 	{
						 		 		echo'<div class="Me_image_contener2">
													<a href="'.$shawfile['URL'].'">
														<img src="'.$shawfile['URL'].'"/>
													</a><br/>
														<span>'.$shawfile['nom'].'</span>
												</div>';
						 		 	}
						 		 	elseif($shawfile['type']=="pdf")
						 		 	{
						 		 		echo'<div class="Me_file_contener2">
													<a href="'.$shawfile['URL'].'">
													<i class="fas fa-file-pdf"></i>
												</a><br/>
													<span>'.$shawfile['nom'].'</span>
												</div>';
						 		 	}
						 		 	elseif($shawfile['type']=="document")
						 		 	{
						 		 		echo'<div class="Me_file_contener2">
														<a href="'.$shawfile['URL'].'">
															<i class="far fa-file-word"></i>
														</a><br/>
															<span>'.$shawfile['nom'].'</span>
												</div>';
						 		 	}
						 		 	elseif($shawfile['type']=="audio")
						 		 	{
						 		 		echo'<div class="Me_file_contener2">
													<a href="'.$shawfile['URL'].'">
														<i class="fas fa-file-audio"></i>
													</a><br/>
														<span>'.$shawfile['nom'].'</span>
							   					 </div>
						   					 ';
						 		 	}
						 		 	elseif($shawfile['type']=="video")
						 		 	{
						 		 		echo'<div class="Me_file_contener2">
													<a href="'.$shawfile['URL'].'">
														<i class="far fa-file-video"></i>
													</a><br/>
														<span>'.$shawfile['nom'].'</span>
						   					 </div>
											
						   					 ';
						 		 	}
						 		 	else
						 		 	{
						 		 		echo'<div class="Me_file_contener2">
													<a href="'.$shawfile['URL'].'">
														<i class="fas fa-file"></i>
														
													</a><br/>
												<span>'.$shawfile['nom'].'</span>
											</div>
						   					 ';
						 		 	}

						 			
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
		echo '<input type="text"  name="ME_last_message" id="ME_last_message" hidden value="'.$ajax_id.'"/>
			  <input type="text"  name="ME_last_message_date" id="ME_last_message_date" hidden value="'.$ajax_date.'"/>';
	}
  ?>