 <?php
 session_start();
include "../include/config.php";
include "../modele/modele.php";
 if(isset($_SESSION['idUser'])){

    echo "<script>
                   window.location = '../index.php';
              </script>"; 


 }
 $message="";
 $message2="";

 if(!isset($_SESSION['idUser']))
 {
  if(isset($_POST['C_user']) && isset($_POST['C_mdp']))
  {
    if(!empty($_POST['C_user']) && !empty($_POST['C_mdp']))
    {
      
          $resultat = test_login($_POST['C_user'],$_POST['C_mdp']);

          if($resultat)
          {
              $ip = getIp();
              $_SESSION['statut'] = $resultat['Statut_utilisateur'];


              
              if($_SESSION['statut'] /*== "offline"*/)
              {

                  $_SESSION['Role'] = $resultat['Role'];
                  $_SESSION['statut_supp'] = $resultat['Statut_suppression'];

                  if($_SESSION['statut_supp']=="")
                  {
                          if(!empty($_SESSION['Role']) && $_SESSION['Role'] <= 2  )
                          {

                              
                            $_SESSION['nom'] = $resultat['Nom_utilisateur'];
                            $_SESSION['prenom'] = $resultat['Prenom_utilisateur'];
                            $_SESSION['idUser'] = $resultat['idUtilisateur'];
                            $_SESSION['Login'] = $resultat['Login'];
                            $_SESSION['Login'] = $ip;

                           

                            $date = date("Y-m-d h:i:s");
                            add_online($ip, $date);
                            $result = statut_changed("online",$_SESSION['idUser']);
                            echo "<script>
                                 window.location = '../index.php';
                            </script>"; 
                            
                          }
                          else
                          {
                             $message="Desolé vous n'avez plus accés à cette application ";
                          }
                   }
                   else
                   {
                    $message="Votre compte a été supprimé, veuillez vous renseigner chez l'administrateur";

                   }
              } 
              /*else
              {
                       $message="L'utilisateur est déjà connecté! Bien vouloir vous connecter avec votre compte";

                        unset($_SESSION['nom']);
                        unset($_SESSION['idUser']);
                        unset($_SESSION['Login']);
              }*/
                   
             
          }
          else
          {
              $message= "<p class='C_error2'>Mot de passe ou login incorrect</p>";
             unset($_SESSION['nom']);
             unset($_SESSION['idUser']);
             unset($_SESSION['Login']);
          }

    }
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Connexion</title>
        <link rel="stylesheet" type="text/css" href="../assets/CSS/all.css">
  <meta name="viewport" content="width-device-width, initial-scale=1.0">
       <link rel="stylesheet" type="text/css" href="../assets/CSS/mobile.css">
        <link rel="stylesheet" type="text/css" href="../assets/CSS/tablette.css">
            <link rel="stylesheet" type="text/css" href="../assets/CSS/tablette2.css">
        <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
        <script type="text/javascript" src="../assets/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="../assets/js/connexion.js"></script>
</head>
<body class="C_all">
<div class="C_container">
  
  <div class="C_first">
            <img src="../assets/Images/LOGO-1.png">
  </div>
  <div class="C_block0">
    <span class="C_error"><?php echo $message; ?></span>

    <div  id="C_error">
      Veuillez remplir toutes vos coordonnées
    </div>

    <div class="C_block1">
      
                    <form class="C_formulaire" method="POST">
        <div class="C_p1">
          <h1 class="C_login">
            Login
          </h1>
        </div><br/>
        <div class="C_user">
          <input type="text" name="C_user" id="C_user" class="C_user" placeholder="Nom d'utilisateur"><br/>
          <i class="fa fa-user"></i>
        </div><br/>
        <div class="C_lock">
          <input type="password" name="C_mdp" id="mdp" class="C_mdp" placeholder="Mot de passe"><br/>
          <i class="fa fa-lock"></i>
        </div><br/><br/>
          <input type="submit" name="submit" id="submit" class="C_submit">
      </form>
    </div>
  </div>
</div>
</body>
</html>