

<div class="container-general container-projet">
    <div class="M_wrapper-menu ">
     <?php include  "include/menu.php" ?>
    </div>
    <div class="container-content container-contenu">


<div class="h_box1">
      <a href="index.php?module=administration&action=historique connexion user">
<i class="fa fa-arrow-left"></i></a>
      <h2>Historique de Connexion de M. <?php
             $query3=get_user_by_id($_GET['id']); echo $query3['Nom_utilisateur'].' ';  echo $query3['Prenom_utilisateur'] ; ?></h2>
       <div class="h_box1a">
       <table>
    

        <tr class="h_td2">
         
            <td >Date connexion</td>
         
           
            <td>Date de deconnexion</td>
            
             </tr>
            <?php 
 
            $query2=get_all_online2($_GET['id']);

            while($result2=$query2->fetch(PDO::FETCH_ASSOC)){
            $date_chaine = date_format(date_create($result2['date_connexion']),"d/m/Y h:i:s");
            $date_chaine2 = date_format(date_create($result2['date_deconnexion']),"d/m/Y h:i:s");
          
           ?>  
        
         <tr>
          <?php if($result2['date_deconnexion'] == ""){ ?>
                   <td><?php echo $date_chaine; ?></td>
                    <td><?php echo " En ligne"; ?></td>
                 <?php }else{ ?>
                   <td><?php echo $date_chaine; ?></td>
                   <td><?php echo $date_chaine2; ?></td>
                 <?php } ?>
            
         </tr>
        <?php }?>
       </table>
      </div>
     </div>
     </div>
    </div>    
</div>