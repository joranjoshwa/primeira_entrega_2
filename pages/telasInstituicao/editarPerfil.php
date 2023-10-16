<?php
    session_start();
    include '../../php/util.php';

    $dados = executarQuery('SELECT `nome`, `CNPJ`, `senha`, `email`, `localidades_id` FROM instituicoes WHERE id = "'.$_SESSION['user'][1].'";', $retorno=true)[0];
    $dados['localidade'] = converterChave($dados['localidades_id'], 'localidades')[0]['nome'];
    
    unset($dados['localidades_id']);
    extract($dados);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <title>AgroFam+</title>
</head>
<body> 
    <main>
        <div class="card">
            <h1>Atualize seu cadastro</h1>
            <form action="../../index.php" method="post">
                <input type="text" name="nome" placeholder="Nome" value="<?php echo $nome?>" required>
                <input type="text" name="senha" placeholder="Senha" value="<?php echo $senha?>" required>
                <select name="localidade" required>
                    <option disabled>Escolha uma opção</option>
                    <?php
                        $opcoes = ['Eunápolis', 'Salto da Divisa', 'Porto Seguro'];
                        foreach ($opcoes as $indice => $valor) 
                        {
                            if ($valor == $localidade)
                            {
                                echo "<option value='$valor' selected>$valor</option>";
                            }
                            else
                            {
                                echo "<option value='$valor'>$valor</option>";
                            }
                        }
                    ?>
                </select>
                <input type="number" name="cnpj" placeholder="CNPJ" value="<?php echo $CNPJ?>" required>
                <input type="email" name="email" placeholder="instituicao@agrofam.com" value="<?php echo $email?>" required>
                
                <input type="hidden" name="MAX_FILE_SIZE" value="500000">
                <label for="profilePic"> Foto de Perfil</label>
                <input type="file" name="profilePic" accept=".jpeg .jpg .png">

                <input type="hidden" name="tela" value="atualizar">
                <input type="hidden" name="tipo" value="insti"><!--será removido coma criação da sessão de logado-->
                <input type="submit" value="atualizar">
            </form>
        </div>
    </main>
    
</body>
</html>