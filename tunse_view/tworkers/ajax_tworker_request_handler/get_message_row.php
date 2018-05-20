<?php
////session_start();



  $getInfo = getTworker($econn, $_POST['session']);
  extract($getInfo);

$Username = ucfirst($tworkers_firstname);


    $state = $econn->prepare("SELECT * FROM message WHERE sender = :send AND reciever = :rec OR sender = :rec AND reciever = :send");
    $state->bindParam(":send", $_POST['sender']);
    $state->bindParam(":rec", $_POST['receiver']);
    $state->execute();

  echo $state->rowCount();


?>
