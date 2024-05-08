<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <style>
        body{
            background-color:#ADD8E6;
        }

        .body{
            border:2px solid black;
            margin-top:100px;
            margin-left:400px;
            margin-right:400px;
            margin-bottom:50px;
            background-color:#ADD8E6;
        }
        .form{
            padding:10px;
            text-align:center;

        }
        .anc{
            
            margin-left:200px;
            margin-right:200px;
        }
        .file-input-background {
            margin-left:188px;
            margin-right:100px;
            width: 150px;
            height: 115px;
            background-size: cover;
            background-position: center;
            cursor: pointer; /* Add cursor pointer to indicate clickability */
            border: 1px solid none; /* Add border for visual clarity */
        }
        </style>
</head>
<body>
    <?php
    include('header.php');
    ?>
<div class="body">
<?php
session_start();
require('db.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    if (isset($_REQUEST['email'])) {
        $email = stripslashes($_REQUEST['email']);
       $email = mysqli_real_escape_string($con, $email);

       $check_query = "SELECT * FROM `users` WHERE email = '$email'";
       $check_result = mysqli_query($con, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
    echo "<div class='form'>
          <h3>Email address is already registered.</h3><br/>
          <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
          </div>";
} else {
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $gender   = $_REQUEST['gender'];
        $phno     = $_REQUEST['phno'];
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $subscription =$_POST['subscription'];
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        date_default_timezone_set('Asia/Kolkata');
        $create_datetime = date("d-m-Y H:i:s");
        $role="customer";

        $target_dir = "uploads/"; // Directory where uploaded files will be saved
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["file"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                 htmlspecialchars( basename( $_FILES["file"]["name"]));
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    $files=  $_FILES["file"]["name"];
        $query    = "INSERT into `users` (username,gender,phno,email, password,subscription, create_datetime,role,files)
                     VALUES ('$username','$gender','$phno','$email','" . md5($password) . "','$subscription','$create_datetime','$role','$files')";
        $result   = mysqli_query($con, $query);

        if ($result) {
            $inserted_id = mysqli_insert_id($con);
            $mail = new PHPMailer(true);
            
            // Server settings
            $mail->isSMTP(); 
            $mail->Host       = 'smtp.gmail.com';  // Specify SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'massdiwa007@gmail.com'; // SMTP username
            $mail->Password   = 'yqqo dqid sgln ouwr';   // SMTP password
            $mail->SMTPSecure = 'tls';            // Enable TLS encryption
            $mail->Port       = 587;              // TCP port to connect to
            
            // Recipients
            $mail->setFrom('massdiwa007@gmail.com', 'Diwa'); // Your email and name
            $mail->addAddress($email, $username); // Recipient email and name
            
            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Registration Successful';
            $mail->Body    = "Dear $username,<br><br>ID:$inserted_id<br><br>Name:$username<br><br>Gender:$gender<br><br>Phone:$phno<br><br>Role:$role<br><br>Registered Time:$create_datetime<br><br>Uploaded File:$files<br><br>Thank you for registering with us.<br><br>Your account has been successfully created.";
            
            // Send email
            if ($mail->send()) {
                echo "<div class='form'>
                      <h3>You are registered successfully.</h3><br/>
                      <p class='link'>Click here to <a href='dashboard.php'>Dashboard</a></p>
                      </div>";
            } else {
                echo "<div class='form'>
                      <h3>Registration successful, but there was an error sending the confirmation email.</h3><br/>
                      <p class='link'>Click here to <a href='login.php'>Login</a></p>
                      </div>";
            }
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='admin_reg.php'>registration</a> again.</p>
                  </div>";
        }
    } 
} else {
?>
<?php

$sql = "SELECT * FROM packages";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    

?>
    <form class="form" action="" method="post" enctype="multipart/form-data">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required /><br><br>
        <label for="Gender">Gender:</label>
        <input type="radio" class="login-input" name="gender" value="Male" required>
        <label for="Male" value="Male">Male</label>
        <input type="radio" class="login-input" name="gender" value="Female" required>
        <label for="Female" value="Female">Female</label><br><br>
        <input type="number" class="login-input" name="phno" placeholder="Phone Number"><br><br>
        <input type="text" class="login-input" name="email" placeholder="Email Adress"><br><br>
        <label for="role">Role:</label>
        <select name="role">
            <option>Select Your Option</label>
            <option value="admin">admin</option>
            <option value="customer">customer</option>
    </select><br><br>
    <label for="subscription">Subscription:</label>
        <select name="subscription" id="subscription">
            <option>Select Your Option</label>
            <?php while($row = mysqli_fetch_assoc($result)){ ?>
            <option value="<?php echo $row['pac_id']; ?>"><?php echo $row['package']; ?></option>
            <?php } ?>
    </select><br><br>
        <input type="password" class="login-input" name="password" placeholder="Password"><br><br>
        <label for="file">Choose your file:</label>
    <input type="file" id="fileInput" name="file" hidden><br><br>
    <div id="fileInputBackground" class="file-input-background"></div><br><br>
        <input type="submit" name="submit" value="Register" class="login-button">
        <!-- <p class="anc"><a href="login.php" style="text-decoration:none;
            border:1px solid black;
            background-color:red;
            color:black;
            font-weight:bold;">Click to Login</a></p> -->
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var fileInput = document.getElementById('fileInput');
            var fileInputBackground = document.getElementById('fileInputBackground');

            fileInputBackground.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        fileInputBackground.style.backgroundImage = "url('" + e.target.result + "')";
                    };

                    reader.readAsDataURL(fileInput.files[0]);
                }
            });
        });
    </script>
    <?php
    }

    ?>
<?php
    }
?>
</div>
<?php
    include('footer.php');
    ?>
</body>
</html>