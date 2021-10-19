
 <body>
  <?= $content ?>
<div class="container-general container-projet">
	<div class="M_wrapper-menu ">
	 <?php include  "include/menu.php" ?>
	</div>
	<div class="container-content container-contenu">
		<div class="AC_container1-global">
			<?php
			if(isset($_POST['nom_client'])  && isset($_POST['adresse_client']) && isset($_POST['nom_entreprise']) && isset($_POST['tel_client']) && isset($_POST['loc_client']) && isset($_POST['langue_client'])){
			    if(!empty($_POST['nom_client']) && !empty($_POST['nom_entreprise']) && !empty($_POST['adresse_client']) && !empty($_POST['tel_client']) && !empty($_POST['loc_client']) && !empty($_POST['langue_client'])){

			          $resultat = edit_client($_POST['nom_client'],$_POST['adresse_client'],$_POST['nom_entreprise'],$_POST['tel_client'],$_POST['loc_client'],$_POST['langue_client'],$_GET['id']);

			          if($resultat){


			              echo "<script>
			                   window.location = 'index.php?module=administration&action=liste client';
			              </script>"; 
			             
			          }else{
			             echo "Echec de modification";
			          }

			    }else{
			       echo "veuillez remplir tous les champs";
			    }
			  }

			 if(isset($_GET['id'])){
			  $result= get_client_by_id($_GET['id']);
			} 

			 ?>
			<div class="AC_container1-form">
				<div class="AC_container1-form-box1">
					<form method="post" action="" id="AC_form">

						<input type="text" name="nom_client" class="AC_name tail_input-np" value="<?php echo $result['Nom_client']; ?>" required="">
						<input type="mail" name="adresse_client" class="AC_mail tail_input-np" value="<?php echo $result['Adresse']; ?>"  required="">
						<input type="mail" name="nom_entreprise" class="AC_entreprise tail_input" value="<?php echo $result['Entreprise']; ?>"  required="">
						<input type="mail" name="tel_client" class="AC_tel tail_input" required=""  value="<?php echo $result['Telephone']; ?>">
						<input type="mail" name="loc_client" class="AC_loc tail_input" required=""  value="<?php  echo $result['Localisation']; ?>">
						<select name="langue_client" class="AC_langue tail_input" value="" >
							<option value="<?php echo $result['Langue']; ?>">Français</option>	
							<option value="Anglais">Anglais</option>
						</select>
						<div class="AC_form_form_box1">
						En cliquant sur <strong>Modifier maintenant</strong> vous Acceptez qu'on modifie vos informations	
						</div>
						<input type="submit" name="submit" class="AC_btn-client" value="Modifier Maintenant">
					</form>
				</div>
				<div class="AC_container1-form-box2">
					<div class="p-AC_form_info">
						Mettre à jour vos informations
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>