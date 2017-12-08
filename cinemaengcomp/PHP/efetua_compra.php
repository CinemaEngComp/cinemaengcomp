<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

include_once 'conexao.php';

$codigo_sessao         = $_POST['codigo_sessao'];
$codigos_cadeiras = $_POST['codigos_cadeiras'];
$email = $_POST['email'];
$resultado = substr($codigos_cadeiras,0,-1);
$codigos = explode(";", $resultado);
$cpf = "";
$sql2;
$codigo_ingresso;
$codigo_filme;
$nome_filme;

    $sql1 = $dbcon->query("SELECT * FROM cadastro_usuario WHERE email='$email'" );
    while ($row1 = mysqli_fetch_array($sql1)){
        $cpf = $row1["cpf"];
    }
    
    $sql4 = $dbcon->query("SELECT * FROM sessao WHERE codigo_sessao='$codigo_sessao'" );
    while ($row4 = mysqli_fetch_array($sql4)){
        $codigo_filme = $row4["codigo_filme"];
    }
        
    $sql5 = $dbcon->query("SELECT * FROM filmes WHERE codigo_filme='$codigo_filme'" );
    while ($row5 = mysqli_fetch_array($sql5)){
        $nome_filme = $row5["nome_filme"];
    }   

for ($i = 0; $i < count($codigos); $i++) {
    if (empty($codigo_sessao)==false AND empty($codigos_cadeiras)==false AND empty($cpf)==false) {
        $sql2 = $dbcon->query("INSERT INTO ingresso(codigo_cadeira,codigo_sessao,cpf_cliente) 
                             VALUES('$codigos[$i]','$codigo_sessao','$cpf')");
                           
        $sql3 = $dbcon->query("SELECT * FROM ingresso WHERE cpf_cliente='$cpf' AND codigo_sessao='$codigo_sessao' AND codigo_cadeira='$codigos[$i]'" );
        while ($row3 = mysqli_fetch_array($sql3)){
            $codigo_ingresso = $row3["codigo_ingresso"];
        }
        
        $qrcode = addslashes('{"Filme":"'.$nome_filme.'", "Ingresso":"'.$codigo_ingresso.'", "Cadeira":"'.$codigos[$i].'", "CodFilme":"'
                    .$codigo_filme.'", "Sessao":"'.$codigo_sessao.'", "CPF":"'.$cpf.'"}');
                    
        $sql6 = $dbcon->query("UPDATE ingresso SET qrcode_ingresso='$qrcode' WHERE codigo_ingresso=$codigo_ingresso");
    }
}

    if($sql2){
      echo "compra_ok";
    }else {
      echo "compra_erro";
    }

?>