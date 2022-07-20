<?php
    require("model/database.php");
    require("model/userAuth.php");
    print_r(getenv("DB_PASSWORD"));
    ?>

<?php @include "./view/base/header.php" ?>

<?php @include "./view/topNavBar.php" ?>

<?php
    @include "./view/base/footer.php";
?>

 
