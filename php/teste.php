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


    $var = executarQuery('SELECT * from agricultores', $retorno=1);
    if(!$var){
        echo 'pedro';
    }
    print_r ($var);

    ?>
</pre>
</body>
</html>
