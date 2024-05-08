<?php
                require_once "db.php";
                
                if(isset($_GET["id"])) {

                    $id =  $_GET["id"];
                    $sql ="SELECT * FROM users WHERE id = '$id'";
                    $result = $con->query($sql);
					
                    if($result->num_rows > 0) {
                        // Fetch data and display it
                        while($row = mysqli_fetch_assoc($result)) {
                          $id = $row['id'];
                          $username = $row['username'];
                          $gender = $row['gender'];
                          $phno = $row['phno'];
                          $email = $row['email'];
                          $subscription = $row['subscription'];
                          $file = $row['files'];
				?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
<!-- Bootstrap CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<!-- Font Awesome CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
<title>View</title>
<style>
    body {
    background: #ADD8E6;
    
    padding: 0;
    margin: 0;
    font-family: 'Lato', sans-serif;
    color: #000;
}
.student-profile .card {
    border-radius: 10px;
}
.student-profile .card .card-header .profile_img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    margin: 10px auto;
    border: 10px solid #ccc;
    border-radius: 50%;
}
.student-profile .card h3 {
    font-size: 20px;
    font-weight: 700;
}
.student-profile .card p {
    font-size: 16px;
    color: #000;
}
.student-profile .table th,
.student-profile .table td {
    font-size: 14px;
    padding: 5px 10px;
    color: #000;
}
    </style>
</head>
<body>
<div class="student-profile py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent text-center">
            <img class="profile_img" src="uploads/<?php echo $row["files"];?>" alt="student dp">
            <h3><?php echo $row["username"]; ?></h3>
          </div>
          <div class="card-body">
            <p class="mb-0"><strong class="pr-1">ID:</strong><?php echo $row["id"]; ?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>
          </div>
          <div class="card-body pt-0">
            <table class="table table-bordered">
              <tr>
                <th width="30%">Gender</th>
                <td width="2%">:</td>
                <td><?php echo $row["gender"]; ?></td>
              </tr>
              <tr>
                <th width="30%">Phone Number</th>
                <td width="2%">:</td>
                <td><?php echo $row["phno"]; ?></td>
              </tr>
              <tr>
                <th width="30%">Email</th>
                <td width="2%">:</td>
                <td><?php echo $row["email"]; ?></td>
              </tr>
              <tr>
                <th width="30%">Subscription</th>
                <td width="2%">:</td>
                <td><?php echo $row["subscription"]; ?></td>
              </tr>
            </table>
          </div>
        </div>
          <div style="height: 26px"></div>
      
      </div>
    </div>
  </div>
</div>
</body>
    </html>
    <?php
}
                    }else{
                        echo "No data found for the provided ID.";
                    }
                }else{
                    echo "No ID provided.";
                }
?>