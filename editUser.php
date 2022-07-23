<?php
     $title="Admin";
     include_once("./view/base/top.php");
     include_once("./view/topNavBarAdmin.php");
     include_once("./banco/usuarios.php");
     include_once("./banco/userAuth.php");
     include_once("./banco/database.php");
     redirectIfNotAdmin();

     
     
     if($_SERVER["REQUEST_METHOD"] == "POST"){
        updateUser($_POST);
     }
     
     
     $user = getUserById($_GET["id"]);
?>

    <div class="card center pt-2 mt-5 mx-auto" style="width: 500px;">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="card-body">
            <input type="hidden" name="id" value=<?php echo $user["id"] ?>>
            <h4 class="card-title">Editando Usuário</h4>
            <div class="form-group">
               <label for="email">Nome:</label>
               <input type="nome" class="form-control" name="nome" value="<?php echo $user["nome"] ?>">
            </div>
            <div class="form-group">
               <label for="email">Email:</label>
               <input type="email" class="form-control" name="email" value=<?php echo $user["email"] ?>>
            </div>
            <div class="form-group">
               <input class="form-check-input ml-3" name="admin" type="checkbox" <?php if($user["admin"] == 1){ echo "checked"; }?>>
               <label class="form-check-label ml-5" for="flexCheckDefault">
               Admin
               </label>
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>
    </div>

<?php
     include_once("./view/base/bottom.php");
?>