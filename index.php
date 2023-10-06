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

            case 'atualizar':

                if ($_POST['tipo'] == 'insti')
                {
                    $acao = 'telasInsti';
                    $local = 'profileInsti';
                }
                else 
                {
                    $acao = 'telasAgricultor';
                    $local = 'profileAgro';
                }

                if(!atualizar($_POST))
                {
                    echo 'função atualizar';
                    $_SESSION['erro'] = [true, 'Houve algo de errado com o(s) campo(s) atualizados'];
                    header("Location: pages/$acao/editarPerfil.php");
                }
                header("Location: pages/profile/$local.html");

                break;

            case 'documentos':
                armazenarDocumentos($_POST, $_FILES);
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
    if ($_SESSION['erro'][0]){
        echo '<h3 class="erroMSG">'.$_SESSION['erro'][1].'</h3>';
        $_SESSION['erro'][0] = false;
    }
    include "./pages/".$page.".html";
?>
</html>