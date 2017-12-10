<?

require ('n_connector.php');

	mysql_query("BEGIN");

//	$assentos_selecionados=json_decode(stripslashes($aS));

//	echo stripslashes($aS)."\n\n\n";
//	print_r($assentos_selecionados);

	$aS=substr($aS,1,strlen($aS)-2);
//	$aS='{"I8":1,"J8":1,"J9":1,"I9":1,"I10":1,"J10":1}';


	$assentos_selecionados=json_decode(stripslashes($aS),true);

//	echo stripslashes($aS)."\n\n\n";
//	print_r($assentos_selecionados);


//	exit;

function mychecksintaxe_AS($valor) {

	$valor	=ereg_replace("\/","",$valor);
	$valor	=ereg_replace("\\","",$valor);

	return $valor;
}

//echo "CADEIRA $assentos_selecionados\n";
	foreach($assentos_selecionados as $ingresso_key => $valor_ingresso) {

//		echo "CADEIRA $ingresso_key\n";
		$cadeira=GetCadeira($sl,$ingresso_key);
//		print_r($cadeira);

		$codigo_cadeira=$cadeira['codigo_cadeira'];
		$qrcode_ingresso='CALMAAI';
		$codigo_sessao=$s;
		$cpf_cliente='';

		$sql=" INSERT INTO `ingresso`
		(
		`codigo_cadeira`,
		`qrcode_ingresso`,
		`codigo_sessao`,
		`cpf_cliente`)
		VALUES
		($codigo_cadeira,
		'$qrcode_ingresso',
		$codigo_sessao,
		'$cpf_cliente')
		 ";

		 //	echo "$sql\n";
		$result = mysql_query($sql);
		$codigo_ingresso=mysql_insert_id();
		saveLOG("INSERT INGRESSO ",$sql." - ".mysql_error(),1,1);

		$qrcode = addslashes('{"Filme":"'.$n.'", "Ingresso":"'.$codigo_ingresso.'", "Cadeira":"'.$codigo_cadeira.'", "CodFilme":"'
                    .$cf.'", "Sessao":"'.$codigo_sessao.'", "CPF":"'.$cpf_cliente.'"}');


		$sql=" update ingresso set qrcode_ingresso='$qrcode' where codigo_ingresso=$codigo_ingresso ";
		$result = mysql_query($sql);

		saveLOG("update INGRESSO ",$sql." - ".mysql_error(),1,1);

		$codigo_ingresso_array.=$codigo_ingresso."|";

	}


 mysql_query("COMMIT");

function GetCadeira($sala,$nome){
	$strSQL=" SELECT * from cadeira where codigo_sala=$sala and UPPER(nome_cadeira)='$nome' ";
	$result = mysql_query($strSQL);
	$myrow = mysql_fetch_array($result);
	return $myrow;
}


header("Location: sessao_ingresso.php?n=$n&cf=$cf&s=$s&c=".$codigo_ingresso_array);
exit();


?>