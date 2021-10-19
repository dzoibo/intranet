		$( document ).ready(function()
		{
		    $('#fo_send_bt,#fo_reset_bt,#fo_add_sujet').mousedown(function()
					{
						 $(this).css({
						 	boxShadow: '2px 2px 2px 2px rgb(84, 138, 167)',
						 	border:'none',
						 });

					});
					
					$('#fo_send_bt,#fo_reset_bt').mouseup(function()
					{
						 $(this).css({
						 	boxShadow: 'none',
						 	border:'1px solid black',
						 	outline:'none'
						 });
					});
					$('#fo_add_sujet').mouseup(function()
					{
						 $(this).css({
						 	boxShadow: '2px 2px 2px 2px #a5a1a1',
						 });
					});

					$('#fo_add_sujet').click(function()
					{
						$('.fo_form_sujet').show();
					 	$('.fo_form_sujet input').focus();
					});
					$('#fo_reset_bt').click(function()
					{
						$('.fo_form_sujet').hide();
					 	document.location.href="#fo_titre_sujet";
					});
					$('#fo_checkbox').click(function(){

						if($('.fo_msg_list_rep').is(':visible'))
						{
							$('.fo_msg_list_rep').toggle(false);			
						}
						else
						{
							$('.fo_msg_list_rep').toggle(true);
						}
					});
				
		});	


			


	function ajouter_fav(id)
	{
			$('#fo_sujet_favoris'+id).attr
		({
		    class : 'fo_sujet_favoris',
		    title : 'Retirer des favoris',
		    onclick:'retirer_fav('+id+')',
		});

		$.post(
			{
				url:'modules/utilisateur/fo_traitement.php',
				data:{ id_sujet_fav:id,traitement:'1', id_user_fav:$('input[name="id_user"]').val()},
				success:function(data)
					{
						console.log(data);
						},
				error : function(resultat, statut, erreur)
						{
						console.log('echec d\'ajout');
		       			}

			}); 
	}
	function retirer_fav(id)
	{
			$('#fo_sujet_favoris'+id).attr
		({
		    class : 'fo_sujet_no_favoris',
		    title : 'Ajouter aux favoris',
		    onclick:'ajouter_fav('+id+')',
		});

		$.post(
			{
				url:'modules/utilisateur/fo_traitement.php',
				data:{id_sujet_fav:id,traitement:'0',id_user_fav:$('input[name="id_user"]').val()},
				success:function(data)
					{
						console.log(data);
					},
				error : function(resultat, statut, erreur)
						{
						console.log('echec d\'ajout');
		       			}

				}); 
	}

