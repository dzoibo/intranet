<?php  
if(isset($_GET['id'])){
  $result= get_client_by_id($_GET['id']);
}
  if(isset($_GET['idprojet'])){
    $result2= get_client_projet_by_id($_GET['idprojet']);
}

$result3=get_rencontre_projet_by_idclient($result['idClient'],$result2['id']);
if(isset($_GET['idprojet'])){
$req=update_projet_statut_valide($_GET['idprojet']);
    
}
 ?>
 <body>
  <?= $content ?>
 <div class="container-general container-projet">
    <div class="M_wrapper-menu ">
     <?php include  "include/menu.php" ?>
    </div>
    <div class="container-content container-contenu">
        <div class="AC_container1-global">
            <div class="AC_container1-form pro_val_container1_form">
                <div class="AC_container1-form-box1 pro_val_container1">
                    <form method="post" action="" id="AC_form_valide">

                        <input type="text" name="nom_client" class="AC_name tail_input-np" value="<?php echo $result['Nom_client']; ?>" disabled>
                        <input type="mail" name="adresse_client" class="AC_mail tail_input-np" value="<?php echo $result['Adresse']; ?>" disabled>
                        <input type="text" name="nom_entreprise" class="AC_entreprise tail_input" value="<?php echo $result['Entreprise']; ?>" disabled>
                        <input type="text" name="tel_client" class="AC_tel tail_input" value="<?php echo $result['Telephone']; ?>" disabled>
                        <input type="text" name="loc_client" class="AC_loc tail_input" value="<?php echo $result['Localisation']; ?>" disabled>
                        <select name="langue_client" class="AC_langue tail_input" disabled >
                            <option ><?php echo $result['Langue']; ?></option>  
                        </select>
                       <input type="text" name="nom_client" class="AC_name tail_input-np" value="Nom du projet:  <?php echo $result2['nom_projet']; ?>" disabled>
                       <input type="text" name="nom_client" class="AC_name tail_input-np" value="Montant:  <?php echo $result2['Somme']; ?>" disabled>

                    </form>
                </div>
                <div class="box_gagne">
                   <p>Gagné</p>
                </div>
                <div class="AC_container1-form-box2">
                    <div class="p-AC_form_info">
                        <?php if($result2['etat_projet']=="non commence") {?>
                        <a href="index.php?module=administration&action=ajout_projet&idclient=<?php echo $_GET['id'] ?>&idprojet=<?php echo $_GET['idprojet']?>"><button type="submit"name="btn-valide-projet-client" >Commencer le projet</button></a>
                    <?php }else{ ?>
                        <button style="cursor: inherit;" >Ce projet a deja été commencé!!!</button>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
</body>