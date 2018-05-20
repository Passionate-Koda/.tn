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
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Modern an Admin Panel Category Flat Bootstarp Resposive Website Template | Register :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="csss/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="csss/style.css" rel='stylesheet' type='text/css' />
<link href="csss/font-awesome.css" rel="stylesheet">
<!-- jQuery -->
<script src="jss/jquery.min.js"></script>
<!----webfonts--->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<!---//webfonts--->
<!-- Bootstrap Core JavaScript -->
<script src="jss/bootstrap.min.js"></script>
</head>
<body id="login">
  <div class="login-logo">
    <a href="tunsehome"><img src="images/logo.png" alt=""/></a>
  </div>
  <h2 class="form-heading"><a href="tunsehome">Back To Tunse Home</a></h2>
  <h2 class="form-heading"><a href="myDashboard">Back To Dashboard</a></h2>
  <h2 class="form-heading">Tworkers Complete Registeration</h2>


  Welcome, <?php echo ucwords($tworkers_firstname)  ?>
  <hr>
  <script type="text/javascript">
//   function PreviewImage(){
// var img = document.getElementById("uploadImage");
// var holder = document.getElementById("holder");
// var image = document.createElement('img');
// image.setAttribute("src", window.URL.createObjectURL(img.files));
// holder.appendChild(image);
// }
//   </script>

    <form class="form-signin app-cam"  action="c_registration" method="POST" enctype="multipart/form-data">
      <p>Please Complete Your Registration</p>
      <p>Upload Your Picture</p>
      <input class="btn-success1" type="file" id="uploadImage" name="pic" onchange="document.getElementById('holder').src = window.URL.createObjectURL(this.files[0])" >
      <div class="">
        <img id="holder" height="100" width="120">
      </div>
      <label for="">Date Of Birth</label>
      <input type="date" class="form-control" name="dob" value="" placeholder="Date Of Birth"><hr>
      <!-- <input type="text"  name="state" value="" placeholder="State"><hr> -->
      <label for="">State</label>
      <select class="form-control" onchange="getlga(this.value)" class="" id='stateid' name="state">
        <option value="">--Select State</option>
        <?php getState($iconn); ?>
      </select><hr>
      <label for="">Local Government</label>
      <select class="form-control" id="lga" name="lga">
      </select><hr>
      <label for="">Skill</label>
      <select class="form-control" name="skill">
        <option value="">--Select Skill</option>
        <?php getSkill($econn); ?>
      </select><hr>

      <label for="">Address</label>
      <textarea class="form-control" name="address" rows="8" cols="auto" placeholder="Address"></textarea><hr>
      <label for="">Work Description</label>
      <textarea class="form-control" name="description" rows="8" cols="auto" placeholder="Helps the users Know more about your Skills"></textarea><hr>
      <input  class="btn btn-lg btn-success1 btn-block" type="submit" name="submit" value="Submit">
    </form>


State
<div class="copy_layout login register">
   <p>Copyright &copy; 2015 Modern. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
</div>
</body>
</html>
