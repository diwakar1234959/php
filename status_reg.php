<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <style>
        body{
            border:2px solid black;
            margin-top:100px;
            margin-left:400px;
            margin-right:400px;
            background-color:#ADD8E6;
        }
        .form{
            padding:10px;
            text-align:center;
        }
        a{
            text-decoration:none;
            border:1px solid black;
            background-color:red;
            color:black;
            font-weight:bold;
        }
    </style>
</head>
<body>
<?php
session_start();
require('db.php');

// Ensure admin is logged in
if (empty($_SESSION["admin_email"])) {
    header("Location: login.php");
    exit();
}

// Check if user ID is provided in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query user information based on ID
    $sql = "SELECT * FROM users u LEFT JOIN packages p ON u.subscription = p.pac_id WHERE id=$id";
    if($result = mysqli_query($con, $sql)) {
        if(mysqli_num_rows($result) >= 1) {
            if($row = mysqli_fetch_assoc($result)) {
?>
    <form class="form" action="status.php" method="POST">
        <h1 class="login-title">Status</h1>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> <!-- Hidden input for user ID -->
        <input type="text" class="login-input" name="package" placeholder="Package"value="<?php echo $row['package']; ?>" /><br><br>
        <input type="number" class="login-input" name="price" placeholder="Price"><br><br>
        <input type="hidden" name="status" value="<?php echo $row['status']; ?>">
        <!-- <input type="number" class="login-input" name="status" placeholder="Status"value="<?php echo $row['status']; ?>"><br><br> -->
        <!-- <input type="text" class="login-input" name="duration" placeholder="Duration"><br><br> -->
        <input type="submit" value="Pay" name="submit" class="submit">
    </form>
<?php
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "Error querying user information.";
    }
} else {
    echo "User ID not provided.";
}
mysqli_close($con);
?>
</body>
</html>
