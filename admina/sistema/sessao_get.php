<?
	header("Content-Type: text/xml; charset=ISO-8859-1",true);
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");	

	include "n_connector.php";		


$newQuery=" SELECT * FROM sessao inner join filmes on sessao.codigo_filme=filmes.codigo_filme  where sessao.codigo_filme=$f ";

	require_once("../../lib/javascript/dhtmlxSuite_v30/dhtmlxConnector_php/codebase/grid_connector.php");


//	saveLOG("FIN TIPOESPECIAL - SELECT",$newQuery,$cookie_cod_usr,2);
	
$grid = new GridConnector($dbcnx);
$grid->set_encoding("ISO-8859-1");
//$grid->enable_log("n_caixa_adiantamento_LOG.txt",true);

$grid->render_sql($newQuery,"codigo_sessao","codigo_sessao,nome_filme,codigo_sala,data_sessao,horario_sessao,codigo_filme");


?>