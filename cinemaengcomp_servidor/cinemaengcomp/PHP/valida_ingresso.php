<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

include_once 'conexao.php';

$codigo_ingresso = $_POST['codigo_ingresso'];

$sql = $dbcon->query("SELECT * FROM ingresso WHERE codigo_ingresso='$codigo_ingresso'");

$response1             = array();
$response1["ingresso"] = array();
$ingresso              = array();


if (mysqli_num_rows($sql) > 0) {
    
    while ($row = mysqli_fetch_array($sql)) {
        $codigo_sessao  = $row["codigo_sessao"];
        $cpf            = $row["cpf_cliente"];
        $codigo_cadeira = $row["codigo_cadeira"];
        
        $sql2 = $dbcon->query("SELECT * FROM sessao WHERE codigo_sessao='$codigo_sessao'");
        
        if (mysqli_num_rows($sql2) > 0) {
            
            while ($row2 = mysqli_fetch_array($sql2)) {
                
                $data_sessao    = $row2["data_sessao"];
                $codigo_filme   = $row2["codigo_filme"];
                $codigo_sala    = $row2["codigo_sala"];
                $horario_sessao = $row2["horario_sessao"];
                
                $data_hora_sessao = new DateTime($data_sessao . ' ' . $horario_sessao);
                
                $data_hora_intervalo_sessao = new DateTime($data_sessao . ' ' . $horario_sessao);
                $data_hora_intervalo_sessao->sub(new DateInterval('PT15M'));
                $data_hora_intervalo_sessao = $data_hora_intervalo_sessao->format('Y-m-d H:i:s');
                
                $sql4 = $dbcon->query("SELECT * FROM filmes WHERE codigo_filme='$codigo_filme'");
                
                if (mysqli_num_rows($sql4) > 0) {
                    
                    while ($row4 = mysqli_fetch_array($sql4)) {
                        $duracao_filme_minutos  = $row4["duracao_filme"];
                        $ingresso["nome_filme"] = $row4["nome_filme"];
                    }
                    
                }
                
                $sql5 = $dbcon->query("SELECT * FROM cadeira WHERE codigo_cadeira='$codigo_cadeira'");
                if (mysqli_num_rows($sql5) > 0) {
                    
                    while ($row5 = mysqli_fetch_array($sql5)) {
                        $nome_cadeira             = $row5["nome_cadeira"];
                        $ingresso["nome_cadeira"] = $row5["nome_cadeira"];
                    }
                    
                }
                
                $sql6 = $dbcon->query("SELECT * FROM sala WHERE codigo_sala='$codigo_sala'");
                if (mysqli_num_rows($sql6) > 0) {
                    
                    while ($row6 = mysqli_fetch_array($sql6)) {
                        $tipo_sala             = $row6["tipo_sala"];
                        $ingresso["tipo_sala"] = $row6["tipo_sala"];
                    }
                    
                }
                
                
                $ingresso["codigo_ingresso"] = $row["codigo_ingresso"];
                $ingresso["horario_sessao"]  = $row2["horario_sessao"];
                $data_ordenada               = explode("-", $row2["data_sessao"]);
                $data_ordenada               = $data_ordenada[2] . '-' . $data_ordenada[1] . '-' . $data_ordenada[0];
                $ingresso["data_sessao"]     = $data_ordenada;
                $ingresso["codigo_sala"]     = $row2["codigo_sala"];
                
                $data_hora_final_sessao = new DateTime($data_sessao . ' ' . $horario_sessao);
                $data_hora_final_sessao->add(new DateInterval('PT' . $duracao_filme_minutos . 'M'));
                $data_hora_final_sessao = $data_hora_final_sessao->format('Y-m-d H:i:s');
                
                
                //aplicando funcao de data/hora devido diferenca de 3 horas do servidor                
                $data_hora_atual = new DateTime("now", new DateTimeZone('America/Sao_Paulo'));
                $data_hora_atual = $data_hora_atual->format('Y-m-d H:i:s');
                
                
                if ($data_hora_atual > $data_hora_final_sessao) {
                    
                    
                    $ingresso["status_mensagem"] = "sessao_encerrada";
                    
                    array_push($response1["ingresso"], $ingresso);
                    
                    echo json_encode($response1);
                    
                    
                } elseif ($data_hora_atual < $data_hora_intervalo_sessao) {
                    
                    $ingresso["status_mensagem"] = "sessao_nao_iniciada";
                    
                    array_push($response1["ingresso"], $ingresso);
                    
                    echo json_encode($response1);
                    
                    
                } else {
                    
                    if ($cpf == "") {
                        
                        $sql3 = $dbcon->query("UPDATE cadeira SET status_cadeira= '1' WHERE codigo_cadeira=$codigo_cadeira");
                    } else {
                        $sql3 = $dbcon->query("UPDATE cadeira SET status_cadeira= '2' WHERE codigo_cadeira=$codigo_cadeira");
                    }
                    
                    
                    $ingresso["status_mensagem"] = "ingresso_poltrona_ok";
                    
                    array_push($response1["ingresso"], $ingresso);
                    
                    echo json_encode($response1);
                    
                }
                
            }
            
        } else {
            
            $ingresso["status_mensagem"] = "sessao_invalida";
            
            array_push($response1["ingresso"], $ingresso);
            
            echo json_encode($response1);
            
        }
    }
    
} else {
    
    echo "erro_busca_ingresso";
    
}

?>