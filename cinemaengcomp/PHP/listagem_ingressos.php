<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664


include_once 'conexao.php';

$email         = $_POST['email'];

$sql1 = $dbcon->query("SELECT * FROM cadastro_usuario WHERE email='$email'");

$response1 = array();


  
  while ($row1 = mysqli_fetch_array($sql1)){
    $cpf = $row1["cpf"];
  }  
  
    $sql2 = $dbcon->query("SELECT * FROM ingresso WHERE cpf_cliente='$cpf' ORDER BY codigo_sessao DESC");
    
if(mysqli_num_rows($sql2) > 0){    
    
    $response1["lista_ingressos"] = array();
    
    while ($row2 = mysqli_fetch_array($sql2)){
        
        $codigo_sessao = $row2["codigo_sessao"];   
	    $codigo_cadeira  = $row2["codigo_cadeira"];        

        $lista_ingressos = array();
                
        $lista_ingressos["codigo_ingresso"] = $row2["codigo_ingresso"];
        $lista_ingressos["qrcode_ingresso"] = $row2["qrcode_ingresso"];
        $lista_ingressos["cpf_cliente"]     = $row2["cpf_cliente"];
        
        $sql3 = $dbcon->query("SELECT * FROM cadeira WHERE codigo_cadeira='$codigo_cadeira'");    
        while ($row3 = mysqli_fetch_array($sql3)){
            $lista_ingressos["nome_cadeira"]  = $row3["nome_cadeira"];
        }
        
        $sql4 = $dbcon->query("SELECT * FROM sessao WHERE codigo_sessao='$codigo_sessao' ORDER BY data_sessao DESC");    
        while ($row4 = mysqli_fetch_array($sql4)){
            $codigo_filme = $row4["codigo_filme"]; 
            $codigo_sala  = $row4["codigo_sala"];
            $data = explode("-", $row4["data_sessao"]);
            $data = $data[2].'-'.$data[1].'-'.$data[0];
            $lista_ingressos["data_sessao"] = $data;
            $lista_ingressos["horario_sessao"]  = $row4["horario_sessao"];
        }    
            
        $sql5 = $dbcon->query("SELECT * FROM sala WHERE codigo_sala='$codigo_sala'");    
        while ($row5 = mysqli_fetch_array($sql5)){
                $lista_ingressos["codigo_sala"]  = $row5["codigo_sala"];
                $lista_ingressos["tipo_sala"]  = $row5["tipo_sala"];
        }
            
        $sql6 = $dbcon->query("SELECT * FROM filmes WHERE codigo_filme='$codigo_filme'");
        while ($row6 = mysqli_fetch_array($sql6)){
                $lista_ingressos["nome_filme"]  = $row6["nome_filme"];
        }
        
            
        array_push($response1["lista_ingressos"], $lista_ingressos);

    }
  
  echo json_encode($response1);
  
  
}else {
   $response1["sem_ingresso"] = "sem_ingresso"; 
   echo json_encode($response1);
   
}  



?>