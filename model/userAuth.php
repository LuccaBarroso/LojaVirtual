<?php
 function getUsers(){
    global $db;
    $result = $db->query('SELECT username from users');
    if (!$result) {
        die('Invalid query: ');
    }
    while($row = $result->fetch_assoc()) {
        echo "Name: " . $row["username"];
    }
    return $result;
 }
?>