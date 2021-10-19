<?php 
 if(isset($_GET['id'])){
  $result= get_client_by_id($_GET['id']);
}
 if(isset($_GET['id'])){
  $result_projet= get_rencontre_by_idclient_projet($_GET['id']);
}
if(isset($_POST['btn-etape-proparle'])){
if(isset($_POST['id_projet'])){
	$req=update_projet_statut(1,$_POST['id_projet']);
	
}
}
if(isset($_POST['btn-etape-devis'])){
if(isset($_POST['id_projet'])){
	$req=update_projet_statut(2,$_POST['id_projet']);
}
}
if(isset($_POST['btn-etape-gagne'])){
if(isset($_POST['id_projet'])){
	$req=update_projet_statut(3,$_POST['id_projet']);
}
}
if(isset($_POST['btn-etape-annuler'])){
if(isset($_POST['id_projet'])){
	$req=update_projet_statut(4,$_POST['id_projet']);
}
}
$message="";
if(isset($_POST['btn-envoie-projet'])){
if(!empty($_POST['nom_projet'])&&!empty($_POST['somme_client'])){
	$doc=$_FILES['file']['name'];
	$file=$_FILES['file']['tmp_name'];
	 $upload="document/projet/".$doc.$result['Entreprise'];
	 move_uploaded_file($file, $upload);
$req=projet_devis($_POST['nom_projet'],$_POST['somme_client'],$_GET['id'],$doc);
if($req){
	//header('location:index.php?module=administration&action=devis client&id='.$_GET['id']);
}
}
}
if(isset($_POST['btn-envoie-renc'])){
if(!empty($_POST['motif_rencontre']) && !empty($_POST['AC_area'])){
	$doc=$_FILES['file']['name'];
	$file=$_FILES['file']['tmp_name'];
	 $upload="document/projet/".$doc;
	 move_uploaded_file($file, $upload);
	add_rencontre($_GET['id'],$doc);
}  
}

//}
?>
<body>
  <?= $content ?>

<div class="container-general container-projet">
	<div class="M_wrapper-menu ">
	 <?php include  "include/menu.php" ?>
	</div>
	<div class="container-content container-contenu">
		<?php  ?>
		<div class="LC_container1-global">
			<div class="LC_container1-flex">
				<div class="LC_container1-flex-box1 client-new">
					<div class="client_new-box1">
						<div class="client_new-box1a">
						Nouveau
					</div>
					<div class="client_new-box1b " id="icon-ajout-new">
						<i class="fa fa-plus"></i>
					</div>
					</div>
						<div class="client-new-formulaire taille-input">
							<span><?php echo $message; ?></span>
							<form method="post" accept="" action="" enctype="multipart/form-data">
						<input type="text" name="nom_client" class="" value="<?php echo $result['Nom_client'] ?>">
						<input type="text" name="type_marche" class="" value="<?php echo $result['Entreprise'] ?>">
						<input type="text" name="nom_projet" class="motif_rencontre" required="">
						<label class="LC_placeholder2">Projet</label>	
						<input type="text" name="somme_client" class="motif_rencontre" placeholder="150.000 XAF" required="">
						<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
	                   <div class="client-new-formulaire-file">
	                  <span class="LC_file-box1">Importer un Document</span>
	                 <label for="LC_file" class="LC_file-box2">
	 				<i class="fas fa-upload"></i>
	          			<input TYPE = "HIDDEN" NAME = "MAX_FILE_SIZE" VALUE = "20000000">
	 					<input  type="file" name="file" class="LC_file" accept=".doc,.pdf,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf" id="LC_file" />
	 					</label>
	                </div>
	              <button type="submit" name="btn-envoie-projet" >Enregistrer</button>
	 						</form>             
						</div>
					<div class="client-new-affichage">
						<?php $query=get_client_by_porjet_devis($result['idClient']);
							while($resultat=$query->fetch(PDO::FETCH_ASSOC)){

							 ?>
						<div class="client-new-affichage-n taille-input">
							
							<p>Projet: <strong><?php echo $resultat['nom_projet']; ?></strong><br>
							Entreprise: <strong><?php echo $result['Entreprise']; ?></strong><br>
							Montant: <strong><?php echo $resultat['Somme']; ?></strong><br>
							Document:<strong><?php 	if($resultat['document']==""){ ?>
								Pas de document <?php 	}else{ ?>
									<a href="document/projet/<?php 	echo $resultat['document']; ?>"><?php 	echo $resultat['document']; ?></a>
								<?php 	} ?>
							</strong>
						</p>
							<p class="para-aff-new" onclick="afficher_renc(<?php echo $resultat['id']; ?>);" title="Cliquez pour voir les differentes rencontres">Voir les Rencontres</p>
							<div class="para-new-renc-block<?php echo $resultat['id']; ?> para-new-renc-block-2">

							  <?php  
							    $queri = get_rencontre_by_client2($resultat['id']);
							    while($resultat2=$queri->fetch(PDO::FETCH_ASSOC)){
							?>
							<p class="para-new-renc<?php echo $resultat['id']; ?> para-new-rencontre">
							              Heure de la rencontre:   <strong><?php echo $resultat2['Heure_Rencontre']; ?> </strong><br> 
							              Motif de la rencontre:   <strong><?php echo $resultat2['Motif_Rencontre']; ?> </strong> <br>
												Debouche de la rencontre:   <strong><?php echo $resultat2['Debouche_Rencontre']; ?>   </strong><br>
							Document:<strong><?php 	if($resultat2['document']==""){ ?>
								Pas de document <?php 	}else{ ?>
									<a href="document/projet/<?php 	echo $resultat2['document']; ?>"><?php 	echo $resultat2['document']; ?></a>
								<?php 	} ?>
							</strong> 
							                </p>
							              <?php  }?>

							               
							  </div>

							<form method="post" accept="" action="" enctype="multipart/form-data">
						<input type="type" name="motif_rencontre" class="motif_rencontre" required="" >
						<label class="LC_placeholder2">Le motif de la rencontre</label>	
                     <textarea placeholder="une brieve description" name="AC_area" class="AC_area"></textarea>
                     <input type="hidden" name="id_projet" value="<?php echo $resultat['id']; ?>">
                                <!--<span class="LC_file-box1-2">Importer un Document</span>
                               <label for="LC_file" class="LC_file-box3">
               				<i class="fas fa-upload"></i></label>-->

                        			<input TYPE = "HIDDEN" NAME = "MAX_FILE_SIZE" VALUE = "20000000">
               					<input  type="file" name="file" class="LC_file2 taille-file" accept=".doc,.pdf,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf" />
                     <button type="submit" name="btn-envoie-renc" class="TAB_btn">
                         Enregistrer
                     </button>
                 </form>
                 		<form method="post" class="form_etape_projet">
                 			<button type="submit" name="btn-etape-proparle">Aller Sur Proparle</button>
                 			<input type="hidden" name="id_projet" value="<?php echo $resultat['id']; ?>">
                 			<button type="submit"name="btn-etape-annuler" >Annuler le Projet</button>
						</form>
						</div>
						<?php } ?>

						
					</div>
					
				</div>
				<div class="LC_container1-flex-box1 client-proparle">
					<div class="client_new-box1">
						<div class="client_new-box1a">
						Pourparlé
					</div>
					<div class="client_new-box1b">
						<i class="fa fa-plus"></i>
					</div>
					</div>
										<div class="client-new-affichage">
											<?php $query=get_client_by_porjet_devis1($result['idClient']);
												while($resultat=$query->fetch(PDO::FETCH_ASSOC)){
												 ?>
											<div class="client-new-affichage-n taille-input">
												
												<p>Projet: <strong><?php echo $resultat['nom_projet']; ?></strong><br>
												Entreprise: <strong><?php echo $result['Entreprise']; ?></strong><br>
												Montant: <strong><?php echo $resultat['Somme']; ?></strong>
													Document:<strong><?php 	if($resultat['document']==""){ ?>
														Pas de document <?php 	}else{ ?>
															<a href="document/projet/<?php 	echo $resultat['document']; ?>"><?php 	echo $resultat['document']; ?></a>
														<?php 	} ?>
													</strong>
											</p>
												<p class="para-aff-new" onclick="afficher_renc(<?php echo $resultat['id']; ?>);" title="Cliquez pour voir les differentes rencontres">Voir les Rencontres</p>
												<div class="para-new-renc-block<?php echo $resultat['id']; ?> para-new-renc-block-2">

												  <?php  
												    $queri = get_rencontre_by_client2($resultat['id']);
												    while($resultat2=$queri->fetch(PDO::FETCH_ASSOC)){
												?>
												<p class="para-new-renc<?php echo $resultat['id']; ?> para-new-rencontre">
												              Heure de la rencontre:   <strong><?php echo $resultat2['Heure_Rencontre']; ?> </strong><br> 
												              Motif de la rencontre:   <strong><?php echo $resultat2['Motif_Rencontre']; ?> </strong> <br>
												Debouche de la rencontre:   <strong><?php echo $resultat2['Debouche_Rencontre']; ?>   </strong><br>
												Document:<strong><?php 	if($resultat2['document']==""){ ?>
													Pas de document <?php 	}else{ ?>
														<a href="document/projet/<?php 	echo $resultat2['document']; ?>"><?php 	echo $resultat2['document']; ?></a>
													<?php 	} ?>
												</strong>  
												                </p>
												              <?php   } ?>
												 </div>
												<form method="post" accept="" action="" enctype="multipart/form-data">
											<input type="type" name="motif_rencontre" class="motif_rencontre" required="" >
											<label class="LC_placeholder2">Le motif de la rencontre</label>	
					                     <textarea placeholder="une brieve description" name="AC_area" class="AC_area"></textarea>
					                     <input type="hidden" name="id_projet" value="<?php echo $resultat['id']; ?>">
					                                <!--<span class="LC_file-box1-2">Importer un Document</span>
					                               <label for="LC_file" class="LC_file-box3">
					               				<i class="fas fa-upload"></i></label>-->

					                        			<input TYPE = "HIDDEN" NAME = "MAX_FILE_SIZE" VALUE = "20000000">
					               					<input  type="file" name="file" class="LC_file2 taille-file" accept=".doc,.pdf,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf" />
					                     <button type="submit" name="btn-envoie-renc" class="TAB_btn">
					                         Enregistrer
					                     </button>
					                 </form>
					                 		<form method="post" class="form_etape_projet">
					                 			<button type="submit" name="btn-etape-devis">Aller Sur Devis</button>
					                 			<input type="hidden" name="id_projet" value="<?php echo $resultat['id']; ?>">
					                 			<button type="submit"name="btn-etape-annuler" >Annuler le Projet</button>
											</form>
											</div>
											<?php } ?>

											
										</div>
				</div>
				<div class="LC_container1-flex-box1 client-devis">
					<div class="client_new-box1">
						<div class="client_new-box1a">
						Dévis
					</div>
					<div class="client_new-box1b">
						<i class="fa fa-plus"></i>
					</div>
					</div>
										<div class="client-new-affichage">
											<?php $query=get_client_by_porjet_devis2($result['idClient']);
												while($resultat=$query->fetch(PDO::FETCH_ASSOC)){
												 ?>
											<div class="client-new-affichage-n taille-input">
												
												<p>Projet: <strong><?php echo $resultat['nom_projet']; ?></strong><br>
												Entreprise: <strong><?php echo $result['Entreprise']; ?></strong><br>
												Montant: <strong><?php echo $resultat['Somme']; ?></strong>
													Document:<strong><?php 	if($resultat['document']==""){ ?>
														Pas de document <?php 	}else{ ?>
															<a href="document/projet/<?php 	echo $resultat['document']; ?>"><?php 	echo $resultat['document']; ?></a>
														<?php 	} ?>
													</strong>
											</p>
												<p class="para-aff-new" onclick="afficher_renc(<?php echo $resultat['id']; ?>);" title="Cliquez pour voir les differentes rencontres">Voir les Rencontres</p>
												<div class="para-new-renc-block<?php echo $resultat['id']; ?> para-new-renc-block-2">

												  <?php  
												    $queri = get_rencontre_by_client2($resultat['id']);
												    while($resultat2=$queri->fetch(PDO::FETCH_ASSOC)){
												?>
												<p class="para-new-renc<?php echo $resultat['id']; ?> para-new-rencontre">
												              Heure de la rencontre:   <strong><?php echo $resultat2['Heure_Rencontre']; ?> </strong><br> 
												              Motif de la rencontre:   <strong><?php echo $resultat2['Motif_Rencontre']; ?> </strong> <br>
												Debouche de la rencontre:   <strong><?php echo $resultat2['Debouche_Rencontre']; ?>   </strong><br> 
												Document:<strong><?php 	if($resultat2['document']==""){ ?>
													Pas de document <?php 	}else{ ?>
														<a href="document/projet/<?php 	echo $resultat2['document']; ?>"><?php 	echo $resultat2['document']; ?></a>
													<?php 	} ?>
												</strong> 
												                </p>
												              <?php   } ?>
												 </div>
												<form method="post" accept="" action="" enctype="multipart/form-data">
											<input type="type" name="motif_rencontre" class="motif_rencontre" required="" >
											<label class="LC_placeholder2">Le motif de la rencontre</label>	
					                     <textarea placeholder="une brieve description" name="AC_area" class="AC_area"></textarea>
					                     <input type="hidden" name="id_projet" value="<?php echo $resultat['id']; ?>">
					                                <!--<span class="LC_file-box1-2">Importer un Document</span>
					                               <label for="LC_file" class="LC_file-box3">
					               				<i class="fas fa-upload"></i></label>-->

					                        			<input TYPE = "HIDDEN" NAME = "MAX_FILE_SIZE" VALUE = "20000000">
					               					<input  type="file" name="file" class="LC_file2 taille-file" accept=".doc,.pdf,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf" />
					                     <button type="submit" name="btn-envoie-renc" class="TAB_btn">
					                         Enregistrer
					                     </button>
					                 </form>
					                 		<form method="post" class="form_etape_projet">
					                 			
					                 			<input type="hidden" name="id_projet" value="<?php echo $resultat['id']; ?>">
					                 			<button type="" name="btn-etape-gagne">Aller sur Gagné</button>
					                 			<button type="submit"name="btn-etape-annuler" >Annuler le Projet</button>
											</form>
											</div>
											<?php } ?>

											
										</div>
				</div>
				<div class="LC_container1-flex-box1 client-win">
					<div class="client_new-box1">
						<div class="client_new-box1a">
						Gagné
					</div>
					<div class="client_new-box1b">
						<i class="fa fa-plus"></i>
					</div>
					</div>
										<div class="client-new-affichage">
											<?php $query=get_client_by_porjet_devis3($result['idClient']);
												while($resultat=$query->fetch(PDO::FETCH_ASSOC)){
												 ?>
											<div class="client-new-affichage-n taille-input">
												
												<p>Projet: <strong><?php echo $resultat['nom_projet']; ?></strong><br>
												Entreprise: <strong><?php echo $result['Entreprise']; ?></strong><br>
												Montant: <strong><?php echo $resultat['Somme']; ?></strong><br>
													Document:<strong><?php 	if($resultat['document']==""){ ?>
														Pas de document <?php 	}else{ ?>
															<a href="document/projet/<?php 	echo $resultat['document']; ?>"><?php 	echo $resultat['document']; ?></a>
														<?php 	} ?>
													</strong>
											</p>
										<a href="index.php?module=administration&action=projet valide&id=<?php 	echo $_GET['id'] ?>&idprojet=<?php echo $resultat['id'];	 ?>"><button class="btn-valide-projet-client" type="submit" name="btn-etape-gagne">Voir plus</button></a>
											</div>
											<?php } ?>

											
										</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function()
	{
		$('#icon-ajout-new').click();
		icon_show_client=$('#icon-ajout-new');
		box_affichage=$('.client-new-formulaire');
		icon_show_client.click(function()
		{
			box_affichage.toggle('slow');
		});
	});

	function afficher_renc(idprojet){
	$('.para-new-renc-block'+idprojet).toggle(300);
	$('.para-new-renc'+idprojet).toggle(300);

	}
</script>