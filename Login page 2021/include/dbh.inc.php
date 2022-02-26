<?php

$serverName = "localhost";
$dBUsername = "root";
$sBPassword = "";
$dBName = "login-sistem";

$conn = mysqli_connect($serverName, $dBUsername, $sBPassword, $dBName);

if(!$conn){
	die("Connection failed: ". mysqli_connect_error());
}