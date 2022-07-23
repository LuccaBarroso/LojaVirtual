<?php
    $title="Login";
    include_once("./view/base/top.php"); 
    include_once("./view/base/initSection.php");
    include_once("./banco/userAuth.php");


    $senha_error = $email_error = "";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["email"])){
            $email = htmlspecialchars($_POST["email"]);
        }
        
        if(isset($_POST["senha"])){
            $senha = htmlspecialchars($_POST["senha"]);
        }
    
        if (isset($_GET['success']) && $_GET['success']) {
            echo "<div class='d-flex justify-content-center mt-2'><p class='alert alert-success m-2' style='width:400px;'>"."Registrado com sucesso!" ."!</p></div>";;
        }

        if($email == ""){
            $email_error = "É necessário inserir o email!";
        }
    
        if($senha == ""){
            $senha_error = "É necessário inserir a senha!";
        }
        if($senha_error == "" && $email_error == ""){
            $senha_error = login($email, $senha);
        }
    } 
    if (isset($_GET['success'])) {
        echo "
        <div class='d-flex justify-content-center'>
            <p class='alert alert-success m-2' style='width:400px;'>
                Registrado com sucesso!  
            </p>
        </div>";
    }
    
?>

    <br>
    <div class="card lg m-auto p-3" style="width: 500px;">
    <p class="center">Fazer login</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email">
        </div>
        <?php
            if($email_error != ""){
                echo "<p class='alert alert-warning'>". $senha_error ."</p>";
            }
        ?>
        <div class="form-group">
            <label for="senha">senha:</label>
            <input type="password" class="form-control" name="senha">
        </div>
        <?php
            if($senha_error != ""){
                echo "<p class='alert alert-warning'>". $senha_error ."</p>";
            }
        ?>
        <button type="submit" class="btn btn-primary">Logar</button>
    </form> 
    </div>
<?php
    include_once("./view/base/bottom.php");
?>

 
