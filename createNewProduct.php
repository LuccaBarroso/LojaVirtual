<?php
     $title="Admin";
     include_once("./view/base/top.php");
     include_once("./view/topNavBarAdmin.php");
     include_once("./banco/produtos.php");
     include_once("./banco/userAuth.php");
     include_once("./banco/database.php");
     redirectIfNotAdmin();

     
     
     if($_SERVER["REQUEST_METHOD"] == "POST"){
        print_r(createNewProduct($_POST));
     }
?>

    <div class="card center pt-2 mt-5 mx-auto" style="width: 500px;">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="card-body">
            <input type="hidden" name="id" value=<?php echo $user["id"] ?>>
            <h4 class="card-title">Criando Produto</h4>
            <div class="form-group">
               <label for="nome">Nome:</label>
               <input type="text" class="form-control" name="nome">
            </div>
            <div class="form-group">
               <label for="descricao">Descrição:</label>
               <input type="text" class="form-control" name="descricao">
            </div>
            <div class="form-group">
               <label for="preco">Preço:</label>
               <input type="number" min="0.00" step="0.01" class="form-control" name="preco">
            </div>
            <div class="form-group">
               <label for="preco">Imagem:</label>
               <input type="file" class="btn" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Criar</button>
        </form>
    </div>

<?php
     include_once("./view/base/bottom.php");
?>