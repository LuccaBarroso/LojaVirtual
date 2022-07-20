<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'mynewpassword');
    define('DB_NAME', 'LojaVirtual');
     
    //tenta conectar com banco
    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
     
    // se não conectar retorna um erro
    if($db === false){
        $error_msg = ("ERROR: Could not connect. " . mysqli_connect_error());
        include("view/error.php");
        exit();
    }
?>