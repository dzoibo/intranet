

	

	$(document).ready(function()
	{
		// d'ici 
		$('.AC_Me_option').click(function()
		{
			$('.AC_Me_box1b').css({
					overflow: 'visible',  
				});
		});
		$('#AC_Me_menu_disc').click(function()
		{
				$('#AC_Me_search_msg,#AC_Me_search_msg_icon').hide();
				$('.AC_Me_box1').show();
				$('.AC_Me_box0').css({
					marginLeft:'20.5%'
				});

				
				$(this).css({
					color:'#548aa7'
				});
				$('.AC_Me_block_menu').css({
					right:'25.4%'
				})

				$('#AC_Me_body').show();
		});

	$('#AC_Me_box1_close').click(function()
	{
		$('.AC_Me_box1').hide();
		$('.AC_Me_box0').css({
				marginLeft:'25%'
			});
		$('#AC_Me_menu_disc').css({
				color:'black',
			});
		$('#AC_Me_body').hide();
		$('.AC_Me_block_menu').css({
				right:'21%'
			})
	});
	$("#AC_Me_Back_archiv").click(function() {
        location.reload(true);
    });
	$('#AC_Me_menu_rech').click(function()
	{
		$('#AC_Me_search_msg,#AC_Me_search_msg_icon').show();
		$('#AC_Me_search_msg').focus();
		$('#AC_Me_menu_disc').css({
				color:'black'
			});
		$(this).css({
				color:'#548aa7'
			});
	});
	$('#AC_Me_search_msg').blur(function()
	{
		$('.AC_Me_box1b').show();
		$('#AC_Me_search_msg,#AC_Me_search_msg_icon').hide();
		$('.AC_Me_box1b_search').hide();
		$('#AC_Me_menu_rech').css({
				color:'black'
			});
	})

	$('#AC_Me_menu_archi').click(function()
	{
		$('.AC_Me_block_menu').hide();
		$('#AC_Me_title_archiv').show();
		$('#AC_Me_Back_archiv').show();
		$.post
		({
			url:'traitement ajax/accueil_msg.php',
			data:
			{ 
				id_user_archiv:$('#ME_id_input').val(),

			},

			success:function(data)
			{
								
				$('.AC_Me_box1b').html(data);
								
			},
			error : function(resultat, statut, erreur)
			{
				console.log('echec ');
			}
		})

	});
	// à ici ...# acceuil_msg.php/<script>...</script>
		$('.ME_search').keyup(function(){ 

			if($(this).val().length>=1)
			{
				console.log('Cliqué !');
				$.post({
							url:'traitement ajax/accueil_msg.php',
							data:'rechercher_contact='+ $(this).val()+'&id='+$('#ME_id_input').val(),
							dataType:'html',
							success: function (data) 
											{
								           		 console.log('Submission was successful.');
								               	 console.log(data);
								               
								           		 $('.ME_result').html(data);
								           		 $('.ME_result').show();
						                 		 $('.ME_box1ba').hide();

								               	
            								 },
					   });

			}
				else 
			{
				
								               		 
								               	  $('.ME_result').hide();
								               	  $('.ME_box1ba').show();
			}
    			
				});

		
		//fonction pour l'actualisation des  statut(en ligne/deconnécté)
		
		setInterval(function()
		{
			$(".Me_statut_contact").each(function()
			{ 
				  var yo= $(this).attr('id');// pour chaque objet de la classe statut on réccupére l'id
				  var radical_id=yo.substring(0,17);//on extrait ensuite le radicale de l'id;
				  yo=yo.substring(17);//on extrait l'id du user qui va nous permettre de work dans la BD;

				  $.post(
				{
						url:'traitement ajax/accueil_msg.php',
						timeout: 1000,
						data:{ id_statut:yo},
						success:function(data)
							{
								$('#'+radical_id+yo).html(data);
								console.log(" statut...");
							},
						error : function(xmlhttprequest, textstatus, message)
							{
								$(".Me_statut_contact").html('');
								if(textstatus==="timeout")
								 {
									$(".Me_statut_contact").html('');
									console.log('temps d\'attente écoulé...');
								 } 
			       			},

					}); 
			});
		},1000);
		//fonction pour actualiser la page d'acceuil automatiquement...
 setInterval(function()
		{ 
			$.post(
			{
					url:'traitement ajax/accueil_msg.php',
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
								console.log(" ac...");
							}
							
						},
					error : function(resultat, statut, erreur)
						{
							console.log('echec d\'actualisation');
		       			}

				}); 
		}, 1000);

		$('#AC_Me_search_msg').keyup(function()
		{

					if($(this).val().length>=1)
					{
						$.post({
									url:'traitement ajax/accueil_msg.php',
									data:'recherche='+ $(this).val()+'&id_user_recherche='+$('#ME_id_input').val(),//$('#id_user').val(), on s'esn servira plutard
									dataType:'html',
									success: function (data) 
													{
										         		 console.log('Submission was successful.');
										               	 console.log(data);
										           		 $('.AC_Me_box1b_search').html(data);
										           		 $('.AC_Me_box1b_search').show();
								                 		 $('.AC_Me_box1b').hide();

										               	
		            								 },
		            				error:function(data)
		            				{
		            					console.log(data);	               		 
										$('.AC_Me_box1b_search').hide();
									    $('.AC_Me_box1b').show();		
		            				}
							   });

					}
					else 
					{
						
										               		 
								$('.AC_Me_box1b_search').hide();
							    $('.AC_Me_box1b').show();
					}

		});

});

	setInterval(function()// actualisation de message ...
		{ 
			$.ajax(
			{
				url:'traitement ajax/accueil_msg.php',
				type: 'POST',
				data:{ id:$('#ME_last_message').val(),
					   date:$('#ME_last_message_date').val(),// ce champs est crée dans la fonction Me_afficher_message...
					   idEx:$('#ME_id_input').val(),
					   idRec:$('#idRec').val() },
				success:function(data)
					{
						$('.ME_box21').append(data);
						console.log("c'est mmo");
					},
				error : function(resultat, statut, erreur)
				{
					console.log(resultat+' et '+statut+' yo '+erreur);
       			}

				}); 
		}, 500);



	function envoyer()
	{
    	event.preventDefault();

		if ($('.ME_msg').val()=="" && $("#Me_file1").val().length===0 && $("#Me_file2").val().length===0)
		{
			$('.ME_msg').focus();
			alert("Vous ne pouvez pas envoyer de message vide");
		}
		else
		{
			var form = $('#form')[0];
			var data = new FormData(form);	
			$.ajax
			({	
				url : 'modules/utilisateur/msg_traiteur.php',
				type : 'POST',
				enctype: 'multipart/form-data',
				data: data ,
				processData: false,//indique à jQuery qu'il ne doit pas traiter les données 
				contentType: false,//indique à jQuery de ne pas configurer le type content
				cache: false,
				timeout: 600000,//le temps limite d'attente...
				xhr: function() 
				{
	                var xhr = new window.XMLHttpRequest();
	                xhr.upload.addEventListener("progress", function(evt) {
	                    if (evt.lengthComputable) {
	                        var percentComplete = ((evt.loaded / evt.total) * 100);
	                        $('.ME_progress-bar').width(percentComplete + '%');
	                        $('.ME_uploadStatus').html( percentComplete+'%');
	                        if (percentComplete==100)
	                        {
	                        	$('.ME_progress-bar').fadeOut("slow");
	                        	$('.ME_uploadStatus').fadeOut("slow");
	                        }

	                    }
	                }, false);
	                return xhr;
	            },
	            beforeSend: function()
	            {
	                $('.ME_progress-bar').width('0%');
	                $('.ME_uploadStatus').html('');
	            },
				success : function(reponse)
				{
					console.log(reponse);
					form.reset();
					$('.Me_info_file').html('');
					$('.Me_info_file').css('borderStyle','none');
				},
				error: function(reponse)
				{
					console.log(reponse);
					alert('vous n\'etes pas connécté; Verifier votre connexion...')
				}

			});
		}
		
	};

//on crée deux variables contenant les types qu'on passera en parametre plutard en fontion de l'envoyeur de fichier choisi
var fileType2 = [
  'image/jpeg',
  'image/jpg',
  'image/png',
  'image/svg',
  'image/tiff',
  'image/ico',
  'image/pjp',
  'image/gif',
];
var fileType1=[
'.doc',
'.docx',
'.xml',
'application/msword',
'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
'application/pdf',
'audio/*',
'video/*',
'video/mp4'
];



		function validFileType(file,types) 
		{
		  for(var i = 0; i < types.length; i++)
		   {
		    if(file.type === types[i])
		     {
		      return true;
		    }
		   }

		  return false;
		}

		function returnFileSize(number) {
		  if(number < 1024) {
		    return number + ' octets';
		  } else if(number >= 1024 && number < 1048576) {
		    return (number/1024).toFixed(1) + ' Ko';
		  } else if(number >= 1048576) {
		    return (number/1048576).toFixed(1) + ' Mo';
		  }
		}


function update(fichier) 
{
	alert('yomolar');
	var input = document.querySelector(fichier);
	var preview = document.querySelector('.Me_info_file');
	preview.style.border='1px solid black';
	preview.innerHTML='';

	if (fichier=='#Me_file1') //on efface la valeur du fichier qui n'a pas été selectionné
	{
		var type= fileType1;
		var reset2=document.querySelector('#Me_file2');
		reset2.value='';
	}
	else//on efface la valeur du fichier qui n'a pas été selectionné
	{
		var type=fileType2;
		var reset1=document.querySelector('#Me_file1');
		reset1.value='';
	}

  	while(preview.firstChild) 
  	{
    	preview.removeChild(preview.firstChild);
  	}
 
  var curFiles = input.files;
  if(curFiles.length === 0) 
  {
   $('.Me_info_file').html('');
   $('.Me_info_file').css('borderStyle','none');
  } 
  else
  {
    var list = document.createElement('ol');
    preview.appendChild(list);

   

    for(var i = 0; i < curFiles.length; i++) {
      var listItem = document.createElement('li');
      var para = document.createElement('p');

      // on verifie le type...
      if(curFiles[i].size>=2000000000)
      			{
					      	para.innerHTML='le fichier </strong>'+ curFiles[i].name+' est trop lourd veuillez choisir un autre moin volumineux';
					      	listItem.appendChild(para);
					      	document.querySelector('#submit2').disabled = true;
      			}
      else if(validFileType(curFiles[i],type)) 
      {
			        para.innerHTML = 'Nom du fichier: <strong>' + curFiles[i].name + '</strong><br/> taille: <strong>' + returnFileSize(curFiles[i].size) + '</strong>.';
			        var ado =para.innerHTML;
			        if(validFileType(curFiles[i],fileType2))
			        {
			        	var image = document.createElement('img');
			        	image.src = window.URL.createObjectURL(curFiles[i]);
			       		listItem.appendChild(image);
			        }
			        else
			        {
			        	
			        	para.innerHTML = '<i class="fas fa-file"></i><br>'+ ado;
			        }
			        
			        listItem.appendChild(para);
			        document.querySelector('#submit2').disabled = false;

      }

      else 
      {
        para.innerHTML = 'Non du fichier: <strong>' + curFiles[i].name + '</strong> Mauvais type de fichier ; modifier votre selection.';
        listItem.appendChild(para);
        document.querySelector('#submit2').disabled = true;


      }

      list.appendChild(listItem);
    }
  }
  preview.innerHTML=preview.innerHTML+'<div class="ME_progress" ><div class="ME_progress-bar"> </div></div><div class="ME_uploadStatus" ></div>'
}

function epingler_desepingler (id_block,pin_unpin)
{
	event.preventDefault();
	$.post
	({
		url:'traitement ajax/accueil_msg.php',
		data:
		{ 
			id_user:$('#ME_id_input').val(),
			id_message:$('#ME_id_last_message').val(),
			id_convers:id_block,
			action:pin_unpin,

		},

		success:function(data)
		{
							
			$('.AC_Me_box1b').html(data);
			console.log(" ac...");
							
		},
		error : function(resultat, statut, erreur)
		{
			console.log('echec d\'épinglage');
		}

	}); 
}

function archiver_desarchiver(id_block,archiv_unarchiv)
{
	event.preventDefault();
	$.post
	({
		url:'traitement ajax/accueil_msg.php',
		data:
		{ 
			id_user:$('#ME_id_input').val(),
			id_message:$('#ME_id_last_message').val(),
			id_convers_to_archive:id_block,
			action:archiv_unarchiv,

		},

		success:function(data)
		{
			if (archiv_unarchiv != 'archiver')
			{
				$('#'+id_block).remove();
			}
			else
			{
				$('.AC_Me_box1b').html(data);
				console.log(" ac...");
			}				
			
							
		},
		error : function(resultat, statut, erreur)
		{
			console.log('echec ');
		}
	})
}
function option(id_Menu)
{
	event.preventDefault();
	$(id_Menu + "+div").show();
	$(id_Menu + "+div").focus();
	$('.AC_Me_box1b').css({
					overflow: 'visible', 
				});
}
function enrouler(id_list)
{
	$(id_list).hide();
	$('.AC_Me_box1b').css({
					overflow: 'scroll', 
				});
}



