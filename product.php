<?php
    $title="Home";
    // require("model/userAuth.php");
    include_once("./view/base/top.php");
    include_once("./banco/produtos.php");
    include_once("./view/topNavBar.php");

    $product = getProductById($_GET["id"]);
    viewProduct($_GET["id"]);
    
?>
  <div class="card lg m-auto p-3" style="width: 500px;">
        <img src="<?php echo $product["imagem"] ?>"
        class="card-img-top" alt="placeholder" style="width: 460px;"/>
        <div class="text-center d-flex flex-column justify-content-center align-items-center pt-2" style="height:100px;">
        <div class="mb-1">
          <h5 class="card-title d-inline"><?php echo $product["nome"] ?></h5>
          <p class="mr-1 d-inline"><?php echo $product["view"] ?><i class="bi-eye pl-1"></i></p>
        </div>
            <p><?php echo $product["descricao"] ?></p>
        </div>
        <div class="d-flex justify-content-around font-weight-bold mt-4">
            <span class="pt-1">$<?php echo number_format($product["preco"], 2, ',', '.')?></span>
            <span><a href="./" class="btn btn-success mb-2">Adicionar ao Carrinho</a></span>
        </div>
  </div>

<?php
    include_once("./view/base/bottom.php");
?>