<?php	
function test_login($login,$password){

   $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
   $query=$pdo->prepare('SELECT * FROM utilisateur WHERE login = :log and MDP = :pass ');
    

    $query->bindValue(":log",$login,PDO::PARAM_STR);
    $query->bindValue(":pass",$password,PDO::PARAM_STR);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}



function online_changed($statut,$idUser){

   $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
   $query=$pdo->prepare('UPDATE online SET statut_online = :statut WHERE user_online = :idUser');
    

    $query->bindValue(":statut",$statut,PDO::PARAM_INT);
    $query->bindValue(":idUser",$idUser,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
    
}



function statut_changed($statut,$idUser){

   $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
   $query=$pdo->prepare('UPDATE utilisateur SET Statut_utilisateur = :statut WHERE idUtilisateur = :idUser');
    

    $query->bindValue(":statut",$statut,PDO::PARAM_STR);
    $query->bindValue(":idUser",$idUser,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
    
}



function statut_tache_changed($statut,$idTache){

   $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
   $query=$pdo->prepare('UPDATE tache SET Statut = :statut WHERE idTache = :idTache');
    

    $query->bindValue(":statut",$statut,PDO::PARAM_INT);
    $query->bindValue(":idTache",$idTache,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
    
}



function statut_module_changed($statut,$idModule){

   $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
   $query=$pdo->prepare('UPDATE module SET Statut = :statut WHERE idModule = :idModule');
    

    $query->bindValue(":statut",$statut,PDO::PARAM_INT);
    $query->bindValue(":idModule",$idModule,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
    
}



function debut_module_changed($idModule){

   $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        
   $date = (string)date("Y-m-d h:i:s");
  
   $query=$pdo->prepare('UPDATE module SET Date_Debut = :date WHERE idModule = :idModule');
    

    $query->bindValue(":date",$date,PDO::PARAM_STR);
    $query->bindValue(":idModule",$idModule,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
    
}



function debut_tache_changed($idTache){

   $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        
   $date = (string)date("Y-m-d h:i:s");
  
   $query=$pdo->prepare('UPDATE tache SET Date_debut = :date WHERE idTache = :idTache');
    

    $query->bindValue(":date",$date,PDO::PARAM_STR);
    $query->bindValue(":idTache",$idTache,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
    
}



function get_client(){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM client WHERE Statut_client=" " order by idClient desc');

    $query->execute();

    return $query;
}



function get_rencontre_by_client($idClient){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM rencontre_has_client WHERE idClient = :idClient');

    $query->bindValue(":idClient",$idClient,PDO::PARAM_INT);

    $query->execute();

    return $query;
}
function get_rencontre_by_client2($id_project_client){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM rencontre WHERE id_project_client = :id_project_client');

    $query->bindValue(":id_project_client",$id_project_client,PDO::PARAM_INT);

    $query->execute();

    return $query;
}


function get_rencontre_by_id($id){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM rencontre WHERE idRencontre = :id');

    $query->bindValue(":id",$id,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}




function get_projet(){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM project where Statut="" order by idProject desc');

    $query->execute();

    return $query;
}




function get_module(){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM module order by idModule desc');

    $query->execute();

    return $query;
}




function get_module_by_id($idModule){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM module WHERE idModule = :idModule');

    $query->bindValue(":idModule",$idModule,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}



function get_module_by_project($idProject){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM module WHERE idProject = :idProject');

    $query->bindValue(":idProject",$idProject,PDO::PARAM_INT);

    $query->execute();


    return $query;
}



function get_tache(){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM tache');

    $query->execute();

    return $query;
}



function get_tache_by_id($idTache){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM tache WHERE idTache = :idTache');

    $query->bindValue(":idTache",$idTache,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}



function get_tache_by_module($idModule){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM tache WHERE idModule = :idModule ORDER BY Statut DESC');

    $query->bindValue(":idModule",$idModule,PDO::PARAM_INT);

    $query->execute();

    return $query;
}




function get_projet_by_id($id){
  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM project WHERE idProject = :id');
    

    $query->bindValue(":id",$id,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}





function get_equipe_by_id($id){
  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM equipe WHERE idEquipe = :id');
    

    $query->bindValue(":id",$id,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}



function get_client_by_id($id){
  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM client WHERE idClient = :id');
    

    $query->bindValue(":id",$id,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}


function add_client(){
  $date = (string)date("d/m/Y à h:i:s");

        $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        $req = $bdd->prepare('INSERT INTO client(Nom_client, Adresse, Entreprise, Telephone, Localisation,Langue,date_client) VALUES(:nom_client,
        :adresse, :entreprise, :telephone, :localisation,:langue,:date_client)');
        $req->execute(array(
        'nom_client' => $_POST['nom_client'],
        'adresse' => $_POST['adresse_client'],
        'entreprise' => $_POST['nom_entreprise'],
        'telephone' => $_POST['tel_client'],
        'localisation' => $_POST['loc_client'],
        'langue' => $_POST['langue_client'],
        'date_client' => $date

        ));
               
}
function projet_devis($nom_projet,$somme,$id_client,$upload){
$pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);

$query = $pdo->Prepare('INSERT INTO project_client (nom_projet,Somme, id_client,statut_projet,etat_projet,document) VALUES (:nom_projet, :somme,:id_client,0,:etat,:doc)');

  
  $query->bindValue(':nom_projet',$nom_projet, PDO::PARAM_STR);
  $query->bindValue(':somme',$somme, PDO::PARAM_STR);
 $query->bindValue(':id_client',$id_client, PDO::PARAM_INT);
 $query->bindValue(':etat',"non commence", PDO::PARAM_STR);
 $query->bindValue(':doc',$upload, PDO::PARAM_STR);
 
  $query->CloseCursor();

  if ($query->execute()) {
  
    return true;
           
  }
  return false;
  
}
function update_projet_statut_valide($id){
        $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        $query=$bdd->prepare('UPDATE project_client SET etat_projet = :etat_projet WHERE id = :id');


        $query->bindValue(":etat_projet","commence",PDO::PARAM_STR);
        $query->bindValue(":id",$id,PDO::PARAM_INT);

        $query->execute();


    return $query;
    
}
function get_client_by_porjet_devis($id){
  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM project_client WHERE id_client=:id and  statut_projet=0');
  
    $query->bindValue(":id",$id,PDO::PARAM_INT);

    $query->execute();

    return $query;
}
function get_client_by_porjet_devis1($id){
  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM project_client WHERE id_client=:id and  statut_projet=1');
  
    $query->bindValue(":id",$id,PDO::PARAM_INT);

    $query->execute();


    return $query;
}function get_client_by_porjet_devis2($id){
  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM project_client WHERE id_client=:id and  statut_projet=2');
  
    $query->bindValue(":id",$id,PDO::PARAM_INT);

    $query->execute();


    return $query;
}function get_client_by_porjet_devis3($id){
  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM project_client WHERE id_client=:id and  statut_projet=3');
  
    $query->bindValue(":id",$id,PDO::PARAM_INT);

    $query->execute();


    return $query;
}
function update_projet_statut($statut,$id){
        $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        $query=$bdd->prepare('UPDATE project_client SET statut_projet = :statut_projet WHERE id = :id');


        $query->bindValue(":statut_projet",$statut,PDO::PARAM_STR);
        $query->bindValue(":id",$id,PDO::PARAM_INT);

        $query->execute();


    return $query;
    
}
function add_rencontre($idClient,$document){

        $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        $date =date("Y-m-d");
        $heure = date("h:i:s");
        
        $req = $bdd->prepare('INSERT INTO rencontre(Date_Rencontre, Heure_Rencontre, Motif_Rencontre, Debouche_Rencontre,id_project_client,document) VALUES(:date_rencontre,
        :heure_rencontre, :motif_rencontre, :debouche_rencontre,:id_project_client,:document)');
        $req->execute(array(
        'date_rencontre' => $date,
        'heure_rencontre' => $heure,
        'motif_rencontre' => $_POST['motif_rencontre'],
        'debouche_rencontre' => $_POST['AC_area'],
        'id_project_client' => $_POST['id_projet'],
        'document'=>$document,

        ));
        
        $quer=$bdd->prepare('SELECT * FROM rencontre ORDER BY idRencontre DESC LIMIT 1');

        $quer->execute();

        $resulta = $quer->fetch(PDO::FETCH_ASSOC);
        $nbr = $resulta['idRencontre'];
        
                        $req = $bdd->prepare('INSERT INTO rencontre_has_client(idRencontre, idClient) VALUES(:idRencontre, :idClient)');
                        $req->execute(array(
                        'idRencontre' => $nbr,
                        'idClient' => $idClient,
                            ));

        
}
function get_rencontre_by_idclient_projet($id){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM project_client WHERE id = :id');

    $query->bindValue(":id",$id,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}


function add_online($ip, $date){
        $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        $req = $bdd->prepare('INSERT INTO online(ip_online, statut_online, user_online, date_connexion) VALUES(:ip,
        :statut, :user, :date)');
        $req->execute(array(
        'ip' => $ip,
        'statut' => 1,
        'user' => $_SESSION['idUser'],
        'date' => $date));
}


function update_online($id, $date){
        $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        $query=$bdd->prepare('UPDATE online SET date_deconnexion = :date, statut_online = :statut1 WHERE statut_online = :statut AND user_online = :id');


        $query->bindValue(":date",$date,PDO::PARAM_STR);
        $query->bindValue(":statut1",0,PDO::PARAM_INT);
        $query->bindValue(":statut",1,PDO::PARAM_INT);
        $query->bindValue(":id",$id,PDO::PARAM_INT);

        $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
    
}




function update_projet($id){
        $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        
        $date1 = (string)$_POST['debut_projet'];
    
        $date2 = (string)$_POST['fin_projet'];
    
        $query=$bdd->prepare('UPDATE project SET intutile = :nom_projet, date_debut = :debut_projet, date_fin = :fin_projet WHERE idProject = :id');


        $query->bindValue(":nom_projet", $_POST['nom_projet'],PDO::PARAM_STR);
        $query->bindValue(":debut_projet", $date1,PDO::PARAM_STR);
        $query->bindValue(":fin_projet", $date2,PDO::PARAM_STR);
        $query->bindValue(":id",$id,PDO::PARAM_INT);

        $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
    
}



function update_equipe($id){
        $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        $query=$bdd->prepare('UPDATE equipe SET Nom_equipe = :nom_equipe WHERE idEquipe = :id');


        $query->bindValue(":nom_equipe",$_POST['nom_equipe'],PDO::PARAM_STR);
        $query->bindValue(":id",$id,PDO::PARAM_INT);

        $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
    
}

function add_projet(){
    $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        
    $date1 = (string)$_POST['debut_projet'];
    
    $date2 = (string)$_POST['fin_projet'];
        
    $date = (string)date("d-m-Y à h:i:s");
    $date_enr = date("d/m/Y à h:i:s");

    $req = $bdd->prepare('INSERT INTO project(intutile, date_debut, date_fin, Utilisateur_idUtilisateur,id_client,date_enreg) VALUES(:nom_projet,
    :debut_projet, :fin_projet, :idUser,:id_client,:date_enreg)');
    $req->execute(array(
    'nom_projet' => $_POST['nom_projet'],
    'debut_projet' => $date1,
    'fin_projet' => $date2,
    'idUser' => $_SESSION['idUser'],
    'id_client' => $_POST['id_client'],
    'date_enreg' => $date_enr


));
     $quer=$bdd->prepare('SELECT MAX(idProject) as idProject FROM project ');

            $quer->execute();

            $resulta = $quer->fetch(PDO::FETCH_ASSOC);
            $idProject = $resulta['idProject'];
   
        add_notification("Projet", "a créé le projet ".$_POST['nom_projet'], $idProject,$_SESSION['idUser']);

                $query2=$bdd->prepare('SELECT notification FROM idNotification ORDER BY idNotification DESC');
               $query2->execute();
               $resultat2 = $query2->fetch(PDO::FETCH_ASSOC);
               $idNotification = $resultat2['idNotification'];
      $user = get_all_utilisateur();
      while ($recepteur = $user->fetch(PDO::FETCH_ASSOC))
      {
        if($recepteur['Role']!=2 or $recepteur['idUtilisateur']= $_SESSION['idUser'])// si le recepteur n'est pas administrateur ou s'il est le créateur de la notification on continue
        {
            continue;
        }
        else // dans le cas contraaire il peut récevoir la notification
        {
            add_notification_has_utilisateur($recepteur['idUtilisateur'],$idNotification,"non_lu");
        }
      }
}

function add_notification($type="", $contenu="", $idcontent, $idauteur){
    $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        
    $date = (string)date("Y-m-d h:i:s");
    
    
    $req = $bdd->prepare('INSERT INTO notification(typeNotification, contenuNotification, dateNotification, id_content, id_auteur) VALUES(:type,
    :contenu, :date, :idcontent, :idauteur)');
    $req->execute(array(
    'type' => $type,
    'contenu' => $contenu,
    'date' => $date,
    'idcontent' => $idcontent,
    'idauteur' => $idauteur
)); 
}
function add_notification_has_utilisateur($recepteur, $idnotif, $statut){
    $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD); 
    $req = $bdd->prepare('INSERT INTO notification_has_user(id_recepteur, id_notification, Statut) VALUES(:recepteur,
    :idnotif, :statut)');
    $req->execute(array
        (
            'recepteur' => $recepteur,
            'idnotif' => $idnotif,
            'statut' => $statut
            
        )); 
}
function Get_nbre_notification($id,$bdd)
{
    $nbre=$bdd->prepare('SELECT * from notification_has_user where id_recepteur=:id and statut!="lu"' );
    $nbre->bindValue("id",$id,PDO::PARAM_INT);
    $nbre->execute();

    if($nbre->rowCount())
    {
        return $nbre->rowCount();
    }
    else
    {
        return  "";
    }

}
function Get_notification($bdd,$idRec,$sizeNotif)
{
        if ($sizeNotif==2) 
        {
           $all_notif=$bdd->prepare('SELECT * FROM notification_has_user WHERE id_recepteur=:id ORDER by id_notification DESC');
        }
        else//on affiche que les dix premiéres notifications si c'est ce genre...
        {
            $all_notif=$bdd->prepare('SELECT * FROM notification_has_user WHERE id_recepteur=:id ORDER by Statut DESC limit 0,6');
        }

        $all_notif->bindValue(":id",$idRec,PDO::PARAM_INT);
        $all_notif->execute();

        while($all_notification=$all_notif->fetch())
        {
           $notif=$bdd->prepare('SELECT idNotification, typeNotification, contenuNotification, dateNotification, id_content, id_auteur,time (dateNotification) as heure , date (dateNotification) as jour FROM notification WHERE idNotification=:idnotif');
           $notif->bindValue(':idnotif',$all_notification['id_notification'],PDO::PARAM_INT);
           $notif->execute(); 
           $notif=$notif->fetch();
           $type=$notif['typeNotification'];
           $heure= Me_conversion_date($notif['jour']).' à '.substr($notif['heure'], 0,5);
           $statut=$all_notification['Statut'];
           $lien='';
           $icone='';


           switch ($type)
           {
                case 'message':
                    $icone='<i class="far fa-comments"></i>';
                    $lien= 'index.php?module=utilisateur&action=message&id_contact='.$notif['id_auteur'].'#ME_repere';     
                break;

                case 'sujet':

                    $sous_cat=$bdd->prepare('SELECT id_lng from sujet where id_sujet='.$notif['id_content']);
                    $sous_cat->execute();
                    $sous_cat=$sous_cat->fetch();
                    $icone='<i class="fas fa-users"></i>';
                    $lien= 'index.php?module=utilisateur&action=reponse&idLng='.$sous_cat['id_lng'].'& idSujet='.$notif['id_content'].'';     
                break;

                case 'reponse':
                    $sujet = $bdd->prepare('SELECT id_sujet from reponses where id_reponse='.$notif['id_content']);
                    $sujet->execute();
                    $sujet=$sujet->fetch();

                    $sous_cat=$bdd->prepare('SELECT id_lng from sujet where id_sujet='.$sujet['id_sujet']);
                    $sous_cat->execute();
                    $sous_cat=$sous_cat->fetch();

                    $icone='<i class="fas fa-users"></i>';
                    $lien= 'index.php?module=utilisateur&action=reponse&idLng='. $sous_cat['id_lng'].'&idSujet='.$sujet['id_sujet'];     
                break;

                case 'sous-categorie':
                    $icone='<i class="fas fa-users"></i>';
                    $lien= 'index.php?module=utilisateur&action=sujet&idLng='.$notif['id_content'].'';     
                break;

                case 'categorie':
                    $cat=$bdd->prepare('SELECT nom_cat from categorie where id_cat='.$notif['id_content']);
                    $cat->execute();
                    $cat=$cat->fetch();
                    $icone='<i class="fas fa-users"></i>';
                    $lien= 'index.php?module=utilisateur&action=forum&lienCat=fo_'.$cat['nom_cat'].'';
                break;

                case 'sujet resolu':
                    $icone='<i class="fas fa-users"></i>';
                    $lien= 'index.php?module=utilisateur&action=reponse&idLng='.$sous_cat['id_lng'].'& idSujet='.$notif['id_content'].'';    
                break;


                case 'rapport_eve':
                    $icone='<i class="far fa-file-pdf"></i>';
                    $lien= 'index.php?module=utilisateur&action=evenement&id_eve_rapport='.$notif['id_content'].'';     
                break;
                case 'projet':
                     $icone='<i class="fa fa-project-diagram"></i>';
                     $lien= 'index.php?module=utilisateur&action=projet';
                break;
                case 'equipe':
                     $icone='<i class="fa fa-project-diagram"></i>';
                     $lien= 'index.php?module=utilisateur&action=equipe';
                break;
               default:
                    $icone='<i class="far fa-calendar-alt"></i>';
                    $lien= 'index.php?module=utilisateur&action=evenement&id_eve='.$notif['id_content'].'';
               break;
           }
           if($sizeNotif==2)
           {
          echo'<div class="N_notification_list">
                  <a href="'.$lien.'" onclick="notif_lu ('.$notif['idNotification'].')">
                    <div class="N_box_pp">';
                        Me_show_user2($notif['id_auteur'],$bdd);
            echo       '<div class="N_box_pp_icon">'.$icone.'</div>
                    </div>
                    <div class="N_notification_info">
                      <div class="N_notification_information">
                        <strong> '. get_user($bdd,$notif['id_auteur']).' </strong> '.$notif['contenuNotification'].'
                      </div>
                    </div>
                    <div class="N_notification_date">
                      '.$heure.' <div class="N_notification_'.$statut.'" id ="notif_lu_'.$notif['idNotification'].'" onclick="notif_lu ('.$notif['idNotification'].')"     title="non lu"> </div>
                    </div>  
                  </a>
                </div>';
           }
           else
           {
            echo'<div class="H_notification_list">
                  <a href="'.$lien.'" onclick="notif_lu ('.$notif['idNotification'].')">
                    <div class="H_box_pp">';
                        Me_show_user2($notif['id_auteur'],$bdd);
            echo       '<div class="H_box_pp_icon">'.$icone.'</div>
                    </div>
                    <div class="H_notification_info">
                      <div class="H_notification_information">
                        <strong> '. get_user($bdd,$notif['id_auteur']).' </strong> '. CoupePhrase($notif['contenuNotification'],65).'
                      </div>
                    </div>       
                    <div class="H_notification_date">
                      '.$heure.' <div class="H_notification_'.$statut.'" onclick="notif_lu ('.$notif['idNotification'].')" id ="notif_lu_'.$notif['idNotification'].'" title="non lu"> </div>
                    </div>  
                  </a>
                </div>'; 
           }
          
        }
}
function get_rencontre_projet_by_id($idren){


  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM rencontre WHERE idRencontre = :id');

    $query->bindValue(":id",$idren,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result; 
}
function get_projet_by_idequipe($idequipe){


  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM project WHERE Equipe_idEquipe = :idequipe');

    $query->bindValue(":idequipe",$idequipe,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result; 
}
function get_rencontre_projet_by_idclient($idren,$id_client){


  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM rencontre WHERE idRencontre = :id and id_project_client=:id2');

    $query->bindValue(":id",$idren,PDO::PARAM_INT);
      $query->bindValue(":id2",$id_client,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result; 
}
function get_client_projet_by_id($idproject){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM project_client WHERE id = :id');
    

    $query->bindValue(":id",$idproject,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}
function get_rencontre_projet_by_idclient2($idproject,$id_client){


  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM project_client WHERE id = :idproject and id_client=:id_client');

      $query->bindValue(":idproject",$idproject,PDO::PARAM_INT);
      $query->bindValue(":id_client",$id_client,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result; 
}

function add_module($idProject){
    $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        
    $date1 = (string)date("Y-m-d h:i:s");
    
    $date2 = (string)$_POST['date_fin_module'];
    
    $req = $bdd->prepare('INSERT INTO module(Nom_Module, Date_creation, Date_Fin, idProject, Description_Module) VALUES(:nom_module,
    :creation_module, :fin_module, :idProject, :description_module)');
    $req->execute(array(
    'nom_module' => $_POST['nom_module'],
    'creation_module' => $date1,
    'fin_module' => $date2,
    'idProject' => $idProject,
    'description_module' => $_POST['description_module']
));   
           $queri=$bdd->prepare('SELECT idModule FROM module ORDER BY idModule DESC');

            $queri->execute();

            $result = $queri->fetch(PDO::FETCH_ASSOC);
            $nbre = $result['idModule'];         
            if(!empty($_POST['chek'])){
                foreach($_POST['chek'] as $chek){
                        $req = $bdd->prepare('INSERT INTO participants_module(idModule, idParticipant) VALUES(:idModule, :idUser)');
                        $req->execute(array(
                        'idModule' => $nbre,
                        'idUser' => $chek
                ));}
                }
}


function add_tache($idModule){
    $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        
    $date1 = (string)date("Y-m-d h:i:s");
    
    $date2 = (string)$_POST['date_fin_tache'];
    
    $req = $bdd->prepare('INSERT INTO tache(Nom_tache, Date_creation, Date_Fin, idModule, idParticipant) VALUES(:nom_tache,
    :creation_tache, :fin_tache, :idModule, :idUser)');
    $req->execute(array(
    'nom_tache' => $_POST['nom_tache'],
    'creation_tache' => $date1,
    'fin_tache' => $date2,
    'idModule' => $idModule,
    'idUser' => $_POST['participant_tache']
));
  
}

function conversion_date2($date)
    {
        if($date==date('d-m-Y',time()-3600*24))
        {
          return "Hier";
        }
        elseif ($date==date('d-m-Y') )
        {
          return "Aujourd'hui";
        }
        else
        {
          list($day, $month, $year) = explode("-", $date);

        $months = array("Jan", "Fev", "Mars", "Avr", "Mai", "Juin",
          "Juil", "Août", "Sept", "Oct", "Nov", "Dec");

          return "". $day." ".$months[$month-1]." ".$year;// ajouter ceci si on veut aussi afficher les heures." à ".$hour."h".$min."min"
        }
         
    }
function add_equipe(){
    
    $date = (string)date("d-m-Y à h:i:s");
    
           $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
    
           $quer=$bdd->prepare('SELECT idProject FROM project ORDER BY idProject DESC');

            $quer->execute();

            $resulta = $quer->fetch(PDO::FETCH_ASSOC);
            $nbr = $resulta['idProject'];
            $req = $bdd->prepare('INSERT INTO equipe(Nom_Equipe) VALUES(:nom_equipe)');
            $req->execute(array(
                'nom_equipe' => $_POST['nom_equipe'],
            ));
           $queri=$bdd->prepare('SELECT idEquipe FROM equipe ORDER BY idEquipe DESC LIMIT 1');

            $queri->execute();

            $result = $queri->fetch(PDO::FETCH_ASSOC);
            $nbre = $result['idEquipe'];
            
            $query=$bdd->prepare('UPDATE project SET Equipe_idEquipe = :idEquipe WHERE idProject = :idProject');
            
            $query->bindValue(":idEquipe",$nbre,PDO::PARAM_INT);
            $query->bindValue(":idProject",$nbr,PDO::PARAM_INT);


            $query->execute();

            $resultat = $query->fetch(PDO::FETCH_ASSOC);


             add_notification("Equipe", "Vous a ajouté à une nouvelle équipe",$nbre, $_SESSION['idUser']);

                            $quer=$bdd->prepare('SELECT idNotification  FROM notification ORDER BY idNotification DESC');
                                   $quer->execute();
                                   $resulta = $quer->fetch(PDO::FETCH_ASSOC);
                                   $idNotification = $resulta['idNotification'];
            if(!empty($_POST['chk'])){
                foreach($_POST['chk'] as $chk){
                        $req = $bdd->prepare('INSERT INTO equipe_has_utilisateur(Equipe_idEquipe, Utilisateur_idUtilisateur) VALUES(:idEquipe, :idUser)');
                        $req->execute(array(
                        'idEquipe' => $nbre,
                        'idUser' => $chk
                            ));
                            add_notification_has_utilisateur($chk,$idNotification,"non_lu");
                                   
                }
                    
        echo "<script>
                   window.location = './index.php?module=utilisateur&action=projet_accueil';
              </script>"; 
            }
}





function get_user_by_equipe($id){
  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT Utilisateur_idUtilisateur FROM equipe_has_utilisateur WHERE Equipe_idEquipe = :id');
    

    $query->bindValue(":id",$id,PDO::PARAM_INT);

    $query->execute();


    return $query;
}


function get_user_by_module($id){
  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT idParticipant FROM participants_module WHERE idModule = :id');
    

    $query->bindValue(":id",$id,PDO::PARAM_INT);

    $query->execute();


    return $query;
}


function get_user_by_tache($id){
  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT idParticipant FROM tache WHERE idTache = :id');
    

    $query->bindValue(":id",$id,PDO::PARAM_INT);

    $query->execute();


    return $query;
}







function edit_client($nom,$adresse,$entreprise,$tel,$localisation,$langue,$id){
    $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
    $query = $pdo->prepare('UPDATE `client` SET `Nom_client` = ?, `Adresse` = ?, `Entreprise` = ?, `Telephone` = ?, `Localisation` = ?, `Langue` = ? WHERE `idClient` = ?');
    $query->execute(array(
        $nom,
        $adresse,
        $entreprise,
        $tel,
        $localisation,
        $langue,
        $id
    ));
    if($query -> execute()){
      return true;
    } else{
      return false;
    }
}



function delete_client($id){
  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
  $query=$pdo->prepare('UPDATE client set Statut_client="supprimer" WHERE idClient = :id');
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    if ($query->execute()) {
  
    return true;
  }
  return false;
  
}

function delete_projet($id){

 $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
  $query=$pdo->prepare('UPDATE project set Statut="supprimer" WHERE idProject = :id');
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    if ($query->execute()) {
  
    return true;
  }
  return false;
}

function delete_module($id){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
  $query=$pdo->prepare('DELETE from module WHERE idProject = :id');

        $query->bindValue(':id',$id,PDO::PARAM_INT);


        if($query->execute()){
  
        $query->CloseCursor(); 
    return true;
    
    }else{
    
    return false;
    
    }
}


function delete_module_participant($id){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
  $query=$pdo->prepare('DELETE from participants_module WHERE idModule = :id');

        $query->bindValue(':id',$id,PDO::PARAM_INT);


        if($query->execute()){
  
        $query->CloseCursor(); 
    return true;
    
    }else{
    
    return false;
    
    }
}



function delete_tache($id){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
  $query=$pdo->prepare('DELETE from tache WHERE idModule = :id');

        $query->bindValue(':id',$id,PDO::PARAM_INT);

$query->execute();
        if($query->execute()){
  
        $query->CloseCursor(); 
    return true;
    
    }else{
    
    return false;
    
    }
}


function delete_equipe_utiisateur($id){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
  $query=$pdo->prepare('DELETE from equipe_has_utilisateur WHERE Equipe_idEquipe = :id');

        $query->bindValue(':id',$id,PDO::PARAM_INT);


        if($query->execute()){
  
        $query->CloseCursor(); 
    return true;
    
    }else{
    
    return false;
    
    }
}



function delete_equipe($id){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
  $query=$pdo->prepare('DELETE from equipe WHERE idEquipe = :id');

        $query->bindValue(':id',$id,PDO::PARAM_INT);


        if($query->execute()){
  
        $query->CloseCursor(); 
    return true;
    
    }else{
    
    return false;
    
    }
}


function convert_date($date){
    $date = date_format(date_create($date),"d/m/Y");
    return $date;
}
                
function get_message(){
        $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        $result = $bdd->query('SELECT * FROM message');
        $nbr = $result->rowCount();
        $req = $bdd->prepare('INSERT INTO message(idMessage, contenu, Utilisateur_idUtilisateur) VALUES(:idMessage,
        :contenu, :idUtilisateur)');
        $req->execute(array(
        'idMessage' => $nbr,
        'contenu' => $_POST['ME_msg'],
        'idUtilisateur' => $_SESSION[idUser],
        ));
        }
        
        
function getIp(){
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    else return $_SERVER['REMOTE_ADDR'];
}

function inscription_membres($nom,$prenom,$login,$tel,$mail,$mdp,$role,$loc){

$pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);

$query = $pdo->Prepare('INSERT INTO utilisateur (idUtilisateur,Nom_utilisateur, Prenom_utilisateur,Login,mail,MDP,Role,telephone,localite) VALUES (NULL, :nom, :prenom,:login,:mail,:mdp,:role,:tel,:loc)');

  
  $query->bindValue(':nom',$nom, PDO::PARAM_STR);
 $query->bindValue(':prenom',$prenom, PDO::PARAM_STR);
 $query->bindValue(':login',$login, PDO::PARAM_STR);
  $query->bindValue(':mail',$mail, PDO::PARAM_STR);
 $query->bindValue(':mdp',$mdp, PDO::PARAM_STR);
 $query->bindValue(':role',$role, PDO::PARAM_STR);
  $query->bindValue(':tel',$tel, PDO::PARAM_STR);
 $query->bindValue(':loc',$loc, PDO::PARAM_STR);


  
  $query->CloseCursor();

  if ($query->execute()) {
  
    return true;
           
  }
  return false;
  
}

function get_user_by_id($id){
  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM utilisateur WHERE idUtilisateur = :id');
    

    $query->bindValue(":id",$id,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function get_all_utilisateur(){

    $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
   $query=$pdo->prepare('SELECT * FROM utilisateur WHERE Statut_suppression=" " order by Nom_utilisateur ');
    

    $query->execute();

    return $query;
}

function get_user_by_type_user($role){
  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT * FROM type_user WHERE  idType_user= :role');
    

    $query->bindValue(":role",$role,PDO::PARAM_INT);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}



function get_all_online($idUser){

    $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
   $query=$pdo->prepare('SELECT *  FROM online where user_online=:idUser order by idonline desc limit 1');
    
    $query->bindValue(":idUser",$idUser,PDO::PARAM_INT);

    $query->execute();

    return $query;
}
function get_all_online2($idUser){

    $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
   $query=$pdo->prepare('SELECT *  FROM online where user_online=:idUser order by idonline desc ');
    
    $query->bindValue(":idUser",$idUser,PDO::PARAM_INT);

    $query->execute();

    return $query;
}
function get_all_user_online(){

    $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
   $query=$pdo->prepare('SELECT  DISTINCT user_online  FROM online ');
    

    $query->execute();

    return $query;
}


function get_user_online($login){
  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
    $query=$pdo->prepare('SELECT DISTINCT * FROM utilisateur WHERE  idUtilisateur= :login');
    

    $query->bindValue(":login",$login,PDO::PARAM_INT);

    $query->execute();


    return $query;
}
function edit_utilisateur($nom,$prenom,$login,$tel,$mail,$mdp,$role,$loc,$id){
    $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
    $query = $pdo->prepare('UPDATE `utilisateur` SET `Nom_utilisateur` = :nom, `Prenom_utilisateur` = :prenom, `Login` = :login, `telephone` = :tel, `mail` = :mail, `MDP` = :mdp, `Role` = :role, `localite` = :loc WHERE `idUtilisateur` = :id');

   $query->bindValue(':nom',$nom, PDO::PARAM_STR);
 $query->bindValue(':prenom',$prenom, PDO::PARAM_STR);
 $query->bindValue(':login',$login, PDO::PARAM_STR);
 $query->bindValue(':tel',$tel, PDO::PARAM_INT);
 $query->bindValue(':mail',$mail, PDO::PARAM_STR);
 $query->bindValue(':mdp',$mdp, PDO::PARAM_STR);
 $query->bindValue(':role',$role, PDO::PARAM_INT);
 $query->bindValue(':loc',$loc, PDO::PARAM_STR);
 $query->bindValue(':id',$id, PDO::PARAM_STR);

  if ($query->execute()) {
  
    return true;
  }
  return false;
  
}



function delete_utilisateur($id){
  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
  $query=$pdo->prepare('UPDATE utilisateur set Statut_suppression="supprimer" WHERE idUtilisateur = :id');
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    if ($query->execute()) {
  
    return true;
  }
  return false;
  
}

 
function show_user($id)
{
  $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
	$donne=$bdd->query('SELECT * from utilisateur where idUtilisateur ='.$id);
	$PP=$donne->fetch();
	if($PP['Photo']=='')
	{
		echo '<div class="show_user_ico"><i class="fa fa-user-alt fa-3x"></i></div>';
	}
	else
	{
		echo '<img src ="'.$PP['Photo'].'" />';
	}
}


 
function show_user2($id,$class)
{
  $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
	$donne=$bdd->query('SELECT * from utilisateur where idUtilisateur ='.$id);
	$PP=$donne->fetch();
	if($PP['Photo']=='')
	{
		echo '<i class="fa fa-user-alt fa-3x"></i>';
	}
	else
	{
		echo '<img class='.$class.' src ="'.$PP['Photo'].'" />';
	}
}




function add_profil($id, $upload, $nom)
{
        $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);

  
              $im = imagecreatefromjpeg($upload);
              imagepng($im, "assets/Images/PP/pp.png");
              $im2 = imagecreatetruecolor(130, 130);
              imagecopyresampled($im2, $im, 0, 0, 0, 0, imagesx($im2), imagesy($im2), imagesx($im), imagesy($im));
              imagepng($im2, "assets/Images/PP/mini_".$nom."_pp.png");
              $pp = "assets/Images/PP/mini_".$nom."_pp.png";
        $query=$bdd->prepare('UPDATE utilisateur SET Photo = :photo WHERE idUtilisateur = :id');


        $query->bindValue(":photo", $pp,PDO::PARAM_STR);
        $query->bindValue(":id",$id,PDO::PARAM_INT);

        $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
    
}
function get_nombre_user(){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
   $query=$pdo->prepare('SELECT COUNT(*) AS nbreuser FROM utilisateur');
        $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}
function get_nombre_eve(){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
   $query=$pdo->prepare('SELECT COUNT(*) AS nbre_eve FROM evenements where depasser=0 and supprimer =0 ');
        $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}
function get_nombre_client(){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
   $query=$pdo->prepare('SELECT COUNT(*) AS nbreclient FROM client');
        $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}
function get_nombre_project(){

  $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
  
   $query=$pdo->prepare('SELECT COUNT(*) AS nbreprojet FROM project');
        $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}
