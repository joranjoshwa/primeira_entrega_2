<?php
    include '../../php/conectorBD.php';
    session_start();

    $result=executarQuery('SELECT nome, subtipos_id FROM produtos ORDER BY subtipos_id', $retorno=true);
    foreach ($result as $chave => $valor) 
    {
        if (!isset($produtos[$valor['subtipos_id']]))
        {
            $produtos[$valor['subtipos_id']] = [];
        }
        array_push($produtos[$valor['subtipos_id']], $valor['nome']);
    }

    $produtosID = executarQuery('SELECT produtos_id FROM ofertas WHERE agricultores_id ='.$_SESSION['user'][1], $retorno=true);
    $ofertasAnteriores = [];
    foreach ($produtosID as $indice => $valor) {
        array_push($ofertasAnteriores, executarQuery("SELECT nome FROM produtos WHERE id = ".$valor['produtos_id'], $retorno=true));
        $ofertasAnteriores[$indice] = $ofertasAnteriores[$indice][0]['nome'];
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/telaOfertas.css">

    <title>Agrofam+</title>
</head>
<body>
    <main>
        <div class="card">
            <h1>Cite a Oferta</h1>
            <form action="../../index.php" method="post">
                <div class="overflow">
                    <div class="hTabela">
                        <span>subtipo</span>
                        <span>itens</span>
                    </div>

                    <?php

                    foreach ($produtos as $chave => $valor)
                    {
                        echo '<div class="bTabela">';
                        $subtipo = executarQuery("SELECT nome FROM subtipos WHERE id='$chave'", $retorno=true)[0]['nome'];
                        echo "<div class='subtipo'>$subtipo</div>";
                        
                        $itens = "<div class='itens'>";
                        $select = "<div class='select'>";
                        foreach ($valor as $indice => $nome) 
                        {
                            if(in_array($nome, $ofertasAnteriores))
                            {
                                $select = $select."<span><input type='checkbox' name='produto[]' value='$nome' checked></span>";
                            }
                            else
                            {
                                $select = $select."<span><input type='checkbox' name='produto[]' value='$nome'></span>";
                            }
                            $itens = $itens."<span>$nome</span>";
                            
                        }
                        $itens = $itens.'</div>';
                        $select = $select.'</div>';
                        echo $itens;
                        echo $select;
                        
                        echo '</div>';
                    }

                    ?>
    
                </div>
                <input type="hidden" name="tela" value="ofertas">
                <input type="submit" value="concluído">
            </form>
        </div>
    </main>
    
</body>
</html>