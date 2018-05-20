<?php
//session_start();


// if(isset($_SESSION['t_id'])){
//   $sess = $_SESSION['t_id'];
// }




    $state = $econn->prepare("SELECT * FROM contacts WHERE contact_owner = :sid");
    $state->bindParam(":sid", $_POST['session']);
    $state->execute();

    if($state->rowCount() < 1){
      // echo '<div class="avatar">
      // <small>You have not accepted any Task</small>
      // </div>';

      echo'  <li class="contacts">
          <small>You have not accepted any Task</small>
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

        // echo '<a href="tworkersContact?o='.$contact_owner.'&t='.$contact_hash_id.'&i='.$contact_id.'"><div class="online-top">
        //   <div class="top-at">
        //     <img class="img-responsive" src="image/3.png" alt="">
        //   </div>
        //   <div class="top-on">
        //     <div class="top-on1">
        //       <p>'.$contact_name.'</p>
        //       <span>'.$contact_category.'</span>
        //     </div>
        //     <label class="round"> </label>
        //     <div class="clearfix"> </div>
        //   </div>
        //   <div class="clearfix"> </div>
        // </div></a>';

        echo '<li class="contacts">
          <a id="anchor" href="tworkersContact?o='.$contact_owner.'&t='.$contact_hash_id.'&i='.$contact_id.'">
         
          <div class="avater" style="background-image:url(\'asset/images/dummy/0c31c9dc.profile.jpg\');background-size:cover; background-repeat:no-repeat; background-position:center;">


             </div>
            </div>
            <h3>'.$contact_name.'</h3>
            <p>'.$contact_category.'</p>

            </a>
        </li>';
      }
    }


?>
