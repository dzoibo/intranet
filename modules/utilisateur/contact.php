<title>Contact</title>
</head>
<body>
      <?= $content ?>


<div class="container-general container-projet">
  <div class="M_wrapper-menu ">
   <?php include  "include/menu.php" ?>
  </div>
    <div class="container-content container-contenu">
          
			<div class="ge_box">
        
				<h2 class="ge_lienb">Contact</h2>
				
				
				<div class="ge_box1">
			
        <table id="example" class="display" >
            <thead>
                <tr class="ge_ligne0">
                  <td>Photo</td>
                    <td>Nom</td>
                    <td>Prenom</td>
                    <td>Email</td>
                    <td>Login</td>
                    <td>Statut</td>
                    <td>Option</td>
                </tr>
            </thead>
          <?php 
          $query= get_all_utilisateur();
          
          while($result=$query->fetch(PDO::FETCH_ASSOC)){
            
           
           ?>
                <tr>
                  <td><div class="ge_photo">
                    <?php show_user($result['idUtilisateur']); ?>
                        </div></td>
                    <td><?php echo $result['Nom_utilisateur']; ?></td>
                    <td><?php echo $result['Prenom_utilisateur']; ?></td>
                    <td><?php echo $result['mail'];  ?></td>
                    <td><?php echo $result['Login'];  ?></td>
                    <td><?php echo $result['Statut_utilisateur'];  ?></td>
                    <td class="ge_ligne">
                      <div class="ge_ligne1"> 
                    <?php echo '<a  href="index.php?module=utilisateur&action=message&id_contact='.$result['idUtilisateur'].'#ME_repere" title="Envoyer un message"><i class="far fa-comments"></i></a>'; ?>
                </div>
                </td>

                </tr>
              <?php }?>  
        </table>
    </div>

			</div>
			
<script type="text/javascript">
    $(document).ready(function() {

  
    var table = $('#example').DataTable();
     
    
    /*$('#example tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        alert( 'Votre nom est '+data[0]+'' );
   } );*/
   } ); 
     </script>
  

        </div>
		</div>
