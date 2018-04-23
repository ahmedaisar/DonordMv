<?php 

//check if this phone number is registered or not and returns true if exists or false otherwise.
function person_exists($phone) {
	$connection = mysqli_connect('localhost', 'root', '', 'donorsdb');
	$check = "SELECT * FROM donors WHERE `phone` = '$phone'";
	$result = mysqli_query($connection, $check);
		if (mysqli_num_rows($result) !== 0) {
			return TRUE;
		} else {
			return FALSE;
		}
}

//check if this phone number is registered or not and returns true if exists or false otherwise.
function user_exists($phone) {
	$connection = mysqli_connect('localhost', 'root', '', 'donorsdb');
	$check = "SELECT * FROM users WHERE `user`='$phone'";
	$result = mysqli_query($connection, $check);
		if (mysqli_num_rows($result) !== 0) {
			return TRUE;
		} else {
			return FALSE;
		}
}
//check if this email is registered or not and returns true if exists or false otherwise.
function email_exists($email) {
	$connection = mysqli_connect('localhost', 'root', '', 'donorsdb');
	$check = "SELECT * FROM users WHERE `email`='$email'";
	$result = mysqli_query($connection, $check);
		if (mysqli_num_rows($result) !== 0) {
			return TRUE;
		} else {
			return FALSE;
		}
}


//calculate age for a given date of birth
function get_age ($dob) {
	return date_diff(date_create($dob), date_create('now'))->y." yrs";
}

//adds a non-user personal information to the DB.
function add_person ($phone, $fname, $mname, $lname, $bloodgroup, $gender, $dob) {
	$connection = mysqli_connect('localhost', 'root', '', 'donorsdb');	
	$sql = "INSERT IGNORE INTO donors (`phone`,`fname`,`mname`,`lname`,`bloodGroup`,`gender`,`DOB`)" 
	. "VALUES ('$phone','$fname','$mname','$lname','$bloodgroup','$gender','$dob')";
		if ($connection->query($sql) === TRUE) {
			return "TRUE";
		} else {
			return "FALSE";
		}	
}


//registers a new user and add personal info
function register_user ($email, $phone, $password){
	$timestamp = date('Y-m-d',strtotime('now'));
	$connection = mysqli_connect('localhost', 'root', '', 'donorsdb');
	$sql = "INSERT IGNORE INTO users (`email`,`user`,`pword`,`timeStamp`)" 
	. "VALUES ('$email', '$phone', '$password', '$timestamp')";
		if ($connection->query($sql) === TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
}

//encripts password
function passwordify($email, $pass) {
	$email = hash('sha256', $email);
    $pass = hash('sha256', $email);
    $pass =  $email . $pass;
    return $pass = hash('sha256', $pass);
}

//checks if password and confirm password is matching
function match_passwords ($pass, $cpass) {
	if ($pass === $cpass) {
		return 'TRUE';
	} else {
		return 'FALSE';
	}

}

//varifies if the password provided for the email is correct
function varify_password ($email, $pass) {
	$connection = mysqli_connect('localhost', 'root', '', 'donorsdb');
	$sql = "SELECT * FROM users WHERE email = '$email'";
	$result = mysqli_query($connection, $sql);
	while ($data = mysqli_fetch_object($result)) {
	$pword = $data -> pword;
	
	if ($pass === $pword) {
        return TRUE;
	} else {
		return FALSE;
	}
}
}

//name says it all
function get_all_donors (){
	$connection = mysqli_connect('localhost', 'root', '', 'donorsdb');
	$sql = "SELECT * FROM donors ORDER BY `fname`";
	$result = mysqli_query($connection, $sql);
		while ($data = mysqli_fetch_object($result)) {
		$phone = $data -> phone;
		$fname = $data -> fname;
		$mname = $data -> mname;
		$lname = $data -> lname;
		$bloodGroup = $data -> bloodGroup;
		$gender = $data -> gender;
		$dob = $data -> DOB;
		$age = date_diff(date_create($dob), date_create('now'))->y." yrs";
		$fullname = trim($fname." ".$mname." ".$lname);

		switch ($gender) {
			case '1':
				$gender = "Male";
			break;
			case '0':
				$gender = "Female";
			break;	

			default:
				$gender = "N/A";
			break;
		}
//output a table row
echo
"<tr><td>" . $phone . "</td><td>" . $fullname . "</td><td>" . $bloodGroup . "</td><td>" . $gender . "</td><td>" . $age . "</td></tr>";
} 
}


//filters a donor list based on blood group
function get_donors_by_bloodgroup ($bloodgroup){
	$connection = mysqli_connect('localhost', 'root', '', 'donorsdb');
	$sql = "SELECT * FROM donors WHERE bloodGroup = '$bloodgroup' ORDER BY `fname`";
	$result = mysqli_query($connection, $sql);
		while ($data = mysqli_fetch_object($result)) {
		$phone = $data -> phone;
		$fname = $data -> fname;
		$mname = $data -> mname;
		$lname = $data -> lname;
		$bloodGroup = $data -> bloodGroup;
		$gender = $data -> gender;
		$dob = $data -> DOB;
		$age = date_diff(date_create($dob), date_create('now'))->y." yrs";
		$fullname = trim($fname." ".$mname." ".$lname);

		switch ($gender) {
			case '1':
				$gender = "Male";
			break;
			case '0':
				$gender = "Female";
			break;	

			default:
				$gender = "N/A";
			break;
		}
//output a table row
echo
"<tr><td>" . $phone . "</td><td>" . $fullname . "</td><td>" . $bloodGroup . "</td><td>" . $gender . "</td><td>" . $age . "</td></tr>";
} 
}

//creates a session with id of email and logs the user in
function login($email, $pass){
	$connection = mysqli_connect('localhost', 'root', '', 'donorsdb');
	$query = "SELECT * FROM `users` WHERE `email` = '$email' AND `pword` = '$pass'";
	$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result) == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
}
 
//gets an array with the user data   
function load_profile ($email){
	$connection = mysqli_connect('localhost', 'root', '', 'donorsdb');
	$sql = "SELECT * FROM people WHERE email = '$email'";
	$result = mysqli_query($connection, $sql);
		while ($data = mysqli_fetch_object($result)) {
		$user['phone'] = $data -> phone;
		$user['fname'] = $data -> fname;
		$user['mname'] = $data -> mname;
		$user['lname'] = $data -> lname;
		$user['bloodGroup'] = $data -> bloodGroup;

		$user['gender'] = $data -> gender;
		switch ($user['gender']) {
			case '1':
				$user['gender'] = "Male";
			break;
			case '0':
				$user['gender'] = "Female";
			break;	

			default:
				$user['gender'] = "N/A";
			break;
		}

		$user['dob'] = $data -> DOB;
		$user['age'] = date_diff(date_create($user['dob']), date_create('now'))->y." yrs";
		$user['fullname'] = trim($user['fname']." ".$user['mname']." ".$user['lname']);
		
    	return $user;
	}
}

//adds a new donation log to the DB.
function add_donation ($donor, $location, $date, $notes) {
	$connection = mysqli_connect('localhost', 'root', '', 'donorsdb');	
	$sql = "INSERT IGNORE INTO donations (`donor`, `location`, `donationDate`, `notes`)" 
	. "VALUES ('$donor', '$location', '$date', '$notes')";
		if ($connection->query($sql) === TRUE) {
			return "TRUE";
		} else {
			return "FALSE";
		}	
}

//gets user's blood donation log if it exists
function get_donoation_log ($phone){
	$connection = mysqli_connect('localhost', 'root', '', 'donorsdb');
	$sql = "SELECT * FROM donations WHERE donor = '$phone' ORDER BY `donationDate` desc";
	$result = mysqli_query($connection, $sql);
	if (mysqli_num_rows($result) >= 1) {
		while ($data = mysqli_fetch_object($result)) {
		$location = $data -> location;
		$donationDate = date('d-M-Y', strtotime($data -> donationDate));
		$notes = $data -> notes;		
echo "<li class='collection-item avatar'>".
      "<i class='zmdi zmdi-invert-colors red circle'></i>".
      "<span class='title'><b>".$location."</b></span>".
      "<p>".$donationDate."<br>".
      "<em>".$notes."</em>".
      "</p>".
      "<span class='secondary-content'>".
      "<a href='#!' class='waves-effect waves-light teal-text'><i class='zmdi zmdi-quote'></i></a> ".
      "<a href='#!' class='waves-effect waves-light'><i class='zmdi zmdi-edit'></i></a> ".
      "<a href='#!' class='waves-effect waves-light red-text'><i class='zmdi zmdi-delete'></i></a></span>".
      "</li>";
}
		} else {
			echo "<li class='red-text center'>No donations recorded</li>";
		}
		 
}

//get the latest donation info for the phone number
function get_latest_donation($phone){
	$connection = mysqli_connect('localhost', 'root', '', 'donorsdb');
	$sql = "SELECT * FROM `donations` WHERE donor = '$phone' ORDER BY donation DESC LIMIT 1";
	$result = mysqli_query($connection, $sql);
		while ($data = mysqli_fetch_object($result)) {
		$latest['location'] = $data -> location;
		$latest['donationDate'] = $data -> donationDate;
		$latest['notes'] = $data -> notes;

		return $latest;
	}
}

//logs the user out
function logout() {
	session_start();
	session_destroy();
	header('Location: login.php');
}
?>
