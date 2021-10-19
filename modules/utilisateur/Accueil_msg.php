<script type="text/javascript" src="./assets/js/message.js"></script>
<title>Messsage</title>
</head>
<body>
	<?= $content ?>
		<div class="M_wrapper-menu ">
		 	<?php include  "include/menu.php" ;
		 	?>
		</div>
			
	<input type="hidden" id="ME_id_input" name="" value=<?php  echo $_SESSION['idUser'];?>>
	<div class="AC_Me_box0">
		<div>
			<span  id="AC_Me_Back_archiv">
				<i class="fas fa-arrow-left" style="font-size: 30px;"></i>
			</span>
			
			<h2  id="AC_Me_title"> LISTE DES CONVERSATIONS </h2> 
			<span id="AC_Me_title_archiv"> (Archivées)</span>
		</div>

		<div class="AC_Me_block_menu">
			<div class="AC_Me_menu" title="Archives" id="AC_Me_menu_archi">
				<i class="fas fa-archive"></i>
			</div>
			<div class="AC_Me_menu" id="AC_Me_menu_disc">
				<i class="far fa-comment-alt"></i>
				<div class="AC_Me_menu_pen"><i class="fas fa-pen"></i></div>
			</div>
			
			<div class="AC_Me_menu" id="AC_Me_menu_rech">
				<i class="fa fa-search"></i>
			</div>
			
		</div>
		<div id="AC_Me_bt_search_msg">
				<input type="text" name="search_msg" placeholder="Rechercher convers..." id="AC_Me_search_msg"/>

				<div id="AC_Me_search_msg_icon">
					<i class="fa fa-search"></i>
				</div>
		</div>

		<div class="AC_Me_box1">
				<div id="AC_Me_box1_close">
					<i class="fas fa-times"></i>
				</div>
				<div class="ME_box1a">
					&nbsp;&nbsp;<h3>Nouvelle Discussion</h3>
					<input type="text" name="search"  class="ME_search" placeholder="chercher un contact ...">
					<span>
						<i class="fa fa-search" aria-hidden="true">	
						</i>
					</span>
				</div>
				<div class="ME_result" style="display: none"></div>
				<div class="ME_box1ba">
					<?php  Me_afficher_contact($bdd,$_SESSION['idUser'])?>
				</div>
				
			</div>

			<?php  ?>
		
	    <div class="AC_Me_box1b">
	    	
	    	<?php 
	    		Me_Acceuil_Msg_c($bdd,$_SESSION['idUser']);
	    	 ?>
			<input type="hidden" id="ME_id_last_message" name="" value=<?php  echo get_last_message($_SESSION['idUser'],$bdd)?> > 
		 </div>
		 <div class=" AC_Me_box1b_search">
		 	
		 </div>
		 <!--
		 	frond end realisé avant l'afffichage PHP

		   <a href=""> 	
				<div class="AC_Me_box1b1">
					<img src="'.$donnees['photo'].'"/>
				</div>
				<div class="AC_Me_box1b2" >
					<div class="AC_Me_name_contact">
						MENYEM VICTOR....
						<span class="AC_Me_heure" style="color:  #0B8CB8">
							17:23
						</span>
					</div>

					<div class="AC_Me_dernier_message">
						Last : Ceci est le dernier message bref,,,
					</div>
					<div class="AC_Me_nouveau_message">
						<span>2</span>
					</div>
			   </div>
		   </a> -->
		
	</div>
	<div id="AC_Me_body">
	
	</div>

