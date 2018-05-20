<?php



if(isset($_SESSION['t_id'])){
  $sess = $_SESSION['t_id'];
}


$ran = rand(00000,9999);
$diffran = "m".$ran;
$not_hashid = $_POST['sender'].$diffran.$_POST['receiver'];
$noti_status = 0;
$noti_count = 1;
$sender_alias = $_POST['sender_alias'];
$noti = "You have a message from $sender_alias";



//$type = 'reply';
$stmt = $econn->prepare("INSERT INTO message_notification VALUES(NULL,:nst, :ncnt, :snd,:rec,:noti,:notihs,NOW(),NOW())");
$stmt->bindParam(":nst", $noti_status);
$stmt->bindParam("ncnt", $noti_count);
$stmt->bindParam(":snd", $_POST['sender']);
$stmt->bindParam(":rec", $_POST['receiver']);
$stmt->bindParam(":noti", $noti);
$stmt->bindParam(":notihs", $not_hashid);
//var_dump($_POST);
$stmt->execute();
