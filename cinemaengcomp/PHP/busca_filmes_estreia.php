<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

include_once 'conexao.php';

//select para buscar filmes em estreia
$sql2 = $dbcon->query("SELECT * FROM filmes WHERE dat_inivig = current_date()");

// array for JSON response
$response2 = array();



if(mysqli_num_rows($sql2) > 0){


  //$response2["genero"] = "estreias";
 
  //user node
  $response2["filmes_estreias"] = array();
  
  
  while ($row2 = mysqli_fetch_array($sql2)){
    
    $filmesestreias = array();
    $filmesestreias["nome_filme"]          = $row2["nome_filme"];
    $filmesestreias["genero_filme"]        = $row2["genero_filme"];
    $filmesestreias["duracao_filme"]       = $row2["duracao_filme"];
    $filmesestreias["classificacao_filme"] = $row2["classificacao_filme"];
    $filmesestreias["sinopse_filme"]       = $row2["sinopse_filme"];
    $filmesestreias["caminho"]             = $row2["caminho_banner"];
    $filmesestreias["codigo_filme"]        = $row2["codigo_filme"];
    
   
    array_push($response2["filmes_estreias"], $filmesestreias);
    
  }
  
  //echoing JSON reponse
  echo json_encode($response2);
  
}else{
  $response2["genero"] = "sem_estreia"; 
   echo json_encode($response2);
}

?>