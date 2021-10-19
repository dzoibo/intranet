
 <?php
  if(isset($_GET['id'])){
    if(isset($_POST['nom_module'])){
        if(!empty($_POST['nom_module'])&&!empty($_POST['description_module'])&&!empty($_POST['date_fin_module'])){
            add_module($_GET['id']);
        } else {
            echo '<script>alert("Veuillez tout remplir");</script>';
        }
    }
        if(isset($_POST['idTache'])){
            $module = get_module_by_id($_POST['idModul']);
            if($module['Statut']==0){
                debut_module_changed($_POST['idModul']);
                statut_module_changed(1, $_POST['idModul']);
            }elseif ($module['Statut']==2) {
                statut_module_changed(1, $_POST['idModul']);
            }
            $tache = get_tache_by_id($_POST['idTache']);
            if($tache['Statut']==0){
                debut_tache_changed($_POST['idTache']);
            }
            statut_tache_changed(1, $_POST['idTache']);
        }
        if(isset($_POST['idTache_Fin'])){
            statut_tache_changed(2, $_POST['idTache_Fin']);
            $query= get_tache_by_module($_POST['idModule_Fin']);
            while($tache = $query->fetch()){
                    if($tache['Statut']==2){
                        statut_module_changed(2, $_POST['idModule_Fin']);
                    }else{
                        statut_module_changed(1, $_POST['idModule_Fin']);
                    }
                }
        }
  $result= get_projet_by_id($_GET['id']);
  $resultat= get_equipe_by_id($result['Equipe_idEquipe']);
  $user = get_user_by_equipe($resultat['idEquipe']);

  if(empty($result)){
    header('Location:index.php');
  }
?>
<body>
      <?= $content ?>

<div class="container-general container-projet">
    <div class="M_wrapper-menu ">
     <?php include  "include/menu.php" ?>
    </div>
    <div class="container-content container-contenu">
			
			<div class="TAB_box1">
				<div class="TAB_box1a">
				 <a href="index.php?module=utilisateur&action=projet_accueil">
                    <i class="fa fa-arrow-left"></i></a>
				</div>
              <span class="TAB_span">La date de fin de votre projet portant sur <?php echo $result['intutile'];?> est le <?php 
                 $date_chaine = date_format(date_create($result['date_fin']),"d-m-Y ");

              echo $date_chaine;?></span> 

				<div class="TAB_box1b">
					<div class="TAB_box1b1">
                     <?php echo $result['intutile'];?>
					</div>
					<div class="TAB_box1b2">
                    <?php echo $resultat['Nom_equipe'];?>
					</div>
					<div class="TAB_box1b3">
                        <?php
                            while ($donnees=$user->fetch(PDO::FETCH_ASSOC)){
                            foreach ($donnees as $donnees){
                            $don = get_user_by_id($donnees);
                            ?>
                        <div class="TAB_box1b3a">
                            <?php if($don['Photo']==""){ ?>
                                <i class="fa fa-user-alt"></i>
                            <?php }else{ ?>
                          <?php echo "<img src='".$don['Photo']."' >"; ?> 
                          <?php } ?> 
                        </div>
                        <div class="TAB_box1b3b">
                         <?php echo $don['Nom_utilisateur']; ?>   
                        </div>
                   <?php  
                        }} 
                    ?>
					</div>
				
			</div>
  <?php }else{?>
				<div class="TAB_box1b">
					<div class="TAB_box1b1">
					Nom du projet
					</div>
					<div class="TAB_box1b2">
					Nom de L'equipe
					</div>
					<div class="TAB_box1b3">
						affichages des
					personnes concernant le projet
					</div>
				
			</div>
  <?php }?>
			<div class="TAB_box2">
					<div class="TAB_box2a">
					<h3> A faire</h3>
                                            <div class="TAB_box2a2">
                                                <button class="TAB_btn1"><i class="fa fa-plus"></i> Ajouter un module</button>
                                            </div>
                                                    <form class="TAB_form1" method="POST" id="form_module">
                                                    <input type="text" name="nom_module" class="TAB_input" placeholder="Nom du module"><br>
                                                    <input type="hidden" name="idProject" value="<?php echo $_GET['id'];?>">
                                                    <textarea name="description_module" class="msg_module"></textarea><br>
                                                    <div class="TAB_box2a2a">
                                                    <label class="TAB_p1">Ajouter les participants: </label><br>
                                                                <?php  if(isset($_GET['id'])){
                                                                $result= get_projet_by_id($_GET['id']);
                                                                $resultat= get_equipe_by_id($result['Equipe_idEquipe']);
                                                                $user = get_user_by_equipe($resultat['idEquipe']); 
                                                                while ($donnee=$user->fetch(PDO::FETCH_ASSOC)){
                                                                    foreach ($donnee as $donnee){
                                                                        $done = get_user_by_id($donnee);
                                                                        echo '<input type="checkbox" class="chk_module" id="TAB_check" value="'.htmlspecialchars($done['idUtilisateur']).'" name="chek[]">' . htmlspecialchars($done['Nom_utilisateur']).'<br>' ;
                                                                    
                                                                    }
                                                                }}
                                                                ?>
                                                    </div>
                                                    <input type="date" name="date_fin_module" class="TAB_input" ><br>
                                                    <input type="submit" name="submit" value="Ajouter" id="TAB_btn2" class="TAB_btn2">
                                                </form>                             
                                        <div class="TAB_box2a1">
                                                       	<?php
                                                        if(isset($_GET['id'])){ 

                                                       	$query=get_module();
                                                       	while ($result=$query->fetch(PDO::FETCH_ASSOC)){
                                                                if($result['idProject']==$_GET['id']){ 
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
								<button type="button" class="TAB_btn11" onclick="open_tache(<?php echo $result['idModule']; ?>)" ><i class="fa fa-plus"></i> Ajouter une tache</button>
								<div class="TAB_2a11a<?php echo $result['idModule'];  ?> TAB_2a11ainput" >
									<form method="POST" class="form_tache<?php echo $result['idModule']; ?>">
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
                                                                                        echo '<script>window.location="index.php?module=utilisateur&action=tableaux_projets&id='.$_GET['id'].'"</script>';
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
                                                                        <button type="submit" onclick="post_tache(<?php echo $result['idModule']  ?>)" data-element="<?php echo $result['idModule'] ?>" id="TAB_btn11a" class="TAB_btn11a"> Publier</button>
								</form>
			</div>
								</div>
                                                        	</div>
							</div>
                                                                <?php }}} ?>
							</div>                              
					
						
					</div>
					<div class="TAB_box2b">
                                            
                                            
					<h3> En cours</h3>
					<div class="TAB_box2a1">
                                                       	<?php
                                                        if(isset($_GET['id'])){ 
                                                       	$query=get_module();
                                                       	while ($result=$query->fetch(PDO::FETCH_ASSOC)){
                                                                if($result['idProject']==$_GET['id'] && $result['Statut']==1){ 
                                                       	 ?>
                                                        <div class="TAB_2a111">
                                                        	<p class="TAB_para" onclick="afficher2(<?php echo $result['idModule']?>);" id="<?php echo $result['idModule']?>">
                                                        		<?php echo $result['Nom_Module']; ?></p>
                                                        	<div class="TAB_2a1111" id="<?php echo $result['idModule'].'d'; ?>">
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
                                                            
						
                                                                    <br><strong><label>Tâches en cours :</label></strong>	
                        <div>	
                                <?php
                                	$tache= get_tache();
                                       	while ($tache_result=$tache->fetch(PDO::FETCH_ASSOC)){
                                                if($tache_result['idModule']==$result['idModule'] && $tache_result['Statut']==1){ 
                                ?>
                                <div class="TAB_2a111" id="TAB_2a111">
                                <p class="TAB_para"  onclick="affiche(<?php echo $tache_result['idTache']?>);" id="<?php echo $tache_result['idTache']?>">
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
                                                                          <input type="hidden" name="idModule_Fin" value="<?php echo $result['idModule']?>">
                                                                          <input type="hidden" name="idTache_Fin" value="<?php echo $tache_result['idTache']?>">
                                                                          <button type="submit" class="TAB_btn">
                                                                              Terminer
                                                                          </button>
                                                                      </form>
                                                                    </div>
                            </div>    </div><?php }}?>
								</div>
                                                        	</div>
							</div>
                                                                <?php }}} ?>
						</div>
					
							
					</div>
					<div class="TAB_box2c">
					<h3> Terminé</h3>
					<div class="TAB_box2a1">
                                                       	<?php
                                                        if(isset($_GET['id'])){ 
                                                       	$query=get_module();
                                                       	while ($result=$query->fetch(PDO::FETCH_ASSOC)){
                                                                if($result['idProject']==$_GET['id'] && $result['Statut']>0){ 
                                                       	 ?>
                                                        <div class="TAB_2a111">
                                                        	<p class="TAB_para" onclick="afficher3(<?php echo $result['idModule']?>);" id="<?php echo $result['idModule']?>">
                                                        		<?php echo $result['Nom_Module']; ?></p>
                                                        	<div class="TAB_2a1111" id="<?php echo $result['idModule'].'a'; ?>">
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
                                                            
						
                                                                    <br><strong><label>Tâches terminées :</label> </strong>	
                        <div>	
                                <?php
                                	$tache= get_tache();
                                       	while ($tache_result=$tache->fetch(PDO::FETCH_ASSOC)){
                                                if($tache_result['idModule']==$result['idModule'] && $tache_result['Statut']==2){ 
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
                                                                    </div>
                            </div>    </div><?php }}?>
								</div>
                                                        	</div>
							</div>
                                                                <?php }}} ?>
						</div>
				
			</div>

		</div>
        </div>
                </div>
            </div>
        </body>
            <script type="text/javascript">
/*function post_tache(idmodule)
{
            var isValid = true;
                //var idbtn =  $(this).attr('data-element');
                /*var idmodule=$('#idmodule'+).val();*/
//data = $form.serialize() + '&' + $.param(data);
           /* var form=$(".form_tache"+idmodule).serialize();
            var nom_tache = $(".nom-tache").val();
            if (nom_tache == "")
             {
                $(".nom_tache").css('border', '#fb0505 1px solid');

            }
            else
            {
            alert(form);

               $.ajax(
               {
                type:'post',
                url:'traitement ajax/traitement_tache.php',
                data: form,
                success: function(reponse){
                $('#TAB_2a111').html(reponse);
                $('.TAB_2a1111').show();

                
                }

               });
    } 
}*/
      function open_tache(idmodule2){

    $('.TAB_2a11a'+idmodule2).toggle(300);
}
        $(document).ready(function(){

           

           /* $('#TAB_btn2').click(function(){
                var isValid = true;

        var form=$("#form_module").serialize();
        var titre=$(".TAB_input").val();
        var text=$(".msg_module").val();

          if (titre == "" && text=="") {
              $(".TAB_input").css('border', '#fb0505 1px solid');
              $(".msg_module").css('border', '#fb0505 1px solid');

              isValid = false;
          }else{
                   $.ajax({
                    type:'post',
                    url:'traitement ajax/traitement_module_send.php',
                    data: form,
                    success: function(reponse){
                        $('#TAB_2a111').html(reponse);
                        $('#form_module').hide(500);
                        $('.TAB_btn1').show(100);
                        $(".TAB_input").val('');
                       // $(".chk_module").prop("checked") == false;
                        $(".msg_module").val(''); 

                    }
                   });
          } 
       
            });*/


              }); 

        </script>