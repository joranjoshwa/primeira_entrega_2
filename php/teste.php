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

    include "conectorBD.php";
    $id = 31123123;
    $queryResult=executarQuery("SELECT senha from agricultores WHERE CPF = '$id'", $retorno=true)[0]['senha'];
    print_r($queryResult);
    ?>
</pre>
</body>
</html>
