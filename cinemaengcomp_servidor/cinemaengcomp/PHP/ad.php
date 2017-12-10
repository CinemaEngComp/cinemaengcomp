<?php

//Barbara Monique Schumacher        RA:20423474
//Natalia Fernanda Milani de Moraes RA:20399454
//Rodrigo Cruz do Nascimento        RA:20391100
//Vinicius Araujo dos Santos        RA:20390456
//Willian Moraes do Nascimento      RA:20397664

include_once 'conexao.php';

 echo   "vvv";

$sql = "SELECT * FROM cadeira";
$result = $dbcon->query($sql);

if ($result->num_rows >= 1) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       
         if(  $row["status_cadeira"]  == '0'){

           echo  $row["nome_cadeira"]. "x,";  
          }
       
        if(  $row["status_cadeira"]  == '1'){

            echo  $row["nome_cadeira"]. "y,";}  
               
       

         
    }

        

} else

 {
    echo "fail";
}

$dbcon->close();

?>


