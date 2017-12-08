<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

include_once 'conexao.php';

$codigo_sessao         = $_POST['codigo_sessao'];
$sql1 = $dbcon->query("SELECT * FROM ingresso WHERE codigo_sessao='$codigo_sessao'");

$response1 = array();

if(mysqli_num_rows($sql1) > 0){

  $response1["cadeiras"] = array();
  
  while ($row1 = mysqli_fetch_array($sql1)){
    $cadeiras = array();
    $codigo = $row1["codigo_cadeira"];
    $sql2 = $dbcon->query("SELECT * FROM cadeira WHERE codigo_cadeira='$codigo'");
     while ($row2 = mysqli_fetch_array($sql2)){
            $cadeiras = array();
            $cadeiras["codigo_cadeira"]          = $row2["codigo_cadeira"];
            $cadeiras["nome_cadeira"]          = $row2["nome_cadeira"];
            array_push($response1["cadeiras"], $cadeiras);
      }
  }
  echo json_encode($response1);
}else {
   echo 'sem_cadeiras';
}  


?>