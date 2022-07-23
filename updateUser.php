<?php
     $title="Admin";
     include_once("./view/base/top.php");
     include_once("./view/topNavBarAdmin.php");
     include_once("./banco/userAuth.php");
     include_once("./banco/userAuth.php");
     include_once("./banco/database.php");
     redirectIfNotAdmin();

     $extra_error = $nome_error = $email_error = "";
     $id = $nome = $email = $admin = "";
     
     
   if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(isset($_POST["id"])){
         $id = htmlspecialchars($_POST["id"]);
      }

      if(isset($_POST["nome"])){
         $nome = htmlspecialchars($_POST["nome"]);
      }
      if($nome == ""){
         $nome_error = "É necessário que o usuário tenha um nome!";
      }

      if(isset($_POST["email"])){
         $email = htmlspecialchars($_POST["email"]);
      }
      if($email == ""){
         $email_error = "É necessário que o usuário tenha um email!";
      }

      if(isset($_POST["admin"]) && $_POST["admin"] == "on"){
         $admin = 1;
      }else{
         $admin = 0;
      }
      if($email_error == "" && $nome_error == ""){
         $extra_error = updateUser($id, $nome, $email, $admin);
      }
   }
   if(isset($_GET["id"])){
      $user = getUserById($_GET["id"]);
   }else{
      $user = getUserById($_POST["id"]);
   }
?>

    <div class="card center pt-2 mt-5 mx-auto" style="width: 500px;">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="card-body">
            <input type="hidden" name="id" value=<?php echo $user["id"] ?>>
            <h4 class="card-title">Editando Usuário</h4>
            <div class="form-group">
               <label for="nome">Nome:</label>
               <input type="nome" class="form-control" name="nome" value="<?php echo $user["nome"] ?>">
            </div>
            <?php
               if($nome_error != ""){
                  echo "<p class='alert alert-warning'>". $nome_error ."</p>";
               }
            ?>
            <div class="form-group">
               <label for="email">Email:</label>
               <input type="email" class="form-control" name="email" value=<?php echo $user["email"] ?>>
            </div>
            <?php
               if($email_error != ""){
                  echo "<p class='alert alert-warning'>". $email_error ."</p>";
               }
            ?>
            <div class="form-group">
               <input class="form-check-input ml-3" name="admin" type="checkbox" <?php if($user["admin"] == 1){ echo "checked"; }?>>
               <label class="form-check-label ml-5" for="flexCheckDefault">
               Admin
               </label>
            </div>
            <?php
               if($extra_error != ""){
                  echo "<p class='alert alert-warning'>". $extra_error ."</p>";
               }
            ?>
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>
    </div>

<?php
     include_once("./view/base/bottom.php");
?>