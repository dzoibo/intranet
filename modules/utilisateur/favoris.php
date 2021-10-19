<script type="text/javascript" src="./assets/js/favoris.js"></script>
<title>Favoris</title>
</head>
<body>
	<?= $content ?>
	<div class="M_wrapper-menu ">
	 	<?php include  "include/menu.php" ?>
	</div>
	  <div class="fo_all_container">
		<div class="fo_chemin">
			<strong><a href="index.php?module=utilisateur&action=forum">Forum ></a></strong>Sujets favoris
		</div>
		<div class="fo_bar">

			<div class ="fo_liste">
				<a class=" fo_li_liste" href="index.php?module=utilisateur&action=forum" > Liste des forums </a> 
				<a class="fo_li_liste" href="index.php?module=utilisateur&action=interventions"> Mes interventions</a>
				<a class="fo_li_liste_s" href=""> Sujets favoris</a>
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
			Sujets Favoris
		</div>
		<?php afficher_favoris($bdd,$_SESSION['idUser'])  ?>
		<button id="fo_add_sujet">Créer un sujet</button>
		<form class="fo_form_sujet" method="POST" action= "modules/utilisateur/fo_traitement.php">
				
				<label for="fo_titre_sujet" >Titre Sujet</label><br/><input type="text" name="titre" id="fo_titre_sujet" required="" /><br/> <br/>
				<select name="idLng"> 
					<?php get_langage($bdd);  ?>
				</select><br/>
				
				<input type="text" hidden name="id_user" value= <?php  echo $_SESSION['idUser'];?> />
				<label for="fo_contenu_sujet" >Contenu</label><br/> <textarea name="Contenu" id="" required="fo_contenu_sujet" /></textarea> <br/> <br/>
				<div id="fo_send_box">
					<button id="fo_send_bt" type="submit"> Envoyer</button>
					<button id="fo_reset_bt" type="reset"> Annuler</button>
				</div>

		</form>
	</div>
</body>
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
		$('#fo_checkbox').click(function(){

			if($('.fo_msg_list_rep').is(':visible'))
			{
				$('.fo_msg_list_rep').toggle(false);			
			}
			else
			{
				$('.fo_msg_list_rep').toggle(true);
			}
		});
</script>
</html>