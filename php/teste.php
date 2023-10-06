<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<pre>
    <?php

    include "util.php";

    $chave = '2';
    $tabela = 'localidades';
    print_r(executarQuery("SELECT * FROM $tabela WHERE id = $chave", $retorno=true)[0]);
    $result = converterChave($chave, $tabela)[0]['nome'];
    print_r($result);
    ?>
</pre>
</body>
</html>
