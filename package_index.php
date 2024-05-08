<?php

?>

<!DOCTYPE html>
<head>
    <script src="https://kit.fontawesome.com/bc0d876b43.js" crossorigin="anonymous"></script>
    <title>Admin</title>
    <style>
        body{
            background-color:#ADD8E6;
            margin-top:100px;
            margin-left:200px;
            margin-right:200px;
        }
        .table{
            text-align:center;
        }
        table {
   border: 1px solid black;
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  border: 1px solid black;
}a{
    text-decoration:none;
}

/* tr:hover {
    background-color: coral;
} */
        </style>
</head>
<body>
<?php
  include('header.php');
  ?>
    <div class="table">
        <h1>Package Management Table</h1>
        <!-- <button><a href="logout.php">Logout</a></button><br><br> -->
        <button><a href="package_reg.php">Package Register</a></button><br><br>
    <?php
    session_start();
    require_once "db.php";

    if (empty( $_SESSION["admin_email"])) {
    header("Location: login.php");
    exit();
     }
   
    $sql = "SELECT * FROM packages";
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
            echo '<table>';
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>Id</th>";
                        echo "<th>Package</th>";
                        echo "<th>Price</th>";
                        echo "<th>Duration</th>";
                        echo "<th>Edit</th>";
                        echo "<th>Delete</th>";
                        
                        
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                        echo "<td>" . $row['pac_id'] . "</td>";
                        echo "<td>" . $row['package'] . "</td>";
                        echo "<td>" . $row['pac_price'] . "</td>";
                        echo "<td>" . $row['duration'] . "</td>";
                        echo "<td><a href='package_up.php?id=" . $row["pac_id"] . "' class='edit'><i class='fa-solid fa-pen' style='color: black;'></i></a></td>";
                        echo "<td><a href='package_delete.php?id=" . $row["pac_id"] . "' class='edit'><i class='fa-solid fa-trash' style='color: black;'></i></a></td>";
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
</body>
<?php
  include('footer.php');
  ?>
</html>