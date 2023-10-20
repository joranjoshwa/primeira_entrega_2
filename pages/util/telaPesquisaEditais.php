<?php
    session_start();
    if (!isset($_SESSION['user']))
    {
      header("Location: ../../php/logout.php");  
    }
    
    include '../../php/util.php';

    $result = executarQuery('SELECT nome FROM localidades', $retorno=true);
    $localidades =[];
    foreach ($result as $indice => $nome) 
    {
        array_push($localidades, $nome['nome']);
    }

    $result = executarQuery('SELECT nome FROM produtos', $retorno=true);
    $produtos =[];
    foreach ($result as $indice => $nome) 
    {
        array_push($produtos, $nome['nome']);
    }

    if (isset($_POST['pesquisar']))
    {
        if(!isset($_POST['produtos']) && !isset(($_POST['regiao'])))
        {
            $editais = executarQuery("SELECT * FROM editais", $retorno=true);  
        }
        
        extract($_POST);

        if(isset($regiao))
        {
            
            $editais = executarQuery("call selecionarEditaisLocalidade('$regiao')", $retorno=true);
        }

        if (isset($produto))
        {
            if (isset($editais))
            {
                $result = executarQuery("call selecionarEditaisProdutos('$produto');", $retorno=true);
                $id = [];
                foreach ($result as $indice => $valores) {
                    array_push($id, $valores['id']);
                }

                $aux = [];
                foreach ($editais as $indice => $valor) 
                {
                    if (in_array($valor['id'], $id))
                    {
                        array_push($aux, $valor);
                    }
                }

                $editais = $aux;
            }
            else
            {
                $editais = executarQuery("call selecionarEditaisProdutos('$produto');", $retorno=true);
            }
        }
    }
    else
    {
        $editais = executarQuery('SELECT id, titulo, dataIni, dataFim FROM editais', $retorno=true);
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css?v=2">
    <link rel="stylesheet" href="../../css/telaPesquisa.css?v=2">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">

    <title>AgroFam+</title>
</head>

<body>
    <nav>
        <span><a id="index" href="../../index.php"><img src="../../img/agrofam.svg"></a></span>
        <a href="../../pages/profile/profile<?php echo $_SESSION['user'][2]?>.php"><img src="../../storage/profilePictures/<?php echo $_SESSION['user'][2]."/".$_SESSION['user'][1]?>.jpg"></a>
    </nav>
    <main>
        <form action="./telaPesquisaEditais.php" method="POST">
            <select name="regiao">
                <option disabled selected>Selecione uma região</option>
                <?php
                foreach ($localidades as $indice => $nome) {
                    echo "<option value='$nome'>$nome</option>";
                }
                ?>
            </select>
            <select name="produto">
                <option disabled selected>Selecione um produto</option>
                <?php
                foreach ($produtos as $indice => $nome) {
                    echo "<option value='$nome'>$nome</option>";
                }
                ?>
            </select>
            <input type="submit" value="pesquisar" name="pesquisar">
        </form>

        <div class="header">
            <div class="nome">Título</div>
            <div class="periodo">Período</div>
        </div>
        <?php
        foreach ($editais as $indice => $valores) 
        {
            extract($valores);
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
    </main>
</body>

</html>