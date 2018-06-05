<?php
//session_start();


// if(isset($_SESSION['t_id'])){
//   $sess = $_SESSION['t_id'];
// }




    $contact = $econn->prepare("SELECT * FROM contacts WHERE contact_owner = :sid");
    $contact->bindParam(":sid", $_POST['session']);
    $contact->execute();

    if($contact->rowCount() < 1){
      echo'  <li class="contacts">
          <small>You have not accepted any Task</small>
        </li>';
    }else{

      while($row = $contact->fetch(PDO::FETCH_BOTH)){
        extract($row);

        $pcount = count($contact_hash_id);



        echo '<li class="contacts">
          <a id="anchor" href="tworkersContact?o='.$contact_owner.'&t='.$contact_hash_id.'&i='.$contact_id.'">';


          for($i=0;$i<$pcount;$i++){

            $info = getUser($econn, $contact_hash_id);
            extract($info);
            if($image == NULL){
              $image = "asset/images/dummy/0c31c9dc.profile.jpg";
            }


          echo'<div class="avater" style="background-image:url('.$image.');background-size:cover; background-repeat:no-repeat; background-position:center;">
             </div>';
             }
            echo '</div>
            <h3>'.$contact_name.'</h3>
            <p>'.$contact_category.'</p>
            </a>
        </li>';
      }
    }


?>
