<?php
ob_start();
$error = [];
if(array_key_exists('submit', $_POST)){
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

    $red = getNewInfo($econn,$clean, $reg);
    $email = $_POST['email'];
     $hid = $red[0];
     $token = $red[1];
     $username = $_POST['username'];
  
     
  
     
      $from = "info@mckodev.com.ng"; //enter your email address
 $to = $email; //enter the email address of the contact your sending to
 $subject = "Users Verification"; // subject of your email

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
  }
  
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Welcome to tunse</title>
</head>
<body>
  <h1>Welcome to Tunse</h1>
  <a href="ulogin"><li>Login</li></a>
  <a href="tworkers"><li>Twokers</li></a>
  <hr>
  <h2 class="form-heading">Register</h2>
  <form class="form-signin app-cam" action="u_register" method="post"><hr>
    <?php
    if(isset($error['email'])){
      $err =displayErrors($error, 'email');
      echo $err;
    }
    if(isset($error['hash'])){
      $err =displayErrors($error, 'hash');
      echo $err;
    }
     ?>
    <p>Enter your personal details below</p><hr>
    <input name="firstname" type="text" class="form-control1" placeholder="Firstname" autofocus="" required><hr>
    <input name="lastname" type="text" class="form-control1" placeholder="Lastname" autofocus="" required><hr>
    <input name="username" type="text" class="form-control1" placeholder="Username" autofocus="" required><hr>
    <input name="phonenumber" type="text" class="form-control1" placeholder="Phone Number" autofocus="" required><hr>
    <input name="email" type="text" class="form-control1" placeholder="Email" autofocus="" required><hr>
    <input name="hash" type="password" class="form-control1" placeholder="Password" required><hr>
    <input name="confirm_hash" type="password" class="form-control1" placeholder="Re-type Password" required><hr>
    <select onchange="getlga(this.value)" class="" id='stateid' name="state" required>
      <option value="">--Select State</option>
      <?php getState($iconn); ?>
    </select>

    <select id="lga" name="lga" required>
    </select><hr>
    <select  class=""  name="country" required>
      <option value="">--Select Country</option>
      <?php getCountry($iconn); ?>
    </select>
    <label class="checkbox-custom check-success">
      <input name="term" type="checkbox" value="accept" id="checkbox1" required> <label for="checkbox1">I agree to the Terms of Service and Privacy Policy</label>
    </label>
    <button name="submit" class="btn btn-lg btn-success1 btn-block" type="submit">Submit</button>
    <div class="registration">
      Already Registered.
      <a class="" href="u_login">
        Login
      </a>
    </div>
  </form>
  <div class="copy_layout login register">
    <p>Copyright &copy; 2015 Modern. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
  </div>
  <script type="text/javascript" src="u_ajax">

  </script>


</body>
</html>
