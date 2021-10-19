
				$( document ).ready(function()
				{
					$('#fo_send_bt,#fo_reset_bt,#fo_add_s_cat').mousedown(function()
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
				$('#fo_add_s_cat').mouseup(function()
				{
					 $(this).css({
					 	boxShadow: '2px 2px 2px 2px #a5a1a1',
					 });
				});

				$('#fo_add_s_cat').click(function()
				{
					$('.fo_form_forum').show();
				 	$('.fo_form_forum input').focus();
				});
				$('#fo_reset_bt').click(function()
				{
					$('.fo_form_forum').hide();
				 	document.location.href="#fo_titre_sujet";
				});
				$('#fo_plus_cat').click(function(e)
				{
					e.preventDefault();
					$('.fo_new_cat').show();
					$('#fo_annuler_cat').show();
					$('#fo_plus_cat').hide();
					$('.fo_new_cat input').focus();
					 $('.fo_form_forum').css({
					 	height:'68vh',
					 });
				});
				$('#fo_annuler_cat').click(function(e)
				{
					e.preventDefault();
					$('.fo_new_cat').hide();
					$('#fo_annuler_cat').hide();
					$('#fo_plus_cat').show();
					$('.fo_form_forum').css({
					 	height:'62vh',
					 });
				})

				$('#fo_new_cat_bt').click(function(e)
				{
					e.preventDefault();
					if($('#fo_new_cat').val())
					{
						$.post(
						{
							url:'modules/utilisateur/fo_traitement.php',
							data:{ new_cat:$('#fo_new_cat').val(),idUser:$('input[name="id_user"]').val()},

							success:function(data)
								{
									$('#fo_cat_select').append(data);
									console.log(data);
									alert('Categorie crée');
									},
							error : function(resultat, statut, erreur)
									{
									console.log('echec d\'ajout');
					       			}

						});
						$('#fo_annuler_cat').hide();
						$('#fo_plus_cat').show();
						$('#fo_new_cat').val("");
						$('.fo_new_cat').hide();
						$('.fo_form_forum').css({
					 	height:'62vh',
					 });
					}
					else
					{
						alert('Vous devez remplir le champs...')
					} 
				})		
		});	