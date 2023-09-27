<?php

include "credenciais.php"

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$banco = new mysqli($host, $user, $password, $bd);

function executarQuery($multi = False, $retorno = False, $query){

    if ($multi)
    {
        if(!$banco->multi_query($consulta))
        {
            print_r($result);
            $banco->error;
        }

    }

    else if(!$result=$banco->query($consulta))
    {
        print_r($result);
        $banco->error;

        if ($retorno)
        {
            do
            {
                if($result = $banco->store_result())
                {
                    while($linha = $result->fetch_row())
                    {
                        array_push($dados, $linha[0]);
                    }
                }
            }
            while($banco->next_result())
        }

    }

}
?>