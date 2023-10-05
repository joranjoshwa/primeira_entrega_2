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
        include 'util.php';
        session_start();
        
        if ($tipo == 'agro')
        {
           $tabela = 'agricultores';
           $selectSQL = "SELECT nome, CPF, CAF, senha, telefone, email, localidades_id FROM agricultores WHERE id = ".$_SESSION['user'][1];
        }
        else
        {
            $tabela = 'instituicoes';
            $selectSQL = 'SELECT `nome`, `CNPJ`, `email`, `senha`, `localidades_id` FROM instituicoes WHERE id = '.$_SESSION['user'][1];
        }

        $queryResult = executarQuery($selectSQL, $retorno=true)[0];
        foreach ($queryResult as $coluna => $valor) 
        {   
            $col = $coluna;
            if ($coluna == 'localidades_id')
            {
                $localidadeFK = converterChave($valor, $tabela, $getValor=false);
                $col = 'localidade';
            }
                
            if ($tipo == 'agro')
            {
                if ($coluna == 'CAF' || $coluna == 'CPF') $col = strtolower($coluna);
            }
            else
            {
                if ($coluna == 'CNPJ') $col = strtolower($coluna);
            }

            if ($valor != $dados[$col])
            {
                if ($col == 'localidade' && $localidadeFK != $valor)
                {
                    $dados[$col] = $localidadeFK;
                }
                else
                {
                    $dados[$col] = $queryResult[$coluna];
                }
            }
        }

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
            `localidades_id` = '$localidade'
            WHERE `$tabela`.`id` = ".$_SESSION['user'][1];
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
            WHERE `$tabela`.`id` = ".$_SESSION['user'][1];
        }

        executarQuery($updateSQL);
    }

?>