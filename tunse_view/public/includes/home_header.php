<!DOCTYPE html>
<html>
<head>
<title>TUNSE| Home</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link rel="shortcut icon" href="asset/ico/tunse.jpg">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="css/zoomslider.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<link rel="stylesheet" type="text/css" href="css/recommend.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui1.css">
		<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>
<!--/web-fonts-->
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,600italic,300,300italic,700,400italic' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Wallpoet' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Ubuntu:400,500,700,300' rel='stylesheet' type='text/css'>
	<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "8fa7ddba-7819-47f5-aff3-60aff6f4fcb1",
      notifyButton: {
        enable: true,
      },
    });
  });
</script>
<!--//web-fonts-->
</head>
<body>

<!--/banner-section-->
	<div id="demo-1" data-zs-src='["images/2.jpg", "images/1.jpg", "images/3.jpg"]' data-zs-overlay="dots">
		<div class="demo-inner-content">
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
							    <!-- <li><a href="compare.html"></a></li>
							    <li><a href="cars.html">Used Cars <i class="glyphicon glyphicon-triangle-bottom"> </i></a>
							      <ul>
								  <li><a href="used.html">Find Used cars</a></li>
									 <li><a href="sell.html">Sell Your Car</a></li>
									 <li><a href="cars.html"><span>Search Used Cars</span></a></li>
									 <li class="last"><a href="valuation.html"><span>Used Car Valuation</span></a></li>
									 <li><a href="dealer.html"><span>Locate Dealer</span></a></li>

								  </ul>
							   </li>
							   <li><a href="sell.html">Sell Your Car</a></li>
							   <li><a href="news.html">News And Reviews</a></li>
							   <li><a href="dealer.html">Dealers And Services</a></li>
							   <li><a href="#">More <i class="glyphicon glyphicon-triangle-bottom"> </i> </a>
							      <ul>
									  <li><a href="loan.html"><span>Car Loan</span></a></li>
									  <li><a href="codes.html"><span>Short Codes</span></a></li>
									  <li><a href="accessories.html"><span>Car Accessories</span></a></li>
									  <li><a href="tips.html"><span>Tips and Advices</span></a></li>
									  <li class="last"><a href="help.html"><span>Privacy Policy</span></a></li> -->
								 <!-- </ul>
							   </li>
							   <li><a href="insurance.html">Insurance</a></li>
							 <li><a href="app.html">Catchy Carz app</a><li> -->
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
          ?> </a>
          <a href="contact" ><span class="glyphicon glyphicon-tag"></span>
           My Tworkers Directory
          </a></div>
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
                  <li>
								 <form action="" method="post">
									<input type="text" name="email" class="email" placeholder="Email" required=""/>
									<input type="password" name="hash" class="password" placeholder="Password" required=""/>
									<input type="checkbox" id="brand" value="">
									<label for="brand"><span></span> Remember me</label>
                  <div class="login-bottom one">
                  <input type="submit" name="submit" value="LOGIN"/>
                </div>
								</form>
                </li>
								<!-- <div class="login-bottom">
									<ul>
										<li>
											<a href="#">Forgot password?</a>
										</li>

									</ul>

								</div> -->
								<!-- <div class="clearfix"></div> -->
							</div>
							<!-- <div class="social-icons">
							<ul>
								<li><a href="#"><span class="icons"></span><span class="text">Facebook</span></a></li>
								<li class="twt"><a href="#"><span class="icons"></span><span class="text">Twitter</span></a></li>
								<li class="ggp"><a href="#"><span class="icons"></span><span class="text">Google+</span></a></li>
							</ul>
						</div> -->
							</div>
							</nav>
						</div>
				<script src="js/classie2.js"></script>
						<script>
							var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
								showRight = document.getElementById( 'showRight' ),
								body = document.body;

							showRight.onclick = function() {
								classie.toggle( this, 'active' );
								classie.toggle( menuRight, 'cbp-spmenu-open' );
								disableOther( 'showRight' );
							};

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

						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
