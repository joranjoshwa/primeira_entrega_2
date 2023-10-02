<?php

function executarQuery($consulta, $retorno = 0, $multi = 0){

    include "credenciais.php";
    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $banco = new mysqli($host, $user, $password, $bd);

    if ($multi){
        $banco->multi_query($consulta);
        if ($retorno){
            $dados =[];
            do{ 
                if($result = $banco->store_result()){
                    while($linha = $result->fetch_row()){
                        array_push($dados, $linha[0]);
                    }
                }
            }while($banco->next_result());
            return $dados;
        }
        
    }
    
    if(!$result=$banco->query($consulta)){
        print_r($result);
        $banco->error;
    }

    if($retorno){
        $dados = [];
        while ($linha = $result -> fetch_assoc()){
            array_push($dados, $linha);
        }
        return $dados;
    }

}

?>