<?php
ob_start();
session_start();
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

  if(empty($error)){
    $clean = array_map('trim', $_POST);
    loginUser($econn, $clean);
  }
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
  if(empty($_POST['email'])){
    $error['email'] = "Please Enter Your EMail";
  }
  if(empty($_POST['firstname'])){
    $error['firstname'] = "Please Enter Your Firstname";
  }
  if(empty($_POST['lastname'])){
    $error['lastname'] = "Please Enter Your Lastname";
  }
  if(empty($_POST['username'])){
    $error['username'] = "You did not Enter Your Username";
  }
  if(empty($_POST['phonenumber'])){
    $error['phonenumber'] = "You did not Enter Your phonenumber";
  }
  if(empty($_POST['confirm_hash'])){
    $error['confirm_hash'] = "You did not Confirm Your password";
  }
  if(empty($_POST['state'])){
    $error['state'] = "You did not Enter Your State";
  }
  if(empty($_POST['lga'])){
    $error['lga'] = "You did not Enter Your Lga";
  }
  if(empty($_POST['country'])){
    $error['country'] = "You did not Enter Your Country";
  }
  if(empty($_POST['term'])){
    $error['term'] = "You need to accept term";
  }

  if(empty($_POST['hash'])){
    $error['hash'] = "You did not Enter Your Password";
  }
  if(empty($error)){
    $clean = array_map('trim', $_POST);
    $reg = registerUser($econn, $clean);

 

      $red = getNewInfo($econn,$clean, $reg);
    $email = $_POST['email'];
     $hid = $red[0];
     $token = $red[1];
     $username = $_POST['username'];
  
     
  require_once "Mail.php"; // PEAR Mail package
require_once ('Mail/mime.php'); // PEAR Mail_Mime packge   
     
      $from = "info@mckodev.com.ng"; //enter your email address
 $to = $email; //enter the email address of the contact your sending to
 $subject = "Tunse Users Verification"; // subject of your email

$headers = array ('From' => $from,'To' => $to, 'Subject' => $subject);

// $text = ''; // text versions of email.
$html = "<html><body>Hello, $username <br>Follow the link below to verify your account <br>https://tunse.mckodev.com.ng/usersVerification?hid=$hid&token=$token"; // html versions of email.

$crlf = "\n";

$mime = new Mail_mime($crlf);
// $mime->setTXTBody($text);
$mime->setHTMLBody($html);

//do not ever try to call these lines in reverse order
$body = $mime->get();
$headers = $mime->headers($headers);

 $host = "localhost"; // all scripts must use localhost
 $username = "qservers@mckodev.com.ng"; //  your email address (same as webmail username)
 $password = "Digital2017+"; // your password (same as webmail password)

$smtp = Mail::factory('smtp', array ('host' => $host, 'auth' => true,
'username' => $username,'password' => $password));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
    
$error['mail']= "<p>" . $mail->getMessage() . "</p>";
}
else {
	$success = [];
 		$success['mail'] = "A verification link has been sent to your mail"; 
}
    
    
    
    
    
    
    
    
    
    
  }else{
    foreach ($error as $err) {
    echo  "<div class=\"alert alert-danger\" role=\"alert\">
        <strong>Warning!</strong>$err
      </div>";
  }
  echo  "<div class=\"alert alert-warning\" role=\"alert\">
      <strong>Hence!</strong>Your Registration Was not Successful
    </div>";

}

}
include 'includes/home_header.php';
?>


		    <!--banner-info-->
			<div class="banner-info">
			  <h1><a href="tunsehome">TUNSE<span class="logo-sub"></span> </a></h1>

				<p>Connects you to reliable Artisan</p>
        <?php if(isset($_GET['msg'])){
          $msg = str_replace('_', ' ', $_GET['msg']);
        echo  "<div class=\"alert alert-danger\" role=\"alert\">
					<strong>Warning! </strong>$msg
				</div>";
        } ?>
        <?php if(isset($_GET['success'])){
          $msg = str_replace('_', ' ', $_GET['success']);
        echo  "<div class=\"alert alert-success\" role=\"alert\">
					<strong>Successful! </strong>$msg
				</div>";
        } 
        
        
        if(isset($error['mail'])){
                     echo '<div class="alert alert-danger" role="alert">
    <strong>Alert! </strong>'.$error['mail'].
    '</div>';
                    }
                    if(isset($success['mail'])){
                        echo '<div class="alert alert-success" role="alert">
    <strong>Successful! </strong>'.$success['mail'].
    '</div>';
                    }
        
        
        ?>
        
        
        
			       <form action="#" method="post">
					<div class="search-two">
					<select id="country" onchange="showWorkerPage('findtworkers?id='+this.value)" class="frm-field required">
						<option value="null">Select from skill category</option>
            <?php getSkill($econn) ?>
					</select>
				</div>

				</form>
			</div>
				<!--//banner-info-->
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

								</div>
						</div>
						 <div class="modal-body about">

								<div class="dis-contact">
								  <h4>Contact Information</h4>
<input type="hidden" id="session" name="" value="<?php echo $sid ?> ">
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
                  <input name="firstname" type="text" class="name active" placeholder="Firstname" required>
                  <input name="lastname" type="text" class="name active" placeholder="Lastname" required>
                  <input name="username" type="text" class="name active" placeholder="Username" required>
                  <input name="phonenumber" type="text" class="name active" placeholder="Phone Number" required>
									<input type="text" name="email" class="email" placeholder="Email" required="">
									<input type="password" name="hash" class="password" placeholder="Password" required="">
                  <input name="confirm_hash" type="password" class="password" placeholder="Re-type Password" required>
                  <div class="year">
                  <select id="stateid" name="state" onchange="getlga(this.value)" class="frm-field required" required>
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
									<input type="radio" name="term" id="" value="accept" required>
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
						 <!-- <div class="social-icons">
									<ul>
										<li><a href="#"><span class="icons"></span><span class="text">Facebook</span></a></li>
										<li class="twt"><a href="#"><span class="icons"></span><span class="text">Twitter</span></a></li>
										<li class="ggp"><a href="#"><span class="icons"></span><span class="text">Google+</span></a></li>
									</ul>
									</div> -->
					</div>
				</div>
			</div>
			<!-- //sign-up-->
				<!-- /location-->
				<div class="modal ab fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog sign" role="document">
					<div class="modal-content about">
						<div class="modal-header one">
							<button type="button" class="close sg" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<div class="discount one">
									<h3>Please Tell Us Your City</h3>

								</div>
						</div>
						 <div class="modal-body about">
								<div class="login-top sign-top location">
								 <form action="#" method="post">
				                      <select id="country12" onchange="change_country(this.value)" class="frm-field required">
														<option value="null"> Select City</option>
														<option value="city">Amsterdam</option>
														<option value="city">Bahrain</option>
														<option value="city">Cannes</option>
														<option value="city">Dublin</option>
														<option value="city">Edinburgh</option>
														<option value="city">Florence</option>
														<option value="city">Georgia</option>
														<option value="city">Hungary</option>
														<option value="city">Hong Kong</option>
														<option value="city">Johannesburg</option>
														<option value="city">Kiev</option>
														<option value="city">London</option>
														<option value="city">Others...</option>
										</select>
								</form>
							     </div>


						 </div>


					</div>
				</div>
			</div>
			<!-- //location-->
      <!--/car-loan-mid-->
        <div class="car-loan-mid w3l">
         <h3 class="tittle">Categories</h3>
            <div class="categories">
            <?php


              $stmt = $econn->prepare("SELECT * FROM skill");
              $stmt->execute();
              $result = "";
              while($row = $stmt->fetch(PDO::FETCH_BOTH)){
                extract($row);?>

                <div class="col-md-3 focus-grid">
                  <a href="findtworkers?id=<?php echo $skill_id ?>">
                    <div class="focus-border">
                      <div class="focus-layout">
                        <div class="focus-image"><i class="<?php echo $icon ?>"></i></div>
                        <h4 class="clrchg"><?php echo $skill ?></h4>
                      </div>
                    </div>
                  </a>
                </div>
                <?php
              }


?>




              <div class="clearfix"></div>

          </div>
        </div>
        <!--//car-loan-top-->

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
<script type="text/javascript" src="js/jquery.zoomslider.min.js"></script>
		<script type="text/javascript">
				 $(window).load(function() {
				  $("#flexiselDemo").flexisel({
					visibleItems:1,
					animationSpeed: 1000,
					autoPlay: true,
					autoPlaySpeed:1000,
					pauseOnHover:true,
					enableResponsiveBreakpoints: true,
					responsiveBreakpoints: {
						portrait: {
							changePoint:480,
							visibleItems: 1
						},
						landscape: {
							changePoint:640,
							visibleItems: 1
						},
						tablet: {
							changePoint:768,
							visibleItems: 1
						}
					}
				});
				});
				</script>
						<script type="text/javascript">
				 $(window).load(function() {
				  $("#flexiselDemo1").flexisel({
					visibleItems: 4,
					animationSpeed: 1000,
					autoPlay: true,
					autoPlaySpeed: 3000,
					pauseOnHover:true,
					enableResponsiveBreakpoints: true,
					responsiveBreakpoints: {
						portrait: {
							changePoint:480,
							visibleItems: 1
						},
						landscape: {
							changePoint:640,
							visibleItems: 2
						},
						tablet: {
							changePoint:768,
							visibleItems: 3
						}
					}
				});
				});
				</script>
					<script type="text/javascript" src="js/jquery.flexisel.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/u_ajax.js">

</script>


</body>
</html>
