<?php
  $title="Admin";
  include_once("./view/base/top.php");
  include_once("./view/topNavBarAdmin.php");
  include_once("./banco/userAuth.php");
  include_once("./banco/produtos.php");
  include_once("./banco/database.php");
  redirectIfNotAdmin();

  $nome_error = $descricao_error = $preco_error = $imagem_error  = "";
     
     
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["id"])){
      $id = htmlspecialchars($_POST["id"]);
    }else{
      $imagem_error="id inexistente";
    }
    if(isset($_POST["nome"])){
        $nome = htmlspecialchars($_POST["nome"]);
    }
    if($nome == ""){
        $nome_error = "É necessário que o produto tenha um nome!";
    }
    
    if(isset($_POST["descricao"])){
        $descricao = htmlspecialchars($_POST["descricao"]);
    }
    if($descricao == ""){
        $descricao_error = "É necessário que o produto tenha um descricao!";
    }

    if(isset($_POST["preco"])){
        $preco = htmlspecialchars($_POST["preco"]);
    }
    if($preco == ""){
        $preco_error = "É necessário que o produto tenha um preco!";
    }

    if($preco_error == "" && $descricao_error == "" && $nome_error == ""){
        if(!empty($_FILES["imagem"]["name"])) {
          $fileName = $_FILES["imagem"]["name"];
          $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
          $path = "./uploads/produtos/".$nome.rand().".".$fileType;
          
          if(in_array($fileType, array('jpg','png','jpeg'))){
              if(updateProduct($id, $nome, $descricao, $preco, $path)){
                move_uploaded_file($_FILES["imagem"]["tmp_name"], $path);
                header("Location: http://localhost/adminMain.php?msg=Produto Criado com Sucesso&type=success");
              }
          }else{ 
              $imagem_error = 'Só são permitidos os formatos JPG, JPEG e PNG.'; 
              }
        }else{
          if(updateProduct($id, $nome, $descricao, $preco)){
            header("Location: http://localhost/adminMain.php?msg=Produto Atualizado com Sucesso&type=success");
          }
        }
    }
  }
  if(isset($_GET["id"])){
    $product = getProductById($_GET["id"]);
  }else{
    $product = getProductById($_POST["id"]);
  }
?>

    <div class="card center pt-2 mt-5 mx-auto" style="width: 500px;">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="POST" class="card-body">
            <h4 class="card-title">Criando Produto</h4>
            <input type="hidden" name="id" value=<?php echo $product["id"] ?>>
            <div class="form-group">
               <label for="nome">Nome:</label>
               <input type="text" class="form-control" name="nome" value="<?php echo $product["nome"] ?>">
            </div>
            <?php
               if($nome_error != ""){
                  echo "<p class='alert alert-warning'>". $nome_error ."</p>";
               }
            ?>
            <div class="form-group">
               <label for="descricao">Descrição:</label>
               <input type="text" class="form-control" name="descricao" value="<?php echo $product["descricao"] ?>">
            </div>
            <?php
               if($descricao_error != ""){
                  echo "<p class='alert alert-warning'>". $descricao_error ."</p>";
               }
            ?>
            <div class="form-group">
               <label for="preco">Preço:</label>
               <input type="number" min="0.00" step="0.01" class="form-control" name="preco" value="<?php echo $product["preco"] ?>">
            </div>
            <?php
               if($preco_error != ""){
                  echo "<p class='alert alert-warning'>". $preco_error ."</p>";
               }
            ?>
            <div class="form-group">
               <label for="imagem">Imagem:</label>
               <input type="file" class="btn" name="imagem">
            </div>
            <?php
               if($imagem_error != ""){
                  echo "<p class='alert alert-warning'>". $imagem_error ."</p>";
               }
            ?>
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>
    </div>

<?php
     include_once("./view/base/bottom.php");
?>