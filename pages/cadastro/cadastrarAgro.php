
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css?version=2">
    <link rel="stylesheet" href="../../css/cadastrarAgro.css">
    <title>AgroFam+</title>
</head>
<body>
    <main>
        <div class="card">
            <h1>agricultor</h1>
            <h2>blalalalal</h2>
            <?php
                session_start();
                if ($_SESSION['erro'][0]){
                    echo '<h3 class="erroMSG">'.$_SESSION['erro'][1].'</h3>';
                }
            ?>
            <form action="../../index.php" method="post">
                <div class="overflow">
                    <input type="text" name="nome" placeholder="Nome" required>
                    <input type="password" name="senha" placeholder="Senha" required>
                    <input type="number" name="cpf" placeholder="CPF" required>
                    <select name="localidade" required>
                        <option disabled selected>Escolha uma opção</option>
                        <option value="Eunápolis">Eunápolis</option>
                        <option value="Salto da Divisa">Salto da Divisa</option>
                        <option value="Porto Seguro">Porto Seguro</option>
                    </select>
                    <input type="number" name="caf" placeholder="CAF" required>
                    <input type="number" name="telefone" placeholder="Telefone" required>
                    <input type="email" name="email" placeholder="E-mail" required>
                    <p><span>atenção</span>, essa plataforma é de uso exclusivo a agricultores familiares, caso não se enquadre, não prossiga, é totalmente proibido inscrever instituições sem autorização.</p>
                </div>

                <input type="hidden" name="tela" value="registrar">
                <input type="hidden" name="tipo" value="agro">
                <input type="submit" value="entrar">
            </form>
        </div>
    </main>
</body>
</html>