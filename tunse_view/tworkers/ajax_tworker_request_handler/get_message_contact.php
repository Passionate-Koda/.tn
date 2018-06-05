<?php
$messageContact = $econn->prepare("SELECT * FROM contacts WHERE contact_owner = :sid");
$messageContact->bindParam(":sid", $_POST['session']);
$messageContact->execute();
if($messageContact->rowCount() < 1){
  echo '<li class="avatar">
  <small>You have not added Contact</small>
  </li>';
}else{
  while($row = $messageContact->fetch(PDO::FETCH_BOTH)){
    extract($row);
    $pcount = count($contact_hash_id);
    echo ' <li class="contacts">
    <a id="anchor" href="tworkersMessenger?s='.$contact_owner.'&r='.$contact_hash_id.'">';
    for($i=0;$i<$pcount;$i++){
      $info = getUser($econn, $contact_hash_id);
      extract($info);
      if($image == NULL){
        $image = "asset/images/dummy/0c31c9dc.profile.jpg";
      }
      echo '<div class="avater" style="background-image:url('.$image.');background-size:cover; background-repeat:no-repeat; background-position:center;">';
    }
    echo '</div>
    <h3>'.$contact_name.'</h3>
    <p>'.$contact_category.'</p>
    </a>
    </li>';
  }
}
?>
