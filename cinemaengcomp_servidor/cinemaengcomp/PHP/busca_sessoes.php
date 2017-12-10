<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

include_once 'conexao.php';


$codigo_filme         = $_POST['codigo_filme'];
$data_sessao          = $_POST['data_sessao'];

$sql1 = $dbcon->query("SELECT * FROM sessao WHERE codigo_filme='$codigo_filme' AND data_sessao='$data_sessao' ORDER BY horario_sessao");

// array for JSON response
$response1 = array();


if(mysqli_num_rows($sql1) > 0){

 
  //user node
  $response1["sessoes"] = array();
  

  
  while ($row1 = mysqli_fetch_array($sql1)){
    
    $sessoes = array();
    $sessoes["codigo_sala"]          = $row1["codigo_sala"];
    $sessoes["codigo_filme"]         = $row1["codigo_filme"];
    $sessoes["data_sessao"]          = $row1["data_sessao"];
    $sessoes["horario_sessao"]       = $row1["horario_sessao"];
    $sessoes["codigo_sessao"]        = $row1["codigo_sessao"];

    
   
    array_push($response1["sessoes"], $sessoes);
    
  }
  
  //echoing JSON reponse
  echo json_encode($response1);
  
  
}else {

   echo 'sem_sessoes';
   
}  


?>