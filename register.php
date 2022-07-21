<?php
    $title="Register";
    require("model/database.php");
    // require("model/userAuth.php");
    include_once("./view/base/top.php"); 

    $senha_error = "";
    $nome = htmlspecialchars($_POST["nome"]);
    $email = htmlspecialchars($_POST["email"]);
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    //checar se senhas são iguais
    if($_POST["senha"] !== $_POST["confirmarSenha"]){
        $senha_error="As senhas precisam ser iguais!";
    }

    if($senha_error == ""){

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //somente quando for post
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($db, $sql);
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_senha);
            
        // Set parameters
        $param_name = $nome;
        $param_email = $email;
        $param_senha = $senha; // Creates a password hash
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Redirect to login page
            header("location: http://localhost/login.php");
        }else{
            // header("Location: http://localhost/error.php?msg="."Falha ao criar usuário");
        }
    }
    }
    
    ?>
<br>
    <div class="card lg m-auto mx-3" style="width: 500px; padding: 10px; margin: 10px;">
    <p class="center">Registrar um novo usuário</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email">
        </div>
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
        <button type="submit" class="btn btn-default">Submit</button>
    </form> 
    </div>
<?php
    include_once("./view/base/bottom.php");
?>

 
