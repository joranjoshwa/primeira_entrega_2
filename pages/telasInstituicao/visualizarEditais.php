<?php
    include '../../php/conectorBD.php';
    session_start();

    if (!isset($_SESSION['user']))
    {
      header("Location: ../../php/logout.php");  
    }

    $editais = executarQuery('SELECT id, titulo, dataIni, dataFim FROM editais', $retorno=true);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/visualizarEditais.css?v=7">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroFam+</title>
</head>
<body>
    <nav>
        <span><a id='index' href="../../index.php"><img src="../../img/agrofam.svg"></a></span>
        <a href="../../pages/profile/profileInsti.php"><img src="../../storage/profilePictures/insti/<?php echo $_SESSION['user'][1]?>.jpg"></a>
    </nav>
    <section>
        <h1>Seus Editais</h1>
        <a href="./criarEditais.php">Adicionar Edital</a>
        <div class="lista">
            <div class="header">
                <div class="nome">Título</div>
                <div class="periodo">Período</div>
            </div>
            <?php
            foreach ($editais as $indice => $valor) {
                extract($valor);
                $dataIni = explode('-',$dataIni);
                $dataIni = $dataIni[2].'/'.$dataIni[1].'/'.$dataIni[0];

                $dataFim = explode('-',$dataFim);
                $dataFim = $dataFim[2].'/'.$dataFim[1].'/'.$dataFim[0];

                echo "<div class='editais'>
                <span class='nome'>$titulo</span>
                <div class='data periodo'>$dataIni a $dataFim</div>
                <span class='submit'>
                <form method='post' action='../util/exibirEdital.php'>
                <input type='submit' value='visualizar'><input name='id' type='hidden' value='$id'>
                </form>
                </span>
                </div>";
            }
            ?>
        </div>
    </section>
</body>
</html>