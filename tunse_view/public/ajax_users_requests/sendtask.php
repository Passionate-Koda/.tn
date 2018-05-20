<?php




$ran = rand(00000,9999);
$diffran = "taskto".$ran;
$task_hashid = $_POST['client_id'].$diffran.$_POST['tworkers_id'];
$count = 1;
$consent = 0;


$stmt = $econn->prepare("INSERT INTO task VALUES(NULL,:thid, :ci, :tsk, :tid,:tc,:cnst,:cnt,NOW(),NOW())");
$stmt->bindParam(':ci', $_POST['client_id']);
$stmt->bindParam(':tsk', $_POST['task']);
$stmt->bindParam(':tid', $_POST['tworkers_id']);
$stmt->bindParam(':tc', $_POST['taskCategory']);
$stmt->bindParam(':cnt', $count);
$stmt->bindParam(':cnst', $consent);
$stmt->bindParam(':thid', $task_hashid);

$stmt->execute();
//var_dump($count);
//var_dump($task_hashid);

sendNotifications($econn,$_POST['uname'], $_POST['tworkers_id'], $task_hashid);

function sendNotifications($dconn,$unamee,$Tworkerhash_id,$taskh){
  $uname = $unamee;

  $type = "task";
  $msg = "You have recieved a $type  from $uname";

  $stmte = $dconn->prepare("INSERT INTO notification VALUES(NULL, :ns, :ownid, :cnt, :noti,:type,:tyid, NOW(), NOW()) ");
  $data =[
    ":ns" => 0,
    ":ownid" => $Tworkerhash_id,
    ":cnt" => 1,
    ":noti"=> $msg,
    ":type"=> $type,
    ":tyid"=> $taskh,
  ];
  $stmte->execute($data);

  echo "Task Successfully Sent! Expect your reply. Visit <a href=\"dashbord\">Dashbord</a>";
}
