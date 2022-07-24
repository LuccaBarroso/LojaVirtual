<?php
    $title="Home";
    // require("model/userAuth.php");
    include_once("./view/base/top.php");
    include_once("./banco/produtos.php");
    include_once("./view/topNavBar.php");
    include_once("./banco/banner.php");


    $banners = getValidBanners();
    
?>

    <!-- Banner -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
                foreach($banners as $key => $banner){
                    echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.$key.'" class="'.($key == 0 ? 'active' : '').'"></li>';
                }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
                foreach($banners as $key => $banner){
                    echo '<div class="carousel-item '.($key == 0 ? 'active' : '').'">
                            <img class="d-block w-100" src="'.$banner["imagem"].'" alt="'.$banner["imagem"].'">
                        </div>';
                }
            ?>
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

 
