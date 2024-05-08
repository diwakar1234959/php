<!DOCTYPE html>
<head>
<script src="https://kit.fontawesome.com/bc0d876b43.js" crossorigin="anonymous"></script>
    <title>User Details</title>
    <style>
        body {
            background-color: #ADD8E6;
            margin-top: 100px;
            margin-left: 300px;
            margin-right: 300px;
        }

        .table {
            text-align: center;
        }

        table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid black;
        }

        tr:hover {
            background-color: coral;
        }
        a{
            text-decoration:none;

        }
    </style>
</head>
<body>
    <?php
    include('header.php');
    ?>
<div class="table">
    <h1>User Details</h1>
    <!-- <button><a href="logout.php">Logout</a></button><br><br> -->
    <?php
    require_once "db.php";

    session_start();

    
    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        exit();
    }

    $email = $_SESSION['email'];
    $sql = "SELECT * FROM users u LEFT JOIN packages p ON u.subscription = p.pac_id WHERE email = '$email'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        ?>
        <table>
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Phone No</th>
                <th>Email</th>
                <th>Subscription</th>
                <th>File</th>
                <th>Edit</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['phno']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><button><a href="package.php"><?php echo $row['package']; ?></a></button></td>
                <td><?php
                $file_src = 'uploads/' . $row["files"]; ?>
                <img src="<?php echo $file_src; ?>" alt="Uploaded Image" width="50px" height="50px"></td>
                <td><a href="up.php?id=<?php echo $row["id"]; ?>" class="edit">
                <i class="fa-solid fa-pen" style="color: black;"></i>
						</a></td>
            </tr>
            </tbody>
        </table>
        <?php
    } else {
        echo "User details not found.";
    }

    mysqli_close($con);
    ?>
</div>
<?php
include('footer.php');
?>
</body>
</html>
