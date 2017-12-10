<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

include_once 'conexao.php';


$codigo_sessao        =  $_POST['codigo_sessao'];

$codigo_sala;

$sql1 = $dbcon->query("SELECT * FROM sessao WHERE codigo_sessao='$codigo_sessao'");

// array for JSON response
$response1 = array();

if(mysqli_num_rows($sql1) > 0){

 
  while ($row1 = mysqli_fetch_array($sql1)){
    $codigo_sala = $row1["codigo_sala"];
  }
  
  $sql2 = $dbcon->query("SELECT * FROM cadeira WHERE codigo_sala='$codigo_sala'");
  

        echo strval(mysqli_num_rows($sql2));

     
  
}else {

   echo "sem_sessoes";
   
}  


?>