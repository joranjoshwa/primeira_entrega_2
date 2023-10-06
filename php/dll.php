<?php

    function login($dados)
    {
        include 'conectorBD.php';
        session_start();
        extract($dados);

        if (strlen($id)==11)
        {
            if(!$queryResult=executarQuery("SELECT senha from agricultores WHERE CPF = '$id'", $retorno=true)[0]['senha']) return false;
            if($queryResult == "".$senha)
            {
                $_SESSION['user'] = [true, $id]; 
                return true;
            }

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
        include 'util.php';
        
        if ($dados['tipo'] == 'agro')
        {
           $tabela = 'agricultores';
           $selectSQL = "SELECT id FROM agricultores WHERE CPF = '".$_SESSION['user'][1]."';";
        }
        else
        {
            $tabela = 'instituicoes';
            $selectSQL = 'SELECT id FROM instituicoes WHERE CNPJ = "'.$_SESSION['user'][1].'"';
        }

        $queryResult = executarQuery($selectSQL, $retorno=true)[0];
        $id = $queryResult['id'];
        
        $dados['localidade'] = converterChave($dados['localidade'], 'localidades', $getValor=false);

        extract($dados);
        if ($tipo == 'agro')
        {
            $updateSQL = "UPDATE `$tabela` 
            SET 
            `nome` = '$nome', 
            `CPF` = '$cpf',
            `CAF` = '$caf',
            `senha` = '$senha',
            `telefone` = '$telefone',
            `email` = '$email',
            `localidades_id` = $localidade
            WHERE `$tabela`.`id` = $id";
        }
        else
        {
            $updateSQL = "UPDATE `$tabela` 
            SET 
            `nome` = '$nome', 
            `CNPJ` = '$cnpj',
            `senha` = '$senha',
            `email` = '$email',
            `localidades_id` = '$localidade'
            WHERE `$tabela`.`id` = $id";
        }

        if(!executarQuery($updateSQL)) return false;
        return true;
    }

?>