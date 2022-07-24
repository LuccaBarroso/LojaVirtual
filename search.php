<?php
    $title="Pesquisa";
    // require("model/userAuth.php");
    include_once("./view/base/top.php");
    include_once("./banco/produtos.php");
    include_once("./view/topNavBar.php");
    include_once("./banco/banner.php");
    
    $pesquisa = $_POST["search"];

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
        <h4 class="row pt-4">Resultado da pesquisa por <?php echo $pesquisa?>:</h4>
        <div class="row text-center">
            <?php
                $result = getSearchResult($pesquisa);
                if($result != null){
                    foreach($result as $product){
                        echo generateProductHTML($product);
                    }
                }else{
                  echo '<div class="col-12">
                          <div class="alert alert-danger" role="alert">
                            Desculpe! Nenhum produto encontrado com esse(s) termo.
                          </div>
                        </div>';
                }
                ?>
                <div class="col-12">
                    <a href="index.php" class="btn btn-primary">Voltar para a página inicial</a>
                </div>
        </div>
    </div>
  </div>

<?php
    include_once("./view/base/bottom.php");
?>

 
