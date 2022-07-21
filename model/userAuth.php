<?php
 include_once("database.php");
 function getUsers($db){
    $result = mysqli_query($db, 'SELECT username from users');
    if (!$result) {
        die('Invalid query: ');
    }
    while($row = $result->fetch_assoc()) {
        echo "Name: " . $row["username"];
    }
    return $result;
 }
 getUsers($db)
?>