<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>French Leather SA</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	</head>
	<body>
		<div class="container">
			<?php include 'component/header.php'; ?>
			<div class="jumbotron">
				<h2>Sign Up</h2>
				<p>Please fill this form to create an account.</p>
				<form action="control.php" method="post">
					<div class="form-group <?php if (!empty($_SESSION['username_err'])) echo 'has-error'; ?>">
						<label>Username</label>
						<input type="text" name="username" class="form-control" value="<?php echo $_SESSION['username']; ?>">
						<span class="help-block"><?php echo $_SESSION['username_err']; ?></span>
					</div>
					<div class="form-group <?php if (!empty($_SESSION['password_err'])) echo 'has-error'; ?>">
						<label>Password</label>
						<input type="password" name="password" class="form-control" value="<?php echo $_SESSION['password']; ?>">
						<span class="help-block"><?php echo $_SESSION['password_err']; ?></span>
					</div>
					<div class="form-group <?php if (!empty($_SESSION['confirm_password_err'])) echo 'has-error'; ?>">
						<label>Confirm Password</label>
						<input type="password" name="confirm_password" class="form-control" value="<?php echo $_SESSION['confirm_password']; ?>">
						<span class="help-block"><?php echo $_SESSION['confirm_password_err']; ?></span>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Submit" name="register">
						<input type="reset" class="btn btn-default" value="Reset">
					</div>
					<p>Already have an account? <a href="login.php">Login here</a>.</p>
				</form>
			</div>
		</div>
	</body>
</html>
