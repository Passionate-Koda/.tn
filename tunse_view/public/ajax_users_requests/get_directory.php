<?php
$state = $econn->prepare("SELECT * FROM directory WHERE directory_owner = :sid");
$state->bindParam(":sid", $_POST['session']);
$state->execute();
if($state->rowCount() < 1){
  echo '<li class="avatar">
  <small>You have not added a Tworker to your directory</small>
  </li>';
}else{
  while($row = $state->fetch(PDO::FETCH_BOTH)){
    extract($row);
    $getInfo = getTworker($econn, $tworkers_hash_id);
    extract($getInfo);
    echo '<li class="contacts">
    <a id="anchor" href="directory?o='.$directory_owner.'&t='.$tworkers_hash_id.'&i='.$id.'">
    <div class="avater" style="background-image:url('.$tworkers_image.');background-size:cover; background-repeat:no-repeat; background-position:center;">
    </div>
    <h3>'.$tworkers_firstname.' '.$tworkers_surname.'</h3>
    <p></p>
    </a>
    </li>';
  }
}
?>
