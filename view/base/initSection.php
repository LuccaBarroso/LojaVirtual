<?php
     include_once("./view/topNavBar.php");
     include_once("./banco/userInfo.php");
     if(isUserLogged()){
         if(isAdmin()){
             echo "
             <div class='d-flex justify-content-center'>
                 <p class='alert alert-success m-2' style='width:400px;'>"
                     ."Bem vindo ". htmlspecialchars($_SESSION["nome"]).
                     " sua conta tem privilegios de admin <a href='./adminMain.php'>clique aqui para acessar o painel</a>" .
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