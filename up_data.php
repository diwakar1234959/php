<?php
require_once "db.php";
session_start();

if(isset($_POST["submit"]) && isset($_GET["id"])) {
    $id = $_GET['id'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $phno = $_POST['phno'];
    $email = $_POST['email'];
    $subscription = $_POST['subscription'];

    // Check if a file is uploaded
    if(isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        $file_name = $_FILES["file"]["name"];
        $file_tmp = $_FILES["file"]["tmp_name"];
        
        // Move the uploaded file to a permanent location
        $upload_directory = "uploads/";
        $file_destination = $upload_directory . basename($file_name);
        
        if(move_uploaded_file($file_tmp, $file_destination)) {
            // Update the database with the new file information
            $sql = "UPDATE users SET `username`= '$username', `gender`= '$gender', `phno`= '$phno', `email`= '$email', `subscription`= '$subscription', `files`= '$file_name' WHERE id= $id";
            
            echo "SQL Query: $sql<br>"; // Debugging statement
            
            if ($con->query($sql) === TRUE) {
                $redirectPage = ($_SESSION['email'] == $email) ? "user_dashboard.php" : "dashboard.php";
                header("location: $redirectPage");
                exit();
            } else {
                echo "Error updating record: " . $con->error;
            }
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        // If no file is uploaded, update other user details without changing the file
        $sql = "UPDATE users SET `username`= '$username', `gender`= '$gender', `phno`= '$phno', `email`= '$email', `subscription`= '$subscription' WHERE id= $id";
        
        echo "SQL Query: $sql<br>"; // Debugging statement
        
        if ($con->query($sql) === TRUE) {
            $redirectPage = ($_SESSION['email'] == $email) ? "user_dashboard.php" : "dashboard.php";
            header("location: $redirectPage");
            exit();
        } else {
            echo "Error updating record: " . $con->error;
        }
    }
} else {
    echo "Invalid request.";
}
?>
