<?php
    function isUserLogged(){
        session_start();
        if(isset($_SESSION["logado"]) && $_SESSION["logado"]==true){
            return true;
        }else {
            return false;
        }
    }
    function isAdmin(){
        session_start();
        print_r($_SESSION["admin"]);
        if(isUserLogged() && $_SESSION["admin"]==1){
            return true;
        }else {
            return false;
        }
    }


?>