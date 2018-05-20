<?php
//session_start();



$noti_status = 0;
$noti_count = 1;
//$type = 'reply';
$stmt = $econn->prepare("INSERT INTO notification VALUES(NULL,:ns, :oid, :ncnt,:noti,:tp,:tid,NOW(),NOW())");
$stmt->bindParam(":ns", $noti_status);
$stmt->bindParam(":oid", $_POST['client']);
$stmt->bindParam(":ncnt", $noti_count);
$stmt->bindParam(":noti", $_POST['msg']);
$stmt->bindParam(":tp", $_POST['type']);
$stmt->bindParam(":tid", $_POST['type_id']);
//var_dump($_POST);
$stmt->execute();
