<?php
ob_start();
session_start();
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
      <div class="login-logo">
        <a href="index.html"><img src="images/logo.png" alt=""/></a>
      </div>
      <h2 class="form-heading">login</h2>
      <div class="app-cam">
    	  <form method="post" action="u_login">


          <?php


          if(isset($message['login'])){
            $err =displayErrors($message, 'login');
            echo $err;
          }
          if(isset($error['email'])){
            $err =displayErrors($error, 'email');
            echo $err;
          }
          if(isset($error['hash'])){
            $err =displayErrors($error, 'hash');
            echo $err;
          }
           ?>
    		<input name="email" type="text" class="text" placeholder="email">
    		<input name="hash" type="password"  placeholder="Password">
    		<div class="submit"><input name="submit" type="submit"  value="Login"></div>
    		<div class="login-social-link">
              <a href="index.html" class="facebook">
                  Facebook
              </a>
              <a href="index.html" class="twitter">
                  Twitter
              </a>
            </div>
    		<ul class="new">
    			<li class="new_left"><p><a href="#">Forgot Password ?</a></p></li>
    			<li class="new_right"><p class="sign">New here ?<a href="u_register"> Sign Up</a></p></li>
    			<div class="clearfix"></div>
    		</ul>
    	</form>
      </div>
       <div class="copy_layout login">
          <p>Copyright &copy; 2015 Modern. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
       </div>

    </body>
  </html>
