<?php

    require_once "db.php";
    session_start();
    if(isset($_POST["submit"])){
  
    if(isset($_GET["id"]) && isset($_POST["package"]) && isset($_POST["pac_price"]) && isset($_POST["duration"])){
        $id = $_GET['id'];
        $package = $_POST['package'];
        $price = $_POST['pac_price'];
        $duration = $_POST['duration'];
        $email = $_POST['email'];
        $subscription = $_POST['subscription'];

              

            
        $sql = "UPDATE packages SET `package`= '$package',`pac_price`= '$price', `duration`= '$duration' WHERE pac_id= $id";


        if ($con->query($sql)==TRUE) {
            header("location: package_index.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later.";
        }
    
    }
}
  
?>