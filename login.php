<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <style>
        body{
            /* background-color:#ADD8E6; */
            background:url('img.jpg');
            background-repeat:no-repeat;
            background-size:100% 700px;
        }
         .body{
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
        .link{
            
            margin-left:200px;
            margin-right:200px;
        }
        </style>
</head>
<body>  
    <div class="body">
<?php
session_start();      

    require('db.php');
    if(isset($_SESSION['email']) || isset($_SESSION['admin_email'])) {
       
    echo "Sorry, another user is already logged in. Please log out to continue.";
    exit();
    }
    if(isset($_COOKIE['emailid']) && isset($_COOKIE['password'])){
        $emailid = $_COOKIE['emailid'];
        $password = $_COOKIE['password'];
    }else{
        $emailid=$password="";
    }
    if (isset($_POST['email'])) {
        // print_r($_POST);
        $email = stripslashes($_REQUEST['email']); 
        $email = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $query    = "SELECT * FROM `users` WHERE email='$email'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $user_data = mysqli_fetch_assoc($result);
            if ($user_data['login'] == 1) {
            $_SESSION['email'] = $email;
            if(isset($_REQUEST['rememberme'])){
                setcookie('emailid',$_REQUEST['email'],time()+20);
                setcookie('password',$_REQUEST['password'],time()+20);
            }else{
                setcookie('emailid',$_REQUEST['email'],time()-10);
                setcookie('password',$_REQUEST['password'],time()-10);
            }
    
            
            if ($user_data['role'] == 'customer') {
                $_SESSION['email'] = $user_data['email'];

                if($user_data['subscription']==""){
                header("Location: package.php"); // Redirect to user dashboard
                exit();
            }else{
                    header("Location: user_dashboard.php");
                }
            } elseif ($user_data['role'] == 'admin') {
                $_SESSION["is_admin"] = true;
                $_SESSION["admin_email"] = $_POST["email"];
                header("Location: dashboard.php"); // Redirect to admin dashboard
                exit();
            }}else{
                echo "<div class='form'>
                  <h3>Status is Inactive</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
            }} else {
            echo "<div class='form'>
                  <h3>Incorrect email/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    }  else {
?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="email" placeholder="email" value="<?php echo $emailid; ?>" autofocus="true"/><br><br>
        <input type="password" class="login-input" name="password" placeholder="Password" value="<?php echo $password; ?>"/><br><br>
        <input type="checkbox" class="login-input" name="rememberme" id="rememberme"/><label for="rememberme">Remember me</label><br><br>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="registration.php" style="text-decoration:none;
            border:1px solid black;
            background-color:red;
            color:black;
            font-weight:bold;">New Registration</a></p>
  </form>
<?php
    }
?>
</div>
</body>
</html>