<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">

    <title>Document</title>
</head>
<body> 
    <main>
        <div class="card">
            <h1>Atualize seu cadastro</h1>
            <form action="../../index.php" method="post">
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

                <input type="hidden" name="tela" value="atualizar">
                <input type="hidden" name="tipo" value="agro"><!--será removido coma criação da sessão de logado-->
                <input type="submit" value="entrar">
            </form>
        </div>
    </main>
    
</body>
</html>