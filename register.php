<?php
    $title="Register";
    // require("model/userAuth.php");
    include_once("./view/base/top.php"); 

    $senha_error = $email_error = $nome_error = "";
    if(isset($_POST["nome"])){
        $nome = htmlspecialchars($_POST["nome"]);
        if($nome == ""){
            $nome_error = "É necessário que o usuário tenha um nome!";
        }
    }
    if(isset($_POST["email"])){
        $email = htmlspecialchars($_POST["email"]);
        if($email == ""){
            $email_error = "É necessário que o usuário tenha um email!";
        }
    }
    if(isset($_POST["senha"])){
        $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
        if($_POST["senha"] == ""){
            $senha_error = "É necessário que o usuário tenha uma senha!";
        }
    }
    //checar se senhas são iguais
    if(isset($_POST["senha"]) && isset($_POST["confirmarSenha"]) && $_POST["senha"] !== $_POST["confirmarSenha"]){
        $senha_error="As senhas precisam ser iguais!";
    }

    //TODO validar se o email já não esta cadastrado

    if($senha_error == "" && $email_error == "" && $nome_error == ""){

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //somente quando for post
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($db, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_senha);
                
            // Set parameters
            $param_name = $nome;
            $param_email = $email;
            $param_senha = $senha; // Creates a password hash
            
            //tenta executar
            if(mysqli_stmt_execute($stmt)){
                // deu certo, vai pra login
                header("location: http://localhost/login.php?success=true");
            }else{
                // header("Location: http://localhost/error.php?msg="."Falha ao criar usuário");
            }
        }
    }
    
    ?>
<br>
    <div class="card lg m-auto p-3" style="width: 500px;">
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
        <button type="submit" class="btn btn-primary">Submit</button>
    </form> 
    </div>
<?php
    include_once("./view/base/bottom.php");
?>

 
