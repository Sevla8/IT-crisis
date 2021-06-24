<?php
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>French Leather SA</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body>
<div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" ><a href="index.php">Home</a></li>
            <li role="presentation"><a href="login.php">Login</a></li>
            <li role="presentation"><a href="register.php">Register</a></li>
            <li role="presentation"><a href="about.php">About</a></li>
            <li role="presentation"><a href="joinus.php">Join us</a></li>
          </ul>
        </nav>
        <a href="index.php"><img src="img/logo.jpg" height="70px"></a>
        <h3 class="text-muted">French Leather SA</h3>
      </div>

      <div class="text-center">
        <p><img src="img/tweet-5.png"></p>
        <p><img src="img/tweet-4.png"></p>
        <p><img src="img/tweet-3.png"></p>
        <p><img src="img/tweet-2.png"></p>
        <p><img src="img/tweet-1.png"></p>
      </div>

  <?php
    if (isset($_SESSION['message']) && $_SESSION['message'])
    {
      printf('<b>%s</b>', $_SESSION['message']);
      unset($_SESSION['message']);
    }
  ?>
  
</body>
</html>
