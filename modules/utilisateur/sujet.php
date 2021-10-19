<script type="text/javascript" src="./assets/js/forum.js"></script>
	<title>Sujet</title>
</head>
<body>
	<?= $content ?>
		<div class="M_wrapper-menu ">
		 	<?php include  "include/menu.php" ?>
		</div>

<?php if(!isset($_GET['idLng']) or !is_numeric($_GET['idLng']))
		{
			header("index.php?module=utilisateur&action=forum");
			exit();
		}
		if (isset($_GET['rapport'])) 
		{
			echo'<script type="text/javascript"> alert("Sujet crée");</script>';
		}

?>
   <div  class="fo_all_container">
	<div class="fo_chemin">
		<?php echo Show_lien_lng($bdd,$_GET['idLng']); ?>
	</div>
	<div class="fo_bar">

		<div class ="fo_liste">
			<a class=" fo_li_liste" href="index.php?module=utilisateur&action=forum" > Liste des forums </a> 
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
	<!--<div id="fo_msg_sous_categorie">
		HTML/CSS
	</div>

	<div class="fo_msg_list">
		<a href="">
		<div class="fo_msg_titre">
			Une erreur grave avec mes div et le tout ....<br/>
			<span class="fo_msg_auteur">Posté par <strong>Arim d'bo</strong> le 24 sep 2020 à 22:2 </span>
		</div>
		</a>

		<div class="fo_msg_nombre_reponses">
			11 réponses
		</div>
		<div class="fo_msg_last_reponse">
			Dernieres reponses par <strong> Franck</strong><br/>
			9 jan 2021  à 17:23
		</div>
	</div>!-->

	<?php afficher_sujet($bdd,$_GET['idLng'], $_SESSION['idUser']);  ?>

	<button id="fo_add_sujet">Créer un sujet</button>
	<form class="fo_form_sujet" method="POST" action= "modules/utilisateur/fo_traitement.php">
			
			<label for="fo_titre_sujet" >Titre Sujet</label><br/><input type="text" name="titre" id="fo_titre_sujet" required="" /><br/> <br/>
			<input type="text" name="idLng" hidden value=<?php echo $_GET['idLng'];?> />
			<input type="text" hidden name="id_user" value= <?php  echo $_SESSION['idUser'];?> />
			<label for="fo_contenu_sujet" >Contenu</label><br/> <textarea name="Contenu" id="" required="fo_contenu_sujet" /></textarea> <br/> <br/>
			<div id="fo_send_box">
				<button id="fo_send_bt" type="submit"> Envoyer</button>
				<button id="fo_reset_bt" type="reset"> Annuler</button>
			</div>

	</form>
  </div>
<script type="text/javascript">
	$('#fo_send_bt,#fo_reset_bt,#fo_add_sujet').mousedown(function()
		{
			 $(this).css({
			 	boxShadow: '2px 2px 2px 2px rgb(84, 138, 167)',
			 	border:'none',
			 });

		});
		
		$('#fo_send_bt,#fo_reset_bt').mouseup(function()
		{
			 $(this).css({
			 	boxShadow: 'none',
			 	border:'1px solid black',
			 	outline:'none'
			 });
		});
		$('#fo_add_sujet').mouseup(function()
		{
			 $(this).css({
			 	boxShadow: '2px 2px 2px 2px #a5a1a1',
			 });
		});

		$('#fo_add_sujet').click(function()
		{
			$('.fo_form_sujet').show();
		 	$('.fo_form_sujet input').focus();
		});
		$('#fo_reset_bt').click(function()
		{
			$('.fo_form_sujet').hide();
		 	document.location.href="#fo_titre_sujet";
		});
</script>