<?php
	try
		{
		$bdd = new PDO('mysql:host=localhost;dbname=seinova;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));// ce dernier paramettre permet d'afficher les erreurs SQL
		}
		catch (Exception $e)
		{
		        die('Erreur : ' . $e->getMessage());
		}

		


	if(isset($_FILES['file1']) or isset($_FILES['file2']) or isset($_POST['ME_msg']))
	{
		if (empty($_FILES['file1']) and empty($_FILES['file2']) and $_POST['ME_msg']) // ceci n'est pas totalement valide car empty ne sera jamais true pour les tableau
		{
			echo "<script  type=\"text/javascript\">alert('Vous n'avez envoyé aucun message!)</script>; "; // en attendant de trouver un moyen cote serveur d'empécher l'envoie avec le bouton...
		}

		else
		{

			$contenu = $_POST['ME_msg'];
			$Msg=$bdd->prepare('INSERT INTO message(Contenu,idExpediteur,idRecepteur,date_envoie) values(:msg,:idEx,:idRec,:dateSend)');
			 $Msg->bindValue(":msg",$contenu,PDO::PARAM_STR);
			 $Msg->bindValue(":idEx",$_POST['idEx'],PDO::PARAM_INT);
			 $Msg->bindValue(":idRec",$_POST['idRec'],PDO::PARAM_INT);
		     $Msg->bindValue(":dateSend",date('Y-m-d H:i:s'),PDO::PARAM_STR);

		     $Msg->execute();
		     // on selection le message qu'on vient d'envoyer pour ajouter les fichier et mettre à jour la table conversation également
			 $reponse_last_id = $bdd->prepare('SELECT MAX(idMessage) as idmax FROM message where (idExpediteur=:idEx and idRecepteur=:idRec)  or (idRecepteur=:idEx and idExpediteur=:idRec)');
			 $reponse_last_id->bindValue(":idEx",$_POST['idEx'],PDO::PARAM_INT);
			 $reponse_last_id->bindValue(":idRec",$_POST['idRec'],PDO::PARAM_INT);
			 $reponse_last_id->execute();
             $last_id =  $reponse_last_id->fetch();
             $last_id = $last_id['idmax'];
             // on crée une nouvelle notification
             $new_notif=$bdd->prepare('INSERT INTO notification (typeNotification,dateNotification,contenuNotification,id_auteur,id_content) values ("message",:dateNotif,:contenu,:idauteur,:id_content)');
             $new_notif->bindValue(":dateNotif",date('Y-m-d H:i:s'),PDO::PARAM_STR);
             $new_notif->bindValue(":contenu",": \"".$contenu."\"",PDO::PARAM_STR);
             $new_notif->bindValue(":idauteur",$_POST['idEx'],PDO::PARAM_INT);
             $new_notif->bindValue(":id_content", $last_id,PDO::PARAM_INT);
             $new_notif->execute();

             $notif_has_user = $bdd->prepare('INSERT INTO notification_has_user(id_recepteur, id_notification, Statut) VALUES (:idrecep,(SELECT MAX(idNotification) as idNotification FROM `notification`) ,"non_lu")');
             $notif_has_user->bindValue(":idrecep",$_POST['idRec'],PDO::PARAM_INT);
             $notif_has_user->execute();


             //on met à jour le dernier message des coversations...
             $select_convers=$bdd->prepare('SELECT * from conversation where (iduser1=:idEx and iduser2=:idRec)  or (iduser1=:idRec and iduser2=:idEx)');
             $select_convers->bindValue(":idEx",$_POST['idEx'],PDO::PARAM_INT);
			 $select_convers->bindValue(":idRec",$_POST['idRec'],PDO::PARAM_INT);
			 $select_convers->execute();

			 if($select_convers->rowCount()) // Dans le cas ou une conversation existe entre ces deux utilisateurs...
			 {
			 	$selected_convers=$select_convers->fetch();
			 	if($selected_convers['archiver']=='oui') // Nous faisons ceci pour sortir la conversation des archives quand le récepteur recevra
			 	{
			 		$unArchiv=$bdd->prepare('UPDATE conversation set archiver='.$_POST['idRec'].' where id_conversation='.$selected_convers['id_conversation'].'');
			 		$unArchiv->execute();
			 	}	
			 	elseif($selected_convers['archiver']==$_POST['idEx'])
			 	{
			 		$unArchiv=$bdd->prepare('UPDATE conversation set archiver= "non" where id_conversation='.$selected_convers['id_conversation'].'');
			 		$unArchiv->execute();
			 	}

			 	$insert_last_convers=$bdd->prepare('UPDATE conversation set last_message='.$last_id.' where id_conversation='.$selected_convers['id_conversation'].'');
			 	$insert_last_convers->execute();
			 }
			 else// Dans le cas ou il n'y aucune conversation entre ces deux utilisateurs...
			 {	
			 	$insert_last_convers=$bdd->prepare('INSERT INTO conversation (iduser1, iduser2, last_message, archiver, epingler) VALUES (:idEx,:idRec,:msg,"non","non")');
			 	$insert_last_convers->bindValue(":msg",$last_id,PDO::PARAM_INT);
			 	$insert_last_convers->bindValue(":idEx",$_POST['idEx'],PDO::PARAM_INT);
			 	$insert_last_convers->bindValue(":idRec",$_POST['idRec'],PDO::PARAM_INT);
			 	$insert_last_convers->execute();
			 }

             //on entamme avec les fichiers
             $img_type=array("jpeg","jpg","svg","png","giff","ai","jfif","pjpeg","pjp");
             $video_type=array("mp4","avi","move","mkv");
             $doc_type=array("docx","docm","doctx","dotm","xlsx","xlsm","xlsb","xltx");
             $audio_type=array("mp3","WAV","BWF","Ogg","CAFF","RAW","mp3","WMA");
              $msg_erreur=array();
                $Error_tlg=array();

             $myFile = $_FILES['file1'];
             $fileCount = count($myFile["name"]);
                echo "<br>";
                $error=false;

                for ($i = 0; $i < $fileCount; $i++)
                 {	
                 	$error=false;
                    if( $myFile["size"][$i]!=0 and $myFile["name"][$i] )//en attendant de trouver un autre moyen de verifier
                    {	
                        if($myFile["size"][$i]>=20000000)
                        {
                        	$error=true;
                        }
                        if( substr(strrchr($myFile['name'][$i], "."), 1)=='php' or $myFile["type"][$i]=='application/octet-stream' )// la premiere condition nous permet de rechercher les chaines de caractéres; on pouvait aussi utiliser pathinfo($myFile["name"][$i])['extension']
                        {
                        	$error=true;
                        	echo "bad type";
                        }
                        if(!is_uploaded_file($myFile['tmp_name'][$i]))
                        {
                        	$error=true;
                        	echo "erreu tele";
                        }
                        if	($myFile["error"][$i]!=0)
                        {
                        	$error=true;
                        	echo "erreur error";
                        }
                        if($error)
                        {
                        	$msg_erreur[$i]="erreur d'envoie ".$myFile["name"][$i].": mauvaise extension ou fichier trop lourd(taille max=20Mo)";
                        }
                        else// il y'a aucune erreur on peut donc passer au telechargement...
                        {
                        echo getcwd();
                        $type_insert="autres";
                        $nom=$myFile["name"][$i];
                        $extensionFichier=pathinfo($myFile["name"][$i])['extension'];	
                        $stock=substr(dirname(__DIR__), 0, -8)."/document/File_Doc/"; // la focntion substr est utilisé pour couper la partie de dirname(__DIR__) qui ne nous est pas utile
                        $nomDestination = $myFile["name"][$i].date("YmdHis").".".$extensionFichier;

						  
						    //on verifie le type de fichier pour filtrer l'insertion;
						    if($extensionFichier=='pdf')
						    {
						    	$type_insert="pdf";
						    }
						    elseif (in_array($extensionFichier,$img_type)) {
						    	$type_insert="image";
						    }
						    elseif (in_array($extensionFichier, $video_type)) {
						    	$type_insert="video";
						    }
						    elseif (in_array($extensionFichier, $doc_type)) {
						    	$type_insert="document";
						    }
						    elseif (in_array($extensionFichier, $audio_type)) {
						    	$type_insert="audio";	
						    }
						    else
						    {
						    	$type_insert="autres";
						    }
						    try //on essaye de télécharger
						    {
							     move_uploaded_file($myFile["tmp_name"][$i],$stock.$nomDestination);
							     $file_insert=$bdd->prepare('INSERT INTO fichier(id_message,nom,taille,type,URL	) values(:id_message,:nom,:taille,:type,:URL)');
							     $file_insert->bindValue(":id_message",$last_id,PDO::PARAM_INT);
				 				 $file_insert->bindValue(":nom",$nom,PDO::PARAM_STR);
				 				 $file_insert->bindValue(":taille",$myFile["size"][$i],PDO::PARAM_STR);
			     				 $file_insert->bindValue(":type",$type_insert,PDO::PARAM_STR);
			     				 $file_insert->bindValue(":URL","document/File_Doc/".$nomDestination,PDO::PARAM_STR);

			     				 $file_insert->execute();
						    } 
						    catch (\Exception $e) 
						    {
						        $e->getMessage();
						        $Error_tlg[$i]="Erreur de transfert";
						    }
						    
                        }

            
                    }  
                 }  
                 //on entamme avec les images
           
              $msg_erreur2=array( );
               $Error_tlg2=array();//erreur en cas de telechargement

             $myFile = $_FILES['file2'];
             $fileCount = count($myFile["name"]);
               
                $error=false;

                for ($i = 0; $i < $fileCount; $i++)
                 {	
                 	$error=false;
                    if( $myFile["size"][$i]!=0 and $myFile["name"][$i] )//en attendant de trouver un autre moyen de verifier
                    {
                        if($myFile["size"][$i]>=20000000)
                        {
                        	$error=true;
                        }
                        if( substr(strrchr($myFile['name'][$i], "."), 1)=='php' or $myFile["type"][$i]=='application/octet-stream' )// la premiere condition nous permet d'extraire l'extension; on pouvait aussi utiliser pathinfo($myFile["name"][$i])['extension']
                        {
                        	$error=true;
                        }
                        if(!is_uploaded_file($myFile['tmp_name'][$i]))
                        {
                        	$error=true;
                        }
                        if	($myFile["error"][$i]!=0)
                        {
                        	$error=true;
                        }
                        if($error)
                        {
                        	$msg_erreur2[$i]="erreur d'envoie ".$myFile["name"][$i].": mauvaise extension ou fichier trop lourd(taille max=20Mo)";
                       }
                        else// il y'a aucune erreur on peut donc passer au telechargement...
                        {
                        echo "c'est mo";
                        $type_insert="autres";
                        $nom=$myFile["name"][$i];
                        $extensionFichier=pathinfo($myFile["name"][$i])['extension'];	
                       $stock=substr(dirname(__DIR__), 0, -8)."/document/File_Doc/"; // la focntion substr est utilisé pour couper la partie de dirname(__DIR__) qui ne nous est pas utile
                        $nomDestination = $myFile["name"][$i].date("YmdHis").".".$extensionFichier;

						  
						    //on verifie le type de fichier pour filtrer l'insertion;
						    if($extensionFichier=='pdf')
						    {
						    	$type_insert="pdf";
						    }
						    elseif (in_array($extensionFichier,$img_type)) {
						    	$type_insert="image";
						    }
						    elseif (in_array($extensionFichier, $video_type)) {
						    	$type_insert="video";
						    }
						    elseif (in_array($extensionFichier, $doc_type)) {
						    	$type_insert="document";
						    }
						    elseif (in_array($extensionFichier, $audio_type)) {
						    	$type_insert="audio";	
						    }
						    else
						    {
						    	$type_insert="autres";
						    }
						  	try 
						  	{
						       move_uploaded_file($myFile["tmp_name"][$i], $stock.$nomDestination);
						       $file_insert=$bdd->prepare('INSERT INTO fichier(id_message,nom,taille,type,URL	) values(:id_message,:nom,:taille,:type,:URL)');
						     	$file_insert->bindValue(":id_message",$last_id,PDO::PARAM_INT);
			 				 	$file_insert->bindValue(":nom",$nom,PDO::PARAM_STR);
			 				 	$file_insert->bindValue(":taille",$myFile["size"][$i],PDO::PARAM_STR);
		     				 	$file_insert->bindValue(":type",$type_insert,PDO::PARAM_STR);
		     				 	$file_insert->bindValue(":URL","document/File_Doc/".$nomDestination,PDO::PARAM_STR);
		     				 	$file_insert->execute();
		     				 	echo $stock.$nomDestination;
						    } 
						    catch (\Exception $e) 
						    {
						        $e->getMessage();
						        $tlg2[$i]="erreur de transfert";
						    }
						    
                        }

            
                    }  
                 }
        }           
	}
	else
	{
		echo "rien";;
	}
 ?>
