<?php

session_start();
$_SESSION['t_id'] = $_GET['hid'];
$stmt = $econn->prepare("SELECT * FROM verify WHERE hash_id =:hid AND token=:tk");
$data = [
  ':hid'=> $_GET['hid'],
  ':tk'=> $_GET['token']
];
$stmt->execute($data);

if($stmt->rowCount() > 0){
// var_dump($data);
  $num = 1;
$verify = $econn->prepare("UPDATE tworkers SET tworkers_verification=$num WHERE tworkers_hashid = :thid");
$data2 = [
  ':thid'=>$_GET['hid']
];
$verify->execute($data2);


$stmt = $econn->prepare("DELETE FROM verify WHERE hash_id =:hid AND token=:tk");
$data = [
  ':hid'=> $_GET['hid'],
  ':tk'=> $_GET['token']
];
$stmt->execute($data);




$mes = "Verification Successful";
  $message = preg_replace('/\s+/', '_', $mes);
header("Location:/myDashboard?success=$message");

}else{

  $mes = "Verification Failed";
  $message = preg_replace('/\s+/', '_', $mes);

   header("Location: tunsehome?msg=$message");
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
 ?>
