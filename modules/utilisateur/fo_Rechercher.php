	<title>Recherche</title>
</head>
<body>
	<?= $content ?>
	<div class="M_wrapper-menu ">
	 	<?php include  "include/menu.php" ?>
	</div>
   <div class="fo_all_container" >
	<div class="fo_chemin">
		<strong><a href="index.php?module=utilisateur&action=forum">Forum ></a></strong>Rechercher	</div>
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


		<?php
		 if(isset($_POST['search']))
		{
			afficher_recherche($bdd,$_POST['search'], $_SESSION['idUser']);  
		}
		else
		{
			echo'<script >document.location.href = "index.php?module=utilisateur&action=forum"; </script>';
		}
		?>
	
  </div>
</body>
</html>