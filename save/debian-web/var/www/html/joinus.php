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
				<h1>Upload your CV here!</h1>
				<form method="POST" action="control.php" enctype="multipart/form-data">
					<div>
						<span>Upload a File:</span>
						<input type="file" name="uploadedFile" />
					</div>
					<input type="submit" name="uploadBtn" value="Upload" />
				</form>
			</div>
			<div>
				<?php
					if (isset($_SESSION['message']) && $_SESSION['message']) {
						printf('<b>%s</b>', $_SESSION['message']);
						unset($_SESSION['message']);
					}
				?>
			</div>
		</div>
	</body>
</html>
