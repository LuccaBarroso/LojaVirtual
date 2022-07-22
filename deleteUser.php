<?php
     $title="Admin";
     include_once("./view/base/top.php");
     include_once("./view/topNavBarAdmin.php");
     include_once("./banco/userInfo.php");
     include_once("./banco/database.php");
     redirectIfNotAdmin();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $sql = "Delete from usuarios where id=".$_POST["id"];
        if(mysqli_query($db, $sql)){
            header("Location: http://localhost/adminMain.php?msg=Usuario Deletado com Sucesso&type=success");
        }else{
            header("Location: http://localhost/adminMain.php?msg="."Falha ao Deletar Usuario"."&type=danger");
        }
    }

?>

    <div class="card center pt-2 mt-5 mx-auto" style="width: 500px;">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="card-body">
            <input type="hidden" name="id" value=<?php echo $_GET['id'] ?>>
            <h4 class="card-title">Deletando Usuário</h4>
            <p class="card-description">
                Tem certeza que quer deletar o usuário de id
                <?php
                    echo $_GET['id'];
                ?>?
            </p>
            <button type="submit" class="btn btn-danger">Deletar</button>
        </form>
    </div>

<?php
     include_once("./view/base/bottom.php");
?>