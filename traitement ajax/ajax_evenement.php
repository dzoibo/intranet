<?php include "../modele/modele4.php";

 try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=seinova;charset=utf8', 'root', '');
		}
		catch (Exception $e)
		{
		    die('Erreur : ' . $e->getMessage());
		}

if(isset($_POST['valeur']))
{

	if($_POST['valeur'] =='rechercher') 
	{
 
        afficher_recherche($bdd,$_POST['contenu']);	
    }
    else
    {
    	$drop=substr($_POST['valeur'],19);
        $bdd->query(' UPDATE evenements set supprimer=1 WHERE id_eve='.$drop);
        echo $drop;

        // place aux notifications
        		$new_notif=$bdd->prepare('INSERT INTO notification (typeNotification,dateNotification,contenuNotification,id_auteur,id_content) values ("evenement",:dateNotif," a supprimé un evenement auquel vous êtes  participant 
						",:idauteur,:id_content)');
	             					$new_notif->bindValue(":dateNotif",date('Y-m-d H:i:s'),PDO::PARAM_STR);
	             					$new_notif->bindValue(":idauteur",$_POST['id_auteur_delete'],PDO::PARAM_INT);
	             					$new_notif->bindValue(":id_content", $drop,PDO::PARAM_INT);
	             					$new_notif->execute();

	             					$last_notif=$bdd->query('SELECT MAX(idNotification) as idNotification FROM notification');
	             					$last_notif=$last_notif->fetch();
        		$reccuperation=$bdd->query('SELECT id_utilisateur FROM participation where id_eve='.$drop);
				$i=0;

				while ($id_participant=$reccuperation->fetch())//on place tout dans un tableau...
				{

					$value=$id_participant['id_utilisateur'];
					
					if($value==$_POST['id_auteur_delete'])
						{
							continue;
						}

					$notif_has_user = $bdd->prepare('INSERT INTO notification_has_user(id_recepteur, id_notification, Statut) VALUES (:idrecep,:idnotif ,"non_lu")');
            		 									$notif_has_user->bindValue(":idrecep", $value,PDO::PARAM_INT);
            		 									$notif_has_user->bindValue(":idnotif",$last_notif['idNotification'],PDO::PARAM_INT);
             											$notif_has_user->execute();

				}
    }
}




if ( isset($_FILES["EV_file"]) and isset($_POST['idEve']) )
{
	upload_rapport($_FILES["EV_file"],$bdd,$_POST['idEve']);

	// Notification pour l'ajout du rapport

	$new_notif=$bdd->prepare('INSERT INTO notification (typeNotification,dateNotification,contenuNotification,id_auteur,id_content) values ("rapport_eve",:dateNotif," a importé un rapport à un événement auquel vous avez  participé 
						",:idauteur,:id_content)');
	$new_notif->bindValue(":dateNotif",date('Y-m-d H:i:s'),PDO::PARAM_STR);
	$new_notif->bindValue(":idauteur",$_POST['id_auteur'],PDO::PARAM_INT);
	$new_notif->bindValue(":id_content", $_POST['idEve'],PDO::PARAM_INT);
	$new_notif->execute();

	$last_notif=$bdd->query('SELECT MAX(idNotification) as idNotification FROM notification');
	$last_notif=$last_notif->fetch();



				$reccuperation=$bdd->query('SELECT id_utilisateur FROM participation where id_eve='.$_POST['idEve']);

				while ($id_participant=$reccuperation->fetch())//on place tout dans un tableau...
				{

					$value=$id_participant['id_utilisateur'];
					
				
					if($value==$_POST['id_auteur'])
						{
							continue;
						}

					$notif_has_user = $bdd->prepare('INSERT INTO notification_has_user(id_recepteur, id_notification, Statut) VALUES (:idrecep,:idnotif ,"non_lu")');
            		 									$notif_has_user->bindValue(":idrecep", $value,PDO::PARAM_INT);
            		 									$notif_has_user->bindValue(":idnotif",$last_notif['idNotification'],PDO::PARAM_INT);
             											$notif_has_user->execute();

				}
	
}

function upload_rapport($file,$bdd,$id)
{
	$nomOrigine = $file['name'];
	$elementsChemin = pathinfo($nomOrigine);
	$extensionFichier = $elementsChemin['extension'];
	if ($extensionFichier!='pdf')
	{
	    echo "Le fichier n'a pas l'extension attendue";
	} 
	elseif ($file["size"]>=10000000)
	{
		echo "Fichier trop volumineux";
	}
	else
	{    
	    // Copie dans le repertoire du script avec un nom
	    // incluant l'heure a la seconde pres 
	    $repertoireDestination ="Document/Rapport/";
	    $nomDestination = "Rapport_".date("YmdHis").".".$extensionFichier;

	    if (move_uploaded_file($file["tmp_name"],"../". $repertoireDestination.$nomDestination)) 
	    {
	      echo "Le fichier temporaire ".$file["tmp_name"]." a été déplacé vers ".$repertoireDestination.$nomDestination;
	     $insert= $bdd->prepare('UPDATE evenements SET rapport_eve="'.$repertoireDestination.$nomDestination.'" WHERE id_eve='.$id.'');
	     $insert->execute();
	     var_dump($insert);
	    }
	    else
	    {
	      echo "Erreur de telechargement...";          
	    }
	}
}
function afficher_recherche($bdd,$contenu)
	    	{
	    		$nombre=$bdd->query('SELECT id_eve,theme,description,type,date_eve ,date_creation from evenements where depasser=0 and Supprimer=0 and  theme LIKE \'%'.$contenu.'%\'');
			

				if(!( $nombre->rowCount()))
				{
					echo '<div class="ev_modifier_title2"> Aucun évenement trouvé<div>';
					exit();
				}
				else
				{
					echo '<h2 class="ev_modifier_title"> Resultat Recherche </h2>';
				}
				
				while ($donnees = $nombre->fetch() )
				{
					if(!comparer_date($donnees['date_eve']))// on verifie si la date n'est pas encore passée si c'est le cas on change la valeur de depasser
					{
						$bdd->query('UPDATE evenements SET depasser=1 WHERE id_eve='.$donnees['id_eve'].'');
					}
					else
					{
						$date = $donnees['date_eve'];
						list($date2, $time2) = explode(" ", $donnees['date_creation']);

						
						$nombre_participant=$bdd->prepare('SELECT Nom_utilisateur, idUtilisateur ,Prenom_utilisateur  FROM utilisateur INNER JOIN participation ON id_utilisateur = idUtilisateur WHERE id_eve ='.$donnees['id_eve'].'');
						$nombre_participant->execute();
						$i=$nombre_participant->rowCount();

											
						echo '
						<div class="EV_affichage" id="EV_affichage'.$donnees['id_eve'].'">
					 		<div class="EV_block0" id="EV_'.$donnees['id_eve'].'">
								<div class="EV_block1" id="EV_block1_'.$donnees['id_eve'].'">
										<div >
										    <span class="EV_titre">
											'.$donnees['theme'].'</span>
											<span class="EV_type">('.$donnees['type'].')
											</span><br/><br/>
											<span class="EV_type">
												Créé par <strong>'.Createur($bdd,$donnees['id_eve']).'</strong>  le '
												 .$date2.'
											</span><br/>
										</div>
										<div class="EV_description">
											 '.$donnees['description'].'
										</div>
									
								</div>
								<div class="EV_date_afficher" id="EV_date_'.$donnees['id_eve'].'">
									 Prevu le <strong>';
									 conversion_date($date);//on mets le ';' car notre fonction posséde deja un echo
									 echo'</strong>
								</div>	<br/>	
								<div class="EV_Mblock">
									<div class="EV_participant">
										 0'.$i//$i ici permet d'afficher le nombre de participants
										 .' Participants :

										 <div class="ev_derouler_participant" id=ev_derouler_participant'.$donnees['id_eve'].'> 
										 	<ul>';
										 		while($nombre_participant0=$nombre_participant->fetch())
												{
													echo'<li>' .substr($nombre_participant0['Nom_utilisateur'].' '.$nombre_participant0['Prenom_utilisateur'], 0,20).'</li>';
												}	

										 	echo'	
										 	</ul> 
										 </div>
									</div>
								</div>
								<div class="ev_bt_alter">
									<a href="index.php?module=administration&action=Eve_modification.php&id_eve='.$donnees['id_eve'].'">
							 			<button class="EV_alter EV_update">Modifier<i class="fas fa-pen-alt"></i></button>
									</a>
									<button value="'.$donnees['id_eve'].'"  class="EV_alter EV_delete" id="EV_delete'.$donnees['id_eve'].'" onclick="Supprimer(\'#EV_affichage'.$donnees['id_eve'].'\')"> Supprimer<i class="fas fa-trash-alt"></i>
									</button>
								</div>
							</div>
							
					    </div>
					 	';	
					}
					

				}
	    	}
	
