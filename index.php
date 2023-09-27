<?php
    extract($_POST);

    switch ($tela) {
        case 'login':
            
            break;
        
        default:
            
            break;
    }

    if (!isset($stylesheet)){
        $stylesheet = "entrar";
    }

    if (!isset($page)){
        $page = "login/entrar";
    }


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css?version=1">
    <link rel="stylesheet" href="css/<?php echo $stylesheet;?>.css?version=3">

    <title>Agrofam+</title>
</head>
<?php
    include "./pages/".$page.".html";
?>
</html>