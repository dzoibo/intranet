<script type="text/javascript" src="./assets/js/evenement.js"></script>
<title>Modifier_evenement</title>
</head>
<body>
	<?= $content ?>
		<div class="M_wrapper-menu ">
		 	<?php include  "include/menu.php" ;
		 	?>
		</div>

			<?php 
			if(!isset($_GET['id_eve']) or !is_numeric($_GET['id_eve']))
			{
				echo '<script>document.location.href="index.php?module=utilisateur&action=evenement"</script>';
				exit();	
			}
			?>
			
			<?php




					if(isset($_POST['type_eve']) and isset($_POST['theme'])and isset($_POST['EV_text'])and isset($_POST['EV_heure'])and isset($_POST['EV_date']) and isset($_POST['idUtilisateur']))//ici $_POST['idUtilisateur'] est un tableau qui contient tout les checkbox de name ="idUtilisateur[]"
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
											
								
									$req=$bdd->prepare('UPDATE evenements SET theme=:theme ,type=:type,description=:descr,date_eve=:date_eve,idCreateur=:idCreateur,date_creation=:date_creation WHERE id_eve=:id_eve');

									$req->bindValue(":idCreateur",$_SESSION['idUser'],pdo::PARAM_INT);// en attendant d'avoir les sessions...
									$req->bindValue(":id_eve",$_GET['id_eve'],pdo::PARAM_INT);
									$req->bindValue(":type",$type,pdo::PARAM_STR);
									$req->bindValue(":theme",$theme,pdo::PARAM_STR);
									$req->bindValue(":descr",$description,pdo::PARAM_STR);
									$req->bindValue(":date_eve",$date_final,pdo::PARAM_STR);
									$req->bindValue(":date_creation",date("Y-m-d H:i:s"),pdo::PARAM_STR);
									$req->execute();

									//on récupére l'id de la derniére insertion dans la table événement pour ajouter les participants dans l'autre table.
									$id_recup=$_GET['id_eve'];
									$restart=$bdd->prepare('DELETE FROM `participation` WHERE id_eve=:id_recup');
									$restart->bindValue(':id_recup',$id_recup,pdo::PARAM_INT);
									$restart->execute();
									//place aux notifications
									$new_notif=$bdd->prepare('INSERT INTO notification (typeNotification,dateNotification,contenuNotification,id_auteur,id_content) values ("evenement",:dateNotif," a modifié évenement auquel vous etes participant
														",:idauteur,:id_content)');
									$new_notif->bindValue(":dateNotif",date('Y-m-d H:i:s'),PDO::PARAM_STR);
									$new_notif->bindValue(":idauteur",$_SESSION['idUser'],PDO::PARAM_INT);
									$new_notif->bindValue(":id_content", $id_recup,PDO::PARAM_INT);
									$new_notif->execute();

									$last_notif=$bdd->query('SELECT MAX(idNotification) as idNotification FROM notification');
									$last_notif=$last_notif->fetch();



												
									
									foreach ($_POST['idUtilisateur'] as  $value)
												{
													;
													try
													{
														$add_user=$bdd->prepare('INSERT INTO participation (id_eve,id_utilisateur) VALUES(?,?)');

														$add_user->execute(array($id_recup, $value));

													}
													catch (Exception $e) 
													{
												   		//s'il y a un problème PHP ou SQL, tout s'affichera ici
												   		print "Erreur ! " . $e->getMessage() . "<br/>";
													}
												}
								
										


										 $reccuperation=$bdd->query('SELECT id_utilisateur FROM participation where id_eve='.$_GET['id_eve']);// on reccupére tout pour inserer dans la table notification_has_user 

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

										  $nb_insert = $add_user->rowCount();
										 if(($nb_insert!=0))
										 {
										 	
										 	unset($_POST['type_eve']);
											unset($_POST['EV_date']);
											unset($_POST['theme']);
											unset($_POST['EV_heure']);
											unset($_POST['EV_heure']);//on fait ceci pour supprimer toute les valeurs dans nos variables pour que le formulaire soit réinitialisé...
											echo "<script>alert('évenement modifié')</script>";
											echo '<script>document.location.href="index.php?module=utilisateur&action=evenement"</script>';
																		
										}	
										 else
										 {
										 	echo "<script>alert('".$_GET['id_eve']."erreur de création')</script>";
										 	


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
					<div class="AE_boxb AE_sbox ">
						<ul>
							<li><a href="index.php?module=administration&action=ajouteven"><b>Ajouter un Evenement</b></a></li>
						</ul>
					</div>
				</div>

				<div class="AE_box1">	<h2 class="ev_modifier_title">Modifier évenement</h2>
					<h3>Modifier les données de votre évenement</h3>
					<br>
					<form  method="POST" action="">
						
						<?php  modifier_eve($bdd,$_GET['id_eve'])?>
						
						<div id="AE_div_bt">
							<button type="submit" class="EV_btn" name="EV_btn">Modifier</button><!--creer un alert à ce niveau apres la derniere verfication si tous est okay-->
						</div>
					</form>

						
				</div>
				
				
			</div>
		</div>
	
