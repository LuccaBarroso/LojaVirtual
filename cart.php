<?php
  $title="Carrinho";
  include("banco/cart.php");
  include_once("./view/base/top.php");
  include_once("./banco/produtos.php");
  include_once("./view/topNavBar.php");
?>
    <div class="container p-2" style="min-height: 60vh;">
      <h4>Carrinho</h4>
      <hr>
      <?php
        if(isset($_SESSION["cart"])){
          foreach($_SESSION["cart"] as $id => $quantity){
            if($quantity > 0){
              $product = getProductById($id);
              echo'
              <div class="card row d-flex flex-row my-3" >
                <div class="col-md-6 m-auto float-left">
                  <img src="'.$product["imagem"].'" class="img-fluid rounded" style="height:100px">
                </div>
                <div class="col-md-6 text-center mt-2">
                  <h3>'.$product["nome"].'</h3>
                  <p>'.$product["descricao"].'</p>
                  <p>R$';

                  if(isset($product["desconto"])){
                    $valorReal = ($product["preco"]/100)*(100 - $product["desconto"]);
                    echo number_format($valorReal*$quantity, 2, ",", ".");
                  }else{
                    echo number_format($product["preco"]*$quantity, 2, ",", ".");
                  }

                  echo '</p>
                  <div class="row text-center m-3">
                    <a href="./removeProductFromCart.php?id='.$id.'" class="m-auto btn btn-danger p-2"><i class="bi-dash-lg"></i></a>
                    <p class="m-auto">Quantidade: '.$quantity.'</p>
                    <a href="./addProductToCart.php?id='.$id.'" class="m-auto  btn btn-danger p-2"><i class="bi-plus-lg" style="width:32px;"></i></a>
                  </div>
                </div>
              </div>
              ';
            }
          }
        }else{
          echo "<div class='alert alert-info'>Nenhum produto no carrinho</div>";
        }
      ?>
      <hr>
      <div class="row justify-content-md-center">
        <div class="m-auto col-lg-2">
          <a href="./" class="btn btn-primary p-2">Continuar comprando</a>
        </div>
        <div class="m-auto col-lg-2">
          <p class="card outline-primary m-auto p-2">Total: R$ <?php echo number_format(getTotal(), 2, ",", "."); ?></p>
        </div>
        <div class="m-auto col-lg-2">
          <a href="./" class="btn btn-success p-2">Finalizar compra</a>
        </div>
    </div>

<?php
    include_once("./view/base/bottom.php");
?>

 
