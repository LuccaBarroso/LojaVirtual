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
            array_push($users, array(
              "id" => $UsuarioAtual["id"],
              "nome" => $UsuarioAtual["nome"],
              "email" => $UsuarioAtual["email"],
              "admin" => $UsuarioAtual["admin"]
            ));
          }
          return $users;
         }else{
          return false;
         }
      }
  }

  function getUserById($id_to_change){
    require("./banco/database.php");
    $sql = "SELECT id, nome, email, admin FROM usuarios where id=".$id_to_change;
    $result = mysqli_query($db, $sql);
    if($result!=null){
      return mysqli_fetch_assoc($result);
    }else{
      return false;
    }
  }
?>