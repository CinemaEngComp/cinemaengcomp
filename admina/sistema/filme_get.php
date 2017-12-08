<?
	header("Content-Type: text/xml; charset=ISO-8859-1",true);
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");	

	include "n_connector.php";		


$newQuery=" SELECT * FROM filmes  ";

	require_once("../../lib/javascript/dhtmlxSuite_v30/dhtmlxConnector_php/codebase/grid_connector.php");


//	saveLOG("FIN TIPOESPECIAL - SELECT",$newQuery,$cookie_cod_usr,2);
	
$grid = new GridConnector($dbcnx);
$grid->set_encoding("ISO-8859-1");
//$grid->enable_log("n_caixa_adiantamento_LOG.txt",true);

$grid->render_sql($newQuery,"codigo_filme","codigo_filme,nome_filme,genero_filme,dat_inivig,dat_fimvig,duracao_filme,classificacao_filme,sinopse_filme,caminho_banner");


?>