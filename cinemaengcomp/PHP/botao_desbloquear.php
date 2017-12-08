<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

include_once 'conexao.php';

$codigo_ingresso = $_POST['codigo_ingresso'];

$sql = $dbcon->query("SELECT * FROM ingresso WHERE codigo_ingresso='$codigo_ingresso'");

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
                $horario_sessao = $row2["horario_sessao"];
                
                $data_hora_sessao = new DateTime($data_sessao . ' ' . $horario_sessao);
                
                $data_hora_intervalo_sessao = new DateTime($data_sessao . ' ' . $horario_sessao);
                $data_hora_intervalo_sessao->sub(new DateInterval('PT15M'));
                $data_hora_intervalo_sessao = $data_hora_intervalo_sessao->format('Y-m-d H:i:s');
                
                $sql4 = $dbcon->query("SELECT * FROM filmes WHERE codigo_filme='$codigo_filme'");
                
                if (mysqli_num_rows($sql4) > 0) {
                    
                    while ($row4 = mysqli_fetch_array($sql4)) {
                        $duracao_filme_minutos  = $row4["duracao_filme"];
                    }
                    
                }
                
               
                $data_hora_final_sessao = new DateTime($data_sessao . ' ' . $horario_sessao);
                $data_hora_final_sessao->add(new DateInterval('PT' . $duracao_filme_minutos . 'M'));
                $data_hora_final_sessao = $data_hora_final_sessao->format('Y-m-d H:i:s');
                
                
                //aplicando funcao de data/hora devido diferenca de 3 horas do servidor                
                $data_hora_atual = new DateTime("now", new DateTimeZone('America/Sao_Paulo'));
                $data_hora_atual = $data_hora_atual->format('Y-m-d H:i:s');
                
                
                if ($data_hora_atual > $data_hora_final_sessao) {
                    
                    echo "Sessão encerrada!";
                    
                } elseif ($data_hora_atual < $data_hora_intervalo_sessao) {
                    
                    echo "Sessão não iniciada!";
                    
                } else {
                    
                    
                    $sql5 = $dbcon->query("SELECT * FROM cadeira WHERE codigo_cadeira='$codigo_cadeira'");
                    
                    if (mysqli_num_rows($sql5) > 0) {
                                         
                    
                        while ($row5 = mysqli_fetch_array($sql5)) {
                          $status_cadeira = $row5["status_cadeira"];
                        
                          if( $status_cadeira == '2'){
                        
                            $sql3 = $dbcon->query("UPDATE cadeira SET status_cadeira= '1' WHERE codigo_cadeira=$codigo_cadeira");
                            
                            echo "Desbloqueando poltrona...";
                          }else if ($status_cadeira == '0'){
                            echo "Desbloqueio recusado!";
                          }else{
                             echo "Poltrona desbloqueada!";
                          }
                        }
                        
                    }
                    
                }
                
            }
            
        } else {
            
            echo "Sessão nao encontrada!";
            
            
        }
    }
    
} else {
    
    echo "erro_busca_ingresso";
    
}

?>