<?php
require_once "dbh.inc.php";
function empty_input($name, $email, $username, $pwd, $pwd_repeat){
	if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwd_repeat)){
		return true;
	}
	return false;
}


function invalid_username($username){
	if(preg_match("/^[a-zA-Z0-9]*$/", $username)){
		return false;
	}
	return true;
}


function invalid_email($email){
	if(!filter_var($email, FILTER_VALIDATATE_EMAIL)){
		return false;
	}
	return true;
}


function invalid_password($pwd, $pwd_repeat){
	if($pwd != $pwd_repeat){
		return true;
	}
	return false;
}


function exist_username_email($usernamem, $email){
	$sql = "SELECT * FROM users WHERE usersUid = ? or usersEmail = ?;";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("location: ../signup.php?error=stmt_fail");
			exit();
	}
	mysqli_stmt_bind_param($stmt, "ss", $username, $email);
	mysqli_stmt_execute($stmt);

	$result_data = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_assoc($result_data);
	if($row){
		return $row;
	}else{
		return false;
	}

	mysqli_stmt_close($stmt);
}




function exist_username($usernamem){
	$sql = mysqli_query($conn, "SELECT * FROM users WHERE usersUid='$usernamem'");
	//$sql = "SELECT * FROM users WHERE usersUid = ?";
	$stmt = mysqli_stmt_init($conn);
	/*
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("location: ../login.php?error=stmt_fail_username");
			exit();
	}*/
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);

	$result_data = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_assoc($result_data);
	if($row){
		return $row;
	}else{
		return false;
	}
	mysqli_stmt_close($stmt);
}


function exist_email($email){
	$query = mysqli_query($conn, "SELECT * FROM users WHERE email='".$email."'");

    if (!$query)
    {
    	header("location: ../login.php?error=stmt_fail_email");
			exit();
    }
	if(mysqli_num_rows($query) > 0){
    	return $query;
	}else{
    	return false;
	}
}



function create_user($name, $email, $username, $pwd){
	$sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUE (?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("location: ../signup.php?error=stmt_fail");
			exit();
	}

	$hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashed_pwd);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location: ../signup.php?error=none");
			exit();
}


function empty_input_login($username, $pwd){
		if(empty($username) || empty($pwd)){
		return true;
	}
	return false;
}


function login_user($username_email, $pwd){
		if(!filter_var($username_email, FILTER_VALIDATATE_EMAIL)){
			header("location: ../login.php?error=unknow_mail");
			exit();
		}else{
			header("location: ../login.php?error=unknow_username");
			exit();
		}

		if(filter_var($username_email, FILTER_VALIDATATE_EMAIL)){
			$user_exist = exist_email($conn, $email);
			if($user_exist === false){
				header("location: ../login.php?error=unknow_mail");
				exit();
			}
		}else{
			$user_exist = exist_username($conn, $email);
			if($user_exist === false){
				header("location: ../login.php?error=unknow_username");
				exit();
			}
		}

		$pwd_hasged = $user_exist["usersPwd"];
		$check_pwd = password_verify($pwd, $pwd_hasged);
		if($check_pwd === false){
			header("location: ../login.php?error=loging_failed");
			exit();
		}else if($check_pwd === true){
			session_start();
			$_SESSION["userid"] = $user_exist["usersId"];
			$_SESSION["useruid"] = $user_exist["usersUid"];
			header("location: ../index.php");
			exit();
		}
	}
?>
