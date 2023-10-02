<?php

    function converterChave($chave, $tabela, $getValor=true)
    {
        include 'conectorBD.php';
        
        if ($getValor)
        {
            return executarQuery("SELECT * FROM $tabela WHERE id = '$chave'", $retorno=1)[0];
        }
        else
        {
            return executarQuery("SELECT id from $tabela WHERE nome = '$chave';", $retorno=1)[0]['id'];
        }
    }
?>