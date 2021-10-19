<?php
		include "../modele/modele3.php";



	if (isset($_POST['id']) and isset($_POST['date']) and isset($_POST['idEx']) and isset($_POST['idRec']) )   // ajax actualisation de message 
	{
		$idEx=$_POST['idEx'];
		$idRec=$_POST['idRec'];
		$id = $_POST['id'];
		$recuperation=$bdd->prepare('SELECT idMessage as id_msg, Contenu as contenu ,idExpediteur as idEx,idRecepteur as idRec,time(date_envoie) as heure ,date(date_envoie) as date_send,statut FROM message WHERE idMessage>:id and ((idExpediteur=:idEx and idRecepteur=:idRec) OR(idExpediteur=:idRec and idRecepteur=:idEx)) and statut!="lu"');
		$recuperation->bindValue(':idEx',$idEx,PDO::PARAM_INT);
		$recuperation->bindValue(':idRec',$idRec,PDO::PARAM_INT);
		$recuperation->bindValue(':id',$_POST['id'],PDO::PARAM_INT);
		$recuperation->execute();

		while ($data=$recuperation->fetch())
	    	{
	    		// Cette partie modifie le statut du message en fonction du fait qu'il ait deja eté affiché chez le recepteur ou chez l'envoyeur ou chez les deux

		    		if( $data['idEx'] == $_POST['idEx'] )
		    		{
		    			if ( $data['statut'] == "non_lu")
		    		    {
		    				$statut='envoyer'; 
		    			}
		    			elseif ( $data['statut'] == "recu")
		    		    {
		    				$statut='lu';
		    			}
		    			else
		    			{
		    				continue;
		    			}	
		    		}

		    		else 
		    		{
		    			if ( $data['statut'] == "non_lu")
		    		    {
		    				$statut='recu';
		    			}
		    			elseif ( $data['statut'] == "envoyer")
		    		    {
		    				$statut='lu';
		    			}
		    			else
		    			{
		    				continue;
		    			}
		    		}
		    		$bdd->query('UPDATE message SET statut="'.$statut.'" where idMessage='.$data['id_msg'].'');

		    		if($_POST['date']!=$data['date_send'])
		    		{
		    			echo'<div class="Me_date_send"> Aujourd\'hui</div> ';
		    			echo"<script>
		    					$('#ME_last_message_date').val('".$data['date_send']."');
		    				 </script>" ;// ce bout de code permet de modifier la date du denier message dans la page message.php...
		    		}
		    		
					 	$nombre2=$bdd->prepare('SELECT id_fichier as id_file, nom ,URL , type, taille FROM fichier where id_message=:id_message');
					 	$nombre2->bindValue(":id_message",$data['id_msg'],PDO::PARAM_INT);
					 	$nombre2->execute();
					 	if($data['idEx']==$idEx)

					 	{	
					 		echo '<div class=Me_shaw_file>';
					 		while ($shawfile=$nombre2->fetch())
						 		 {
						 		 	$type_file='';
						 		 	$Me_file_image_contener='Me_file_contener';// par defaut on met cette valeur qu'on ne changera que si le fichier est une image car c'est le seul type dont l'affichage est différent...
						 		 	
						 		 	if($shawfile['type']=='image')
						 		 	{
						 		 		$Me_file_image_contener='Me_image_contener';
						 		 		$type_file='<img src="'.$shawfile['URL'].'"/>';
						 		 	}
						 		 	elseif($shawfile['type']=="pdf")
						 		 	{
						 		 		$type_file='<i class="fas fa-file-pdf"></i>';
						 		 	}
						 		 	elseif($shawfile['type']=="document")
						 		 	{
						 		 		$type_file='<i class="far fa-file-word"></i>';
						 		 	}
						 		 	elseif($shawfile['type']=="audio")
						 		 	{
						 		 		$type_file='<i class="fas fa-file-audio"></i>';
						 		 	}
						 		 	elseif($shawfile['type']=="video")
						 		 	{
						 		 		$type_file='<i class="far fa-file-video"></i>';
						 		 	}
						 		 	else
						 		 	{
						 		 		$type_file='<i class="fas fa-file"></i>';
						 		 	}



						 		 	echo'<div class="'.$Me_file_image_contener.'">
											<a href="'.$shawfile['URL'].'">
												'.$type_file.'
											</a><br/>
											<span>'.$shawfile['nom'].'</span>
						 				 </div>';
						 			
						 		}
						 		echo'</div>';

					 			echo'<div class="Me_msg_div">
										<div class="ME_box2b">
											'. htmlspecialchars($data['contenu']).'
											<div class="Me_space_contenu"></div>
											<span class="Me_afficher_heure_envoie">
												'.substr($data['heure'], 0,-3).'
											</span>
										</div>

									</div>';

					 	}

					 	else
					 	{
					 		echo '<div class=Me_shaw_file2>';
					 		while ($shawfile=$nombre2->fetch())
						 		 {
						 		 	$type_file='';
						 		 	$Me_file_image_contener='Me_file_contener2';
						 		 	
						 		 	if($shawfile['type']=='image')
						 		 	{
						 		 		$Me_file_image_contener='Me_image_contener2';
						 		 		$type_file='<img src="'.$shawfile['URL'].'"/>';
						 		 	}
						 		 	elseif($shawfile['type']=="pdf")
						 		 	{
						 		 		$type_file='<i class="fas fa-file-pdf"></i>';
						 		 	}
						 		 	elseif($shawfile['type']=="document")
						 		 	{
						 		 		$type_file='<i class="far fa-file-word"></i>';
						 		 	}
						 		 	elseif($shawfile['type']=="audio")
						 		 	{
						 		 		$type_file='<i class="fas fa-file-audio"></i>';
						 		 	}
						 		 	elseif($shawfile['type']=="video")
						 		 	{
						 		 		$type_file='<i class="far fa-file-video"></i>';
						 		 	}
						 		 	else
						 		 	{
						 		 		$type_file='<i class="fas fa-file"></i>';
						 		 	}
						 		 	echo'<div class="'.$Me_file_image_contener.'">
											<a href="'.$shawfile['URL'].'">
												'.$type_file.'
											</a><br/>
											<span>'.$shawfile['nom'].'</span>
						 				 </div>';
						 			
						 		}
						 		echo '</div>';

					 			echo'<div class="Me_msg_div">
										<div class="ME_box2a">
											'. htmlspecialchars($data['contenu']).'
											<div class="Me_space_contenu"></div>
											<span class="Me_afficher_heure_envoie">
												'.substr($data['heure'], 0,-3).'
											</span>
										</div>

									</div>';	
					 	}
						
					

			}
	}else
	{
		echo "<script> 
				alert('Erreur de chargement veuillez actualisez la page');
			</script>";
	}
  ?>