<?php 
include "../include/config.php";
include "../modele/modele.php";
$result= get_projet_by_id($_POST['idProject']);
$resultat= get_equipe_by_id($result['Equipe_idEquipe']);
$user = get_user_by_equipe($resultat['idEquipe']);

if(isset($_POST['nom_module'])){
        if(!empty($_POST['nom_module'])&&!empty($_POST['description_module'])&&!empty($_POST['date_fin_module'])){
            $req=add_module($_POST['idProject']);
        } else {
            echo '<script>alert("Veuillez tout remplir");</script>';
        }
    } 
?>

                                                            <?php
                                                           if(isset($_GET['id'])){ 

                                                            $query=get_module();
                                                            while ($result=$query->fetch(PDO::FETCH_ASSOC)){
                                                                   if($result['idProject']==$_POST['idProject']){ 
                                                             ?>
                                                           <div class="TAB_2a111" id="TAB_2a111">
                                                            <p class="TAB_para" onclick="afficher(<?php echo $result['idModule']?>);" id="<?php echo $result['idModule']?>">
                                                                <?php echo $result['Nom_Module']; ?></p>
                                                            <div class="TAB_2a1111<?php echo $result['idModule']; ?>" id="<?php echo $result['idModule'].'b'; ?>">
                                                                       <div class="TAB_2a111a">
                                                                       <p class="TAB_p1">Description du module:</p> <?php echo $result['Description_Module']; ?><br>
                                                                       Duree: <?php echo convert_date($result['Date_Fin']); ?><br>
                                                                         Participants:<br>
                                                                               <?php
                                                                               $quer= get_user_by_module($result['idModule']);
                                                                               while ($resulta=$quer->fetch(PDO::FETCH_ASSOC)){
                                                                                   foreach ($resulta as $resulta){
                                                                                       $que = get_user_by_id($resulta);
                                                                                       echo $que['Nom_utilisateur'].'</br>';
                                                                                   }
                                                                               }
                                                                               ?>
                                                                       </div>
                                                               
                        
                                                                      <label class="TAB_p1">Tâches disponibles :</label>    
                           <div>    
                                   <?php
                                    $tache= get_tache();
                                            while ($tache_result=$tache->fetch(PDO::FETCH_ASSOC)){
                                                   if($tache_result['idModule']==$result['idModule'] && $tache_result['Statut']==0){ 
                                   ?>
                                   <div class="TAB_2a111">
                                   <p class="TAB_para" onclick="affiche(<?php echo $tache_result['idTache']?>);" id="<?php echo $tache_result['idTache']?>">
                                           <?php echo $tache_result['Nom_tache'];?></p>
                                   <div class="TAB_2a1111" id="<?php echo $tache_result['idTache'].'c';?>">
                                                                       <div class="TAB_2a111a">
                                                                         Date de fin: <?php echo convert_date($tache_result['Date_fin']); ?><br>
                                                                         Participant:<br>
                                                                               <?php
                                                                               $quer= get_user_by_tache($tache_result['idTache']);
                                                                               while ($resulta=$quer->fetch(PDO::FETCH_ASSOC)){
                                                                                   foreach ($resulta as $resulta){
                                                                                       $que = get_user_by_id($resulta);
                                                                                       echo $que['Nom_utilisateur'].'</br>';
                                                                                   }
                                                                               }
                                                                               ?>
                                                                         <form method="POST">
                                                                             <input type="hidden" name="idModul" value="<?php echo $result['idModule']?>">
                                                                             <input type="hidden" name="idTache" value="<?php echo $tache_result['idTache']?>">
                                                                            
                                                                             <button type="submit" class="TAB_btn">
                                                                                 Débuter
                                                                             </button>
                                                                         </form>
                                                                       </div>
                               </div>    </div><?php }}?>
                                <button class="TAB_btn11"><i class="fa fa-plus"></i> Ajouter une tache</button>
                                <div class="TAB_2a11a">
                                    <form method="POST" id="form_tache<?php echo $result['idModule']; ?>">
                                                                               <?php ?>
                                    <input type="text" name="nom_tache" placeholder="Nom de la tache" class="nom-tache"><br>
                                    <input type="date" name="date_fin_tache"><br>
                                       <input type="hidden" name="idModule" id="idmodule<?php echo $result['idModule']?>" value="<?php echo $result['idModule']?>">
                                    <label>Participant de la tache</label>
                                                                           <select name="participant_tache">
                                                                               <?php
                                                                               $quer= get_user_by_module($result['idModule']); 
                                                                                   if(isset($_POST['nom_tache'])){
                                                                                       if(!empty($_POST['nom_tache'])&&!empty($_POST['participant_tache'])&&!empty($_POST['date_fin_tache'])){
                                                                                           add_tache($_POST['idModule']);
                                                                                           //echo '<script>window.location="index.php?module=utilisateur&action=tableaux_projets&id='.$_GET['id'].'"</script>';
                                                                                           break;
                                                                                       } else {
                                                                                           echo 'Veuillez tout remplir';
                                                                                           break;
                                                                                       }
                                                                                   }
                                                                               while ($resulta=$quer->fetch(PDO::FETCH_ASSOC)){
                                                                                   foreach ($resulta as $resulta){
                                                                                       $que = get_user_by_id($resulta);
                                                                                       echo '<option value="'.$que['idUtilisateur'].'">'.$que['Nom_utilisateur'].'</option>';
                                                                                   }
                                                                               }
                                                                               ?>
                                    </select><br>
                                                                           <button type="button" onclick="post_tache(<?php echo $result['idModule']  ?>)" data-element="<?php echo $result['idModule'] ?>" id="TAB_btn11a" class="TAB_btn11a"> Publier</button>
                                </form>
            </div>
                                </div>
                                                            </div>
                            </div>
                                                                                                    <?php }}} ?>
                           
                     