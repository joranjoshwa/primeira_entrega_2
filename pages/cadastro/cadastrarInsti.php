
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css?version=12">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <title>AgroFam+</title>
</head>
<body>
    <nav>
        <span><a href="../../index.php" id="index"><img src="../../img/agrofam.svg"></a></span>
    </nav>
    <main>
        <div class="card">
            <h1>Instituição</h1>
            <h2>tela de cadastro da instituição</h2>
            <form action="../../index.php" method="post" enctype="multipart/form-data" >

                <div class="overflow">
                    <input type="text" name="nome" placeholder="Nome da Instituição" required>
                    <input type="password" name="senha" placeholder="Senha" required>
                    <input type="text" name="cnpj" placeholder="CNPJ"  minlength="14" maxlength="14" pattern="[0-9]{14}" required>
                    <input type="email" name="email" placeholder="instituicao@agrofam.com" required>
                    <select name="localidade" required>
                        <option disabled selected>Escolha uma opção</option>
                        <?php
                            include '../../php/dll.php';

                            $localidades = getLocalidades();
                            foreach ($localidades as $indice => $nome) 
                            {
                                echo "<option value='$nome'>$nome</option>";
                            }
                        ?>
                    </select>

                    <label for="profilePic"> Foto de Perfil</label>
                    <input type="file" name="profilePic" accept=".jpg">
                    <!--<input type="text" name="localidade" placeholder="Localidade" required>-->
                    <p><span>atenção</span>, Esta aba de cadastro é exclusiva para instituição. Não realize
                    cadastros em nome de instituições sem autorização.</p>
                    
                    <input type="hidden" name="tela" value="registrar">
                    <input type="hidden" name="tipo" value="insti">
                    <input type="submit" value="entrar">
                </div>

            </form>
        </div>
    </main>
</body>
</html>