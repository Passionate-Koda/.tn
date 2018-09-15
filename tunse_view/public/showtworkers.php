<?php
ob_start();
// $page_name = "Home";
// define("REC_PATH", dirname(dirname(__FILE__)));
// include REC_PATH.'/includes/header.php';
//
//
session_start();
authenticateUser('tunsehome');
if(isset($_SESSION['u_id'])){
  $sid = $_SESSION['u_id'];
  $getInfo = getUser($econn, $sid);
  extract($getInfo);
}
$error = [];
if(array_key_exists('submit', $_POST)){
  $message = [];
  if(empty($_POST['email'])){
    $error['email'] = "Please Enter Your EMail";
  }
  if(empty($_POST['hash'])){
    $error['hash'] = "Please Enter Your Password";
  }
  if(empty($error)){
    $clean = array_map('trim', $_POST);
    loginUser($econn, $clean, $message);
  }
  var_dump($error);
}
if(array_key_exists('register', $_POST)){
  if(doesUserEmailExist($econn, $_POST['email'])){
    $error['email'] = "Email Already Exist";
  }
  if(doesUserPhoneNumberExist($econn, $_POST['phonenumber'])){
    $error['phonenumber'] = "This Phone number has been used to Register";
  }
  if(doesUsernameExist($econn, $_POST['username'])){
    $error['username'] = "Username Already Taken, Please Choose another";
  }
  if($_POST['hash'] !== $_POST['confirm_hash']){
    $error['hash'] = "Password Does Not Match";
  }
  if(empty($error)){
    $clean = array_map('trim', $_POST);
    $reg = registerUser($econn, $clean);
    getNewInfo($econn,$clean, $reg);
  }
  var_dump($error);
}
?>
<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
  <title>TUNSE|Workers</title>
  <!-- for-mobile-apps -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Catchy Carz Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
  Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
  function hideURLbar(){ window.scrollTo(0,1); } </script>
  <!-- //for-mobile-apps -->
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
  <link rel="stylesheet" type="text/css" href="css/zoomslider.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/component.css" />
  <link rel="stylesheet" type="text/css" href="css/jquery-ui1.css">
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
  <script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>
  <!--/web-fonts-->
  <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,600italic,300,300italic,700,400italic' rel='stylesheet' type='text/css'>
  <link href='//fonts.googleapis.com/css?family=Wallpoet' rel='stylesheet' type='text/css'>
  <link href='//fonts.googleapis.com/css?family=Ubuntu:400,500,700,300' rel='stylesheet' type='text/css'>
  <!--//web-fonts-->
  <style media="screen">
  .slider {
    -webkit-appearance: none;
    width: 100%;
    height: 15px;
    border-radius: 5px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
  }
  .slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
  }
  .slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
  }
  .stars-outer {
    display: inline-block;
    position: relative;
    font-family: FontAwesome;
  }
  .stars-outer::before {
    content: "\f006 \f006 \f006 \f006 \f006";
  }
  .stars-inner {
    position: absolute;
    top: 0;
    left: 0;
    white-space: nowrap;
    overflow: hidden;
    width: 0;
  }
  .stars-inner::before {
    content: "\f005 \f005 \f005 \f005 \f005";
    color: #f8ce0b;
  }
  .attribution {
    font-size: 12px;
    color: #444;
    text-decoration: none;
    text-align: center;
    position: fixed;
    right: 10px;
    bottom: 10px;
    z-index: -1;
  }
  .attribution:hover {
    color: #1fa67a;
  }
  </style>
</head>
<body onpageshow="getWorkers(<?php echo $_GET['id'] ?>); getWorkersModal(<?php echo $_GET['id'] ?>)">
  <!--/banner-section-->
  <input type="hidden" id="session" name="" value="<?php echo $sid ?>">
  <input type="hidden" id="skill_id" name="" value="<?php echo $_GET['id'] ?>">
  <div id="demo-1" class="banner-inner">
    <div class="banner-inner-dott">
      <div class="header-top">
        <!-- /header-left -->
        <div class="header-left">
          <!-- /sidebar -->
          <div id="sidebar">
            <h4 class="menu">TUNSE</h4>
            <ul>
              <li><a href="#">Users <i class="glyphicon glyphicon-triangle-bottom"> </i> </a>
                <ul>
                  <li><a href="dashboard"><span>USERS</span></a></li>
                  <li><a href="myDashboard"><span>TWORKERS</span></a></li>
                </ul>
              </li>
            </ul>
            <div id="sidebar-btn">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
          <script>
          var sidebarbtn = document.getElementById('sidebar-btn');
          var sidebar = document.getElementById('sidebar');
          sidebarbtn.addEventListener('click', function () {
            if(sidebar.classList.contains('visible')){
              sidebar.classList.remove('visible');
            }else {
              sidebar.className = 'visible';
            }
          });
          </script>
          <?php if(isset($_SESSION['u_id'])){ ?>
            <!-- //sidebar -->
            <div class="tag"><a href="dashboard" ><span class="glyphicon glyphicon-tag"></span> <?php
            $Username = ucfirst($username);
            echo "Welcome, $Username";
            ?> </a></div>
          <?php }else{ ?>
            <div class="tag"><a href="#" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-log-in"></span> Sign Up</a></div>
          <?php } ?>
          <div class="tag"><a href="tworkerRegistration" ><span class="glyphicon glyphicon-log-in"></span> Become A Tworker</a></div>
        </div>
        <!-- //header-left -->
        <div class="search-box">
          <ul>
            <li>
              <?php if(isset($_SESSION['u_id'])){
              }else{
                ?>
                <button id="showRight" class="navig">Login </button>
              <?php } ?>
              <div class="cbp-spmenu-push">
                <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
                  <h3>Login</h3>
                  <div class="login-inner">
                    <div class="login-top">
                      <form action="tunsehome" method="post">
                        <input type="text" name="email" class="email" placeholder="Email" required=""/>
                        <input type="password" name="hash" class="password" placeholder="Password" required=""/>
                        <input type="checkbox" id="brand" value="">
                        <label for="brand"><span></span> Remember me</label>
                        <div class="login-bottom one">
                          <input type="submit" name="submit" value="LOGIN"/>
                        </div>
                      </form>
                      <div class="login-bottom">
                        <ul>
                          <li>
                            <a href="#">Forgot password?</a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="social-icons">
                      <ul>
                        <li><a href="#"><span class="icons"></span><span class="text">Facebook</span></a></li>
                        <li class="twt"><a href="#"><span class="icons"></span><span class="text">Twitter</span></a></li>
                        <li class="ggp"><a href="#"><span class="icons"></span><span class="text">Google+</span></a></li>
                      </ul>
                    </div>
                  </div>
                </nav>
              </div>
              <script src="js/classie2.js"></script>
              <script>
              var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
              showRight = document.getElementById( 'showRight' ),
              body = document.body;
              // showRight.onclick = function() {
              //   classie.toggle( this, 'active' );
              //   classie.toggle( menuRight, 'cbp-spmenu-open' );
              //   disableOther( 'showRight' );
              // };
              function disableOther( button ) {
                if( button !== 'showRight' ) {
                  classie.toggle( showRight, 'disabled' );
                }
              }
              </script>
              <!--Navigation from Right To Left-->
            </li>
          </ul>
        </div>
      </div>
      <div class="clearfix"></div>
      <!--banner-info-->
      <div class="banner-info">
        <h1><a href="tunsehome">TUNSE<span class="logo-sub"></span> </a></h1>
        <p>Connects you to reliable Artisan</p>
        <!--//banner-info-->
      </div>
    </div>
  </div>
  <!-- discounts-->
  <div class="modal ab fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog about" role="document">
      <div class="modal-content about">
        <div class="modal-header">
          <button type="button" class="close ab" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="discount">
            <h3>Get Offers & Discount of</h3>
            <p>Catchy Carz Brand VL in New York</p>
            <form action="#" method="post">
              <select id="country5" onchange="change_country(this.value)" class="frm-field required">
                <option selected="selected" value="-1">-Buying Time Period-</option>
                <option value="0">Just Researching</option>
                <option value="7">1 Week</option>
                <option value="14">2 Weeks</option>
                <option value="30">1 Month</option>
                <option value="60">2 Months</option>
              </select>
              <input type="text" class="Pin code" placeholder="Pin code" required="">
            </form>
          </div>
        </div>
        <div class="modal-body about">
          <div class="dis-contact">
            <h4>Contact Information</h4>
            <form action="#" method="post">
              <input type="text" name="name" class="name active" placeholder="Name" required="">
              <input type="text" name="email" class="email" placeholder="Email" required="">
              <input type="text" name="phone" class="phone" placeholder="Phone" required="">
              <div class="d-c">
                <span class="checkbox1">
                  <label class="checkbox"><input type="checkbox" name="" checked=""><i> </i>I agree to Terms and Conditions.</label>
                </span>
              </div>
              <input type="submit" value="Find Offers">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- //discounts-->
  <!-- //sign-up-->
  <div class="modal ab fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog sign" role="document">
      <div class="modal-content about">
        <div class="modal-header one">
          <button type="button" class="close sg" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="discount one">
            <h3>Sign Up</h3>
          </div>
        </div>
        <div class="modal-body about">
          <div class="login-top sign-top one">
            <form action="#" method="post">
              <input name="firstname" type="text" class="name active" placeholder="Firstname" >
              <input name="lastname" type="text" class="name active" placeholder="Lastname" >
              <input name="username" type="text" class="name active" placeholder="Username" >
              <input name="phonenumber" type="text" class="name active" placeholder="Phone Number" >
              <input type="text" name="email "class="email" placeholder="Email" required="">
              <input type="password" name="hash" class="password" placeholder="Password" required="">
              <input name="confirm_hash" type="password" class="password" placeholder="Re-type Password" required>
              <div class="year">
                <select id="stateid" onchange="getlga(this.value)" class="frm-field required">
                  <option value="">--Select State</option>
                  <?php getState($iconn); ?>
                </select>
                <select id="lga" name="lga" class="frm-field required" required>
                </select>
              </div>
              <br>
              <br>
              <div class="year">
                <select  class=""  name="country" class="frm-field required" required>
                  <option value="">--Select Country</option>
                  <?php getCountry($iconn); ?>
                </select>
              </div>
              <label class="checkbox-custom check-success">
                <input type="checkbox" name="term" id="checkbox1" value="accept">
                I agree to the Terms of Service and Privacy Policy</label>
                <label for="brand1"><span></span> Remember me?</label>
                <div class="login-bottom one">
                  <ul>
                    <li>
                      <a href="#">Forgot password?</a>
                    </li>
                    <li>
                      <input type="submit" name="register" value="SIGN UP">
                    </li>
                    <div class="clearfix"></div>
                  </ul>
                </div>
              </form>
            </div>
          </div>
          <div class="social-icons">
            <ul>
              <li><a href="#"><span class="icons"></span><span class="text">Facebook</span></a></li>
              <li class="twt"><a href="#"><span class="icons"></span><span class="text">Twitter</span></a></li>
              <li class="ggp"><a href="#"><span class="icons"></span><span class="text">Google+</span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <span id="ModalHandle">
  </span>
  <div class="service-breadcrumb">
    <div class="container">
      <div class="wthree_service_breadcrumb_left">
        <ul>
          <li><a href="tunsehome">Home</a> <i>|</i></li>
          <li>Tworkers</li>
        </ul>
      </div>
      <div class="wthree_service_breadcrumb_right">
        <h3>Tworkers</h3>
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
  <!--//breadcrumb-->
  <!--/search-car -->
  <div class="search-car w3l">
    <div class="container">
      <!--/search-car-inner -->
      <div class="search-car-inner w3l">
        <!--/search-car-left-nav -->
        <!--//search-car-left-nav -->
        <!--/search-car-right-text -->  <div class="col-md-3 search-car-left-sidebar">
        <section class="sky-form">
          <h4>Filters</h4>
          <div class="w_nav1">
            <ul class="dropdown-menu6">
              <li>
                <h4>Filter by</h4>
                <select id="country12" onchange="getSWorkers(this.value)" class="frm-field required">
                  <option>--Select Filter--</option>
                  <option value="rating">Rating</option>
                  <option value="distance">Distance</option>
                </select>
              </li>
            </ul>
          </div>
          <div class="range">
            <h4>Adjust Distance</h4>
            <ul class="dropdown-menu6">
              <li id="filter">
                <!-- <input onchange="getAWorkers(this.value,'rating')" type="range" min="1" max="100" value="1" class="slider" id="myRange"> -->
              </li>
              <p id="display_adjustment"></p>
            </ul>
          </div>
        </section>
        <!---->
      </div>
      <div class="col-md-9 search-car-right-text w3">
        <div class="well well-sm">
          <strong>Display</strong>
          <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm two"><span
              class="glyphicon glyphicon-th"></span>Grid</a>
            </div>
          </div>
          <div id="products" class="row list-group">
</div>
</div>
<!--//search-car-right-text -->
<div class="clearfix"></div>
</div>
<!--//search-car-inner -->
</div>
</div>
<!--//search-car -->
<!-- footer -->
<div class="footer">
  <div class="container">
    <div class="footer-grids">
      <div class="col-md-3 footer-grid animated wow slideInLeft" data-wow-delay=".5s">
        <h3>About Us</h3>
        <p>TUNSE is a platform that brings the T-worker (a pool of verified individuals) in the area and those who need their services together. <br>Tunse was founded to solve the need for being able to get a relaible help, wherever and whenever. </span></p>
      </div>
      <div class="col-md-3 footer-grid animated wow slideInLeft" data-wow-delay=".7s">
        <!-- <h3>Flickr Posts</h3> -->
        <div class="clearfix"> </div>
      </div>
      <div class="col-md-3 footer-grid animated wow slideInLeft" data-wow-delay=".8s">
        <!-- <h3>Blog Posts</h3> -->
      </div>
      <div class="col-md-3 footer-grid animated wow slideInLeft" data-wow-delay=".6s">
        <h3>Contact Info</h3>
        <ul>
          <li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>Covenant University
            Ota,<span> Ogun State .</span></li>
            <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">info@tunse.org</a></li>
            <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>0802 665 0762 </li>
            <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>0803 067 8010  </li>
          </ul>
        </div>
        <div class="clearfix"> </div>
      </div>
      <div class="footer-logo animated wow slideInUp" data-wow-delay=".5s">
        <h2><a href="tunsehome">TUNSE<span>Connects you to reliable Artisan</span></a></h2>
      </div>
      <div class="copy-right animated wow slideInUp" data-wow-delay=".5s">
        <p>&copy 2018 Tunse. All rights reserved</a></p>
      </div>
    </div>
  </div>
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <!---->
  <script type="text/javascript" src="js/jquery-ui.js"></script>
  <script type='text/javascript'>//<![CDATA[
    $(window).load(function(){
      $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 200000,
        values: [ 5000, 100000 ],
        slide: function( event, ui ) {  $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  });//]]>
  </script>
  <script>
  $(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
  });
  </script>
  <script type="text/javascript" src="js/showTworkersAjax.js">
  </script>
</body>
</html>
