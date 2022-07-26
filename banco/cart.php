<?php


  function getCart(){
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    return $_SESSION["cart"];
  }

  function addProductToCart($id){
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    if(!isset($_SESSION["cart"])){
      $_SESSION["cart"] = array();
    }
    if(!isset($_SESSION["cart"][$id])){
      echo "eita";
      $_SESSION["cart"][$id] = 0;
    }
    $_SESSION["cart"][$id] +=  1;
  }
  
  function removeProductFromCart($id){
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    if(isset($_SESSION["cart"][$id]) && $_SESSION["cart"][$id] >= 0 ){
      $_SESSION["cart"][$id] -= 1;
    }
  }

  function getTotal(){
    $total = 0;
    foreach(getCart() as $id => $quantity){
      $product = getProductById($id);
      if(isset($product["desconto"])){
        $valorReal = ($product["preco"]/100)*(100 - $product["desconto"]);
        $total += $valorReal * $quantity;
      }else{
        $total += $product["preco"] * $quantity;
      }
    }
    return $total;
  }

?>