<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<pre>
    <?php

    include "conectorBD.php";


    print_r(executarQuery("describe agricultores", $retorno=1, $multi = 0));


    ?>
</pre>
</body>
</html>
