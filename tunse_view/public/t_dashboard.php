<?php
ob_start();
session_start();
authenticateUser();
if(isset($_SESSION['u_id'])){
  $sid = $_SESSION['u_id'];
  $getInfo = getUser($econn, $sid);
  extract($getInfo);
}
if(isset($_SESSION['u_id'])){
  $Username = ucfirst($username);
}
if(isset($_GET['t'])){
  $tworkers_hashid = $_GET['t'];
}
$getTworkersInfo = getTworker($econn, $tworkers_hashid);
extract($getTworkersInfo);

if(array_key_exists('submit', $_POST)){
  sendTask($econn, $sid, $_POST['task'], $tworkers_hashid, $Username);
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to tunse</title>
  </head>
  <style>

    #map {
      height: 90%;
      width: 70%;
    }
    html, body {
      height: 90%;
      margin: 0;
      padding: 0;
    }
  </style>
  <body>
    <h1>Welcome to Tunse</h1>
<?php

  echo "Welcome, $Username";


?>
<br>
<a href="/u_platform">Home</a>
<a href="/u_inbox">Messages</a>
<a id="notification" href="">Notification</a>
<a href="/u_platform">My Account</a>
<a id="logout" href="">Logout</a>
<hr>
<input type="hidden" id="session" name="" value="<?php echo $sid ?> ">
<h1><?php echo $tworkers_firstname ?></h1>
<?php getTworkerSkills($econn, $_GET['t']); ?>

<form class="" action="tworkersBoard?t=<?php echo $tworkers_hashid ?>" method="post">
  <p>Tell us About Your task</p>
  <textarea name="task" rows="8" cols="80" required></textarea>
  <input type="submit" name="submit" value="Send">
</form>

<div id="map"></div>
<script>
  function initMap() {
    var uluru = {lat:<?php echo $tworkers_lat ?>, lng:<?php echo $tworkers_long ?>};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 17,
      center: uluru
    });
    var marker = new google.maps.Marker({
      position: uluru,
      map: map
    });
  }
</script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCScwCRZOo5trTCzyk9vqNbhFAkT4-cgRU&callback=initMap"
  async defer></script>

<script type="text/javascript" src="f_ajax">
</script>
  </body>
</html>
