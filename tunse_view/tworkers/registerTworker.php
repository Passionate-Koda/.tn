<?php
session_start();
ob_start();
//require_once "Mail.php"; // PEAR Mail package
//require_once ('Mail/mime.php'); // PEAR Mail_Mime packge

$error = [];
if(array_key_exists('submit', $_POST)){
  // die(var_dump($_POST));
  if(doesEmailExist($econn, $_POST['email'])){
    $error['email'] = "Email Already Exist";
  }
  if(doesPhoneNumberExist($econn, $_POST['phonenumber'])){
    $error['phonenumber'] = "This Phone number has been used to Register";
  }
  if($_POST['hash'] !== $_POST['confirm_hash']){
    $error['hash'] = "Password Does Not Match";
  }
  if(empty($error)){

// die(var_dump($red));
$email = $_POST['email'];

     $firtsname = $_POST['firstname'];
     $lastname = $_POST['surname'];
     $clean = array_map('trim', $_POST);
      $red = registerTworker($econn, $clean);



//       $from = "info@mckodev.com.ng"; //enter your email address
//  $to = $email; //enter the email address of the contact your sending to
//  $subject = "Tunse Tworkers Verification"; // subject of your email
//
// $headers = array ('From' => $from,'To' => $to, 'Subject' => $subject);

// $text = ''; // text versions of email.
// $html = "<html><body>Hello, $firstname $lastname <br>Follow the link below to verify your account <br>https://tunse.mckodev.com.ng/tworkersVerification?hid=$hid&token=$token"; // html versions of email.
//
// $crlf = "\n";
//
// //$mime = new Mail_mime($crlf);
// // $mime->setTXTBody($text);
// //$mime->setHTMLBody($html);
//
// //do not ever try to call these lines in reverse order
// //$body = $mime->get();
// //$headers = $mime->headers($headers);
//
//  $host = "localhost"; // all scripts must use localhost
//  $username = "qservers@mckodev.com.ng"; //  your email address (same as webmail username)
//  $password = "Digital2017+"; // your password (same as webmail password)
//
// //$smtp = Mail::factory('smtp', array ('host' => $host, 'auth' => true,
// // 'username' => $username,'password' => $password));
//
// //$mail = $smtp->send($to, $headers, $body);
//
// //if (PEAR::isError($mail)) {
//
// //$error['mail']= "<p>" . $mail->getMessage() . "</p>";
// }
// else {
// 	$success = [];
//  		$success['mail'] = "A verification link has been sent to your mail";
// }


// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
require '/usr/share/php/libphp-phpmailer/class.smtp.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.mckodev.com.ng';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'qservers@mckodev.com.ng';                 // SMTP username
    $mail->Password = 'Mayowa02';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('qservers@mckodev.com.ng', 'Mailer');
    // $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress($email);               // Name is optional
    $mail->addReplyTo('qservers@mckodev.com.ng', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
     $hid = $red[0];
     $token = $red[1];
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

//      	include('Mail.php'); // includes the PEAR Mail class, already on your server.

// 		$username = 'info@mckodev.com.ng'; // your email address
//     $password = '6Z4m7Nar3u'; // your email address password

// 		$from = "info@mckodev.com.ng";
// 		$to = $email;
// 		$subject = "Tunse Tworkers Verification";
// 		$body= "Follow this link to verify your account https://tunse.mckodev.com.ng/tworkersVerification?hid=$hid&token=$token";




// 		$headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject); // the email headers
// 		$smtp = Mail::factory('smtp', array ('host' =>'localhost', 'auth' => true, 'username' => $username, 'password' => $password, 'port' => '25')); // SMTP protocol with the username and password of an existing email account in your hosting account
// 		$mail = $smtp->send($to, $headers, $body); // sending the email

// 		if (PEAR::isError($mail)){
// 		echo("<p>" . $mail->getMessage() . "</p>");
// 		}
// 		else {
// // 		echo("<p>A verification mail has been sent to your email!</p>");
// 		$success = [];
// 		$success['mail'] = "A verification link has been sent to your mail";
// 		// header("Location: http://www.example.com/"); // you can redirect page on successful submission.
// 		}





     //From email address and
            // loginTworker($econn,$clean);


  }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>Tunse| Tworkers Registration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Tunse">

        <meta http-equiv="x-pjax-version" content="v173">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!-- fav and touch icons -->
        <link rel="shortcut icon" href="asset/ico/tunse.jpg">

        <link rel="stylesheet" href="asset/styles/9281c719.vendor.css"/>
        <link rel="stylesheet" href="asset/styles/3fc417cd.main.css"/>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
        <![endif]-->
    </head>

    <body class="animated fadeIn">

		<div class="content content-full">
			<div class="container">
				<div class="signin-wrapper">
					<div class="tab-content">


						<div class="signup tab-pane fade in active" id="signup">
							<div class="signup-brand">
								<a href="tunsehome"></a><img src="asset/images/dummy/logo2.png" alt="Sign up"></a>
							</div>
							<h1 class="text-lead">Create an account</h1>
							<p>Create an account here to work as a tworker add your skills and start getting task on TUNSE. </p>
							<p>Already have an account, please <a href="tworkers_login">Signin</a>.</p>

							<form id="signup-form" method="POST" data-validate="form" action="" role="form">
                <?php
                // displaying error
                    if(isset($error['email'])){
                      $err =displayErrors($error, 'email');
                      echo $err;
                    }
                    if(isset($error['phonenumber'])){
                      $err =displayErrors($error, 'phonenumber');
                      echo $err;
                    }
                    if(isset($error['hash'])){
                      $err =displayErrors($error, 'hash');
                      echo $err;
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
								<div class="row">
									<div class="col-sm-5">
                    <p>Enter your personal details below</p>
                    <div class="form-group">
                      <label class="control-label text-inverse" for="usernameUp">Surname</label>
                      <input type="text" class="form-control" name="surname" id="usernameUp" required=""  autocomplete="off">

                    <div class="form-group">
                      <label class="control-label text-inverse" for="usernameUp">Firstname</label>
                      <input type="text" class="form-control" name="firstname" id="usernameUp" required="" autocomplete="off">

                    </div>
                    <div class="form-group">
                      <label class="control-label text-inverse" for="usernameUp">Middlename</label>
                      <input type="text" class="form-control" name="middlename" id="usernameUp" required=""  autocomplete="off">
                    </div>
                    <div class="form-group">
                      <label class="control-label text-inverse" for="usernameUp">Phonenumber</label>
                      <input type="text" class="form-control" name="phonenumber" id="usernameUp" required="" minlength="11" maxlength="11" autocomplete="off">
                    </div>
    <p> Enter your account details below</p>
                    <div class="form-group">
                      <label class="control-label text-inverse" for="emailUp">Email</label>
                      <input type="email" class="form-control" name="email" id="emailUp" required="" autocomplete="off">
                      <p class="helper-block text-muted"><small><strong>Type carefully!</strong> You will be sent a confirmation email.</small></p>
                    </div>

                    <div class="form-group">
                      <label class="control-label text-inverse" for="passwordUp">Password</label>
                      <input type="password" class="form-control" name="hash" id="passwordUp" required="" minlength="4">
                      <p class="helper-block text-muted"><small>The longer the better. Include numbers for more security.</small></p>
                    </div>

                    <div class="form-group">
                      <label class="control-label text-inverse" for="cpasswordUp">Confirm Password</label>
                      <input type="password" class="form-control" name="confirm_hash" id="cpasswordUp">
                      <p class="helper-block text-muted"><small>Enter your password again!</small></p>
                    </div>

                    <div class="form-group margin-top">
                      <div class="nice-checkbox">
                        <input class="checkbox-o" value="accept" type="checkbox" name="term" id="newsletter">
                        <label for="newsletter">Accept Terms and Conditions</label>
                      </div>
                    </div>

                    <div class="form-group form-actions">
                      <input name="submit" type="submit" class="btn btn-primary" value="Create account">
                    </div>

                  </div>

									</div>
								</div>

							</form><!--/#signup-form-->
						</div><!--/#signup-->

					</div><!--/tab-content-->

					<div class="signin-footer">
						<ul class="list-inline pull-right">
							<li><a href="#">Knowledge base</a></li>
						</ul>
						<ul class="list-inline">
							<li>&copy; 2018 Tunse</li>
							<li><a href="#">Terms of Use</a></li>
							<li><a href="#">Privacy Policy</a></li>
						</ul>
					</div>

				</div><!--/signin-wapper-->

			</div><!--/container-->
		</div><!--/content-->



        <!-- javascript
        ================================================== -->
        <script src="asset/scripts/39914ff3.vendor-main.js"></script>
        <script src="asset/scripts/756399db.vendor-usefull.js"></script>
        <script src="asset/scripts/e7058f60.vendor-form.js"></script>
        <script src="asset/scripts/fc9d433c.vendor-editor.js"></script>
        <!--[if lte IE 8]>
        <script src="scripts/eae815b5.excanvas.js"></script>
        <![endif]-->
        <script src="asset/scripts/2ce1156c.vendor-graph.js"></script>
        <script src="asset/scripts/37a77790.vendor-table.js"></script>
        <script src="asset/scripts/1581b2aa.vendor-maps.js"></script>
        <script src="asset/scripts/5f4fd25b.vendor-util.js"></script>


        <!-- required stilearn template js -->
        <script src="asset/scripts/5917523f.main.js"></script>
        <!-- This scripts will be reload after pjax or if popstate event is active (use with class .re-execute) -->
        <script src="asset/scripts/89c3d6c9.initializer.js"></script>

        <script>
          (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
          function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
          e=o.createElement(i);r=o.getElementsByTagName(i)[0];
          e.src='../../../../www.google-analytics.com/analytics.js';
          r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
          ga('create','UA-71722129-1');ga('send','pageview');
        </script>

    </body>


</html>
