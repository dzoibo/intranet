$(document).ready(function()
	{
		setInterval(function()
		{ 
			$.post(
			{
					url:'traitement ajax/accueil.php',
					data:{ id_user:$('#ME_id_input').val(),id_message:$('#ME_id_last_message').val()},
					success:function(data)
						{
							if(data=="Rien")// si il ya aucun nouveau message on sort sans actuaiser
							{
								console.log(data);
								return;	
							}
							else
							{
								$('.AC_Me_box1b').html(data);
								console.log(data+'yo');
							}
							
						},
					error : function(resultat, statut, erreur)
						{
							console.log('echec d\'actualisation');
		       			}

				}); 
		}, 1000);




	});