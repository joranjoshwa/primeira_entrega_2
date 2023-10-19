<?php
    session_start();
    include '../../php/conectorBD.php';
    $arquivos = executarQuery("SELECT * FROM arquivos WHERE agricultores_id = '".$_SESSION['user'][1]."';", $retorno=true);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/enviarDocs.css?v=6">

    <title>AgroFam+</title>
</head>
<body>
    <nav>
        <span><a href="../../index.php" id="index"><img src="../../img/agrofam.svg"></a></span>
        <a href="../../pages/profile/profileAgro.php"><img src="../../storage/profilePictures/agro/<?php echo $_SESSION['user'][1]?>.jpg"></a>
    </nav>
    <main>
        <div class="card">
            <h1>Documentos</h1>
            <form action="../../index.php" method="post" enctype="multipart/form-data" >
                <input type="text" name="nome" placeholder="Nome do documento">
                <input type="hidden" name="MAX_FILE_SIZE" value="500000">
                <input type="file" name="documento" accept=".pdf">

                <input type="hidden" name="tela" value="documentos">
                <input type="submit" value="concluído">
            </form>
            
            <section>
                <?php
                    foreach ($arquivos as $indice => $valor) 
                    {
                        extract($valor);
                        echo "<div class='doc'><a target='_blank' href='../../storage/documentos/$agricultores_id-$id-$nome.pdf'>$nome</a></div>";
                    }
                ?>
            </section>
            
        </div>
    </main>
    
</body>