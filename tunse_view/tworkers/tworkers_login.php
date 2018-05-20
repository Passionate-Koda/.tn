<?php
ob_start();
session_start();
// $page_name = "Tworkers|Login";
// define("REC_PATH", dirname(dirname(__FILE__)));
// include REC_PATH.'/includes/header.php';


  $error = [];
  if(array_key_exists('submit', $_POST)){
    if(empty($_POST['email'])){
      $error['email'] = "Please Enter Your EMail";
    }

    if(empty($_POST['hash'])){
      $error['hash'] = "Please Enter Your Password";
    }

    if(empty($error)){
      var_dump($_POST);
      $clean = array_map('trim', $_POST);
      loginTworker($econn, $clean);

    }


  }


?>



<!DOCTYPE html>
<html lang="en">


<head>
        <meta charset="utf-8">
        <title>Stilearn Admin Bootstrap</title>
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
						<div class="row tab-pane fade in active" id="signin">
							<div class="col-md-offset-1 col-md-6 hidden-sm hidden-xs">
								<div id="carousel-example" class="carousel slide" data-ride="carousel">
							      	<ol class="carousel-indicators">
								        <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
								        <li data-target="#carousel-example" data-slide-to="1"></li>
								        <li data-target="#carousel-example" data-slide-to="2"></li>
								        <!-- <li data-target="#carousel-example" data-slide-to="3"></li> -->
								        <!-- <li data-target="#carousel-example" data-slide-to="4"></li> -->
							      	</ol>
							      	<div class="carousel-inner">
								        <div class="item active">
								          	<img src="images/1.jpg" alt="Slide image">
								        </div>
								        <div class="item">
								          	<img src="images/2.jpg" alt="Slide image">
								        </div>
								        <div class="item">
								          	<img src="images/3.jpg" alt="Slide image">
								        </div>
								        <!-- <div class="item">
								          	<img src="asset/images/dummy/4e81cd8d.img6.png" alt="Slide image">
								        </div>
								        <div class="item">
								          	<img src="asset/images/dummy/3e4d8287.img3.png" alt="Slide image">
								        </div> -->
							      	</div>
							      	<a class="left carousel-control" href="#carousel-example" data-slide="prev">
							        	<span class="glyphicon glyphicon-chevron-left"></span>
							      	</a>
							      	<a class="right carousel-control" href="#carousel-example" data-slide="next">
							        	<span class="glyphicon glyphicon-chevron-right"></span>
							      	</a>
							    </div>
							</div><!--/cols-->

							<div class="col-md-offset-1 col-md-4 col-sm-offset-2 col-sm-8">
								<div class="signin">
									<div class="signin-brand">
										<a href="page-signin.html">
											<img class="lazy" src="asset/images/dummy/logo2.png" alt="Sign In">
										</a>
									</div><!--/signin-brand-->

									<form action="" method="POST" data-validate="form" role="form" id="signin-form">
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
                     <?php if(isset($_GET['msg'])){
                       $msg = str_replace('_', ' ', $_GET['msg']);
                     echo  "<div class=\"alert alert-danger\" role=\"alert\">
                       <strong>Warning!</strong>$msg
                     </div>";
                     } ?>
										<p><small>Stilearn Admin account. <a href="#">Learn more?</a></small></p>
										<div class="form-group">
											<div class="input-group input-group-in">
												<span class="input-group-addon text-muted">@</span>
												<input type="text" class="form-control" name="email" required="" minlength="4" placeholder="email" autocomplete="off">
											</div><!--/input-group-->
										</div><!--/form-group-->

										<div class="form-group">
											<div class="input-group input-group-in">
												<span class="input-group-addon text-muted"><i class="fa fa-circle-o"></i></span>
												<input type="password" class="form-control" name="hash" required="" minlength="4" placeholder="Password">
											</div><!--/input-group-->
										</div><!--/form-group-->

										<div class="form-group">
											<div class="nice-checkbox">
												<input  class="checkbox-o" type="checkbox" name="keep-signin" id="keep-signin">
												<label for="keep-signin">Keep me sign in</label>
											</div>
										</div><!--/form-group-->

										<div class="form-group form-actions">
											<input name="submit" type="submit" class="hidden-sm btn btn-primary" value="Sign In">
											<!-- <input type="submit" class="visible-sm btn btn-lg btn-block btn-primary" value="Sign In"> -->
										</div><!--/form-group-->

										<p>
											<small>
												<a href="#modalRecover" data-toggle="modal">Can't Access your Account?</a><br>
												<a href="#" class="hidden-sm">Sign in with another account?</a>
											</small>
										</p>
										<p class="hidden-sm">
											<a href="#" rel="tooltip" title="Signin with Twitter account" class="btn btn-sm btn-info"><span class="fa fa-twitter"></span></a>
											<a href="#" rel="tooltip" title="Signin with Google account" class="btn btn-sm btn-danger"><span class="fa fa-google-plus"></span></a>
											<a href="#" rel="tooltip" title="Signin with Github account" class="btn btn-sm btn-cloud"><span class="fa fa-github"></span></a>
										</p>

										<p class="margin-top"><small>Don't have a account? <a href="tworkerRegistration"><strong>Creata an Account</strong></a></small></p>
									</form><!--/#signin-form-->
								</div><!--/signin-->


								<!-- modalRecover -->
	                            <div class="modal fade" id="modalRecover" tabindex="-1" role="dialog" aria-labelledby="modalRecoverLabel" aria-hidden="true">
	                                <div class="modal-dialog">
	                                    <div class="modal-content">
	                                        <div class="modal-header">
	                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                                            <h4 class="modal-title" id="modalRecoverLabel">Reset Password</h4>
	                                        </div>
	                                        <div class="modal-body">
	                                            <form action="http://stilearning.com/items/preview/stilearn-admin/index.php" method="POST" data-validate="form" role="form" id="recover-form">
													<div class="form-group">
														<div class="input-group input-group-in">
															<span class="input-group-addon text-muted">@</span>
															<input type="email" class="form-control" name="recover" required="" autocomplete="off">
														</div><!--/input-group-->
													</div><!--/form-group-->
													<p class="text-muted"><small>Enter email address and we will send you a link to reset your password.</small></p>
												</form>
	                                        </div>

	                                        <div class="modal-footer">
	                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                                            <button type="button" class="btn btn-primary">Send reset link</button>
	                                        </div>
	                                    </div><!-- /.modal-content -->
	                                </div><!-- /.modal-dialog -->
	                            </div><!-- /.modal -->


							</div><!--/cols-->
						</div><!--/row-->

						<!-- <div class="signup tab-pane fade" id="signup">
							<div class="signup-brand">
								<img src="asset/images/dummy/782e8c3f.stilearn-logo2.png" alt="Sign up">
							</div>
							<h1 class="text-lead">Create an account</h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, ad, sint, ea, dicta dolor nesciunt adipisci molestias molestiae ex fugit sunt quia praesentium? Deserunt atque tenetur mollitia perspiciatis doloribus sint. By creating an account you agree to the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</p>
							<p>Already have an account, please <a data-toggle="tab" href="#signin">Signin</a>.</p>

							<form id="signup-form" data-validate="form" action="http://stilearning.com/items/preview/stilearn-admin/index.php" role="form">
								<div class="row">
									<div class="col-sm-5">
										<div class="form-group">
											<label class="control-label text-inverse" for="usernameUp">Username</label>
											<input type="text" class="form-control" name="usernameUp" id="usernameUp" required="" minlength="4" maxlength="12" autocomplete="off">
											<p class="helper-block text-muted"><small>May contain letters, digits, dashes and underscores, and should be between 4 and 12 characters long.</small></p>
										</div>

										<div class="form-group">
											<label class="control-label text-inverse" for="emailUp">Email</label>
											<input type="email" class="form-control" name="emailUp" id="emailUp" required="" autocomplete="off">
											<p class="helper-block text-muted"><small><strong>Type carefully!</strong> You will be sent a confirmation email.</small></p>
										</div>

										<div class="form-group">
											<label class="control-label text-inverse" for="passwordUp">Password</label>
											<input type="password" class="form-control" name="passwordUp" id="passwordUp" required="" minlength="4">
											<p class="helper-block text-muted"><small>The longer the better. Include numbers for protein.</small></p>
										</div>

										<div class="form-group">
											<label class="control-label text-inverse" for="cpasswordUp">Confirm Password</label>
											<input type="password" class="form-control" name="hash" id="cpasswordUp">
											<p class="helper-block text-muted"><small>Enter your password again!</small></p>
										</div>

										<div class="form-group margin-top">
											<div class="nice-checkbox">
												<input class="checkbox-o" type="checkbox" name="newsletter" id="newsletter" checked="checked">
												<label for="newsletter">Sign me up for the newsletter</label>
											</div>
										</div>

										<div class="form-group form-actions">
											<input name="submit" type="submit" class="btn btn-primary" value="Create account">
										</div><!--/form-group-->

									</div><!--/cols-->
								</div><!--/row-->

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
