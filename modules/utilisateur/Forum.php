 <?php if(isset($_GET['lienCat']))
		{
			echo'<script type="text/javascript"> document.location.href="#'.$_GET['lienCat'].'"; </script>' ;
		}  ?>
 <script type="text/javascript" src="./assets/js/forum.js"></script>
	<title>Forum</title>
</head>
<body>
	<?= $content ?>
		<div class="M_wrapper-menu ">
		 	<?php include  "include/menu.php" ;
		 	
		 	?>
		</div>
   <div class="fo_all_container" >
		<div class="fo_chemin">
			<strong><a href="">Forum ></a></strong>Listes des forums	</div>
		<div class="fo_bar">

			<div class ="fo_liste">
				<a class=" fo_li_liste_s" href="" > Liste des forums </a> 
				<a class="fo_li_liste" href="index.php?module=utilisateur&action=interventions"> Mes interventions</a>
				<a class="fo_li_liste" href="index.php?module=utilisateur&action=favoris"> Sujets favoris</a>
			</div>

			<form method="POST" action="index.php?module=utilisateur&action=fo_Rechercher">
				<div class="fo_search">
					<input type="search" required name="search"   placeholder="Rechercher un sujet..."/>
					<button class ="fo_btsearch">
						<i id="fo_btsearch" class="fa fa-search" aria-hidden="true"></i>
					</button>	
				</div>
			</form>
		</div>

			<div class="fo_Titre">
				Liste des forums
			</div>
			
			<?php afficher_forum($bdd);?>
			<?php if(check_role($bdd,$_SESSION['idUser']))
			echo '<button id="fo_add_s_cat">Créer une sous-categorie</button>';

			 ?>
			
			<form class="fo_form_forum" method="POST" action= "modules/utilisateur/fo_traitement.php">
					
					<label for="fo_titre_s_cat" >Nom sous-categorie</label><br/>
					<input type="text" name="Nom_sous_cat" id="fo_titre_s_cat" required="" /><br/> 
					<label>Categorie</label><br/>
						<button title="Créer une nouvelle categorie" id="fo_plus_cat"><i class="fas fa-plus"></i></button>
						<button title="Annuler" id="fo_annuler_cat"><i class="fas fa-times"></i></button>
					<select name="idCat" id="fo_cat_select"> 
							<?php get_categorie($bdd);  ?>
					</select> <br/>
					
					<div class="fo_new_cat">
						<label for="fo_titre_s_cat" >Nouvelle categorie</label><br/>
						<input type="text"  id="fo_new_cat"> <button id="fo_new_cat_bt">Ajouter</button>
					</div>

					<input type="text" hidden name="id_user" value= <?php  echo $_SESSION['idUser'];?> />
					<label for="fo_contenu_sujet" >Description</label><br/>
				    <textarea name="Description" id="" required="fo_contenu_sujet" /></textarea> <br/> <br/>
					<div id="fo_send_box">
						<button id="fo_send_bt" type="submit"> Envoyer</button>
						<button id="fo_reset_bt" type="reset"> Annuler</button>
					</div>

			</form>
  </div>