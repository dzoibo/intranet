
 
<?php 
session_start();

include "./include/config.php";
include "./modele/modele.php";
include "./modele/modele3.php";
include "./modele/modele2.php";
include "./modele/modele4.php";
 include 'include/header.php';


 if(!isset($_SESSION['idUser'])){

    echo "<script>
                   window.location = 'modules/connexion.php';
              </script>"; 


 }
// Si un module est specifié, on regarde s'il existe
if (!empty($_GET['module'])) {

  $module = dirname(__FILE__).'/modules/'.$_GET['module'].'/';
  
  // Si l'action est specifiée, on l'utilise, sinon, on tente une action par défaut
  $action = (!empty($_GET['action'])) ? $_GET['action'].'.php' : 'index.php';
  
  // Si l'action existe, on l'exécute
  if (is_file($module.$action)) {

    include $module.$action;

  // Sinon, on affiche la page d'accueil !
  } else {

    include 'include/accueil.php';
  }

// Module non specifié ou invalide ? On affiche la page d'accueil !
} else {

  include 'include/accueil.php';
}



include 'include/footer.php';
?>