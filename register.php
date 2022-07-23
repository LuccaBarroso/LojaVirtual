<?php
    $title="Register";
    // require("model/userAuth.php");
    include_once("./view/base/top.php");
    include_once("./view/base/initSection.php");
    include_once("./banco/userAuth.php");

    $senha_error = $email_error = $nome_error = "";
    $nome = $email = $senha = $confirmarSenha = "";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
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

        if(isset($_POST["senha"])){
            $senha = $_POST["senha"];
        }
        if($senha == ""){
            $senha_error = "É necessário que o usuário tenha uma senha!";
        }

        if(isset($_POST["confirmarSenha"])){
            $confirmarSenha = $_POST["senha"];
        }
        if($_POST["confirmarSenha"] == ""){
            $senha_error = "É necessário que o usuário tenha uma senha!";
        }
        
        if($senha != $confirmarSenha){
            $senha_error = "Senhas precisam ser iguais!";
        }

        if($senha_error == "" && $email_error == "" && $nome_error == ""){
            $senha = password_hash($senha, PASSWORD_DEFAULT);
            $senha_error = register($nome, $email, $senha);
        }
    }
    ?>
<br>
    <div class="container card lg m-auto p-3">
    <p class="center">Registrar um novo usuário</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome">
        </div>
        <?php
            if($nome_error != ""){
                echo "<p class='alert alert-warning'>". $nome_error ."</p>";
            }
        ?>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email">
        </div>
        <?php
            if($email_error != ""){
                echo "<p class='alert alert-warning'>". $email_error ."</p>";
            }
        ?>
        <div class="form-group">
            <label for="senha">senha:</label>
            <input type="password" class="form-control" name="senha">
        </div>
        <div class="form-group">
            <label for="confirmarSenha">Confirme a senha:</label>
            <input type="password" class="form-control" name="confirmarSenha">
        </div>
        <?php
            if($senha_error != ""){
                echo "<p class='alert alert-warning'>". $senha_error ."</p>";
            }
        ?>
        <div class="text-center">
            <a href="./login.php" class="d-block pb-1">Já tenho conta, quero me logar</a>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
    </form> 
    </div>
<?php
    include_once("./view/base/bottom.php");
?>

 
