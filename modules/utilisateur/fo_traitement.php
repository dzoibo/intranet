<?php 

include"../../modele/modele2.php";
try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=seinova;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));// ce dernier paramettre permet d'afficher les erreurs SQL
		}
		catch (Exception $e)
		{
		        die('Erreur : ' . $e->getMessage());
		}
 $date= date("Y-m-d H:i:s"); 
	if(isset($_POST['titre']) and isset($_POST['Contenu']) )
	{
		$sujet=$bdd->prepare('INSERT INTO sujet( `titre`, `contenu`, `id_auteur`, `date_sujet`, `id_lng`) VALUES(:titre,:contenu,:id_auteur,:date_sujet,:id_lng)');

		$sujet->bindValue(":titre",$_POST['titre'],PDO::PARAM_STR );
		$sujet->bindValue(":contenu",$_POST['Contenu'],PDO::PARAM_STR);
		$sujet->bindValue(":id_lng",$_POST['idLng'],PDO::PARAM_INT);
		$sujet->bindValue(":date_sujet",$date ,PDO::PARAM_STR);
		$sujet->bindValue(":id_auteur",$_POST['id_user'],PDO::PARAM_INT);
		$sujet->execute();

		$last_sujet= $bdd->query('SELECT MAX(id_sujet) as id_sujet from sujet');
		$last_sujet=$last_sujet->fetch();
		notif_forum($bdd,$_POST['id_user'],"a posté un nouveau sujet","sujet",$last_sujet['id_sujet']);

		echo $sujet->rowCount();
		$sujet->closecursor();
		header('location:../../index.php?module=utilisateur&action=sujet&rapport=ok&idLng='.$_POST['idLng']);
		exit();
	}

	if(isset($_POST['Contenu_reponse']) and isset($_POST['idSujet']) )
	{
		 $date= date("Y-m-d H:i:s");
		$reponse=$bdd->prepare('INSERT into reponses (Contenu_reponse,id_auteur,date_reponse,id_sujet) VALUES (:contenu,:id_auteur,:date_reponse,:id_sujet)');
		$reponse->bindValue(":contenu",$_POST['Contenu_reponse'],PDO::PARAM_STR);
		$reponse->bindValue(":date_reponse", $date=date("Y-m-d H:i:s"),PDO::PARAM_STR);
		$reponse->bindValue(":id_auteur",$_POST['id_user'],PDO::PARAM_INT);
		$reponse->bindValue(":id_sujet",$_POST['idSujet'],PDO::PARAM_INT);
		$reponse->execute();

		$last_reponse= $bdd->query('SELECT MAX(id_reponse) as id_reponse from reponses');
		$last_reponse=$last_reponse->fetch();
		notif_forum($bdd,$_POST['id_user'],"a commenté un sujet sur lequel vous discutez","reponse",$last_reponse['id_reponse']);
		header('location:../../index.php?module=utilisateur&action=reponse&rapport=ok&idLng='. $_POST['idLng'].'&%20idSujet='.$_POST['idSujet']);
		exit();
	}

	if(isset($_POST['id_sujet_resolu']) and isset($_POST['id_sujet_auteur_resolu']))
	{
		$sujets= $bdd->query('SELECT * from sujet where id_sujet='.$_POST['id_sujet_resolu']);
 		$sujet=$sujets->fetch();

 		notif_forum($bdd,$_POST['id_sujet_auteur_resolu'],"a marqué un sujet sur lequel vous discutez résolu","sujet resolu",$_POST['id_sujet_resolu']);
		$resolu=$bdd->query('UPDATE sujet set statut_sujet ="resolu" where id_sujet='.$_POST['id_sujet_resolu']);
		header('location:../../index.php?module=utilisateur&action=reponse&idLng='. $sujet['id_lng'].'&%20idSujet='.$_POST['id_sujet_resolu']);
		exit();
	}

	if(isset($_POST['id_user_fav']) and isset($_POST['id_sujet_fav']))// ajax favoris
	{
		if($_POST['traitement']=='1')
		{
			$insert=$bdd->query('INSERT into favoris (id_auteur,id_sujet) VALUES ('.$_POST['id_user_fav'].','.$_POST['id_sujet_fav'].')');
			echo('ajouté au favoris');
		}
		else
		{
			$delete=$bdd->prepare('DELETE from favoris where id_auteur='.$_POST['id_user_fav'].' and id_sujet='.$_POST['id_sujet_fav']);
			$delete->execute();

		}
		exit();
	}

	if( isset($_POST['new_cat']) and isset($_POST['idUser']))// ajax new categorie
	{
		$insert=$bdd->exec('INSERT into categorie (nom_cat, idUtilisateur) values ("'.$_POST['new_cat'].'","'.$_POST['idUser'].'")');
		$recups=$bdd->query('SELECT * from categorie where id_cat=( SELECT MAX(id_cat) from categorie)');
		$recup=$recups->fetch();
		echo '<option value="'.$recup['id_cat'].'" >'.$recup['nom_cat'].'</option>';

		notif_forum($bdd,$_POST['idUser'],"a créé une nouvelle categorie","categorie",$recup['id_cat']);
	}

	if(isset($_POST['Nom_sous_cat']) and isset($_POST['idCat']) and isset($_POST['Description']) and isset($_POST['id_user'])) 
	{
		$insert=$bdd->exec('INSERT INTO langage( Nom, Description, id_cat, id_createur) VALUES ("'.$_POST['Nom_sous_cat'].'","'.$_POST['Description'].'",'.$_POST['idCat'].','.$_POST['id_user'].')');

		$last_langage= $bdd->query('SELECT MAX(id_lng) as id_lng from langage');
		$last_langage=$last_langage->fetch();
		notif_forum($bdd,$_POST['id_user'],"a créé un nouveau langage","sous-categorie",$last_langage['id_lng']);
		
		header('location:../../index.php?module=utilisateur&rapport=ok&action=forum');
	}


		function notif_forum($bdd,$idEx,$contenu,$type,$id_content) // fonction pour inserer les notifications dans toutes les tables du module forum
		{
			$new_notif=$bdd->prepare('INSERT INTO notification (typeNotification,dateNotification,contenuNotification,id_auteur,id_content) values (:type,:dateNotif,:contenu,:idauteur,:id_content)');
             $new_notif->bindValue(":dateNotif",date('Y-m-d H:i:s'),PDO::PARAM_STR);
             $new_notif->bindValue(":type",$type,PDO::PARAM_STR);
             $new_notif->bindValue(":contenu",$contenu,PDO::PARAM_STR);
             $new_notif->bindValue(":idauteur",$idEx,PDO::PARAM_INT);
             $new_notif->bindValue(":id_content",$id_content,PDO::PARAM_INT);
             $new_notif->execute(); 


             $last_notif=$bdd->query('SELECT MAX(idNotification) as idNotification FROM `notification`');
             $last_notif=$last_notif->fetch(); 
             	if($type=="sous-categorie" or $type=="categorie" or $type=="sujet")// si on a un nouveu sujet ou une nouvelle categorie ou une nouvellle sous-categorie , on envoie la notif à tout le monde.
             	{
             		$list= $bdd->query('SELECT idUtilisateur from utilisateur where Role < 3 ');
             		while($liste=$list->fetch())
             		{
             			if($liste['idUtilisateur']== $idEx)
             			{
             				continue ;
             			}
             			$notif_has_user = $bdd->prepare('INSERT INTO notification_has_user(id_recepteur, id_notification, Statut) VALUES (:idrecep,:last_notif,"non_lu")');
			            $notif_has_user->bindValue(":idrecep",$liste['idUtilisateur'],PDO::PARAM_INT);
			            $notif_has_user->bindValue(":last_notif",$last_notif['idNotification'],PDO::PARAM_INT);
			            $notif_has_user->execute();
             		}

             	}
             	elseif ($type=="reponse") // Si c'est une réponse on notifie tout ceux qui ont dejà répondu et le createur...
             	{
             		$sujet=$bdd->prepare('SELECT id_sujet from reponses where id_reponse=:id'); // on recupére id du sujet pour avoir tout les participants à ce sujet
             		$sujet->bindValue(":id",$id_content,PDO::PARAM_INT);
             		$sujet->execute();
             		$sujet=$sujet->fetch();

             		$id_auteur= $bdd->prepare('SELECT id_auteur from sujet where id_sujet=:id');
             		$id_auteur->bindValue(":id",$sujet['id_sujet'],PDO::PARAM_INT);
             		$id_auteur->execute();
             		$id_auteur=$id_auteur->fetch();
             		if($id_auteur['id_auteur']!=$idEx) // on enregistre une notification particuliére pour l'auteur du commentaire
             		{
             			$new_notif=$bdd->prepare('INSERT INTO notification (typeNotification,dateNotification,contenuNotification,id_auteur,id_content) values ("reponse",:dateNotif,"a commenté un sujet que vous avez créé",:idauteur,:id_content)');
             			$new_notif->bindValue(":dateNotif",date('Y-m-d H:i:s'),PDO::PARAM_STR);
	             		$new_notif->bindValue(":idauteur",$idEx,PDO::PARAM_INT);
	             		$new_notif->bindValue(":id_content", $id_content,PDO::PARAM_INT);
	             		$new_notif->execute(); 

	             		$notif_has_user = $bdd->prepare('INSERT INTO notification_has_user(id_recepteur, id_notification, Statut) VALUES (:idrecep,(SELECT MAX(idNotification) FROM `notification`) ,"non_lu")');
	             		$notif_has_user->bindValue(":idrecep",$id_auteur['id_auteur'],PDO::PARAM_INT);
	             		$notif_has_user->execute();

             		}

             		$list=$bdd->prepare('SELECT DISTINCT (id_auteur) from reponses where id_sujet=:id');
             		$list->bindValue(":id",$sujet['id_sujet'],PDO::PARAM_INT);
             		$list->execute();

             		while ( $liste=$list->fetch())
             		{
             			if($liste['id_auteur']== $idEx or $id_auteur['id_auteur']==$liste['id_auteur']) // si l'auteur de la notif est dans la liste ou il est l'auteur du sujet on passe au suivant
             			{
             				continue ;
             			}
             			$notif_has_user = $bdd->prepare('INSERT INTO notification_has_user(id_recepteur, id_notification, Statut) VALUES (:idrecep,:last_notif,"non_lu")');
			            $notif_has_user->bindValue(":idrecep",$liste['id_auteur'],PDO::PARAM_INT);
			            $notif_has_user->bindValue(":last_notif",$last_notif['idNotification'],PDO::PARAM_INT);
			            $notif_has_user->execute();
             		}


             	}
             	else
             	{
             		$list=$bdd->prepare('SELECT DISTINCT (id_auteur) from reponses where id_sujet=:id');
             		$list->bindValue(":id",$id_content,PDO::PARAM_INT);
             		$list->execute();

             		while ( $liste=$list->fetch())
             		{
             			if($liste['id_auteur']== $idEx ) // si l'auteur de la notif est dans la liste ou il est l'auteur du sujet on passe au suivant
             			{
             				continue ;
             			}
             			$notif_has_user = $bdd->prepare('INSERT INTO notification_has_user(id_recepteur, id_notification, Statut) VALUES (:idrecep,:last_notif,"non_lu")');
			            $notif_has_user->bindValue(":idrecep",$liste['id_auteur'],PDO::PARAM_INT);
			            $notif_has_user->bindValue(":last_notif",$last_notif['idNotification'],PDO::PARAM_INT);
			            $notif_has_user->execute();
             		}
             	}

		}
  ?>
