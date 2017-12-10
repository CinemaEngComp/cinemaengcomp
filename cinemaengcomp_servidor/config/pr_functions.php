<?

/*
	***Histórico de Alteração***
	Feito por: JB
	Data: 20/07/2010
	Descrição: Mudança no cálculo do prazo efetivo para calcular a performance. Calculo considera agora cidade e uf de entrega para checar se não é feriado regional
	Funções Alteradas: DoCalculaPerformanceEntrega
	Funcões Criadas: CheckHoliday

*/
// mychecksintaxe_num
// myGetDateTime
// 29/07/2010 - FCV - Inclusão função mychecksintaxe_num_PC

/*
	***Histórico de Alteração***
	Feito por: JB
	Data: 05/08/2010
	Tipo: Corretiva
	Descrição: Estava sem os parâmetros de cidade e uf de entrega na função de calculo da performance
	Funções Alteradas: DoCalculaPerformanceEntrega

*/

/*
	***Histórico de Alteração***
	Feito por: JB
	Data: 05/08/2010
	Tipo: Corretiva
	Descrição: Setar cookie do digito da conta de motorista e proprietário
	Funções Alteradas: SetCookieMotor,SetCookieVeic

*/

/*
	***Histórico de Alteração***
	Feito por: JB
	Data: 01/11/2010
	Tipo: Corretiva
	Descrição: Colocar parâmetro da função para setar a qtd de casas decimais
	Funções Alteradas: fixcalculo_casadecimal

*/

/*
	***Histórico de Alteração***
	Feito por: JB
	Data: 24/02/2011
	Tipo: Corretiva
	Descrição: Mudança de horário de verão, soma 3600 segundos para não errar no cálculo da DLE.
	Funções Alteradas: DoCalculaPerformanceEntrega

*/
// 16/04/2011 - FCV - Inclusão função __validCerts

/*
	***Histórico de Alteração***
	Feito por: JB
	Data: 07/07/2011
	Tipo: Corretiva
	Descrição: Verificar extensão jpeg da pasta de comprovantes em arquivo
	Funções Alteradas: CheckScan

*/

/*
	***Histórico de Alteração***
	Data: 22/11/2011
	Feito por: JB
	Tipo: Desenvolvimento
	Descrição: Implantação de autenticação SMTP
	função alterada: SendEmail
*/

/*
	***Histórico de Alteração***
	Feito por: JB
	Data: 16/12/2011
	Descrição: Funcao para checar se é IE
	Funções Alteradas: using_ie

*/
// FCV - 05/02/2012 - Insere/Atualiza Empresa para ficar padronizado em todos os módulos
// GUGU - 21/01/2013 - certificadoValidade() Verifica validade do certificado digital das unidades e manda email caso estiver para vencer
/*
	***Histórico de Alteração***
	Feito por: JB
	Data: 25/03/2013
	Descrição: troca de ereg_replace(deprecated) por str_replace
	Funções Alteradas: mychecksintaxe_num

*/
/*
	***Histórico de Alteração***
	Feito por: JB
	Data: 08/04/2013
	Descrição: incluído o filtro do pr atual no sql
	Funções Alteradas: getWHEREFILTRO_CTRC

*/
/*
	***Histórico de Alteração***
	Feito por: JB
	Data: 17/04/2013
	Descrição: flag para nao echoar selected na combo
	Funções Alteradas: montar_combo_exclusive

*/

/*
	***Histórico de Alteração***
	Feito por: JB
	Data: 19/04/2013
	Descrição: incluído o filtro do pr atual no sql
	Funções Alteradas: getWHEREFILTRO_MINUTA

*/
/*
	***Histórico de Alteração***
	Feito por: JB
	Data: 15/05/2014
	Descrição: arrumada a funcao de formatacao de data
	Funções Alteradas: ordenarDate

*/
// FCV - 04/05/2016 - Inclurcao Funcao NUCCI_GetArrayfromDHTMLSerialize - Para converter XML do Serialize do DHTML para array normal
// GLA - 24/06/2016 - Comentei essas duas linhas da função getWHEREFILTRO_NOTA, para que o DHTMLX do Gerenciamento NOTA FISCAL funcione certinho. As linhas comentadas são só pra DEBUG.

/*
	***Historico de Alteracao***
	Feito por: JB
	Data: 26/07/2016
	Descricao: criada a funcao getGRIDOCORRENCIA
*/
// FCV- 01/02-17 - session_register 

/*
	***Historico de Alteracao***
	Feito por: JB
	Data: 24/08/2017
	Descricao: criada a funcao nucci_trim
*/

/*
	***Historico de Alteracao***
	Feito por: JB
	Data: 29/08/2017
	Descricao: criada a funcao GetMotoristaFromPlaca
*/
// FCV - 05/10/2017 - Ajuste função GetInfoEmpresaFULL_ibge para utilizar mysql_fetch_assoc no lugar de mysql_fetch_array

function nucci_mysql_real_escape_string($valor) {
	if (get_magic_quotes_gpc()) {
		return $valor;
	} else {
		return mysql_real_escape_string($valor);
	}
}	
function nucci_GetServerOS() {
	if (!empty($_SERVER['SERVER_SOFTWARE']) && strstr($_SERVER['SERVER_SOFTWARE'], 'Win32')) {
		return "Windows";
	} else {
		return "Linux";
	}
}

function nucci_utf8_encode($valor) {
	$os=nucci_GetServerOS();
	if ("Windows"==$os) {
//		return utf8_encode($valor);
		return ($valor);
	} else {
		return ($valor);
	}
}

function nucci_utf8_decode($valor) {
	$os=nucci_GetServerOS();
	if ("Windows"==$os) {
		return utf8_decode($valor);
	} else {
		return utf8_decode($valor);
	}
}

function nucci_strtoupper($var){
//	$aux = strtoupper(strtr(nucci_utf8_decode($var) ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
//	$aux = strtoupper(strtr(utf8_decode($var) ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));
	$aux = strtoupper(strtr(nucci_utf8_decode($var) ,"áéíóúâêôãõàèìòùç","ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ"));

	return $aux;
}


	function NUCCI_ExecScriptEVAL($script) {
		global $localhost;
		global $localpath;
		global $manual;
		$a_script=split(";",$script);
		foreach ($a_script as $key => $script_line) {
			if(""!=trim($script_line)) {
				$script_line.=";";
//			echo "<p>->script_line=$script_line</P>\n";
			   eval($script_line);
			}
		}
	}
function chkvalidadecookie($mycookie_cod_usr){
	if(""==$mycookie_cod_usr){
		$myreturn=0;
	}else{
		$myreturn=1;
	}
	return $myreturn;

}
	function GetNota($cod_nota=0,$filtro=""){
		$str = " SELECT * from tbl_nota ";
		if (0<$cod_nota) {
			$str.="  where cod_not=$cod_nota ";
		}
		if (""!=$filtro) {
			$str.="  where $filtro ";
		}
		$str.="  limit 1 ";
		$rst = mysql_query("$str");
		$row = mysql_fetch_array($rst);
		if (0==$row['ntipo_not']) {
			$cliente=$row['scnpj_emp_CLI'];
		} else {
			$cliente=$row['scnpj_emp_OD'];
		}
		if (""!=$row['scnpj_emp_CON']) {
			$cliente=$row['scnpj_emp_CON'];
		}
		$row['cliente']=$cliente;

		return $row;
	}


function checktipousr($mytipo,$mytipocheck){
	if($mytipo==$mytipocheck){
		$myreturn=1;
	}else{
		$myreturn=0;
	}
	return $myreturn;
}
function GetCodAA($cnpj="") {
	$mysql=" SELECT * FROM tbl_reserva_agente WHERE (scnpj_emp='$cnpj') ";
	$myresult = mysql_query($mysql);
	if (!$myresult) {
		return 0;
		echo("Error performing query: " . mysql_error()."<BR><BR>$sql" );
		exit();
	}
	$myrow = mysql_fetch_array($myresult);
	return $myrow['cod_aa'];

}
function getNF($cod_not) {

	$mysql=" SELECT * FROM tbl_nota WHERE (cod_not='$cod_not') ";

	$myresult = mysql_query($mysql);
	if (!$myresult) {
		echo("Error performing query: " . mysql_error()."<BR><BR>$sql" );
		exit();
	}

	$myrow = mysql_fetch_array($myresult);

	return $myrow;

}

function get_secondemp($l_scnpj_CLI) {

	$mysql=" SELECT * FROM tbl_empresa WHERE (scnpj_emp='$l_scnpj_CLI') ";

//	$mydbcnx = mysql_connect($mysql_host, $mysql_user, $mysql_senha);
//	if (!$mydbcnx) {
//		echo( "Unable to connect to the database server at this time." );
//		exit();
//	}

//	if (!mysql_select_db($mysql_db) ) {
//		echo( "Unable to locate the $mysql_db database at this time." );
//		exit();
//	}
	$myresult = mysql_query($mysql);
	if (!$myresult) {
		echo("Error performing query: " . mysql_error()."<BR><BR>$sql" );
		exit();
	}

	$myrow = mysql_fetch_array($myresult);

	$myreturn="";
	if (""!==$myrow['snome_emp']) {
		$myreturn=$myrow['snome_emp']." - ".$myrow['scidade_emp']." - ".$myrow['suf_emp'];
	}
	mysql_free_result($myresult);

	return $myreturn;

}

function get_emp($l_scnpj_CLI) {

//	include "pr_definitions.php";		// Definições Gerais


	$mysql=" SELECT * FROM tbl_empresa WHERE (scnpj_emp='$l_scnpj_CLI') ";

//	$mydbcnx = mysql_connect($mysql_host, $mysql_user, $mysql_senha);
//	if (!$mydbcnx) {
//		echo( "Unable to connect to the database server at this time." );
//		exit();
//	}

//	if (!mysql_select_db($mysql_db) ) {
//		echo( "Unable to locate the $mysql_db database at this time." );
//		exit();
//	}
	$myresult = mysql_query($mysql);
	if (!$myresult) {
		echo("Error performing query: " . mysql_error()."<BR><BR>$sql" );
		exit();
	}

	$myrow = mysql_fetch_array($myresult);

	$myreturn=$myrow['snome_emp'];

	mysql_free_result($myresult);

	return $myreturn;

}


function GetQuantNF($l_numro_ctr) {

//	include "pr_definitions.php";		// Definições Gerais

	$mysql=" SELECT count(*) as QUANT FROM tbl_nota WHERE (snro_ctr_not='$l_numro_ctr') ";

	$myresult = mysql_query($mysql);
	if (!$myresult) {
		echo("Error performing query: " . mysql_error()."<BR><BR>$sql" );
		exit();
	}

	$myrow = mysql_fetch_array($myresult);

	$myreturn=$myrow['QUANT'];

	mysql_free_result($myresult);

	return $myreturn;

}


function myfixdatetime_frommysql($mydate) {

	list($data,$horafull)=split(' ',$mydate,2);
	list($ano,$mes,$dia)=split('-',$data,3);
	list($hor,$min,$sec)=split(':',$horafull,3);
	$myfixdate="$dia/$mes/$ano $hor:$min:$sec";
	if ($ano==0) {
		$myfixdate="";
	}

	return $myfixdate;
}
function myfixtime_frommysql($mydate) {

	list($data,$horafull)=split(' ',$mydate,2);
	list($ano,$mes,$dia)=split('-',$data,3);
	list($hor,$min,$sec)=split(':',$horafull,3);
	$myfixdate="$hor:$min:$sec";
	if (""==trim($mydate)) {
		$myfixdate="";
	}
	return $myfixdate;
}
function myfixdatetime_tomysql($mydate) {

	/*
	list($data,$horafull)=split(' ',$mydate,2);
	list($dia,$mes,$ano)=split('/',$data,3);
	list($hor,$min,$sec)=split(':',$horafull,3);
	*/

	list($data,$horafull)=explode(' ',$mydate,2);//jb 14/04/2014
	list($dia,$mes,$ano)=explode('/',$data,3);//jb 14/04/2014
	list($hor,$min,$sec)=explode(':',$horafull,3);//jb 14/04/2014

	if ($ano==0) {
		$myfixdate="";
	}
	if (""==$sec) {
		$sec="00";
	}
	if (""==$min) {
		$min="00";
	}
	if (""==$hor) {
		$hor="00";
	}
	$myfixdate="$ano-$mes-$dia $hor:$min:$sec";
	if((""==$hor) or (""==$min) or (""==$sec)){
//		$myfixdate="$ano-$mes-$dia";
	}

	return $myfixdate;
}
function GetDataExtenso($mydate="") {
	if (""==trim($mydate)) {		return "";	}
	list($data,$horafull)=split(' ',$mydate,2);
	list($dia,$mes,$ano)=split('/',$data,3);
	$myDataExtenso		=$dia." de ".GetMonthString($mes)." de ".$ano;
	return $myDataExtenso;
}

function myfixdate_tomysql($mydate="") {
	if (""==trim($mydate)) {		return "";	}

	if(strpos($mydate,' ')===false){
		$data=$mydate;
	}else{
		list($data,$horafull)	=split(' ',$mydate);
	}
	list($dia,$mes,$ano)	=split('/',$data,3);
	//list($hor,$min,$sec)	=split(':',$horafull,3);
	$myfixdate="$ano-$mes-$dia";
	if ($ano==0) {
		$myfixdate="";
	}
	return $myfixdate;
}

function myfixdate_frommysql($mydate) {

	if (""==trim($mydate)) {
		return "";
	}
	list($data,$hora)=split(' ',$mydate,2);
	list($ano,$mes,$dia)=split('-',$data,3);
	$myfixdate="$dia/$mes/$ano";
	if ($ano==0) {
		$myfixdate="";
	}

	return $myfixdate;
}

function myfixdateMDY_frommysql($mydate) {

	if (""==trim($mydate)) {
		return "";
	}
	list($data,$hora)=split(' ',$mydate,2);
	list($ano,$mes,$dia)=split('-',$data,3);
	$myfixdate="$mes/$dia/$ano";
	if ($ano==0) {
		$myfixdate="";
	}

	return $myfixdate;
}

function myfixdateref_frommysql($mydate) {

	if (""==trim($mydate)) {
		return "";
	}
	list($data,$hora)=split(' ',$mydate,2);
	list($ano,$mes,$dia)=split('-',$data,3);
	$myfixdate="$mes/$ano";
	if ($ano==0) {
		$myfixdate="";
	}

	return $myfixdate;
}
function myfixdateref_tommysql($mydate) {

	if (""==trim($mydate)) {
		return "";
	}
	list($data,$hora)=split(' ',$mydate,2);
	list($mes,$ano)=split('/',$data,3);
	$myfixdate="$ano-$mes";
	if ($ano==0) {
		$myfixdate="";
	}

	return $myfixdate;
}
function myfixdatetime_CALC_frommysql($mydate) {
	if (""==trim($mydate)) {		return "";	}
	list($data,$hora)=split(' ',$mydate,2);
	list($ano,$mes,$dia)=split('-',$data,3);
	list($hor,$min,$sec)=split(':',$hora,3);
	$myfixdate="$mes/$dia/$ano";
	if ($ano==0) {
		$myfixdate="";
	}

	return $myfixdate." $hor:$min:00";
}

function myfixdatetimeHHMM_frommysql_to_grid($mydate) {
	if (""==trim($mydate)) {		return "";	}
	list($data,$hora)=split(' ',$mydate,2);
	list($ano,$mes,$dia)=split('-',$data,3);
	list($hor,$min,$sec)=split(':',$hora,3);
	$myfixdate="$dia/$mes/$ano $hor:$min";
	if ($ano==0) {
		$myfixdate="";
	}

	return $myfixdate;
}


function myfixdatetime_frommysql_to_grid($mydate) {
	if (""==trim($mydate)) {		return "";	}
	list($data,$hora)=split(' ',$mydate,2);
	list($ano,$mes,$dia)=split('-',$data,3);
	list($hor,$min,$sec)=split(':',$hora,3);
	$myfixdate="$dia-$mes-$ano";
	if ($ano==0) {
		$myfixdate="";
	}

	return $myfixdate." $hor:$min:sec";
}
function myfixdatetime_frommysql_to_grid_HHMM($mydate) {
	if (""==trim($mydate)) {		return "";	}
	list($data,$hora)=split(' ',$mydate,2);
	list($ano,$mes,$dia)=split('-',$data,3);
	list($hor,$min,$sec)=split(':',$hora,3);
	$myfixdate="$dia/$mes/$ano"." $hor:$min";
	if ($ano==0) {
		$myfixdate="";
	}

	return $myfixdate;
}
function myfixdatetime_fromgrid_to_mysql($mydate) {
	if (""==trim($mydate)) {return ""; }
	$mydate	=ereg_replace('-','/',$mydate);
	$mydate=myfixdatetime_tomysql(mychecksintaxe_checknewline($mydate));
	return $mydate;
}

function GetTime_fromDatetime($mydate="") {
	if (""==trim($mydate)) {
		return "";
	}
	list($data,$hora)=split(' ',$mydate,2);
	return $hora;

}

function GetDate_fromDatetime($mydate="") {
	if (""==trim($mydate)) {
		return "";
	}
	list($data,$hora)=split(' ',$mydate,2);
	return $data;

}

function myRight($mystr,$myquant) {

	return substr($mystr,strlen($mystr)-$myquant,$myquant);

}

//function showwarn($mystr) {
//	error_log($mystr,0);
//}


function myLog($VARS) {

		$MY_POST_STRING="";
		while (list($key,$val)=each($VARS)) {
			$key=urlencode(stripslashes($key));
			$val=urlencode(stripslashes($val));
			$MY_POST_STRING.="$key=$val\n";
		}

		$sql=" INSERT INTO tbl_loginternet (Cod_User,dtData_lint,mLog_lint,stipo_lint,sHttpReferer_lint) VALUES ($cod_usr,NOW(),'$QUERY_STRING $MY_POST_STRING','$REQUEST_METHOD','$PHP_SELF')  " ;
		$result = mysql_query($sql);
		if (!$result) {
			echo("Error performing query: " . mysql_error()."<BR><BR>$sql" );
			exit();
		}
}

function myGetDateTime() {

	global $myDatenow;
	global $myDateRefnow;
	global $myTimenow;
	global $myDateTime;
	global $myDateTimeMySQL;
	global $mySec;
	global $myDay;
	global $myMonth;
	global $myYear;
	global $myEDIDate;
	global $myEDIDateAAAA;
	global $myEDITime;
	global $myEDIDateTime;
	global $myDateTimeSimple;
	global $mySerial;
	global $myDateDASHnow;
	global $myDateSO;
	global $myDateExtenso;
	global $myTimeSimplesnow;
	global $myDateTimeHi;

	$myDatenow			=date('d/m/Y',time());
	$myDateRefnow		=date('m/Y',time());
	$myDateDASHnow		=date('d-m-Y',time());
	$myDateSO			=date('Y-m-d',time());
	$myDateTimeSimple	=date('d/m/Y H:i',time());
	$myTimenow			=date('H:i:s',time());
	$myTimeSimplesnow	=date('H:i',time());
	$myDateTime 		=$myDatenow." ".$myTimenow;
	$myDateTimeHi 		=$myDatenow." ".$myTimeSimplesnow;
	$myDateTimeMySQL	=myfixdatetime_tomysql($myDateTime);
	$mySec 				=date('s',time());
	$myDay				=date('d',time());
	$myMonth 			=date('m',time());
	$myEDIDate			=date('dmy',time()); 		// $mday$mon$year_aa
	$myEDIDateAAAA		=date('dmY',time()); 		// $mday$mon$formatyear
	$myEDITime			=date('Hi',time()); 		// $hour$min
	$myEDIDateTime		=date('dmHi',time()); 		// $mday$mon$hour$min
	$myYear 			=date('Y',time());
	$mySerial			=date('smHis',time()); 		// $mday$mon$hour$min
	$myDataExtenso		=$myDay." de ".GetMonthString($myMonth)." de ".$myYear;

	return 1;
}

function GetMonthString($mymonth){
	switch($mymonth){
		case 1:$myreturn="Janeiro";break;
		case 2:$myreturn="Fevereiro";break;
		case 3:$myreturn="Março";break;
		case 4:$myreturn="Abril";break;
		case 5:$myreturn="Maio";break;
		case 6:$myreturn="Junho";break;
		case 7:$myreturn="Julho";break;
		case 8:$myreturn="Agosto";break;
		case 9:$myreturn="Setembro";break;
		case 10:$myreturn="Outubro";break;
		case 11:$myreturn="Novembro";break;
		case 12:$myreturn="Dezembro";break;
	}

	return $myreturn;
}


function ShowWarn($str) {

	//error_log ($str, 3, "/var/log/httpd/nucci/error_log");

}

function get_time_diff($start,$end){    // Calculates difference in seconds and returns text string.
  $diff = ($end-$start);
  if($diff<60){
    $sec = $diff;
  }
  else{
    if($diff<3600){
      $min = floor($diff/60);
      $sec = $diff-(60*$min);
    }
    else{
      if($diff<86400){
        $hour = floor($diff/3600);
        $min = floor(($diff-($hour*3600))/60);
        $sec = (($diff-($hour*3600)-(60*$min)));
      }
      else{
        if($diff<604800){
          $day = floor($diff/86400);
          $hour = floor(($diff-($day*86400))/3600);
          $min = floor(($diff-($day*86400)-($hour*3600))/60);
          $sec = (($diff-($day*86400)-($hour*3600)-(60*$min)));
        }
        else{
          if($diff<31536000){
            $week = floor($diff/604800);
            $day = floor(($diff-($week*604800))/86400);
            $hour = floor(($diff-($week*604800)-($day*86400))/3600);
            $min = floor(($diff-($week*604800)-($day*86400)-($hour*3600))/60);
            $sec = (($diff-($week*604800)-($day*86400)-($hour*3600)-(60*$min)));
          }
          else{
            $year = floor($diff/31536000);
            $week = floor(($diff-($year*31536000))/604800);
            $day = floor(($diff-($year*31536000)-($week*604800))/86400);
            $hour = floor(($diff-($year*31536000)-($week*604800)-($day*86400))/3600);
            $min = floor(($diff-($year*31536000)- ($week*604800)-($day*86400)-($hour*3600))/60);
            $sec = (($diff-($year*31536000)-($week*604800)-($day*86400)-($hour*3600)-(60*$min)));
          }
        }
      }
    }
  }

  if($sec != ''){
    if($sec == 1){
      $final = $sec . ' second';
    }
    else{
      $final = $sec . ' seconds';
    }
  }
  if($min != ''){
    if($min == 1){
      $final = $min . ' minute ' . $final;
    }
    else{
      $final = $min . ' minutes ' . $final;
    }
  }
  if($hour != ''){
    if($hour == 1){
      $final = $hour . ' hour ' . $final;
    }
    else{
      $final = $hour . ' hours ' . $final;
    }
  }
  if($day != ''){
    if($day == 1){
      $final = $day . ' day ' . $final;
    }
    else{
      $final = $day . ' days ' . $final;
    }
  }
  if($week != ''){
    if($week == 1){
      $final = $week . ' week ' . $final;
    }
    else{
      $final = $week . ' weeks ' . $final;
    }
  }
  if($year != ''){
    if($year == 1){
      $final = $year . ' year ' . $final;
    }
    else{
      $final = $year . ' years ' . $final;
    }
  }
  return $final;
}

function getresto ($valor) {

	return intval(($valor-intval($valor))*100);

}

function GetMCT ($placa) {

	$mysql=" SELECT smct_veic FROM tbl_veiculo WHERE (splaca_veic='$placa') ";

	$myresult = mysql_query($mysql);
	if (!$myresult) {
		echo("Error performing query: " . mysql_error()."<BR><BR>$sql" );
		exit();
	}

	$myrow = mysql_fetch_array($myresult);

	$myreturn=$myrow['smct_veic'];

	mysql_free_result($myresult);

	return $myreturn;

}

function checknull_bool2num($valor) {
	$new_valor=0;
	if (trim($valor)<>"") { $new_valor=0; }
	if ('true'==trim($valor)) { $new_valor=1; }
	if ('false'==trim($valor)) { $new_valor=0; }
	return $new_valor;
}

function checknull_num($valor) {
	$new_valor=0;
	if (trim($valor)<>"") { $new_valor=$valor; }
	return $new_valor;
}


function checkquant_tabela($mytable="",$mycriterio=""){
	if (""==$mytable) {
		return 1;
	}

	$myWhere="";
	if($mycriterio<>""){
		$myWhere=" WHERE $mycriterio ";
	}

	$mystrSQL=" SELECT COUNT(*) as TOTAL FROM $mytable $myWhere ";

	$myresult = mysql_query($mystrSQL);
	if (!$myresult) {
		echo("Error performing query: " . mysql_error()."<BR><BR>$mystrSQL" );
		exit();
	}

	$myrow = mysql_fetch_array($myresult);
	$myreturn=mychecksintaxe_num($myrow['TOTAL']);
//	echo "<!-- T:$myreturn  | $mystrSQL -->";
	return $myreturn;
}

function SetCookieProprietario($myscpf){

	global $cookie_scgc_prop;
	global $cookie_stipo_prop;
	global $cookie_snome_prop;
	global $cookie_sendereco_prop;
	global $cookie_sbairro_prop;
	global $cookie_scidade_prop;
	global $cookie_suf_prop;
	global $cookie_scep_prop;
	global $cookie_stelefone_prop;
	global $cookie_srg_prop;
	global $cookie_sorgexp_prop;
	global $cookie_sfax_prop;
	global $cookie_sinss_prop;
	global $cookie_srtb_prop;
	global $cookie_sie_prop;
	global $cookie_nnumerodep_prop;
	global $cookie_snomebanco_prop;
	global $cookie_scgcbanco_prop;
	global $cookie_sbanco_prop;
	global $cookie_sagencia_prop;
	global $cookie_scc_prop;
	global $cookie_dtcreate_prop;
	global $cookie_dtupdate_prop;
	global $cookie_bisento_prop;
	global $cookie_nclassinterna_prop;
	global $cookie_cod_update_usr;
	global $cookie_bsimples_prop;
	global $cookie_stitular_cc_prop;



	$strSQL=" SELECT tbl_proprietario.* FROM tbl_proprietario WHERE scgc_prop='$myscpf' ";
	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);

	$cookie_scgc_prop=$myrow['scgc_prop'];
	$cookie_stipo_prop=$myrow['stipo_prop'];
	$cookie_snome_prop=$myrow['snome_prop'];
	$cookie_sendereco_prop=$myrow['sendereco_prop'];
	$cookie_sbairro_prop=$myrow['sbairro_prop'];
	$cookie_scidade_prop=$myrow['scidade_prop'];
	$cookie_suf_prop=$myrow['suf_prop'];
	$cookie_scep_prop=$myrow['scep_prop'];
	$cookie_stelefone_prop=$myrow['stelefone_prop'];
	$cookie_srg_prop=$myrow['srg_prop'];
	$cookie_sorgexp_prop=$myrow['sorgexp_prop'];
	$cookie_sfax_prop=$myrow['sfax_prop'];
	$cookie_sinss_prop=$myrow['sinss_prop'];
	$cookie_srtb_prop=$myrow['srtb_prop'];
	$cookie_sie_prop=$myrow['sie_prop'];
	$cookie_nnumerodep_prop=$myrow['nnumerodep_prop'];
	$cookie_snomebanco_prop=$myrow['snomebanco_prop'];
	$cookie_scgcbanco_prop=$myrow['scgcbanco_prop'];
	$cookie_sbanco_prop=$myrow['sbanco_prop'];
	$cookie_sagencia_prop=$myrow['sagencia_prop'];
	$cookie_scc_prop=$myrow['scc_prop'];
	$cookie_dtcreate_prop=$myrow['dtcreate_prop'];
	$cookie_dtupdate_prop=$myrow['dtupdate_prop'];
	$cookie_bisento_prop=$myrow['bisento_prop'];
	$cookie_nclassinterna_prop=$myrow['nclassinterna_prop'];
	$cookie_cod_update_usr=$myrow['cod_update_usr'];
	$cookie_bsimples_prop=$myrow['bsimples_prop'];
	$cookie_stitular_cc_prop=$myrow['stitular_cc_prop'];

	return 1;
}

function SetCookieMotor($myscpf){

	global $cookie_scpf_mot;
	global $cookie_snome_mot;
	global $cookie_sendereco_mot;
	global $cookie_nnumero_mot;
	global $cookie_scomplemento_mot;
	global $cookie_sbairro_mot;
	global $cookie_scidade_mot;
	global $cookie_scep_mot;
	global $cookie_suf_mot;
	global $cookie_stelefone_mot;
	global $cookie_scelular_mot;
	global $cookie_mobs_mot;
	global $cookie_srg_mot;
	global $cookie_sexp_mot;
	global $cookie_spai_mot;
	global $cookie_smae_mot;
	global $cookie_shabilitacao_mot;
	global $cookie_dthabilitacao_mot;
	global $cookie_dtvalidade_mot;
	global $cookie_dtcreate_mot;
	global $cookie_dtupdate_mot;
	global $cookie_mlog_mot;
	global $cookie_nstatus_mot;
	global $cookie_ntipo_mot;
	global $cookie_nnumerodep_mot;
	global $cookie_sbanco_mot;
	global $cookie_sagencia_mot;
	global $cookie_scc_mot;
	global $cookie_sdigitocc_mot;
	global $cookie_stipo_cc_mot;
	global $cookie_scc_titular_mot;
	global $cookie_scc_cnpjcpf_mot;
	global $cookie_ncurrent_embarque_mot;
	global $cookie_ncurrent_embarque_pr_mot;


	$strSQL=" SELECT tbl_motorista.* FROM tbl_motorista WHERE scpf_mot='$myscpf' ";
	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);

	$cookie_scpf_mot = $myrow['scpf_mot'];
	$cookie_snome_mot = $myrow['snome_mot'];
	$cookie_sendereco_mot = $myrow['sendereco_mot'];
	$cookie_nnumero_mot = $myrow['nnumero_mot'];
	$cookie_scomplemento_mot = $myrow['scomplemento_mot'];
	$cookie_sbairro_mot = $myrow['sbairro_mot'];
	$cookie_scidade_mot = $myrow['scidade_mot'];
	$cookie_scep_mot = $myrow['scep_mot'];
	$cookie_suf_mot = $myrow['suf_mot'];
	$cookie_stelefone_mot = $myrow['stelefone_mot'];
	$cookie_scelular_mot = $myrow['scelular_mot'];
	$cookie_mobs_mot = $myrow['mobs_mot'];
	$cookie_srg_mot = $myrow['srg_mot'];
	$cookie_sexp_mot = $myrow['sexp_mot'];
	$cookie_spai_mot = $myrow['spai_mot'];
	$cookie_smae_mot = $myrow['smae_mot'];
	$cookie_shabilitacao_mot = $myrow['shabilitacao_mot'];
	$cookie_dthabilitacao_mot = $myrow['dthabilitacao_mot'];
	$cookie_dtvalidade_mot = $myrow['dtvalidade_mot'];
	$cookie_dtcreate_mot = $myrow['dtcreate_mot'];
	$cookie_dtupdate_mot = $myrow['dtupdate_mot'];
	$cookie_mlog_mot = $myrow['mlog_mot'];
	$cookie_nstatus_mot = $myrow['nstatus_mot'];
	$cookie_ntipo_mot = $myrow['ntipo_mot'];
	$cookie_sbanco_mot = $myrow['sbanco_mot'];
	$cookie_sagencia_mot = $myrow['sagencia_mot'];
	$cookie_scc_mot = $myrow['scc_mot'];
	$cookie_sdigitocc_mot=$myrow['sdigitocc_mot'];
	$cookie_stipo_cc_mot = $myrow['stipo_cc_mot'];
	$cookie_scc_titular_mot = $myrow['scc_titular_mot'];
	$cookie_scc_cnpjcpf_mot = $myrow['scc_cnpjcpf_mot'];
	$cookie_ncurrent_embarque_mot = $myrow['ncurrent_embarque_mot'];
	$cookie_ncurrent_embarque_pr_mot = $myrow['ncurrent_embarque_pr_mot'];

	return 1;
}

function GetInfoMotor($myinfo,$myscpf){
	$strSQL=" SELECT tbl_motorista.* FROM tbl_motorista WHERE scpf_mot='$myscpf' ";

	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);

	switch($myinfo){
		case 1: $strReturn=$myrow['snome_mot'];break;
		case 2: $strReturn=$myrow['sendereco_mot'];break;
		case 3: $strReturn=$myrow['nnumero_mot'];break;
		case 4: $strReturn=$myrow['scomplemento_mot'];break;
		case 5: $strReturn=$myrow['sbairro_mot'];break;
		case 6: $strReturn=$myrow['scidade_mot'];break;
		case 7: $strReturn=$myrow['scep_mot'];break;
		case 8: $strReturn=$myrow['suf_mot'];break;
		case 9: $strReturn=$myrow['stelefone_mot'];break;
		case 10: $strReturn=$myrow['scelular_mot'];break;
		case 11: $strReturn=$myrow['mobs_mot'];break;
		case 12: $strReturn=$myrow['srg_mot'];break;
		case 13: $strReturn=$myrow['sexp_mot'];break;
		case 14: $strReturn=$myrow['spai_mot'];break;
		case 15: $strReturn=$myrow['smae_mot'];break;
		case 16: $strReturn=$myrow['shabilitacao_mot'];break;
		case 17: $strReturn=$myrow['dthabilitacao_mot'];break;
		case 18: $strReturn=$myrow['dtvalidade_mot'];break;
		case 19: $strReturn=$myrow['dtcreate_mot'];break;
		case 20: $strReturn=$myrow['dtupdate_mot'];break;
		case 21: $strReturn=$myrow['mlog_mot'];break;
		case 22: $strReturn=$myrow['nstatus_mot'];break;
		case 23: $strReturn=$myrow['ntipo_mot'];break;
		case 24: $strReturn=$myrow['ntipo_mot'];break;

	}

	return $strReturn;
}

function GetInfoMotorFULL($myscpf){
	$strSQL=" SELECT tbl_motorista.* FROM tbl_motorista WHERE scpf_mot='$myscpf' ";

	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);

	return $myrow;
}

function GetInfoProp($myinfo,$myscpf){
	$strSQL=" SELECT tbl_proprietario.* FROM tbl_proprietario WHERE scgc_prop='$myscpf' ";

	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);

	if(1==$myinfo){
		$strReturn=$myrow['snome_prop'];
	}

	if(2==$myinfo){
		$strReturn=$myrow['stipo_prop'];
	}

	if(3==$myinfo){
		$strReturn=$myrow['nnumerodep_prop'];
	}

	if(4==$myinfo){
		$strReturn=$myrow['sendereco_prop'];
	}

	if(5==$myinfo){
		$strReturn=$myrow['scidade_prop'];
	}

	if(6==$myinfo){
		$strReturn=$myrow['suf_prop'];
	}

	if(7==$myinfo){
		$strReturn=$myrow['stelefone_prop'];
	}
	if(8==$myinfo){
		$strReturn=$myrow['nclassinterna_prop'];
	}

	return $strReturn;
}



function SetCookieVeic($mysplaca){

	global $cookie_cod_veic;
	global $cookie_splaca_veic;
	global $cookie_stipo_veic;
	global $cookie_smct_veic;
	global $cookie_sid_veic;
	global $cookie_scor_veic;
	global $cookie_sorigem_veic;
	global $cookie_suf_veic;
	global $cookie_scartao_veic;
	global $cookie_nstatus_veic;
	global $cookie_slastpos_veic;
	global $cookie_dtlastpos_veic;
	global $cookie_sfrota_veic;
	global $cookie_dtcreate_veic;
	global $cookie_cod_tveic;
	global $cookie_nrastreamento_veic;
	global $cookie_nclassinterna_veic;
	global $cookie_smarca_veic;
	global $cookie_sano_veic;
	global $cookie_schassis_veic;
	global $cookie_npbt_veic;
	global $cookie_ncarga_veic;
	global $cookie_neixos_veic;
	global $cookie_scert_veic;
	global $cookie_mobs_veic;
	global $cookie_scgcprop_veic;
	global $cookie_sieprop_veic;
	global $cookie_stipoprop_veic;
	global $cookie_snomeprop_veic;
	global $cookie_sendprop_veic;
	global $cookie_sbairroprop_veic;
	global $cookie_scidadeprop_veic;
	global $cookie_sufprop_veic;
	global $cookie_scepprop_veic;
	global $cookie_snomebancoprop_veic;
	global $cookie_scgcbancoprop_veic;
	global $cookie_sbancoprop_veic;
	global $cookie_sagenciaprop_veic;
	global $cookie_sccprop_veic;
	global $cookie_sdigitoccprop_veic;
	global $cookie_stelefoneprop_veic;
	global $cookie_smodelo_veic;
	global $cookie_bsimplesprop_veic;
	global $cookie_stitular_ccprop_veic;
	global $cookie_stipo_ccprop_veic;


	$strSQL=" SELECT tbl_veiculo.* FROM tbl_veiculo WHERE splaca_veic='$mysplaca' ";
	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);


	$cookie_splaca_veic = $myrow['splaca_veic'];
	if($myrow['cod_tveic']!=""){$cookie_stipo_veic = GetInfoTipoVeic($myrow['cod_tveic']);}
	$cookie_smct_veic = $myrow['smct_veic'];
	$cookie_sid_veic = $myrow['sid_veic'];
	$cookie_scor_veic = $myrow['scor_veic'];
	$cookie_sorigem_veic = $myrow['sorigem_veic'];
	$cookie_suf_veic = $myrow['suf_veic'];
	$cookie_scartao_veic = $myrow['scartao_veic'];
	$cookie_nstatus_veic = $myrow['nstatus_veic'];
	$cookie_slastpos_veic = $myrow['slastpos_veic'];
	$cookie_dtlastpos_veic = $myrow['dtlastpos_veic'];
	$cookie_sfrota_veic = $myrow['sfrota_veic'];
	$cookie_dtcreate_veic = $myrow['dtcreate_veic'];
	//$cookie_cod_tveic = $myrow['cod_tveic'];
	$cookie_nrastreamento_veic = $myrow['nrastreamento_veic'];
	$cookie_nclassinterna_veic = $myrow['nclassinterna_veic'];
	$cookie_smarca_veic = $myrow['smarca_veic'];
	$cookie_sano_veic = $myrow['sano_veic'];
	$cookie_schassis_veic = $myrow['schassis_veic'];
	$cookie_npbt_veic = $myrow['npbt_veic'];
	$cookie_ncarga_veic = $myrow['ncarga_veic'];
	$cookie_neixos_veic = $myrow['neixos_veic'];
	$cookie_scert_veic = $myrow['scert_veic'];
	$cookie_mobs_veic = $myrow['mobs_veic'];
	$cookie_scgcprop_veic = $myrow['scgcprop_veic'];
	$cookie_sieprop_veic = $myrow['sieprop_veic'];
	$cookie_stipoprop_veic = $myrow['stipoprop_veic'];
	$cookie_snomeprop_veic = $myrow['snomeprop_veic'];
	$cookie_sendprop_veic = $myrow['sendprop_veic'];
	$cookie_sbairroprop_veic = $myrow['sbairroprop_veic'];
	$cookie_scidadeprop_veic = $myrow['scidadeprop_veic'];
	$cookie_sufprop_veic = $myrow['sufprop_veic'];
	$cookie_scepprop_veic = $myrow['scepprop_veic'];
	$cookie_snomebancoprop_veic = $myrow['snomebancoprop_veic'];
	$cookie_scgcbancoprop_veic = $myrow['scgcbancoprop_veic'];
	$cookie_sbancoprop_veic = $myrow['sbancoprop_veic'];
	$cookie_sagenciaprop_veic = $myrow['sagenciaprop_veic'];
	$cookie_sccprop_veic = $myrow['sccprop_veic'];
	$cookie_sdigitoccprop_veic = $myrow['sdigitoccprop_veic'];
	$cookie_stelefoneprop_veic = $myrow['stelefoneprop_veic'];
	$cookie_smodelo_veic= $myrow['smodelo_veic'];
	$cookie_bsimplesprop_veic= $myrow['bsimplesprop_veic'];
	$cookie_stitular_ccprop_veic= $myrow['stitular_ccprop_veic'];
	$cookie_stipo_ccprop_veic= $myrow['stipo_ccprop_veic'];


	return 1;

}
function GetInfoVeic_FULL($mysplaca){
	$strSQL=" SELECT tbl_veiculo.*, tbl_nucci_tipocavalo.*, tbl_nucci_tipocarroceria.sdesc_ntcarr, tbl_nucci_tipoveiculo.snome_ntveic   FROM ((tbl_veiculo LEFT JOIN tbl_nucci_tipocavalo ON tbl_veiculo.cod_tcav = tbl_nucci_tipocavalo.cod_ntcav) LEFT JOIN tbl_nucci_tipoveiculo ON tbl_veiculo.cod_tveic = tbl_nucci_tipoveiculo.cod_ntveic) LEFT JOIN tbl_nucci_tipocarroceria ON tbl_veiculo.cod_tcarr = tbl_nucci_tipocarroceria.cod_ntcarr WHERE splaca_veic='$mysplaca' ";

	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);

	return $myrow;
}
function GetOcorrenciaFULL($mycod_oco){
	$strSQL=" SELECT * FROM tbl_ocorrencia WHERE cod_oco='$mycod_oco' ";

	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);

	return $myrow;
}



function GetInfoVeic($myinfo,$mysplaca){
	$strSQL=" SELECT tbl_veiculo.*, tbl_nucci_tipocavalo.sdesc_ntcav FROM tbl_veiculo LEFT JOIN tbl_nucci_tipocavalo ON tbl_veiculo.cod_tcav = tbl_nucci_tipocavalo.cod_ntcav  WHERE splaca_veic='$mysplaca' ";

	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);

	switch($myinfo){
		case 1: $strReturn=$myrow['splaca_veic'];break;
		case 2: $strReturn=$myrow['stipo_veic'];break;
		case 3: $strReturn=$myrow['smct_veic'];break;
		case 4: $strReturn=$myrow['sid_veic'];break;
		case 5: $strReturn=$myrow['scor_veic'];break;
		case 6: $strReturn=$myrow['sorigem_veic'];break;
		case 7: $strReturn=$myrow['suf_veic'];break;
		case 8: $strReturn=$myrow['scartao_veic'];break;
		case 9: $strReturn=$myrow['nstatus_veic'];break;
		case 10: $strReturn=$myrow['slastpos_veic'];break;
		case 11: $strReturn=$myrow['dtlastpos_veic'];break;
		case 12: $strReturn=$myrow['sfrota_veic'];break;
		case 13: $strReturn=$myrow['dtcreate_veic'];break;
		case 14: $strReturn=$myrow['cod_tveic'];break;
		case 15: $strReturn=$myrow['nrastreamento_veic'];break;
		case 16: $strReturn=$myrow['nclassinterna_veic'];break;
		case 17: $strReturn=$myrow['smarca_veic'];break;
		case 18: $strReturn=$myrow['sano_veic'];break;
		case 19: $strReturn=$myrow['schassis_veic'];break;
		case 20: $strReturn=$myrow['npbt_veic'];break;
		case 21: $strReturn=$myrow['ncarga_veic'];break;
		case 22: $strReturn=$myrow['neixos_veic'];break;
		case 23: $strReturn=$myrow['scert_veic'];break;
		case 24: $strReturn=$myrow['mobs_veic'];break;
		case 25: $strReturn=$myrow['scgcprop_veic'];break;
		case 26: $strReturn=$myrow['sieprop_veic'];break;
		case 27: $strReturn=$myrow['stipoprop_veic'];break;
		case 28: $strReturn=$myrow['snomeprop_veic'];break;
		case 29: $strReturn=$myrow['sendprop_veic'];break;
		case 30: $strReturn=$myrow['sbairroprop_veic'];break;
		case 31: $strReturn=$myrow['scidadeprop_veic'];break;
		case 32: $strReturn=$myrow['sufprop_veic'];break;
		case 33: $strReturn=$myrow['scepprop_veic'];break;
		case 34: $strReturn=$myrow['snomebancoprop_veic'];break;
		case 35: $strReturn=$myrow['scgcbancoprop_veic'];break;
		case 36: $strReturn=$myrow['sbancoprop_veic'];break;
		case 37: $strReturn=$myrow['sagenciaprop_veic'];break;
		case 38: $strReturn=$myrow['sccprop_veic'];break;
		case 39: $strReturn=$myrow['cod_tcav'];break;
		case 40: $strReturn=$myrow['sdesc_ntcav'];break;


	}

	return $strReturn;
}

function GetInfoTipoVeic($mycod_tveic){
	$strSQL=" SELECT tbl_tipoveiculo.* FROM tbl_tipoveiculo WHERE cod_tveic=$mycod_tveic ";
	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);
	$strReturn=$myrow['snome_tveic'];

	return $strReturn;
}

function GetInfoTipoCavalo($mycod_tcav){
	$strSQL=" SELECT tbl_tipocavalo.* FROM tbl_tipocavalo WHERE cod_tcav=$mycod_tcav ";
	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);
	$strReturn=$myrow['sdesc_tcav'];

	return $strReturn;
}
function GetInfoUnidadeFULL($mypr){

	$mypr=mychecksintaxe_num($mypr);
	$strSQL=" SELECT tbl_unidade.* FROM tbl_unidade WHERE npr_uni = $mypr ";

	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);
	return 	$myrow;
}
function GetEDI($cod_edi){

	$cod_edi	=mychecksintaxe_num($cod_edi);
	$strSQL=" SELECT tbl_edi.* FROM tbl_edi WHERE cod_edi = $cod_edi ";

	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);
	return 	$myrow;

}
function UpdateNextEDI($cod_edi){

	$cod_edi	=mychecksintaxe_num($cod_edi);
	$strSQL=" update tbl_edi set nnextnumber_edi=nnextnumber_edi+1 WHERE cod_edi = $cod_edi ";

	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
	return 	1;

}
function GetInfoUnidade($myinfo,$mypr){

//	if(strlen($mypr)==1){
//		$mypr="0".$mypr;
//	}

//	$strSQL=" SELECT tbl_unidade.* FROM tbl_unidade WHERE npr_uni = '$mypr' ";
	$mypr=mychecksintaxe_num($mypr);
	$strSQL=" SELECT tbl_unidade.* FROM tbl_unidade WHERE npr_uni = $mypr ";

	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);

	if(1==$myinfo){
		$strReturn=$myrow['snome_uni'];
		if ("00"==$mypr) {
			$strReturn="Todos";
		}
	}

	if(2==$myinfo){
		$strReturn=$myrow['ssigla_uni'];
	}

	if(3==$myinfo){
		$strReturn=$myrow['semail_uni'];
	}

	if(4==$myinfo){
		$strReturn=$myrow['scidade_uni'];
	}

	if(5==$myinfo){
		$strReturn=$myrow['sregiao_uni'];
	}

	return $strReturn;
}

function GetInfoUsuario($myinfo,$mycod_usr){
	global $npr_uni_user;
	global $npr_uni;
	//global $ssenha_usr;
	global $ntipo_usr;

	$strReturn = "";

	if (""!=$mycod_usr) {

		$strSQL=" SELECT tbl_usuario.* FROM tbl_usuario WHERE cod_usr=$mycod_usr ";
		$myresult = mysql_query($strSQL);
		if (!$myresult) {
  			echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
			exit();
		}
	 	$myrow = mysql_fetch_array($myresult);

		if(1==$myinfo){
			$strReturn=$myrow['snome_usr'];
			$npr_uni_user=$myrow['npr_uni'];
			$npr_uni=$myrow['npr_uni'];
			//$ssenha_usr=$myrow['ssenha_usr'];
			$ntipo_usr=$myrow['ntipo_usr'];
		}
	}
	return $strReturn;
}

function montar_combo($strOption,$strValue,$strSelected="aksldjl"){
		$mystrReturn="";
		if($strSelected==$strValue){
			$mystrReturn.='<option value="'.$strValue.'" selected>'.$strOption.'</option>';
		}else{
			$mystrReturn.='<option value="'.$strValue.'">'.$strOption.'</option>';
		}
		return $mystrReturn;
	}

function montar_combo_exclusive($strOption,$strValue,$strSelected,$bselected=1){
		$mystrReturn="";
		if($strSelected==$strValue){
			if($bselected){
				$mystrReturn.='<option value="'.$strValue.'" selected>'.$strOption.'</option>';
			}else{
				$mystrReturn.='<option value="'.$strValue.'" >'.$strOption.'</option>';
			}
		}
		return $mystrReturn;
}


function format_moeda($myvalor){
	$strReturn="R$".number_format($myvalor,2,",",".");
	return $strReturn;
}
function format_numero($myvalor,$dec=2){
	$strReturn=number_format($myvalor,$dec,",",".");
	return $strReturn;
}
function format_numero_contabil($myvalor,$dec=2){
	$strReturn=number_format(abs($myvalor),$dec,",",".");
	$fim=" C";
	if (0>$myvalor) {$fim=" D";}
	return $strReturn.$fim;
}

function GetTimeGradeCombo($sHorario="") {

	$myGrade="";
		for($nHour=0;$nHour<=23;$nHour++){
			for($nMin=0;$nMin<=50;$nMin+=10){
				if(strlen($nHour)==1){$sHour="0".$nHour;}else{$sHour=$nHour;}
				if(strlen($nMin)==1){$sMin="0".$nMin;}else{$sMin=$nMin;}
				$myGrade.=SetComboOption("$sHour:$sMin",$sHorario);
			}
		}

	/*
	$myGrade=SetComboOption("00:00",$sHorario);
	$myGrade.=SetComboOption("01:00",$sHorario);
	$myGrade.=SetComboOption("02:00",$sHorario);
	$myGrade.=SetComboOption("03:00",$sHorario);
	$myGrade.=SetComboOption("04:00",$sHorario);
	$myGrade.=SetComboOption("05:00",$sHorario);
	$myGrade.=SetComboOption("06:00",$sHorario);
	$myGrade.=SetComboOption("07:00",$sHorario);
	$myGrade.=SetComboOption("08:00",$sHorario);
	$myGrade.=SetComboOption("09:00",$sHorario);
	$myGrade.=SetComboOption("10:00",$sHorario);
	$myGrade.=SetComboOption("11:00",$sHorario);
	$myGrade.=SetComboOption("12:00",$sHorario);
	$myGrade.=SetComboOption("13:00",$sHorario);
	$myGrade.=SetComboOption("14:00",$sHorario);
	$myGrade.=SetComboOption("15:00",$sHorario);
	$myGrade.=SetComboOption("16:00",$sHorario);
	$myGrade.=SetComboOption("17:00",$sHorario);
	$myGrade.=SetComboOption("18:00",$sHorario);
	$myGrade.=SetComboOption("19:00",$sHorario);
	$myGrade.=SetComboOption("20:00",$sHorario);
	$myGrade.=SetComboOption("21:00",$sHorario);
	$myGrade.=SetComboOption("22:00",$sHorario);
	$myGrade.=SetComboOption("23:00",$sHorario);
	*/
	return $myGrade;

}

function SetComboOption($sOption,$value) {

	$sreturn="<option value='$sOption' ";
	if ($sOption==$value) {$sreturn.=" selected ";}
	$sreturn.=">$sOption</option>";
	return $sreturn;
}
function valorPorExtenso2($valor=0, $maiusculas=false) {
	$singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
	$plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");

	$c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
	$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
	$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezesete", "dezoito", "dezenove");
	$u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");

	$z=0;

	$valor = number_format($valor, 2, ".", ".");
	$inteiro = explode(".", $valor);
	for($i=0;$i<count($inteiro);$i++)
		for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
			$inteiro[$i] = "0".$inteiro[$i];

	// $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
	$fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
	for ($i=0;$i<count($inteiro);$i++) {
		$valor = $inteiro[$i];
		$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
		$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
		$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

		$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd &&$ru) ? " e " : "").$ru;
		$t = count($inteiro)-1-$i;
		$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
		if ($valor == "000")$z++; elseif ($z > 0) $z--;
		if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
		if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) &&($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
	}
   if(!$maiusculas){
   		return($rt ? $rt : "zero");
   } else {
   		return (ucwords($rt) ? ucwords($rt) : "Zero");
   }
	return($rt ? $rt : "zero");
}

function extenso($valor=0, $maiusculas=false) {
	$singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
	$plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
	$c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
	$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
	$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezesete", "dezoito", "dezenove");
	$u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
	$z=0;
	$rt=0;
	$valor = number_format($valor, 2, ".", ".");
	$inteiro = explode(".", $valor);
	for($i=0;$i<count($inteiro);$i++)
		for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
			$inteiro[$i] = "0".$inteiro[$i];
 	$fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
	for ($i=0;$i<count($inteiro);$i++) {
		$valor = $inteiro[$i];
		$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
		$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
		$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

		$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd && $ru) ? " e " : "").$ru;
		$t = count($inteiro)-1-$i;
		$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
		if ($valor == "000")$z++; elseif ($z > 0) $z--;
		if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
		if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
	}

   if(!$maiusculas){
   		return($rt ? $rt : "zero");
   } else {
   		return (ucwords($rt) ? ucwords($rt) : "Zero");
   }

}
function valorPorExtenso($valor=0) {
	$singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
	$plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");

	$c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
	$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
	$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezesete", "dezoito", "dezenove");
	$u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");

	$z=0;

	$valor = number_format($valor, 2, ".", ".");
	$inteiro = explode(".", $valor);
	for($i=0;$i<count($inteiro);$i++)
		for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
			$inteiro[$i] = "0".$inteiro[$i];

	// $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
	$fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
	for ($i=0;$i<count($inteiro);$i++) {
		$valor = $inteiro[$i];
		$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
		$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
		$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

		$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd && $ru) ? " e " : "").$ru;
		$t = count($inteiro)-1-$i;
		$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
		if ($valor == "000")$z++; elseif ($z > 0) $z--;
		if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
		if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
	}

	return($rt ? $rt : "zero");
}

function GetInfoUnidade_All($mypr){
	global $ssigla_uni;
	global $snome_uni;
	global $ntipo_uni;
	global $npr_uni;
	global $scidade_uni;
	global $suf_uni;
	global $npr_uni;
	global $stelefone_uni;


	if(strlen($mypr)==1){
		$mypr="0".$mypr;
	}

	$strSQL=" SELECT tbl_unidade.* FROM tbl_unidade WHERE npr_uni='$mypr' ";

	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);

	$ssigla_uni=$myrow['ssigla_uni'];
	$snome_uni=$myrow['snome_uni'];
	$ntipo_uni=$myrow['ntipo_uni'];
	$npr_uni=$myrow['npr_uni'];
	$scidade_uni=$myrow['scidade_uni'];
	$suf_uni=$myrow['suf_uni'];
	$npr_uni=$myrow['npr_uni'];
	$stelefone_uni=$myrow['stelefone_uni'];
	if ("00"==$mypr) {
		$snome_uni="Todos";
	}

	return $strReturn;
}


function mychecksintaxe($valor) {

	$valor	=ereg_replace('\'','',$valor);
	$valor	=ereg_replace("\"",'',$valor);

	return $valor;
}

function mychecksintaxe_num($valor) {

	//$valor	=ereg_replace(',','.',$valor);//jb 25/03/2013
	$valor	=str_replace(',','.',$valor);
	//$valor	=ereg_replace(' ','',$valor);//jb 25/03/2013
	$valor	=str_replace(' ','',$valor);
	if (""==trim($valor)) {$valor=0;}

	return $valor;
}

function mychecksintaxe_MYSQL($valor) {

	$valor	=ereg_replace('&AMP;','',$valor);
	$valor	=ereg_replace('&QUOT;',"\"",$valor);
	$valor	=ereg_replace('UPDATE','',$valor);
	$valor	=ereg_replace('DELETE','',$valor);
	$valor	=ereg_replace('INSERT','',$valor);
	$valor	=ereg_replace('GRANT','',$valor);
	$valor	=ereg_replace('DROP','',$valor);
	$valor	=trim($valor);
	return mysql_real_escape_string($valor);
}

	function mychecksintaxe_GRIDVALUES($valor) {

		/*
		$valor	=ereg_replace('&','',$valor);
		$valor	=ereg_replace("\"",'',$valor);
		$valor	=ereg_replace("\'",'',$valor);
		$valor	=ereg_replace(",",'',$valor);
		$valor=trim($valor);
		*/
	//	$valor=htmlentities($valor);

		$valor = preg_replace("/[^a-zA-Z0-9\\s\(\)\.\-\/]/", "", $valor);//jb 14/04/2014

		return $valor;
	}
function mychecksintaxe_GRID($valor) {

	$valor	=ereg_replace('&','',$valor);
	$valor	=ereg_replace("\"",'',$valor);
	$valor	=ereg_replace("\'",'',$valor);
	$valor=trim($valor);
//	$valor=htmlentities($valor);
	return $valor;
}

function mychecksintaxe_num_POSITIVO($valor) {

	$valor	=ereg_replace(',','.',$valor);
	$valor	=ereg_replace('-','',$valor);
	$valor	=ereg_replace(' ','',$valor);
	if (""==$valor) {$valor=0;}

	return $valor;
}


function mychecksintaxe_num_BR($valor) {

	$valor	=ereg_replace(',','',$valor);
	$valor	=ereg_replace('\.',',',$valor);
	$valor	=ereg_replace(' ','',$valor);
	if (""==$valor) {$valor=0;}

	return $valor;
}
function mychecksintaxe_num_PC($valor) {

	$valor	=ereg_replace('\.','',$valor);
	$valor	=ereg_replace(' ','',$valor);

	return $valor;
}

function nucci_htmlentities($valor) {
	$valor=htmlentities($valor);
	$valor	=ereg_replace(" ","&nbsp;",$valor);
	return $valor;
}
function mychecksintaxe_numINIBR($valor) {

	$valor	=ereg_replace("\.","",$valor);
	$valor	=ereg_replace(',','.',$valor);
	$valor	=ereg_replace(' ','',$valor);
	if (""==$valor) {$valor=0;}

	return $valor;
}
function mychecksintaxe_checknewline($valor) {

	$valor	=ereg_replace("\n",'',$valor);
	$valor	=ereg_replace("\r",'',$valor);
	return $valor;
}
function GetEstadoCombo($suf) {

	$myCombo="";
	$myCombo.=SetComboOption("AC",$suf); // 1
	$myCombo.=SetComboOption("AL",$suf);// 2
	$myCombo.=SetComboOption("AP",$suf);// 3
	$myCombo.=SetComboOption("AM",$suf);// 4
	$myCombo.=SetComboOption("BA",$suf);// 5
	$myCombo.=SetComboOption("CE",$suf);// 6
	$myCombo.=SetComboOption("DF",$suf);// 7
	$myCombo.=SetComboOption("ES",$suf);// 8
	$myCombo.=SetComboOption("GO",$suf);// 9
	$myCombo.=SetComboOption("MA",$suf);//10
	$myCombo.=SetComboOption("MG",$suf);//11
	$myCombo.=SetComboOption("MS",$suf);//12
	$myCombo.=SetComboOption("MT",$suf);//13
	$myCombo.=SetComboOption("PA",$suf);//14
	$myCombo.=SetComboOption("PB",$suf);//15
	$myCombo.=SetComboOption("PR",$suf);//16
	$myCombo.=SetComboOption("PE",$suf);//17
	$myCombo.=SetComboOption("PI",$suf);//18
	$myCombo.=SetComboOption("SC",$suf);//19
	$myCombo.=SetComboOption("SE",$suf);//20
	$myCombo.=SetComboOption("SP",$suf);//21
	$myCombo.=SetComboOption("RJ",$suf);//22
	$myCombo.=SetComboOption("RN",$suf);//23
	$myCombo.=SetComboOption("RO",$suf);//24
	$myCombo.=SetComboOption("RR",$suf);//25
	$myCombo.=SetComboOption("RS",$suf);//26
	$myCombo.=SetComboOption("TO",$suf);//27

	return $myCombo;

}
function GetGrupo($cod_grp) {

	$myCombo="";

	$sql=" SELECT * FROM tbl_empresa_grupo where cod_grp=$cod_grp ";
	$resultcombo = mysql_query($sql);
	if (!$resultcombo) {
			echo("Error performing query: " . mysql_error() ); exit();
	}

	$rowcombo = mysql_fetch_array($resultcombo);

	return $rowcombo;

}

function GetGrupoCombo($cod_grp) {

	$myCombo="";

	$sql=" SELECT * FROM tbl_empresa_grupo where bativo_grp<>0 order by snome_grp  ";
	$resultcombo = mysql_query($sql);
	if (!$resultcombo) {
			echo("Error performing query: " . mysql_error() ); exit();
	}

	while($rowcombo = mysql_fetch_array($resultcombo)){
		$myCombo.=montar_combo($rowcombo['snome_grp'],$rowcombo['cod_grp'],$cod_grp);
	}

	return $myCombo;

}


	function CheckScanNOTA($tipo,$unidade,$cto,$serie) {
		global $localpath;
		$praca_nova=sprintf("%03d",(int)$unidade);
		$mydir="/custom/scanner/$praca_nova/$tipo/$serie/"; // tipo 1
		$myfilename="doc".$cto.".jpg";
		saveLOG("CheckScan ",$localpath.$mydir.$myfilename,1,1);

		//echo  " $localpath$mydir$myfilename ";
		//alteracao, procura tbm se o arquivo nao esta com extensao jpeg ou gif - JB 07/07/2011
		if (file_exists("$localpath$mydir$myfilename")) {
			return $mydir.$myfilename;
		} else {
			$myfilename="doc".$cto.".jpeg";
			if (file_exists("$localpath$mydir$myfilename")) {
				return $mydir.$myfilename;
			}else{
				$myfilename="doc".$cto.".gif";
				if (file_exists("$localpath$mydir$myfilename")) {
					return $mydir.$myfilename;
				}else{
					return "";
				}
			}
		}
	}
	function CheckScan($tipo,$unidade,$cto,$serie) {
		global $localpath;
		$cto=sprintf("%06d",(int)$cto);
		$praca_nova=sprintf("%03d",(int)$unidade);
		$mydir="/custom/scanner/$praca_nova/$tipo/$serie/"; // tipo 1
		$myfilename="doc".$cto.".jpg";
		saveLOG("CheckScan ",$localpath.$mydir.$myfilename,1,1);

		//echo  " $localpath$mydir$myfilename ";
		//alteracao, procura tbm se o arquivo nao esta com extensao jpeg ou gif - JB 07/07/2011
		if (file_exists("$localpath$mydir$myfilename")) {
			return $mydir.$myfilename;
		} else {
			$myfilename="doc".$cto.".jpeg";
			if (file_exists("$localpath$mydir$myfilename")) {
				return $mydir.$myfilename;
			}else{
				$myfilename="doc".$cto.".gif";
				if (file_exists("$localpath$mydir$myfilename")) {
					return $mydir.$myfilename;
				}else{
					return "";
				}
			}
		}
	}

	function CheckCTOScan($praca,$cto,$serie) {
		global $localpath;
		$cto=sprintf("%06d",(int)$cto);
		$praca_nova=sprintf("%03d",(int)$praca);
		$mydir="/custom/scanner/$praca_nova/1/$serie/"; // tipo 1
		$myfilename1="doc".$cto.".jpg";
		$myfilename2="doc".$cto.".jpeg";

//		echo  " $localpath$mydir$myfilename ";
		if (file_exists("$localpath$mydir$myfilename2")) {
			return $mydir.$myfilename2;
		} elseif (file_exists("$localpath$mydir$myfilename1")) {
            return $mydir.$myfilename1;
        } else {
			return "";
		}
	}
	function CheckCTOScanBOOL($praca,$cto) {
		global $localpath;
		$cto=sprintf("%06d",(int)$cto);
		$praca_nova=sprintf("%03d",(int)$praca);
		$mydir="scanner/$praca_nova/";
		$myfilename1="ctrc".$cto.".jpg";
		$myfilename2="ctrc".$cto.".jpeg";

//		echo  " $localpath$mydir$myfilename ";
		if (file_exists("$localpath$mydir$myfilename1")) {
			return 1;
		} elseif (file_exists("$localpath$mydir$myfilename2")) {
            return 1;
        } else {
			return 0;
		}


	}



	function mygetsituacao($valor){

		$myst = " SELECT tbl_situacao.* FROM tbl_situacao WHERE (cod_sit=$valor)";
		$myresult = mysql_query("$myst");
		$myrow = mysql_fetch_array($myresult);
		$myreturn = $myrow['snome_sit'];
		return $myreturn ;
	}

function GetUnidadeCombo($cod_grp) {

	$myCombo="";

	$sql=" SELECT tbl_unidade.* FROM tbl_unidade where (bativa_uni=1) and  (npr_uni is not null) and (ssigla_uni is not null) ORDER BY ssigla_uni   ";
	$resultcombo = mysql_query($sql);
	if (!$resultcombo) {
			echo("Error performing query: " . mysql_error() ); exit();
	}

	while($rowcombo = mysql_fetch_array($resultcombo)){
		$myCombo.=montar_combo($rowcombo['snome_uni'],$rowcombo['npr_uni'],$cod_grp);
	}

	return $myCombo;

}

function LogUsr($mycod_usr,$myip){
	$mysql=" UPDATE tbl_usuario SET dtlastlogin_usr=now(),slastiplogin_usr='$myip' where cod_usr=$mycod_usr  ";
	$myresult = mysql_query($mysql);
	if (!$myresult) {
			echo("Error performing query: " . mysql_error()."SQL:$mysql"); exit();
	}
}

function get_transportadora($cod_trp) {

	$mysql=" SELECT * FROM tbl_transportadora WHERE (cod_trans='$cod_trp') ";

	$myresult = mysql_query($mysql);
	if (!$myresult) {
		echo("Error performing query: " . mysql_error()."<BR><BR>$sql" );
		exit();
	}

	$myrow = mysql_fetch_array($myresult);
	$myreturn=$myrow['snome_trans'];
	mysql_free_result($myresult);

	return $myreturn;

}


function SendEmail($to,$subject,$msg) {
	global $g_NUCCI_GERAL_mailserver;
	global $g_NUCCI_GERAL_idemail;
	global $g_NUCCI_GERAL_emailadministrador;

	//jb 22/11/2011
	global $g_NUCCI_GERAL_AUTENTICA_SMTP;
	global $g_NUCCI_USER_SMTP;
	global $g_NUCCI_PASS_SMTP;
	global $g_NUCCI_GERAL_mailserver_port;

	$mail = new htmlMimeMail();

	if(1==$g_NUCCI_GERAL_AUTENTICA_SMTP){//jb 22/11/2011
		$mail->setSMTPParams("$g_NUCCI_GERAL_mailserver",$g_NUCCI_GERAL_mailserver_port,"$g_NUCCI_GERAL_idemail",true,"$g_NUCCI_USER_SMTP","$g_NUCCI_PASS_SMTP");
	}else{
		$mail->setSMTPParams("$g_NUCCI_GERAL_mailserver",$g_NUCCI_GERAL_mailserver_port,"$g_NUCCI_GERAL_idemail");
	}

	$mail->setReturnPath("$g_NUCCI_GERAL_emailadministrador");
    $mail->setHtml($msg,'');
	$mail->setFrom("$g_NUCCI_GERAL_emailadministrador");
	$mail->setSubject($subject);
	$mail->setHeader('X-Mailer', 'Nucci Systems - Sistema Web de Logística');
	$result = $mail->send(array($to), 'smtp');
	if (!$result) {
			print_r($mail->errors);
	}
	return 1;
}

function CheckFiltro($cookie_FILTRO_scnpj_emp,$cookie_FILTRO_snome_emp,$idioma='pt-br') {

	global $site_base;
	global $idioma_txt;
	$myreturn="";
	if (""!=$cookie_FILTRO_scnpj_emp) {
		$myreturn='<img border="0" src="/images/btn_mini_filtro.gif" onMouseOver="return overlib('."'".$idioma_txt{'perfil'}{'titulo'}.': <b>'.$cookie_FILTRO_snome_emp.'<BR />'.$cookie_FILTRO_scnpj_emp.'</b>'."'".');" onMouseOut="return nd();" ';
	}
	return $myreturn;
}

	function getWHEREFILTRO_NOTA($visualizartodasunidades=0) {
		global $cookie_FILTRO_scnpj_emp;
		global $cookie_FILTRO_snome_emp;
		global $cookie_mfilter_O_cnpj_usr;
		global $cookie_mfilter_D_cnpj_usr;
		global $C_NTIPO_EMP_REPRESENTANTE;
		global $C_NTIPO_EMP_CLIENTE_PAGANTE;
		global $C_NTIPO_EMP_ENVIO_DESTINO;
		global $C_NTIPO_EMP_DESTINATARIO;
		global $C_NTIPO_EMP_CLIENTECOMERCIAL;
		global $cookie_ntipo_usr;
		global $cookie_celula_scnpj_emp;
		global $g_NUCCI_GERAL_VIEW_CLIENTE_ONLYPAGADOR;
//echo "<!-- cookie_celula_scnpj_emp $cookie_celula_scnpj_emp $cookie_FILTRO_scnpj_emp -->";
		$local_cookie_celula_scnpj_emp;
		if (""!=$cookie_celula_scnpj_emp) {
//			$sWhere=" and ( ";
//				$sWhere.=" (tbl_nota.scnpj_emp_CLI IN ($cookie_celula_scnpj_emp)) or ";
//				$sWhere.=" (tbl_nota.scnpj_emp_OD IN ($cookie_celula_scnpj_emp)) or " ;
//				$sWhere.=" (tbl_nota.scnpj_emp_CON IN ($cookie_celula_scnpj_emp)) " ;
//			$sWhere.=" ) ";
			$local_cookie_celula_scnpj_emp.=",".$cookie_celula_scnpj_emp;
		}

		if (""!=$cookie_FILTRO_scnpj_emp ) {

			if ($cookie_ntipo_usr==C_NTIPO_USR_CLIENTE) {

				if (1==$g_NUCCI_GERAL_VIEW_CLIENTE_ONLYPAGADOR) {
					$sWhere.=" and ( ";

					$sWhere.=" (tbl_nota.scnpj_emp_CON IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) " ;

					$sWhere.=" or (tbl_nota.ntipo_not=0 and tbl_nota.scnpj_emp_CLI IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) " ;
					$sWhere.=" or (tbl_nota.ntipo_not=1 and tbl_nota.scnpj_emp_OD IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) " ;

					$sWhere.=" ) ";
				} else {
					$sWhere.=" and ( ";
					$sWhere.=" (tbl_nota.scnpj_emp_CLI IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or ";
					$sWhere.=" (tbl_nota.scnpj_emp_OD IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or " ;
					$sWhere.=" (tbl_nota.scnpj_emp_CON IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) " ;
					$sWhere.=" ) ";

				}
			}
			if ($cookie_ntipo_usr==C_NTIPO_USR_REMETENTE) {
				$sWhere.=" and ( ";
				$sWhere.=" (tbl_nota.scnpj_emp_CLI IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) ";
				$sWhere.=" ) ";
			}
			if ($cookie_ntipo_usr==C_NTIPO_USR_DESTINATARIO) {
				$sWhere.=" and ( ";
				$sWhere.=" (tbl_nota.scnpj_emp_OD IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp))  " ;
				$sWhere.=" ) ";
			}
			global $C_NTIPO_EMP_REDESPACHO;
			if ($cookie_ntipo_usr==C_NTIPO_EMP_REDESPACHO) {
				$sWhere.=" and (tbl_nota.scnpj_emp_REP in ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) " ;
			}

			if ($cookie_ntipo_usr<=C_NTIPO_USR_INFORMACAO) {
					$sWhere.=" and ( ";
					$sWhere.=" (tbl_nota.scnpj_emp_CLI IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or ";
					$sWhere.=" (tbl_nota.scnpj_emp_OD IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or " ;
					$sWhere.=" (tbl_nota.scnpj_emp_CON IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) " ;
					$sWhere.=" ) ";
			}



		}
		global $cookie_npr_uni;
		global $cookie_ntipo_usr;
		global $C_NTIPO_EMP_REPRESENTANTE;

		global $C_NTIPO_EMP_INFORMACAO;
		if ( ($cookie_ntipo_usr==C_NTIPO_USR_INFORMACAO) and (0==$visualizartodasunidades) ) {
			$sWhere.=" and  ( (tbl_nota.npr_not = '$cookie_npr_uni' ) or (tbl_nota.nuni_dest_not = '$cookie_npr_uni') or (tbl_nota.npr_atual_not = '$cookie_npr_uni') ) " ;
		}
		if ($cookie_ntipo_usr==C_NTIPO_USR_REPRESENTANTE) {
			$sWhere.=" and  ( (tbl_nota.npr_not = '$cookie_npr_uni' ) or (tbl_nota.nuni_dest_not = '$cookie_npr_uni') or (tbl_nota.npr_atual_not = '$cookie_npr_uni') ) " ;
		}
		global $C_NTIPO_USR_CONSIG;
		if ($cookie_ntipo_usr==C_NTIPO_USR_CONSIG) {
			$sWhere.=" and (tbl_nota.scnpj_emp_CON in ('$cookie_FILTRO_scnpj_emp')) " ;
		}
		global $C_NTIPO_USR_REDESPACHO;
		if ($cookie_ntipo_usr==C_NTIPO_USR_REDESPACHO) {
			$sWhere.=" and (tbl_nota.scnpj_emp_REP in ('$cookie_FILTRO_scnpj_emp')) " ;
		}
		if ($cookie_ntipo_usr==C_NTIPO_USR_VENDEDOR) {
			$sWhere.=" and ( ";
			$sWhere.=" (tbl_nota.scnpj_emp_CLI IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or ";
			$sWhere.=" (tbl_nota.scnpj_emp_OD IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or " ;
			$sWhere.=" (tbl_nota.scnpj_emp_CON IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) " ;
			$sWhere.=" ) ";
		}
		
		// GLA - 24/06/2016 - Comentei essas duas linhas abaixo, pq não deixa trazer os resultado do novo grid "DHTMLX"
	 	//nucci_debug_html(1," CHECK ".$cookie_ntipo_usr."/".$C_NTIPO_USR_REDESPACHO);
	 	//nucci_debug_html(1," CHECK ".$cookie_ntipo_usr."/".$C_NTIPO_USR_CONSIG);
		return $sWhere;
	}
	function getWHEREFILTRO_AWB($viewalluni=0) {

		global $cookie_FILTRO_scnpj_emp;
		global $cookie_FILTRO_snome_emp;
		global $cookie_mfilter_O_cnpj_usr;
		global $cookie_mfilter_D_cnpj_usr;
		global $cookie_cod_usr;
		global $C_NTIPO_EMP_CLIENTE_PAGANTE;
		global $C_NTIPO_EMP_ENVIO_DESTINO;
		global $C_NTIPO_EMP_DESTINATARIO;
		global $C_NTIPO_EMP_CONSIGNATARIO;
		global $C_NTIPO_EMP_CLIENTECOMERCIAL;
		global $cookie_ntipo_usr;

		//echo "<!-- cookie_FILTRO_scnpj_emp $cookie_FILTRO_scnpj_emp  -->";
		//echo "<!-- cookie_FILTRO_snome_emp $cookie_FILTRO_snome_emp  -->";
		//echo "<!-- cookie_mfilter_O_cnpj_usr $cookie_mfilter_O_cnpj_usr  -->";
		//echo "<!-- cookie_mfilter_D_cnpj_usr $cookie_mfilter_D_cnpj_usr  -->";
		$sWhere=" ";

		global $cookie_celula_scnpj_emp;
		if (""!=$cookie_celula_scnpj_emp) {
//			$sWhere.=" and ( ";
//				$sWhere.=" (tbl_awb.tbl_empresa_scnpj_emp_EXP IN ($cookie_celula_scnpj_emp)) or ";
//				$sWhere.=" (tbl_awb.tbl_empresa_scnpj_emp_DEST IN ($cookie_celula_scnpj_emp)) or " ;
//				$sWhere.=" (tbl_awb.tbl_empresa_scnpj_emp_CONS IN ($cookie_celula_scnpj_emp)) " ;
//			$sWhere.=" ) ";
			$local_cookie_celula_scnpj_emp.=",".$cookie_celula_scnpj_emp;

		}

		if ($cookie_FILTRO_scnpj_emp != "" ) {
			if ($cookie_ntipo_usr==C_NTIPO_USR_CLIENTE) {
				global $g_NUCCI_GERAL_VIEW_CLIENTE_ONLYPAGADOR;
				if (1==$g_NUCCI_GERAL_VIEW_CLIENTE_ONLYPAGADOR) {
					$sWhere.=" and ( ";
					$sWhere.=" (tbl_awb.tbl_empresa_scnpj_emp_EXP IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or ";
					$sWhere.=" (tbl_awb.tbl_empresa_scnpj_emp_DEST IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or " ;
					$sWhere.=" (tbl_awb.tbl_empresa_scnpj_emp_CONS IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) " ;
					$sWhere.=" ) ";
				} else {
					$sWhere.=" and ( ";
					$sWhere.=" (tbl_awb.tbl_empresa_scnpj_emp_EXP IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or ";
					$sWhere.=" (tbl_awb.tbl_empresa_scnpj_emp_DEST IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or " ;
					$sWhere.=" (tbl_awb.tbl_empresa_scnpj_emp_CONS IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) " ;
					$sWhere.=" ) ";

				}
			}
			if ($cookie_ntipo_usr==C_NTIPO_USR_REMETENTE) {
				$sWhere.="and ( ";
					$sWhere.=" (tbl_awb.tbl_empresa_scnpj_emp_EXP IN ('$cookie_FILTRO_scnpj_emp')) ";
				$sWhere.=" ) ";
			}
			if ($cookie_ntipo_usr==C_NTIPO_USR_DESTINATARIO) {
				$sWhere="and ( ";
					$sWhere.=" (tbl_awb.tbl_empresa_scnpj_emp_DEST IN ('$cookie_FILTRO_scnpj_emp'))  " ;
				$sWhere.=" ) ";
			}
		if ($cookie_ntipo_usr==C_NTIPO_USR_VENDEDOR) {
			$sWhere.=" and ( ";
			$sWhere.=" (tbl_awb.tbl_empresa_scnpj_emp_EXP IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or ";
			$sWhere.=" (tbl_awb.tbl_empresa_scnpj_emp_DEST IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or " ;
			$sWhere.=" (tbl_awb.tbl_empresa_scnpj_emp_CONS IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) " ;
			$sWhere.=" ) ";
		}
//			if ($cookie_mfilter_O_cnpj_usr == "") {
//				$sWhere.=" and (tbl_cto.scnpj_emp_REM IN ('$cookie_FILTRO_scnpj_emp'))";
//			}
//	 		if ($cookie_mfilter_O_cnpj_usr != "") {
//				$sWhere.=" and (tbl_cto.scnpj_emp_REM IN ('$cookie_FILTRO_scnpj_emp',$cookie_mfilter_O_cnpj_usr))  ";
//			}
//			if ($cookie_mfilter_D_cnpj_usr != "") {
//				$sWhere="and ( ";
//				if ($cookie_mfilter_O_cnpj_usr != "") {
//					$sWhere.=" (tbl_cto.scnpj_emp_REM IN ('$cookie_FILTRO_scnpj_emp',$cookie_mfilter_O_cnpj_usr)) or ";
//				}
//				$sWhere.=" (tbl_cto.scnpj_emp_DEST IN ('$cookie_FILTRO_scnpj_emp',$cookie_mfilter_D_cnpj_usr))  " ;
//				$sWhere.=" ) ";
//			}
		}
		if (-24==$cookie_cod_usr) {
			$sWhere.=" and (tbl_awb.tbl_empresa_scnpj_emp_EXP = '-24') ";
		}

		global $cookie_npr_uni;
		global $cookie_ntipo_usr;
		global $C_NTIPO_EMP_REPRESENTANTE;
		global $C_NTIPO_EMP_INFORMACAO;
		if ( ($cookie_ntipo_usr==C_NTIPO_USR_INFORMACAO) and (0==$viewalluni) ) {
			$sWhere.=" and ( (tbl_awb.npr_awb = '$cookie_npr_uni' ) or (tbl_awb.npr_dest_awb = '$cookie_npr_uni')  ) " ;
		}

		if ($cookie_ntipo_usr==C_NTIPO_USR_REPRESENTANTE) {
			$sWhere.=" and ( (tbl_awb.npr_awb = '$cookie_npr_uni' ) or (tbl_awb.npr_dest_awb = '$cookie_npr_uni')  ) " ;
		}
		global $C_NTIPO_USR_CONSIG;
		if ($cookie_ntipo_usr==C_NTIPO_USR_CONSIG) {
			$sWhere.=" and (tbl_awb.tbl_empresa_scnpj_emp_CONS in ('$cookie_FILTRO_scnpj_emp')) " ;
		}


		return $sWhere;
	}
	function getWHEREFILTRO_CTRC($visualizartodasunidades=0) {
		global $cookie_FILTRO_scnpj_emp;
		global $cookie_FILTRO_snome_emp;
		global $cookie_mfilter_O_cnpj_usr;
		global $cookie_mfilter_D_cnpj_usr;
		global $cookie_cod_usr;
		global $C_NTIPO_EMP_CLIENTE_PAGANTE;
		global $C_NTIPO_EMP_ENVIO_DESTINO;
		global $C_NTIPO_EMP_DESTINATARIO;
		global $C_NTIPO_EMP_CLIENTECOMERCIAL;
		global $cookie_ntipo_usr;

		//echo "<!-- cookie_FILTRO_scnpj_emp $cookie_FILTRO_scnpj_emp  -->";
		//echo "<!-- cookie_FILTRO_snome_emp $cookie_FILTRO_snome_emp  -->";
		//echo "<!-- cookie_mfilter_O_cnpj_usr $cookie_mfilter_O_cnpj_usr  -->";
		//echo "<!-- cookie_mfilter_D_cnpj_usr $cookie_mfilter_D_cnpj_usr  -->";
		$sWhere="";

		global $cookie_celula_scnpj_emp;
		if (""!=$cookie_celula_scnpj_emp) {
//			$sWhere.=" and ( ";
//					$sWhere.=" (tbl_cto.scnpj_emp_REM IN ($cookie_celula_scnpj_emp)) or ";
//					$sWhere.=" (tbl_cto.scnpj_emp_DEST IN ($cookie_celula_scnpj_emp)) or " ;
//					$sWhere.=" (tbl_cto.scnpj_emp_CON IN ($cookie_celula_scnpj_emp)) " ;
//			$sWhere.=" ) ";
			$local_cookie_celula_scnpj_emp.=",".$cookie_celula_scnpj_emp;

		}

		if ($cookie_FILTRO_scnpj_emp != "" ) {
			if ($cookie_ntipo_usr==C_NTIPO_USR_CLIENTE) {
				global $g_NUCCI_GERAL_VIEW_CLIENTE_ONLYPAGADOR;
				if (1==$g_NUCCI_GERAL_VIEW_CLIENTE_ONLYPAGADOR) {
					$sWhere.="and ( ";
						$sWhere.=" (tbl_cto.scnpj_emp_PAG IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) ";
					$sWhere.=" ) ";
				} else {
					$sWhere.="and ( ";
					$sWhere.=" (tbl_cto.scnpj_emp_REM IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or ";
					$sWhere.=" (tbl_cto.scnpj_emp_DEST IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or " ;
					$sWhere.=" (tbl_cto.scnpj_emp_CON IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) " ;
					$sWhere.=" ) ";

				}
			}
			if ($cookie_ntipo_usr==C_NTIPO_USR_REMETENTE) {
				$sWhere.="and ( ";
					$sWhere.=" (tbl_cto.scnpj_emp_REM IN ('$cookie_FILTRO_scnpj_emp')) ";
				$sWhere.=" ) ";
			}
			if ($cookie_ntipo_usr==C_NTIPO_USR_DESTINATARIO) {
				$sWhere="and ( ";
					$sWhere.=" (tbl_cto.scnpj_emp_DEST IN ('$cookie_FILTRO_scnpj_emp'))  " ;
				$sWhere.=" ) ";
			}

//			if ($cookie_mfilter_O_cnpj_usr == "") {
//				$sWhere.=" and (tbl_cto.scnpj_emp_REM IN ('$cookie_FILTRO_scnpj_emp'))";
//			}
//	 		if ($cookie_mfilter_O_cnpj_usr != "") {
//				$sWhere.=" and (tbl_cto.scnpj_emp_REM IN ('$cookie_FILTRO_scnpj_emp',$cookie_mfilter_O_cnpj_usr))  ";
//			}
//			if ($cookie_mfilter_D_cnpj_usr != "") {
//				$sWhere="and ( ";
//				if ($cookie_mfilter_O_cnpj_usr != "") {
//					$sWhere.=" (tbl_cto.scnpj_emp_REM IN ('$cookie_FILTRO_scnpj_emp',$cookie_mfilter_O_cnpj_usr)) or ";
//				}
//				$sWhere.=" (tbl_cto.scnpj_emp_DEST IN ('$cookie_FILTRO_scnpj_emp',$cookie_mfilter_D_cnpj_usr))  " ;
//				$sWhere.=" ) ";
//			}
		}
		if (-24==$cookie_cod_usr) {
			$sWhere.=" and (tbl_cto.scnpj_emp_REM = '-24') ";
		}

		global $cookie_npr_uni;
		global $cookie_ntipo_usr;
		global $C_NTIPO_EMP_REPRESENTANTE;
		global $C_NTIPO_EMP_INFORMACAO;
		if ( ($cookie_ntipo_usr==C_NTIPO_USR_INFORMACAO) and (0==$visualizartodasunidades) ) {
			//$sWhere.=" and ( (tbl_cto.spr_cto = '$cookie_npr_uni' ) or (tbl_cto.sprdest_cto = '$cookie_npr_uni')  ) " ;
			$sWhere.=" and ( (tbl_cto.spr_cto = '$cookie_npr_uni' ) or (tbl_cto.sprdest_cto = '$cookie_npr_uni') or (tbl_cto.npratual_cto = '$cookie_npr_uni') ) " ;//08/04/2013
		}

		if ($cookie_ntipo_usr==C_NTIPO_USR_REPRESENTANTE) {
			//$sWhere.=" and ( (tbl_cto.spr_cto = '$cookie_npr_uni' ) or (tbl_cto.sprdest_cto = '$cookie_npr_uni')  ) " ;// incluido o pr atual no filtro - jb 08/04/2013
			$sWhere.=" and ( (tbl_cto.spr_cto = '$cookie_npr_uni' ) or (tbl_cto.sprdest_cto = '$cookie_npr_uni') or (tbl_cto.npratual_cto = '$cookie_npr_uni')  ) " ;
		}
		global $C_NTIPO_USR_CONSIG;
		if ($cookie_ntipo_usr==C_NTIPO_USR_CONSIG) {
			$sWhere.=" and (tbl_cto.scnpj_emp_CON in ('$cookie_FILTRO_scnpj_emp')) " ;
		}
		global $C_NTIPO_USR_REDESPACHO;
		if ($cookie_ntipo_usr==C_NTIPO_USR_REDESPACHO) {
			$sWhere.=" and (tbl_cto.scnpj_emp_RED in ('$cookie_FILTRO_scnpj_emp')) " ;
		}
		if ($cookie_ntipo_usr==C_NTIPO_USR_VENDEDOR) {
			$sWhere.="and ( ";
			$sWhere.=" (tbl_cto.scnpj_emp_REM IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or ";
			$sWhere.=" (tbl_cto.scnpj_emp_DEST IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or " ;
			$sWhere.=" (tbl_cto.scnpj_emp_CON IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) " ;
			$sWhere.=" ) ";
		}

		return $sWhere;
	}

	function getWHEREFILTRO_Minuta($visualizartodasunidades=0) {
		global $cookie_FILTRO_scnpj_emp;
		global $cookie_FILTRO_snome_emp;
		global $cookie_mfilter_O_cnpj_usr;
		global $cookie_mfilter_D_cnpj_usr;
		global $C_NTIPO_EMP_CLIENTE_PAGANTE;
		global $C_NTIPO_EMP_ENVIO_DESTINO;
		global $C_NTIPO_EMP_DESTINATARIO;
		global $C_NTIPO_EMP_DESTINATARIO;
		global $C_NTIPO_EMP_CLIENTECOMERCIAL;
		global $C_NTIPO_EMP_INFORMACAO;
		global $cookie_ntipo_usr;

		//echo "<!-- cookie_FILTRO_scnpj_emp $cookie_FILTRO_scnpj_emp  -->";
		//echo "<!-- cookie_FILTRO_snome_emp $cookie_FILTRO_snome_emp  -->";
		//echo "<!-- cookie_mfilter_O_cnpj_usr $cookie_mfilter_O_cnpj_usr  -->";
		//echo "<!-- cookie_mfilter_D_cnpj_usr $cookie_mfilter_D_cnpj_usr  -->";


		$sWhere='';

		global $cookie_celula_scnpj_emp;
		if (""!=$cookie_celula_scnpj_emp) {
//			$sWhere.=" and ( ";
//				$sWhere.=" (tbl_minuta.scnpj_emp_REM IN ($cookie_celula_scnpj_emp)) or ";
//				$sWhere.=" (tbl_minuta.scnpj_emp_DEST IN ($cookie_celula_scnpj_emp)) or " ;
//				$sWhere.=" (tbl_minuta.scnpj_emp_CON IN ($cookie_celula_scnpj_emp)) " ;
//			$sWhere.=" ) ";
			$local_cookie_celula_scnpj_emp.=",".$cookie_celula_scnpj_emp;
		}

		if ($cookie_FILTRO_scnpj_emp != "" ) {

			if ($cookie_ntipo_usr==C_NTIPO_USR_CLIENTE) {
				global $g_NUCCI_GERAL_VIEW_CLIENTE_ONLYPAGADOR;
				if (1==$g_NUCCI_GERAL_VIEW_CLIENTE_ONLYPAGADOR) {
					$sWhere.="and ( ";
						$sWhere.=" (tbl_minuta.scnpj_emp_PAG IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp))  ";
					$sWhere.=" ) ";
				} else {
					$sWhere.="and ( ";
						$sWhere.=" (tbl_minuta.scnpj_emp_REM IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or ";
						$sWhere.=" (tbl_minuta.scnpj_emp_DEST IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or " ;
						$sWhere.=" (tbl_minuta.scnpj_emp_CON IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) " ;
					$sWhere.=" ) ";

				}
			}
			if ($cookie_ntipo_usr==C_NTIPO_USR_REMETENTE) {
				$sWhere.="and ( ";
					$sWhere.=" (tbl_minuta.scnpj_emp_REM IN ('$cookie_FILTRO_scnpj_emp')) ";
				$sWhere.=" ) ";
			}
			if ($cookie_ntipo_usr==C_NTIPO_USR_DESTINATARIO) {
				$sWhere.="and ( ";
					$sWhere.=" (tbl_minuta.scnpj_emp_DEST IN ('$cookie_FILTRO_scnpj_emp'))  " ;
				$sWhere.=" ) ";
			}

		}

		global $cookie_npr_uni;
		global $cookie_ntipo_usr;
		global $C_NTIPO_EMP_REPRESENTANTE;

		global $C_NTIPO_EMP_INFORMACAO;
		if ( ($cookie_ntipo_usr==C_NTIPO_USR_INFORMACAO) and (0==$visualizartodasunidades) ) {
			//$sWhere.=" and ( (tbl_minuta.tbl_unidade_npr_uni = '$cookie_npr_uni' ) or (tbl_minuta.npr_dest_min = '$cookie_npr_uni')  ) " ;//jb 19/04/2013
			$sWhere.=" and 1=1 and ( (tbl_minuta.tbl_unidade_npr_uni = '$cookie_npr_uni' ) or (tbl_minuta.npr_dest_min = '$cookie_npr_uni') or (tbl_minuta.npratual_min = '$cookie_npr_uni') ) " ;
		}
		if ($cookie_ntipo_usr==C_NTIPO_USR_REPRESENTANTE) {
			$sWhere.=" and 2=2 and ( (tbl_minuta.tbl_unidade_npr_uni = '$cookie_npr_uni' ) or (tbl_minuta.npr_dest_min = '$cookie_npr_uni')  ) " ;
		}
		global $C_NTIPO_USR_CONSIG;
		if ($cookie_ntipo_usr==C_NTIPO_USR_CONSIG) {
			$sWhere.=" and (tbl_minuta.scnpj_emp_CON in ('$cookie_FILTRO_scnpj_emp')) " ;
		}
		global $C_NTIPO_USR_REDESPACHO;
		if ($cookie_ntipo_usr==C_NTIPO_USR_REDESPACHO) {
			$sWhere.=" and (tbl_minuta.scnpj_emp_RED in ('$cookie_FILTRO_scnpj_emp')) " ;
		}
		if ($cookie_ntipo_usr==C_NTIPO_USR_VENDEDOR) {
			$sWhere.="and ( ";
			$sWhere.=" (tbl_minuta.scnpj_emp_REM IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or ";
			$sWhere.=" (tbl_minuta.scnpj_emp_DEST IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) or " ;
			$sWhere.=" (tbl_minuta.scnpj_emp_CON IN ('$cookie_FILTRO_scnpj_emp' $local_cookie_celula_scnpj_emp)) " ;
			$sWhere.=" ) ";
		}
		return $sWhere;
	}
function inserthistorico($dtdata_hst,$cod_not,$cod_usr,$cod_sit,$mdescricao_hst) {

	$strSQL=" insert ignore into tbl_historico set ";
	$strSQL.=" dtdata_hst='$dtdata_hst' ";
	$strSQL.=" ,cod_not='$cod_not' ";
	$strSQL.=" ,cod_usr='$cod_usr' ";
	$strSQL.=" ,cod_sit ='$cod_sit' ";
	$strSQL.=" ,mdescricao_hst ='$mdescricao_hst' ";
	$strSQL.=" ,dtinclusao_hst =now() ";
//echo "$strSQL";
	$result = mysql_query($strSQL);
	if (!$result) {
//		echo("$strSQL <BR> Error performing query: " . mysql_error() );
//		exit();
	}
//saveLOG('inserthistorico ',$strSQL,1,2);	
	return mysql_insert_id();

}

function GetTipoEmbalagem($codigo) {
	if (""==$codigo) {
		return "";
	}
	$str = "SELECT snome_tpemb FROM tbl_nucci_tipoembalagem WHERE cod_tpemb = $codigo";
	$rst = mysql_query("$str");
	$row = mysql_fetch_array($rst);
	return $row['snome_tpemb'];
}

function GetTipoProduto($codigo) {
	$str = "SELECT snome_tpprd FROM tbl_nucci_tipoproduto WHERE cod_tpprd = $codigo";
	$rst = mysql_query("$str");
	$row = mysql_fetch_array($rst);
	return $row['snome_tpprd'];
}

function saveLOG_EDI ($cod_edi=0,$sfile_edil="",$descricao="",$usuario="",$erro=0) {
	if (""==$usuario) {
		echo("(LOG) Sem usuário definido. Entre novamente no sistema para REVALIDAR o seu login. ($titulo)" );
		exit();
	}
	$erro=mychecksintaxe_num($erro);

	$descricao=mysql_escape_string($descricao);
	$sqlLOG 	 = " INSERT INTO tbl_edi_log set ";
	$sqlLOG  	.= " tbl_edi_cod_edi 	= $cod_edi, ";
	$sqlLOG  	.= " sfile_edil 	= '$sfile_edil', ";
	$sqlLOG  	.= " dtdata_edil 	= now(), ";
	$sqlLOG  	.= " mlog_edil	= \"$descricao\", ";
	$sqlLOG  	.= " cod_usr = $usuario, ";
	$sqlLOG  	.= " berror_edil = $erro ";

	$rstLOG = mysql_query($sqlLOG);
	if (!$rstLOG) {
		echo("Error performing query: " . mysql_error()."<BR><BR>$sqlLOG" );
		exit();
	}
	return mysql_insert_id();
}

function saveLOG ($titulo,$descricao="",$usuario=0,$tipo=0) {
	global $cookie_cod_usr;

	if (""==$usuario) {
		echo("(LOG) Sem usuário definido. Entre novamente no sistema para REVALIDAR o seu login. ($titulo)" );
		exit();
	}
//	$usuario=mychecksintaxe_num($cookie_cod_usr);
	if (is_array($descricao) || is_object($descricao)) {
		$descricao="ARRAY: ".print_r($descricao,true);
	} 

	$descricao=mysql_escape_string($descricao);
	$sqlLOG 	 = " INSERT INTO tbl_log SET ";
	$sqlLOG  	.= " dtdata_log 	= now(),
					mdesc_log	= \"$descricao\",
					tbl_usuario_cod_usr = $usuario,
					tbl_nucci_tipo_log_cod_tplog = $tipo,
					stitulo_log = '$titulo' 
				";
	$rstLOG = mysql_query($sqlLOG);

//	die("$sqlLOG - ".mysql_error());
	if (!$rstLOG) {
		echo("Error performing query: " . mysql_error()."<BR><BR>$sqlLOG" );
		exit();
	}
}


	function checkDATA($valor=0,$tamanho=0) {
		$newvalor = $valor;
		if (""==$valor) {
			for($i=0;$i<$tamanho;$i++) {
				$newvalor.= "-";
			}
		}
		return $newvalor;
	}

	function checkCLIENTE($nome,$limite,$tamanho) {
		$cliente = $nome;
		if (strlen($nome)>$limite) {
			$cliente=substr($nome,0,$tamanho).'...';
		}
		return $cliente;
	}

function GetUsuario($mycod_usr){

	if (""!=$mycod_usr) {

		$strSQL=" SELECT tbl_usuario.* FROM tbl_usuario WHERE cod_usr=$mycod_usr ";
		$myresult = mysql_query($strSQL);
		if (!$myresult) {
  			echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
			exit();
		}
	 	$myrow = mysql_fetch_array($myresult);

	}
	return $myrow;
}
function GetUserfromEmail($email="") {
	if (""==$email) { return 0; }
	$strSQL=" SELECT cod_usr FROM tbl_usuario WHERE semail_usr='$email'  ";
	$myresult = mysql_query($strSQL);
 	$myrow = mysql_fetch_array($myresult);
	return $myrow['cod_usr'];
}
function GetUsersfromEmail($email="") {
	if (""==$email) { return 0; }
	$strSQL=" SELECT cod_usr FROM tbl_usuario WHERE semail_usr='$email'  ";
	$myresult = mysql_query($strSQL);
	$retorno=array();
 	while ($myrow = mysql_fetch_array($myresult)) {
		$retorno[]=$myrow['cod_usr'];
	}
	return $retorno;
}

function GetEmailFromUsers($cod_usr=0,$filtro="") {

	$strSQL=" SELECT semail_usr FROM tbl_usuario WHERE  cod_usr>0 ";
	if (0<$cod_usr) {
		$strSQL.=" and cod_usr=$cod_usr ";
	}
	if (""!=trim($filtro)) {
		$strSQL.=" and $filtro ";
	}
//	saveLOG("GetEmailFromUsers","$strSQL",1,1);

	$myresult = mysql_query($strSQL);
	$retorno="";
 	while ($myrow = mysql_fetch_array($myresult)) {
		if (""!=$retorno) {$retorno.=', ';}
		$retorno.=strtolower($myrow['semail_usr']);
	}
	return $retorno;
}
function GetEmailFromUsersUnidade($npr=0,$filtro="") {

	$strSQL=" SELECT DISTINCT tbl_usuario.semail_usr FROM tbl_unidade INNER JOIN tbl_usuario ON tbl_unidade.npr_uni = tbl_usuario.npr_uni WHERE (((tbl_usuario.semail_usr) Is Not Null And (tbl_usuario.semail_usr)<>'')) and ( tbl_usuario.npr_uni in ($npr) ) $filtro ORDER BY tbl_usuario.semail_usr";
//	saveLOG("GetEmailFromUsersUnidade","$strSQL",1,1);

	$myresult = mysql_query($strSQL);
	$retorno="";
 	while ($myrow = mysql_fetch_array($myresult)) {
		if (""!=$retorno) {$retorno.=', ';}
		$retorno.=strtolower($myrow['semail_usr']);
	}
	return $retorno;
}
function GetInfoEmpresa($info,$cnpj){
	$strReturn = "";
	$strSQL = " SELECT * FROM tbl_empresa WHERE scnpj_emp = '$cnpj' ";
	$myresult = mysql_query($strSQL);
	if (!$myresult) {
		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);
	switch($info) {
		case 1:
			$strReturn  = $myrow['snome_emp'];
			break;
		case 2:
			$strReturn  = $myrow['sendereco_emp'];
			break;
		case 3:
			$strReturn  = $myrow['scidade_emp'];
			break;
		case 4:
			$strReturn  = $myrow['suf_emp'];
			break;
		case 5:
			$strReturn  = $myrow['scep_emp'];
			break;
		case 6:
			$strReturn  = $myrow['cod_eclass'];
			break;
		case 7:
			$strReturn  = $myrow['sie_emp'];
			break;
		case 8:
			$strReturn  = $myrow['sbairro_emp'];
			break;
	}
	return $strReturn;
}

function GetInfoCia($info,$codigo){
	$strReturn = "";
	$strSQL = " SELECT * FROM tbl_ciaaerea WHERE cod_ciaa = $codigo ";
	$myresult = mysql_query($strSQL);
	if (!$myresult) {
		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);
	switch($info) {
		case 1:
			$strReturn  = $myrow['snome_ciaa'];
			break;
		case 2:
			$strReturn  = $myrow['ssigla_ciaa'];
			break;
		case 3:
			$strReturn  = $myrow['sICAO_ciaa'];
			break;
		case 4:
			$strReturn  = $myrow['sfullname_ciaa'];
			break;
		case 5:
			$strReturn  = $myrow['srazao_ciaa'];
			break;
		case 6:
			$strReturn  = $myrow['ssite_ciaa'];
			break;
		case 7:
			$strReturn  = $myrow['scontacorrente_ciaa'];
			break;
		case 8:
			$strReturn  = $myrow['nstatus_ciaa'];
			break;
	}
	return $strReturn;
}

function GetInfoEmpresaFULL($cnpj){
	$strReturn = "";
	$strSQL = " SELECT * FROM tbl_empresa WHERE scnpj_emp = '$cnpj' ";
	$myresult = mysql_query($strSQL);
	if (!$myresult) {
		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);


	return $myrow;
}
function GetInfoEmpresaFULL_ibge($cnpj){
	$strReturn = "";

	$strSQL = "  SELECT tbl_empresa.*, tbl_nucci_cidade.* ";
	$strSQL.= " FROM tbl_empresa LEFT JOIN tbl_nucci_cidade ON (tbl_empresa.scidade_emp = tbl_nucci_cidade.snome_ncid) AND (tbl_empresa.suf_emp = tbl_nucci_cidade.tbl_nucci_estado_ssigla_nuf) ";
	$strSQL.= " WHERE scnpj_emp = '$cnpj' ";
	$myresult = mysql_query($strSQL);
	if (!$myresult) {
		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_assoc($myresult);


	return $myrow;
}
function GetTipoEntregaString($tipo) {
	$myreturn="";
	switch($tipo){
		case 0:$myreturn="Domicílio";break;
		case 1:$myreturn="Retira no Aeroporto";break;
	}
	return $myreturn;
}

function GetTipoFreteString($mytipofrete){
	switch($mytipofrete){
		case 0:$myreturn="CIF";break;
		case 1:$myreturn="FOB";break;
		case 2:$myreturn="Á VISTA";break;
		case 3:$myreturn="A PAGAR";break;
	}
	return $myreturn;
}
function GetTipoFreteVISTAPAGAR($mytipofrete){
	switch($mytipofrete){
		case 0:$myreturn="A PAGAR";break;
		case 1:$myreturn="Á VISTA";break;
	}
	return $myreturn;
}
function GetModalString($cod_modal) {

	$mysql=" SELECT * FROM tbl_nucci_modal WHERE (cod_modal='$cod_modal') ";
	$myresult = mysql_query($mysql);
	if (!$myresult) {
		echo("Error performing query: " . mysql_error()."<BR><BR>$sql" );
		exit();
	}

	$myrow = mysql_fetch_array($myresult);
	$myreturn=$myrow['sdesc_modal'];
	mysql_free_result($myresult);

	return $myreturn;

}

function mkdirs($dir, $mode = 0777, $recursive = true) {
  if( is_null($dir) || $dir === "" ){
   return FALSE;
  }
  if( is_dir($dir) || $dir === "/" ){
   return TRUE;
  }
  if( mkdirs(dirname($dir), $mode, $recursive) ){
    $retorno		=mkdir($dir, $mode);
  	$retorno2		=@chmod($dir,0777);
   return $retorno;
  }
  return FALSE;
}

function mkdir_recursive($dirName){
// foreach(split('/',dirname($dirName)) as $dirPart){

// 	mkdir($newDir="$newDir$dirPart/");
//	echo "$newDir<BR>";
// };
	$working_directory=$dirName;
	do {
 	  $dir = $working_directory;

 	  while (!@mkdir($dir,0777)) {
 	      $dir = dirname($dir);

  	     if ($dir == '/' || is_dir($dir))
  	         break;
  	 }
	} while ($dir != $working_directory);


}


function mychecksintaxe_numCNPJCPF($valor) {

	$valor	=ereg_replace("\.","",$valor);
	$valor	=ereg_replace("\,","",$valor);
	$valor	=ereg_replace("\-","",$valor);
	$valor	=ereg_replace("\/","",$valor);

	return $valor;
}

function FormatFixo($smy_input,$smy_len,$smy_fill) {

	$smyformatstr="";

	if (strlen($smy_input)>abs($smy_len)) {
		$smy_input=substr($smy_input,0,abs($smy_len)) ;
	}
	$smyformatstr="%".$smy_len."s";
	$myformatado=sprintf($smyformatstr,$smy_input);
	$myfill_str='';
	if (""!=$smy_fill) {
		for($myindex=0;$myindex<abs($smy_len);$myindex++) {
			$myfill_str.=$smy_fill;
		}
		if(0<$smy_len){
			$myfill_str=substr($myfill_str,0,$smy_len-strlen($smy_input)).$smy_input;
		}else{
			$myfill_str=$smy_input.substr($myfill_str,0,abs($smy_len)-strlen($smy_input));
		}
	} else {
		$myfill_str=$myformatado;
	}
	return $myfill_str;
}


function FormatFixoNum($smy_input,$smy_len,$smy_fill,$smy_dec) {

	$smyformatstr="";
	$strReturn=number_format($myvalor,$smy_dec,",",".");


	$valorfmt =mychecksintaxe_num(number_format(mychecksintaxe_num($smy_input),$smy_dec,",","."));
	$valorfmt	=ereg_replace("\,","",$valorfmt);
	$valorfmt	=ereg_replace("\.","",$valorfmt);
	$valorfmt	=ereg_replace(" ","",$valorfmt);
	$smy_input=$valorfmt;

	if (strlen($smy_input)>abs($smy_len))	{
		$smy_input=substr($smy_input,strlen($smy_input)-$smy_len,$smy_len) ;
	}
	$smyformatstr="%".$smy_len."s";
	$myformatado=sprintf($smyformatstr,$smy_input);

	$myfill_str='';
	if (""!=$smy_fill) {
		for($myindex=0;$myindex<$smy_len;$myindex++) {
			$myfill_str.=$smy_fill;
		}
		$myfill_str=substr($myfill_str,0,$smy_len-strlen($smy_input)).$smy_input;
	} else {
		$myfill_str=$myformatado;
	}

	return $myfill_str;

}
function myNucciFormatCOD($nCOD,$nTAM=6) {
	$myreturn="";
	$myreturn=FormatFixo($nCOD,$nTAM,'0');
	return $myreturn;
}

function myNucciCountFilesInDir($dir) {
	$counter = 0;
	$countdir = opendir($dir);
	while($file = readdir($countdir)){
	   if($file != '.' && $file != '..'){
		if(!is_dir($dir.$file)){
	      $counter++;
		}
	   }
	}
	closedir($countdir);
	return $counter;
}


function GetComboBanco($current){
	//carregar combos de bancos
   $strSQL=" SELECT * FROM tbl_nucci_banco  order by nnumero_nban ";
   $resultcombo = mysql_query($strSQL);
	if (!$resultcombo) {
	  	echo("Error performing query: " . mysql_error() );
		exit();
	}
	while ( $rowcombo = mysql_fetch_array($resultcombo) ) {
		$combo_banco.=montar_combo($rowcombo['nnumero_nban']."-".$rowcombo['snome_nban'],$rowcombo['nnumero_nban'],$current);
	}
	return $combo_banco;
}

function no_acentos($myvalor){
	$array_____acentos=array("á","â","ã","à","Á","Â","Ã","À","é","ê","É","Ê","í","Í","ó","ô","õ","Ó","Ô","Õ","ú","ü","Ú","Ü","ç","Ç");
	$arrray_no_acentos=array("a","a","a","a","A","A","A","A","e","e","E","E","i","I","o","o","o","O","O","O","u","u","U","U","c","C");
	$myvalor=str_replace($array_____acentos,$arrray_no_acentos,$myvalor);
	return $myvalor;
}

	function ajustaDESC($valor,$indice) {
		$espaco="&nbsp;";
		ereg("/<![^>]*>/",$valor);
		if ($valor!="") {
			$valor.="...";
		}
		str_replace("<BR>",$espaco,$valor);
		str_replace("<br>",$espaco,$valor);
		$valor=substr($valor,0,$indice);
		return $valor;
	}
	function ordenarDate($data,$idioma_id='pt-br') {

		if (strpos($data,"/")) {
    		$stipo="BARRA";
		}else{
			$stipo="HIFEN";
		}

		list($data1,$hora1)=split(' ',$data,2);
		if("BARRA"==$stipo){
			$dt = split ("/",$data1);
			$h	= split (":",$hora1);
			$datah = mktime($h[0],$h[1],$h[2],$dt[1],$dt[0],$dt[2]);
			$datah_2 = date("l",$datah);
			$datah_3 = date("d/m/Y H:i:s",$datah);
		}else{
			$dt = split ("-",$data1);//jb 15/05/2014
			$h	= split (":",$hora1);
			$datah = mktime($h[0],$h[1],$h[2],$dt[1],$dt[2],$dt[0]);//jb 15/05/2014
			$datah_2 = date("l",$datah);
			$datah_3 = date("d/m/Y H:i:s",$datah);
		}

		if ('pt-br'==$idioma_id) {
			switch ($datah_2) {
				case "Sunday":
					$dia = "Dom";
					break;
				case "Monday":
					$dia = "Seg";
					break;
				case "Tuesday":
					$dia = "Ter";
					break;
				case "Wednesday":
					$dia = "Qua";
					break;
				case "Thursday":
					$dia = "Qui";
					break;
				case "Friday":
					$dia = "Sex";
					break;
				case "Saturday":
					$dia = "Sab";
					break;
			}
		}
		if ('en'==$idioma_id) {
			switch ($datah_2) {
				case "Sunday":
					$dia = "Sun";
					break;
				case "Monday":
					$dia = "Mon";
					break;
				case "Tuesday":
					$dia = "Tue";
					break;
				case "Wednesday":
					$dia = "Wed";
					break;
				case "Thursday":
					$dia = "Thu";
					break;
				case "Friday":
					$dia = "Fri";
					break;
				case "Saturday":
					$dia = "Sat";
					break;
			}
		}
		$dataf = $datah_3." ".$dia;
		return $dataf;
	}

	function getGRIDUNIDADE($semfilial_txt="SEM FILIAL",$unidadefixa=0) {
		$strUNI = " SELECT npr_uni,snome_uni,ssigla_uni FROM tbl_unidade WHERE bativa_uni=1 ";
		if (0!=$unidadefixa) {
			$strUNI.= "	and npr_uni=$unidadefixa ";
		}
		$strUNI.= "	ORDER BY ssigla_uni ";
		$rstUNI = mysql_query("$strUNI");
		if (0==$unidadefixa) {
			$dadosRETURN = "0:$semfilial_txt";
		}
		while ($rowUNI = mysql_fetch_array($rstUNI)) {
			if (""!=$dadosRETURN) {
				$dadosRETURN .= ",";
			}
			$dadosRETURN .= $rowUNI['npr_uni'].":".$rowUNI['ssigla_uni']."-".$rowUNI['snome_uni'];
		}
		return $dadosRETURN;
	}
	function getGRIDVENDEDOR() {
		$strVEN = "SELECT cod_usr,snome_usr FROM tbl_usuario WHERE bvendedor_usr = 1 ORDER BY snome_usr ";
		$rstVEN = mysql_query("$strVEN");
		$dadosRETURN .= "0:NENHUM";
		while ($rowVEN = mysql_fetch_array($rstVEN)) {
			if (""!=$dadosRETURN) {
				$dadosRETURN .= ",";
			}
			$dadosRETURN .= $rowVEN['cod_usr'].":".$rowVEN['snome_usr'];
		}
		return $dadosRETURN;
	}
	
	//jb 26/07/2016
	function getGRIDOCORRENCIA($cnpj=-1) {
		$strSQL = " SELECT cod_oco,scnpj_emp,nid_oco,sdesc_oco,bbaixa_oco ";
		$strSQL.= " FROM tbl_ocorrencia ";
		$strSQL.= " where ntipo_oco=0 ";
		
		if (""!=$cnpj) {
			$strSQL.= " and scnpj_emp='$cnpj' ";
		}
		
		$strSQL.= " order by  nid_oco ";
		$data = mysql_query($strSQL);
		
		$dadosRETURN="";
		
		while ($rowUNI = mysql_fetch_array($data)) {
			if (""!=$dadosRETURN) {
				$dadosRETURN .= ",";
			}
			$dadosRETURN .= $rowUNI['nid_oco'].":".$rowUNI['nid_oco']." - ".$rowUNI['sdesc_oco'];
		}
		return $dadosRETURN;
	}


function nucciCheckVariable($variable="") {
	$meuretorno="";
	if (""==$variable) {return "";}
	if (isset($_GET[$variable])) {
		$meuretorno=$_GET[$variable];
	}
	if (isset($_POST[$variable])) {
		$meuretorno=$_POST[$variable];
	}
	return $meuretorno;
}

function Random_Password($length) {
    srand(date("s"));
    $possible_charactors = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $string = "";
    while(strlen($string)<$length) {
        $string .= substr($possible_charactors, rand()%(strlen($possible_charactors) ),1);
    }
    return($string);
}
//echo Random_Password(8);

function GetCleanURL($url) {
	$urlarray=parse_url($url);

	return trim($urlarray['scheme']."://".$urlarray['host']."/");

}

function mychecksintaxe_data_inglestoportugues_small($valor) {

	$valor	=ereg_replace('Sun','Dom',$valor);
	$valor	=ereg_replace("Mon",'Seg',$valor);
	$valor	=ereg_replace("Tue",'Ter',$valor);
	$valor	=ereg_replace("Wed",'Qua',$valor);
	$valor	=ereg_replace("Thu",'Qui',$valor);
	$valor	=ereg_replace("Fri",'Sex',$valor);
	$valor	=ereg_replace("Sat",'Sab',$valor);

	return $valor;
}

function nucci_debug_html($forma=1,$valor="") {
	switch($forma) {
		case 1:
			echo "<!-- $valor -->\n";
			break;
	}
}

function mychecksintaxe_checknewline_string($valor) {

	$valor	=str_replace("\\n",' ',$valor);
	$valor	=str_replace("\\r",' ',$valor);
//	$valor	=ereg_replace('\\',' ',$valor);
	return $valor;
}
	function fixcalculo_casadecimal($valor,$nprecisaodec=2) {
//		return $valor;
		return round($valor,$nprecisaodec);
	}

function checkDATABOOLEAN($valor=0) {
	if (1==$valor) {return "Sim";}
	return "Não";
}


//The function returns the no. of business days between two dates and it skeeps the holidays
//Example:
//$holidays=array("2006-12-25","2006-12-26","2007-01-01");
//echo getWorkingDays("2006-12-22","2007-01-06",$holidays)
// => will return 8
function getWorkingDays($startDate,$endDate,$holidays){
    //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
    //We add one to inlude both dates in the interval.
    $days = (strtotime($endDate) - strtotime($startDate)) / 86400 + 1;

    $no_full_weeks = floor($days / 7);
    $no_remaining_days = fmod($days, 7);

    //It will return 1 if it's Monday,.. ,7 for Sunday
    $the_first_day_of_week = date("N",strtotime($startDate));
    $the_last_day_of_week = date("N",strtotime($endDate));

    //The two can't be equal because the $no_remaining_days (the interval between $the_first_day_of_week and $the_last_day_of_week) is at most 6
    //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
    if ($the_first_day_of_week < $the_last_day_of_week){
        if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
        if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
    }
    else{
        if ($the_first_day_of_week <= 6) $no_remaining_days--;
        //In the case when the interval falls in two weeks, there will be a Sunday for sure
        $no_remaining_days--;
    }

    //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
    $workingDays = $no_full_weeks * 5 + $no_remaining_days;

    //We subtract the holidays
    foreach($holidays as $holiday){
        $time_stamp=strtotime($holiday);
        //If the holiday doesn't fall in weekend
        if (strtotime($startDate) <= $time_stamp && $time_stamp <= strtotime($endDate) && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)
            $workingDays--;
    }

    return $workingDays;
}

function dec2any( $num, $base=62, $index=false ) {
    if (! $base ) {
        $base = strlen( $index );
    } else if (! $index ) {
        $index = substr( "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ,0 ,$base );
    }
    $out = "";
    for ( $t = floor( log10( $num ) / log10( $base ) ); $t >= 0; $t-- ) {
        $a = floor( $num / pow( $base, $t ) );
        $out = $out . substr( $index, $a, 1 );
        $num = $num - ( $a * pow( $base, $t ) );
    }
    return $out;
}
function any2dec( $num, $base=62, $index=false ) {
    if (! $base ) {
        $base = strlen( $index );
    } else if (! $index ) {
        $index = substr( "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 0, $base );
    }
    $out = 0;
    $len = strlen( $num ) - 1;
    for ( $t = 0; $t <= $len; $t++ ) {
        $out = $out + strpos( $index, substr( $num, $t, 1 ) ) * pow( $base, $len - $t );
    }
    return $out;
}
//
//
//
function aSortBySecondIndex($multiArray, $secondIndex) {
   while (list($firstIndex, ) = each($multiArray))
       $indexMap[$firstIndex] = $multiArray[$firstIndex][$secondIndex];
   asort($indexMap);
   while (list($firstIndex, ) = each($indexMap))
       if (is_numeric($firstIndex))
           $sortedArray[] = $multiArray[$firstIndex];
       else $sortedArray[$firstIndex] = $multiArray[$firstIndex];
   return $sortedArray;
}




function DateAdd($interval, $number, $date) {

    $date_time_array = getdate($date);
    $hours = $date_time_array['hours'];
    $minutes = $date_time_array['minutes'];
    $seconds = $date_time_array['seconds'];
    $month = $date_time_array['mon'];
    $day = $date_time_array['mday'];
    $year = $date_time_array['year'];

    switch ($interval) {
        case 'yyyy':
            $year+=$number;
            break;
        case 'q':
            $year+=($number*3);
            break;
        case 'm':
            $month+=$number;
            break;
        case 'y':
        case 'd':
        case 'w':
            $day+=$number;
            break;
        case 'ww':
            $day+=($number*7);
            break;
        case 'h':
            $hours+=$number;
            break;
        case 'n':
            $minutes+=$number;
            break;
        case 's':
            $seconds+=$number;
            break;
    }
    $timestamp= mktime($hours,$minutes,$seconds,$month,$day,$year);
    return $timestamp;
}

function add_days($my_date,$numdays) {
  $date_t = strtotime($my_date.' UTC');
  return gmdate('Y-m-d',$date_t + ($numdays*86400));
}


function showError2($tipo=0,$titulo="",$descricao="",$descricao_erro="",$blog=true) {
	global $G_NUCCI_LISTA_LEGENDA_AMANHA;
	global $G_NUCCI_LISTA_LEGENDA_HOJE;
	global $G_NUCCI_LISTA_LEGENDA_ATRASADO;
	global $site_base;
	global $cookie_cod_usr;

	$meuusuario=mychecksintaxe_num($cookie_cod_usr);

	$icon="/images/icon_stophand.gif";
	switch ($tipo) {
		case NUCCI_ERROR_RESTRICTED: 	$icon="/images/icon_restricted.jpg"; 		break;
		case NUCCI_ERROR_SERVERERROR:	$icon="/images/icon_error_servererror.gif"; break;
		case NUCCI_ERROR_SQL:			$icon="/images/icon_error_servererror.gif"; break;
	}

?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td height="1" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="1" colspan="2" style=" border-top-style:dashed; border-top-color:#CCCCCC; border-top-width:1px" >&nbsp;</td>
  </tr>
  <tr>
    <td height="114" align="center" valign="middle"><img src="<?=$icon?>" /></td>
    <td><div align="center" id="showERROR_MSG" class="textbolddark"><?=$descricao?></div></td>
  </tr>
  <tr>
    <td height="1" colspan="2" style=" border-top-style:dashed; border-top-color:#CCCCCC; border-top-width:1px" >&nbsp;</td>
  </tr>
</table>
<?
	if ($blog) {
		saveLog("ERROR $titulo - $blog",$descricao."-".$descricao_erro,$meuusuario,NUCCI_ERROR_RESTRICTED,$blog);
	}
}


function GetSIAFI($estado="",$cidade="") {
	$strVEN = " SELECT tbl_nucci_cidadesiafi.cod_nsiafi FROM tbl_nucci_cidadesiafi WHERE (((tbl_nucci_cidadesiafi.snome_nsiafi)=\"$cidade\") AND ((tbl_nucci_cidadesiafi.suf_nsiafi)=\"$estado\")) ";
//echo "<!-- $strVEN -->\n";
	$rstVEN = mysql_query("$strVEN");
	$rowVEN = mysql_fetch_array($rstVEN);
	return $rowVEN['cod_nsiafi'];
}

function is_date($value, $format = 'yyyy-mm-dd'){

	if(strlen($value) == 10 && strlen($format) == 10){
		// find separator. Remove all other characters from $format
		$separator_only = str_replace(array('m','d','y'),'', $format);
		$separator = $separator_only[0]; // separator is first character

		if($separator && strlen($separator_only) == 2){

			// make regex
			$regexp = str_replace('mm', '[0-1][0-9]', $value);
			$regexp = str_replace('dd', '[0-3][0-9]', $value);
			$regexp = str_replace('yyyy', '[0-9]{4}', $value);
			$regexp = str_replace($separator, "\\" . $separator, $value);

			if($regexp != $value && preg_match('/'.$regexp.'/', $value)){

				// check date
				$day = substr($value,strpos($format, 'd'),2);
				$month = substr($value,strpos($format, 'm'),2);
				$year = substr($value,strpos($format, 'y'),4);

				if(@checkdate($month, $day, $year)) return true;

			}
		}
	}
	return false;
}

function DoCalculaPerformanceEntrega($datainicio="",$datafinal="",$exclui_sabado=1,$scidade_entrega="",$suf_entrega="") {

	$performance=0;

	if ( (""==trim($datainicio)) or (!is_date($datainicio)) ) {
		return -1;
	}
	if ( (""==trim($datafinal)) or (!is_date($datafinal)) ) {
		return -1;
	}
	// Troca para ficar a comparação correta...
	if ( ($datainicio>$datafinal)) {
		$temp		=$datafinal;
		$datafinal	=$datainicio;
		$datainicio	=$temp;
	}

	$start_date     = strtotime($datainicio);
	$end_date     = strtotime($datafinal);
	$novadata		=$start_date;
	for($nIndex=0;$novadata<$end_date;$nIndex++) {
		$check_b		=date('w', $novadata);
		$novadata	=$novadata + (86400);
		$check		=date('w', $novadata);

		//chk DST - jb 24/02/2011
		if($check_b==$check){
			$novadata+=(3600);
			$check		=date('w', $novadata);
		}



		//chk holiday - JB 19/07/2010
		if(""!=$scidade_entrega && ""!=$suf_entrega){
			$is_holiday=CheckHoliday($novadata,$scidade_entrega,$suf_entrega);
		}else{
			$is_holiday=FALSE;
		}

		$performance++;
//echo "P$performance <BR>";
		if ((6==$check) and (1==$exclui_sabado)){
//echo "Sábado <BR>";
			$performance--;
			if ($end_date==$novadata) {
				// mesmo exclui foi entregue no sábado
				$performance++;
//echo "Continua <BR>";
			}
		}
		if (0==$check) {
//echo "Domingo <BR>";
			$performance--;
		}
		//checar se feriado - JB 19/07/2010
		if($is_holiday && 0!=$check && 6!=$check){
			$performance--;
		}
	}
	return $performance;

}
function dateDiff($dformat, $endDate, $beginDate)
{
$date_parts1=explode($dformat, $beginDate);
$date_parts2=explode($dformat, $endDate);
$start_date=gregoriantojd($date_parts1[0], $date_parts1[1], $date_parts1[2]);
$end_date=gregoriantojd($date_parts2[0], $date_parts2[1], $date_parts2[2]);
return $end_date - $start_date;
}
function isCNPJCPF($valor) {
	if(11==strlen($valor) )	{
		return checkCPF($valor);
	} else {
		return checkCNPJ($valor);
	}
}
function checkCPF($cpf) {
	//$cnpj = preg_replace( "@[./-]@", "", $cnpj );
	if( strlen($cpf) <> 11 or !is_numeric($cpf) )	{
		return false;
	}
	if( ($cpf == '00000000000') ) {
	   return false;
    }
	if( ($cpf == '11111111111')
	or  ($cpf == '22222222222')
	or  ($cpf == '33333333333')
	or  ($cpf == '44444444444')
	or  ($cpf == '55555555555')
	or  ($cpf == '66666666666')
	or  ($cpf == '77777777777')
	or  ($cpf == '88888888888')
	or  ($cpf == '99999999999')
	) {
	   return false;
    }

     for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf{$c} != $d) {
                return false;
            }
        }
	return true;

}
function checkCNPJ($cnpj) {
	//$cnpj = preg_replace( "@[./-]@", "", $cnpj );
	if( strlen($cnpj) <> 14 or !is_numeric($cnpj) )	{
		return false;
	}

	if( ($cnpj == '00000000000000') ) {
	   return false;
    }
	if( ($cnpj == '11111111111111')
	or  ($cnpj == '22222222222222')
	or  ($cnpj == '33333333333333')
	or  ($cnpj == '44444444444444')
	or  ($cnpj == '55555555555555')
	or  ($cnpj == '66666666666666')
	or  ($cnpj == '77777777777777')
	or  ($cnpj == '88888888888888')
	or  ($cnpj == '99999999999999')
	) {
	   return false;
    }

	$k = 6;
	$soma1 = "";
	$soma2 = "";

	for( $i = 0; $i < 13; $i++ ){
		$k = $k == 1 ? 9 : $k;
		$soma2 += ( $cnpj{$i} * $k );
		$k--;
		if($i < 12)	{
			if($k == 1)	{
				$k = 9;
				$soma1 += ( $cnpj{$i} * $k );
				$k = 1;
			} else {
				$soma1 += ( $cnpj{$i} * $k );
			}
		}
	}

	$digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
	$digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;
	return ( $cnpj{12} == $digito1 and $cnpj{13} == $digito2 );
}

function GetRPTOutPutFULL($txttitulo="",$fullfilename="",$fullfilename_zip="",$txtsubtitulo="Exportação") {
	global $site_base;
	global $localpath;
	$fileInfo		= new File_Info($fullfilename);
	$fileInfoZIP	= new File_Info($fullfilename_zip);

?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<TITLE><?=$g_title?></TITLE>
<link rel="stylesheet" type="text/css" href="/global.css">
</HEAD>
<BODY topmargin="0" leftmargin="0" marginwidth="0" marginheight="0" bgcolor="#FFFFFF">
<TABLE border="0" width="634" cellspacing="0" cellpadding="0" height="34" >
<TR><TD width="17" height="34" nowrap>&nbsp;</TD>
<TD width="64" height="34"><IMG border="0" src="/images/icone_currview.gif" width="62" height="26"></TD>
<TD height="34"><h1><?=$txttitulo?></h1></TD>
</TR></TABLE>
<TABLE border="0" width="629" cellspacing="0" cellpadding="0">
  <TR>
    <TD width="50" height="16" nowrap align="center"></TD>
    <TD width="467" height="16" valign="bottom"></TD>
  </TR>
  <TR>
    <TD width="50" height="25" nowrap align="center">&nbsp;</TD>
    <TD width="467" height="25"><font size="4" color="#000066"><b><?=$txtsubtitulo?></b></font></TD>
  </TR>
  <TR>
    <TD width="50" height="15" nowrap align="center"></TD>
    <TD width="467" height="15"><IMG border="0" src="/images/o_ponto_black.gif" width="570" height="1"></TD>
  </TR>
</TABLE>
<TABLE border="0" width="627" cellspacing="0" cellpadding="0">
    <TD width="50" height="20" nowrap align="center">&nbsp;</TD>
    <TD width="574" height="20" colspan="3">&nbsp;</TD>
  </TR>
  <TR>
    <TD width="50" height="20" nowrap align="center" rowspan="6">&nbsp;</TD>
    <TD width="63" height="20" valign="top" rowspan="6" align="center">
    <br>
    <a href="<?=$site_base?>export/<?=$fileInfo->getBasename()?>" onMouseOver="window.status='Download em formato Excel';return true" onMouseOut="window.status='';return true">
    <img border="0" src="/images/excel_4848.gif"><br>
    <font size="1">(<?=$fileInfo->getSize(FILE_INFO_SIZE_KB)?>Kb)</font></a><br>
    <br>
    <a href="<?=$site_base?>export/<?=$fileInfoZIP->getBasename()?>" onMouseOver="window.status='Download em formato ZIP';return true" onMouseOut="window.status='';return true">
    <img border="0" src="/images/zip_3232.png"><br>
    <font size="1">(<?=$fileInfoZIP->getSize(FILE_INFO_SIZE_KB)?>Kb)</font></a></TD>
    <TD width="3" height="20" rowspan="6">
    <IMG border="0" src="/images/o_ponto_black.gif" width="1" height="300"></TD>
    <TD width="511" height="4" valign="top">
    <br>
    <font size="1">&lt;= Clique nas figuras para fazer o download os arquivos.</font><br>
    &nbsp;<p>&nbsp;</p>
    <p>
    <br>
    Arquivo de Exportação Excel gerado em <?=$now?></TD>
  </TR>
  <TR>
    <TD width="511" height="4" valign="top">
    </TD>
  </TR>
  <TR>
    <TD width="511" height="3" valign="top">
    </TD>
  </TR>
  <TR>
    <TD width="511" height="3" valign="top">
    </TD>
  </TR>
  <TR>
    <TD width="511" height="3" valign="top">
    </TD>
  </TR>
  <TR>
    <TD width="511" height="3" valign="top">
    </TD>
  </TR>
  <TR>
    <TD height="32" nowrap align="center" width="50">&nbsp;</TD>
    <TD height="32" width="574" colspan="3">&nbsp;</TD>
  </TR>  <TR>
    <TD width="624" height="45" nowrap align="center" colspan="4">&nbsp;</TD>
  </TR>

</TABLE>
<? require $localpath."/php/n_footer.php" ?>
</BODY>
</HTML>
<?

}

function GetInfoSituacaoFULL($cod_sit){

	$mypr=mychecksintaxe_num($mypr);
	$strSQL=" SELECT * FROM tbl_situacao WHERE cod_sit = $cod_sit ";
	$myresult = mysql_query($strSQL);
	if (!$myresult) {
  		echo("Error performing query: " . mysql_error()."SQL:$strSQL" );
		exit();
	}
 	$myrow = mysql_fetch_array($myresult);
	return 	$myrow;
}

function myfixdateFECHAMENTO_toINICIAL_DMY($mydate) {

	if (""==trim($mydate)) {
		return "";
	}
	$dia='01';
	$ano=substr($mydate,0,4);
	$mes=substr($mydate,4,2);
	$myfixdate="$dia/$mes/$ano";
	if ($ano==0) {
		$myfixdate="";
	}

	return $myfixdate;
}

function myfixdateFECHAMENTO_toFINAL_DMY($mydate) {

	$diaa=array(31,28,31,30,31,30,31,31,30,31,30,31);
	if (""==trim($mydate)) {
		return "";
	}

	$ano=substr($mydate,0,4);
	$mes=substr($mydate,4,2);
	$dia=$diaa[$mes-1];

	$myfixdate="$dia/$mes/$ano";
	if ($ano==0) {
		$myfixdate="";
	}

	return $myfixdate;
}



//$ip=$_SERVER['REMOTE_ADDR'];
//if("172.17.3"!=substr($ip,0,8)){
//	exit();
//}

/*função para checar se determinada data é feriado. Olhar em 3 tabelas:
tbl_nucci_feriado - feriados nacionais e estaduais fixos (dia e mes)
tbl_operacao_feriado_cidade - feriados regionais por cidade (dia, mes e cidade)
tbl_operacao_feriado_variavel - feriados que variam conforme o ano (dia, mes e ano)
JB -  19/07/2010
*/

function CheckHoliday($data,$scidade_entrega,$suf_entrega){
	$date_formated=date('Y-m-d',$data);
	list($ano,$mes,$dia)=split("-",$date_formated);

	//checar feriados fixos nacionais e estaduais
	$strSQL=" SELECT dtdata_nfer FROM tbl_nucci_feriado WHERE (  date_format(dtdata_nfer,'%d-%m')='$dia-$mes' AND suf_nfer IS NULL  ) OR (  date_format(dtdata_nfer,'%d-%m')='$dia-$mes' AND suf_nfer='$suf_entrega'  ) ";
	//echo($strSQL."<br>");
	$GetHoliday=mysql_query($strSQL);
	if(0<mysql_num_rows($GetHoliday)){
		//echo("feriado fixo");
		return TRUE;

	}

	//checar feriados regionais
	$strSQL=" SELECT dtdata_ofc FROM tbl_operacao_feriado_cidade WHERE date_format(dtdata_ofc,'%d-%m')='$dia-$mes' AND scidade_ofc='$scidade_entrega' AND suf_ofc='$suf_entrega'  ";
	//echo($strSQL."<br>");
	$GetHoliday=mysql_query($strSQL);
	if(0<mysql_num_rows($GetHoliday)){
		//echo("feriado regional");
		return TRUE;
	}

	//checar feriados variáveis
	$strSQL=" SELECT dtdata_ofv FROM tbl_operacao_feriado_variavel WHERE date_format(dtdata_ofv,'%Y-%m-%d')='$date_formated' ";
	$GetHoliday=mysql_query($strSQL);
	//echo($strSQL."<br>");
	if(0<mysql_num_rows($GetHoliday)){
		//echo("feriado var");
		return TRUE;
	}
	//echo("feriado nenhum");
	return FALSE;
}

function getGrupoCNPJ($cod_grp){
  $sql = " SELECT scnpj_emp, snome_emp FROM tbl_empresa WHERE cod_grp = $cod_grp";
  $rst = mysql_query($sql);

  $arrayGrupo=array();
  $nIndex=0;
  while($row = mysql_fetch_array($rst)){
   $arrayGrupo[$nIndex][0]= $row['scnpj_emp'];
   $arrayGrupo[$nIndex][1]= $row['snome_emp'];

   $nIndex++;
  }

  return $arrayGrupo;
}
    function __validCerts($cert){
        $flagOK = true;
        $errorMsg = "";
        $data = openssl_x509_read($cert);
        $cert_data = openssl_x509_parse($data);
        // reformata a data de validade;
        $ano = substr($cert_data['validTo'],0,2);
        $mes = substr($cert_data['validTo'],2,2);
        $dia = substr($cert_data['validTo'],4,2);
        //obtem o timeestamp da data de validade do certificado
        $dValid = gmmktime(0,0,0,$mes,$dia,$ano);
        // obtem o timestamp da data de hoje
        $dHoje = gmmktime(0,0,0,date("m"),date("d"),date("Y"));
        // compara a data de validade com a data atual
        if ($dValid < $dHoje ){
            $flagOK = false;
            $errorMsg = "A Validade do certificado expirou em ["  . $dia.'/'.$mes.'/'.$ano . "]";
        } else {
            $flagOK = $flagOK && true;
        }
        //diferença em segundos entre os timestamp
        $diferenca = $dValid - $dHoje;
        // convertendo para dias
        $diferenca = round($diferenca /(60*60*24),0);
        //carregando a propriedade
        $daysToExpire = $diferenca;
        // convertendo para meses e carregando a propriedade
        $m = ($ano * 12 + $mes);
        $n = (date("y") * 12 + date("m"));
        //numero de meses até o certificado expirar
        $monthsToExpire = ($m-$n);
        $certMonthsToExpire = $monthsToExpire;
        $certDaysToExpire = $daysToExpire;
        return array('status'=>$flagOK,'error'=>$errorMsg,'meses'=>$monthsToExpire,'dias'=>$daysToExpire);
    } //fim validCerts

function GetPrazoCertificado_Unidade($uni,$senha) {
	global $localpath;

	$file=$localpath."/custom/certificado/".$uni.".pfx";

	if (!file_exists($file)) {
		saveLog('GetPrazoCertificado_Unidade 1','Sem arquivo '.$file,1,1);
		return -1;
	}
				$key = file_get_contents($file);

				//carrega os certificados e chaves para um array denominado $x509certdata
				if (!openssl_pkcs12_read($key,$x509certdata,$senha) ){
					return -2;
				} else {
			//verifica sua validade
					$aResp = __validCerts($x509certdata['cert']);

					$expiraem=$aResp['dias'];
					return $expiraem;
//					if (30>$expiraem) {
//						$temcertificado=4; // erro
//					}

//					if ( $aResp['error'] != '' ){
//						$temcertificado=3; // erro
//					}
				}
				return -3;
}

function signXML($docxml, $tagid='', $sfilechavepriv,$sfilechavepub){

	$URLdsig='http://www.w3.org/2000/09/xmldsig#';
	$URLCanonMeth='http://www.w3.org/TR/2001/REC-xml-c14n-20010315';
	$URLSigMeth='http://www.w3.org/2000/09/xmldsig#rsa-sha1';
	$URLTransfMeth_1='http://www.w3.org/2000/09/xmldsig#enveloped-signature';
	$URLTransfMeth_2='http://www.w3.org/TR/2001/REC-xml-c14n-20010315';
	$URLDigestMeth='http://www.w3.org/2000/09/xmldsig#sha1';

	// obter o chave privada para a ssinatura
	$fp = fopen($sfilechavepriv, "r");
	$priv_key = fread($fp, 8192);
	fclose($fp);
	$pkeyid = openssl_get_privatekey($priv_key);
	// limpeza do xml com a retirada dos CR, LF e TAB
	$order = array("\r\n", "\n", "\r", "\t");
	$replace = '';
	$docxml = str_replace($order, $replace, $docxml);
	// carrega o documento no DOM
	$xmldoc = new DOMDocument();
	$xmldoc->preservWhiteSpace = false; //elimina espaços em branco
	$xmldoc->formatOutput = false;
	// muito importante deixar ativadas as opçoes para limpar os espacos em branco
	// e as tags vazias
	$xmldoc->loadXML($docxml,LIBXML_NOBLANKS | LIBXML_NOEMPTYTAG);
	$root = $xmldoc->documentElement;
	//extrair a tag com os dados a serem assinados
	$node = $xmldoc->getElementsByTagName($tagid)->item(0);
	$id = trim($node->getAttribute("Id"));
	$idnome = preg_replace('/[^0-9]/','', $id);
	//extrai os dados da tag para uma string
	$dados = $node->C14N(false,false,NULL,NULL);
	//calcular o hash dos dados
	$hashValue = hash('sha1',$dados,true);
	//converte o valor para base64 para serem colocados no xml
	$digValue = base64_encode($hashValue);
	//monta a tag da assinatura digital
	$Signature = $xmldoc->createElementNS($URLdsig,'Signature');
	$root->appendChild($Signature);
	$SignedInfo = $xmldoc->createElement('SignedInfo');
	$Signature->appendChild($SignedInfo);
	//Cannocalization
	$newNode = $xmldoc->createElement('CanonicalizationMethod');
	$SignedInfo->appendChild($newNode);
	$newNode->setAttribute('Algorithm', $URLCanonMeth);
	//SignatureMethod
	$newNode = $xmldoc->createElement('SignatureMethod');
	$SignedInfo->appendChild($newNode);
	$newNode->setAttribute('Algorithm', $URLSigMeth);
	//Reference
	$Reference = $xmldoc->createElement('Reference');
	$SignedInfo->appendChild($Reference);
	$Reference->setAttribute('URI', '#'.$id);
	//Transforms
	$Transforms = $xmldoc->createElement('Transforms');
	$Reference->appendChild($Transforms);
	//Transform
	$newNode = $xmldoc->createElement('Transform');
	$Transforms->appendChild($newNode);
	$newNode->setAttribute('Algorithm', $URLTransfMeth_1);
	//Transform
	$newNode = $xmldoc->createElement('Transform');
	$Transforms->appendChild($newNode);
	$newNode->setAttribute('Algorithm', $URLTransfMeth_2);
	//DigestMethod
	$newNode = $xmldoc->createElement('DigestMethod');
	$Reference->appendChild($newNode);
	$newNode->setAttribute('Algorithm', $URLDigestMeth);
	//DigestValue
	$newNode = $xmldoc->createElement('DigestValue',$digValue);
	$Reference->appendChild($newNode);
	// extrai os dados a serem assinados para uma string
	$dados = $SignedInfo->C14N(false,false,NULL,NULL);
	//inicializa a variavel que irá receber a assinatura
	$signature = '';
	//executa a assinatura digital usando o resource da chave privada
	$resp = openssl_sign($dados,$signature,$pkeyid);
	//codifica assinatura para o padrao base64
	$signatureValue = base64_encode($signature);
	//SignatureValue
	$newNode = $xmldoc->createElement('SignatureValue',$signatureValue);
	$Signature->appendChild($newNode);
	//KeyInfo
	$KeyInfo = $xmldoc->createElement('KeyInfo');
	$Signature->appendChild($KeyInfo);
	//X509Data
	$X509Data = $xmldoc->createElement('X509Data');
	$KeyInfo->appendChild($X509Data);
	//carrega o certificado sem as tags de inicio e fim
	$cert = cleanCerts($sfilechavepub);
	//X509Certificate
	$newNode = $xmldoc->createElement('X509Certificate',$cert);
	$X509Data->appendChild($newNode);
	//grava na string o objeto DOM
	$docxml = $xmldoc->saveXML();
	// libera a memoria
	openssl_free_key($pkeyid);
	//retorna o documento assinado
	return $docxml;
} //fim signXML


function cleanCerts($certFile){
	//carregar a chave publica do arquivo pem
	$pubKey = file_get_contents($certFile);
	//inicializa variavel
	$data = '';
	//carrega o certificado em um array usando o LF como referencia
	$arCert = explode("\n", $pubKey);
	foreach ($arCert AS $curData) {
		//remove a tag de inicio e fim do certificado
		if (strncmp($curData, '-----BEGIN CERTIFICATE', 22) != 0 && strncmp($curData, '-----END CERTIFICATE', 20) != 0 ) {
			//carrega o resultado numa string
			$data .= trim($curData);
		}
	}
	return $data;
}

function limpaCampo($campo){
  $campo=strtolower($campo);
  $campo=str_replace ("'","",$campo);
  $campo=str_replace ("\"","",$campo);
  $campo=str_replace (";","",$campo);
  $campo=str_replace ("\\","",$campo);
  $campo=str_replace ("=","",$campo);
  $campo=str_replace ("script","",$campo);
  $campo=str_replace ("[","",$campo);
  $campo=str_replace ("{","",$campo);
  $campo=str_replace (" or ","",$campo);
  $campo=str_replace (" delete ","",$campo);
  $campo=str_replace (" and ","",$campo);
  $campo=str_replace (" update ","",$campo);
  $campo=str_replace (" insert ","",$campo);
  $campo=str_replace (" select ","",$campo);
  $campo=str_replace (" union ","",$campo);
  $campo=str_replace (" create ","",$campo);
  return $campo;
}

function limpaCampo_normal($campo){
  $campo=str_replace ("'","",$campo);
  $campo=str_replace ("\"","",$campo);
  $campo=str_replace (";","",$campo);
  $campo=str_replace ("\\","",$campo);
  $campo=str_replace ("=","",$campo);
  $campo=str_replace ("script","",$campo);
  $campo=str_replace ("[","",$campo);
  $campo=str_replace ("{","",$campo);
  $campo=str_replace (" or ","",$campo);
  $campo=str_replace (" delete ","",$campo);
  $campo=str_replace (" and ","",$campo);
  $campo=str_replace (" update ","",$campo);
  $campo=str_replace (" insert ","",$campo);
  $campo=str_replace (" select ","",$campo);
  $campo=str_replace (" union ","",$campo);
  $campo=str_replace (" create ","",$campo);
  return $campo;
}

function using_ie(){
	$u_agent = $_SERVER['HTTP_USER_AGENT'];
	$ub = False;
	if(preg_match('/MSIE/i',$u_agent)) {
		$ub = True;
	}
	return $ub;
}

function nucci_CreateEmpresa($dadosEMP) {
	global $cookie_cod_usr;

	$myQuery = " insert into tbl_empresa set ";
	$myQuery.= " dtcreate_emp 		=now() ";
	$myQuery.= ", cod_usr_create	='".mychecksintaxe_MYSQL(mychecksintaxe_num($cookie_cod_usr))."'";
	$myQuery.= ", scnpj_emp			='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scnpj_emp']))."'";
	$myQuery.= ", snome_emp			='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['snome_emp']))."'";
	$myQuery.= ", srazao_emp 		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['srazao_emp']))."'";
	$myQuery.= ", scep_emp			='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scep_emp']))."'";
	$myQuery.= ", sendereco_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['sendereco_emp']))."'";
	$myQuery.= ", snumero_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['snumero_emp']))."'";
	$myQuery.= ", scomplemento_emp	='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scomplemento_emp']))."'";
	$myQuery.= ", sbairro_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['sbairro_emp']))."'";
	$myQuery.= ", suf_emp			='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['suf_emp']))."'";
	$myQuery.= ", scidade_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scidade_emp']))."'";
	$myQuery.= ", sddd_emp			='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['sddd_emp']))."'";
	$myQuery.= ", stelefone_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['stelefone_emp']))."'";
	$myQuery.= ", scontato_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scontato_emp']))."'";
	$myQuery.= ", semail_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['semail_emp']))."'";
	$myQuery.= ", sie_emp 			='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['sie_emp']))."'";
	$myQuery.= ", scob_cep_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_cep_emp']))."'";
	$myQuery.= ", scob_endereco_emp	='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_endereco_emp']))."'";
	$myQuery.= ", scob_numero_emp	='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_numero_emp']))."'";
	$myQuery.= ", scob_complemento_emp	='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_complemento_emp']))."'";
	$myQuery.= ", scob_bairro_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_bairro_emp']))."'";
	$myQuery.= ", scob_uf_emp			='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_uf_emp']))."'";
	$myQuery.= ", scob_cidade_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_cidade_emp']))."'";
	$myQuery.= ", scob_telefone_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_telefone_emp']))."'";
	$myQuery.= ", scob_email_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_email_emp']))."'";
	$myQuery.= ", semailfiscal_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['semailfiscal_emp']))."'";
	$myQuery.= ", npr_uni				=".mychecksintaxe_MYSQL(mychecksintaxe_num($dadosEMP['npr_uni']))."";
	$myQuery.= ", ntipo_emp				=".mychecksintaxe_MYSQL(mychecksintaxe_num($dadosEMP['ntipo_emp']))."";
	$myQuery.= ", nclassfiscal_emp		=".mychecksintaxe_MYSQL(mychecksintaxe_num($dadosEMP['nclassfiscal_emp']))."";
	$myQuery.= ", sidcliente_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['sidcliente_emp']))."'";
	$myQuery.= ", cod_vendedor_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['cod_vendedor_emp']))."'";
	$myQuery.= ", bbloqueioemissao_emp	=".mychecksintaxe_MYSQL(mychecksintaxe_num($dadosEMP['bbloqueioemissao_emp']))." ";
	$myQuery.= ", mbloqueioemissao_emp	='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['mbloqueioemissao_emp']))."'";
	$myQuery.= ", nstatus_emp			=".mychecksintaxe_MYSQL(mychecksintaxe_num($dadosEMP['nstatus_emp']))." ";
	$myQuery.= ", sexp_conta_1_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['sexp_conta_1_emp']))."'";
	$myQuery.= ", sexp_conta_2_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['sexp_conta_2_emp']))."'";
	$myQuery.= ", sexp_conta_3_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['sexp_conta_3_emp']))."'";

	$rstUPEMP = mysql_query($myQuery);
	saveLOG("Insert Empresa CENTRAL",$myQuery." - ".mysql_error(),$cookie_cod_usr,2);
	if (!$rstUPEMP) {
		return 0;
	} else {
		return 1;
	}
}
function nucci_UpdateEmpresa($dadosEMP) {
	global $cookie_cod_usr;

	$myQuery = " update tbl_empresa set ";
	$myQuery.= " dtupdate_emp 		=now() ";
	$myQuery.= ", snome_emp			='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['snome_emp']))."'";
	$myQuery.= ", srazao_emp 		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['srazao_emp']))."'";
	$myQuery.= ", scep_emp			='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scep_emp']))."'";
	$myQuery.= ", sendereco_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['sendereco_emp']))."'";
	$myQuery.= ", snumero_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['snumero_emp']))."'";
	$myQuery.= ", scomplemento_emp	='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scomplemento_emp']))."'";
	$myQuery.= ", sbairro_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['sbairro_emp']))."'";
	$myQuery.= ", suf_emp			='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['suf_emp']))."'";
	$myQuery.= ", scidade_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scidade_emp']))."'";
	$myQuery.= ", sddd_emp			='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['sddd_emp']))."'";
	$myQuery.= ", stelefone_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['stelefone_emp']))."'";
	$myQuery.= ", scontato_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scontato_emp']))."'";
	$myQuery.= ", semail_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['semail_emp']))."'";
	$myQuery.= ", sie_emp 			='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['sie_emp']))."'";
	$myQuery.= ", scob_cep_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_cep_emp']))."'";
	$myQuery.= ", scob_endereco_emp	='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_endereco_emp']))."'";
	$myQuery.= ", scob_numero_emp	='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_numero_emp']))."'";
	$myQuery.= ", scob_complemento_emp	='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_complemento_emp']))."'";
	$myQuery.= ", scob_bairro_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_bairro_emp']))."'";
	$myQuery.= ", scob_uf_emp			='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_uf_emp']))."'";
	$myQuery.= ", scob_cidade_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_cidade_emp']))."'";
	$myQuery.= ", scob_telefone_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_telefone_emp']))."'";
	$myQuery.= ", scob_email_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scob_email_emp']))."'";
	$myQuery.= ", semailfiscal_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['semailfiscal_emp']))."'";
	$myQuery.= ", npr_uni				=".mychecksintaxe_MYSQL(mychecksintaxe_num($dadosEMP['npr_uni']))."";
	$myQuery.= ", ntipo_emp				=".mychecksintaxe_MYSQL(mychecksintaxe_num($dadosEMP['ntipo_emp']))."";
	$myQuery.= ", nclassfiscal_emp		=".mychecksintaxe_MYSQL(mychecksintaxe_num($dadosEMP['nclassfiscal_emp']))."";
	$myQuery.= ", sidcliente_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['sidcliente_emp']))."'";
	$myQuery.= ", cod_vendedor_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['cod_vendedor_emp']))."'";
	$myQuery.= ", bbloqueioemissao_emp	=".mychecksintaxe_MYSQL(mychecksintaxe_num($dadosEMP['bbloqueioemissao_emp']))." ";
	$myQuery.= ", mbloqueioemissao_emp	='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['mbloqueioemissao_emp']))."'";
	$myQuery.= ", nstatus_emp			=".mychecksintaxe_MYSQL(mychecksintaxe_num($dadosEMP['nstatus_emp']))." ";
	$myQuery.= ", sexp_conta_1_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['sexp_conta_1_emp']))."'";
	$myQuery.= ", sexp_conta_2_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['sexp_conta_2_emp']))."'";
	$myQuery.= ", sexp_conta_3_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['sexp_conta_3_emp']))."'";
	$myQuery.= " where scnpj_emp		='".mychecksintaxe_MYSQL(nucci_strtoupper($dadosEMP['scnpj_emp']))."'";

	$rstUPEMP = mysql_query($myQuery);
	saveLOG("update Empresa CENTRAL",$myQuery." - ".mysql_error(),$cookie_cod_usr,2);
	if (!$rstUPEMP) {
		return 0;
	} else {
		return 1;
	}
}

function limpaCampo_CNPJ($campo){
  $campo=str_replace (".","",$campo);
  $campo=str_replace ("-","",$campo);
  $campo=str_replace ("'","",$campo);
  $campo=str_replace ("/","",$campo);
  $campo=str_replace ("\"","",$campo);
  $campo=str_replace (";","",$campo);
  $campo=str_replace ("\\","",$campo);
  $campo=str_replace ("=","",$campo);
  $campo=str_replace ("script","",$campo);
  $campo=str_replace ("[","",$campo);
  $campo=str_replace ("{","",$campo);
  $campo=str_replace (" or ","",$campo);
  $campo=str_replace (" delete ","",$campo);
  $campo=str_replace (" and ","",$campo);
  $campo=str_replace (" update ","",$campo);
  $campo=str_replace (" insert ","",$campo);
  $campo=str_replace (" select ","",$campo);
  $campo=str_replace (" union ","",$campo);
  $campo=str_replace (" create ","",$campo);
  return $campo;
}


function certificadoValidade($alertaem=30,$sn_config_php){

	//require_once("../custom/config/n_config.php");
	require_once("$sn_config_php");
	require_once("lib/cte/ToolsCTePHP.class.php");
	require_once("lib/mime/htmlMimeMail.php");



	$dbcnx = @mysql_connect($mysql_host,$mysql_user, $mysql_senha);
	if (!$dbcnx) {
		echo( "Unable to connect to the database server at this time." );
		//exit();
		return false;
	}

	if (! @mysql_select_db($mysql_db) ) {
		echo( "Unable to locate the $mysql_db database at this time." );
		//exit();
		return false;
	}
	//saveLog("certificadoValidade config file",$sn_config_php,1,1);

	$str = " SELECT cod_uni, snome_uni, ssigla_uni, npr_uni,bativa_uni,npr_uni,scertificadosenha_uni,semail_uni
	FROM tbl_unidade
	WHERE (bcte_uni = 1 OR bnfe_uni = 1)	AND bativa_uni = 1
	ORDER BY snome_uni ";
	$result = mysql_query("$str");
	//saveLog("certificadoValidade 2",$str,1,1);

	while ($row = mysql_fetch_array($result)) {

		//saveLog("certificadoValidade send to unidade",$row['snome_uni'],1,1);
		$temcertificado=0;
		$expiraem='';
		//if (1==$row['bativa_uni']) {
			if(file_exists("$localpath/custom/certificado/".$row['npr_uni'].".pfx")) {
				$temcertificado=1;
				$file="$localpath/custom/certificado/".$row['npr_uni'].".pfx";
				$key = file_get_contents($file);
				//carrega os certificados e chaves para um array denominado $x509certdata
				if (!openssl_pkcs12_read($key,$x509certdata,$row['scertificadosenha_uni']) ){
					//saveLog("certificadoValidade erro",$expiraem." dias",1,1);
					$temcertificado=2; // erro
				} else {
					//verifica sua validade
					$aResp = __validCerts($x509certdata['cert']);
					//saveLog("certificadoValidade","resp".print_r($aResp,true),1,1);

					$expiraem=$aResp['dias'];
					//saveLog("certificadoValidade expira em",$expiraem." dias",1,1);
					if ($alertaem>$expiraem) {
						$temcertificado=4; // erro
						//saveLog("certificadoValidade tipo erro",$temcertificado,1,1);

						$message  =	 "ATENÇÃO, \n\n";
						$message .=	 "O Certificado Digital da unidade '".$row['snome_uni']."' expira em $expiraem dia(s).\n\n";
						$message .=	 "Providencie um novo certificado A1, assim que possivel!.\n\n\n";
						$message .=	 "Sistema de Informação \n";
						$message .=	 "(by Nucci Systems)";

						$message1  =	 "ATENÇÃO, <br><br>";
						$message1 .=	 "O Certificado Digital da unidade '".$row['snome_uni']."' expira em $expiraem dia(s).<br><br>";
						$message1 .=	 "Providencie um novo certificado A1, assim que possivel!<br><br>";
						$message1 .=	 "Sistema de Informação<br>";
						$message1 .=	 "(by Nucci Systems)";
					}

					if ( $aResp['error'] != '' ){
						$temcertificado=3; // erro
						//saveLog("certificadoValidade tipo erro",$temcertificado,1,1);

						$message  =	 "ATENÇÃO, \n\n";
						$message .=	 "O Certificado Digital da unidade '".$row['snome_uni']."' está expirado.\n\n";
						$message .=	 "A emissão de documentos não será possivel, até um novo certificado ser enviado!\n\n\n";
						$message .=	 "Sistema de Informação \n";
						$message .=	 "(by Nucci Systems)";

						$message1  =	 "ATENÇÃO, <br><br>";
						$message1 .=	 "O Certificado Digital da unidade '".$row['snome_uni']."' está expirado.<br><br>";
						$message1 .=	 "A emissão de documentos não será possivel, até um novo certificado ser enviado!<br><br>";
						$message1 .=	 "Sistema de Informação<br>";
						$message1 .=	 "(by Nucci Systems)";
					}
				}
			}

		//}
		if(3==$temcertificado || 4==$temcertificado){
			/////////////////// ENVIA EMAIL

			$email_from = $g_NUCCI_GERAL_emailadministrador;
			if(empty($email_from)){
				return false;
			}
			if(!empty($row['semail_uni'])){
				$email = $row['semail_uni'];
			} else {
				$email = $g_NUCCI_GERAL_emailadministrador;
			}
			$from 		= "Nucci System <".$email_from.">";
			$subject	= $g_title_short." - ALERTA CERTIFICADO DIGITAL";
			$to			= $email;

			$mail = new htmlMimeMail();
			//$mail->setSMTPParams("localhost",25,"me");
			if(1==$g_NUCCI_GERAL_AUTENTICA_SMTP){//jb 22/11/2011
				$mail->setSMTPParams($g_NUCCI_GERAL_mailserver,$g_NUCCI_GERAL_mailserver_port,$g_NUCCI_GERAL_idemail,true,$g_NUCCI_USER_SMTP,$g_NUCCI_PASS_SMTP);
			}else{
				$mail->setSMTPParams($g_NUCCI_GERAL_mailserver,$g_NUCCI_GERAL_mailserver_port,$g_NUCCI_GERAL_idemail);
			}
			$mail->setFrom($from);
			$mail->setSubject($subject);
			$mail->setHeader('X-Mailer', 'Nucci Systems (http://www.nucci.com.br/)');
			$mail->setHeader('X-ADV', 'Programa para enviar emails HTML com images incorporadas.');
			$mail->setHtml($message1,$message);
			$result=$mail->send(array($to), 'smtp');
			//saveLog("certificadoValidade","$mail->setSMTPParams($g_NUCCI_GERAL_mailserver,$g_NUCCI_GERAL_mailserver_port,$g_NUCCI_GERAL_idemail,true,$g_NUCCI_USER_SMTP,$g_NUCCI_PASS_SMTP);",1,1);
			echo $result."\n\n\n";
		}
	}

	return true;

}

function register_globals($order = 'egpcsn')
{
    // define a subroutine
    if(!function_exists('register_global_array'))
    {
        function register_global_array(array $superglobal)
        {
            foreach($superglobal as $varname => $value)
            {
                global $$varname;
                $$varname = $value;
            }
        }
    }

    $order = explode("\r\n", trim(chunk_split($order, 1)));
    foreach($order as $k)
    {
        switch(strtolower($k))
        {
            case 'e':    register_global_array($_ENV);        break;
            case 'g':    register_global_array($_GET);        break;
            case 'p':    register_global_array($_POST);        break;
            case 'c':    register_global_array($_COOKIE);    break;
            case 's':    register_global_array($_SERVER);    break;
			case 'n':    session_start(); register_global_array($_SESSION);    break;
        }
    }
}

class XML2Array {

    private static $xml = null;
	private static $encoding = 'UTF-8';

    /**
     * Initialize the root XML node [optional]
     * @param $version
     * @param $encoding
     * @param $format_output
     */
    public static function init($version = '1.0', $encoding = 'UTF-8', $format_output = true) {
        self::$xml = new DOMDocument($version, $encoding);
        self::$xml->formatOutput = $format_output;
		self::$encoding = $encoding;
    }

    /**
     * Convert an XML to Array
     * @param string $node_name - name of the root node to be converted
     * @param array $arr - aray to be converterd
     * @return DOMDocument
     */
    public static function &createArray($input_xml) {
        $xml = self::getXMLRoot();
		if(is_string($input_xml)) {
			$parsed = $xml->loadXML($input_xml);
			if(!$parsed) {
				throw new Exception('[XML2Array] Error parsing the XML string.');
			}
		} else {
			if(get_class($input_xml) != 'DOMDocument') {
				throw new Exception('[XML2Array] The input XML object should be of type: DOMDocument.');
			}
			$xml = self::$xml = $input_xml;
		}
		$array[$xml->documentElement->tagName] = self::convert($xml->documentElement);
        self::$xml = null;    // clear the xml node in the class for 2nd time use.
        return $array;
    }

    /**
     * Convert an Array to XML
     * @param mixed $node - XML as a string or as an object of DOMDocument
     * @return mixed
     */
    private static function &convert($node) {
		$output = array();

		switch ($node->nodeType) {
			case XML_CDATA_SECTION_NODE:
				$output['@cdata'] = trim($node->textContent);
				break;

			case XML_TEXT_NODE:
				$output = trim($node->textContent);
				break;

			case XML_ELEMENT_NODE:

				// for each child node, call the covert function recursively
				for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) {
					$child = $node->childNodes->item($i);
					$v = self::convert($child);
					if(isset($child->tagName)) {
						$t = $child->tagName;

						// assume more nodes of same kind are coming
						if(!isset($output[$t])) {
							$output[$t] = array();
						}
						$output[$t][] = $v;
					} else {
						//check if it is not an empty text node
						if($v !== '') {
							$output = $v;
						}
					}
				}

				if(is_array($output)) {
					// if only one node of its kind, assign it directly instead if array($value);
					foreach ($output as $t => $v) {
						if(is_array($v) && count($v)==1) {
							$output[$t] = $v[0];
						}
					}
					if(empty($output)) {
						//for empty nodes
						$output = '';
					}
				}

				// loop through the attributes and collect them
				if($node->attributes->length) {
					$a = array();
					foreach($node->attributes as $attrName => $attrNode) {
						$a[$attrName] = (string) $attrNode->value;
					}
					// if its an leaf node, store the value in @value instead of directly storing it.
					if(!is_array($output)) {
						$output = array('@value' => $output);
					}
					$output['@attributes'] = $a;
				}
				break;
		}
		return $output;
    }

    /*
     * Get the root XML node, if there isn't one, create it.
     */
    private static function getXMLRoot(){
        if(empty(self::$xml)) {
            self::init();
        }
        return self::$xml;
    }
}

	function utf8_converter($array)
	{
		array_walk_recursive($array, function(&$item, $key){
			if(mb_detect_encoding($item, 'utf-8', true)){
					$item = utf8_decode($item);
			}
		});
		return $array;
	}

function NUCCI_GetArrayfromDHTMLSerialize($xmlstring){
		global $cookie_cod_usr;
		$xmlstring=utf8_encode($xmlstring);
		//saveLog("sajax_SaveNF ",$xmlstring,1,$cookie_cod_usr);


		$array = XML2Array::createArray($xmlstring);
		//saveLog("sajax_SaveNF aaa ",print_r($array,true),1,$cookie_cod_usr);
		$array=utf8_converter($array);

		
		//saveLog("sajax_SaveNF aaa2 2",print_r($array,true),1,$cookie_cod_usr);
		
		//saveLog("sajax_SaveNF 2",print_r($array,true),1,$cookie_cod_usr);
		$lista_colunas=array();
		$lista_colunas2=array();
		$nIndex=0;
		foreach ($array['rows']['head']['column'] as $coluna ) {
			$lista_colunas[$nIndex]=$coluna['@attributes']['id'];
			$lista_colunas2[$coluna['@attributes']['id']]=$nIndex;
			$nIndex++;
		}
		//saveLog("lista_colunas pos_array_faixaprod",$pos_array_faixaprod,1,$cookie_cod_usr);
		//saveLog("lista_colunas ",print_r($lista_colunas,true),1,$cookie_cod_usr);
		//saveLog("lista_colunas index",print_r($lista_colunas2,true),1,$cookie_cod_usr);


		if (is_array($array['rows']['row']['cell'])) {
			//saveLog("T1",print_r($array['rows']['row']['cell'],true),1,$cookie_cod_usr);
			$dump=$array['rows']['row'];
			unset($array['rows']['row']);
			$array['rows']['row'][0]=$dump;
			unset($dump);
		} else {
			//saveLog("T2",print_r($array['rows']['row'],true),1,$cookie_cod_usr);
		}
		$dados_nf=array();
		$dados_nf_index=0;
		//saveLog("lista_colunas array ",print_r($array['rows']['row'],true),1,$cookie_cod_usr);
		foreach ($array['rows']['row'] as $linha ) {

			//saveLog("lista_colunas linha ",print_r($linha,true),1,$cookie_cod_usr);
			//saveLog("lista_colunas atri ",print_r($linha['@attributes'],true),1,$cookie_cod_usr);
			
			foreach($lista_colunas2 as $nome_campo => $indice_campo) {
				$dados_nf[$dados_nf_index][$nome_campo]=$linha['cell'][$indice_campo]['@cdata'];
			}
			
			foreach($linha['userdata'] as $dadosusuario) {
				//saveLog("dadosusuario ",print_r($dadosusuario,true),1,$cookie_cod_usr);
				$dados_nf[$dados_nf_index][$dadosusuario['@attributes']['name']]=$dadosusuario['@cdata'];
			}
			
			
			
			$dados_nf_index++;
			
			


		}
//		saveLog("campos",print_r($dados_nf,true),1,$cookie_cod_usr);
		return $dados_nf;

}

//remove espacos inclusive nao ascii - jb 24/08/2017
function nucci_trim($svar=""){
	if(""==$svar) return $svar;
	
	$svar = preg_replace('/[\pZ\pC]/u',' ',$svar);
	$svar=trim($svar);
	
	return $svar;
}

//funcao para pegar o motorista pela placa padrao do mesmo - jb 29/08/2017
function GetMotoristaFromPlaca($splacapadrao_mot=""){
		if(""==$splacapadrao_mot) return "";
		
		$strsql=" select scpf_mot from tbl_motorista where splacapadrao_mot='$splacapadrao_mot' limit 1 ";
		
		$GetMot=mysql_query($strsql);
		if(!$GetMot){
			return "";
		}
		$scpf_mot=mysql_result($GetMot,0,"scpf_mot");
		return $scpf_mot;
}


	##############################################################
	## Igualando ao máximos uma string							##
	##############################################################
	
	function igualar_string($nome){
		$nome = trim($nome); // Remove os espaços
		$nome = strtr($nome, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ", "aaaaeeiooouucAAAAEEIOOOUUC"); // Remove os acentos
		$nome = strtolower($nome); // Convertendo para minúsculas
		return $nome;
	}
	
	
if (!function_exists('session_register')) {
 eval('function session_register($name){global $$name;$_SESSION[$name] = $$name;$$name = &$_SESSION[$name];}');
}

register_globals();

myGetDateTime();

?>
