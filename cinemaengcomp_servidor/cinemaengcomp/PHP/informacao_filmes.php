<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

include_once 'conexao.php';


header('Content-Type: text/html; charset=utf-8');

$codigo           = $_POST['codigo'];

$sql = $dbcon->query("SELECT * FROM filmes WHERE codigo_filme = '$codigo'");

            $linha = mysqli_fetch_assoc($sql);

            echo $linha['nome_filme']; 
            echo "<br>";
            echo $linha['duracao_filme']; 
            echo "<br>";
            echo $linha['genero_filme']; 
            echo "<br>";
            echo $linha['classificacao_filme']; 
            echo "<br>";
            echo $linha['sinopse_filme']; 
?>