
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css?version=8">
    <link rel="stylesheet" href="../../css/cadastrarAgro.css">
    <title>AgroFam+</title>
</head>
<body>
    <main>
        <div class="card">
            <h1>Instituição</h1>
            <h2>blalalalal</h2>
            <?php
                session_start();
                if ($_SESSION['erro'][0]){
                    echo '<h3 class="erroMSG">'.$_SESSION['erro'][1].'</h3>';
                    $_SESSION['erro'][0] = false;
                }
            ?>
            <form action="../../index.php" method="post">
                <div class="overflow">
                    <input type="text" name="nome" placeholder="Nome da Instituição" required>
                    <input type="password" name="senha" placeholder="Senha" required>
                    <input type="number" name="cnpj" placeholder="CNPJ" required>
                    <input type="email" name="email" placeholder="E-mail" required>
                    <select name="localidade" required>
                        <option disabled selected>Escolha uma opção</option>
                        <option value="Eunápolis">Eunápolis</option>
                        <option value="Salto da Divisa">Salto da Divisa</option>
                        <option value="Porto Seguro">Porto Seguro</option>
                    </select>
                    <!--<input type="text" name="localidade" placeholder="Localidade" required>-->
                    <p><span>atenção</span>, Esta aba de cadastro é exclusiva para instituição. Não realize
                        cadastros em nome de instituições sem autorização.</p>
                </div>
                <input type="hidden" name="tela" value="registrar">
                <input type="hidden" name="tipo" value="insti">
                <input type="submit" value="entrar">
            </form>
        </div>
    </main>
</body>
</html>