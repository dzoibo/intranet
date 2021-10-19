	$(document).ready(function(){

		search=$('.icone3');
		search.click(function(){

			$(".AQ_box1").css("display","none");
		});

		icon_show_client=$('.icon-ajout-new');
		box_affichage=$('.client-new-formulaire');
		icon_show_client.click(function(){

			box_affichage.show(600);
		});
	});
	/* <script type="text/javascript">
		        	function get_data(){
		        		$.get("http://localhost/intranet/traitement%20ajax/traitement_chart.php",function(d){
		        			console.log(d);
		        			set_data_table(d);
		        			set_data_chart(d);
		        		},"jSON");
		        	}

		        	function set_data_table(d){
		        		$('#semaine tbody').remove();
		        		for(i=0;i<d.length;i++){
		        			$('#semaine tbody').append("<tr><td>"+d.labels[i]+"</td><td>"+d.data[i]+"</td></tr>");
		        		}
		        	}

		        	function set_data_chart(d){*/