<?php
//session_start();


// if(isset($_SESSION['t_id'])){
//   $sess = $_SESSION['t_id'];
// }




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
        // echo '<li class="avatar">
        // <a href="'.$type.'?id='.$type_id.'">
        // <div>'.$notification.'</div>
        // <small>1 minute ago</small>
        // </a>
        // </li>';

    
        echo ' <li class="contacts">
           <a id="anchor" href="tworkersMessenger?s='.$contact_owner.'&r='.$contact_hash_id.'">
           <div class="avater" style="background-image:url(\'asset/images/dummy/0c31c9dc.profile.jpg\');background-size:cover; background-repeat:no-repeat; background-position:center;">


             </div>
             <h3>'.$contact_name.'</h3>
             <p>'.$contact_category.'</p>

             </a>
         </li>';
      }
    }


?>
