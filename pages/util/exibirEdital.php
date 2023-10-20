<?php
    include '../../php/util.php';
    session_start();
    
    if (!isset($_SESSION['user']))
    {
      header("Location: ../../php/logout.php");  
    }

    extract($_POST);
    $edital = executarQuery("SELECT * FROM editais WHERE id =$id",$retorno=true)[0];
    extract($edital);

    $dataIni = explode('-',$dataIni);
    $dataIni = $dataIni[2].'/'.$dataIni[1].'/'.$dataIni[0];

    $dataFim = explode('-',$dataFim);
    $dataFim = $dataFim[2].'/'.$dataFim[1].'/'.$dataFim[0];

    $instituicao = executarQuery("SELECT nome FROM instituicoes WHERE id=$instituicoes_id",$retorno=true)[0]['nome'];

    $documentosID = executarQuery("SELECT documentos_id FROM requisitos WHERE editais_id = $id", $retorno=true);
    $documentos = [];
    foreach ($documentosID as $indice => $valor) 
    {
        $documento = executarQuery('SELECT nome FROM documentos WHERE id='.$valor['documentos_id'], $retorno=true)[0]['nome'];
        array_push($documentos, $documento);
    }

    $produtosID = executarQuery("SELECT produtos_id FROM demandas WHERE editais_id=$id",$retorno=true);
    $produtos = [];
    foreach ($produtosID as $indice => $valor) {
        $produto = executarQuery('SELECT nome FROM produtos WHERE id='.$valor['produtos_id'], $retorno=true)[0]['nome'];
        array_push($produtos, $produto);
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/exibirEdital.css?v=2">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <title>AgroFam+</title>
</head>

<body>
    <nav>
        <span><a id="index" href="../../index.php"><img src="../../img/agrofam.svg"></a></span>
        <a href="../../pages/profile/profile<?php echo $_SESSION['user'][2]?>.php"><img src="../../storage/profilePictures/<?php echo $_SESSION['user'][2]."/".$_SESSION['user'][1]?>.jpg"></a>
    </nav>
    <section> 
        <h1><?php echo $titulo?></h1>
        <div><i><?php echo $instituicao?></i></div>

        <label for="link">Link para o edital</label>
        <a target="_blank" href="<?php echo $link?>">Clique aqui para visualizar o edital no site da instituição.</a>

        <label for="descricao">Descrição:</label>
        <p id="descricao">
            <?php echo $descricao?>
        </p>
        
        <label for="data">Período:</label>
        <div class="data" id="data"><?php echo $dataIni." a ".$dataFim?></div>

        <label for="documentos">Documentos necessários:</label>
        <div id="documentos">
            <?php
            foreach ($documentos as $indice => $documento) {
                echo "<span>- $documento</span>";
            }
            ?>
        </div>

        <label for="demandas">Demandas deste edital: </label>
        <div id="demandas">
            <?php
            foreach ($produtos as $indice => $produto) {
                echo "<span>- $produto</span>";
            }
            ?>
        </div>
    </section>
</body>

</html>