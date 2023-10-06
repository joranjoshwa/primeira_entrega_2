<?php

    include 'conectorBD.php';
    function converterChave($chave, $tabela, $getValor=true)
    {
        
        if ($getValor)
        {
            return executarQuery("SELECT * FROM $tabela WHERE id = $chave", $retorno=true);
        }
        else
        {   
            return executarQuery("SELECT id from $tabela WHERE nome = '$chave';", $retorno=true)[0]['id'];
        }
    }
?>