<?php
  function getUserByEmail($email){
    require("./banco/database.php");
    $sql = "SELECT id, nome, senha, admin FROM usuarios WHERE email = '".$email."'";
    $result = mysqli_query($db, $sql);
    $user = mysqli_fetch_assoc($result);
    if($user != null){
      return $user;
    }else{
      return false;
    }
    
  }

  function login($email, $senha){
    $user = getUserByEmail($email);
    if($user){
      if(password_verify($senha, $user["senha"])){
        if (session_status() === PHP_SESSION_NONE) {
          session_start();
        }

        $_SESSION["logado"] = true;
        $_SESSION["id"] = $user["id"];
        $_SESSION["nome"] = $user["nome"];
        if($user["admin"]){
          $_SESSION["admin"] = $user["admin"];
        }
        header("Location: http://localhost");
        
      }else{
        return "Usuário ou senha invalidos";
      }
    }else{
      return "Usuário ou senha invalidos";
    }
  }

  function isUserLogged(){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION["logado"]) && $_SESSION["logado"]==true){
        return true;
    }else {
        return false;
    }
  }

  function isAdmin(){
      if (session_status() === PHP_SESSION_NONE) {
          session_start();
      }
      
      if(isUserLogged() && $_SESSION["admin"]==1){
          return true;
      }else {
          return false;
      }
  }

  function redirectIfNotAdmin(){
      if(!isAdmin()){
          header("Location: http://localhost");
      }
  }

?>