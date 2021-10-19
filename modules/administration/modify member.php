
<?php 
 
 if(isset($_GET['id'])){
  $result= get_user_by_id($_GET['id']);
}

 ?>


            <?php if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['login']) && !empty($_POST['tel']) && !empty($_POST['mail']) && !empty($_POST['mdp']) && !empty($_POST['role']) && !empty($_POST['loc'])){

          $resultat = edit_utilisateur($_POST['nom'],$_POST['prenom'],$_POST['login'],$_POST['tel'],$_POST['mail'],$_POST['mdp'],$_POST['role'],$_POST['loc'],$_GET['id']);

          if($resultat){


            
              echo "<script>
                   window.location = 'index.php?module=administration&action=liste user';
              </script>";
             
          }else{
             echo "Echec de modification";
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

 <div class="m_bo">
            
            <h2 style="text-align: center;">Modifier les informations du personnel de seinova</h2>
            

        <div class="i_box">
           <form method="POST" class="i_form">
            <span id="i_error">Veuillez remplir tous les champs</span>
            <div class="i_box1">
                <label>Nom</label><br>
            <input type="text" name="nom" placeholder="Nom" id="nom" class="nom" value="<?php echo $result['Nom_utilisateur']?>"><br><br>
            <label>Prenom</label><br>
            <input type="text" name="prenom"  placeholder="Prenom" id="prenom" class="prenom" value="<?php echo $result['Prenom_utilisateur']?>"><br><br>
             <label>Nom d'Utilisateur</label>
            <input type="text" name="login"  placeholder="Nom d'Utilisateur" id="login" class="login" value="<?php echo $result['Login']?>"><br><br>
             <label>numero de Telephone</label>
             <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"  name="tel" placeholder="Telephone" class="tel" value="<?php echo $result['telephone']?>">
            </div>

            <div class="i_box2">
             <label>Email</label><br>
             <input type="email" name="mail"  placeholder="Email" id="mail" class="mail" value="<?php echo $result['mail']?>" ><br><br>
                  <label>Mot de passe</label><br>
            <input type="password" name="mdp"  placeholder="Mot de passe" id="mdp" class="mdp" value="<?php echo $result['MDP']?>"><br><br>
                 <label>Role</label><br>
            <select name="role" id="role" class="role">
                <option value="1">Utilisateur</option>
                 <option value="2">Administrateur</option>
                  <option value="3">Bloqué</option>

            </select><br><br>
                 <label>localite</label><br>
            <input type="text" name="loc" class="loc" placeholder="localite" value="<?php echo $result['localite']?>"><br><br>
            </div>
            <!--<input type="hidden" name="id" value="<?php echo $result['id'];?>">-->
            <button type="submit" name="submit" value="Valider les informations" id="i_btn">Valider les informations</button>
            </form> 
          </div>  
        </div>
		</div>
        </div>
    </body>