<?php
    session_start();

    if (!isset($_SESSION['user']))
    {
      header("Location: ../../php/logout.php");  
    }

    include '../../php/conectorBD.php';
    $result = executarQuery("SELECT instituicoes.nome as insti, localidades.nome as lugar, uf.nome as estado FROM instituicoes, localidades, uf WHERE instituicoes.localidades_id = localidades.id AND localidades.uf_id = uf.id AND instituicoes.id ='".$_SESSION['user'][1]."';",$retorno=true)[0];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/profileAgro.css">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">

    <title>AgroFam+</title>
</head>
<body>
    <nav>
        <span><a id='index' href="../../index.php"><img src="../../img/agrofam.svg" alt=""></a></span>
        <a href="../../pages/profile/profileInsti.php"><img src="../../storage/profilePictures/insti/<?php echo $_SESSION['user'][1]?>.jpg" alt=''></a>
    </nav>
    <main>
        <div class="card">
            <div class="foto"> <img src="../../storage/profilePictures/insti/<?php echo $_SESSION['user'][1]?>.jpg" alt=""></div>
            <div class="user">
                <span class="nome"><b>instituição</b> <?php echo $result['insti'];?></span>
                <span class="detalhes"><?php echo $result['lugar'].", ".$result['estado'];?></span>
            </div>
            <div class="acoes">
                <p><img src="../../img/editarPerfil.svg" alt=""><span><a href="../telasInstituicao/editarPerfil.php">Editar perfil</a></span></p>
                <p><img src="../../img/editaisPublicados.svg" alt=""><span><a href="../telasInstituicao/visualizarEditais.php">Seus editais</a></span></p>
                <p id="sair"><img src="../../img/logout_black_24dp.svg" alt="sair"><span><a href="../../php/logout.php">Sair</a></span></p>
            </div>
        </div>
    </main>
</body>
</html>