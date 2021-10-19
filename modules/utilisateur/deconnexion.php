 <?php
 $result = statut_changed("offline",$_SESSION['idUser']);
                    $date = date("Y-m-d h:i:s");
                    update_online($_SESSION['idUser'], $date);
 $resulta = online_changed(0,$_SESSION['idUser']);
/*unset($_SESSION['nom']);
unset($_SESSION['idUser']);
unset($_SESSION['Login']);
 session_unset();*/
 session_destroy();

echo "<script>
                   window.location = 'index.php';
              </script>"; 

?>

