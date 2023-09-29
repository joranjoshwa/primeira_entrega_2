<?php
    include 'conectorBD.php';

    function login($dados)
    {
        return;
    }

    function registrar($dados){
        extract($dados);
        if ($tipo == 'insti'){
            if (!executarQuery('SELECT * from agricultores', $retorno=1)){
                excutarQuery("INSERT INTO `instituicoes` (`id`, `nome`, `CNPJ`, `email`, `senha`, `localidades_id`) 
                VALUES (
                    NULL, 
                    $nome, 
                    $cnpj, 
                    $email, 
                    $senha, 
                    '1'
                );",
            );
            }
            
        }
    }

?>