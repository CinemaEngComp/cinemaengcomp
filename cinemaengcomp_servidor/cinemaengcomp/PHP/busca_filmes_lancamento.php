<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

include_once 'conexao.php';

//select para buscar filmes que serao proximos lancamentos
$sql3 = $dbcon->query("SELECT * FROM filmes WHERE dat_inivig > current_date()");


// array for JSON response
$response3 = array();

if(mysqli_num_rows($sql3) > 0){

  //user node
  $response3["filmes_lancamentos"] = array();
  
  
  while ($row3 = mysqli_fetch_array($sql3)){
    
    $filmeslancamentos = array();
    $filmeslancamentos["nome_filme"]          = $row3["nome_filme"];
    $filmeslancamentos["genero_filme"]        = $row3["genero_filme"];
    $filmeslancamentos["duracao_filme"]       = $row3["duracao_filme"];
    $filmeslancamentos["classificacao_filme"] = $row3["classificacao_filme"];
    $filmeslancamentos["sinopse_filme"]       = $row3["sinopse_filme"];
    $filmeslancamentos["caminho"]             = $row3["caminho_banner"];
    $filmeslancamentos["codigo_filme"]        = $row3["codigo_filme"];
    
    array_push($response3["filmes_lancamentos"], $filmeslancamentos);
    
  }
  
  //echoing JSON reponse
  echo json_encode($response3);
  
}else{
   
   $response3["filmes_lancamentos"] = 'sem_lancamentos'; 
   echo json_encode($response3);

}

?>