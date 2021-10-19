

$(document).ready(function(){

	var icone1=$('.EV_box2a3a');
icone1.click(function(){
	$('.EV_box2b').toggle('.EV_box2a');

});
var btn =$('.AE_ajout');
btn.click(function(){
	$('.AE_box2a').css('display','block');
});

var btn=$('.TAB_btn1');
btn.click(function(){
	$('.TAB_form1').toggle(500);
});
var btn=$('.TAB_btn1a');
btn.click(function(){
	$('.TAB_form2').css('display','block');
	$('.TAB_btn1a').css('display','none');
});
var btn=$('.TAB_btn1b');
btn.click(function(){
	$('.TAB_form3').css('display','block');
	$('.TAB_btn1b').css('display','none');
});

/*var btn=$('.TAB_btn11');
btn.click(function(){
    $('.TAB_2a11a').css('display','block');
});*/
/*var btn=$('.AC_btn2');
btn.click(function(){
	$('.AC_box2').css('display','block');
	$('.AC_box1').css('display','none');
});*/

// ajout client

$('.AC_btn2').click(function(){
var result=true;

if($('.nom_entrepise').val()==""){
$('.AC_error').css('display','block');
result=false;
}
else{

result=true;
}
if($('.nom_client').val()==""){
$('.AC_error').css('display','block');
}
else{

result=true;
}
if($('.adresse_client').val()==""){
$('.AC_error').css('display','block');
result=false;

}
else{

result=true;
}
if($('.tel_client').val()==""){

$('.AC_error').css('display','block');
result=false;

}
else{

var phone = $('.tel_client').val();
    
if(isNaN(phone)){
    if(phone.length>=9){

$('.AC_error2').css('display','none');
	

}else{
$('.AC_error2').text('Le minimum est 9 chiffres');

}
}else{

$('.AC_error2').css('display','block');
}
}

if($('.loc_client').val()==""){
$('.AC_error').css('display','block');
result=false;
}
else{

result=true;
}

if (result==true){

}else{
return result;
}
});

/* inscription*/

var btn=$('.ge_btn');
btn.click(function(){
    $('.ge_box').css('display','none');
    $('.i_bo').css('display','block');

});


nom=$('.nom');
prenom=$('.prenom');
mail=$('.mail');
login=$('.login');
tel=$('.tel');
loc=$('.loc');
role=$('.role');
mdp=$('.mdp');

$('form').submit(function(){

var result=true;

if(nom.val()==""){
$('#i_error').css('display','block');
result=false;
}
else{

result=true;
}
if(prenom.val()==""){
$('#i_error').css('display','block');
result=false;
}
else{

result=true;
}
if(mail.val()==""){
$('#i_error').css('display','block');
result=false;
}
else{

result=true;
}
if(login.val()==""){
$('#i_error').css('display','block');
result=false;
}
else{

result=true;
}
if(tel.val()==""){
$('#i_error').css('display','block');
result=false;
}
else{

result=true;
}
if(role.val()==""){
$('#i_error').css('display','block');
result=false;
}
else{

result=true;
}
if(loc.val()==""){
$('#i_error').css('display','block');
result=false;
}
else{

result=true;
}
if(mdp.val()==""){
$('#i_error').css('display','block');
result=false;
}
else{

result=true;
}

return result;
});

nom.keyup(function(){
 $('#i_error').css('display','none');   
});
prenom.keyup(function(){
 $('#i_error').css('display','none');   
});
mail.keyup(function(){
 $('#i_error').css('display','none');   
});
login.keyup(function(){
 $('#i_error').css('display','none');   
});
tel.keyup(function(){
 $('#i_error').css('display','none');   
});
role.keyup(function(){
 $('#i_error').css('display','none');   
});
loc.keyup(function(){
 $('#i_error').css('display','none');   
});
mdp.keyup(function(){
 $('#i_error').css('display','none');   
});






// recontre avce le client#

$('.AC_btn3').click(function(){
var result=true;

if($('.date_rencontre').val()==""){
$('.AC_error2').css('display','block');
result=false;
}
else{

result=true;
}
if($('.time_rencontre').val()==""){
$('.AC_error2').css('display','block');
}
else{

result=true;
}
if($('.motif_rencontre').val()==""){
$('.AC_error2').css('display','block');
result=false;

}
else{

result=true;
}

if($('.AC_area').val()==""){
$('.AC_error2').css('display','block');
result=false;

}
else{

result=true;
}
return result;
});

//rencontre client3

var btn=$('.LC3_btn');
btn.click(function(){
    $('.LC3_box2').css('display','block');
     $('.LC3_box1').css('display','none');
     $('.LC_p1').css('display','none');
   

});

//Ajouter un evenement
	
$('.AE_ajout').click(function(){
		var result=true;
if($('.theme').val()==""){
	$('.AC_error2').css('display','block');
result=false;

}else{
result=true;
}
if($('.type_eve').val()==""){
	$('.AC_error2').css('display','block');
result=false;

}else{
result=true;
}
if($('.date').val()==""){
	$('.AC_error2').css('display','block');
result=false;

}else{
result=true;
}
if($('.AE_time').val()==""){
	$('.AC_error2').css('display','block');
result=false;

}else{
result=true;
}

if($('.EV_text').val()==""){
	$('.AC_error2').css('display','block');
result=false; 

}else{
result=true;
}
return result;
});



// projet_equipe

$('.AP_btn3').click(function(){
   
		var result=true;
if($('.AP_equipe2').val()==""){
	$('.AP_error2').css('display','block');
    result=false;
}
if(result==true){
}
else{
return result;
}
});
});


function deconnexion(){
        $.ajax({
        url: "index.php?module=utilisateur&action=deconnexion",
        type: "POST",
        success: function(msg){
            },
        error: function(msg){
        // On alerte d'une erreur
        alert('Erreur');
        },
    });
}

function afficher(para2){
        var p = "#" + para2 + "b";
        $(p).toggle(300);
    }

function afficher2(para2){
        var p = "#" + para2 + "d";
        $(p).toggle(300);
    }
    

function afficher3(para2){
        var p = "#" + para2 + "a";
        $(p).toggle(300);
    }
    
	function affiche(para3){
        var p = "#" + para3 + "c";
        $(p).toggle(300);
    }