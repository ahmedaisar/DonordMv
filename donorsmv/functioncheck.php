<?php 
session_start();

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
} else {
	header('Location: login.php');
}

require_once 'files/connect.php';
require_once 'files/functions.php';


 ?>
 <html>
 	<head>
 		<title><?php echo $user ?></title>
 	</head>
 	<body>
 		<?php $profile = load_profile ($user); echo $profile['phone']; ?><br>
 		<a href="logout.php">Exit</a><br>
 
		 <?php $latest = get_latest_donation($profile['phone']);
		 $date = strtotime($latest['donationDate']);

			
		 ?>

 		<h4><?php 
 		$phone = '9781993';
 		$pass = passwordify($user,'password');
 		if (person_exists($phone)) {
 			echo "person exists<br>";
 		} else {
 			echo "person does not exist<br>";
 		}
 		if (email_exists($user)) {
 			echo "email exists<br>";
 		} else {
 			echo "email does not exist<br>";
 		}
 		if (user_exists($phone)) {
 			echo "user exists<br>";
 		} else {
 			echo "user does not exist<br>";
 		}
 		if (varify_password ($user, $pass)) {
 			echo "Password verified<br>";
 		} else {
 			echo "Could not verify password<br>";
 		}

 		

		$ipAddress = $_SERVER['REMOTE_ADDR'];
		print "IP = ". $ipAddress. "<BR>";
 		
 		 ?></h4>
		<table>
			<thead>
				<tr>
					<th>Phone</th>
					<th>Name</th>
					<th>Blood Group</th>
					<th>Gender</th>
					<th>Age</th>
				</tr>				
			</thead>
			<tbody>
				<?php 
 					get_donors_by_bloodgroup ($profile['bloodGroup']);
				?>
			</tbody>
		</table><br>

 		 <?php

 		 	echo "Last donated on: ".$latest['donationDate']."<br>";
			$today = time();
			$difference = $today - $date;
			echo floor($difference / 86400)." days since the last donation<br>";

			$ninety = strtotime("+90 day", $date);
			$ninety = date("d-m-Y", $ninety);
			echo "Available after ".$ninety."<br>";

			if ($difference >= 90) {
				$availability = "Available";
			} else {
				$availability = "Not Available";
			}

			echo $availability;

 		  ?>

 	</body>
 </html>