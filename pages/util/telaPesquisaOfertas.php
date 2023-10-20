
<?php
    session_start();
    if (!isset($_SESSION['user']))
    {
      header("Location: ../../php/logout.php");  
    }
    
    include '../../php/conectorBD.php';

    $result = executarQuery('SELECT nome FROM localidades', $retorno=true);
    $localidades =[];
    foreach ($result as $indice => $nome) 
    {
        array_push($localidades, $nome['nome']);
    }

    $result = executarQuery('SELECT nome FROM produtos', $retorno=true);
    $produtos = [];
    foreach ($result as $indice => $nome) 
    {
        array_push($produtos, $nome['nome']);
    }

    //
    if(isset($_POST['pesquisar']))
    {   
        if(!isset($_POST['produtos']) && !isset(($_POST['regiao'])))
        {
            $ofertas = executarQuery("SELECT * FROM ofertas", $retorno=true);  
        }
        
        extract($_POST);

        if (isset($regiao))
        {
            $local = executarQuery("SELECT id FROM localidades WHERE nome = '$regiao';", $retorno=true)[0]['id'];
            $ofertas = executarQuery("call selecionarOfertasRegiao('$local')", $retorno=true);
        }

        if (isset($produto))
        {
            if (isset($ofertas))
            {
                $id = [];
                foreach ($ofertas as $indice => $valores) 
                {
                    array_push($id, $valores['id']);
                }
                $aux = [];
                $result = executarQuery("call selecionarOfertasProduto('$produto')", $retorno=true);
                foreach ($result as $indice => $valores) 
                {
                    if (in_array($valores['id'], $id))
                    {
                        array_push($aux, $valores);
                    }
                }
                $ofertas = $aux;
            }
            else
            {
                $ofertas = executarQuery("call selecionarOfertasProduto('$produto')", $retorno=true);
            }
        }
    }
    else
    {
        $ofertas = executarQuery("SELECT * FROM ofertas", $retorno=true);
    }
    //

    $produtosOfertados = [];
    $contatoAgro = [];
    foreach ($ofertas as $indice => $oferta) 
    {
        extract($oferta);
        $aux = executarQuery("SELECT nome FROM produtos WHERE id=$produtos_id", $retorno=true)[0]['nome'];
        array_push($produtosOfertados, $aux);

        $aux = executarQuery("SELECT nome, email, telefone FROM agricultores WHERE id=$agricultores_id", $retorno=true)[0];
        array_push($contatoAgro, $aux);
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/telaPesquisa.css">
    <title>AgroFam+</title>

    <style>
        .contato{
            width:40%;
        }

    </style>
</head>
<body>
    <nav>
        <span><a id="index" href="../../index.php"><img src="../../img/agrofam.svg"></a></span>
        <a href="../profile/profileInsti.php"><img src="../../storage/profilePictures/<?php echo $_SESSION['user'][2]."/".$_SESSION['user'][1]?>.jpg"></a>
    </nav>
    <main>
        <form action="./telaPesquisaOfertas.php" method="post">
            <select name="regiao">
                <option selected disabled>Escolha uma opção de região</option>
                <?php
                foreach ($localidades as $indice => $nome) {
                    echo "<option value='$nome'>$nome</option>";
                }
                ?>
            </select>
            <select name="produto">
                <option selected disabled>Escolha uma opção de produto</option>
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
            <div class="periodo">Produtor(a)</div>
            <div class="contato">Conato</div>
        </div>

        <?php
            foreach ($produtosOfertados as $indice => $produto) 
            {
                extract($contatoAgro[$indice]);
                echo "<div class='editais'>
                <span class='nome'>$produto</span>
                <div class='data periodo'>$nome</div>
                <span class='submit'>
                    $email / $telefone   
                </span>
                </div>";
            }
        ?>
    </main>
</body>
</html>