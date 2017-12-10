<?
/*****************************************/
$paginaMOBITRUCK="index"; // Essa variável faz com que essa página não fique em loop - GLA 30/08/2016
require_once "n_connector.php";
/*****************************************/

	$hashid="";
	$campo = "";
	
	if(""==trim($email)){
		
		$retorno = false;
		$mensagem = "Digite seu email.";
		$campo = "email";
	}
	elseif(!fn_ValidaEmail($email)){
		
		$retorno = false;
		$mensagem = "Digite um email válido";
		$campo = "email";
	}
	else
	{
		saveLOG('LOGIN ',$email." - ".$pass,1,2);		
		$mysql = " SELECT * FROM cadastro_usuario WHERE (email='$email') and funcionario_qrcode=1   limit 1 " ;
		$myresult = mysql_query($mysql);
		$myrow = mysql_fetch_array($myresult);
		saveLOG('LOGIN2',print_r($myrow,true),1,2);	
	


		if ( ($myrow['email']==$email) and ($myrow['senha']==$pass)) {
				$retorno = true;
				$mensagem = "Logado com sucesso!";

				// 
				$cookie_cod_usr=$myrow['cod_usr'];
				$cookie_usuario=$myrow;
				session_register("cookie_cod_usr");
				session_register("cookie_usuario");


		} else {
			$retorno = false;
			$mensagem = "Email ou senha errada.";

		}
		
	}

	$array = array("success" => $retorno,"message" => $mensagem,"hash" => $hashid, "pos" => date("Ymdhis"), "campo"=> $campo,"firsttime"=>$firsttime);
	echo json_encode($array);
	exit;

function fn_ValidaEmail($mail){
	if(preg_match("/^([[:alnum:]_.-]){3,}@([[:lower:][:digit:]_.-]{3,})(\.[[:lower:]]{2,3})(\.[[:lower:]]{2})?$/", $mail)) {
		return true;
	}else{
		return false;
	}
}




?>