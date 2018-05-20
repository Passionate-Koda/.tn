<?php
//session_start();


if(isset($_SESSION['t_id'])){
  $sess = $_SESSION['t_id'];
}

$stmt = $econn->prepare("DELETE FROM message_notification WHERE sender = :snd AND receiver = :rec ");
$stmt->bindParam(":snd", $_POST['receiver']);
$stmt->bindParam(":rec", $_POST['sender']);

$stmt->execute();
