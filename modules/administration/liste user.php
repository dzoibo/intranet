

 <?php 
if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['login']) && isset($_POST['mail']) && isset($_POST['mdp']) && isset($_POST['role'])){

    $resultat = inscription_membres($_POST['nom'],$_POST['prenom'],$_POST['login'],$_POST['tel'],$_POST['mail'],$_POST['mdp'],$_POST['role'],$_POST['loc'] );
          if($resultat){
            
echo "<script>
                   window.location = 'index.php?module=administration&action=liste user';
              </script>"; 
     }else{

    }
  }


if(isset($_GET['id'])){

          $resultat = delete_utilisateur($_GET['id']);
          if($resultat){

              echo "<script>
                   window.location = 'index.php?module=administration&action=liste user';
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
         <div class="ge_box"> 
        <div class="ge_boxx">
        <div class="ge_boxa ge_box_color">
            <a href="index.php?module=administration&action=liste user" class="ge_lien1">Comptes des Utilisateurs</a>
             </div> 
             <div class="ge_boxb">
            <a href="index.php?module=administration&action=historique connexion user" class="ge_lien1">Historique de connexion</a>
          </div>
        </div>
                <h2 class="ge_lienb">Liste contenant tous les informations du personnel de l'entreprise</h2>
                
                <div class="ge_box1">
            
                    <table id="example" class="display" style="width:100%">

                    <thead>
                <tr class="ge_ligne0">
                  <td>Photo</td>
                    <td>Nom</td>
                    <td>Prenom</td>
                    <td>Email</td>
                    <td>Login</td>
                    <td>Role</td>
                    <td>Option</td>
                </tr>
            </thead>
          <?php 
          $query= get_all_utilisateur();
          
          while($result=$query->fetch(PDO::FETCH_ASSOC)){
            
             $query2=  get_user_by_type_user($result['Role']);
          
          
           ?>
                <tr>
                  <td><div class="ge_photo">
                    <?php show_user($result['idUtilisateur']); ?>
                  </div></td>
                    <td><?php echo $result['Nom_utilisateur']; ?></td>
                    <td><?php echo $result['Prenom_utilisateur']; ?></td>
                    <td><?php echo $result['mail'];  ?></td>
                    <td><?php echo $result['Login'];  ?></td>
                    <td><?php echo $query2['nom_type_user'];  ?></td>
                    <td class="ge_ligne"><div class="ge_ligne1"> 
                    <a href="index.php?module=administration&action=modify member&id=<?php echo $result['idUtilisateur']; ?>"><i class="fa fa-pen-alt"></i></a>
                </div>
                <div class="ge_ligne2">
                  <a href="index.php?module=administration&action=liste user&id=<?php echo $result['idUtilisateur']; ?>"><i class="far fa-trash-alt"  ></i></a>
                </div></td>

                </tr>
              <?php }?>  
        </table>
    </div>  
            
            <div class="ge_box2">
                
                <button class="ge_btn">Ajouter un personnel &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span ><i class="fa fa-plus"></i></span></button>
                
            </div>
            </div>
            
<script type="text/javascript">
    $(document).ready(function() {

  
    var table = $('#example').DataTable();
     
    var btn=$('.ge_btn');
btn.click(function(){
    $('.ge_box').css('display','none');
    $('.i_bo').show(500);

});
    /*$('#example tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        alert( 'Votre nom est '+data[0]+'' );
   } );*/
   } ); 
     </script>
  


         <div class="i_bo">
           <a href="index.php?module=administration&action=liste user
           ">
<i class="fa fa-arrow-left"></i></a>
            
            <h2 style="text-align:center;"> Enregistrement des personnels de l'entreprise</h2>
            

        <div class="i_box">
           <form method="POST" class="i_form" onsubmit="return validate()">
            <span id="i_error">Veuillez remplir tous les champs</span>
            <div class="i_box1">
                <label>Nom</label><br>
            <input type="text" name="nom" placeholder="Nom" id="nom" class="nom"><br><br>
            <label>Prenom</label><br>
            <input type="text" name="prenom"  placeholder="Prenom" id="prenom" class="prenom"><br><br>
             <label>Nom d'Utilisateur</label>
            <input type="text" name="login"  placeholder="Nom d'Utilisateur" id="login" class="login"><br><br>
             <label>numero de Telephone</label>
            <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"  name="tel" placeholder="Telephone" class="tel" id="tel">
            </div>

            <div class="i_box2">
             <label>Email</label><br>
             <input type="email" name="mail"  placeholder="Email" id="mail" class="mail" ><br><br>
                  <label>Mot de passe</label><br>
            <input type="password" name="mdp"  placeholder="Mot de passe" id="mdp" class="mdp"><br><br>
                 <label>Role</label><br>
            <select name="role" id="role" class="role">
                <option value="1">Utilisateur</option>
                 <option value="2">Administrateur</option>
            </select><br><br>
                 <label>localite</label><br>
            <input type="text" name="loc" class="loc" placeholder="localite" id="loc"><br><br>
            </div>
            <input name="submit" type="submit"  value="Valider les informations" class="contact-btn" id="i_btn">

            </form> 
          </div>  
        </div>
        </div>
           </div> 
       </body>
           <script type="text/javascript">
               function validateform() {
                   var isValid = true;

                   var nom = $("#nom").val();
                   var prenom = $("#prenom").val();
                   var login = $("#login").val();
                   var tel = $("#tel").val();
                   var mail = $("#mail").val();
                   var mdp = $("#mdp").val();
                   var loc = $("#loc").val();
                   var role = $("#role").val();

                   if (nom == "") {
                       $("#nom").css('border', '#fb0505 1px solid');
                       isValid = false;
                   }
                   if (prenom == "") {
                       $("#prenom").css('border', '#fb0505 1px solid');
                       isValid = false;
                   }
                 
                   if (tel == "") {
                       $("#tel").css('border', '#fb0505 1px solid');
                       isValid = false;
                   }
                   if (mdp == "") {
                       $("#mdp").css('border', '#fb0505 1px solid');
                       isValid = false;
                   }
                   if (login == "") {
                       $("#login").css('border', '#fb0505 1px solid');
                       isValid = false;
                   }
                   if (!mail.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
                       $("#info").html("(Adresse email non valide)");
                       $("#mail").css('border', '#fb0505 1px solid');
                       isValid = false;
                   }
                   if (loc == "") {
                       $("#loc").css('border', '#fb0505 1px solid');
                       isValid = false;
                   }
                   if (role == "") {
                       $("#role").css('border', '#fb0505 1px solid');
                       isValid = false;
                   }
                   return isValid;
               }

           </script>