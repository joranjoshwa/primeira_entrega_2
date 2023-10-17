<?php

    function login($dados)
    {
        include 'conectorBD.php';
        //session_start();
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
                $chave = executarQuery("SELECT id FROM instituicoes WHERE CNPJ = $id;", $retorno=true)[0]['id'];//<-isso
                $_SESSION['user'] = [true, $chave]; 
                return true;
            }
        }
        return false;
    }

    function registrar($dados, $img){
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

                $userID = executarQuery('SELECT max(id) FROM instituicoes', $retorno=true)[0]['max(id)'];
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

                $userID = executarQuery('SELECT max(id) FROM agricultores', $retorno=true)[0]['max(id)'];
            }
        }

        if (isset($userID))
        {
            $ext = pathinfo($img['profilePic']['name'], PATHINFO_EXTENSION);
            //tirar esse dashboard
            $fileName = "C:/xampp/htdocs/dashboard/primeira_entrega_2/storage/profilePictures/$tipo/$userID.$ext";
            if(!move_uploaded_file($img['profilePic']['tmp_name'], $fileName))
            {
                echo 'erro no envio dos arquivos';
            }

            return true;
        }

        return false;
    }

    function atualizar($dados, $img)
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
            WHERE `$tabela`.`id` = ".$_SESSION['user'][1];
        }

        executarQuery($updateSQL);
        return true;
    }

    function armazenarDocumentos($dados, $files)
    {
        include 'conectorBD.php';
        include 'dir.php';//mudei
        extract($dados);
        
        if (!$nome) $nome = pathinfo($files['documento']['name'], PATHINFO_FILENAME);

        $ext = pathinfo($files['documento']['name'], PATHINFO_EXTENSION);
        
        executarQuery("INSERT INTO `arquivos`(`id`, `nome`, `agricultores_id`) 
        VALUES (
            NULL,
            '$nome',
            '".$_SESSION['user'][1]."')"
        );

        $fileID = executarQuery('SELECT max(id) FROM arquivos', $retorno=true)[0]['max(id)'];

        $filename = $_SESSION['user'][1]."-$fileID-$nome.$ext";
        
        $directory = $dir.'storage/documentos/';
        $upload = $directory.$filename;
        echo $upload;

        if(!move_uploaded_file($files['documento']['tmp_name'], $upload))//criar nome com o id do arquivo e do agricultor
        {
            echo 'erro no envio dos arquivos';
        }

    }

    function citarOfertas($produtos)
    {
        include 'conectorBD.php';
        executarQuery('DELETE FROM ofertas where agricultores_id ='.$_SESSION['user'][1]);
        
        if($produtos != [])
        {
            $insertSQL = "INSERT INTO ofertas (produtos_id, agricultores_id) VALUES";
            foreach ($produtos as $indice => $valor) 
            {
                $produtos_id = executarQuery("SELECT id from produtos WHERE nome = '$valor'", $retorno=true)[0]['id'];
                $insertSQL = $insertSQL."('$produtos_id','".$_SESSION['user'][1]."'),";
            }
            $insertSQL = rtrim($insertSQL, ",");
            $insertSQL = $insertSQL.";";
            executarQuery($insertSQL);
        }
    }

    function criarEditais($dados)
    {
        include 'util.php';
        extract($dados);

        executarQuery("INSERT INTO 
        `editais`(`titulo`, `instituicoes_id`, `descricao`, `dataIni`, `dataFim`, `link`) 
        VALUES (
            '$nome',
            '".$_SESSION['user'][1]."',
            '$descricao',
            '$dataIni',
            '$dataFim',
            '$link')");

        $editaisID = executarQuery('SELECT max(id) FROM editais', $retorno=true)[0]['max(id)'];
        
        foreach ($demandas as $indice => $nome) 
        {
            $produtosID = converterChave($nome, 'produtos', $getValor=false);
            executarQuery("INSERT INTO `demandas`(`editais_id`, `produtos_id`) 
            VALUES (
            '$editaisID',
            '$produtosID')");
        }

        foreach ($documentos as $indice => $documento) 
        {
            $documentosID = converterChave($documento, 'documentos', $getValor=false);
            executarQuery("INSERT INTO `requisitos`(`documentos_id`, `editais_id`) 
            VALUES (
            '$documentosID',
            '$editaisID')");
        }
    }
?>