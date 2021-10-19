 <?php
 if(isset($_GET['idclient'])){
    if(!empty($_POST['nom_projet'])&&!empty($_POST['debut_projet'])&&!empty($_POST['fin_projet'])){
        add_projet($_GET['idclient']);
}
}
if(isset($_POST['nom_equipe'])){
    if(!empty($_POST['nom_equipe'])){
        add_equipe();
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
     
				<div class="AP_box1">
					<h2 style="text-align:center;">Entrez les informations pour la creation de votre projet</h2>
                                        <form class="AP_form" method="POST">
						<P class="AP_error">Veuillez renseignez tous les champs</P>
                               <?php  if(isset($_GET['idprojet'])){
                         $result2= get_client_projet_by_id($_GET['idprojet']);
                        ?>
                        <input type="text" name="nom_projet" class="nom_projet" id="nom_projet" placeholder="Sur quoi voulez-vous travaillez" value="<?php echo $result2['nom_projet']; ?>"><br><br>
                        <input type="hidden" name="id_client" value="<?php   $result= get_client_by_id($_GET['idclient']);
                        echo $result['idClient']; ?>" class="id_client" id="id_client">
                        <?php }else{ ?>
                       <input type="text" name="nom_projet" class="nom_projet" id="nom_projet" placeholder="Sur quoi voulez-vous travaillez" ><br><br>
     
                            <?php } ?>

					<label>Date de Debut du projet</label><br>
                    <input type="date" name="debut_projet" class="debut_projet" id="debut_projet" min="<?php echo date("Y-m-d"); ?>" max="<?php  echo date("Y-m-d",strtotime("+2 years")); ?>" onfocus="controle_date()"  ><br><br>
                    
					<label>Date de Fin du projet</label><br>
                    <input type="date" name="fin_projet" class="fin_projet" id="fin_projet" min="<?php echo date("Y-m-d"); ?>" max="<?php  echo date("Y-m-d",strtotime("+2 years")); ?>" onfocus="controle_date()"  ><br><br>
					
					<button type="button" name="submit"  class="AP_btn2">Valider les informations</button><br>
					
					</form>
				</div>
				<div class="AP_box2">
					<h2>Entrez les informations pour la creation de votre equipe</h2>
                                        

					<form class="AP_form2" method="POST" action="">
						<P class="AP_error2">Veuillez renseignez tous les champs</P>
						<label>Nom d'Equipe</label><br>
                                                <input type="text" name="nom_equipe" placeholder="Nom de l'équipe" class="AP_equipe2" id="nom_equipe"><br><br>	
                                                <h4>Selctionner les membres de votre equipe</h4>
                                                <div class="" id="AP_box2a">
                                                    
                                                    
                                        <?php
                                        $bdd = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
                                        $resultat = $bdd->query('SELECT * FROM utilisateur ORDER BY Nom_utilisateur');
                                        while ($donnees = $resultat->fetch()){
                                                echo '<a ><div><input type="checkbox" value="'.htmlspecialchars($donnees['idUtilisateur']).'" name="chk[]" id="AP_check">' . htmlspecialchars($donnees['Nom_utilisateur']).'</div></a>' ;
                                                
                                        }
                                        $resultat->closeCursor();
                                    ?></div>
					<br><br><br>
                                        <button type="submit" name="submit" value="Valider les informations" class="AP_btn3">Valider l'Equipe</button><br>
					
					
					</form>
				</div>
                                
			</div>
		</div>
    </body>
			<script type="text/javascript">
				
	function controle_date()
{
  date_debut = document.getElementById("debut_projet").value;
  date_fin = document.getElementById("fin_projet").value;

  if (date_debut !== "")
  {
    var date = document.getElementById("fin_projet");
    date.setAttribute('min', date_debut);
  }
  

}

$(document).ready(function(){
    // Ajout projet

    $('.AP_btn2').click(function(){
            var result=true;
    if($('.nom_projet').val()==""){
        $('.AP_error').css('display','block');
    result=false;

    }else{
    result=true;
    }
    if($('.debut_projet').val()==""){
        $('.AP_error').css('display','block');
    result=false;

    }else{
    result=true;
    }
    if($('.fin_projet').val()==""){
        $('.AP_error').css('display','block');
    result=false;

    }else{
    result=true;
    }
    if (result==true){
        var nom_projet = encodeURIComponent($("#nom_projet").val());
        var debut_projet = encodeURIComponent($("#debut_projet").val());
        var fin_projet = encodeURIComponent($("#fin_projet").val());
        var id_client = encodeURIComponent($("#id_client").val());

        $.ajax({
            url: "traitement ajax/ajout_projet.php",
            type: "POST",
            data: "nom_projet="+nom_projet+"&debut_projet="+debut_projet+"&fin_projet="+fin_projet+"&id_client="+id_client,
            success: function(msg){
                // Si la réponse est true, tout s'est bien passé,
                // Si non, on a une erreur et on l'affiche
                if(msg == true) {
                        $('.AP_box1').hide(500);
                        $('.AP_box2').show(200);
                } else{
                        $('.AP_box1').hide(500);
                        $('.AP_box2').show(200);
                }
            },
            error: function(msg){
            // On alerte d'une erreur
            alert('Erreur');
            },
        });
    }else{
    return result;
    }

    });

    // Modifier projet

    $('#MP_btn3').click(function(){
            var result=true;
    if($('.nom_projet').val()==""){
        $('.AP_error').css('display','block');
    result=false;

    }else{
    result=true;
    }
    if($('.debut_projet').val()==""){
        $('.AP_error').css('display','block');
    result=false;

    }else{
    result=true;
    }
    if($('.fin_projet').val()==""){
        $('.AP_error').css('display','block');
    result=false;

    }else{
    result=true;
    }
    if (result==true){
        var nom_projet = encodeURIComponent($("#nom_projet").val());
        var debut_projet = encodeURIComponent($("#debut_projet").val());
        var fin_projet = encodeURIComponent($("#fin_projet").val());
        var idProject = encodeURIComponent($("#id").val());
        var idEquipe = encodeURIComponent($("#id1").val());
        $.ajax({
            url: "index.php?module=administration&action=modifier_projet",
            type: "POST",
            data: "nom_projet="+nom_projet+"&debut_projet="+debut_projet+"&fin_projet="+fin_projet+"&idProject="+idProject+"&idEquipe="+idEquipe,
            success: function(msg){
                // Si la réponse est true, tout s'est bien passé,
                // Si non, on a une erreur et on l'affiche
                if(msg == true) {
                } else{
                }
            },
            error: function(msg){
            // On alerte d'une erreur
            alert('Erreur');
            },
        });
    }else{
    return result;
    }

    });

});
			</script>

