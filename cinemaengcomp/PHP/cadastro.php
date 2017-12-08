<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

include_once 'conexao.php';

$nome           = $_POST['nome'];
$cpf            = $_POST['cpf'];
$dat_nascimento = $_POST['datnascimento'];
$sexo           = $_POST['sexo'];
$endereco       = $_POST['endereco'];
$numero         = $_POST['numero'];
$bairro         = $_POST['bairro'];
$cidade         = $_POST['cidade'];
$uf             = $_POST['uf'];
$cep            = $_POST['cep'];
$email          = $_POST['email'];
$senha          = $_POST['senha'];
$confirma_senha = $_POST['confirmasenha'];


$sql1 = $dbcon->query("SELECT * FROM cadastro_usuario WHERE email='$email'");
$sql2 = $dbcon->query("SELECT * FROM cadastro_usuario WHERE cpf='$cpf'");


if(mysqli_num_rows($sql1) > 0){
  echo "email_erro";

  
} elseif (mysqli_num_rows($sql2) > 0){
  echo "cpf_erro";
  
} else {
  
    $sql3 = $dbcon->query("INSERT INTO cadastro_usuario(nome,cpf,dat_nascimento,sexo,endereco,numero,bairro,cidade,uf,cep,email,senha,confirma_senha) 
                           VALUES('$nome','$cpf','$dat_nascimento','$sexo','$endereco','$numero','$bairro','$cidade','$uf','$cep','$email','$senha','$confirma_senha')");
        
    
    if($sql3){
      echo "cadastro_ok";
    }else {
      echo "cadastro_erro";
    }

}

?>