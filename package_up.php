<!DOCTYPE html>
<html lanh="en">
    <head>
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
    <div class="body">
<?php 

                require_once "db.php";
                $sql_query = "SELECT * FROM packages WHERE pac_id = ". $_GET["id"];
        
                if ($result = $con->query($sql_query)) {
                    while ($row = $result->fetch_assoc()) { 
                        $id = $row['pac_id'];
                        $package = $row['package'];
                        $price = $row['pac_price'];
                        $duration = $row['duration'];
                        
            ?>
  <form class="form" action="package_up_data.php?id=<?php echo $id;?>" method="post">
        <h1 class="login-title">Update Package</h1>
        <input type="text" class="login-input" name="package" placeholder="Package" value="<?php echo $package ?>"><br><br>
        <input type="number" class="login-input" name="pac_price" placeholder="Price"value="<?php echo $price ?>"><br><br>
        <input type="text" class="login-input" name="duration" placeholder="Duration"value="<?php echo $duration ?>"><br><br>
        <input type="submit" name="submit" value="submit" class="login-button">
    </form>
<?php
                    }
                }
?>
</body>
    </html>
