<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css?version=6">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    <title>AgroFam+</title>
</head>
<body>
    <main>
    <nav>
        <span><a href="../../index.php" id="index"><img src="../../img/agrofam.svg"></a></span>
    </nav>
        <div class="card">
            <h1>Agricultor</h1>
            <h2>Tela de cadastro do agricultor</h2>
            <form action="../../index.php" method="post" enctype="multipart/form-data" >
                <div class="overflow">
                    <input type="text" name="nome" placeholder="Nome" required>
                    <input type="password" name="senha" placeholder="Senha" required>
                    <input type="text" name="cpf" placeholder="CPF"  minlength="11" maxlength="11" pattern="[0-9]{11}" required>
                    <select name="localidade" required>
                        <option disabled selected>Escolha uma localidade:</option>
                        <?php
                            include '../../php/dll.php';

                            $localidades = getLocalidades();
                            foreach ($localidades as $indice => $nome) 
                            {
                                echo "<option value='$nome'>$nome</option>";
                            }
                        ?>
                    </select>
                    <input type="text" name="caf" placeholder="CAF (Cadastro Nacional da Agricultura Familiar)" required minlength="11" maxlength="11" pattern="[0-9]{11}">

                    <input type="text" name="telefone" placeholder="Formato: XX 9XXXX-XXXX" required pattern="[0-9]{2}.{1}9[0-9]{4}-[0-9]{4}">
                    <input type="email" name="email" placeholder="Ex: agricultor@agrofam.com" required>
                    
                    
                    <label for="profilePic"> Foto de Perfil</label>
                    <input type="file" name="profilePic" accept=".jpg">
                    <p><span>atenção</span>, essa plataforma é de uso exclusivo a agricultores familiares, caso não se enquadre, não prossiga, é totalmente proibido inscrever instituições sem autorização.</p>
                    <input type="hidden" name="tela" value="registrar">
                    <input type="hidden" name="tipo" value="agro">
                    <input type="submit" value="enviar">
                </div>

            </form>
        </div>
    </main>
</body>
</html>