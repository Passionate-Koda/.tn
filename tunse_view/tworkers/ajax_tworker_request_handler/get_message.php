<?php
////session_start();



  $getInfo = getTworker($econn, $_POST['session']);
  extract($getInfo);

  $getUInfo = getUser($econn, $_POST['receiver']);
  extract($getUInfo);

$Username = ucfirst($tworkers_firstname);


    $state = $econn->prepare("SELECT * FROM message WHERE sender = :send AND reciever = :rec OR sender = :rec AND reciever = :send");
    $state->bindParam(":send", $_POST['sender']);
    $state->bindParam(":rec", $_POST['receiver']);
    $state->execute();

    if($state->rowCount() < 1){
      echo '<li class="avatar">
      <small>No Message Sent</small>
      </li>';
    }else{
      while($row = $state->fetch(PDO::FETCH_BOTH)){
        extract($row);
        $sender = substr($sender_alias, 0, 1);
        $color = "";
        $timed = decodeTime($time);
if($Username == $sender_alias){
echo '<li class="chat-box float-right">
    <div class="msg float-right radius-right">
      <div class="text">
        <p class="float-right margin-right">'.$messageText.'</p>
      </div>
      <div class="float-left margin-left">
        <h5 class="time-text">'.$timed.'</h5>
      </div>
    </div>
  </li>
  <div style="display:block; clear:both"></div>';
}else{
  echo  '  <li class="chat-box float-left">
      <div class="chat-avater float-left" style="background-image: url('.$image.')">
      </div>
      <div class="msg float-left radius-left">
        <div class="text">
            <p class="float-left margin-left">'.$messageText.'</p>
        </div>

        <div class="float-right margin-right">
            <h5 class="time-text">'.$timed.'</h5>
        </div>

      </div>
    </li>
    <div style="display:block; clear:both"></div>';
}


      // echo  '<li class="collection-item avatar email-unread">
      //     <i class="icon_4'.$color.'">'.$sender.'</i>
      //     <div class="avatar_left">
      //       <span class="email-title">'.$sender_alias.'</span>
      //       <p class="truncate grey-text ultra-small">'.$messageText.'</p>
      //     </div>
      //     <a href="#!" class="secondary-content"><span class="blue-text ultra-small">'.$time.'</span></a>
      //     <a href="#!" class="secondary-content"><span class="blue-text ultra-small">'.$date.'</span></a>
      //     <div class="clearfix"> </div>
      //   </li><hr>';

      }
    }


?>
