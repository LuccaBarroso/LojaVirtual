<?php
  include("banco/cart.php");
  removeProductFromCart($_GET["id"]);
  header("Location: http://localhost/cart.php");
?>