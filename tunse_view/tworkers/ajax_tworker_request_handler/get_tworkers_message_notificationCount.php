<?php

// if(isset($_SESSION['t_id'])){
//   $sess = $_SESSION['t_id'];
// }


    $cnt = "0";

    $stmt = $econn->prepare("SELECT notification_count FROM message_notification WHERE receiver = :sid ");
    $stmt->bindParam(":sid", $_POST['session']);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      extract($row);


    $cnt += $notification_count;
    }
    echo $cnt;
