<?php
    session_start();
    include './php/dll.php';

    if (isset($_POST['tela']))
    {
        switch ($_POST['tela']) 
        {
            
            case 'login':
                if(!login($_POST))  
                {
                    $_SESSION['erro'] = "Algo deu errado no seu login"; 

                    $page = 'login/entrar.html';
                    $stylesheet = 'entrar';
                }
                else
                {
                    if (strlen($_POST['id'])==11)
                    {
                        $tipo = 'agricultor.html';
                    }
                    else
                    {
                        $tipo = 'instituicao.html';
                    }
                    $page = "home/$tipo";
                    $stylesheet = 'home'; 
                }
                break;
    
            case 'registrar':
                if(!registrar($_POST, $_FILES))
                {
                    $_SESSION['erro'] = 'Seu cadastro falhou!';
                }
                $page = 'login/entrar.html';
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

                if(!atualizar($_POST, $_FILES))
                {
                    $_SESSION['erro'] = 'Houve algo de errado com o(s) campo(s) atualizados';
                    header("Location: pages/$acao/editarPerfil.php");
                }
                header("Location: pages/profile/$local.php");

                break;

            case 'documentos':
                armazenarDocumentos($_POST, $_FILES);
                header('Location: pages/telasAgricultor/enviarDocs.php');
                break;

            case 'ofertas':
                citarOfertas($_POST['produto']);
                header('Location: pages/telasAgricultor/telaOfertas.php');
                break;

            case 'editais':
                criarEditais($_POST);
                header('Location: pages/telasInstituicao/criarEditais.php');
                break;

            default:
                break;
        }
    }
    else
    {
        //não verificado
        if (isset($_SESSION['user']))
        {
            $page = 'home/';
            $stylesheet = 'home';
            if ($_SESSION['user'][2] == 'agro')
            {
                $page = $page.'agricultor.html';
            }
            else
            {
                $page = $page.'instituicao.html';
            }
        }
        else
        {
            $page = 'login/entrar.html';
            $stylesheet = 'entrar';
        }
    }
    
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css?version=4">
    <link rel="stylesheet" href="css/<?php echo $stylesheet;?>.css?version=5">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <title>AgroFam+</title>
</head>
<?php
    include "./pages/".$page;
?>
</html>