<?php
    session_start();
    include '../../php/util.php';

    if (!isset($_SESSION['user']))
    {
      header("Location: ../../php/logout.php");  
    }

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
    <nav>
        <span><a id='index' href="../../index.php"><img src="../../img/agrofam.svg" alt=""></a></span>
        <a href="../../pages/profile/profileInsti.php"><img src="../../storage/profilePictures/insti/<?php echo $_SESSION['user'][1]?>.jpg"></a>
    </nav>
    <?php
    if (isset($_SESSION['erro']))
    {
        echo '<div class="error">
        <div class="errorMSG">
        <span class="close" onclick="fechar()">
        <span></span>
        <span></span>
        </span>
        <p>'.$_SESSION["erro"].'</p>
        </div>
        </div>';
        unset($_SESSION['erro']);
    }
    ?>
    <main>
        <div class="card">
            <h1>Atualize seu cadastro</h1>
            <form action="../../index.php" method="post" enctype="multipart/form-data">
                <input type="text" name="nome" placeholder="Nome" value="<?php echo $nome?>" required>
                <input type="text" name="senha" placeholder="Senha" value="<?php echo $senha?>" required>
                <select name="localidade" required>
                    <option disabled>Escolha uma opção</option>
                    <?php
                        $localidades = executarQuery("SELECT nome FROM localidades;", $retorno=true);
                        $opcoes = [];
                        foreach ($localidades as $indice => $linha) 
                        {
                            array_push($opcoes, $linha['nome']);
                        }
                        
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
                
                <label for="profilePic"> Foto de Perfil</label>
                <input type="file" name="profilePic" accept=".jpg">

                <input type="hidden" name="tela" value="atualizar">
                <input type="hidden" name="tipo" value="insti"><!--será removido coma criação da sessão de logado-->
                <input type="submit" value="atualizar">
            </form>
        </div>
    </main>
    
</body>
</html>