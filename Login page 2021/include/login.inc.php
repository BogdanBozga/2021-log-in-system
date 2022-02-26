<?php
if(isset($_POST["submit"])){
	$username = $_POST["user_mail"];
	$pwd = $_POST["pwd_log"];

	require_once "error_handler.php";

	if(empty_input_login($username, $pwd) !== false){
		header("location: ../login.php?error=empty_input");
		exit();
	}

	login_user($username, $pwd);
}else{
	header("location: ../login.php");
	exit();
}