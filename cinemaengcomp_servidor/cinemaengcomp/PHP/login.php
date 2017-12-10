<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

  include_once 'conexao.php';
  
  $email=$_POST['email'];
  $senha=$_POST['senha'];

  $sql = $dbcon->query("SELECT * FROM cadastro_usuario WHERE email='$email' AND senha='$senha'");
  
  if(mysqli_num_rows($sql) > 0) {
    
    $linha = mysqli_fetch_assoc($sql);
    
    if ($linha['funcionario_qrcode'] <> 0){
      echo "login_funcionario";
    }else{
      echo "login_cliente";
    }
    
   // echo "login_ok";
  }else {
    echo "login_erro";
  }

?>