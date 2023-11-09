<?php
    session_start();

    if (!isset($_SESSION['user']))
    {
      header("Location: ../../php/logout.php");  
    }
    
    include '../../php/util.php';

    $dados = executarQuery('SELECT `nome`, `CAF`, `CPF`, `senha`, `telefone`, `email`, `localidades_id` FROM agricultores WHERE id = "'.$_SESSION['user'][1].'";', $retorno=true)[0];
    $dados['localidade'] = converterChave($dados['localidades_id'], 'localidades')[0]['nome'];
    
    unset($dados['localidades_id']);
    extract($dados);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css?v=1">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <title>AgroFam+</title>
</head>
<body> 
    <nav>
        <span><a href="../../index.php" id="index"><img src="../../img/agrofam.svg"></a></span>
        <a href="../../pages/profile/profileAgro.php"><img src="../../storage/profilePictures/agro/<?php echo $_SESSION['user'][1]?>.jpg" alt=''></a>
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
            <div class="overflow">
                
                <form action="../../index.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="nome" placeholder="Nome" value="<?php echo $nome?>" required>
                    <input type="password" name="senha" placeholder="Senha" value="<?php echo $senha?>" required>
                    <input type="number" name="cpf" placeholder="CPF" value="<?php echo $CPF?>" required>
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
                    <input type="number" name="caf" placeholder="CAF" value="<?php echo $CAF?>" required>
                    
                    <input type="text" name="telefone" value="<?php echo $telefone?>" placeholder="XX 9XXXX-XXXX" required pattern="[0-9]{2}.{1}9[0-9]{4}-[0-9]{4}">
                    <input type="email" name="email" placeholder="agricultor@agrofam.com" value="<?php echo $email?>" required>
                    
                    <!--<input type="number" name="telefone" placeholder="Telefone" value="< ?php echo $telefone?>" required>
                    <input type="email" name="email" placeholder="E-mail" value="< ?php echo $email?>" required>-->
    
                    <label for="profilePic"> Foto de Perfil</label>
                    <input type="file" name="profilePic" accept=".jpg">
    
                    <input type="hidden" name="tela" value="atualizar">
                    <input type="hidden" name="tipo" value="agro">
                    <input type="submit" value="Atualizar">
                </form>
            </div>
        </div>
    </main>
    
</body>
</html>