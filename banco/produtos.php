<!-- 
   CREATE TABLE `produtos` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(255) NOT NULL,
    `descricao` VARCHAR(255) NOT NULL,
    `preco` DECIMAL(10,2) NOT NULL,
    `imagem` VARCHAR(255) NOT NULL,
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
          array_push($produtos, array(
            "id" => $produtoAtual["id"],
            "nome" => $produtoAtual["nome"],
            "descricao" => $produtoAtual["descricao"],
            "preco" => $produtoAtual["preco"],
            "imagem" => $produtoAtual["imagem"]
          ));
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
    $sql = "DELETE FROM produtos WHERE id=".$id;
    if(mysqli_query($db, $sql)){
      header("Location: http://localhost/adminMain.php?msg=Produto Deletado com Sucesso&type=success");
    }else{
      header("Location: http://localhost/adminMain.php?msg=Falha ao deletar o produto&type=danger");
    }
  }
?>