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
        <div class="row">
            <?php
            $products = getProducts();
                if($products != null){
                    foreach($products as $product){
                        echo '
                        <div class="card p-1 m-2">
                            <a href="./product.php?id='.$product["id"].'" class="text-decoration-none text-dark">
                            <img src="'.$product["imagem"].'"
                            class="card-img-top" alt="placeholder" style="width: 250px;"/>
                            <div class="text-center d-flex flex-column justify-content-center align-items-center pt-2" style="height:100px;">
                                <h5 class="card-title">'.$product["nome"].'</h5>
                                <p class="mb-4 w-75">'.$product["descricao"].'</p>
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
        <?php
            if($products == null){
                    echo '
                    <div class="text-center">
                        <h5 class="card-title">Desculpe! ainda não temos produtos cadatrados!</h5>
                    </div>
                    ';
            }
        ?>
    </div>
    <!-- Footer -->

<?php
    include_once("./view/base/bottom.php");
?>

 
