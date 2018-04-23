<?php
session_start();

if (isset($_SESSION['user'])) {
  header('Location: index.php');
} 

require_once 'files/connect.php';
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

  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text text-lighten-2">Be a Hero</h1>
        <div class="row center">
          <h5 class="header col s12 light">Help save a life by joining the donors community</h5>
        </div>
        <div class="row center">
          <a href="register.php" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Join Us!</a>
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="images/redcells.png" alt="Unsplashed background img 1"></div>
  </div>


        <div class="container">
          <div class="section">
            <!--   Icon Section   -->
            <div class="row">
              <div class="col s12 m4">
                <div class="icon-block">
                  <h2 class="center teal-text"><i class="zmdi zmdi-globe"></i></h2>
                  <h5 class="center">Connect with Others</h5>

                  <p class="light">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis dolorem, distinctio cupiditate adipisci eaque ad voluptatem aut excepturi soluta ut quasi ipsa. Enim accusantium doloribus quos recusandae iusto fuga sequi ex nobis, nisi ad minima voluptates, eum dolorum impedit debitis atque illo beatae sint, ab possimus. Dolorem et, qui earum.</p>
                </div>
              </div>

              <div class="col s12 m4">
                <div class="icon-block">
                  <h2 class="center blue-text"><i class="zmdi zmdi-comments"></i></h2>
                  <h5 class="center">Spread the Message</h5>

                  <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
                </div>
              </div>

              <div class="col s12 m4">
                <div class="icon-block">
                  <h2 class="center red-text"><i class="zmdi zmdi-favorite"></i></h2>
                  <h5 class="center">Save Lives</h5>

                  <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
                </div>
              </div>
            </div>

          </div>
        </div>


        <div class="parallax-container valign-wrapper">
          <div class="section no-pad-bot">
            <div class="container">
              <div class="row center">
                <h5 class="header col s12 light">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi quod odio adipisci quaerat, perspiciatis dicta distinctio expedita neque sapiente dolorum.</h5>
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
                <h4>Blood Request Form</h4>
                <form class="col s12">
                  <div class="row">
                    <div class="input-field col l4 s12">
                      <input id="fullname" type="text">
                      <label for="fullname">Full Name</label>
                    </div>
                    <div class="input-field col l4 s12">
                      <input id="location" type="text">
                      <label for="location">Location</label>
                    </div>
                    <div class="input-field col l4 s12">
                      <select>
                        <option value="" selected>Blood Group</option>
                        <option value="1">O +ve</option>
                        <option value="2">O -ve</option>
                        <option value="3">A +ve</option>
                        <option value="4">A -ve</option>
                        <option value="5">B +ve</option>
                        <option value="6">B -ve</option>
                        <option value="7">AB +ve</option>
                        <option value="8">AB -ve</option>
                      </select>
                      <label>Select Blood Group</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <textarea id="textarea1" class="materialize-textarea"></textarea>
                      <label for="textarea1">Details</label>
                    </div>
                  </div>
                  <div class="row">
                    <label>
                      <input type="checkbox" id="indeterminate-checkbox"/>
                      <span>Urgent</span>
                    </label>
                  </div>
                  <div class="row">
                    <a class="waves-effect waves-light btn">Submit</a>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>


        <div class="parallax-container valign-wrapper">
          <div class="section no-pad-bot">
            <div class="container">
              <div class="row center">
                <h5 class="header col s12 light">Thank you for the love and support</h5>
              </div>
            </div>
          </div>
          <div class="parallax"><img src="images/redcells.png" alt="Unsplashed background img 3"></div>
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
      $('#textarea1').val('');
      M.textareaAutoResize($('#textarea1'));
    });
  </script>

  </body>
</html>
