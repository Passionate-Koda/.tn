<?php
$state = $econn->prepare("SELECT * FROM contacts WHERE contact_owner = :sid");
$state->bindParam(":sid", $_POST['session']);
$state->execute();
if($state->rowCount() < 1){
  echo '<li class="avatar">
  <small>You have not added Contact</small>
  </li>';
}else{
  while($row = $state->fetch(PDO::FETCH_BOTH)){
    extract($row);
    $getInfo = getTworker($econn, $contact_hash_id);
    extract($getInfo);
    echo '<li class="contacts">
    <a id="anchor" href="contact?o='.$contact_owner.'&t='.$contact_hash_id.'&i='.$contact_id.'">
    <div class="avater" style="background-image:url('.$tworkers_image.');background-size:cover; background-repeat:no-repeat; background-position:center;">
    </div>
    <h3>'.$contact_name.'</h3>
    <p>'.$contact_category.'</p>
    </a>
    </li>';
  }
}
?>
