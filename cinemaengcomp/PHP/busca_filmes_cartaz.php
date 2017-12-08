<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

include_once 'conexao.php';

//select para buscar filmes em cartaz
$sql1 = $dbcon->query("SELECT * FROM filmes WHERE dat_inivig < current_date() AND dat_fimvig > current_date()");


// array for JSON response
$response1 = array();


if(mysqli_num_rows($sql1) > 0){

 // $response1["genero"] = "cartaz";
 
  //user node
  $response1["filmes_cartaz"] = array();
  
  
  while ($row1 = mysqli_fetch_array($sql1)){
    
    $filmescartaz = array();
    $filmescartaz["nome_filme"]          = $row1["nome_filme"];
    $filmescartaz["genero_filme"]        = $row1["genero_filme"];
    $filmescartaz["duracao_filme"]       = $row1["duracao_filme"];
    $filmescartaz["classificacao_filme"] = $row1["classificacao_filme"];
    $filmescartaz["sinopse_filme"]       = $row1["sinopse_filme"];
    $filmescartaz["caminho"]             = $row1["caminho_banner"];
    $filmescartaz["codigo_filme"]             = $row1["codigo_filme"];
    
    
   
    array_push($response1["filmes_cartaz"], $filmescartaz);
    
  }
  
  //echoing JSON reponse
  echo json_encode($response1);
  
  
}else {
   $response1["genero"] = "sem_cartaz"; 
   echo json_encode($response1);
   
}  

?>