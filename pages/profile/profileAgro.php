<?php
    session_start();
    include '../../php/conectorBD.php';

    $result = executarQuery("SELECT agricultores.nome as agro, localidades.nome as lugar FROM agricultores, localidades WHERE agricultores.localidades_id = localidades.id AND agricultores.id ='".$_SESSION['user'][1]."';",$retorno=true)[0];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/profileAgro.css?version=4">

    <title>AgroFam+</title>
</head>
<body> 
    <nav>
        <span><a href="../../index.php" id="index"><img src="../../img/agrofam.svg"></a></span>
        <a href="pages/profile/profileInsti.html"><img src="../../storage/profilePictures/agro/<?php echo $_SESSION['user'][1]?>.jpg"></a>
    </nav>
    <main>
        <div class="foto"><img src="../../storage/profilePictures/agro/<?php echo $_SESSION['user'][1]?>.jpg" alt=""></div>
        <div class="user">
            <span class="nome"><b>agricultor</b> <?php echo $result['agro'];?></span>
            <span class="detalhes"><?php echo $result['lugar'];?>, Bahia</span>
        </div>
        <div class="acoes">
            <p><img src="../../img/editarPerfil.svg" alt="icone editar perfil"><span><a href="../telasAgricultor/editarPerfil.php">Editar perfil</a></span></p>
            <p><img src="../../img/meusDocumentos.svg" alt="icone meus documentos"><span><a href="../telasAgricultor/enviarDocs.php">Meus documentos</a></span></p>
            <p><img src="../../img/minhasVendas.svg" alt="icone minhas vendas"><span><a href="../telasAgricultor/telaOfertas.php">Minhas vendas</a></span></p>
        </div>
    </main>
    
</body>
</html>