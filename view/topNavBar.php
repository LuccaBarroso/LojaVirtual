
<?php
  require("./banco/userAuth.php");
?>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="./">LojaVirtual</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
          <a class="nav-item nav-link " href="./" data-toggle="tooltip" data-placement="bottom" title="Início">
            <i class="bi-house-fill"></i>
          </a>
          <?php
            if(isUserLogged()){
              echo'
                <a class="nav-item nav-link " href="./logout.php" data-toggle="tooltip" data-placement="bottom" title="Deslogar">
                  <i class=" bi-box-arrow-left"></i>
                </a>
                <a class="nav-item nav-link " href="./profile.php" data-toggle="tooltip" data-placement="bottom" title="Perfil">
                  <i class=" bi-person-fill"></i>
                </a>
                
                ';
              }else{
                echo'
                  <a class="nav-item nav-link " href="./login.php" data-toggle="tooltip" data-placement="bottom" title="Logar">
                    <i class=" bi-box-arrow-in-left"></i>
                  </a>
                ';
              }
              ?>
          <a class="nav-item nav-link " href="./cart.php" data-toggle="tooltip" data-placement="bottom" title="Carrinho">
            <i class=" bi-cart-fill"></i>
          </a>
      </div>
          <form class="d-flex input-group" method="POST" action="./search.php">
            <input
                type="text"
                class="form-control rounded"
                placeholder="Search"
                name="search"
            />
            <button class="input-group-text border-0 ml-2" id="search-addon">
                <i class="fas bi-search"></i>
            </button>
          </form>
    </div>
    </div>
</nav>