<?php 
	include "../modele/modele.php";
	include "../modele/modele3.php";
	include "../modele/modele2.php";


	try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=seinova;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));// ce dernier paramettre permet d'afficher les erreurs SQL
		}
		catch (Exception $e)
		{
		        die('Erreur : ' . $e->getMessage());
		}
	if(isset($_POST['id_user_only'])) //actualisation du nombre de notification
		{	
			echo Get_nbre_notification($_POST['id_user_only'],$bdd);
		}

	if(isset($_POST['size']) and isset($_POST['id_user'])) //actualisation du nombre de notification
		{	
			echo Get_notification($bdd,$_POST['id_user'],$_POST['size']);
		}

	if(isset($_POST['id_notif']) and isset($_POST['id_user'])) //actualisation du nombre de notification
		{	
			$update=$bdd->prepare('UPDATE notification_has_user SET Statut="lu" WHERE id_recepteur=:id_user and id_notification=:id_notif ');
			$update->bindValue(":id_user",$_POST['id_user'],PDO::PARAM_INT);
			$update->bindValue(":id_notif",$_POST['id_notif'],PDO::PARAM_INT);
			$update->execute();

			echo"notif_lu";
		}

		

 ?>