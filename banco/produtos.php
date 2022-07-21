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
  //retorna 20 produtos
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
?>