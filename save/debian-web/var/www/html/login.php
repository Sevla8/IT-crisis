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
			<?php include 'component/header.php'; ?>
			<div class="jumbotron">
				<h2>Login</h2>
				<form action="control.php" method="post">
					<div class="form-group <?php if (!empty($_SESSION['username_err'])) echo 'has-error'; ?>">
						<label>Username</label>
						<input type="text" name="username" class="form-control" value="<?= $_SESSION['username'] ?>">
						<span class="help-block"><?= $_SESSION['username_err'] ?></span>
					</div>
					<div class="form-group <?php if (!empty($_SESSION['password_err'])) echo 'has-error'; ?>">
						<label>Password</label>
						<input type="password" name="password" class="form-control">
						<span class="help-block"><?= $_SESSION['password_err'] ?></span>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Login" name="login">
					</div>
					<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
				</form>
			</div>
		</div>
	</body>
</html>
