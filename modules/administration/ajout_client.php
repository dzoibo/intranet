<?php 
if(!empty($_POST['nom_entreprise'])&&!empty($_POST['nom_client'])&&!empty($_POST['adresse_client']) && !empty($_POST['langue_client'])){
    $req=add_client();
    echo "<script>
                   window.location = 'index.php?module=administration&action=liste client';
              </script>";
}

 ?>
 <body>
  <?= $content ?>
<div class="container-general container-projet">
	<div class="M_wrapper-menu ">
	 <?php include  "include/menu.php" ?>
	</div>
	<div class="container-content container-contenu">
		<div class="AC_container1-global">
			<div class="AC_container1-form">
				<div class="AC_container1-form-box1">
					<form method="post" action="" id="AC_form">

						<input type="text" name="nom_client" class="AC_name tail_input-np" required="">
						<label class="placeholder">Nom et Prenom</label>
						<input type="mail" name="adresse_client" class="AC_mail tail_input-np" required="">
						<label class="placeholder1">E-mail du client ou de l'entreprise</label>
						<input type="mail" name="nom_entreprise" class="AC_entreprise tail_input" required="">
						<label class="placeholder2">Nom de l'entreprise</label>
						<input type="mail" name="tel_client" class="AC_tel tail_input" placeholder="Numero de Telephone">
						<input type="mail" name="loc_client" class="AC_loc tail_input" placeholder="localisation">
						<select name="langue_client" class="AC_langue tail_input">
							<option value="Français">Français</option>	
							<option value="Anglais">Anglais</option>
						</select>
						<div class="AC_form_form_box1">
						En cliquant sur <strong>Demarrer maintenant</strong> vous Acceptez qu'on vous accompagne pour la realisation de votre projet	
						</div>
						<input type="submit" name="submit" class="AC_btn-client" value="Demarrer Maintenant">
					</form>
				</div>
				<div class="AC_container1-form-box2">
					<div class="p-AC_form_info">
						Le travail bien fait ne déçoit jamais.
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>