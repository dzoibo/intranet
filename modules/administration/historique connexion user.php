

<div class="container-general container-projet">
    <div class="M_wrapper-menu ">
     <?php include  "include/menu.php" ?>
    </div>
    <div class="container-content container-contenu">
    <div class="ge_box" >
       <div class="ge_boxx">
            <div class="ge_boxa">  
           <a href="index.php?module=administration&action=liste user" class="ge_lien1">Comptes des Utilisateurs</a>
             </div>
             <div class="ge_boxb ge_box_color">
             <a href="index.php?module=administration&action=historique connexion user" class="ge_lien1">Historique de connexion</a>
          </div>
        </div>
                <h2 class="ge_lienb" >Liste contenant toutes les historiques de connexion du personnel dans l'entreprise</h2>
                
                
                <div class="ge_box11" >
            
                
        <table id="example" class="display ge_box_historique"  >
            <thead>
                <tr class="ge_ligne0">
              <td >Role</td>
                <td>Login</td>
                    <td>Numero telephone</td>
                    <td>localite</td>
                    <td>date de connexion</td>
                    <td>date de deconnexion</td>
                    
                </tr>
            </thead>
          <?php 
          $query=get_all_user_online();
           
          while($result=$query->fetch(PDO::FETCH_ASSOC)){
            
            $query2=get_all_online($result['user_online']);
            while($result2=$query2->fetch(PDO::FETCH_ASSOC)){
            $date_chaine = date_format(date_create($result2['date_connexion']),"d/m/Y h:i:s");
            $date_chaine2 = date_format(date_create($result2['date_deconnexion']),"d/m/Y h:i:s");
            $query3=get_user_by_id($result['user_online']);
            $query4=get_user_by_type_user($query3['Role']);
           ?>
      
                <tr class="" id="ge_box_historique">
                    <td class="ge_ligne1"> <a href="index.php?module=administration&action=historique connexion user details&id=<?php echo $result['user_online']?>"><?php echo $query4['nom_type_user']; ?></a></td>
                   <td><?php echo $query3['Login'];  ?></td>
                    <td><?php echo $query3['telephone']; ?></td>
                    <td><?php echo $query3['localite'];  ?></td>
                   <?php if($query3['Statut_utilisateur'] == "offline"){ ?>
                   <td><?php echo $date_chaine; ?></td>
                   <td><?php echo $date_chaine2; ?></td>
                 <?php }else{ ?>
                   <td><?php echo $date_chaine; ?></td>
                    <td><?php echo " <strong> En Ligne </strong>"; ?></td>
                 <?php } ?>
                </tr>
          <?php }}?>     
        </table>

    </div>

            </div>
            
<script type="text/javascript">
    $(document).ready(function() {

  
    var table = $('#example').DataTable();
     
    /*$('#example tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        alert( 'Votre nom est '+data[0]+'' );
   } );*/
   } ); 
     </script>

    
     </div>
    </div>
</div>