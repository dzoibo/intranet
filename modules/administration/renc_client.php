<?php

    if(!empty($_POST['date_rencontre'])&&!empty($_POST['time_rencontre'])&&!empty($_POST['motif_rencontre'])&&!empty($_POST['AC_area'])){
        
        $quer=$bdd->prepare('SELECT * FROM client ORDER BY idClient DESC LIMIT 1');

        $quer->execute();

        $resulta = $quer->fetch(PDO::FETCH_ASSOC);
        $nbr = $resulta['idClient'];
        add_rencontre($nbr);
    }

?>
	
	
		<div class="ME_box">
			<?php 	include "include/menu.php" ?>
		</div>
		<div class="ME_block2">
		
				<div class="AC_box2">
					<h2>Informations qui ont ete tire de la rencontre avec le client </h2>
					
					<form class="AC_form2" name="" method="POST" action="">
						<p class="AC_error2">Veuillez renseignez tous les champs</p>
						<label>Date de rencontre</label><br>
						<input type="date" name="date_rencontre"
                                                       class="date_rencontre"><br><br>
						<label>Heure de rencontre</label><br>
						<input type="time" name="time_rencontre"
						class="time_rencontre"><br><br>
						<label>Motif de rencontre</label><br>
						<input type="type" name="motif_rencontre"
						class="motif_rencontre" placeholder="Quel etait le motif de la rencontre"><br><br>
						<label>Debouche de la rencontre</label><br>
                                                <textarea placeholder="une brieve description" name="AC_area" class="AC_area"></textarea><br><br>
                                                <input type="submit" name="submit" class="AC_btn3" value="Enregistrer" id="AC_btn3">
						
					</form>
				</div>
			</div>