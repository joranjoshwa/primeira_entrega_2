
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css?version=10">
    <link rel="stylesheet" href="../../css/profileAgro.css?version=4">
    <title>AgroFam+</title>
</head>
<body>
    <nav>
        <span><a href="../../index.php">AgroFam+</a></span>
        <a href="pages/profile/profileInsti.html"><img src="../../storage/profilePictures/agro/<?php echo $_SESSION['user'][1]?>.jpg"></a>
    </nav>
    <main>
        <div class="card">
            <h1>Instituição</h1>
            <h2>blalalalal</h2>
            <form action="../../index.php" method="post" enctype="multipart/form-data" >
                
                <input type="text" name="nome" placeholder="Nome da Instituição" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <input type="text" name="cnpj" placeholder="CNPJ"  minlength="14" maxlength="14" pattern="[0-9]{14}" required>
                <input type="email" name="email" placeholder="instituicao@agrofam.com" required>
                 <select name="localidade" required>
                    <option disabled selected>Escolha uma opção</option>
                    <option value="Eunápolis">Eunápolis</option>
                    <option value="Salto da Divisa">Salto da Divisa</option>
                    <option value="Porto Seguro">Porto Seguro</option>
                </select>

                <label for="profilePic"> Foto de Perfil</label>
                <input type="file" name="profilePic" accept=".jpg">
                <!--<input type="text" name="localidade" placeholder="Localidade" required>-->
                <p><span>atenção</span>, Esta aba de cadastro é exclusiva para instituição. Não realize
                cadastros em nome de instituições sem autorização.</p>

                <input type="hidden" name="tela" value="registrar">
                <input type="hidden" name="tipo" value="insti">
                <input type="submit" value="entrar">
            </form>
        </div>
    </main>
</body>
</html>