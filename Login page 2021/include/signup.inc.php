<?php
	if(isset($_POST["submit"])){

		$name = $_POST["name"];
		$email = $_POST["email"];
		$username = $_POST["uid"];
		$pwd = $_POST["pwd"];
		$pwd_repeat = $_POST["pwd_repeat"];


		require_once "dbh.inc.php";
		require_once "error_handler.php";

		if(empty_input($name, $email, $username, $pwd, $pwd_repeat) !== false){
			header("location: ../signup.php?error=emptyinput");
			exit();
		}
		if(invalid_username($username) !== false){
			header("location: ../signup.php?error=invalid_username");
			exit();
		}
		if(invalid_email($email) !== false){
			header("location: ../signup.php?error=invalid_email");
			exit();
		}
		if(invalid_password($pwd, $pwd_repeat) !== false){
			header("location: ../signup.php?error=invalid_password");
			exit();
		}
		if(exist_username_email($conn, $username, $email) !== false){
			header("location: ../signup.php?error=username_take");
			exit();
		}
	

		create_user($conn, $name, $email, $username, $pwd);

	}else{
		header("location: ../signup.php?");
		exit();
	}
 ?>