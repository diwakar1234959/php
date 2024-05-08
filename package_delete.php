<?php
require_once "db.php";
    $id = $_GET["pac_id"];
    // echo"$id";  
    $query = "DELETE FROM packages WHERE pac_id = '$id'";
    if ($con->query($query)==TRUE){
        header("location: dashboard.php");
    } else {
         echo "Something went wrong".$con->query($query);
    }
?> 