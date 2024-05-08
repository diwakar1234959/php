<?php

?>

<!DOCTYPE html>
<head>
    <script src="https://kit.fontawesome.com/bc0d876b43.js" crossorigin="anonymous"></script>
    <title>Admin</title>
    <style>
        body{
            background-color:#ADD8E6;
            margin-top:50px;
            margin-left:170px;
            margin-right:200px;
            margin-bottom:100px;
        }
        .table{
            text-align:center;
            /* border:1px solid none; */
            margin-left:142px;
            /* margin-right:100px; */
        }
        table {
   border: 1px solid black;
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 5px;
  border: 1px solid black;
}
a{
    text-decoration:none;
}

/* tr:hover {
    background-color: coral;
} */



.sidenav {
  height: 94.6%;
  width: 140px;
  position: absolute;
  z-index: 1;
  /* top: 0; */
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

. {
  margin-left: 160px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}   

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
        </style>
</head>
<body>
    <div class="header">
    <?php 
    include('header.php');
    ?>
    </div>
    <div class="sidenav">
  <a href="admin_reg.php">Admin Register</a>
  <a href="package_index.php">Package Register</a>
</div>
    
    <div class="table">
        <h1>Gym User Table</h1>
        <!-- <a href="admin_reg.php">Admin Register <i class="fa-solid fa-user-tie" style="color: #050505;"></i></a><br><br>
        <button><a href='package_index.php' class='edit'>Package Management</a></button><br><br> -->
    <?php
    session_start();
    require_once "db.php";

    if (!isset( $_SESSION["admin_email"])) {
    header("Location: login.php");
    exit();
     }
    //  $users_id = $_SESSION['id'];
    // $sql = "SELECT * FROM users";    
    $sql = "SELECT * FROM users u LEFT JOIN packages p ON u.subscription = p.pac_id";

    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
            echo '<table>';
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>Id</th>";
                        echo "<th>Name</th>";
                        echo "<th>Gender</th>";
                        echo "<th>Phone No</th>";
                        echo "<th>Email</th>";
                        echo "<th>Subscription</th>";
                        // echo "<th>Subscription_id</th>";
                        echo "<th>Price</th>";
                        echo "<th>Date&Time</th>";
                        echo "<th>Status</th>";
                        echo "<th>Login Status</th>";
                        echo "<th>Role</th>"; 
                        echo "<th>File</th>";
                        echo "<th>Action</th>";
                        // echo "<th>View</th>";
                        // echo "<th>Delete</th>";
                        
                        
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td>" . $row['phno'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        // echo "<td>" . $row['subscription'] . "</td>";
                        echo "<td>" . $row['package'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $row['create_datetime'] . "</td>";
                        echo "<td>";
                        echo ($row['status'] == 1) ? "<a href='status_reg.php?id=".$row["id"]."' class='edit'>Paid</a>" : "<button><a href='status_reg.php?id=".$row["id"]."' class='edit'>Not Paid</a></button>";
                        echo "</td>";
                        echo "<td>";
                        echo ($row['login'] == 1) ? "<a href='login_sta_reg.php?id=".$row["id"]."' class='edit'>active</a>" : "<a href='login_sta_reg.php?id=".$row["id"]."' class='edit'>inactive</a>";
                        echo "</td>";
                        echo "<td>" . $row['role'] . "</td>";
                        echo "<td>";
                        echo '<img src="uploads/' . $row["files"] . '" alt="Uploaded Image" width="50px" height="50px">';
                        echo "</td>";
                        

                        // echo "<td></td>";
                        echo "<td>";
                        echo "<a href='up.php?id=" . $row["id"] . "' class='edit'><i class='fa-solid fa-pen' style='color: black;'></i></a><br>";
                        echo "<a href='view.php?id=" . $row["id"] . "' class='edit'><i class='fa-solid fa-eye' style='color: black;'></i></a><br>";
                        echo "<a href='delete.php?id=" . $row["id"] . "' class='edit'><i class='fa-solid fa-trash' style='color: black;'></i></a><br>";
                        echo "</td>";
                        
                        echo "</tr>";
                }
                echo"</tbody>";
            echo"</table>";
            mysqli_free_result($result);
        }else{
            echo "No records found";
        }
    }else{
        echo "Please try again";
    }

    
    mysqli_close($con);
?>

                                </div>
                                <div clas="footer">
                                <?php 
include('footer.php');
?>
</div>
</body>
</html>