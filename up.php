<!DOCTYPE html>
<html lanh="en">
    <head>
    <style>
        .body{
            border:2px solid black;
            margin-top:100px;
            margin-left:400px;
            margin-right:400px;
            background-color:#ADD8E6;
        }
        .fm{
            padding:10px;
            text-align:center;

        }
        .submit{
            text-decoration:none;
            border:1px solid black;
            background-color:red;
            color:black;
            font-weight:bold;
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

                require_once "db.php";
                $sql_query = "SELECT * FROM users WHERE id = ". $_GET["id"];
        
                if ($result = $con->query($sql_query)) {
                    while ($row = $result->fetch_assoc()) { 
                        $id = $row['id'];
                        $username = $row['username'];
                        $gender = $row['gender'];
                        $phno = $row['phno'];
                        $email = $row['email'];
                        $subscription = $row['subscription'];
                        
            ?>
            <?php

$sql = "SELECT * FROM packages";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    

?>
<form class="fm" action="up_data.php?id=<?php echo $id;?>" method="post" enctype="multipart/form-data"> 
<h1>Update Form</h1><br>
        <input type="text" class="login-input" name="username" placeholder="Username" value="<?php echo $username ?>" required /><br><br>
        <label for="Gender">Gender:</label>
        <input type="radio" class="login-input" name="gender" value="Male" <?php if($gender == "Male"){ echo "checked"; } ?> required>
        <label for="Male" value="Male">Male</label>
        <input type="radio" class="login-input" name="gender" value="Female" <?php if($gender == "Female"){ echo "checked"; } ?> required>
        <label for="Female" value="Female">Female</label><br><br>
        <input type="number" class="login-input" name="phno" placeholder="Phone Number" value="<?php echo $phno ?>"><br><br>
        <input type="text" class="login-input" name="email" placeholder="Email Adress" value="<?php echo $email ?>"><br><br>
        <label for="subscription">Subscription:</label>
        <select name="subscription">
            <option>Select Your Option</label>
            <?php
    // Assuming you have already established a database connection and fetched $result
    while ($row = mysqli_fetch_assoc($result)) :
        // Check if the current 'pac_id' matches the selected subscription
        $selected = ($subscription == $row['pac_id']) ? "selected" : "";
    ?>
        <option value="<?= $row['pac_id'] ?>" <?= $selected ?>><?= $row['package'] ?></option>
    <?php endwhile; ?>
    </select><br><br>
    <label for="file">Choose your file:</label>
    <input type="file" id="fileInput" name="file" hidden><br><br>
    <div id="fileInputBackground" class="file-input-background"></div><br><br>
    <input type="submit" name="submit" value="Submit" class="submit" ><br><br>      
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
                }
?>
</div>  
<?php
include('footer.php');
?>
</body>
    </html>
