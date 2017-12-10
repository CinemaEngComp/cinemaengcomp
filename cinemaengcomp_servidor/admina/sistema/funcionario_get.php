<?
	header("Content-Type: text/xml; charset=ISO-8859-1",true);
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");	

	include "n_connector.php";		


$newQuery.=" SELECT * FROM cadastro_usuario WHERE  funcionario_qrcode=1 ";

	require_once("../../lib/javascript/dhtmlxSuite_v30/dhtmlxConnector_php/codebase/grid_connector.php");


//	saveLOG("FIN TIPOESPECIAL - SELECT",$newQuery,$cookie_cod_usr,2);
	
$grid = new GridConnector($dbcnx);
$grid->set_encoding("ISO-8859-1");
//$grid->enable_log("n_caixa_adiantamento_LOG.txt",true);

$grid->render_sql($newQuery,"cod_usr","cod_usr,nome,cpf,dat_nascimento,sexo,endereco,numero,bairro,cidade,uf,cep,email,senha,confirma_senha");


?>