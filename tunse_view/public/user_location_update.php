<?php
ob_start();
// session_start();


if($_POST['my_long'] == "null" || $_POST['my_lat'] == "null"){
}else{
$stmt = $econn->prepare("UPDATE client SET latitude=:lt, longitude=:lng WHERE hash_id=:sid ");
$stmt->bindParam(":lng", $_POST['my_long']);
$stmt->bindParam(":lt", $_POST['my_lat']);
$stmt->bindParam(":sid", $_POST['session']);
  $stmt->execute();
  echo "Location updated Succesfully";
} ?>
