<?php

ob_start();



session_start();

authenticateTworker('myDashboard');
if(isset($_SESSION['t_id'])){
  $sid = $_SESSION['t_id'];
}
$getInfo = getTworker($econn, $sid);
extract($getInfo);

$error = [];
if(array_key_exists('submit', $_POST)){


  define("MAX_FILE_SIZE", "2097152");

  $ext = ["image/jpg", "image/JPG", "image/jpeg", "image/JPEG", "image/PNG", "image/png"];


if(empty($_POST['dob'])){
$error['dob']= "You did not Enter you Date of Birth";
}
if(empty($_POST['state'])){
$error['state']= "You did not Enter your State";
}
if(empty($_POST['lga'])){
$error['lga']= "You did not Enter your Local Government";
}
if(empty($_POST['address'])){
$error['address']= "You did not Enter you Address";
}
if(empty($_POST['description'])){
  $error['description']= "You did not Enter Description of your Skill";
}
if(!in_array($_FILES['pic']['type'], $ext)){
  $error['pic'] = "You chose Invalid file type";
}
if(empty($_FILES['pic']['name'])){
  $error['pic'] = "You didnt choose a file";
}

if($_FILES['pic']['size'] > MAX_FILE_SIZE){
  $error['pic'] = "File size exceeds maximum. maximum:".MAX_FILE_SIZE;
}

if(empty($error)){
  $clean = array_map('trim', $_POST);
$ver = compressImage($_FILES, 'pic',50, 'uploads/');
completeRegistration($econn, $clean, $sid,$ver);
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


$page = "creg";
include 'includes/header.php';
?>


<div class="content">

  <!-- content-control -->
  <div class="content-control">
    <!--breadcrumb-->
    <ul class="breadcrumb">
      <li><a href="myDashboard"><i class="fa fa-home"></i> Dashboard</a></li>
      <li class="active">Complete Registration</li>
    </ul>
  </div>
  <!--/breadcrumb--
  <!-- /content-control -->

  <div class="content-body">
    <form data-form="wizard" method="post" data-validate="form" role="form" enctype="multipart/form-data" class="form-horizontal">
                        <div data-wizard="">
                            <h3>Account</h3>
                            <section>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="username">Date of Birth *</label>
                                    <div class="col-sm-7">
                                        <div class="input-group input-group-in">
                                            <span class="input-group-addon text-silver"></span>
                                            <input class="form-control"  name="dob" type="date"  required="">
                                        </div>
                                    </div>
                                </div><!-- /form-group -->

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="passwd">State *</label>
                                    <div class="col-sm-7">
                                        <div class="input-group input-group-in">
                                            <span class="input-group-addon text-silver"></span>
                                            <select class="form-control" onchange="getlga(this.value)" class="" id='stateid' name="state" required="">
                                              <option value="">--Select State--</option>
                                              <?php getState($iconn); ?>
                                            </select><hr>
                                        </div>
                                    </div>
                                </div><!-- /form-group -->

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="confirm_passwd">Local Government Area *</label>
                                    <div class="col-sm-7">
                                        <div class="input-group input-group-in">
                                            <span class="input-group-addon text-silver"></span>
                                            <select class="form-control" id="lga" name="lga" required="">
                                            </select><hr>
                                        </div>
                                    </div>
                                </div><!-- /form-group -->
                                <div class="clearfix"></div>
                            </section><!-- /step 1 -->

                            <h3>Profile</h3>
                            <section>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="firstname">Skill *</label>
                                    <div class="col-sm-7">
                                        <div class="input-group input-group-in">
                                            <span class="input-group-addon text-silver"></span>
                                            <select class="form-control" name="skill" required="">
                                              <option value="">--Select Skill</option>
                                              <?php getSkill($econn); ?>
                                            </select><hr>
                                        </div>
                                    </div>
                                </div><!-- /form-group -->

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="lastname">Address *</label>
                                    <div class="col-sm-7">
                                        <div class="input-group input-group-in">
                                            <span class="input-group-addon text-silver"></span>
                                          <textarea class="form-control" name="address" rows="8" cols="auto" placeholder="Address" required=""></textarea><hr>
                                        </div>
                                    </div>
                                </div><!-- /form-group -->

                                <!-- <div class="form-group">
                                    <label class="col-sm-3 control-label" for="email">Email *</label>
                                    <div class="col-sm-7">
                                        <div class="input-group input-group-in">
                                            <span class="input-group-addon text-silver"><i class="fa fa-envelope-o"></i></span>
                                            <input class="form-control" id="email" name="email" type="email" required="">
                                        </div>
                                    </div>
                                </div><!-- /form-group --> 

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="address">Description</label>
                                    <div class="col-sm-7">
                                        <div class="input-group input-group-in">
                                            <span class="input-group-addon text-silver"></span>
                                          <textarea maxlength="200" minlength="100" class="form-control" name="description" rows="8" cols="auto" placeholder="Helps the users Know more about your Skills" required=""></textarea><hr>
                                        </div>
                                    </div>
                                </div><!-- /form-group -->
                            </section><!-- /step 2 -->

                            <h3>Hints</h3>
                            <section>
                              <div class="form-group">
                                    <label class="col-sm-3 control-label" for="fileinput_thumb">Image upload widgets</label>
                                    <div class="col-sm-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px">
                                                <img data-src="holder.js/100%x100%" alt="">
                                            </div>
                                            <div>
                                                <span class="btn btn-sm btn-icon btn-inverse btn-file">
                                                    <i class="fa fa-cloud-upload"></i>
                                                    <span class="fileinput-new">Select image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="pic" id="fileinput_thumb" accept="image/*">
                                                </span>
                                                <button class="btn btn-sm btn-icon btn-danger fileinput-exists" data-dismiss="fileinput">
                                                    <i class="fa fa-times"></i>
                                                    Remove
                                                </button>
                                            </div>
                                        </div><!-- /fileinput -->
                                    </div><!-- /cols -->
                                </div><!-- /form-group -->
                            </section><!-- /step 3 -->

                            <h3>Finish</h3>
                            <section>
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-7">
                                        <div class="nice-checkbox">
                                            <input class="checkbox-o" id="term" name="term" type="checkbox" required="">
                                            <label for="term">
                                                I agree with the Terms and Conditions.
                                            </label>
                                            <input  class="btn btn-lg btn-success1 btn-block" type="submit" name="submit" value="Submit">
                                        </div>
                                    </div>
                                </div><!-- /form-group -->
                            </section><!-- /step 4 -->
                        </div><!-- /wizard -->
                    </form><!-- /form wizard -->





</div><!--/content-body -->
</div><!--/content -->
</section>

<!--/content section -->


<!-- side-right -->
<?php include 'includes/normal.php' ?>


<!-- section footer -->
<a rel="to-top" href="#top"><i class="fa fa-arrow-up"></i></a>
<?php include 'includes/footer.php' ?>
<input type="hidden" id="session" name="" value="<?php echo $sid  ?>">
<!-- <input type="hidden" id="taskNot" name="" value="">
<input type="hidden" id="dtaskNot" name="" value="">
<input type="hidden" id="ataskNot" name="" value=""> -->

<!-- javascript
================================================== -->
<script src="asset/scripts/39914ff3.vendor-main.js"></script>
<script src="asset/scripts/756399db.vendor-usefull.js"></script>
<script src="asset/scripts/e7058f60.vendor-form.js"></script>
<script src="asset/scripts/fc9d433c.vendor-editor.js"></script>
<!--[if lte IE 8]>
<script src="asset/scripts/eae815b5.excanvas.js"></script>
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
  <script type="text/javascript" src="jss/td_ajax.js">

  </script>
  <!-- <script type="text/javascript" src="jss/t_ajax.js">

  </script> -->
  <script type="text/javascript" src="jss/ajax.js">
  </script>

</body>

<!-- Mirrored from stilearning.com/items/preview/stilearn-admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 24 Dec 2017 16:54:14 GMT -->
</html>
