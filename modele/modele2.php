 
 <?php
 // ce fichier contient les fonctions pour tout le module forum
		 
function check_role($bdd,$id)
{
	$get=$bdd->query('SELECT * from utilisateur where idUtilisateur='.$id);
		$user=$get->fetch();
		if($user['Role']==2)
		{
			return true;
		}
		else
		{
			return false;
		}
}		
function get_langage($bdd)
{
	$langages=$bdd->query('SELECT * from langage ');
	
	while ($langage=$langages->fetch()) 
	{
	 echo '<option value="'.$langage['id_lng'].'">'.$langage['Nom'].'</option>';			
	}
}
function get_categorie($bdd)
{
	$categories=$bdd->query('SELECT * from categorie ');
	
	while ($categorie=$categories->fetch()) 
	{
	 echo '<option value="'.$categorie['id_cat'].'">'.$categorie['nom_cat'].'</option>';			
	}
}

 function Show_lien_lng($bdd,$id)
 {
 	$langages= $bdd->query('SELECT * from langage where id_lng='.$id);
 	$langage=$langages->fetch();


 	$categories=$bdd->query('SELECT categorie.nom_cat as nom , categorie.id_cat as id from categorie,langage where langage.id_cat= categorie.id_cat and langage.id_cat='.$langage['id_cat'].' LIMIT 1');
 	$cat=$categories->fetch();

 	return '<strong> <a href=" index.php?module=utilisateur&action=forum"> Forum > </a> </strong>
 			<strong><a href="index.php?module=utilisateur&action=forum&lienCat=fo_'.$cat['nom'].'"> '.$cat['nom'].' > </a> </strong>
 			<span>'.$langage['Nom'].' </span>
		
			';
 }

 function check_favoris($idSujet,$id_user,$bdd)
 {
 	$favoris=$bdd->query('SELECT * from favoris where id_auteur='.$id_user.' and id_sujet = '.$idSujet.'');
 	$fav=$favoris->rowCount();

 	if($fav==0)
 	{
 		return '<div id="fo_sujet_favoris'.$idSujet.'" title="ajouter aux favoris" class="fo_sujet_no_favoris" onclick="ajouter_fav(\''.$idSujet.'\')"> <i class="fas fa-star"></i> </div>';
 	}

 	else
 	{
 		return'<div id="fo_sujet_favoris'.$idSujet.'" title="retirer des favoris" class="fo_sujet_favoris" onclick="retirer_fav(\''.$idSujet.'\')" ><i class="fas fa-star"></i> </div>';
 	}
 }

 function Show_lien_sujet($bdd,$idLng,$idSujet)
 {

 	$sujets= $bdd->query('SELECT * from sujet where id_sujet='.$idSujet);
 	$sujet=$sujets->fetch();

 	$langages= $bdd->query('SELECT * from langage where id_lng='.$idLng);
 	$langage=$langages->fetch();


 	$categories=$bdd->query('SELECT nom_cat as nom , id_cat as id from categorie where id_cat='.$langage['id_cat'].'');
 	$cat=$categories->fetch();

 	return '<strong> <a href=" index.php?module=utilisateur&action=forum"> Forum > </a> </strong>
 			<strong>	<a href="index.php?module=utilisateur&action=forum&lienCat=fo_'.$cat['nom'].'"> '.$cat['nom'].' > </a> </strong>
 			<strong>	<a href="index.php?module=utilisateur&action=sujet&idLng='.$idLng.'"> '.$langage['Nom'].' > </a> </strong>
 			<span>'.$sujet['titre'].' </span>
		
			';

 }


	function Me_conversion_date($date)
		{
				if($date==date('Y-m-d',time()-3600*24))
				{
					return "Hier";
				}
				elseif ($date==date('Y-m-d') )
				{
					return "Aujourd'hui";
				}
				else
				{
					list($year, $month, $day) = explode("-", $date);
		

				$months = array("jan", "fev", "mars", "avr", "mai", "juin",
	    		"juil", "août", "sept", "oct", "nov", "dec");

	    		return "le ". $day." ".$months[$month-1]." ".$year;// ajouter ceci si on veut aussi afficher les heures." à ".$hour."h".$min."min"
				}
				 
		}

	function Me_conversion_date2($date)
		{
				if($date==date('Y-m-d',time()-3600*24))
				{
					return "Hier";
				}
				else
				{
					list($year, $month, $day) = explode("-", $date);
		

				$months = array("jan", "fev", "mars", "avr", "mai", "juin",
	    		"juil", "août", "sept", "oct", "nov", "dec");

	    		return $day." ".$months[$month-1]." ".$year;// ajouter ceci si on veut aussi afficher les heures." à ".$hour."h".$min."min"
				}
				 
		}	

		function afficher_forum($bdd)
	{
		$All_categorie=$bdd->query('SELECT * FROM categorie');
		while ($categorie= $All_categorie->fetch(PDO::FETCH_ASSOC)) // Chaque entrée sera récupérée et placée dans un array.
		{
                    
			echo'<div class="fo_block">
						<span id="fo_'.$categorie['nom_cat'].'"></span>
					  			<h3>'.$categorie['nom_cat'].'</h3>
					  			<div class="fo_contener">';

			$All_sous_categorie=$bdd->query('SELECT id_lng , nom ,Description FROM langage where id_cat ='.$categorie['id_cat']);
							if($All_sous_categorie->rowCount()==0)
							{
								echo "Aucun langage dans cette categorie pour l'instant";
							}
					 		while ($sous_categorie=$All_sous_categorie->fetch(PDO::FETCH_ASSOC))
					 		{		
					 			//afficher le nombres de sujets par langage
					 			$nombre_sujet_request=$bdd->query('SELECT count(titre) As nombre_sujet from sujet where id_lng='.$sous_categorie['id_lng'].'');

					 			$nombre_sujet = $nombre_sujet_request->fetch();

					 			//pour chaque langage on selectionne le last commentaire
					 			$last_commentaire_request=$bdd->query('SELECT id_sujet, titre,contenu FROM sujet where id_lng = '.$sous_categorie['id_lng'].' ORDER BY date_sujet desc Limit 1 OFFSET 0');

					 			//on affiche chaque langage 
					 			echo'<div class="fo_block0" >
									    <a href="index.php?module=utilisateur&action=sujet&idLng='. $sous_categorie['id_lng'].'">
										 <div class="Fo_sujet_description" id="fo_desc_'.$sous_categorie['id_lng'].'">
										  	<div class="fo_titre">
												'.$sous_categorie['nom'].'
												
												<span class="fo_nombre_msg">
													( '.$nombre_sujet['nombre_sujet'].' Sujet)
												</span>
											</div>
											<div class="fo_description">
												'.$sous_categorie['Description'].'
											</div>
										  </div>
										</a>  
											<div class="fo_separateur1"> </div>
										 
											';

						$last_commentaire=$last_commentaire_request->fetch(PDO::FETCH_ASSOC);

					 		      if($last_commentaire_request->rowCount())
					 		    	{
					 		    		echo '<a href="index.php?module=utilisateur&action=reponse&idLng='. $sous_categorie['id_lng'].'& idSujet='.$last_commentaire['id_sujet'].'" class="fo_lien">

					 		    				<div class="fo_last_message">
												<strong><u>Dernier message:</u></strong><br/>'
					 		    					.CoupePhrase(htmlspecialchars($last_commentaire['contenu']),57).
					 		    				'</div>
					 		    			 </a>';
					 		    	}
					 		    	else
					 		    	{
					 		    		echo '<div class="fo_last_message">
													<strong><u>Dernier message:</u></strong><br/>
						 		    				Aucun sujet
					 		    				</div>';
					 		    	}


		

					 			echo '
								 			
											
						</div>';
						}
			echo'  	</div>
		  	   </div>';
		 		
		}
	}
	function sujet_resolu($bdd,$id_sujet,$type)// type ici indique si c'est une fonction de listing de sujet ou la fonction de la page de réponse qui à fait appel à notre fonction
	{
		$sujets=$bdd->query('SELECT statut_sujet as statut from sujet where id_sujet='.$id_sujet);
		$sujet=$sujets->fetch();

		if($sujet['statut']=='resolu')
		{
			if($type==1)
			{
				return '<div class="fo_sujet_resolu"> <i class="fas fa-check"></i><span> Sujets résolu</span></div>';
			}
			else
			{
				return'<div class="fo_resolu"><i class="fas fa-check"></i> Sujet Résolu</div>';
			}
		}
		else
		{
			if($type==1)
			{
				return'<div class="fo_sujet_non_resolu"></div>';
			}
		}
	}
	function get_user($bdd,$id)
	{
		$get=$bdd->query('SELECT * from utilisateur where idUtilisateur='.$id);
		$user=$get->fetch();
		return $user['Nom_utilisateur'].' '.substr($user['Prenom_utilisateur'],0,8);
	}


function interventions($id_user,$bdd)//ici on a copié le code de la fonction qui affiche les sujets et on a complété avec la partie réponse ... l'algorithme est simple: on commence par affiché les sujets donc l'auteur est le user actuel puis on reccupére l'id de ces sujets dans une variable et à la fin on vérifie en compaarant les id des réponse qu'on veut afficher si parmi les sujets commenté par le user il y,a pas redondance

	{
		$tab_sujet[]='';
		$sujets=$bdd->query('SELECT *, date(date_sujet) as jour , time (date_sujet) as heure from sujet where id_auteur='.$id_user.' ORDER by id_sujet DESC');
		

		while($sujet=$sujets->fetch())
		{
			$count=$bdd->query('SELECT count(*) as nbre from reponses where id_sujet='.$sujet['id_sujet']);
			$nbre_cmt=$count->fetch();
			//on gére l'affichage...
			if($nbre_cmt['nbre']==0)
			{
				$tab_sujet[]=$sujet['id_sujet'];
				$nbre_cmt['nbre']='Aucune réponse';

				$date=Me_conversion_date($sujet['jour']).' à '.substr($sujet['heure'],0,5);

			echo '<div class="fo_msg_list">
					<a href="index.php?module=utilisateur&action=reponse&idLng='.$sujet['id_lng'].'& idSujet='.$sujet['id_sujet'].'">
					<div class="fo_msg_titre">
						'.CoupePhrase(htmlspecialchars($sujet['titre'],40)).'<br/>
						<span class="fo_msg_auteur">Posté par <strong>'.CoupePhrase(get_user($bdd,$sujet['id_auteur']),20) .' </strong>  '.$date.' 
						</span>
					</div>
					</a>
					'.sujet_resolu($bdd,$sujet['id_sujet'],2).'
					<div class="fo_msg_nombre_reponses">
						'.$nbre_cmt['nbre'].'
					</div>
					<div class="fo_msg_last_reponse">
						
						 '.check_favoris($sujet['id_sujet'],$id_user,$bdd).'
					</div>
				  </div>';
			}
		else{
				if ($nbre_cmt['nbre']==1) 
				{

					$nbre_cmt['nbre']='0'.$nbre_cmt['nbre'].' réponse';
				}
				else
				{
					if( $nbre_cmt['nbre']<=9)
					{
						$nbre_cmt['nbre']='0'.$nbre_cmt['nbre'].' réponses';
					}
					else
					{
						$nbre_cmt['nbre']=$nbre_cmt['nbre'].' réponses';


					}
					
				}


			$tab_sujet[]=$sujet['id_sujet'];//c'est ce qui va nous servir pour la comparaison aprés...

			$last_cmt=$bdd->query(' SELECT *, date(date_reponse) as jour , time(date_reponse) as heure from reponses where id_sujet= '.$sujet['id_sujet'].' ORDER BY id_reponse DESC limit 1 ');
			$lst_cmt=$last_cmt->fetch();

			 $date=Me_conversion_date($sujet['jour']).' à '.substr($sujet['heure'],0,5);
			 $date2=Me_conversion_date($lst_cmt['jour']).' à '.substr($lst_cmt['heure'],0,5);

			echo '<div class="fo_msg_list">
					<a href="index.php?module=utilisateur&action=reponse&idLng='.$sujet['id_lng'].'& idSujet='.$sujet['id_sujet'].'">
					<div class="fo_msg_titre">
						'.CoupePhrase(htmlspecialchars($sujet['titre']),40).'<br/>
						<span class="fo_msg_auteur">Posté par <strong>'.CoupePhrase(get_user($bdd,$sujet['id_auteur']),20) .' </strong> '.$date.' 
						</span>
					</div>
					</a>
					'.sujet_resolu($bdd,$sujet['id_sujet'],2).'
					<div class="fo_msg_nombre_reponses">
						'.$nbre_cmt['nbre'].'
					</div>
					<div class="fo_msg_last_reponse">
						Derniére réponse par <strong> '.check_favoris($sujet['id_sujet'],$id_user,$bdd).'
						'.CoupePhrase(get_user($bdd,$lst_cmt['id_auteur']),20) .'</strong> '.$date2.'
						
					</div>
				  </div>';	
			}

		}





		$reponses=$bdd->query('SELECT id_sujet from reponses where id_auteur='.$id_user);
		while ($reponse=$reponses->fetch()) 
		{
			if( !in_array($reponse['id_sujet'], $tab_sujet))// on compare l'id réccupéré avec les id  don le user est créateur pour n'afficher que ceux qui restent...
			{

				$sujets2=$bdd->query('SELECT *, date(date_sujet) as jour , time (date_sujet) as heure from sujet where id_sujet='.$reponse['id_sujet'].' ORDER by id_sujet DESC' );
				$sujet2=$sujets2->fetch();


									$count=$bdd->query('SELECT count(*) as nbre from reponses where id_sujet='.$sujet2['id_sujet']);
								$nbre_cmt=$count->fetch();
								//on gére l'affichage...
								if($nbre_cmt['nbre']==0)
								{
									$nbre_cmt['nbre']='Aucune réponse';

									$date=Me_conversion_date($sujet2['jour']).' à '.substr($sujet2['heure'],0,5);

								echo '<div class="fo_msg_list fo_msg_list_rep">
										<a href="index.php?module=utilisateur&action=reponse&idLng='.$sujet2['id_lng'].'& idSujet='.$sujet2['id_sujet'].'">
										<div class="fo_msg_titre">
											'.CoupePhrase(htmlspecialchars($sujet2['titre'],40)).'<br/>
											<span class="fo_msg_auteur">Posté par <strong>'.CoupePhrase(get_user($bdd,$sujet2['id_auteur']),20) .' </strong>  '.$date.' 
											</span>
										</div>
										</a>
										'.sujet_resolu($bdd,$sujet2['id_sujet'],2).'
										<div class="fo_msg_nombre_reponses">
											'.$nbre_cmt['nbre'].'
										</div>
										<div class="fo_msg_last_reponse">
											
											 '.check_favoris($sujet2['id_sujet'],$id_user,$bdd).'
										</div>
									  </div>';
								}
							else{
									if ($nbre_cmt['nbre']==1) 
									{

										$nbre_cmt['nbre']='0'.$nbre_cmt['nbre'].' réponse';
									}
									else
									{
										if( $nbre_cmt['nbre']<=9)
										{
											$nbre_cmt['nbre']='0'.$nbre_cmt['nbre'].' réponses';
										}
										else
										{
											$nbre_cmt['nbre']=$nbre_cmt['nbre'].' réponses';


										}
										
									}


								

								$last_cmt=$bdd->query(' SELECT *, date(date_reponse) as jour , time(date_reponse) as heure from reponses where id_sujet= '.$sujet2['id_sujet'].' ORDER BY id_reponse DESC limit 1 ');
								$lst_cmt=$last_cmt->fetch();
								 $date=Me_conversion_date($sujet2['jour']).' à '.substr($sujet2['heure'],0,5);
								 $date2=Me_conversion_date($lst_cmt['jour']).' à '.substr($lst_cmt['heure'],0,5);

								echo '<div class="fo_msg_list fo_msg_list_rep">
										<a href="index.php?module=utilisateur&action=reponse&idLng='.$sujet2['id_lng'].'& idSujet='.$sujet2['id_sujet'].'">
										<div class="fo_msg_titre">
											'.CoupePhrase(htmlspecialchars($sujet2['titre'],40)).'<br/>
											<span class="fo_msg_auteur">Posté par <strong>'.CoupePhrase(get_user($bdd,$sujet2['id_auteur']),20) .' </strong> '.$date.' 
											</span>
										</div>
										</a>
										'.sujet_resolu($bdd,$sujet2['id_sujet'],2).'
										<div class="fo_msg_nombre_reponses">
											'.$nbre_cmt['nbre'].'
										</div>
										<div class="fo_msg_last_reponse">
											Derniére réponse par <strong> '.check_favoris($sujet2['id_sujet'],$id_user,$bdd).'
											'.CoupePhrase(get_user($bdd,$lst_cmt['id_auteur']),20) .'</strong> '.$date2.'
											
										</div>
									  </div>';	
								}

			}
		}


	}



function afficher_favoris($bdd,$id_user)
{
	$favoris=$bdd->query('SELECT distinct (id_sujet) from favoris where id_auteur='.$id_user);
	while($favori=$favoris->fetch())
	{
		$sujets=$bdd->query('SELECT *, date(date_sujet) as jour , time (date_sujet) as heure from sujet where id_sujet='.$favori['id_sujet']);
		$sujet=$sujets->fetch();
		$count=$bdd->query('SELECT count(*) as nbre from reponses where id_sujet='.$sujet['id_sujet']);
			$nbre_cmt=$count->fetch();
			//on gére l'affichage...
			if($nbre_cmt['nbre']==0)
			{
				$nbre_cmt['nbre']='Aucune réponse';

				$date=Me_conversion_date($sujet['jour']).' à '.substr($sujet['heure'],0,5);

			echo '<div class="fo_msg_list">
					<a href="index.php?module=utilisateur&action=reponse&idLng='.$sujet['id_lng'].'& idSujet='.$sujet['id_sujet'].'">
					<div class="fo_msg_titre">
						'.CoupePhrase(htmlspecialchars($sujet['titre']),40).'<br/>
						<span class="fo_msg_auteur">Posté par <strong>'.CoupePhrase(get_user($bdd,$sujet['id_auteur']),20) .' </strong>  '.$date.' 
						</span>
					</div>
					</a>
					'.sujet_resolu($bdd,$sujet['id_sujet'],2).'
					<div class="fo_msg_nombre_reponses">
						'.$nbre_cmt['nbre'].'
					</div>
					<div class="fo_msg_last_reponse">
						
						 '.check_favoris($sujet['id_sujet'],$id_user,$bdd).'
					</div>
				  </div>';
			}
		else{
				if ($nbre_cmt['nbre']==1) 
				{

					$nbre_cmt['nbre']='0'.$nbre_cmt['nbre'].' réponse';
				}
				else
				{
					if( $nbre_cmt['nbre']<=9)
					{
						$nbre_cmt['nbre']='0'.$nbre_cmt['nbre'].' réponses';
					}
					else
					{
						$nbre_cmt['nbre']=$nbre_cmt['nbre'].' réponses';


					}
					
				}


			

			$last_cmt=$bdd->query(' SELECT *, date(date_reponse) as jour , time(date_reponse) as heure from reponses where id_sujet= '.$sujet['id_sujet'].' ORDER BY id_reponse DESC limit 1 ');
			$lst_cmt=$last_cmt->fetch();

			 $date=Me_conversion_date($sujet['jour']).' à '.substr($sujet['heure'],0,5);
			 $date2=Me_conversion_date($lst_cmt['jour']).' à '.substr($lst_cmt['heure'],0,5);
//idLng et idSujet vont servir dans la page de réception
			echo '<div class="fo_msg_list">
					<a href="index.php?module=utilisateur&action=reponse&idLng='.$sujet['id_lng'].'& idSujet='.$sujet['id_sujet'].'">
					<div class="fo_msg_titre">
						'.CoupePhrase(htmlspecialchars($sujet['titre']),40).'<br/>
						<span class="fo_msg_auteur">Posté par <strong>'.CoupePhrase(get_user($bdd,$sujet['id_auteur']),20) .' </strong> '.$date.' 
						</span>
					</div>
					</a>
					'.sujet_resolu($bdd,$sujet['id_sujet'],2).'
					<div class="fo_msg_nombre_reponses">
						'.$nbre_cmt['nbre'].'
					</div>
					<div class="fo_msg_last_reponse">
						Derniére réponse par <strong> '.check_favoris($sujet['id_sujet'],$id_user,$bdd).'
						'.CoupePhrase(get_user($bdd,$lst_cmt['id_auteur']),20) .'</strong> '.$date2.'
						
					</div>
				  </div>';	
			}
	}
}

	function afficher_recherche($bdd,$motCle,$id_user)

	{
		
			echo '<div id="fo_msg_sous_categorie">
						Resultat recherche pour <strong> "'.$motCle.'"</strong>
				  </div>';


			$sujets=$bdd->query("SELECT *, date(date_sujet) as jour , time (date_sujet) as heure from sujet where titre  LIKE '%".$motCle."%' or contenu LIKE '%".$motCle."%'");

			if($sujets->rowCount()==0)
			{
				echo '<div class="fo_msg_list">
						
						<div class="fo_msg_titre">
							 Aucun sujet trouvé <br/>
							<span class="fo_msg_auteur"><strong></strong> 
							</span>
						</div>

						<div class="fo_msg_nombre_reponses">
							
						</div>
						<div class="fo_msg_last_reponse">
					
							
						</div>
					</div>'
					;
				
			}
		else
		{
			while($sujet=$sujets->fetch())
			{
				$id_lng=$sujet['id_lng'];
				$count=$bdd->query('SELECT count(*) as nbre from reponses where id_sujet='.$sujet['id_sujet']);
				$nbre_cmt=$count->fetch();
				//on gére l'affichage...
				if($nbre_cmt['nbre']==0)
				{
					$nbre_cmt['nbre']='Aucune réponse';

					$date=Me_conversion_date($sujet['jour']).' à '.substr($sujet['heure'],0,5);

				echo '<div class="fo_msg_list">
						<a href="index.php?module=utilisateur&action=reponse&idLng='.$id_lng.'& idSujet='.$sujet['id_sujet'].'">
						<div class="fo_msg_titre">
							'.CoupePhrase(htmlspecialchars($sujet['titre']),40).'<br/>
							<span class="fo_msg_auteur">Posté par <strong>'.CoupePhrase(get_user($bdd,$sujet['id_auteur']),20) .' </strong>  '.$date.' 
							</span>
						</div>
						</a>
						'.sujet_resolu($bdd,$sujet['id_sujet'],2).'
						<div class="fo_msg_nombre_reponses">
							'.$nbre_cmt['nbre'].'
						</div>
						<div class="fo_msg_last_reponse">
							
							 '.check_favoris($sujet['id_sujet'],$id_user,$bdd).'
						</div>
					  </div>';
				}
			else{
					if ($nbre_cmt['nbre']==1) 
					{

						$nbre_cmt['nbre']='0'.$nbre_cmt['nbre'].' réponse';
					}
					else
					{
						if( $nbre_cmt['nbre']<=9)
						{
							$nbre_cmt['nbre']='0'.$nbre_cmt['nbre'].' réponses';
						}
						else
						{
							$nbre_cmt['nbre']=$nbre_cmt['nbre'].' réponses';


						}
						
					}


				

				$last_cmt=$bdd->query(' SELECT *, date(date_reponse) as jour , time(date_reponse) as heure from reponses where id_sujet= '.$sujet['id_sujet'].' ORDER BY id_reponse DESC limit 1 ');
				$lst_cmt=$last_cmt->fetch();

				 $date=Me_conversion_date($sujet['jour']).' à '.substr($sujet['heure'],0,5);
				 $date2=Me_conversion_date($lst_cmt['jour']).' à '.substr($lst_cmt['heure'],0,5);

				echo '<div class="fo_msg_list">
						<a href="index.php?module=utilisateur&action=reponse&idLng='.$id_lng.'& idSujet='.$sujet['id_sujet'].'">
						<div class="fo_msg_titre">
							'.CoupePhrase(htmlspecialchars($sujet['titre']),40).'<br/>
							<span class="fo_msg_auteur">Posté par <strong>'.CoupePhrase(get_user($bdd,$sujet['id_auteur']),20) .' </strong> '.$date.' 
							</span>
						</div>
						</a>
						'.sujet_resolu($bdd,$sujet['id_sujet'],2).'
						<div class="fo_msg_nombre_reponses">
							'.$nbre_cmt['nbre'].'
						</div>
						<div class="fo_msg_last_reponse">
							Derniére réponse par <strong> '.check_favoris($sujet['id_sujet'],$id_user,$bdd).'
							'.CoupePhrase(get_user($bdd,$lst_cmt['id_auteur']),20) .'</strong> '.$date2.'
							
						</div>
					  </div>';	
				}

			}
		}	
		
	}

	function afficher_sujet($bdd,$id_lng,$id_user=1)

	{
			$langage=$bdd->query('SELECT * from langage where id_lng='.$id_lng);
			$lng=$langage->fetch();

			echo '<div id="fo_msg_sous_categorie">
						'.$lng['Nom'].'
				  </div>';

			$sujets=$bdd->query('SELECT *, date(date_sujet) as jour , time (date_sujet) as heure from sujet where id_lng='.$lng['id_lng'].' ORDER by id_sujet DESC' );

			if($sujets->rowCount()==0)
			{
				echo '<div class="fo_msg_list">
						
						<div class="fo_msg_titre">
							 Aucun sujet pour l\'instant<br/>
							<span class="fo_msg_auteur"><strong></strong> 
							</span>
						</div>

						<div class="fo_msg_nombre_reponses">
							
						</div>
						<div class="fo_msg_last_reponse">
					
							
						</div>
					</div>'
					;
				
			}
		else
		{
			while($sujet=$sujets->fetch())
			{
				$count=$bdd->query('SELECT count(*) as nbre from reponses where id_sujet='.$sujet['id_sujet']);
				$nbre_cmt=$count->fetch();
				//on gére l'affichage...
				if($nbre_cmt['nbre']==0)
				{
					$nbre_cmt['nbre']='Aucune réponse';

					$date=Me_conversion_date($sujet['jour']).' à '.substr($sujet['heure'],0,5);

				echo '<div class="fo_msg_list">
						<a href=" index.php?module=utilisateur&action=reponse&idLng='.$id_lng.'& idSujet='.$sujet['id_sujet'].'">
						<div class="fo_msg_titre">
							'.CoupePhrase(htmlspecialchars($sujet['titre']),40).'<br/>
							<span class="fo_msg_auteur">Posté par <strong>'.CoupePhrase(get_user($bdd,$sujet['id_auteur']),20) .' </strong>  '.$date.' 
							</span>
						</div>
						</a>
						'.sujet_resolu($bdd,$sujet['id_sujet'],2).'
						<div class="fo_msg_nombre_reponses">
							'.$nbre_cmt['nbre'].'
						</div>
						<div class="fo_msg_last_reponse">
							
							 '.check_favoris($sujet['id_sujet'],$id_user,$bdd).'
						</div>
					  </div>';
				}
			else{
					if ($nbre_cmt['nbre']==1) 
					{

						$nbre_cmt['nbre']='0'.$nbre_cmt['nbre'].' réponse';
					}
					else
					{
						if( $nbre_cmt['nbre']<=9)
						{
							$nbre_cmt['nbre']='0'.$nbre_cmt['nbre'].' réponses';
						}
						else
						{
							$nbre_cmt['nbre']=$nbre_cmt['nbre'].' réponses';


						}
						
					}


				

				$last_cmt=$bdd->query(' SELECT *, date(date_reponse) as jour , time(date_reponse) as heure from reponses where id_sujet= '.$sujet['id_sujet'].' ORDER BY id_reponse DESC limit 1 ');
				$lst_cmt=$last_cmt->fetch();

				 $date=Me_conversion_date($sujet['jour']).' à '.substr($sujet['heure'],0,5);
				 $date2=Me_conversion_date($lst_cmt['jour']).' à '.substr($lst_cmt['heure'],0,5);

				echo '<div class="fo_msg_list">
						<a href="index.php?module=utilisateur&action=reponse&idLng='.$id_lng.'& idSujet='.$sujet['id_sujet'].'">
						<div class="fo_msg_titre">
							'.CoupePhrase(htmlspecialchars($sujet['titre']),40).'<br/>
							<span class="fo_msg_auteur">Posté par <strong>'.CoupePhrase(get_user($bdd,$sujet['id_auteur']),20) .' </strong> '.$date.' 
							</span>
						</div>
						</a>
						'.sujet_resolu($bdd,$sujet['id_sujet'],2).'
						<div class="fo_msg_nombre_reponses">
							'.$nbre_cmt['nbre'].'
						</div>
						<div class="fo_msg_last_reponse">
							Derniére réponse par <strong> '.check_favoris($sujet['id_sujet'],$id_user,$bdd).'
							'.CoupePhrase(get_user($bdd,$lst_cmt['id_auteur']),20) .'</strong> '.$date2.'
							
						</div>
					  </div>';	
				}

			}
		}	
		
	}


	function afficher_reponse($bdd,$idSujet,$id_user)
	{
		$sujets=$bdd->query('SELECT *, date(date_sujet) as jour, time (date_sujet) as heure from sujet where id_sujet='.$idSujet);
		$sujet=$sujets->fetch();
		if($sujet['statut_sujet']!='resolu' and $sujet['id_auteur']==$id_user)
		{
			$resolu='<form id="fo_form_resolu" method="POST" action="modules/utilisateur/fo_traitement.php">
						<input type="text" hidden name="id_sujet_resolu" value="'.$sujet['id_sujet'].'">
						<input type="text" hidden name="id_sujet_auteur_resolu" value="'.$id_user.'">
						<input type="submit" value="Classer comme résolu?">
					</form>
					';
		}
		else
		{
			$resolu='';
		}

		$lngs=$bdd->query('SELECT * from langage where id_lng='.$sujet['id_lng']);
		$lng=$lngs->fetch();
			

		 $auteurs= $bdd->query('SELECT * from utilisateur where idUtilisateur='.$sujet['id_auteur']);
		 $auteur=$auteurs->fetch();

		echo ''.$resolu.sujet_resolu($bdd,$sujet['id_sujet'],1).'
			<div class="fo_rep_titre_sujet">
					'.$sujet['titre'].'<br/>
					<span>'.$lng['Nom'].'</span>
			  </div>
			  <div class="fo_sujet_selected">
				<div class="fo_rep_bloc_countainer">
					<div class="fo_rep_info_user">
						<span>'.CoupePhrase($auteur['Prenom_utilisateur'].' '.$auteur['Nom_utilisateur'], $long = 13).'</span>
						<div>
							<p>';
                                        show_user2($auteur['idUtilisateur'], "fo_rep_img");
                                        
								echo'
								
							</p>
						</div>
					</div>

					<div class="fo_rep_contenu">
						Sujet créé 
						<span class="fo_rep_date">
							'.Me_conversion_date($sujet['jour']).' à '.substr($sujet['heure'], 0,5).'
						</span>
						<div>
							'.htmlspecialchars($sujet['contenu']).' 
							<div class="fo_rep_fav">
								'.check_favoris($sujet['id_sujet'],$id_user,$bdd).'
							</div>
						</div>
					</div>
				</div>
			  </div>
			  <div class="fo_rep_indicateur">Réponses:</div>
			  ';// on peut maintenant afficher les commentaires de chaque message

		$reponses= $bdd->query('SELECT *, date(date_reponse) as jour, time (date_reponse) as heure from reponses where id_sujet='.$sujet['id_sujet'].' ORDER BY id_reponse DESC' );
		$nbre=$reponses->rowCount();
		if ($nbre==0) 
		{
			echo'<div class="fo_aucune_reponse"> Aucune réponse pour l\'instant ... Cliquer sur le bouton répondre pour envoyer une réponse</div>';
		}
		while ($reponse=$reponses->fetch())
		 {

		 	$auteurs_rep= $bdd->query('SELECT * from utilisateur where idUtilisateur='.$reponse['id_auteur']);
		 	$auteur_rep=$auteurs_rep->fetch();

			echo '<div class="fo_rep_sujet">
					<div class="fo_rep_bloc_countainer">
						<div class="fo_rep_info_user">
							<span>'.CoupePhrase($auteur_rep['Prenom_utilisateur'].' '.$auteur_rep['Nom_utilisateur'], $long = 14).'</span>
							<div>
								<p>';
                                        show_user2($auteur_rep['idUtilisateur'], "fo_rep_img");
                                        
								echo'
								</p>
							</div>
						</div>

						<div class="fo_rep_contenu">
						    postée
							<span class="fo_rep_date">
								'.Me_conversion_date($reponse['jour']).' à '.substr($reponse['heure'], 0,5).'
							</span>
							<div>
								'.htmlspecialchars($reponse['contenu_reponse']).'
							</div>
						</div>
					</div>
				  </div>';	
			}





	}


 ?>