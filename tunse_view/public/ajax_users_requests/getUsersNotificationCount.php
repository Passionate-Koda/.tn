<?php


if(isset($_SESSION['u_id'])){
  $sess = $_SESSION['u_id'];
}





    $cnt = "0";

    $statment = $econn->prepare("SELECT notification_count FROM notification WHERE owner_id = :sid  ");
    $statment->bindParam(":sid", $_POST['session']);
    $statment->execute();
    while($row = $statment->fetch(PDO::FETCH_ASSOC)){
      extract($row);

    $cnt += $notification_count;
    }
    echo $cnt;
