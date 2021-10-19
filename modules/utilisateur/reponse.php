<script type="text/javascript" src="./assets/js/favoris.js"></script>
<title>Reponse</title>
</head>
<body>

<?php if(!isset($_GET['idLng']) or !is_numeric($_GET['idLng']))
		{
			header("location:index.php?module=utilisateur&action=Forum.php");
			exit();
		}
		elseif (!isset($_GET['idSujet']) or !is_numeric($_GET['idSujet']))
		 {
			
			header("location:index.php?module=utilisateur&action=sujet.php&idLng=".$_GET['idLng']);
			exit();
		}
		if (isset($_GET['rapport'])) {
			echo'<script type="text/javascript"> alert("Reponse publiée");</script>';
		}?>
	<?= $content ?>
		<div class="M_wrapper-menu ">
		 	<?php include  "include/menu.php" ?>
		</div>
		<div class="fo_all_container">
			
				<div class="fo_chemin">
					<?php echo Show_lien_sujet($bdd,$_GET['idLng'],$_GET['idSujet']); ?>
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
				
				


				<!--<div class="fo_rep_titre_sujet">
						En choisissant le code tu choisi de rénoncer...<br/>
						<span> HTML/CSS</span>
					</div>

				<div class="fo_rep_sujet">
					<div class="fo_rep_bloc_countainer">
						<div class="fo_rep_info_user">
							<span> Prenom</span>
								<p>
									<img  class="fo_rep_img" src="wede"/>
								</p>
						</div>

						<div class="fo_rep_contenu">
							Sujet créé 
							<span class="fo_rep_date">
								le 11 jan 2021 à 18H
							</span>
							<div>
								Bon bas c'est juste un test de contenu...
							</div>
						</div>
					</div>

				</div>-->

				<?php  afficher_reponse($bdd,$_GET['idSujet'],$_SESSION['idUser'])?>;








		<button id="fo_add_reponse">Repondre</button>
		<form class="fo_form_reponse" method="POST" action= "modules/utilisateur/fo_traitement.php">
			<input type="text" hidden name="id_user" value= <?php  echo $_SESSION['idUser'];?> />

			<input type="text" hidden name="idLng" value= <?php echo $_GET['idLng'];?> />
			<input type="text" hidden name="idSujet" value= <?php echo $_GET['idSujet'];?> />
			<label for="fo_contenu_sujet" >Réponse</label><br/> <textarea name="Contenu_reponse" id="" /></textarea> <br/> <br/>
			<div id="fo_send_box2">
				<button id="fo_send_bt2" type="submit"> Répondre</button>
				<button id="fo_reset_bt2" type="reset"> Annuler</button>
			</div>
		</form>

	</div>


<script type="text/javascript">
	$('#fo_send_bt2,#fo_reset_bt2,#fo_add_reponse').mousedown(function()
		{
			 $(this).css({
			 	boxShadow: '2px 2px 2px 2px rgb(84, 138, 167)',
			 	border:'none',
			 });

		});
		
		$('#fo_send_bt2,#fo_reset_bt2').mouseup(function()
		{
			 $(this).css({
			 	boxShadow: 'none',
			 	border:'1px solid black',
			 	outline:'none'
			 });
		});
		$('#fo_add_reponse').mouseup(function()
		{
			 $(this).css({
			 	boxShadow: '2px 2px 2px 2px #a5a1a1',
			 });
		});


	$('#fo_add_reponse').click(function(){
		$('.fo_form_reponse').show();
		$('.fo_form_reponse textarea').focus();
	});

	$('#fo_reset_bt2').click(function(){

		$('.fo_form_reponse').hide();
		document.location.href="#fo_btsearch";
	});

	$('#fo_send_bt2').click(function(e)
	{
		if($('.fo_form_reponse textarea').val()=='')
		{
			e.preventDefault();
			alert('Vous ne pouvez envoyer de réponse vide...')
		}
	});



</script>