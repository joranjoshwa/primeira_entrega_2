<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css?version=6">
    <title>AgroFam+</title>
</head>
<body>
    <main>
    <nav>
        <span><a href="../../index.php" id="index"><img src="../../img/agrofam.svg"></a></span>
    </nav>
        <div class="card">
            <h1>agricultor</h1>
            <h2>blalalalal</h2>
            <form action="../../index.php" method="post" enctype="multipart/form-data" >
                <div class="overflow">
                    <input type="text" name="nome" placeholder="Nome" required>
                    <input type="password" name="senha" placeholder="Senha" required>
                    <input type="text" name="cpf" placeholder="CPF"  minlength="11" maxlength="11" pattern="[0-9]{11}" required>
                    <select name="localidade" required>
                        <option disabled selected>Escolha uma opção</option>
                        <option value="Eunápolis">Eunápolis</option>
                        <option value="Salto da Divisa">Salto da Divisa</option>
                        <option value="Porto Seguro">Porto Seguro</option>
                    </select>
                    <input type="number" name="caf" placeholder="CAF" required>
                    <input type="text" name="telefone" placeholder="XX 9XXXX-XXXX" required pattern="[0-9]{2}.{1}9[0-9]{4}-[0-9]{4}">
                    <input type="email" name="email" placeholder="agricultor@agrofam.com" required>
                    
                    
                    <label for="profilePic"> Foto de Perfil</label>
                    <input type="file" name="profilePic" accept=".jpg" required>
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