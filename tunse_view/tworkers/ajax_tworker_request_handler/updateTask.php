<?php
////session_start();


//echo $_POST['thid'];
$sstmt = $econn->prepare("UPDATE task SET consent = :cn WHERE task_hashid = :thid ");
$sstmt->bindParam(":cn", $_POST['consentCode']);
$sstmt->bindParam(":thid", $_POST['thid']);
$sstmt->execute();
////var_dump($_POST);
