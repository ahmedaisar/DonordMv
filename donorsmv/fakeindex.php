<?php
session_start();

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
} else {
	header('Location: landing.php');
}

require_once 'files/connect.php';
require_once 'files/functions.php';
$msg = "Fill in your information";
$color = "";



if (isset($_POST['submitForm'])) {
	$phone = $_POST['phone'];
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$bloodGroup = $_POST['bloodGroup'];
	$gender = $_POST['gender'];
	$dob = $_POST['dob'];
	$fullname = trim($fname." ".$mname." ".$lname);


	if (get_age($dob) < 18) {
		$msg = "<b>FAILED:</b> You must be 18+ to donate blood";
		$color = "red";
	} else {
		add_person($phone, $fname, $mname, $lname, $bloodGroup, $gender, $dob);		
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
			<a href="logout.php">logout</a>
			<a href="testprofile.php"><?php echo $user ?></a>
			<form action="" method="POST">
				<h4 class=<?php echo $color ?>><?php echo $msg ?></h4>
				<ul>
					<li>
						<input type="text" name="phone" placeholder="Phone Number" maxlength="7" required>
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
						<select  required >
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
			<form method="POST">
			<select name="bloodGroup" required onchange="this.form.submit();">
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
		</form>
			<table cellpadding="5px">
				<tr>
					<th>Phone</th>
					<th>Name</th>
					<th>Blood Group</th>
					<th>Gender</th>
					<th>Age</th>
				</tr>
				<?php 
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$bloodGroup = $_POST['bloodGroup'];
				get_donors_by_bloodgroup ($bloodGroup); 
				} else {
				get_all_donors();  
				}
				?>
			</table>

		
		</body>
	</head>
</html>