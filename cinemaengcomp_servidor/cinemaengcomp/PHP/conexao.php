<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

//Base Nucci 

    $host = 'localhost';
    $usuario = 'sis_ingresso';
    $senha = "josdh9h78g!d";
    $banco = "sis_ingresso";
    $dbporta = 3306;

  $dbcon = new MySQLi("$host", "$usuario", "$senha", "$banco", "$dbporta");

  if($dbcon->connect_error){
      echo "conexao_erro";
  }
  //echo "Conectado com sucesso";

  mysqli_query($dbcon, "SET NAMES UTF8");
?>