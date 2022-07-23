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
        <div class="row">
            <?php
                $mostViewdProducts = getMostViewedProducts();
                if($mostViewdProducts != null){
                    foreach($mostViewdProducts as $product){
                        echo '
                        <div class="card p-1 pt-3 m-2">
                            <a href="./product.php?id='.$product["id"].'" class="text-dark">
                            <img src="'.$product["imagem"].'"
                            class="card-img-top" alt="placeholder" style="width: 250px;"/>
                            <div class="d-flex">
                                <h5 class="card-title mr-auto ml-2">'.$product["nome"].'</h5>
                                <p class="mr-1">'.$product["view"].'<i class="bi-eye pl-1"></i></p>
                            </div>
                            </a>
                            <div class="d-flex justify-content-around font-weight-bold mt-4">
                                <span class="pt-1">$'.number_format($product["preco"], 2, ',', '.').'</span><span><a href="./" class="btn btn-success mb-2">Adicionar</a></span>
                            </div>
                        </div>
                        ';
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
                    echo '
                    <div class="card p-1 m-2">
                    <a href="./product.php?id='.$product["id"].'" class="text-dark">
                    <img src="'.$product["imagem"].'"
                    class="card-img-top" alt="placeholder" style="width: 250px;"/>
                    <div class="d-flex">
                    <h5 class="card-title mr-auto ml-2">'.$product["nome"].'</h5>
                    <p class="mr-1">'.$product["view"].'<i class="bi-eye pl-1"></i></p>
                    </div>
                    </a>
                    <div class="d-flex justify-content-around font-weight-bold mt-4">
                    <span class="pt-1">$'.number_format($product["preco"], 2, ',', '.').'</span><span><a href="./" class="btn btn-success mb-2">Adicionar</a></span>
                    </div>
                    </div>
                    ';
                }
            }
            ?>
        </div>
    </div>
    <!-- Footer -->

<?php
    include_once("./view/base/bottom.php");
?>

 
