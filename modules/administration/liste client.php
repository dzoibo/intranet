<?php 
if(isset($_GET['id'])){

          $resultat = delete_client($_GET['id']);
          if($resultat){

              echo "<script>
                   window.location = 'index.php?module=administration&action=liste client';
              </script>"; 
             
          }else{
             echo "Echec de la Suppression";
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
      <div class="LC_box">

        <h2><a href="index.php?module=administration&action=liste client"  >Listes des clients</a></h2>
        
        
        <div class="LC2_box1">
           <?php 
           
                   $query=get_client();
                   while($result=$query->fetch(PDO::FETCH_ASSOC)){
                     ?>
                    <?php if(!empty($_SESSION['Role']) && $_SESSION['Role'] ==2  ){ ?>
               <div class="LC2_box1a">

                <a href="index.php?module=administration&action=devis client&id=<?php echo $result['idClient']; ?>"><?php echo $result['Nom_client']; ?></a> 

               </div>

               <div class="LC2_box1a_option">
                 Enregistré(e) le <?php echo $result['date_client']; ?>
               </div>

                       <div class="LC_box1a1">  
                         <a href="index.php?module=administration&action=modifier_client&id=<?php echo $result['idClient']?>"> <button>Modifier <i class="fa fa-pen-alt"></i>  </button></a>
                       </div>
                              
                             
                       <div class="LC_box1a2">
                         <button onclick="delete_client();" name="LC_btn_supp_client"><a href="index.php?module=administration&action=liste client&id=<?php echo $result['idClient']?>">Supprimer<i class="far fa-trash-alt"></i></a></button>
                               </div>
               <?php }else{ ?>
                      <div class="LC2_box1a" style="width:80%; color: white;">

                          <?php echo $result['Nom_client']; ?> 

                      </div>     
              <?php }} ?>              
      </div>
      <?php if(!empty($_SESSION['Role']) && $_SESSION['Role'] ==2  ){ ?>

         <div class="LC_box1b">
           <a href="index.php?module=administration&action=ajout_client"><button class="LC_btn">Ajouter un Client <span class="PRO_eq"><i class="fa fa-plus"></i></span></button></a>
         </div>
       <?php } ?>
      </div>
</div>
</div>

    <script>
      function toggel(para){
        var p = "#" + para + "b";
        $(p).toggle();
    }
    function delete_client(){
      if(!confirm("voulez vous vraiment le Supprimer???")){
        event.preventDefault();
      }
    }
    </script>