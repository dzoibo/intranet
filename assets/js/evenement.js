
$(document ).ready(function()
 {		
 		
    	$('.ev_derouler_participant').mouseover(function()
		{
			 $(this).css('overflowY','scroll');
		});

		$('.ev_derouler_participant').mouseleave(function()
		{
			 $(this).css('overflowY','hidden')
		});


		$('.EV_alter,#EV_archive,#EV_all,#EV_mois').mousedown(function()
		{
			 $(this).css({
			 	boxShadow: '2px 2px 2px 2px rgb(84, 138, 167)'
			 });
		});

		$('.EV_alter').mouseup(function()
		{
			 $(this).css({
			 	boxShadow: '2px 2px 2px 2px #a5a1a1'
			 });
		});


		if (!($(".EV_afficher").children().length>1)) //ces trois conditions sont pour les cas ou il y'a aucun évenement chez un utilisateur...
		{
			$(".EV_afficher").html('<h4 style="margin:auto; width:90%">Aucun évenement pour le moment, cliquer sur "Archives" pour voir les évenements passés</h4>');
		}
		if (!($(".EV_afficher2").children().length>1)) 
		{
			$(".EV_afficher2").html('<h4 style="margin:auto; width:90%">Vous n\'avez aucun évenement ce mois</h4>');
		}
		if (!($(".EV_afficher3").children().length>1)) 
		{
			$(".EV_afficher3").html('<h4 style="margin:auto; width:90%">Aucun évenement archivé</h4>');
		}
		
		

		//on passe maitenant aux requétes ajax...

		$('#EV_archive').mouseup(function()
		{

			 $(this).css({
			 	backgroundColor: '#f1f4ed',
			 	marginTop:'4px' ,
			 	marginBottom: '2px',
				boxShadow: '3px 3px 3px 0px #a5a1a1',
				height: '5vh',
				
			 });
			 $('#EV_all,#EV_mois').css({
			 	marginTop:'0px' ,
			 	paddingTop: '2px',
			 	height: 'auto',
		 		width: '30%',
		 		textAlign: 'center',
		 		marginBottom:'2px',
				backgroundColor: '#dadde4',
				zIndex: '0',
				boxShadow:'none',
			 });


			if($('EV_afficher1').is(":visible"))
			{

			}
			else 
			{
							 $('.EV_afficher').hide();
							 $('.EV_afficher2').hide();
							 $('.EV_afficher1').show();
							 $('.EV_afficher3').hide();
							 $('.EV_afficher4').hide();
			}
			
		});

		$('#EV_all').mouseup(function()
		{
			 $(this).css({
			 	backgroundColor: '#f1f4ed',
			 	marginTop:'4px' ,
			 	marginBottom: '2px',
				boxShadow: '3px 3px 3px 0px #a5a1a1',
				height: '5vh',
			 });
			 $('#EV_archive,#EV_mois').css({
			 	marginTop:'0px' ,
			 	paddingTop: '2px',
			 	height: 'auto',
		 		width: '30%',
		 		textAlign: 'center',
		 		marginBottom:'2px',
				backgroundColor: '#dadde4',
				zIndex: '0',
				boxShadow:'none',
			 });

			 if($('.EV_afficher').is(":visible") )
			 {

			 }
			 else
			 {
			 	$('.EV_afficher').show();
			    $('.EV_afficher2').hide();
				$('.EV_afficher1').hide();
				$('.EV_afficher3').hide();
				$('.EV_afficher4').hide();
			 }

							
							
		});


		$('#EV_mois').mouseup(function()
		{
			 $(this).css({
			 	backgroundColor: '#f1f4ed',
			 	marginTop:'4px' ,
			 	marginBottom: '2px',
				boxShadow: '3px 3px 3px 0px #a5a1a1',
				height: '5vh',
			 });
			 $('#EV_archive,#EV_all').css({
			 	marginTop:'0px' ,
			 	paddingTop: '2px',
			 	height: 'auto',
		 		width: '30%',
		 		textAlign: 'center',
		 		marginBottom:'2px',
				backgroundColor: '#dadde4',
				zIndex: '0',
				boxShadow:'none',
			 });

			 if($('.EV_afficher2').is(":visible"))
			{

			}
			else 
			{
							 $('.EV_afficher').hide();
							 $('.EV_afficher1').hide();
							 $('.EV_afficher2').show();
							 $('.EV_afficher3').hide();
							 $('.EV_afficher4').hide();

			}
			
		});


		$('.EV_search').keyup(function()
		{

			$('#EV_mois,#EV_archive,#EV_all').css({
			 	marginTop:'0px' ,
			 	paddingTop: '2px',
			 	height: 'auto',
		 		width: '30%',
		 		textAlign: 'center',
		 		marginBottom:'2px',
				backgroundColor: '#dadde4',
				zIndex: '0',
				boxShadow:'none',
			 });


			if($(this).val().length>=1)
			{
				$.post({
							url:'traitement ajax/ajax_evenement.php',
							data:'valeur=rechercher&contenu='+ $(this).val(),
							dataType:'html',
							success: function (data) 
											{
								           		 console.log('Submission was successful.');
								               	 console.log(data);
								               	  $('.EV_afficher3').html(data);
								           		  $('.EV_afficher').hide();
												  $('.EV_afficher1').hide();
												  $('.EV_afficher2').hide();
											   	  $('.EV_afficher3').show();
											   	  $('.EV_afficher4').hide();
											   	 
								               	
            								 },
            								 error: function (data)
							{
								$('.EV_afficher3').html('&nbsp&nbsp&nbsp&nbsp  <i class="far fa-sad-tear"></i>&nbsp Erreur:Verifiez votre connexion au serveur...<br/>');
							}
					   });

			}
				else 
			{
				
						  $('.EV_afficher3').hide();
								               	 
			}
    			
		});

		

});

function selectedFile(fichier,block)
{
   var preview=document.querySelector(block);
   var input=document.querySelector(fichier);


    var curFiles=input.files;
     
    if(curFiles.length !== 0)
    {
    	
   	  if(document.querySelector(block).querySelector('.EV_label_titre').style.display!="none")
   	  {
   	  	var rep= confirm("Voulez vous remplacer ce rapport");
   	  	if(!rep)
   	  	{
   	  		exit();
   	  	}
   	  }
   	  document.querySelector(block).querySelector('.EV_progress-bar').style.display="block";
      document.querySelector(block).querySelector('.EV_progress-bar').style.width="0";
      document.querySelector(block).querySelector('.EV_uploadStatus').style.display="block";
      document.querySelector(block).querySelector('.EV_uploadStatus').innerHTML=" ";
   	  document.querySelector(block).querySelector('.EV_label_titre').style.display = "none" ;
      for(var i = 0; i < curFiles.length; i++) 
      {

          var listItem = preview.querySelector('span');
          var para = preview.querySelector('.EV_file_contenair');

          if(curFiles[i].size>=50000001)
          {
            listItem.innerHTML='le fichier <strong>'+ CoupePhrase(curFiles[i].name,35) +'</strong> est trop lourd ';
            preview.querySelector('.EV_submit_box').style.display = "none";
          }
          else if(curFiles[i].type==='application/pdf' )
          {
             listItem.innerHTML = '' + CoupePhrase(curFiles[i].name,35) + '<br/> taille: ' + returnFileSize(curFiles[i].size) + '';
             para.innerHTML='<i class="fas fa-file-pdf ev_pdf"></i>';
             preview.querySelector('.EV_submit_box').style.display = "flex";
             $('.ev_pdf').css( 'color' ,'#f53b57');

          }
          else
          {
            listItem.innerHTML =  '<strong>'+ CoupePhrase(curFiles[i].name,35)+ ':</strong><br/> Mauvais type de fichier!!';
            document.querySelector('.EV_submit_box').style.display = "none";
    
          }
      }
    }
}
function returnFileSize(number)
	 {
	      if(number < 1024) {
	        return number + ' octets';
	      } else if(number >= 1024 && number < 1048576) {
	        return (number/1024).toFixed(1) + ' Ko';
	      } else if(number >= 1048576) {
	        return (number/1048576).toFixed(1) + ' Mo';
	      }
    }

function CoupePhrase(str,long)
	{
					 if(str.length <= long)
					 {
					        str = str;
					        return str;
					 } 
					 else
					 {
					 	str = str.substring(0,long);
					 	return str+'...';
					 }
					 
	}
		
function envoyer(idform,progress,statut)
	{
    	event.preventDefault();

		if ($(idform+' input').val().length==="0")
		{
			
			alert("Erreur de selection de fichier...");
		}
		else
		{
			var form = $(idform)[0];
			var data = new FormData(form);	
			data.append('id_auteur',$('#EV_id_auteur_delete').val());
			$.ajax
			({	

				url : 'traitement ajax/ajax_evenement.php',
				type : 'POST',
				enctype: 'multipart/form-data',
				data: data,
				processData: false,//indique à jQuery qu'il ne doit pas traiter les données 
				contentType: false,//indique à  de ne pas configurer le type content
				cache: false,
				timeout: 600000,
				xhr: function() 
				{
	                var xhr = new window.XMLHttpRequest();
	                xhr.upload.addEventListener("progress", function(evt) {
	                    if (evt.lengthComputable) {
	                        var percentComplete = ((evt.loaded / evt.total) * 100);
	                        $(progress).width(percentComplete + '%');
	                        $(statut).html(percentComplete+'%');
	                        if (percentComplete==100)
	                        {
	                        	$(progress).fadeOut("slow");
	                        	$(statut).fadeOut("slow");
	                        }

	                    }
	                }, false);
	                return xhr;
	            },
	            beforeSend: function()
	            {
	                $(progress).width('0%');
	                $(statut).html('');
	            },
				success : function(reponse)
				{
					form.reset() ;
					document.querySelector(idform).querySelector('.EV_submit_box').style.display = "none" ;
					document.querySelector(idform).querySelector('.EV_label_titre').style.display = "block" ;
					console.log(reponse);
					
				},
				error: function(reponse)
				{
					alert('Erreur de chargement de fichier');
				}

			});
		}
		
	};
//evenements pour la supression...
function Supprimer(id_block)
{
  var r = confirm("L'événement va être Supprimé");
  if (r== true) 
  {
    $.post({
				url:'traitement ajax/ajax_evenement.php',
				data:'valeur=delete'+id_block+'&id_auteur_delete='+ $("#EV_id_auteur_delete").val(),
				dataType:'html',
				success: function (data) 
					{
				     	 console.log('suppression réussie.');
				     	 console.log(data);
		       	         $(id_block).hide();

            				},
            	error : function(data){
            		 console.log('Erreur de connexion.');}

		 });
  } 
	
}

