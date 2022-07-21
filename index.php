<?php
    $title="Home";
    // require("model/userAuth.php");
    include_once("./view/base/top.php");
    include_once("./banco/produtos.php");
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
                            <img src="https://via.placeholder.com/250"
                            class="card-img-top" alt="placeholder" />
                            <div class="text-center">
                                <h5 class="card-title">'.$product["nome"].'</h5>
                                <p class="text-muted mb-4">'.$product["descricao"].'</p>
                            </div>
                            <div class="d-flex justify-content-around font-weight-bold mt-4">
                                <span class="pt-1">$'.number_format($product["preco"], 2, ',', '.').'</span><span><a href="./" class="btn btn-success">Adicionar</a></span>
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

 
