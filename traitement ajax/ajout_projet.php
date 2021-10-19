<?php 
session_start();
include "../include/config.php";
include "../modele/modele.php";

    if(!empty($_POST['nom_projet'])&&!empty($_POST['debut_projet'])&&!empty($_POST['fin_projet'])){
    	echo $_POST['nom_projet'];
        $req=add_projet();

}
 ?>