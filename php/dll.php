<?php

    function login($dados)
    {
        include 'conectorBD.php';
        session_start();
        extract($dados);

        if (strlen($id)==11)
        {
            if(!$queryResult=executarQuery("SELECT senha FROM agricultores WHERE CPF = '$id'", $retorno=true)[0]['senha']) return false;
            if($queryResult == "".$senha)
            {
                $chave = executarQuery("SELECT id FROM agricultores WHERE CPF = $id;", $retorno=true)[0]['id'];//<-isso
                $_SESSION['user'] = [true, $chave]; 
                return true;
            }

        }
        
        if (strlen($id)==14)
        {
            if(!$queryResult=executarQuery("SELECT senha from instituicoes WHERE CNPJ = '$id'", $retorno=true)[0]['senha']) return false;
            
            if($queryResult == "".$senha) 
            {
                $chave = executarQuery("SELECT id FROM agricultores WHERE CPF = $id;", $retorno=true);//<-isso
                $_SESSION['user'] = [true, $chave]; 
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
        }
        else
        {
            $tabela = 'instituicoes';
        }
        
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
            WHERE `$tabela`.`id` = "$_SESSION['user'][1];
        }

        executarQuery($updateSQL);
        return true;
    }

    function armazenarDocumentos($dados, $files)
    {
        include 'conectorBD.php';
        
        $filename = ;
        $dir = 'C:/xampp/htdocs/dashboard/primeira_entrega_2/storage/documentos/';
        $upload = $dir.basename($files['documento']['name']);

        if(!move_uploaded_file($files['documento']['tmp_name'], $upload))//criar nome com o id do arquivo e do agricultor
        {
            echo 'erro no envio dos arquivos';
        }
    }

?>