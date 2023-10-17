<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/profileAgro.css?version=4">

    <title>Document</title>
</head>
<body> 
    <nav>
        <span><a href="../../index.php">AgroFam+</a></span>
        <a href="pages/profile/profileInsti.html"><img src="../../storage/profilePictures/agro/<?php echo $_SESSION['user'][1]?>.jpg"></a>
    </nav>
    <main>
        <div class="card">
            <h1>Agrofam+</h1>
            <div class="foto"><img src="../../storage/profilePictures/agro/<?php echo $_SESSION['user'][1]?>.jpg" alt=""></div>
            <div class="user">
                <span class="nome"><b>agrofam</b> user</span>
                <span class="detalhes">Eunápolis, Bahia, agricultor</span>
            </div>
            <div class="acoes">
                <p><img src="../../img/editarPerfil.svg" alt="icone editar perfil"><span><a href="../telasAgricultor/editarPerfil.php">Editar perfil</a></span></p>
                <p><img src="../../img/meusDocumentos.svg" alt="icone meus documentos"><span><a href="../telasAgricultor/enviarDocs.php">Meus documentos</a></span></p>
                <p><img src="../../img/minhasVendas.svg" alt="icone minhas vendas"><span><a href="../telasAgricultor/telaOfertas.php">Minhas vendas</a></span></p>
            </div>
        </div>
    </main>
    
</body>
</html>