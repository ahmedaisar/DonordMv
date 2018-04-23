<?php
require_once 'files/connect.php';
require_once 'files/functions.php';
$msg = "Fill in your information";
$color = "";


if (isset($_POST['submitForm'])) {
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$cpass = $_POST['cpass'];
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$bloodGroup = $_POST['bloodGroup'];
	$gender = $_POST['gender'];
	$dob = $_POST['dob'];
	$fullname = trim($fname." ".$mname." ".$lname);

if (match_passwords($pass,$pass)) {
	$pass = passwordify($email,$pass);

	if (get_age($dob) < 18) {
		$msg = "<b>FAILED:</b> You must be 18+ to donate blood";
		$color = "red";
	} else {
		if (add_person($phone, $fname, $mname, $lname, $bloodGroup, $gender, $dob)) {
			register_user($email, $phone, $pass);
		} else {
			$msg = "<b>FAILED:</b> Could Not Register";
			$color = "red";
		}
		
		
	}

}

}


?>

<html>
	<head>
		<title>
			New Donor
		</title>
			<style>
				li {
					list-style: none;
				}

				.red {
					color: red;
				}

				.green {
					color: green;
				}
			</style>
		<body>
			<form action="" method="POST">
				<h4 class=<?php echo $color ?>><?php echo $msg ?></h4>
				<ul>
					<li>
						<input type="text" name="phone" placeholder="Phone Number" maxlength="7" required>
					</li>
					<li>
						<input type="email" name="email" placeholder="Email" required>
					</li>
					<li>
						<input type="password" name="pass" placeholder="Password" minlength="8" required>
					</li>
					<li>
						<input type="password" name="cpass" placeholder="Confirm Password" minlength="8" required>
					</li>
					<li>
						<input type="text" name="fname" placeholder="First Name" required>						
					</li>
					<li>
						<input type="text" name="mname" placeholder="Middle Name">				
					</li>
					<li>						
						<input type="text" name="lname" placeholder="Last Name" required>
					</li>
					<li>						
						<select name="bloodGroup" required>
							<option value="">Select Blood Group</option>
							<option value="O+">O+</option>
							<option value="O-">O-</option>
							<option value="A+">A+</option>
							<option value="A-">A-</option>
							<option value="B+">B+</option>
							<option value="B-">B-</option>
							<option value="AB+">AB+</option>
							<option value="AB-">AB-</option>
						</select>
					</li>
					<li>
						<input type="radio" name="gender" value="1"> Male
						<input type="radio" name="gender" value="0"> Female
					</li>
					<li>						
						<input type="date" name="dob" required>
					</li>
					<li>						
						<input type="submit" name="submitForm">
					</li>
				</ul>
			</form>
		</body>
	</head>
</html>