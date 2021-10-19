<script type="text/javascript" src="./assets/js/message.js"></script>
<title>Messsage</title>
</head>
<body>
	<?= $content ?>
		<div class="M_wrapper-menu ">
		 	<?php include  "include/menu.php" ;
		 	?>
		</div>
			
		<div class="ME_box">
			<?php 
						if (!isset($_GET['id_contact']) or !is_numeric($_GET['id_contact']))
						{
							echo "<script>
						    	    window.location = 'index.php?module=utilisateur&action=Accueil_msg';
						          </script>"; 
							exit();
						}
						
				  ?>


		</div>
		
	<div class="ME_bllock2 Me_Me_box1">	
			<div class="ME_box1 ">
				<div class="ME_box1a">
					<input type="text" name="search" class="ME_search" placeholder="Chercher...">
					<span>
						<i class="fa fa-search" aria-hidden="true">
							
						</i>
					</span>
				</div>
				<div class="ME_result" style="display: none"></div>
				<div class="ME_box1ba">
					<?php  Me_afficher_contact($bdd,$_SESSION['idUser'])?>
				</div>
				
			</div>

			<div class="ME_box2">
								<div class="ME_id_contact">
									<?php  Me_afficher_Recepteur($_GET['id_contact'],$bdd); ?>
									
								</div>
				<div class="ME_box21">
					
					<?php Me_afficher_message($bdd,$_SESSION['idUser'],$_GET['id_contact']) ;?>
					<div id="ME_repere"></div>
				</div>
				<div class="Me_info_file">
				<?php
					if (isset($msg_erreur2) and empty($msg_erreur2)) {
						foreach($msg_erreur2 as $element)
							{
							    echo $element . '<br />'; 
							}//ici on affiche les erreurs de messages ou de telechargement de la page de traitement
					}
					if (isset($Error_tlg2) and empty($Error_tlg2)) {
						foreach($Error_tlg2 as $element)
							{
							    echo $element . '<br />'; 
							}
					}
					if (isset($Error_tlg) and empty($Error_tlg)) {
						foreach($Error_tlg as $element)
							{
							    echo $element . '<br />'; 
							}
					}
					if (isset($msg_erreur) and empty($msg_erreur)) {
						foreach($msg_erreur as $element)
							{
							    echo $element . '<br />'; 
							}
					}
				  ?>
					 	
				</div>
				
				<div class="ME_box3">
					
					<form action="msg_traiteur.php" id="form" method="post" enctype="multipart/form-data">
						<div class="ME_box3a">
							<label for="Me_file1" title="Joindre un fichier">
								<i class="fa fa-file-import"></i>

								<input  type="file" name="file1[]" class="Me_file" onchange="update('#Me_file1')" accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,video/*,audio/*" id="Me_file1" multiple  />
							</label>

							<label for="Me_file2" title="Joindre une image">
								<i class="fa fa-camera"></i>
								<input onchange="update('#Me_file2')" type="file" name="file2[]" class="Me_file" id="Me_file2" accept="image/png,image/jpeg,image/tiff,image/svg,image/ico,image/pjp,image/gif"  multiple />
							</label>
							
						</div>
						<div class="ME_box3b">
							<textarea placeholder="Entrer votre message" class="ME_msg" name="ME_msg" maxlength="1000"></textarea>
							<input type="submit" onClick="envoyer()" name="submit" id="submit2" class=" Me_submit2" value="Envoyer" >
						</div>
						<input type="number" name="idRec" id="idRec" hidden value=<?php echo "".$_GET['id_contact'].""; ?>>
						<input type="hidden" id="ME_id_input" name="idEx" value=<?php echo $_SESSION['idUser']; ?>>
					</form>
				</div>
			</div>
		</div>
		

