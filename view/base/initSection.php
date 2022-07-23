<?php
     include_once("./view/topNavBar.php");
     include_once("./banco/userAuth.php");
     if(isUserLogged()){
         if(isAdmin()){
             echo "
             <div class='d-flex justify-content-center container'>
                 <p class='alert alert-success m-2'>"
                     ."Bem vindo ". htmlspecialchars($_SESSION["nome"]).
                     " sua conta tem privilegios de admin <a href='./adminMain.php'>clique aqui para acessar o painel</a>" .
                 "!</p>
             </div>";
         }else{
             echo "
             <div class='d-flex justify-content-center container'>
                 <p class='alert alert-success m-2'>"
                     ."Bem vindo ". htmlspecialchars($_SESSION["nome"]) ."!
                 </p>
             </div>";
         }
     }

?>