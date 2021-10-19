       <?php if(!isset($_SESSION['idUser']))
       {

		    echo "<script>
		                   window.location = 'modules/connexion.php';
		              </script>"; 

	 } ?>   
       <!DOCTYPE html>
       <html>
       <head>
	       	<meta name="viewport" content="width-device-width, initial-scale=1.0">
	        <link rel="stylesheet" type="text/css" href="./assets/CSS/all.css">
	        <link rel="stylesheet" type="text/css" href="./assets/CSS/mobile.css">
	        <link rel="stylesheet" type="text/css" href="./assets/CSS/tablette.css">
	        <link rel="stylesheet" type="text/css" href="./assets/CSS/tablette2.css">
		    <link rel="stylesheet" type="text/css" href="./assets/CSS/main.css">
			<link rel="stylesheet" type="text/css" href="./assets/fontawesome-free-5.15.1-web/css/all.css">
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
			<link href="https://fonts.googleapis.com/css?family=Oswald:400,500,700%7CRoboto:400,500%7CRoboto:400,500&display=swap"
			      rel="stylesheet">
			<script type="text/javascript" src="./assets/js/jquery-3.5.1.min.js"></script>
			<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
			<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="./assets/js/Chart.min.js"></script>
			<script type="text/javascript" src="./assets/js/ajouterquest.js"></script>
			<script type="text/javascript" src="./assets/js/main.js"></script>
			<script type="text/javascript" src="./assets/js/menu.js"></script>
			<script type="text/javascript" src="./assets/js/utils.js"></script>
			<script type="text/javascript" src="./assets/js/evenement2.js"></script>
			<script type="text/javascript" src="./assets/js/notification.js"></script>


<?php ob_start(); // tout ce qui suit sera récupéré et affiché ailleurs plutard?>
<header>
	<input type="text" hidden id="H_id_input" value= <?php  echo $_SESSION['idUser'];?> />
	<nav class="H_navbar" >
		<img src="./assets/Images/LOGO-1.png">
	<div class="H_right">
		<div class="H_icone1 icone-menu">
			<a href="index.php?module=utilisateur&action=message" title="Messages">
				<div id ="H_nbre_msg"><?php GET_nbre_converse($_SESSION['idUser'],$bdd) ?></div>
				<i class="fa fa-envelope"></i>
			</a>
		</div>
		<div class="H_icone2 icone-menu">
			<a  title="Notification">
				<div id ="H_nbre_notif"><?php echo Get_nbre_notification($_SESSION['idUser'],$bdd) ?></div>
				<i class="far fa-bell"></i> 
			</a>
		</div>
		<div class="H_icone3 icone-menu">
			<a href="https://www.google.com/" title="Se connecter à internet">
				<i class="fab fa-firefox-browser"></i>
			</a>
		</div>
			
		<div class="H_icone4 icone-menu M_deconnecter">
			<a href="index.php?module=utilisateur&action=deconnexion" title="Deconnexion">
			<i class="fa fa-power-off"></i>
			</a>
		</div>
	</div>	
	</nav>	
</header>
<div class="H_notification">
			<div id="H_notif_titre">
				<strong>Notifications</strong> 
			</div>
			<div id="H_Me_box1_close" onclick="show_notif()">
					<i class="fas fa-times"></i>
			</div>
			<div class="H_notification_type_container">
				<?php  Get_notification($bdd,$_SESSION['idUser'],1);?>
				
			</div>

			<div id="H_notif_plus">
				<a href="index.php?module=utilisateur&action=notification">
					Afficher Tout
				</a>
			</div>
	</div>
	<div id="H_Me_body">
		
	</div>	
<?php $content = ob_get_clean(); ?>

<script type="text/javascript">

		$(document).ready(function(){
			$('.H_icone2').click(function()
			{
				$('.H_notification').show();
				$('#H_Me_body').show();
			});
			
		});	
		
		function show_notif()
		{
				$('.H_notification').hide();
				$('#H_Me_body').hide();
		}

		 setInterval(function()// c'est avec ce script que nous allons actualiser le nombre de message
		{ 
			$.post(
			{
					url:'traitement ajax/accueil_msg.php',// on va décider de l'adresse et importer la fonction la bas puis verifier avec isset et l'exécuter.
					data:{ id_user_nbre_msg:$('#H_id_input').val()},
					success:function(data)
						{
							$('#H_nbre_msg').html(data);
							console.log("nbre_msg");
						},
					error : function(resultat, statut, erreur)
						{
							console.log('echec nbre_msg');
		       			}

				}); 
		}, 500);
	</script>















