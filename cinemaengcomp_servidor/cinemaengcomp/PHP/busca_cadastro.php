<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

include_once 'conexao.php';


$email = $_POST['email'];

$sql1 = $dbcon->query("SELECT * FROM cadastro_usuario WHERE email='$email'" );

$response1 = array();


if(mysqli_num_rows($sql1) > 0){


  $response1["dadosconta"] = array();
  

  
  while ($row1 = mysqli_fetch_array($sql1)){
    
    $cadastro = array();
    $cadastro["nome"]          = $row1["nome"];
    $cadastro["cpf"]         = $row1["cpf"];
    $data = explode("-", $row1["dat_nascimento"]);
    $data = $data[2].'-'.$data[1].'-'.$data[0];
    $cadastro["dat_nascimento"]          = $data;
    $cadastro["sexo"]         = $row1["sexo"];	
    $cadastro["endereco"]         = $row1["endereco"];
    $cadastro["numero"]         = $row1["numero"];
    $cadastro["bairro"]         = $row1["bairro"];
    $cadastro["cep"]         = $row1["cep"];
    $cadastro["cidade"]         = $row1["cidade"];
    $cadastro["uf"]         = $row1["uf"];
    $cadastro["email"]         = $row1["email"];
   
    array_push($response1["dadosconta"], $cadastro);
    
  }
  
  //echoing JSON reponse
  echo json_encode($response1);
  
  
}else {

   echo 'sem_cadastro';
   
}  


?>