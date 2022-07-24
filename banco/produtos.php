<!-- 
   CREATE TABLE `produtos` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(255) NOT NULL,
    `descricao` VARCHAR(255) NOT NULL,
    `preco` DECIMAL(10,2) NOT NULL,
    `imagem` VARCHAR(255) NOT NULL,
     `view` INT NOT NULL DEFAULT 0,
    primary key(id)
  );
-->
<?php 
  function getProducts(){
    require("./banco/database.php");
    $sql = "SELECT * FROM produtos order by id";
    $result = mysqli_query($db, $sql);
    if($result!=null){
        if(mysqli_num_rows($result) > 0){
        $produtos = array();
        while($produtoAtual = mysqli_fetch_array($result)){
          array_push($produtos, $produtoAtual);
        }
        return $produtos;
        }else{
        return false;
        }
    }
  }
  
  function createNewProduct($nome, $descricao, $preco, $imagem){
    require("./banco/database.php");
    $sql = "INSERT INTO produtos (nome, descricao, preco, imagem) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ssds", $param_nome, $param_descricao, $param_preco, $param_imagem);
    
    $param_nome = $nome;
    $param_descricao = $descricao;
    $param_preco = $preco;
    $param_imagem = $imagem;
    

    //tenta executar
    if(mysqli_stmt_execute($stmt)){
      return true;
    }else{
      header("Location: http://localhost/adminMain.php?msg=Falha ao criar o produto&type=danger");
    }
    return $data;
  }

  function deleteProduct($id){
    require("./banco/database.php");
    $imgPath = getProductById($id)["imagem"];
    $sql = "DELETE FROM produtos WHERE id=".$id;
    if(mysqli_query($db, $sql)){
      unlink($imgPath);
      header("Location: http://localhost/adminMain.php?msg=Produto Deletado com Sucesso&type=success");
    }else{
      header("Location: http://localhost/adminMain.php?msg=Falha ao deletar o produto&type=danger");
    }
  }

  function getProductById($id){
    require("./banco/database.php");
    $sql = "SELECT * FROM produtos where id=".$id;
    $result = mysqli_query($db, $sql);
    if($result!=null){
      return mysqli_fetch_assoc($result);
    }else{
      return false;
    }
  }

  function updateProduct($id, $nome, $descricao, $preco, $imagem=false){
    require("./banco/database.php");
    $oldPath = getProductById($id)["imagem"];
    if($imagem == false){
      $imagem = $oldPath;
    }else{
      unlink($oldPath);
    }

    $sql = "UPDATE produtos SET 
      nome='".$nome."',
      descricao='".$descricao."',
      preco='".$preco."',
      imagem='".$imagem."'
      WHERE id=".$id;

    if (mysqli_query($db, $sql)) {
     return true; 
    }else{
      header("Location: http://localhost/adminMain.php?msg=Falha ao Atualizar o prodduto&type=danger");
    }
  }

  function viewProduct($id){
    require("./banco/database.php");
    $sql = "UPDATE produtos SET view=view+1 WHERE id=".$id;
    if (mysqli_query($db, $sql)) {
     return true; 
    }
  }

  function getMostViewedProducts(){
    require("./banco/database.php");
    $sql = "SELECT * FROM produtos order by view desc limit 8";
    $result = mysqli_query($db, $sql);
    if($result!=null){
        if(mysqli_num_rows($result) > 0){
        $produtos = array();
        while($produtoAtual = mysqli_fetch_array($result)){
          array_push($produtos, $produtoAtual);
        }
        return $produtos;
        }else{
        return false;
        }
    }
  }

  function generateProductHTML($product){
    echo '
    <div class="card p-1 pt-3 m-2">
        <a href="./product.php?id='.$product["id"].'" class="text-dark">
        <img src="'.$product["imagem"].'"
        class="card-img-top" alt="placeholder" style="width: 250px;"/>
        <div class="d-flex">
            <h5 class="card-title mr-auto ml-2">'.$product["nome"].'</h5>
            <p class="mr-1">'.$product["view"].'<i class="bi-eye pl-1"></i></p>
        </div>
        </a>
        <div class="d-flex justify-content-around font-weight-bold mt-4">
            <span class="pt-1">$'.number_format($product["preco"], 2, ',', '.').'</span><span><a href="./addProductToCart.php?id='.$product["id"].'" class="btn btn-success mb-2">Adicionar</a></span>
        </div>
    </div>
    ';
  }
?>