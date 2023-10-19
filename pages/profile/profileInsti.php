<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/profileAgro.css">

    <title>AgroFam+</title>
</head>
<body>
    <nav>
        <span><a href="../../index.php">AgroFam+</a></span>
        <a href="pages/profile/profileInsti.html"><img src="../../storage/profilePictures/insti/<?php echo $_SESSION['user'][1]?>.jpg"></a>
    </nav>
    <main>
        <div class="card">
            <h1>Agrofam+</h1>
            <div class="foto"> <img src="../../storage/profilePictures/insti/<?php echo $_SESSION['user'][1]?>.jpg" alt=""></div>
            <div class="user">
                <span class="nome"><b>agricultor</b> user</span>
                <span class="detalhes">Eunápolis, Bahia, instituição</span>
            </div>
            <div class="acoes">
                <p><img src="../../img/editarPerfil.svg" alt=""><span><a href="../telasInstituicao/editarPerfil.php">Editar perfil</a></span></p>
                <p><img src="../../img/editaisPublicados.svg" alt=""><span><a href="../telasInstituicao/visualizarEditais.php">Seus editais</a></span></p>
            </div>
        </div>
    </main>
</body>
</html>