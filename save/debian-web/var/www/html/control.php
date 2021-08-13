<?php
	session_start();

	require_once 'model.php';

	if (isset($_POST['register'])) {
		control_register();
	}
	else if (isset($_POST['login'])) {
		control_login();
	}
	else if (isset($_POST['post'])) {
		control_post();
	}
	else if (isset($_POST['comment'])) {
		control_comment();
	}
	else if (isset($_POST['uploadBtn'])) {
		control_upload();
	}

	function control_register() {
		// Define variables and initialize with empty values
		$_SESSION['username'] = '';
		$_SESSION['password'] = '';
		$_SESSION['confirm_password'] = '';
		$_SESSION['username_err'] = '';
		$_SESSION['password_err'] = '';
		$_SESSION['confirm_password_err'] = '';

		// Validate username
		if (empty(trim($_POST['username']))) {
			$_SESSION['username_err'] = 'Please enter a username.';
		}
		else if (existUserByLogin(trim($_POST['username']))) {
			$_SESSION['username_err'] = 'This username is already taken.';
		}
		else {
			$_SESSION['username'] = trim($_POST['username']);
		}

		// Validate password
		if (empty($_POST['password'])) {
			$_SESSION['password_err'] = 'Please enter a password.';
		}
		else {
			$_SESSION['password'] = $_POST['password'];
		}

		// Validate confirm password
		if (empty($_POST['confirm_password'])) {
			$_SESSION['confirm_password_err'] = 'Please confirm password.';
		}
		else if (empty($_SESSION['password_err']) && ($_SESSION['password'] != $_POST['confirm_password'])) {
			$_SESSION['confirm_password_err'] = "Password did not match.";
		}
		else {
			$_SESSION['confirm_password'] = $_POST['confirm_password'];
		}

		// Check input errors before inserting in database
		if (empty($_SESSION['username_err']) && empty($_SESSION['password_err']) && empty($_SESSION['confirm_password_err'])) {
			setUser($_SESSION['username'], $_SESSION['password']);
			header("location: login.php");
		}
		else {
			header("location: register.php");
		}
	}

	function control_login() {
		/*
			// Check if the user is already logged in, if yes then redirect him to welcome page
			if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
			exit;
			}
		*/
		$_SESSION['username'] = '';
		$_SESSION['password'] = '';
		$_SESSION['username_err'] = '';
		$_SESSION['password_err'] = '';

		// Check if username is valid
		if (empty(trim($_POST['username']))) {
			$_SESSION['username_err'] = 'Please enter username.';
		}
		else if (!existUserByLogin(trim($_POST['username']))) {
			$_SESSION['username_err'] = 'No account found with that username.';
		}
		else {
			$_SESSION['username'] = trim($_POST['username']);
		}

		// Check if password is empty
		if (empty(trim($_POST['password']))) {
			$_SESSION['password_err'] = 'Please enter your password.';
		}
		else if (empty($_SESSION['username_err']) && !existUserByLoginPassword($_SESSION['username'], $_POST['password'])) {
			$_SESSION['password_err'] = 'The password you entered was not valid.';
		}
		else {
			$_SESSION['password'] = ($_POST['password']);
		}

		// Validate credentials
		if (empty($_SESSION['username_err']) && empty($_SESSION['password_err'])) {
			$_SESSION["loggedin"] = true;
			$_SESSION['user'] = getUserByLoginPassword($_SESSION['username'], $_SESSION['password']);
			header("location: index.php");
		}
		else {
			header("location: login.php");
		}
	}

	function control_post() {
		if ($_SESSION["loggedin"]) {
			setPost($_SESSION['user']['id'], $_POST['text-post'], date('Y-m-d H:i:s'), 0, 0);
			header("location: blog.php");
		}
		else {
			header("location: login.php");
		}
	}

	function control_comment() {
		if ($_SESSION["loggedin"]) {
			setComment($_POST['id-post'], $_SESSION['user']['id'], $_POST['text-comment'], date('Y-m-d H:i:s'), 0, 0);
			header("location: blog.php");
		}
		else {
			header("location: login.php");
		}
	}

	function control_upload() {
		$message = '';
		if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload') {
			if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
				// get details of the uploaded file
				$fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
				$fileName = $_FILES['uploadedFile']['name'];
				$fileSize = $_FILES['uploadedFile']['size'];
				$fileType = $_FILES['uploadedFile']['type'];
				$fileNameCmps = explode(".", $fileName);
				$fileExtension = strtolower(end($fileNameCmps));
				// sanitize file-name
				$newFileName = md5($fileName) . '.' . $fileExtension;
				// directory in which the uploaded file will be moved
				$uploadFileDir = './uploaded_files/';
				$dest_path = $uploadFileDir . $newFileName;

				if (move_uploaded_file($fileTmpPath, $dest_path)) {
					$message ='File was successfully uploaded to : ' . $fileTmpPath . $dest_path;
				}
				else {
					$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
				}
			}
			else {
				$message = 'There is some error in the file upload. Please check the following error.<br>';
				$message .= 'Error:' . $_FILES['uploadedFile']['error'];
			}
		}
		$_SESSION['message'] = $message;
		header("Location: joinus.php");
	}
?>
