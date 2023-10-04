<?php

    function login($dados)
    {
        include 'conectorBD.php';
        session_start();
        extract($dados);

        if (strlen($id)==11)
        {
            if(!$queryResult=executarQuery("SELECT senha from agricultores WHERE CPF = '$id'", $retorno=true)[0]['senha']) return false;
            if($queryResult == "".$senha) return true;

        }
        
        if (strlen($id)==14)
        {
            if(!$queryResult=executarQuery("SELECT senha from instituicoes WHERE CNPJ = '$id'", $retorno=true)[0]['senha']) return false;
            
            if($queryResult == "".$senha) 
            {
                $_SESSION['user'] = [true, $id]; 
                return true;
            }
        }
        return false;
    }

    function registrar($dados){
        include 'util.php';

        extract($dados);

        $localidadeFK = converterChave($localidade, 'localidades', $getValor=false);
        if ($tipo == 'insti')
        {
            if (!executarQuery("SELECT CNPJ from instituicoes WHERE CNPJ = '$cnpj'", $retorno=1))
            {
                executarQuery("INSERT INTO `instituicoes` (`id`, `nome`, `CNPJ`, `email`, `senha`, `localidades_id`) 
                VALUES (
                    NULL, 
                    '$nome', 
                    '$cnpj', 
                    '$email', 
                    '$senha', 
                    $localidadeFK
                );");

                return true;
            } 
        }
        else if ($tipo == 'agro')
        {
            if (!executarQuery("SELECT CPF from agricultores WHERE CPF = $cpf", $retorno=1))
            {
                executarQuery("INSERT INTO `agricultores` (`id`, `nome`, `CAF`, `CPF`, `senha`, `telefone`, `email`, `localidades_id`) 
                VALUES (
                    NULL, 
                    '$nome', 
                    '$caf', 
                    '$cpf', 
                    '$senha', 
                    '$telefone', 
                    '$email', 
                    '$localidadeFK');");

                return true;
            }
        }

        return false;
    }

    function atualizar($dados)
    {
        extract($dados);
        session_start();
        include 'conectorBD.php';

        if ($tipo == 'agro')
        {
            executarQuery("DELETE FROM `agricultores` WHERE `agricultores`.`id` = ".$_SESSION['user'][1]);
            $localidadeFK = converterChave($localidade, 'localidades', $getValor=false);
            executarQuery("INSERT INTO `agricultores` (`id`, `nome`, `CAF`, `CPF`, `senha`, `telefone`, `email`, `localidades_id`) 
                VALUES (
                    NULL, 
                    '$nome', 
                    '$caf', 
                    '$cpf', 
                    '$senha', 
                    '$telefone', 
                    '$email', 
                    '$localidadeFK');");
        }
    }

?>