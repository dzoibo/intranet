
	<script type="text/javascript" src="./assets/js/favoris.js"></script>
<title>Intervention</title>
</head>
<body>
	<?= $content ?>
	<div class="M_wrapper-menu ">
	 	<?php include  "include/menu.php";
	 	if (isset($_GET['rapport'])) 
		{
			echo'<script type="text/javascript"> alert("Sujet crée");</script>';
		} ?>
	</div>
	  <div class="fo_all_container">
		<div class="fo_chemin">
			<strong><a href="index.php?module=utilisateur&action=forum">Forum ></a></strong>Mes interventions
		</div>
		<div class="fo_bar">

			<div class ="fo_liste">
				<a class=" fo_li_liste" href="index.php?module=utilisateur&action=forum" > Liste des forums </a> 
				<a class="fo_li_liste_s" href=""> Mes interventions</a>
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
		<div id="fo_filtre_intervention">
			<label for="fo_checkbox">Afficher uniquement les sujets que j'ai crée </label>
			<input type="checkbox" id="fo_checkbox" >
		</div>
		<?php interventions($_SESSION['idUser'],$bdd)  ?>
		<button id="fo_add_sujet">Créer un sujet</button>
		<form class="fo_form_sujet" method="POST" action= "modules/utilisateur/fo_traitement.php">
				
				<label for="fo_titre_sujet" >Titre Sujet</label><br/><input type="text" name="titre" id="fo_titre_sujet" required="" /><br/> <br/>
				<select name="idLng"> 
					<?php get_langage($bdd);  ?>
				</select><br/>
				
				<input type="text" hidden name="id_user" value= <?php  echo $_SESSION['idUser'];// c'est ici qu'on recuperera la variable de session plutard...?> />
				<label for="fo_contenu_sujet" >Contenu</label><br/> <textarea name="Contenu" id="" required="fo_contenu_sujet" /></textarea> <br/> <br/>
				<div id="fo_send_box">
					<button id="fo_send_bt" type="submit"> Envoyer</button>
					<button id="fo_reset_bt" type="reset"> Annuler</button>
				</div>

		</form>
	  </div>