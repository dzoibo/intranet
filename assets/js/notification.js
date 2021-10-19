

	

	$(document).ready(function()
	{
		 setInterval(function()
				{ 
					$.post(
					{
							url:'traitement ajax/ajax_notif.php',
							data:{ id_user_only:$('#H_id_input').val()},
							success:function(data)
								{
										if(parseInt($('#H_nbre_notif').html())!= parseInt(data))
										{
											console.log("notif refresh =" + data+$('#H_nbre_notif').html());
											$('#H_nbre_notif').html(data);

											notif_load(1);
											notif_load(2);

										}
								},
							error : function(resultat, statut, erreur)
								{
									console.log('echec de connection notif');
				       			}

						}); 
				}, 500);


});
	function notif_load(size_notif) // cette fonction n'est appelée que s'il y'a une nouvelle notification
	{
			$.post(
				{
					url:'traitement ajax/ajax_notif.php',
					data:{ id_user:$('#H_id_input').val(), size:size_notif},// size ici va nous permettre de savoir si l'appel ajax vient de la page d'acceuil, de la page notification ou du header et ainsi de savoir quelles données doivent étre renvoyées pr la page qui recevra tout
					success:function(data)
						{
							if(size_notif==1)// 
								{
									$('.H_notification_type_container').html(data);
								
								}
							else
								{
									$('.N_notification_type_container').html(data);
									$('.A_box_new_affichage A_box_new_msg_aff').html(data);
								}
									
						},
					error : function(resultat, statut, erreur)
							{
								console.log('echec de connection notif');
				       		}

				}); 
	}


	function notif_lu (id)
	{
		$('#notif_lu_'+id).hide();

			$.post(
				{
					url:'traitement ajax/ajax_notif.php',
					data:{ id_user:$('#H_id_input').val(),id_notif:id },
					success:function(data)
						{
								alert('succes');	
						},
					error : function(resultat, statut, erreur)
							{
								console.log('echec de connection notif');
				       		}

				}); 
				
	}



