	
	<script type="text/javascript" src="./assets/js/accueil.js"></script>
	<title>Accueil</title>
</head>
<body>
	<?= $content ?>
<div class="container-general container-projet">
	<div class="M_wrapper-menu ">
	 	<?php include  "menu.php" ?>
	</div>
	<div class="container-content container-contenu">
		<?php if(!empty($_SESSION['Role']) && $_SESSION['Role'] ==2  )
    { ?>
		
				<div class="A_affiche_user_chef">
    <h2 class="para_p">Dashboard</h2>
    <div class="A_affiche_user">
      <div class="A_affiche_user_box">
        <div class="A_affiche_user_box_titre">
          Nombre d'utilisateurs (Online)
        </div>
        <div class="A_affiche_user_box_icon">
          <i class="fa fa-user-alt"></i>
        </div>
        <div class="A_affiche_user_box_mot">
          <p><?php $result=get_nombre_user();
          echo $result['nbreuser'];
           ?></p>
        </div>
      </div>
      <div class="A_affiche_user_box">
        <div class="A_affiche_user_box_titre">
          Nombre de Clients
        </div>
        <div class="A_affiche_user_box_icon">
          <i class="fas fa-people-arrows"></i>
        </div>
        <div class="A_affiche_user_box_mot">
          <p><?php $result=get_nombre_client();
          echo $result['nbreclient'];
           ?></p>
        </div>
      </div>
      <div class="A_affiche_user_box">
        <div class="A_affiche_user_box_titre">
          Nombre de projets
        </div>
        <div class="A_affiche_user_box_icon">
          <i class="fa fa-project-diagram"></i>
        </div>
        <div class="A_affiche_user_box_mot">
          <p><?php $result=get_nombre_project();
          echo $result['nbreprojet'];
           ?></p>
        </div>
      </div>
      <div class="A_affiche_user_box">
        <div class="A_affiche_user_box_titre">
          Nombre d'évènements
        </div>
        <div class="A_affiche_user_box_icon">
          <i class="far fa-calendar-alt"></i>

        </div>
        <div class="A_affiche_user_box_mot">
          <p><?php $result=get_nombre_eve();
          echo $result['nbre_eve'];
           ?></p>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
				<div id="A_parent_graph" class="A_box_graph">
					<h2 style="text-decoration: underline;">
						Dureé de réalisation des Projets
					</h2>
					<div class="A_fil_graph" >
	        <canvas id="myChart"></canvas>
	        <script>
	        var ctx = document.getElementById('myChart').getContext('2d');
	        var myChart = new Chart(ctx, {
	            type: 'bar',
	            data: {
	                labels:[<?php 
	    $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
	     $query=$pdo->prepare('SELECT *  FROM module INNER JOIN project on project.idProject=module.idProject GROUP BY module.idProject  ');
	     $query->execute();
 while($result = $query->fetch(PDO::FETCH_ASSOC)){
echo "'".$result['intutile']."',";
}?>],
	                datasets: [{
	                    label: 'Pourcentage des modules en cours',
	                    data: [<?php 
   $pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);

   $query=$pdo->prepare('SELECT *  FROM Module GROUP BY idProject  ');
    $query->execute();
 while($result = $query->fetch(PDO::FETCH_ASSOC)){
$id_projet=$result['idProject'];
    //echo "'".$id_projet."',";		

$query1=$pdo->prepare("SELECT COUNT(*) as nbre_module_en_cours FROM Module where Statut=1 and idProject=".$id_projet."");
    $query1->execute();
    $result1=$query1->fetch();
    $a=intval($result1['nbre_module_en_cours']);
$query2=$pdo->prepare("SELECT COUNT(*) as nbre_module_total FROM Module where idProject=".$id_projet."");
    $query2->execute();
    $result2=$query2->fetch();
     $b=intval($result2['nbre_module_total']);
    if($b==0){
    echo "'0',";		
    }else{
    echo "'".($a/$b)*(100)."',";		
    }
}?>],
	                    backgroundColor: [
	                        'rgba(54, 162, 235, 0.2)',
	                        'rgba(54, 162, 235, 0.2)',
	                        'rgba(54, 162, 235, 0.2)',
	                        'rgba(54, 162, 235, 0.2)',
	                        'rgba(54, 162, 235, 0.2)',
	                        'rgba(54, 162, 235, 0.2)',
	                    ],
	                    borderColor: [
	                         'rgba(54, 162, 235, 0.2)',
	                        'rgba(54, 162, 235, 0.2)',
	                        'rgba(54, 162, 235, 0.2)',
	                        'rgba(54, 162, 235, 0.2)',
	                        'rgba(54, 162, 235, 0.2)',
	                        'rgba(54, 162, 235, 0.2)',
	                    ],
	                    borderWidth: 1
	                }]
	            },
	            options: {
	                scales: {
	                    y: {
	                        beginAtZero: 0
	                    }
	                }
	            }
	        });
	        </script>
	        <script type="text/javascript">
	        	function get_data(){
	        		$.get("http://localhost/intranet/traitement%20ajax/traitement_chart.php",function(d){
	        			console.log(d);
	        		},"jSON");
	        	}
	        	/*$(document).ready(function(){
	        		$('#btn').click(function(){
	        		  $.ajax({
	        		  	url:'traitement ajax/traitement_chart.php',
	        		  	type:'post',
	        		  	dataType:'JSON',
	        		  	success: function(donnees){
	        		  	$('#A_parent_graph').text(donnees.jour);	
	        		  	$('.A_fil_graph').text(donnees.nombre);	
						}
	        		  });
	        		  });
	        	});*/
	        </script>

					</div>
				</div>
				<div id="A_box_msg" class="A_box_msg A_box_new_msg">
					<h2 style="text-decoration: underline;">
							Messages récents
					</h2>
						 <div class="AC_Me_box1b">
					    	<?php 
					    		Me_Acceuil_Msg_recent($bdd,$_SESSION['idUser']);
					    	 ?>
						 	<input type="hidden" id="ME_id_last_message" name="" value=<?php  echo get_last_message($_SESSION['idUser'],$bdd)?> > 
						 </div>
						<input type="hidden" id="ME_id_input" name="" value=<?php  echo $_SESSION['idUser'];?>>
				</div>
				<div id="A_box_new" class="A_box_new A_box_new_msg ">
				<a><h2 style="text-decoration: underline;">

						Nouvelles
					</h2>
					<div class="A_box_new_affichage A_box_new_msg_aff">
						<?php Get_notification($bdd,$_SESSION['idUser'],2); ?>
					</div>
				</a>
				</div>

				
			<div id="A_bloc3" class="A_bloc">
				<h2 style=" text-align: center; text-decoration: underline;">
		          Agenda
		        </h2>
		  			<div class="A_sbloc" id="calendar">
			          <script>
			                document.addEventListener('DOMContentLoaded', function() 
			                {
			                  var calendarEl = document.getElementById('calendar');
			                  var calendar = new FullCalendar.Calendar(calendarEl, {
			                      headerToolbar: {
			                      left: 'prev,next today',
			                      center: 'title',
			                      right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
			                        },
			                        initialDate: <?php echo"'".date('Y-m-d')."'" ?>,
			                        navLinks: true, // can click day/week names to navigate views
			                        businessHours: true, // display business hours
			                        editable: true,
			                        selectable: true,
			                        events: [
				                              <?php  $events=$bdd->query('SELECT id_eve, theme, type, date_eve, time(date_eve) as heure, idCreateur from evenements where depasser=0 and Supprimer=0');
				                                      while ($event=$events->fetch()) 
				                                      {$date = new DateTime($event['date_eve']);
				                                          $participant=$bdd->prepare('SELECT * from participation where id_eve=:id_eve and id_utilisateur=:id_user');
				                                          $participant->bindValue(':id_eve',$event['id_eve'],PDO::PARAM_INT);  
				                                          $participant->bindValue(':id_user',($_SESSION['idUser']),PDO::PARAM_INT);
				                                          $participant->execute();
				                                          $user=$bdd->query('SELECT * from utilisateur where idUtilisateur='.$_SESSION['idUser']);
				                                          $user=$user->fetch();
				                                          if($participant->rowCount() or  $user['Role']==2)
				                                          {
				                                            $date = new DateTime($event['date_eve']);
				                                            $dateaff=$date->format('Y-m-d')."T". substr($event['heure'], 0,-7);
				                                            echo "
				                                                  {
				                                                    title: '".$event['theme']."(".$event['type'].")',
				                                                    start: '".$date->format('Y-m-d')."T".substr($event['heure'], 0,-7)."',
				                                                    url: 'index.php?module=utilisateur&action=evenement&id_eve_calandar=EV_block1_".$event['id_eve']."',
				                                                    constraint: 'businessHours',
				                                                  },

				                                             "; // cette URL doit etre update au moment de l'assemblage pour que le chemin soit de nouveau exacte
				                                          }
				                                      }
				                                     
				                                      ?>
					                        ]   
					                      });

			                      calendar.render();
			                    });
			              </script>
		  			</div>
				</div>
		</div>
</div>