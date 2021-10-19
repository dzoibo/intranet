
 <?php // Fonctions pour le module evenement


		function user_level($bdd,$id_user)
		{
			$user_level= $bdd->query('SELECT role from utilisateur where idUtilisateur='.$id_user);
			$user_level=$user_level->fetch();
			if ($user_level['role']>=2)
			{
				return true ;
			}
			else 
			{
				return false;
			}
		}
		
		
		function conversion_date ($Cdate)
		{
				
				$Cdate=substr($Cdate, 0, -7);
				list($date, $time) = explode(" ", $Cdate);
				list($year, $month, $day) = explode("-", $date);
				list($hour, $min, $sec) = explode(":", $time);
		
				$months = array("janvier", "février", "mars", "avril", "mai", "juin",
	    		"juillet", "août", "septembre", "octobre", "novembre", "décembre");

	    		return  $day." ".$months[$month-1]." ".$year." <br/><span class=\"EV_heure\">Heure : </span> ".$hour."h".$min."";
		}
			

		function liste_participant($bdd,$id_eve=false)

		{

			if($id_eve)
			{
				$reccuperation=$bdd->query('SELECT id_utilisateur FROM participation where id_eve='.$id_eve);
				$tab_reccuperation=array();
				$i=0;

				while ($id_participant=$reccuperation->fetch())//on place tout dans un tableau...
				{

					$tab_reccuperation[$i]=$id_participant['id_utilisateur'];
					$i++;
				}
				foreach ($tab_reccuperation as $key => $value) //on affcihe d'abord les noms lié à l'évenement ...

				{
					$participants=$bdd->query('SELECT Nom_utilisateur,Prenom_utilisateur ,idUtilisateur from utilisateur where idUtilisateur ='.$value);

					while ($participant=$participants->fetch()) 
					{
							echo '<input type="checkbox" id="AE_user'.$participant['idUtilisateur'].'" name="idUtilisateur[]" value="'.$participant['idUtilisateur'].'" checked  />
								<label for="AE_user'.$participant['idUtilisateur'].'" >'.substr($participant['Nom_utilisateur'].' '.$participant['Prenom_utilisateur'], 0,20).'</label><br>';
					}

				}

				$nombre=$bdd->query('select Nom_utilisateur,Prenom_utilisateur ,idUtilisateur from utilisateur ');
				
				while ($donnees = $nombre->fetch() )
				{
					if (!in_array($donnees['idUtilisateur'],$tab_reccuperation))
					{
						
						echo '<input type="checkbox" id="AE_user'.$donnees['idUtilisateur'].'" name="idUtilisateur[]" value="'.$donnees['idUtilisateur'].'"  />
							<label for="AE_user'.$donnees['idUtilisateur'].'" >'.substr($donnees['Nom_utilisateur'].' '.$donnees['Prenom_utilisateur'], 0,20).'</label><br>';
							//ceci permet d'obtenir le meme resultat mais avec des select plutot--//echo '<option value="'.$donnees['idUtilisateur'].'"> '.$donnees['Nom_utilisateur'].' '.$donnees['Prenom_utilisateur'].'</option>';
					}
				}
			


			}
			else
			{
				$nombre=$bdd->query('select Nom_utilisateur,Prenom_utilisateur ,idUtilisateur from utilisateur ');
				
				while ($donnees = $nombre->fetch() )
				{
					echo '<input type="checkbox" id="AE_user'.$donnees['idUtilisateur'].'" name="idUtilisateur[]" value="'.$donnees['idUtilisateur'].'"  />
							<label for="AE_user'.$donnees['idUtilisateur'].'" >'.substr($donnees['Nom_utilisateur'].' '.$donnees['Prenom_utilisateur'], 0,20).'</label><br>';
					//ceci permet d'obtenir le meme resultat mais avec des select plutot--//echo '<option value="'.$donnees['idUtilisateur'].'"> '.$donnees['Nom_utilisateur'].' '.$donnees['Prenom_utilisateur'].'</option>';
					
				}
			}
				
			
		}


		function comparer_date($date_eve)
		{
			$date1=  new DateTime($date_eve);
			$date1=$date1->getTimestamp();

			$date2=new DateTime('now');
			$date2=$date2->getTimestamp();
			if($date1>$date2)
			{
				return true;
			}
			else
			{
				return false;
			}

		}

		function modifier_eve($bdd,$id)
		{
			$event=$bdd->prepare('SELECT * from evenements where id_eve=:id');
			$event->bindValue(':id',$id,pdo::PARAM_INT);
			$event->execute();

			while ($modif=$event->fetch())
			{

				$jour=substr($modif['date_eve'],0,10);
				$heure=substr($modif['date_eve'],11,5);

				echo '<div class="AE_lbl0" class="AE_lbl0">
								<label  for="AE_theme">Theme de l\'evenement:</label>
							</div>
							<input type="text" required name="theme" id="AE_theme" value="'.$modif['theme'] .'" class="AE_theme" >
							<br>
							<br>
							<div class="AE_lbl0">
									<label  for="type_eve">Type de l\'evenement :</label>
							</div>
							
							<input type="text" required name="type_eve" id="type_eve" value="'. $modif['type'] .'" class="type_eve" >
							<br>
							<br>

							<div class="AE_lbl0">
								<label  for="EV_text" class="EV_area">Description de l\'evenement:</label>
							</div>
							<textarea required placeholder="Rediger..." name="EV_text" value="" id="EV_text" class="EV_text">'. $modif['description'].'</textarea>
							<br>
							<br>
							<div class="AE_temps">
								<label for="temps"> heure : </label>
								<input required type="time" value="'. $heure.'" name="EV_heure">
							</div>
							<label for="date">date : </label>
							<input id="AE_date" type="date" required value="'. $jour.'" name="EV_date">
							<br>
							<br>
							<div class="AE_box2">
								<h3>Ajouter des participants </h3>
								<div class="AE_box2a">';

								echo '
									'.liste_participant($bdd,$id).'
								</div>
							</div>
							<br>
							';
							
			}				
		}

		function Createur($bdd,$id_evenement)
		{
			$nombre=$bdd->query('SELECT utilisateur.idUtilisateur,utilisateur.Nom_utilisateur,utilisateur.Prenom_utilisateur FROM utilisateur,evenements WHERE utilisateur.idUtilisateur = evenements.idCreateur and evenements.id_eve='.$id_evenement);
			
			while ($donnees=$nombre->fetch()) 
			{
				$Createur=substr($donnees['Nom_utilisateur'].' '.$donnees['Prenom_utilisateur'], 0,20);

				return $Createur;
			}
		}
		function acces_evenement($bdd,$id_eve,$id_user)
		{
			$participant=$bdd->prepare('SELECT * from participation where id_eve=:id_eve and id_utilisateur=:id_user');
			$participant->bindValue(':id_eve',$id_eve,PDO::PARAM_INT);	
			$participant->bindValue(':id_user',$id_user,PDO::PARAM_INT);
			$participant->execute();
			if($participant->rowCount())
			{
				return true;
			}	
			else
			{
				return false;
			}
		}
		function afficher_evenements($bdd,$type,$id_user)
		{
			if($type=='simple')
			{
				$nombre=$bdd->query('SELECT * from evenements where depasser=0 and Supprimer=0');
			}
			elseif($type=='mois')
			{
				$nombre=$bdd->query('SELECT * from evenements where depasser=0 and MONTH(evenements.date_eve)=MONTH(NOW()) and Supprimer=0');
				if(!($nombre->rowCount()))
				{
					echo ' <div class="ev_modifier_title2"> Aucun évenement ce mois</div>';
					exit();
				}
				else
				{
					echo '<h2 class=" ev_modifier_title">
								<i class="fas fa-thumbtack"></i>Evenements de ce mois
						  </h2>';
				}
			}
			else
			{
				$nombre=$bdd->query('SELECT * from evenements where depasser=1 and supprimer=0');
			}
			
			

				
			while ($donnees = $nombre->fetch() )
				{
					$user_level= $bdd->query('SELECT role from utilisateur where idUtilisateur='.$id_user);
					$user_level=$user_level->fetch();
					if(!acces_evenement($bdd,$donnees['id_eve'],$id_user) and $user_level['role']<2)
					{
						continue;
					}
					if(!comparer_date($donnees['date_eve']) and $type!='pass')// on verifie si la date n'est pas encore passée si c'est le cas on change la valeur de depasser
					{
						$bdd->query('UPDATE evenements SET depasser=1 WHERE id_eve='.$donnees['id_eve'].'');
					}
					else
					{
							$date = $donnees['date_eve'];
							list($date2, $time2) = explode(" ", $donnees['date_creation']);

							
							$nombre_participant=$bdd->query('SELECT Nom_utilisateur, idUtilisateur ,Prenom_utilisateur  FROM utilisateur INNER JOIN participation ON id_utilisateur = idUtilisateur WHERE id_eve ='.$donnees['id_eve'].'');
							//on compte donc le nombre de participants avec une variable i qu'on va afficher plutard
							$i=$nombre_participant->rowCount();
							
							if($type=='pass')
							{
								if( $user_level['role']>=2)
								{
									if ($donnees['rapport_eve']==NULL)
									{
										
										$last_button='<div class="EV_rapport" id="EV_rapport'.$donnees['id_eve'].'">

													<form action="" class="EV_form" id="EV_form'.$donnees['id_eve'].'" method="post" enctype="multipart/form-data">
														<input onchange="selectedFile(\'#EV_file_input'.$donnees['id_eve'].'\',\'#EV_rapport'.$donnees['id_eve'].'\')" type="file" accept=".pdf" name="EV_file" class="EV_file_input" id="EV_file_input'.$donnees['id_eve'].'" />
														<label for="EV_file_input'.$donnees['id_eve'].'"> 
															<div class="EV_file_contenair"  id="EV_file_contenair'.$donnees['id_eve'].'" > <i class="fas fa-file-upload"></i>
															</div>
														</label><br>
														<input type="number" name="idEve"  hidden value='.$donnees['id_eve'].' ?>
													    <span class="EV_rapport_label">Importer rapport pdf</span>

														<div class="EV_submit_box">
														 	Importer 

															<button type="submit" onClick="envoyer(\'#EV_form'.$donnees['id_eve'].'\',\' #EV_progress-bar'.$donnees['id_eve'].'\',\' #EV_uploadStatus'.$donnees['id_eve'].'\')" name="submit" id="EV_submit'.$donnees['id_eve'].'" class=" EV_submit"  >
																<i class="fas fa-upload"></i>
															</button>
														</div>
														<div class="EV_progress" id="EV_progress'.$donnees['id_eve'].'">
														    <div class="EV_progress-bar" id="EV_progress-bar'.$donnees['id_eve'].'"></div>
														</div>
														<div class="EV_uploadStatus" id="EV_uploadStatus'.$donnees['id_eve'].'"></div>
														
														<label class="EV_label_titre" style="display:none">Telechargement terminé</label>
													</form>

													
											  </div>';		
									}
									else
									{
										$last_button='<div class="EV_rapport" id="EV_rapport'.$donnees['id_eve'].'">

															<a href="'.$donnees['rapport_eve'].'" style=" margin-bottom:3vh;" download="Rapport_'.$donnees['theme'].'">
																<div class="EV_file_contenair"  id="EV_file_contenair'.$donnees['id_eve'].'" > <i class="fas fa-file-pdf ev_pdf" style=" color: rgb(245, 59, 87);"></i>
																</div>
															</a>
															<label class="EV_label_titre" ><span class="EV_rapport_label">
																
															</label>
														    <label class="EV_label_titre" ><span class="EV_rapport_label">
																<u>Rapport_'.$donnees['theme'].'.pdf</u>
															</label>

													 </div>';

									}	

									
								}
								else
								{
									if ($donnees['rapport_eve']==NULL)
									{
										$last_button='<div class="EV_rapport" id="EV_rapport'.$donnees['id_eve'].'">

													
														
														<label for="EV_file_input'.$donnees['id_eve'].'"> 
															<div class="EV_file_contenair"  id="EV_file_contenair'.$donnees['id_eve'].'" > <i class="fas fa-file-upload"></i>
															</div>
														</label><br>
													    
														<label class="EV_label_titre" ><span class="EV_rapport_label">Aucun rapport disponible pour l\'instant</span>
														</label>

														
													
											  </div>
											  ';	
									}
									else
									{
										$last_button='<div class="EV_rapport" id="EV_rapport'.$donnees['id_eve'].'">

															<a href="'.$donnees['rapport_eve'].'" style=" margin-bottom:3vh;" download="Rapport_'.$donnees['theme'].'">
																<div class="EV_file_contenair"  id="EV_file_contenair'.$donnees['id_eve'].'" > <i class="fas fa-file-pdf ev_pdf" style=" color: rgb(245, 59, 87);"></i>
																</div>
															</a>
															<label class="EV_label_titre" ><span class="EV_rapport_label">
																
															</label>
														    <label class="EV_label_titre" ><span class="EV_rapport_label">
																<u>Rapport_'.$donnees['theme'].'.pdf</u>
															</label>

													 </div>';
													
											  	

									 
									}
								}
								
							}
							elseif($user_level['role']>=2)// dans le cas ou c'est un administrateur
							{
								$last_button='<div class="ev_bt_alter">
													<a href="index.php?module=administration&action=Eve_modification&id_eve='.$donnees['id_eve']/*on fera une verification à ce niveau plutard pour voir si l'utilisateur à le droit de voir ca*/ .'">
											 			<button class="EV_alter EV_update">Modifier<i class="fas fa-pen-alt"></i></button>
													</a>
													<button value="'.$donnees['id_eve'].'"  class="EV_alter EV_delete" id="EV_delete'.$donnees['id_eve'].'" onclick="Supprimer(\'#EV_affichage'.$donnees['id_eve'].'\')"> Supprimer<i class="fas fa-trash-alt"></i></button>
												</div>';
							}
							else // dans le cas ou c'est un simple utilisateur
							{
								$last_button="";

							}
							echo '<div class="EV_affichage" id="EV_affichage'.$donnees['id_eve'].'">
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
										 Prevu le <strong>'.
										 conversion_date($date)
										 .'</strong>
									</div>	<br/>	
									<div class="EV_Mblock">
										<div class="EV_participant">
											 0'.$i//$i ici permet d'afficher le nombre de participants
											 .' Participants :

											 <div class="ev_derouler_participant" id=ev_derouler_participant'.$donnees['id_eve'].'>

												 <ul>
										 			';

														while($nombre_participant0=$nombre_participant->fetch())
														{
															echo'<li>' .substr($nombre_participant0['Nom_utilisateur'].' '.$nombre_participant0['Prenom_utilisateur'], 0,20).'</li>';
														}
										 			
						echo '					 </ul> 
											 </div>

										</div>
									</div>
									'.$last_button.'
								</div>

						 	</div>
						 	';
					}
					

				}
		

		}


		

/*<form class="EV_modif_acces_rapport" id="EV_modif_acces_rapport'.$donnees['id_eve'].'">
									'.liste_participant($bdd).'
									<button type="submit" class="EV_acces_btn" name="EV_acces_btn" id="EV_acces_btn'.$donnees['id_eve'].'" onclick="EV_change_acces()">Valider</button>
								</form>*/