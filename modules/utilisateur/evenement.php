<script type="text/javascript" src="./assets/js/evenement.js"></script>
<title>Evenement</title>
</head>
<body>
	<?= $content ?>
		<div class="M_wrapper-menu ">
		 	<?php include  "include/menu.php" ;
		 		  if (isset($_GET['id_eve_calandar']))
		 		  {
		 		  	echo '<script>document.location.href="#'.$_GET['id_eve_calandar'].'"</script>';
		 		  }
		 		  if (isset($_GET['id_eve']))
		 		  {
		 		  	echo '<script>document.location.href="#EV_block1_'.$_GET['id_eve'].'"</script>';
		 		  }
		 		  if (isset($_GET['id_eve_rapport'])) 
		 		  {
					 echo '<script type="text/javascript">
					 $(document ).ready(function()
					 {
					 	$("#EV_archive").trigger("mouseup");
					 });
 
					 		  				
		 		  				document.location.href="#EV_block1_'.$_GET['id_eve_rapport'].'"
		 		  		  </script>';
		 		  }

		 	?>
		</div>
		<div class="ME_block2">
			<div class="EV_content">	
				<div class="AE_box">
						<div class="AE_boxa AE_sbox AE_boxS">
							<ul>
								<li><a href=""><b>Listes des Evenements</b></a></li>
							</ul>
						</div>
                                    
						<div class="AE_boxb AE_sbox ">
							<ul>
								<li> <?php  if(user_level($bdd,$_SESSION['idUser']))
											{
												echo '<a href="index.php?module=administration&action=ajouteven"><b>Ajouter un Evenement</b></a>';
											}
									 ?>
								</li>
							</ul>
						</div>
					</div>
		    </div>

		    <div id="EV_nav_bar">
			    <div id="EV_nav_bar1">
			    	<div  id="EV_mois">
			    	 	<a href="#" >
			    	 		<i class="far fa-calendar"></i> Ce mois
			    	 	</a>
			    	</div>
			    	<div  id="EV_all" >
			    	 	<a href="#" >
			    	 		<i class="fas fa-list-alt"></i> Tout
			    	 	</a>
			    	</div>
			    	<div  id="EV_archive">
			    	 	<a href="#" >
			    	 		<i class="fas fa-archive"> </i>    Archives
			    	 	</a>
			    	</div>    	 
			    </div>
			    <div id="EV_search_box">
			   		 <input type="text" name="search" class="EV_search" placeholder="Chercher evenement...">
			   		 <input type="text" hidden name="id_auteur_delete" id="EV_id_auteur_delete" value= <?php echo $_SESSION['idUser'];  ?>>
			   		 <i class="fa fa-search" aria-hidden="true"></i>
			   	</div>
			</div>   
		    <div class="EV_afficher">
		    	<h2 class="ev_modifier_title"> <i class="fas fa-thumbtack">
		    		</i>Evenememts
		    	</h2>
		    	 <?php afficher_evenements($bdd,'simple',$_SESSION['idUser'])?>
		    </div>
		    <div class="EV_afficher3"></div>
		    <div class="EV_afficher1"> 
		    	<?php afficher_evenements($bdd,'pass',$_SESSION['idUser'])?>
		    </div>
		    <div class="EV_afficher2">
		    	<?php  afficher_evenements ($bdd,'mois',$_SESSION['idUser']) ?>	
		    </div>	
		    
		</div>		
				
