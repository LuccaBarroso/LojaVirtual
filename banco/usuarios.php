<!-- 
  CREATE TABLE `usuarios` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(255) NOT NULL,
	`email` VARCHAR(255) NOT NULL,
	`senha` VARCHAR(255) NOT NULL,
	`data_criado` DATETIME NOT NULL COMMENT 'CURRENT_TIMESTAMP',
	`admin` BOOLEAN COMMENT 'false',
  primary key(id)
); 
-->
<?php 
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

  function updateUser($post){
    $id = $post["id"];
    $nome = $post["nome"];
    $email = $post["email"];
    if($post["admin"] == "on"){
      $admin = 1;
    }else{
      $admin = 0;
    }

    require("./banco/database.php");

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
    
    return $post["email"];
  }
?>