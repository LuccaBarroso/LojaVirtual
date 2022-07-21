<?php
    $title="Home";
    require("model/database.php");
    // require("model/userAuth.php");
    include_once("./view/base/top.php");
    session_start();
    if(isset($_SESSION["logado"])){
        echo "<p class='alert alert-primary m-2'>"."Bem vindo ". htmlspecialchars($_SESSION["nome"]) ."!</p>";
    }
?>
<?php
    include_once("./view/base/bottom.php");
?>

 
