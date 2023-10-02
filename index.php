<?php
    session_start();
    $_SESSION['erro'] = [false, '']; 
    include './php/dll.php';

    if (isset($_POST['tela']))
    {
        switch ($_POST['tela']) 
        {
            
            case 'login':
                if(!login($_POST))  
                {
                    $_SESSION['erro'][1] = "Algo deu errado no seu login";
                    $_SESSION['erro'][0] = true; 

                    $page = 'login/entrar';
                    $stylesheet = 'entrar';
                }
                else
                {
                    if (strlen($_POST['id'])==11)
                    {
                        $tipo = 'agricultor';
                    }
                    else
                    {
                        $tipo = 'instituicao';
                    }
                    $page = "home/$tipo";
                    $stylesheet = 'home'; 
                }
                break;
    
            case 'registrar':
                if(!registrar($_POST))
                {
                    $_SESSION['erro'][1] = "Algo deu errado no seu cadastro";
                    $_SESSION['erro'][0] = true;
                    if ($_POST['tipo'] == 'insti')
                    {
                        $local = 'cadastrarInsti';
                    } 
                    else 
                    {
                        $local = 'cadastrarAgro';
                    }
                    header("Location: pages/cadastro/$local.php");
                }
                $page = 'login/entrar';
                $stylesheet = 'entrar';
                break;
            
            default:
                break;
        }
    }
    else
    {
        $page = 'login/entrar';
        $stylesheet = 'entrar';
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
    empty($_POST);
    include "./pages/".$page.".html";
?>
</html>