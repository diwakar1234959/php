<?php
session_start();
require_once "db.php";
if(isset($_POST["submit"])){

if (empty($_SESSION["admin_email"])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['id']) && isset($_POST['login'])) {
    $id = $_POST['id'];
    $login = $_POST['login'];
    // $price = $_POST['price'];
    $new_login = ($login == 1) ? 0 : 1;

    // Update the login in the database
   $sql = "UPDATE users SET `login` = '$new_login' WHERE id = $id";


    if (mysqli_query($con, $sql)) {
        // login updated successfully
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating login: " . mysqli_error($con);
    }
} else {
    echo "Invalid request";
}
}
?>
