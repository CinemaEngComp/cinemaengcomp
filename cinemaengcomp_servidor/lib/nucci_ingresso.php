<?
//
// Nucci Ingresso
//


define('Nucci_INGRESSO','1.0.0');

class Nucci_Ingresso {

	//Private properties
	var $internal_key;		// Crypt Key;
    var $dbh;
    var $inidb;
    var $ini_path;

    var $debug;
    var $error_code;
    var $error_string;
	var $error_mysql_error_msg;
    var $bUsingDefault;

    var $fr_info= array();

	var $localpath;



	// Calculo
	/*******************************************************************************
	*                                                                              *
	*                               Public methods                                 *
	*                                                                              *
	*******************************************************************************/

// Parametros


	function Nucci_Ingresso ($fr_init_param) {

		// checa parametros
		$this->error_code=0;
		$dbh= @mysql_connect($fr_init_param["db_host"], $fr_init_param["db_user"], $fr_init_param["db_pass"]);
		if (!$dbh) {
			$this->error_code=1;
			return $this->error_code;
		}

		if (! @mysql_select_db($fr_init_param["db_database"]) ) {
			$this->error_code=2;
			return $this->error_code;
		}
//echo "<BR>COD_USR=|".$fr_init_param["cod_usr"]."| <BR>";
//echo "<BR>COD_USR=|".$this->mychecksintaxe_num($fr_init_param["cod_usr"])."| <BR>";

		if (0>=$this->mychecksintaxe_num($fr_init_param["cod_usr"]))  {
			$this->error_code=3;
			return $this->error_code;
		}
		$this->fr_info		=$fr_init_param;

		$this->fr_info['default_serie']='UN';
		if (isset($this->fr_info['serie_nfs'])) {
			$this->fr_info['default_serie']=$this->fr_info['serie_nfs'];
		}
		if (!isset($this->fr_info['debug'])) {
			$this->fr_info['debug']=0;
		}
		if (1==$this->fr_info['debug']) {
			print_r($fr_init_param);
		}
		// OK.. processa tudo
		return 0;

	}

	function mychecksintaxe_num($valor) {

		$valor	=ereg_replace(',','.',$valor);
		if (""==trim($valor)) {$valor=0;}

		return $valor;		
	}
	function NUCCI_ExecScriptEVAL($script) {
		global $localhost;
		$a_script=split(";",$script);
		foreach ($a_script as $key => $script_line) {
			$script_line.=";";
//			echo "<p>->script_line=$script_line</P>\n";
		   eval($script_line);
		}
	}	
	function no_acentos($myvalor){
		$array_____acentos=array("á","â","ã","à","Á","Â","Ã","À","é","ê","É","Ê","í","Í","ó","ô","õ","Ó","Ô","Õ","ú","ü","Ú","Ü","ç","Ç");
		$arrray_no_acentos=array("a","a","a","a","A","A","A","A","e","e","E","E","i","I","o","o","o","O","O","O","u","u","U","U","c","C");
		$myvalor=str_replace($array_____acentos,$arrray_no_acentos,$myvalor);
		return $myvalor;
	}
	function format_moeda($myvalor){
		$strReturn="R$".number_format($myvalor,2,",",".");
		return $strReturn;
	}
	function format_numero($myvalor){
		$strReturn=number_format($myvalor,2,",",".");
		return $strReturn;
	}
	function CheckCampo($dadosNFS,$campo="",$padrao="") {
		if (isset($dadosNFS[$campo])) {
			return " $campo=\"".$this->nucci_mysql_real_escape_string($dadosNFS[$campo])."\" ";
		}
		return " $campo='".$padrao."' ";
	}	
	function CheckCampoSimples($valor,$campo="",$padrao="") {
		if (isset($valor)) {
			return " $campo='".$valor."' ";
		}
		return " $campo='".$padrao."' ";
	}		
	function nucci_mysql_real_escape_string($valor) {
		if (get_magic_quotes_gpc()) {
			return $valor;
		} else {
			return mysql_real_escape_string($valor);
		}
	}
	function mychecksintaxe_numCNPJCPF($valor) {

		$valor	=ereg_replace("\.","",$valor);
		$valor	=ereg_replace("\,","",$valor);
		$valor	=ereg_replace("\-","",$valor);
		$valor	=ereg_replace("\/","",$valor);

		return $valor;		
	}

	function fixcalculo_casadecimal($valor) {
//		return $valor;
		return round($valor,2);
	}

	function GetErroCode() {
		return $this->error_code;
	}
	
	function GetErroString() {
		$myreturn="";
		switch ($this->error_code) {
			case 0: $myreturn="Sem erros."; break;
			case 1: $myreturn="Dados de servidor com problemas."; break;
			case 2: $myreturn="Banco de Dados com problemas."; break;
			case 3: $myreturn="Sem usuário emissor definido."; break;

			case 10: $myreturn="Empresa não encontrada."; break;
			case 11: $myreturn="Lista de Notas Fiscais (cod_not) vazia."; break;
			case 20: $myreturn="Não foi possível achar a Nota Fiscal solicitada."; break;
			case 40: $myreturn="Não foi possível inserir um produto na Nota Fiscal."; break;
			case 45: $myreturn="Não foi possível inserir um vencimento (duplicata) na Nota Fiscal."; break;
			case 200: $myreturn="Nota Fiscal já existente no banco de dados."; break;
			case 300: $myreturn="Impossível inserir produto sem uma Nota Fiscal."; break;
			case 310: $myreturn="Produto já existente na Nota Fiscal."; break;
			case 540: $myreturn="Não é possível cancelar a Nota Fiscal por estar linkada a outro documento ativo."; break;

		
		}
		$myreturn.=$this->error_string;		
		return $myreturn;
	}
	function GetErroStringAdicional() {
		return $this->error_string;
	}	
	function GetErroString_DB_Adicional() {
		return $this->error_mysql_error_msg;
	}	


	function saveLOG ($titulo,$descricao,$usuario,$tipo) {

//		if (""==$usuario) {
//			$this->error_code	=10;
//			return $this->error_code;			
//		}

		$usuario=$this->fr_info['cod_usr'];
	
		$descricao=mysql_escape_string($descricao);
		$sqlLOG 	 = " INSERT INTO tbl_log SET ";
		$sqlLOG  	.= " dtdata_log 	= now(),
						mdesc_log	= \"$descricao\",
						tbl_usuario_cod_usr = $usuario,
						tbl_nucci_tipo_log_cod_tplog = $tipo,
						stitulo_log = '$titulo' 
					";
		$rstLOG = mysql_query($sqlLOG);
		if (!$rstLOG) {
			$this->error_mysql_error_msg=mysql_error();
			$this->error_code	=300;
			return $this->error_code;			
		}
	}	


}



?>
