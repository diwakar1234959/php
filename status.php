<?php
session_start();
require_once "db.php";
if(isset($_POST["submit"])){

if (empty($_SESSION["admin_email"])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['id']) && isset($_POST['status']) && isset($_POST['price'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $price = $_POST['price'];
    $newStatus = ($status == 1) ? 0 : 1;

    // Update the status in the database
   $sql = "UPDATE users SET `status` = '$newStatus', `price`='$price' WHERE id = $id";


    if (mysqli_query($con, $sql)) {
        // Status updated successfully
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating status: " . mysqli_error($con);
    }
} else {
    echo "Invalid request";
}
}
?>
