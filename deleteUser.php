<?php
     $title="Admin";
     include_once("./view/base/top.php");
     include_once("./view/topNavBarAdmin.php");
     include_once("./banco/userInfo.php");
     redirectIfNotAdmin();
?>

    

<?php
     include_once("./view/base/bottom.php");
?>