<?php
require_once 'files/connect.php';
require_once 'files/functions.php';
session_start();
if (isset($_SESSION['user'])) {
  header('Location: index.php');
}

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $pass = passwordify($email,$_POST['pass']);

  if(varify_password($email,$pass)) {
  if (login($email, $pass)) {
    $_SESSION['user'] = $email;
    header("Location: index.php");
  } else {
    header("Location: login.php");
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
        <li><a href="register.php">Register</a></li>
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
      <li><a href="register.php"><i class="zmdi zmdi-account-add"></i>Register</a></li>
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
              <h4>Sign In</h4>
          <div class="row">
              <form method="POST" class="col s12">
                <div class="row">
                  <div class="input-field col s12">
                    <input id="email" type="email" name="email" class="validate" required>
                    <label for="email">Email</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <input id="password" type="password" name="pass" class="validate" required>
                    <label for="password">Password</label>
                  </div>
                </div>
                <div class="row">
                  <button class="btn waves-effect waves-light" type="submit" name="login">Sign In</button>
                </div>
              </form>
            </div>
          <p class="center-align light"><a href="register.php">Register </a>|<a href="landing.php"> Continue as a Guest</a></p>
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
