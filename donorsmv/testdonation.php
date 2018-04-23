<?php
session_start();
require_once 'files/connect.php';
require_once 'files/functions.php';

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  $profile = load_profile ($user);
  $msg = "";
  $color = "teal-text";
} else {
  header('Location: index.php');
}

if (isset($_POST['submit'])) {
  $phone  = $profile['phone'];
  $location = $_POST['location'];
  $date = $_POST['date'];
  $notes = $_POST['notes'];

  $sql = "INSERT IGNORE INTO donations (`donor`, `location`, `donationDate`, `notes`)" 
	. "VALUES ('$phone', '$location', '$date', '$notes')";
	$result = $connection->query($sql);
		if ( $result) {
			echo "TRUE";
		} else {
			echo $result;
		}	
}
?>

 <form method="POST" class="col s12">
                      <div class="row">
                        <div class="input-field col s12">
                          <input name="date" id="date" type="date" required>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <input id="location" name="location" type="text" required>
                          <label for="location" class="white-text">Location</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <textarea id="notes" name="notes" class="materialize-textarea"></textarea>
                          <label for="notes" class="white-text">Notes (optional)</label>
                        </div>
                      </div>
                      <div class="row center">
                        <button class="waves-effect waves-light btn" name="submit">Submit</button>
                      </div>
                    </form>