<?php
    $DB_SERVER = "localhost";
    $DB_USERNAME = "root";
    $DB_PASSWORD="mynewpassword";
    $DB_NAME= "LojaVirtal";
     
    //tenta conectar com banco
    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
     
    // se não conectar retorna um erro
    if($db === false){
        //redireciona para erro
        header("Location: http://localhost/error.php?msg="."Não foi possivel conectar com o banco de dados!");
        // $error_msg = ("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>