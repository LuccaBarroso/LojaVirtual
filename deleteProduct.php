<?php
     $title="Admin";
     include_once("./view/base/top.php");
     include_once("./view/topNavBarAdmin.php");
     include_once("./banco/userAuth.php");
     include_once("./banco/produtos.php");
     redirectIfNotAdmin();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        deleteProduct($_POST["id"]);
    }

?>

    <div class="card center pt-2 mt-5 mx-auto" style="width: 500px;">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="card-body">
            <input type="hidden" name="id" value=<?php echo $_GET['id'] ?>>
            <h4 class="card-title">Deletando Produto</h4>
            <p class="card-description">
                Tem certeza que quer deletar o produto de id
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