<?php
    include 'conectorBD.php';

    function converterChave($chave, $tabela, $modo=1)
    {
        if ($modo)
        {
            $valorChave = executarQuery("SELECT * FROM $tabela WHERE id == $chave", $retorno=1);
        }
        else
        {
            $idChave = executarQuery("SELECT id from $tabela WHERE id == $chave;", $retorno=1);
        }
    }
?>