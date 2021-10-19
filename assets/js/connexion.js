$(document).ready(function(){

var result=true;
user=$('.C_user');
mdp=$(".C_mdp");
$("form").submit(function(){
if (user.val()==""){

	$("#C_error").css("display","block");
		$(".C_error").css("display","none");


	result=false;
}else{
		$("#C_error").css("display","none");
				$(".C_error").css("display","none");

				result=true;
}

if (mdp.val()==""){
	$("#C_error").css("display","block");
	result=false;
}else{
		$("#C_error").css("display","none");
		result=true;
}
return result;
});
user.keyup(function(){
	$(".C_error").css("display","none");
	$("#C_error").css("display","none");

});
mdp.keyup(function(){
	$(".C_error").css("display","none");
		$("#C_error").css("display","none");

});

});

