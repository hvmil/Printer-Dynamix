<!--
	Login Script
	10/22
	index.php provides the login parameters, and passes them to this file via the POST method.
	This file will query to ensure a proper login, and set the session variables for use later on.



-->

<!DOCTYPE html>
<html>

<body>
<?php 
	# Ensure this page is reached via POST
	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		header("Location: /index.php");
	}
	# Pull the params from the $_POST array, hash the password.
	$username = $_POST['username_field'];
	$userpass = $_POST['password_field'];
	$hashed = hash("sha256", $userpass);

	# Connect to database
	require_once "../includes/config.php";

	if ($link == false) {
		die("Error connecting to database!");
	}

	# Query DB to login
	$stmt = $link->stmt_init();
	$stmt = $link->prepare("select user_id,first_name,last_name,email,username,is_admin from user where username=? and password=?");
	$stmt->bind_param("ss", $username, $hashed);
	$stmt->execute();

	#Get data about the user from the DB and bind it to the session.
	$stmt -> bind_result($id,$firstname,$lastname,$email,$user,$is_admin);
	$stmt -> fetch();
	

	#Session Setup
	session_start();

	if ($user == ""){
		$_SESSION["message"] = "Unknown user or bad password.";
		header("Location: ../index.php");
	} else {
		if (isset($_SESSION["message"])) {
			unset($_SESSION["message"]);
		}
		$_SESSION["username"] = $user;
		$_SESSION["email"] = $email;
		$_SESSION["first_name"] = $firstname;
		$_SESSION["last_name"] = $lastname;
		$_SESSION["is_admin"] = $is_admin;
		header("Location: ../forms/main.php");
	}
	


?>
</body>
</html>

	
