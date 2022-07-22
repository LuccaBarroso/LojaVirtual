<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="./">LojaVirtual</a>
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="./">Home</a>
        </li>
        <?php
          session_start();
          if(isset($_SESSION["logado"]) && $_SESSION["logado"]==true){
            echo '
            <a href="./">
              <button type="button" class="btn btn-default">
                <i class="bi-cart"></i>
              </button>
            </a>
            ';
          }else{
            echo '
            <li class="nav-item">
              <a class="nav-link" href="./login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./register.php">Register</a>
            </li>
            ';
          }
        ?>
       
      </ul>
      <div class="container-fluid">
        <form class="d-flex input-group" style="width:60%;">
        <input
            type="search"
            class="form-control rounded"
            placeholder="Search"
            aria-label="Search"
            aria-describedby="search-addon"
        />
            <span class="input-group-text border-0 ml-2" id="search-addon">
                <i class="fas bi-search"></i>
            </span>
        </form>
        </div>
    </div>
  </div>
  <!-- TODO só mostrar se tiver deslogado -->
  <a href="./logout.php">
    <button type="button" class="btn btn-outline-primary">
      <i class="bi-box-arrow-right"></i>
    </button>
  </a>
</nav>