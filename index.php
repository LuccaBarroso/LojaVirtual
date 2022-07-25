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
                            <img class="d-block w-100" src="'.$banner["imagem"].'">
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
        <?php 
            $produtosComDesconto = getDiscountProducts();
            if($produtosComDesconto != null){
                echo '<h4 class="row pt-4">Produtos com Desconto:</h4>';
                echo '<Div class="row">';
                    foreach($produtosComDesconto as $product){
                        echo generateProductHTML($product);
                    }
                echo '</div>';
                
            }
        ?>

        <!-- newsletter -->
        <div class="row mt-3">
            <div class="card text-white bg-dark mt-3 col mr-2">
                <div class="card-body">
                    <h4 class="card-title">Newsletter</h4>
                    <p class="card-text">Preencha seu e-mail e fique por dentro dos melhores descontos.</p>
                    <form>
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu e-mail">
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
            <div class="mt-3 col">
                <?php
                    $product = getMostRecentProduct();
                    if($product != null){
                        echo '
                            <div class="card mt-3 m-auto">
                                <h4 class="card-title p-2">Nosso Mais novo Produto:</h4>
                                <div class="card-body row">
                                    <div class="col"><img class="d-block" src="'.$product["imagem"].'" style="height:200px;"/> </div>
                                    <div class="col text-center">
                                        <p class="card-text">'.$product["nome"].'</p>
                                        <p class="pt-1">R$'.number_format($product["preco"], 2, ',', '.').'</p>
                                        <a href="addProductToCart.php?id='.$product["id"].'" class="btn btn-primary">Adicionar</a>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                ?>
            </div>
        </div>
    </div>

<?php
    include_once("./view/base/bottom.php");
?>

 
