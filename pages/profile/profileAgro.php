<?php
    session_start();
    include '../../php/conectorBD.php';

    if (!isset($_SESSION['user']))
    {
      header("Location: ../../php/logout.php");  
    }

    $result = executarQuery("SELECT agricultores.nome as agro, localidades.nome as lugar, uf.nome as estado FROM agricultores, localidades, uf WHERE agricultores.localidades_id = localidades.id AND localidades.uf_id = uf.id AND agricultores.id ='".$_SESSION['user'][1]."';",$retorno=true)[0];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/profileAgro.css?version=4">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">

    <title>AgroFam+</title>
</head>
<body> 
    <nav>
        <span><a href="../../index.php" id="index"><img src="../../img/agrofam.svg"></a></span>
        <a href="profileAgro.php"><img src="../../storage/profilePictures/agro/<?php echo $_SESSION['user'][1]?>.jpg"></a>
    </nav>
    <main>
        <div class="foto"><img src="../../storage/profilePictures/agro/<?php echo $_SESSION['user'][1]?>.jpg" alt=""></div>
        <div class="user">
            <span class="nome"><b>agricultor</b> <?php echo $result['agro'];?></span>
            <span class="detalhes"><?php echo $result['lugar'].", ".$result['estado'];?></span>
        </div>
        <div class="acoes">
            <p><img src="../../img/editarPerfil.svg" alt="editar perfil"><span><a href="../telasAgricultor/editarPerfil.php">Editar perfil</a></span></p>
            <p><img src="../../img/meusDocumentos.svg" alt="meus documentos"><span><a href="../telasAgricultor/enviarDocs.php">Meus documentos</a></span></p>
            <p><img src="../../img/minhasVendas.svg" alt="minhas vendas"><span><a href="../telasAgricultor/telaOfertas.php">Minhas vendas</a></span></p>
            <p id="sair"><img src="../../img/logout_black_24dp.svg" alt="sair"><span><a href="../../php/logout.php">Sair</a></span></p>
        </div>
    </main>
    
</body>
</html>