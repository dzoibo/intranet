<?php 

 if(isset($_GET['id'])){
  $donnees= get_projet_by_id($_GET['id']);
   $donnees2 = get_equipe_by_id($donnees['Equipe_idEquipe']);
	
 }
 
if(isset($_POST['nom_projet'])){
    if(!empty($_POST['nom_projet'])&&!empty($_POST['debut_projet'])&&!empty($_POST['fin_projet'])){
        update_projet($_POST['idProject']);
    }
}

if(isset($_POST['nom_equipe'])){
    if(!empty($_POST['nom_equipe'])){
        update_equipe($_POST['idEquipe']);
        delete_equipe_utiisateur($_POST['idEquipe']);
            if(!empty($_POST['chk'])){
                foreach($_POST['chk'] as $chk){
           $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
                        $req = $bdd->prepare('INSERT INTO equipe_has_utilisateur(Equipe_idEquipe, Utilisateur_idUtilisateur) VALUES(:idEquipe, :idUser)');
                        $req->execute(array(
                        'idEquipe' => $_POST['idEquipe'],
                        'idUser' => $chk
                            ));
                }
                    
        echo "<script>
                   window.location = './index.php?module=utilisateur&action=projet_accueil';
              </script>"; 
            }
    }
}
 ?>
 <body>
      <?= $content ?>
 <div class="container-general container-projet">
     <div class="M_wrapper-menu ">
      <?php include  "include/menu.php" ?>
     </div>
     <div class="container-content container-contenu">
			<h2 class="MP_para">Modifier les informations concernant le projet</h2>
				<div class="MP_box1">

					<div class="MP_box1a">
					
                                        <form class="MP_form" method="POST">
					<label>Nom du projet</label><br>
                                                <input type="text" name="nom_projet" class="nom_projet" id="nom_projet" placeholder="Sur quoi voulez-vous travaillez" value="<?php echo $donnees['intutile']?>"><br><br>
					<label>Date de Debut du projet</label><br>
                                        <input type="date" name="debut_projet" class="debut_projet" id="debut_projet"  value="<?php echo $donnees['date_debut']?>"><br><br>
					<label>Date de Fin du projet</label><br>
                                        <input type="date" name="fin_projet" class="fin_projet" id="fin_projet" value="<?php echo $donnees['date_fin']?>"><br><br>
					
					
					
					</form>

				</div>
				<div class="MP_box1b">
					
					<form class="MP_form2" method="POST">
						
						<label>Nom de l'Equipe</label><br>
                                                <input type="text" name="nom_equipe" placeholder="Nom de l'équipe"  value="<?php echo $donnees2['Nom_equipe'];?>" class="AP_equipe2" id="nom_equipe" ><br><br>	
                                                <h4>Selctionner les membres de votre equipe</h4>
                                                <div class="" id="AP_box2a">
                                       <?php
                                        $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
                                        $resultat = $bdd->query('SELECT * FROM utilisateur ORDER BY Nom_utilisateur');
                                        while ($donnees = $resultat->fetch()){
                                                echo '<a ><div><input type="checkbox" value="'.htmlspecialchars($donnees['idUtilisateur']).'" name="chk[]" id="AP_check">' . htmlspecialchars($donnees['Nom_utilisateur']).'</div></a>' ;
                                                
                                        }
                                        $resultat->closeCursor();
                                    ?>
                                   </div>
					<br><br><br>
                                        <input type="hidden" name="idEquipe" id="id1" value="<?php echo $donnees2['idEquipe'];?>">						
                                        <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'];?>">

                                       
					
 <button type="submit" name="submit" value="Valider les informations" class="AP_btn3" id="MP_btn3">Modifier les informations</button><br>
				 </form>
					
					
				</div>
				</div>
<script type="text/javascript">
	function afficher(para2){
        var p = "#" + para2 + "b";
        $(p).toggle();
    }
</script>
			</div>
        </div>
    </body>


