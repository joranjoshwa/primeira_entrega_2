<?php
    session_start();

    include '../../php/conectorBD.php';
    $dados = executarQuery('SELECT `nome`, `CAF`, `CPF`, `senha`, `telefone`, `email`, `localidades_id` FROM agricultores WHERE CPF ='.$_SESSION['user'][1]);
    print_r($dados);
    include '../../php/util.php';
    $dados['localidade'] = converterChave("SELECT nome FROM localidades WHERE id =".$dados['localidades_id']);
    
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
                <input type="number" name="cpf" placeholder="CPF" required>
                <select name="localidade" required>
                    <option disabled>Escolha uma opção</option>
                    <?php
                        $opcoes = ['Eunápolis', 'Salto da Divisa', 'Porto Seguro'];
                        foreach ($opcoes as $indice => $valor) 
                        {
                            if ($valor == $localidade)
                            {
                                echo "<option value='$localidade' selected>$localidade</option>";
                            }
                            else
                            {
                                echo "<option value='$localidade'>$localidade</option>";
                            }
                        }
                    ?>
                </select>
                <input type="number" name="caf" placeholder="CAF" required>
                <input type="number" name="telefone" placeholder="Telefone" required>
                <input type="email" name="email" placeholder="E-mail" required>

                <input type="hidden" name="tela" value="atualizar">
                <input type="hidden" name="tipo" value="agro"><!--será removido coma criação da sessão de logado-->
                <input type="submit" value="entrar">
            </form>
        </div>
    </main>
    
</body>
</html>