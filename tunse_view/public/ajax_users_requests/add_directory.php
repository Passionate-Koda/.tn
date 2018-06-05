<?php

$check = $econn->prepare("SELECT * FROM directory WHERE directory_owner = :ch AND tworkers_hashid = :co");
$check->bindParam(":ch", $_POST['directory_owner']);
$check->bindParam(":co", $_POST['directory_tworker']);
$check->execute();
$count = $check->rowCount();
var_dump($count);

if($count>0){
$msg = "You have already added this Contact, Please Check Your <a href=\"contact\">Directory</a>";
var_dump($msg);
}else{
$stmt = $econn->prepare("INSERT INTO directory VALUES(NULL,:co, :cc,NOW(),NOW())");
$stmt->bindParam(":co", $_POST['directory_owner']);
$stmt->bindParam(":cc", $_POST['directory_tworker']);
$stmt->execute();
}
