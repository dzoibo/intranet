
<nav class="M_wrapper-menu">
	<div class="M_box1">
		<a href="index.php?module=utilisateur&action=profil user&id=<?php echo $_SESSION['idUser']?>" title="Mon profil">
			<div class="M_box1a">
	                    <?php show_user($_SESSION['idUser']); ?>
			</div>
			<div class="M_box1b">
				<strong><?php echo $_SESSION['nom']; ?></strong> 		
				<?php echo $_SESSION['prenom']; ?> 		
			</div>
		</a>
	</div>
	<ul class="M_block1">
		<li class="M_menu">
			<a href="index.php?module=&action=index">
				<i class="fa fa-tachometer-alt">
				</i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard
			</a>
		</li>
		<li class="M_menu">
			<a href="index.php?module=utilisateur&action=Accueil_msg">
				<i class="far fa-comments"></i>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a>
		</li>
		<li class="M_menu">
			<a href="index.php?module=utilisateur&action=notification">
				<i class="far fa-bell"></i>&nbsp;&nbsp;&nbsp;&nbsp;Notifications</a>
		</li>
		<li class="M_menu">
			<a href="index.php?module=utilisateur&action=Forum">
				<i class="fa fa-align-right">
					
				</i>&nbsp;&nbsp;&nbsp;&nbsp;Forum
			</a>
		</li>
		<li class="M_menu">
			<a href="index.php?module=utilisateur&action=contact">
				<i class="far fa-address-card">
					
				</i>&nbsp;&nbsp;&nbsp;&nbsp;Contact
			</a>
		</li>
	
		
		<?php if(!empty($_SESSION['Role']) && $_SESSION['Role'] ==2  )
		{ ?>
		<li class="M_menu">
			<a href="#"><i class="fas fa-people-arrows"></i>&nbsp;&nbsp;&nbsp;&nbsp;Clients</a>
		</li>
		<ul class="M_menu1a">
			<li>
				<a href="index.php?module=administration&action=liste client">
					Listes des clients
				</a>
			</li>
			<li>
				<a href="index.php?module=administration&action=ajout_client">
					Ajouter un client
				</a>
			</li>
		</ul>
		<?php  
		}else
		{?>
		<li class="M_menu">
			<a href="index.php?module=administration&action=liste client"><i class="fas fa-people-arrows"></i>&nbsp;&nbsp;&nbsp;&nbsp;Clients</a>
		</li>	
		<?php }?>
		
		<li class="M_menu">
			<a href="index.php?module=utilisateur&action=evenement">
				<i class="far fa-calendar-alt">
					
				</i>&nbsp;&nbsp;&nbsp;&nbsp;Evènements
			</a>
		</li>
		<li class="M_menu">
			<a href="index.php?module=utilisateur&action=projet_accueil">
				<i class="fa fa-project-diagram">
					
				</i>&nbsp;&nbsp;&nbsp;&nbsp;Projets
			</a>
		</li>
			<?php if(!empty($_SESSION['Role']) && $_SESSION['Role'] ==2  ){ ?>

		<li class="M_menu">
			<a href="#">
<i class="fa fa-lock-open-alt"></i>
					
				&nbsp;&nbsp;&nbsp;&nbsp;Gestions des comptes
			</a>
		</li>
		
       
		<ul class="M_menu1a">
			<li>
				<a href="index.php?module=administration&action=liste user">
				Liste des utilisateurs
				</a>
			</li>
			<li>
				<a href="index.php?module=administration&action=historique connexion user">
				Historique de connexion
				</a>
			</li>
			</ul>	
		<?php } ?>
		<li class="M_menu">
			<a href="index.php?module=utilisateur&action=deconnexion" id="M_deconnecter">
				<i class="fa fa-power-off">
					
				</i>&nbsp;&nbsp;&nbsp;&nbsp;Se deconnecter
			</a>
		</li>
		
	</ul>
</nav>

