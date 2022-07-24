<?php
    $title="Home";
    // require("model/userAuth.php");
    include_once("./view/base/top.php");
    include_once("./banco/produtos.php");
    include_once("./view/topNavBar.php");
    
?>

    <!-- Banner -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="//via.placeholder.com/500x100/123476" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="//via.placeholder.com/500x100/1234ff" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="//via.placeholder.com/500x100/12ff00" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
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

 
