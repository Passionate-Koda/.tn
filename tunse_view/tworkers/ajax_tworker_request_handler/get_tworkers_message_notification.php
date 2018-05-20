<?php

    $stmt = $econn->prepare("SELECT * FROM message_notification WHERE receiver = :sid ");
    $stmt->bindParam(":sid", $_POST['session']);
    $stmt->execute();

    if($stmt->rowCount() < 1){
      echo '<li class="avatar">
      <small>No Notification Available</small>
      </li>';
    }else{
      // echo '<ul>';
      while($row = $stmt->fetch(PDO::FETCH_BOTH)){

        extract($row);
        echo '<li class="avatar">
        <a href="tworkersMessenger?s='.$receiver.'&r='.$sender.'">
        <div>'.$notification.'</div>
        <small>1 minute ago</small>
        </a>
        </li>';
      }
      // echo '<li><a href="'.$type.'?id='.$type_id.'">'.$notification.'</a></li>';
    }
    // echo '<ul>';

?>
