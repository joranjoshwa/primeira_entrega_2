<?php
session_start();
include '../../php/conectorBD.php';

if (!isset($_SESSION['user']))
{
    header("Location: ../../php/logout.php");  
}

$result = executarQuery('SELECT nome, subtipos_id FROM produtos ORDER BY subtipos_id', $retorno=true);
foreach ($result as $chave => $valor) 
{
    if (!isset($produtos[$valor['subtipos_id']]))
    {
        $produtos[$valor['subtipos_id']] = [];
    }
    array_push($produtos[$valor['subtipos_id']], $valor['nome']);
}

$result = executarQuery('SELECT nome From documentos',$retorno=true);
$documentos = [];
foreach ($result as $indice => $documento) 
{
    array_push($documentos, $documento['nome']);    
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/criarEditais.css?v=8">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <title>AgroFam+</title>
</head>

<body>
    <nav>
        <span><a id='index' href="../../index.php"><img src="../../img/agrofam.svg"></a></span>
        <a href="../../pages/profile/profileInsti.php"><img src="../../storage/profilePictures/insti/<?php echo $_SESSION['user'][1]?>.jpg"></a>
    </nav>
    <main>
        <div class="card">
            <h1>Adicionar edital</h1>

            <form action="../../index.php" method="post">
                <label for="nome">Insira o título do edital:</label>
                <input type="text" name="nome" id="nome" placeholder="Título" required>

                <label for="dataIni">Data do início do período de inscrição:</label>
                <input type="date" name="dataIni" id="dataIni" required>

                <label for="dataFim">Data do fim do período de inscrição:</label>
                <input type="date" name="dataFim" id="dataFim" required>

                <label for="link">Link do edital:</label>
                <input type="URL" name="link" id="link" placeholder="Cole o link do edital" required>

                <label for="descricao">Descrição:</label>
                <textarea name="descricao" maxlength="240" id="descricao" placeholder="Uma breve descrição do edital"
                    required></textarea>

                <label for="docs">Documentos requisitados:</label>
                <span class="docs" id="docs">
                    <?php
                    foreach ($documentos as $indice => $nome) 
                    {
                        echo "<span>
                        <input type='checkbox' name='documentos[]' value='$nome'>
                        <label for='cpf'>$nome</label>
                        </span>";
                    }
                    ?>
                </span>

                <h2>Escolha os itens para a demanda:</h2>
                <?php
                foreach ($produtos as $subtipo => $produto) 
                {
                    echo '<span class="demandas">';
                    $subtipo = executarQuery("SELECT nome FROM subtipos WHERE id='$subtipo'", $retorno=true)[0]['nome'];
                    echo "<span class='subtipo'>$subtipo</span>";
                    echo '<div class="vertical">';

                    foreach ($produto as $indice => $nome) {
                        echo '<span class="itens">';
                        echo "<span class='nomeDemanda'>$nome</span>
                        <span class='checkbox'><input type='checkbox' name='demandas[]' value='$nome'></span>";
                        echo '</span>';//itens
                    }
                    
                    echo '</div>';//vertical
                    echo '</span>';//demandas
                }
                ?>

                <input type="hidden" name="tela" value="editais">
                <input type="submit" value="criar">
            </form>
        </div>
    </main>
</body>

</html>