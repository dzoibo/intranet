 <?php

 /*if(isset($_GET['id'])){
     
    $date = (string)date("d-m-Y à h:i:s");
    
        
        $projet = get_projet_by_id($_GET['id']);
        
        $users = get_all_utilisateur();
        while($user = $users->fetch(PDO::FETCH_ASSOC)){
            add_notification("Projet", "Le projet ".$projet['intutile'] ." a été supprimé le ".$date."", $_SESSION['idUser'], $user['idUtilisateur']);
        }
        $module = get_module_by_project($_GET['id']);
        delete_equipe_utiisateur($projet['Equipe_idEquipe']);
        while ($modul = $module->fetch(PDO::FETCH_ASSOC)){
            $del_tache = delete_tache($modul['idModule']);
            $del_modul_participant = delete_module_participant($modul['idModule']);
            $del_module = delete_module($_GET['id']);
        }}*/
        
if(isset($_GET['id'])){
          $resultat = delete_projet($_GET['id']);
        //delete_equipe($projet['Equipe_idEquipe']);
          if($resultat){
              echo "<script>
                   window.location = 'index.php?module=utilisateur&action=projet_accueil';
              </script>";        
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
			<div class="PRO_box">
				<h2 >Listes des projets</h2>
				<div class="PRO_box1">
                                    	
                                    <?php
                                    
                                        $query = get_projet();
                                        while ($donnees = $query->fetch()){
                                        	?>
                                            <div class="PRO_box1a">
                                            	<a href="index.php?module=utilisateur&action=tableaux_projets&id=<?php echo $donnees['idProject']?>">
                                            		<?php echo $donnees['intutile']; ?></a>
                                          	</div>
                                            <div class="PRO_box1a_option">
                                             Enregistré le <?php echo $donnees['date_enreg']; ?>   
                                            </div>
				<div class="PRO_box1a1">	
					<a href="index.php?module=administration&action=modifier_projet&id=<?php echo $donnees['idProject']?>"> <button>Modifier &nbsp;&nbsp; <i class="fa fa-pen-alt"></i>  </button></a>
				</div>
              
				<div class="PRO_box1a2">
					<a href="index.php?module=utilisateur&action=projet_accueil&id=<?php echo $donnees['idProject']?>">  <button name="submit">Supprimer&nbsp;&nbsp;<i class="far fa-trash-alt"></i></button></a>
                </div>
                                    <?php } ?>		
				</div>			
			<div class="PRO_box1b">
				<a href="index.php?module=administration&action=ajout_projet"><button class="PRO_btn">Ajouter un projet <span class="PRO_eq"><i class="fa fa-plus"></i></span></button></a>
			</div>
			</div>
		

		</div>
    </div>
</body>
