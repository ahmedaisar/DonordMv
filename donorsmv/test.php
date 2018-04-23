<?php 
require_once 'files/connect.php';
require_once 'files/functions.php';

$email = 'email123@gmail.com';
$pass = 'password';
$pass = passwordify($email, $pass);
echo $pass."<br>";

$connection = mysqli_connect('localhost', 'root', '', 'donorsdb');
	$sql = "SELECT * FROM users WHERE email = '$email'";
	$result = mysqli_query($connection, $sql);
	while ($data = mysqli_fetch_object($result)) {
	$pword = $data -> pword;
	
	echo $pword . "<br>";
}

if(varify_password($email,$pass)) {
	if (login($email, $pass)) {
		echo "SESSION";
		$_SESSION['user'] = $email;
 		header("Location: landing.php");
	} else {
		echo "NO SESSION";
		header("Location: login.php");
	}
}



 ?>
