<?php
require_once "db.php";
    $id = $_GET["id"];
    // echo"$id";  
    $query = "DELETE FROM users WHERE id = '$id'";
    if ($con->query($query)==TRUE){
        header("location: dashboard.php");
    } else {
         echo "Something went wrong".$con->query($query);
    }
?> 