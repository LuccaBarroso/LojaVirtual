<?php 
echo $_GET['link']; 
include("base/top.php");
include_once("./view/topNavBar.php");

?>

    <h2>Alguma coisa deu errado</h2>
    <p><?php 
        if (isset($_GET['msg'])) {
            echo $_GET['msg'];
        } else {
            echo "ERRO NÃO SETADO";
        }
    ?></p>
    <br>
    <p><a href="./">Voltar para pagina principal</a></p>
<?php include("base/bottom.php") ?>