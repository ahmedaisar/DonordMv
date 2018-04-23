<?php
require_once 'files/connect.php';
require_once 'files/functions.php';
$msg="<b class='teal-text'>Please provide your valid information.</b> You will be redirected to login page once you are successfully registered.";

session_start();
if (isset($_SESSION['user'])) {
  header('Location: index.php');
}

if (isset($_POST['submit'])) {
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

//PYRAMID OF DOOM
if (get_age($dob) < 18) {
  $msg = "<b class='red-text'>FAILED:</b> You must be 18+ to donate blood";
} else {
  if (add_person($phone, $fname, $mname, $lname, $bloodGroup, $gender, $dob)) {
    if (email_exists($email)) {
      $msg="<b class='red-text'>Email Exists:</b> That email has already been registered in the database.";
    } else {
      if (user_exists($phone)) {
        $msg="<b class='red-text'>Phone Number Exists:</b> That phone number has already been registered in the database.";
      } else {
        if (register_user ($email, $phone, $pass)) {
          header("location: login.php");
        } else {
          $msg="<b class='red-text'>Error:</b> Could not register user.";
        }        
      }
    }
  }  
}

}

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
        <li><a href="login.php">Sign In</a></li>
      </ul>

      <div class="col"></div>

      <ul id="nav-mobile" class="sidenav">
        <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <form class="col s12">
            <div class="row">
              <div class="input-field col s12">
                <input id="email" type="email" class="validate">
                <label for="email">Email</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="password" type="password" class="validate">
                <label for="password">Password</label>
              </div>
            </div>
          </form>
        </div>
        <div class="card-action right-align">
          <a class="waves-effect waves-light btn">Sign In</a>
        </div>
      </div>
      <li><a href="donors.php"><i class="zmdi zmdi-face"></i>Donors</a></li>
      <li><a href="resuests.php"><i class="zmdi zmdi-comment-more"></i>Requests</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="zmdi zmdi-menu"></i></a>
    </div>
  </nav>

  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12">If you’re a blood donor, you’re a hero to someone,
            somewhere, who received your gracious gift of life.</h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="images/redcells.png" alt="Unsplashed background img 2"></div>
  </div>

  <div class="container">
    <div class="section">

      <div class="row">
          <div class="col s12 center">
            <h3><i class="mdi-content-send brown-text"></i></h3>
              <h4>Register</h4>
              <?php echo $msg ?>
              
          <div class="row">
              <form method="POST" class="col s12">
                <div class="row">
                  <div class="input-field col s12">
                    <input id="phone" name="phone" type="text" class="validate" maxlength="7" required>
                    <label for="phone">Phone</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <input id="email" name="email" type="email" class="validate" required>
                    <label for="email">Email</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <input id="fname" name="fname" type="text" class="validate" required>
                    <label for="fname">First Name</label>
                  </div>
                  <div class="input-field col s12">
                    <input id="mname" name="mname" type="text" class="validate">
                    <label for="mname">Middle Name (optional)</label>
                  </div>
                  <div class="input-field col s12">
                    <input id="lname" name="lname" type="text" class="validate" required>
                    <label for="lname">Last Name</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <input id="pass" name="pass" type="password" class="validate" required>
                    <label for="pass">Password</label>
                  </div>
                  <div class="input-field col s12">
                    <input id="cpass" name="cpass" type="password" class="validate" required>
                    <label for="cpass">Confirm Password</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
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
                    <label>Select Blood Group</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <input id="dob" name="dob" type="date" class="validate" required>
                    <span class="helper-text" data-error="wrong" data-success="right">Date of Birth</span>
                  </div>
                </div>
                <div class="row">
                    <label>
                      <input type="radio" name="gender" value="1">
                      <span>Male</span>
                    </label>
                    <label>
                      <input type="radio" name="gender" value="0">
                      <span>Female</span>
                    </label>
                </div>
                <div class="row">
                  <button class="btn waves-effect waves-light" type="submit" name="submit">Submit</button>
                </div>
              </form>
            </div>
          <p class="center-align light"><a href="login.php">Sign In </a>|<a href="landing.php"> Continue as a Guest</a></p>
        </div>
      </div>

    </div>
  </div>

  <div class="fixed-action-btn hide-on-large-only">
      <a class="btn-floating btn-large red">
        <i class="zmdi zmdi-plus"></i>
      </a>
      <ul>
        <li><a class="btn-floating teal"><i class="zmdi zmdi-face"></i></a></li>
        <li><a class="btn-floating red darken-1"><i class="zmdi zmdi-invert-colors"></i></a></li>
      </ul>
  </div>

  <footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">#DonorsMv</h5>
          <p class="grey-text text-lighten-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
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
    });
  </script>

  </body>
</html>
