
<?php
  require("./banco/userAuth.php");
  if(!isset($title)){
    $title = "";
  }
?>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="./">LojaVirtual</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
          <a class="nav-item nav-link <?php
           if($title == "Home"){
            echo "active";
            }
          ?>" href="./" data-toggle="tooltip" data-placement="bottom" title="Início">
            Início
          </a>
          <?php
            if(isUserLogged()){
              echo'
                <a class="nav-item nav-link " href="./logout.php" data-toggle="tooltip" data-placement="bottom" title="Deslogar">
                  Deslogar
                </a>               
                ';
              }else{
                if($title == "Logar"){
                  $active = "active";
                }else{
                  $active = "";
                }
                echo'
                  <a class="nav-item nav-link '.
                  $active
                  .'" href="./login.php" data-toggle="tooltip" data-placement="bottom" title="Logar">
                    Logar
                  </a>
                ';
              }
          ?>
        </div>
        <form class="d-flex input-group mr-2" method="POST" action="./search.php">
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
        <div class="navbar-nav">
        <a class="nav-item nav-link <?php
           if($title == "Carrinho"){
            echo "active";
          }
        ?>" href="./cart.php" data-toggle="tooltip" data-placement="bottom" title="Carrinho">
          <i class=" bi-cart-fill"></i>
        </a>
        <?php
        if(isUserLogged()){
          if($title == "Profile"){
            $active = "active";
          }else{
            $active = "";
          }
          echo '
          <a class="nav-item nav-link '.
          $active
          .'" href="./profile.php" data-toggle="tooltip" data-placement="bottom" title="Perfil">
            <i class=" bi-person-fill"></i>
          </a>';
        }
        if(isAdmin()){
          if($title == "Admin"){
            $active = "active";
          }else{
            $active = "";
          }
          echo '
            <a class="nav-item nav-link '.
            $active
            .'" href="./adminMain.php" data-toggle="tooltip" data-placement="bottom" title="Admin">
              <i class=" bi-tools"></i>
            </a>
          ';
        }
        ?>
        </div>
      </div>
    </div>
</nav>