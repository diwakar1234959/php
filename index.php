<!DOCTYPE html>
<html>
    <head>
        <title>Index</title>
        <style>
            
    body {
  font-family: Helvetica;
  margin: 0;
  background-color:black;
}
a {
  text-decoration: none;
  color: white;
}
.site-header { 
  border-bottom: 1px solid #000000;
  padding: .5em 1em;
  display: flex;
  justify-content: space-between;
}

.site-identity h1 {
  font-size: 1.5em;
  margin: .6em 0;
  display: inline-block;
}


.site-navigation ul, 
.site-navigation li {
  margin: 0; 
  padding: 0;
}

.site-navigation li {
  display: inline-block;
  margin: 1.4em 1em 1em 1em;
}
            
            img{
                width:100%;
                height:520px;
            }
            </style>
</head>
<body>
<header class="site-header">
  <div class="site-identity">
    <h1><a href="index.php">Reps & Dips</a></h1>
  </div>  
  <nav class="site-navigation">
    <ul class="nav">
      <li><a href="registration.php"style="font-weight:bold;">Register</a></li> 
      <li><a href="login.php"style="font-weight:bold;">Login<i class="fa-solid fa-right-from-bracket" style="color: #050505;"></i></a></li> 
    </ul>
  </nav>
</header>

<img src="img.jpg" alt="img">
    <?php
    include('footer.php');
    ?>
</body>
    </html>
