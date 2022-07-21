<?php
    $title="Login";
    require("model/database.php");
    // require("model/userAuth.php");
    include_once("./view/base/top.php"); 

    $senha_error = $email_error = "";
    if(isset($_POST["email"])){
        $email = htmlspecialchars($_POST["email"]);
    }
    if(isset($_POST["senha"])){
        $senha = htmlspecialchars($_POST["senha"]);
    }
    
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($email == ""){
            $email_error = "É necessário inserir o email!";
        }
    
        if($senha == ""){
            $senha_error = "É necessário inserir a senha!";
        }
        if($senha_error == "" && $email_error == ""){
         //checar se o usuario existe
            $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
            
            if($stmt = mysqli_prepare($db, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                
                $param_email = $email;
                
                // executa
                if(mysqli_stmt_execute($stmt)){
                    // guarda resultado
                    mysqli_stmt_store_result($stmt);
                    
                    // se tiver um usuário, ele existe
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        //checar se a senha bate com a criptografada no banco
                        mysqli_stmt_bind_result($stmt, $id, $nome, $senha_criptografada);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($senha, $senha_criptografada)){
                                session_start();
                                
                                //logar o usuário   
                                $_SESSION["logado"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["nome"] = $nome;

                                header("Location: http://localhost");

                            }else{
                                $senha_error = "Senha ou email incorretos!";
                            }
                        }

                    }else{
                        $senha_error = "Senha ou email incorretos!";

                    }
                }                 
            }
        }
    }
    
    ?>
<br>
    <div class="card lg m-auto mx-3" style="width: 500px; padding: 10px; margin: 10px;">
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
        <button type="submit" class="btn btn-default">Submit</button>
    </form> 
    </div>
<?php
    include_once("./view/base/bottom.php");
?>

 
