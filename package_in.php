<?php

session_start();
require 'db.php';

// print_r($_SESSION);
$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['plan'])) {

        $plan = $_POST['plan'];
        $id = $row['id'];

        $sql = "UPDATE `users` SET subscription = '$plan' WHERE id = $id";

        if (mysqli_query($con, $sql)) {
            header("Location: user_dashboard.php");
            exit; 
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
}
?>
