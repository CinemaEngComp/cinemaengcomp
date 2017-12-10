<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

include_once 'conexao.php';

$codigo_sessao         = $_POST['codigo_sessao'];
$codigos_cadeiras = $_POST['codigos_cadeiras'];
$divisao = explode(";", $codigos_cadeiras);
$retorno = "";



for ($i = 0; $i <= count($divisao); $i++) {
    $sql1 = $dbcon->query("SELECT * FROM ingresso WHERE codigo_sessao='$codigo_sessao' AND codigo_cadeira='$divisao[$i]'" );
    while ($row1 = mysqli_fetch_array($sql1)){
        $codigo = $row1["codigo_cadeira"];
        $sql2 = $dbcon->query("SELECT * FROM cadeira WHERE codigo_cadeira='$codigo'" );
        while ($row2 = mysqli_fetch_array($sql2)){
            $retorno = $retorno . $row2["nome_cadeira"] ." ";
        }
    }
}

if (empty($retorno)) {
    echo "ok";
}
else{
    echo "A(s) cadeira(s) " . $retorno . " foram compradas.";
}




?>