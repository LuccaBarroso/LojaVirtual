<?php
    $title="Home";
    // require("model/userAuth.php");
    include_once("./view/base/top.php");
    include_once("./banco/produtos.php");
    include_once("./view/base/initSection.php");
    
?>

    <!-- Banner -->
    <!-- Mostrar Produtos -->
    <div class="container p-2">
        <h4 class="row pt-4">Produtos mais vistos:</h4>
        <div class="row text-center">
            <?php
                $mostViewdProducts = getMostViewedProducts();
                if($mostViewdProducts != null){
                    foreach($mostViewdProducts as $product){
                        echo generateProductHTML($product);
                    }
                }
                ?>
        </div>
        <h4 class="row pt-4">Todos os Produtos:</h4>
        <div class="row">
            <?php
            $products = getProducts();
            if($products != null){
                foreach($products as $product){
                    echo generateProductHTML($product);
                }
            }
            ?>
        </div>
    </div>
    <!-- Footer -->

<?php
    include_once("./view/base/bottom.php");
?>

 
