<script type="text/javascript" src="./assets/js/evenement.js"></script>
<title>Ajouter_evenement</title>
</head>
<body>
	<?= $content ?>
		<div class="M_wrapper-menu ">
		 	<?php include  "include/menu.php" ;
		 	?>
		</div>
			<?php
					if(isset($_POST['type_eve'])and isset($_POST['theme'])and isset($_POST['EV_text'])and isset($_POST['EV_heure'])and isset($_POST['EV_date']) and isset($_POST['idUtilisateur']))//ici $_POST['idUtilisateur'] est un tableau qui contient tout les checkbox de name ="idUtilisateur[]"
					{
						
						if(empty($_POST['type_eve']) or empty($_POST['theme']) or empty($_POST['EV_text'])or empty($_POST['EV_heure']) or empty($_POST['EV_date']) or empty($_POST['idUtilisateur']))
						{
							echo "<script>alert(' veuillez remplir tout les champs');</script>";	
						}
												
						else
						{
												$type=$_POST['type_eve'];
												$theme=$_POST['theme'];
												$description=$_POST['EV_text'];
												$heure=$_POST['EV_heure'];
												$date=$_POST['EV_date'];
												$formated_date = implode('-',array_reverse  (explode('/',$date)));
												$date_final = $formated_date." ".$heure.":00";
												
									$insert='INSERT INTO evenements(theme,type,description,date_eve,idCreateur) VALUES(?,?,?,?,?)';			
									$req=$bdd->prepare($insert);
									$req->execute(array($theme,$type,$description,$date_final,$_SESSION['idUser']));




									//on récupére l'id de la derniére insertion dans la table événement pour ajouter les participants dans l'autre table.
									$id_recup=$bdd->query('SELECT id_eve From evenements ORDER BY id_eve DESc limit 1 ');
									
									 $id_final= $id_recup->fetch();
									
									
									foreach ($_POST['idUtilisateur'] as  $value)
												{
													$prepare_user='INSERT INTO participation (id_eve,id_utilisateur) VALUES(?,?)';
													try
													{
														$add_user=$bdd->prepare($prepare_user);
														$add_user->execute(array($id_final['id_eve'], $value));

													}
													catch (Exception $e) 
													{
												   		//s'il y a un problème PHP ou SQL, tout s'affichera ici
												   		print "Erreur ! " . $e->getMessage() . "<br/>";
													}
												}
								
										 $nb_insert = $req->rowCount();		
										 



									//place aux notifications
									$new_notif=$bdd->prepare('INSERT INTO notification (typeNotification,dateNotification,contenuNotification,id_auteur,id_content) values ("evenement",:dateNotif," a crée évenement auquel vous etes participant
														",:idauteur,:id_content)');
									$new_notif->bindValue(":dateNotif",date('Y-m-d H:i:s'),PDO::PARAM_STR);
									$new_notif->bindValue(":idauteur",$_SESSION['idUser'],PDO::PARAM_INT);
									$new_notif->bindValue(":id_content", $id_final['id_eve'],PDO::PARAM_INT);
									$new_notif->execute();

									$last_notif=$bdd->query('SELECT MAX(idNotification) as idNotification FROM notification');
									$last_notif=$last_notif->fetch();


									$reccuperation=$bdd->query('SELECT id_utilisateur FROM participation where id_eve='.$id_final['id_eve']);// on reccupére tout les particpants pour inserer la notification dans la table notification_has_user 

												while ($id_participant=$reccuperation->fetch())//on place tout dans un tableau...
												{

													$value=$id_participant['id_utilisateur'];
													
												
													if($value==$_SESSION['idUser'])
														{
															continue;
														}

													$notif_has_user = $bdd->prepare('INSERT INTO notification_has_user(id_recepteur, id_notification, Statut) VALUES (:idrecep,:idnotif ,"non_lu")');
								            		 					$notif_has_user->bindValue(":idrecep", $value,PDO::PARAM_INT);
								            		 					$notif_has_user->bindValue(":idnotif",$last_notif['idNotification'],PDO::PARAM_INT);
								           								$notif_has_user->execute();

												}


												// c'est terminé on redirige tout 
										 if(($nb_insert!=0))
										 {
										 	echo "<script>
										 				alert('evenement crée ');
										 				document.location.href='index.php?module=utilisateur&action=evenement'
										 		  </script>";
											$newid=$id_final['id_eve'];
										 }	
						}
					}	
					elseif(isset($_POST['type_eve']) or isset($_POST['theme']) or isset($_POST['EV_text']) or isset($_POST['EV_heure']) or isset($_POST['EV_date']) or isset($_POST['idUtilisateur']))
					{
						echo "<script>alert(' veuillez remplir tout les champs');</script>";
						

					}	



					
			?> 
		<div class="ME_block2">
			<div class="AE_container">
				<div class="AE_box">
					<div class="AE_boxa AE_sbox ">
						<ul>
							<li><a href="index.php?module=utilisateur&action=evenement"><b>Listes des Evenements</b></a></li>
						</ul>
					</div>
					<div class="AE_boxb AE_sbox AE_boxS">
						<ul>
							<li><a href=""><b>Ajouter un Evenement</b></a></li>
						</ul>
					</div>
				</div>
				<div class="AE_box1">
					<h3>Entrez des informations liées à votre evenement</h3>
					<br>
					<form  method="POST" action="">
						
						<div class="AE_lbl0" class="AE_lbl0">
							<label  for="AE_theme">Theme de l'evenement:</label>
						</div>
							<input type="text" required name="theme" id="AE_theme" value="<?=$_POST['theme'] ?? ''?>" class="AE_theme" >
						<br>
						<br>
						<div class="AE_lbl0">
								<label  for="type_eve">Type de l'evenement :</label>
						</div>
						<input type="text" required name="type_eve" id="type_eve" value="<?=$_POST['type_eve'] ?? ''?>" class="type_eve" ><!-- la valeur entre value c'est pour conserver les données qui etaient dans le formulaire lorsque le formulaire se recharge-->
						<br>
						<br>
						<div class="AE_lbl0">
							<label  for="EV_text" class="EV_area">Description de l'evenement:</label>
						</div>
							<textarea required placeholder="Rediger..." name="EV_text" value="" id="EV_text" class="EV_text"><?=$_POST['EV_text'] ?? ''?></textarea>
						<br>
						<br>
						<div class="AE_temps">
							<label for="temps"> heure : </label>
							<input required type="time" value="<?=$_POST['EV_heure'] ?? ''?>" name="EV_heure">
						</div>
							<label for="date">date : </label>
							<input id="AE_date" type="date" required value="<?=$_POST['EV_date'] ?? ''?>" name="EV_date">
							<input type="hidden" id="EV_id_input_user" name="idUser" value=<?php echo $_SESSION['idUser']; ?>>
						<br>
						<br>
						<div class="AE_box2">
							<h3>Ajouter des participants </h3>
							<div class="AE_box2a">
								<?php liste_participant($bdd)?>
							</div>
						</div>
						<br>
						
						<div id="AE_div_bt">
							<button type="submit" class="EV_btn" name="EV_btn">Créer</button><!--creer un alert à ce niveau apres la derniere verfication si tous est okay-->
						</div>
					</form>		
				</div>
			</div>
		</div>
		
