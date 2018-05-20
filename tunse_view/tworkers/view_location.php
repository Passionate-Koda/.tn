<?php
ob_start();
session_start();
authenticateTworker();
if(isset($_SESSION['t_id'])){
  $sid = $_SESSION['t_id'];
}
$getInfo = getTworker($econn, $sid);
extract($getInfo);
if(array_key_exists('submit', $_POST)){
//var_dump($_POST['my_var']);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Tworkers Home</title>
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

</head>
<body>

  <h1>TUNSE</h1>

  Welcome, <?php echo $tworkers_firstname  ?>
  <br><a href="t_home">Home</a>
  <hr>
  <?php
  $getInfo = getTworker($econn, $sid);
  extract($getInfo);



   ?>


  <div id="map"></div>
  <script>
    function initMap() {
      var uluru = {lat: <?php echo $tworkers_lat ?>, lng: <?php echo $tworkers_long ?>};
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCScwCRZOo5trTCzyk9vqNbhFAkT4-cgRU&callback=initMap"
    async defer></script>

</body>
</html>
