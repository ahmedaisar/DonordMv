<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Indian/Maldives');

$dbhost  = 'localhost';
$dbuser  = 'root';
$dbpass  = '';
$db      = 'donorsdb';
$connect = mysqli_connect($dbhost, $dbuser, $dbpass);

if (!$connect) {
    die('SERVER CONNECTION FAILED...\n: ' . mysqli_error());
}


$sql = "CREATE DATABASE IF NOT EXISTS $db";

$retval = mysqli_query($connect, $sql);
if (!$retval) {
    echo $sql.'</br>';
    die('DATABASE CREATION FAILED\n: ' . mysql_error());
}

$donors = "CREATE TABLE IF NOT EXISTS donors( "
		. "phone varchar(7) NOT null PRIMARY KEY,"
		. "fname varchar(20) NOT null,"
	    . "mname varchar(20),"
	    . "lname varchar(20),"
	    . "bloodGroup varchar(3) not null,"
	    . "gender boolean NOT null,"
    	. "DOB date not null);";
        
$donations = "CREATE TABLE IF NOT EXISTS donations( "
		. "donation int NOT null AUTO_INCREMENT PRIMARY KEY,"
		. "donor varchar(7) NOT null,"
		. "location varchar(50) NOT null,"
		. "donationDate date NOT null,"
		. "notes varchar(255) NOT null,"
		. "FOREIGN KEY (donor) REFERENCES donors (phone));";

$requests = "CREATE TABLE IF NOT EXISTS requests( "
		. "request int NOT null AUTO_INCREMENT PRIMARY KEY,"
		. "requestedBy varchar(50) NOT null,"
		. "expireDate date NOT null,"
		. "bloodType varchar(4) NOT null,"
		. "location varchar(100) NOT null,"
		. "requestedContact varchar(50),"
		. "patientCondition varchar(30),"
		. "details varchar(255) NOT null,"
		. "urgency int NOT null,"
		. "status boolean default TRUE);";

$users = "CREATE TABLE IF NOT EXISTS users( "
		. "email varchar(50) NOT NULL PRIMARY KEY,"
		. "user varchar(7) NOT NULL,"
		. "pword varchar(64) NOT NULL,"
		. "timeStamp DATE NOT NULL,"
		. "FOREIGN KEY (user) REFERENCES donors (phone));";

$people ="CREATE VIEW people AS
" . "SELECT
" . "d.phone,
" . "d.fname,
" . "d.mname,
" . "d.lname,
" . "d.bloodGroup,
" . "d.gender,
" . "d.DOB,
" . "u.email
" . "FROM
" . "donors d
" . "INNER JOIN
" . "users u
" . "ON
" . "u.user = d.phone;";

        
mysqli_select_db($connect,$db);

$mysql1 = mysqli_query($connect,$donors);
$mysql2 = mysqli_query($connect,$donations);
$mysql3 = mysqli_query($connect,$requests);
$mysql4 = mysqli_query($connect,$users);
$mysql5 = mysqli_query($connect,$people);

if (!$mysql1 && !$mysql2 && !$mysql3 && !$mysql4 && !$mysql5) {
    die('COULD NOT CREATE TABLE: ' . mysqli_error($connect));
    
}

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

?>