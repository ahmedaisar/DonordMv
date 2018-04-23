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
  header('Location: landing.php');
}

if (isset($_POST['submit'])) {
  $phone  = $profile['phone'];
  $location = $_POST['location'];
  $date = $_POST['date'];
  $notes = $_POST['notes'];

  if (add_donation ($phone, $location, $date, $notes)) {
  } $msg = "New record added";
  $color = "teal-text";
} else {
  $msg = "Failed to add new record";
  $color = "red-text";
}

$latest = get_latest_donation($profile['phone']);
$date = strtotime($latest['donationDate']);
$today = time();
$difference = $today - $date;
$difference = floor($difference / 86400);
$ninety = strtotime("+90 day", $date);
$ninety = date("d-M-Y", $ninety);

$percentage = ($difference/90)*100;

if ($percentage >= 100) {
  $percentage === 100;
  } else {
    $percentage = $percentage;
  }

if ($difference >= 90) {
  $availability = "<span class='teal-text'>Available</span>";
} else {
  $availability = "<span class='red-text'>Not available</span>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <title>#DonorsMv</title>

  <!-- CSS  -->
  <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="css/material-design-iconic-font.min.css" rel="stylesheet" />
</head>
<body>
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="#" class="brand-logo">#DonorsMv</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="donors.php">Donors</a></li>
        <li><a href="requests.php">Requests</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>

      <div class="col"></div>

      <ul id="nav-mobile" class="sidenav">
        <div class="row">
          <div class="col s12">
            <div class="card black-text">
              <div class="card-image">
                <img src="images/bg1.jpg">
                <span class="card-title"><?php echo $profile['fullname'] ?></span>
              </div>
              <div class="card-content">
                Availability: 
              </div>
                <div class="card-action">
                    <a href="#">Edit</a><a href="logout.php">Logout</a>
                </div>
              </div>
            </div>
          </div>
      <li><a href="donors.php"><i class="zmdi zmdi-face"></i>Find Donors</a></li>
      <li><a href="request-form.php"><i class="zmdi zmdi-invert-colors"></i>Submit Blood Requests</a></li>
      <li><a href="resuests.php"><i class="zmdi zmdi-comment-more"></i> View Blood Requests</a></li>
      <li><a href="profile.php"><i class="zmdi zmdi-account"></i>Profile</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="zmdi zmdi-menu"></i></a>
    </div>
  </nav>

        <div class="container">
          <div class="section">
            <div class="row">
              <div class="col s12">
                  <h5><?php echo $profile['fullname'] ?></h5> (<?php echo $availability ?>)
                  <small><?php echo $difference." days since the last donation" ?></small>

                   <div class="progress red lighten-5 col s8">
                      <div class="determinate red" style="width:<?php echo $percentage."%" ?>;">
                      </div>
                  </div>
                  <span class="col s4"><?php echo $ninety ?></span>
              </div>
            </div>
            <!--   Icon Section   -->
            <div class="row">
              <div class="col s12 m8 l8">
                <div class="icon-block card">
                  <h2 class="center teal-text"><i class="zmdi zmdi-time-restore"></i></h2>
                  <h5 class="center">Donation Log</h5>
                  <div class="row">
                    <ul class="collection">
                      <!--  -->
                      <?php get_donoation_log($profile['phone']) ?>
                  </ul>
                  </div>
                </div>
              </div>

              <div class="col l4 hide-on-med-and-down">
                <div class="icon-block card teal white-text" style="min-height: 500px">
                  <h2 class="center white-text"><i class="zmdi zmdi-plus"></i></h2>
                  <h5 class="center">Add Donation</h5>
                  <div class="row">
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
                  </div>
                </div>
              </div>

              <div class="center">
              <button class="waves-effect waves-light btn hide-on-large-only" name="modal"><i class="zmdi zmdi-plus"></i> Add Donation</button>                
              </div>
  

          </div>
        </div>
      </div>

          <div class="fixed-action-btn hide-on-large-only">
              <a class="btn-floating btn-large red">
                <i class="zmdi zmdi-plus"></i>
              </a>
              <ul>
                <li><a class="btn-floating teal darken-4"><i class="zmdi zmdi-edit"></i></a></li>
                <li><a class="btn-floating teal"><i class="zmdi zmdi-face"></i></a></li>
                <li><a class="btn-floating red darken-1"><i class="zmdi zmdi-invert-colors"></i></a></li>
              </ul>
          </div>

  <footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">#DonorsMv</h5>
          <p class="grey-text text-lighten-4">#DonorsMv is the largest crowd managed database of active blood donors in the Maldives. We focus on utilizing the power of interactive web technologies to help save hundreds of lives by providing an up-to-date database of donors.</p>
        </div>

        <div class="col l3 s12 offset-l3">
          <h5 class="white-text">Find Us On</h5>
          <ul>
            <li><a class="white-text" href="#!"><i class="zmdi zmdi-twitter zmdi-hc-fw"></i> Twitter</a></li>
            <li><a class="white-text" href="#!"><i class="zmdi zmdi-facebook zmdi-hc-fw"></i> Facebook</a></li>
            <li><a class="white-text" href="#!"><i class="zmdi zmdi-instagram zmdi-hc-fw"></i> Instagram</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made with <a class="brown-text text-lighten-3" href="http://materializecss.com">Materialize</a>
      </div>
    </div>
  </footer>

  <!--  Scripts-->
  <script src="js/jquery-331.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  <script>
    $(document).ready(function(){
      $('select').formSelect();
      $('.fixed-action-btn').floatingActionButton();
      $('#textarea1').val('');
      M.textareaAutoResize($('#textarea1'));

    });
  </script>


  <script>
    var elem = document.querySelector('.tooltipped');
    var instance = M.Tooltip.init(elem, options);
    
  </script>
  </body>
</html>
