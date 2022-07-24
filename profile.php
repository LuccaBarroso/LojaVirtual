<?php
    $title="Login";
    include_once("./view/base/top.php"); 
    include_once("./view/base/initSection.php");
    include_once("./banco/userAuth.php");


    $extra_error = $email_error = $nome_error = "";
    
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
        $admin = $_POST["admin"];
        if($email_error == "" && $nome_error == ""){
           $result = updateUser($id, $nome, $email, $admin);
           if($result == "success"){
               header("Location: http://localhost");
            }else{
                $extra_error = $result;
            }
        }
     }
     if(isset($_SESSION["id"])){
        $user = getUserById($_SESSION["id"]);
     }else{
        header("Location: http://localhost/login.php");
     }
?>

    <div class="card center pt-2 mt-5 mx-auto container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="card-body">
            <input type="hidden" name="id" value=<?php echo $user["id"] ?>>
            <input type="hidden" name="admin" value=<?php echo $user["admin"] ?>>
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
            <?php
               if($extra_error != ""){
                  echo "<p class='alert alert-warning'>". $extra_error ."</p>";
               }
            ?>
            <div class="text-center">
               <button type="submit" class="btn btn-primary">Editar</button>
            </div>
        </form>
    </div>

<?php
    include_once("./view/base/bottom.php");
?>

 
