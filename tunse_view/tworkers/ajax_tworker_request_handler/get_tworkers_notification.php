<?php
//session_start();





    $stmt = $econn->prepare("SELECT * FROM notification WHERE owner_id = :sid ");
    $stmt->bindParam(":sid", $_POST['session']);
    $stmt->execute();

    if($stmt->rowCount() < 1){
      // echo '<li class="avatar">
      // <small>No Notification Available</small>
      // </li>';
      echo '<a class="notif-item" href="#">
      <div class="notif-ico">

      </div>
          <p class="notif-text">No Notification Available</p>
      </a';
    }else{
      // echo '<ul>';
      while($row = $stmt->fetch(PDO::FETCH_BOTH)){

        extract($row);
        // echo '<li class="avatar">
        // <a href="'.$type.'?id='.$type_id.'">
        // <div>'.$notification.'</div>
        // <small>1 minute ago</small>
        // </a>
        // </li>';

        echo '<a class="notif-item" href="'.$type.'?id='.$type_id.'">
            <div class="notif-ico bg-success">
                <i class="fa fa-user"></i>
            </div>
            <p class="notif-text">'.$notification.'</p>
        </a';
      }
      // echo '<li><a href="'.$type.'?id='.$type_id.'">'.$notification.'</a></li>';
    }
    // echo '<ul>';

?>
