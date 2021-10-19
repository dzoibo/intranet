<?php 

include "../modele/modele3.php";


	function Me_Acceuil_Msg_recent_ajax($bdd,$id,$id_last)
	{
		if ( $id_last == get_last_message($id,$bdd))

			{
				echo "Rien";
				exit();
			}
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
						$heure=Me_conversion_date($message_final['jour']);
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



		$conversations=$bdd->prepare('SELECT * from conversation where (iduser1 ='.$id.' or iduser2 ='.$id.') and (epingler = "non" and epingler!="'.$id.'") and (archiver = "non" or archiver!="'.$id.'") ORDER by last_message DESC');
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
				echo '<input type="hidden" id="ME_id_last_message" name="" value=' . get_last_message($id,$bdd).' >';
}

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




if (isset($_POST['id_user']) and isset($_POST['id_message']) and !isset($_POST['action'])) // actualisation des converses de la page d'accueil
	{		
		Me_Acceuil_Msg_recent_ajax($bdd,$_POST['id_user'],$_POST['id_message']);
		exit();
	}
 ?>