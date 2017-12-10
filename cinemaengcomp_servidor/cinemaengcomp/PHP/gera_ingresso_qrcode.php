<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

include_once 'conexao.php';

//$codigo_ingresso   = $_POST['codigo_ingresso'];

$codigo_ingresso   = '1';

//select para buscar filmes em estreia
$sql2 = $dbcon->query("SELECT * FROM ingresso WHERE codigo_ingresso = '$codigo_ingresso'");

// array for JSON response
$response2 = array();



if(mysqli_num_rows($sql2) > 0){


  //$response2["genero"] = "estreias";
 
  //user node
  $response2["dados_ingresso"] = array();
  
  
  while ($row2 = mysqli_fetch_array($sql2)){
    
    $ingresso = array();

    $ingresso["qrcode_ingresso"]  = $row2["qrcode_ingresso"];
    
    
    array_push($response2["dados_ingresso"], $ingresso);
    
  }
  
  //echoing JSON reponse
  echo json_encode($response2);
  
}else{
  $response2["dados_ingresso"] = "sem_informacoes"; 
   echo json_encode($response2);
}

?>