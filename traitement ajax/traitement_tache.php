<?php
include "../include/config.php";
include "../modele/modele.php";

if(isset($_POST['idModule'])){
 

    if(isset($_POST['nom_tache'])){
             $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        
    $date1 = (string) date("Y-m-d h:i:s");

    $date2 = (string)$_POST['date_fin_tache'];
    
    $req = $bdd->prepare('INSERT INTO tache(Nom_tache, Date_creation, Date_Fin, idModule, idParticipant) VALUES(:nom_tache,
    :creation_tache, :fin_tache, :idModule, :idUser)');
    $req->execute(array(
    'nom_tache' => $_POST['nom_tache'],
    'creation_tache' => $date1,
    'fin_tache' => $date2,
    'idModule' => $_POST['idModule'],
    'idUser' => $_POST['participant_tache']
));
   
    }
}
?>
      <?php
      $query=get_module();
      while ($result=$query->fetch(PDO::FETCH_ASSOC)){
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
  </div>    </div><?php }}}?>                      