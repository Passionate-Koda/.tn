<?php



if(isset($_SESSION['t_id'])){
  $sess = $_SESSION['t_id'];
}






$count = 1;
$status = 0;

$stmt = $econn->prepare("INSERT INTO message VALUES(NULL,:snd,:sndAl, :recAl, :rec, NOW(),NOW(),:txt,:stts,:cnt)");
$stmt->bindParam(":snd", $_POST['sender']);
$stmt->bindParam(":sndAl", $_POST['sender_alias']);
$stmt->bindParam(":recAl", $_POST['receiver_alias']);
$stmt->bindParam(":rec", $_POST['receiver']);
$stmt->bindParam(":txt", $_POST['text']);
$stmt->bindParam(":stts", $status);
$stmt->bindParam(":cnt", $count);
$stmt->execute();

//var_dump($_POST);
