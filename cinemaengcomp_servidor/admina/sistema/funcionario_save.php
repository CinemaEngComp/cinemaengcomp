<? header("Content-Type: text/html; charset=ISO-8859-1",true); ?>
<?php
    //the php file must be recognized as XML document so necessary header sent
    header("Content-type:text/xml");

	session_start();
	require_once "n_connector.php";

	
$index			= $_GET['c0'];
$descricao		= $_GET['c1'];

$txt_erro 	= "";
$txt_sql 	= "";
$novoid="";
function insert_row($get) {
	global $cod_emp;
	global $permissao;
	global $bloqueio;	
	global $txt_error;	
	global $txt_sql;
	global $novoid;

	$descricao	=nucci_utf8_decode(mychecksintaxe_GRID($descricao));
	
	$sql = " INSERT into cadastro_usuario SET  ";
	$sql.= " nome	='".$get['c1']."' ";
	$sql.= ",cpf	='".$get['c2']."' ";
	$sql.= ",dat_nascimento	='".$get['c3']."' ";
	$sql.= ",sexo	='".$get['c4']."' ";
	$sql.= ",endereco	='".$get['c5']."' ";
	$sql.= ",numero	='".$get['c13']."' ";
	$sql.= ",bairro	='".$get['c6']."' ";
	$sql.= ",cidade	='".$get['c7']."' ";
	$sql.= ",uf	='".$get['c8']."' ";
	$sql.= ",cep	='".$get['c9']."' ";
	$sql.= ",email	='".$get['c10']."' ";
	$sql.= ",senha	='".$get['c11']."' ";
	$sql.= ",confirma_senha	='".$get['c12']."' ";
	$sql.= ",funcionario_qrcode	=1 ";


	$res = mysql_query($sql);
	$novoid=mysql_insert_id();
	$txt_error = mysql_error();
	
	$txt_sql = $sql;
	if(!$res){
		return "error";
	} else {
		return "insert";	
	}

}
function update_row($id,$get){
	global $cod_emp;
	global $permissao;
	global $bloqueio;	
	global $txt_error;	
	global $txt_sql;
	
//	list($cto,$serie,$pr)=split("#",$idcto);

	$descricao	=nucci_utf8_decode(mychecksintaxe_GRID($descricao));
	
	$sql = " UPDATE cadastro_usuario SET  ";
	$sql.= " nome	='".$get['c1']."' ";
	$sql.= ",cpf	='".$get['c2']."' ";
	$sql.= ",dat_nascimento	='".$get['c3']."' ";
	$sql.= ",sexo	='".$get['c4']."' ";
	$sql.= ",endereco	='".$get['c5']."' ";
	$sql.= ",numero	='".$get['c6']."' ";
	$sql.= ",bairro	='".$get['c7']."' ";
	$sql.= ",cidade	='".$get['c8']."' ";
	$sql.= ",uf	='".$get['c9']."' ";
	$sql.= ",cep	='".$get['c10']."' ";
	$sql.= ",email	='".$get['c11']."' ";
	$sql.= ",senha	='".$get['c13']."' ";
	$sql.= ",confirma_senha	='".$get['c13']."' ";
	$sql.= ",funcionario_qrcode	=1 ";
	$sql.= " WHERE cod_usr = ".$id." ";
	$res = mysql_query($sql);
	$txt_error = mysql_error();
//	saveLog("CONTABIL HISTORICO SAVE update_row",$sql." - ".mysql_error(),1,NUCCI_ERROR_RESTRICTED);
	
	$txt_sql = $sql;
	if(!$res){
		return "error";
	} else {
		return "update";	
	}
}

function delete_row($id,$index,$descricao){
	global $cod_emp;
	global $permissao;
	global $bloqueio;	
	global $txt_error;	
	global $txt_sql;
	
//	list($cto,$serie,$pr)=split("#",$idcto);


	$sql = " delete from tbl_fin_contabil_historico WHERE cod_fchist=$id ";
	$res = mysql_query($sql);
	$txt_error = mysql_error();
	saveLog("CONTABIL HISTORICO delete_row",$sql." - ".mysql_error(),1,NUCCI_ERROR_RESTRICTED);
	
	$txt_sql = $sql;
	
	if(!$res){
		return "error";
	} else {
		return "delete";	
	}
}



//include XML Header (as response will be in xml format)
header("Content-type: text/xml");
//encoding may differ in your case
echo('<?xml version="1.0" encoding="iso-8859-1"?>'); 


$mode = $_GET["!nativeeditor_status"]; //get request mode
$rowId = $_GET["gr_id"]; //id or row which was updated 
$newId = $_GET["gr_id"]; //will be used for insert operation


switch($mode){
	case 'inserted': 
		$action = insert_row($_GET);
		$newId=$novoid;
		break;
	case 'deleted': 
//		$action = delete_row($rowId,$index,$descricao);
		break;
	case 'updated':
		//row updating request
		$action = update_row($rowId,$_GET);
		break;
}

//output update results
$retorno = "\n<data>";
$retorno.= "\n  <action type='".$action."' sid='".$rowId."' tid='".$newId."'/>";
$retorno.= "\n  <sql>\n    ".$txt_sql."\n  </sql>";
if(""!=trim($txt_error)) $retorno.= "\n  <txterro>\n    ".$txt_error."\n  </txterro>";
$retorno.= "\n</data>";

print($retorno);
