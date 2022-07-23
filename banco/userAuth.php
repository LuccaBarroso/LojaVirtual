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
  
  function register($nome, $email, $senha){
    require("./banco/database.php");
    $user = getUserByEmail($email);
    if($user){
      return "Já temos um usuário com esse e-mail!";
    }
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_senha);
    
    $param_name = $nome;
    $param_email = $email;
    $param_senha = $senha;
    
    //tenta executar
    if(mysqli_stmt_execute($stmt)){
        header("location: http://localhost/login.php?success=true");
    }else{
        header("Location: http://localhost/error.php?msg="."Falha ao criar usuário");
    }
  }

  function getUsuarios(){
    require("./banco/database.php");
    $sql = "SELECT id, nome, email, admin FROM usuarios order by id";
    $result = mysqli_query($db, $sql);
    if($result!=null){
        if(mysqli_num_rows($result) > 0){
        $users = array();
        while($UsuarioAtual = mysqli_fetch_array($result)){
          array_push($users, $UsuarioAtual);
        }
        return $users;
        }else{
        return false;
        }
    }
  }

  function getUserById($id){
    require("./banco/database.php");
    $sql = "SELECT id, nome, email, admin FROM usuarios where id=".$id;
    $result = mysqli_query($db, $sql);
    if($result!=null){
      return mysqli_fetch_assoc($result);
    }else{
      return false;
    }
  }

  function updateUser($id, $nome, $email, $admin){
    require("./banco/database.php");

    //obs: admin 1 ou 0;
    if($admin != 1 && $admin != 0){
      return false;
    }

    //checar se o email é valido
    $user = getUserByEmail($email);
    if($user &&  $user["id"] != $id){
      return "Já  temos outro usuário com esse email!";
    }

    $sql = "UPDATE usuarios SET 
      nome='".$nome."',
      email='".$email."',
      admin='".$admin."'
      WHERE id=".$id;

    if (mysqli_query($db, $sql)) {
      header("Location: http://localhost/adminMain.php?msg=Usuario Atualizado com Sucesso&type=success");
    }else{
      header("Location: http://localhost/adminMain.php?msg=Falha ao Atualizar o Usuário&type=danger");
    }
  }

  function deleteUser($id){
    require("./banco/database.php");
    $sql = "DELETE FROM usuarios WHERE id=".$id;
    if (mysqli_query($db, $sql)) {
      header("Location: http://localhost/adminMain.php?msg=Usuario Deletado com Sucesso&type=success");
    }else{
      header("Location: http://localhost/adminMain.php?msg=Falha ao Deletar o Usuário&type=danger");
    }
  }
  
?>