// JavaScript Document

$( document ).ready(function() {
    $( "#ni_LoginBtn" ).click(function() {
			ni_CheckLogin();					  
	});
});

function ni_CheckLogin() {
	console.log('ni_CheckLogin');
	var usuario=$('#ni_login_email').val();
	var senha=$('#ni_login_senha').val();
	console.log('useremail='+usuario);
	console.log('senha='+senha);
//	$('#mtFormLogin').trigger('loading-overlay:show');
//	$('#mtFormLoginAlert').hide();
 //	$("#mt_LoginBtn" ).hide(); // AQUI
	//$("#carregando" ).show();
	console.log(JSON.stringify({ "email" : usuario,"pass" : senha }));
	$.ajax({
		url: "checklogin.php",
		cache:false,
		method: "POST",
		data: { "email" : usuario,"pass" : senha },
	})
  	.done(function(msg) {
		var resposta = $.parseJSON(msg);
		if (false==resposta.success) {
			//$('#mtFormLoginAlert_Msg').html();
			//$('#mtFormLoginAlert').show();
			
			notificacao('Erro',resposta.message,'error');
			if(""!=resposta.campo){ $("#"+resposta.campo).focus(); }
			
//	 		$("#mt_LoginBtn" ).show(); // AQUIU
//			$("#carregando" ).hide();
		} else {
			notificacao('Sucesso',resposta.message,'success');
			window.location="/sistema/";
//			$("#mtRealLogin").val();
//			$("#mtRealSenha").val();
//			$("#mtRealToken").val(resposta.hash);
//			if(1==resposta.firsttime){ $("#mtLoginReal").attr("action","/sistema/m_minha_conta.php"); } // Primeira vez redireciona para o cadastro.
//			$('#mtLoginReal').submit();
		}
	})
	.fail(function(msg) {
		//$('#mtFormLoginAlert_Msg').html('Erro de Login: Falha ao verificar Login. Verifique link de Internet.');
		//$('#mtFormLoginAlert').show();
		
		notificacao('Erro','Falha ao verificar Login.<br>Verifique link de Internet.','error');
		
		console.log( "error" );
 //		$("#mt_LoginBtn" ).show(); // AQUI
	//	$("#carregando" ).hide();
	})
	.always(function(msg) {
//		$('#mtFormLogin').trigger('loading-overlay:hide');
		console.log( "complete" );
	});
	
}

//Notificação...
function notificacao(title,text,type){

	var myStack = {"dir1":"up", "dir2":"right", "push":"top"};
	new PNotify({
		title: title,
		text: text,
		delay:1200,
		type:type,
		animation:"fade"
	});
}