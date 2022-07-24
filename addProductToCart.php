<?php
  include("banco/cart.php");
  addProductToCart($_GET["id"]);
  header("Location: http://localhost/cart.php");
?>