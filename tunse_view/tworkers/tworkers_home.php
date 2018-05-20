<?php
ob_start();
session_start();
authenticateTworker('myDashboard');
if(isset($_SESSION['t_id'])){
  $sid = $_SESSION['t_id'];
}

$getInfo = getTworker($econn, $sid);
extract($getInfo);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Tworkers Home</title>
</head>
<style media="screen">
  .hide{
    display:none;
  }
</style>
<body onpageshow="getNofication(<?php echo $sid ?>);getNoficationCount(<?php echo $sid ?>)">
  <h1>TUNSE</h1>
  Welcome, <?php echo $tworkers_firstname  ?>
  <hr>
  <div class="nav">
    <?php if($tworkers_dob == NULL){?>
      To continue, Please Complete your registration <a href="c_registration">here</a>
    <?php }else{

       ?>
      <ul>
        <a href="#"><li>Tasks</li></a>
        <a onclick='vis("showNot", "show")'  href="#"><li>Notification &nbsp<span id="notCnt"></span></li></a>
        <a href="#"><li>Messages</li></a>
      </ul>
    <?php } ?>
    <a href="viewMap">View Location</a>
  </div>
  <div  id="showNot" class="hide"></div><a id="clse" href="#">X</a>

  <?php
  if(isset($_GET['updLoc'])){
    if($_GET['updLoc'] == "upt"){
      updateTworkersLocation($econn, $sid, $_POST['my_lat'], $_POST['my_long']);
    }
  }
  ?>
  <!-- script to get location and send to the database -->
  <script type="text/javascript" src="t_ajax">

  </script>
</body>
</html>
