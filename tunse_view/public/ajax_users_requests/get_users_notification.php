<?php



if(isset($_SESSION['u_id'])){
  $sess = $_SESSION['u_id'];
}





    $state = $econn->prepare("SELECT * FROM notification WHERE owner_id = :sid ");
    $state->bindParam(":sid", $_POST['session']);
    $state->execute();

    if($state->rowCount() < 1){
      echo '<li class="avatar">
      <small>No Notification Available</small>
      </li>';
    }else{

      while($row = $state->fetch(PDO::FETCH_BOTH)){
        extract($row);
        echo '<li class="avatar">
        <a href="'.$type.'?id='.$type_id.'">
        <div>'.$notification.'</div>
        <small>1 minute ago</small>
        </a>
        </li>';
      }
    }


?>
