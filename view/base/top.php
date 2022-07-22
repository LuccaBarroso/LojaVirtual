<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "LojaVirtual-".$title?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
</head>
<body>
    <main class="main">
        <?php 
            require_once("banco/database.php");
            require_once("banco/userInfo.php");
            include_once("./view/topNavBar.php");
            if(isUserLogged()){
                if(isAdmin()){
                    echo "
                    <div class='d-flex justify-content-center'>
                        <p class='alert alert-success m-2' style='width:400px;'>"
                            ."Bem vindo ". htmlspecialchars($_SESSION["nome"]).
                            " sua conta tem privilegios de admin <a href='./admin'>clique aqui para acessar o painel</a>" .
                        "!</p>
                    </div>";
                }else{
                    echo "
                    <div class='d-flex justify-content-center'>
                        <p class='alert alert-success m-2' style='width:400px;'>"
                            ."Bem vindo ". htmlspecialchars($_SESSION["nome"]) ."!
                        </p>
                    </div>";
                }
            }
        ?>
