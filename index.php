<?php
    include './php/dll.php';
    $tela = 'login';
    extract($_POST);

    switch ($tela) {
        case 'login':
            $page = 'login/entrar';
            $stylesheet = 'entrar';

            if (isset($dados)){
                login($user, $pass);
            }
            break;

        case 'registrar':
            registrar();
            break;
        default:
            
            break;
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css?version=4">
    <link rel="stylesheet" href="css/<?php echo $stylesheet;?>.css?version=5">

    <title>AgroFam+</title>
</head>
<?php
    include "./pages/".$page.".html";
?>
</html>