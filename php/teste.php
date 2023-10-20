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

    $result = executarQuery('SELECT nome From documentos',$retorno=true);
    print_r($result);
    echo phpversion();
    ?>
</pre>
</body>
</html>
