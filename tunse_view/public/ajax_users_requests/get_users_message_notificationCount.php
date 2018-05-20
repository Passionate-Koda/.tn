<?php





    $cnt = "0";

    $statment = $econn->prepare("SELECT notification_count FROM message_notification WHERE receiver = :sid  ");
    $statment->bindParam(":sid", $_POST['session']);
    $statment->execute();
    while($row = $statment->fetch(PDO::FETCH_ASSOC)){
      extract($row);

    $cnt += $notification_count;
    }
    echo $cnt;
