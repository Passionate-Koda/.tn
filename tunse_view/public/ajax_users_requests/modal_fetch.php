<?php

if(isset($_POST['session'])){
  $sess = $_POST['session'];
}
if(isset($_POST['skill_id'])){
  $skill = $_POST['skill_id'];
}







$getInfo = getUser($econn, $_POST['session']);
extract($getInfo);
$Username = ucfirst($username);

    $stmt = $econn->prepare("SELECT * FROM tworker_skill WHERE skill_id = :gd");
    $stmt->bindParam(':gd', $_POST['skill_id']);
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
      $statement = $econn->prepare("SELECT * FROM tworkers WHERE tworkers_id = :twid");
      $statement->bindParam(':twid', $tworker_id);
      $statement->execute();

      while($info = $statement->fetch(PDO::FETCH_BOTH)){
        extract($info);
        $name= ucwords($tworkers_firstname).' '.ucwords($tworkers_surname);
        // echo '<li><a href="tworkersBoard?t='.$tworkers_hashid.'" data-target="#myModal1"><h3>'.$name.'</h3>
        //   <p>'.$tworkers_description.'</p>
        //   <p>'.$tworkers_lga.'</p>
        // </a></li><hr><br>';

        echo "<div class=\"modal ab fade\" id=\"myModal$tworkers_hashid\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">";
        echo "<div class=\"modal-dialog sign\" role=\"document\">";
        echo "<div class=\"modal-content about\">";
        echo "<div class=\"modal-header one\">";
        echo "<button type=\"button\" class=\"close sg\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
        echo "<div class=\"discount one\">";
          echo "<h3>Contact Tworker</h3>";

            echo  "</div></div>";
            echo "<div class=\"modal-body about\">";

            echo '<div class="" style="text-align: center">
            <h3>'.$name.'</h3>
            <p class="text-success">Location: <span>'.$tworkers_lga.'</span></p>
                  <hr>
                  <p><img style=" margin-left: auto;margin-right: auto;text-align: center;display: table-cell;vertical-align: middle;max-height: 250px;max-width: 250px;" src="'.$tworkers_image.'" style="height: 100px; width: 150px" class="img-responsive" alt="Fountain" class="img-rounded img-responsive"></p>
                  <hr>
                  <div class="well">
                  <h4>Description</h4>
                  <p>'.$tworkers_description.' </p>
                  </div>
                  <form  action="#" method="post">
                   <input type="hidden" id="'.$tworkers_hashid.'" value="$tworkers_hashid">
                   <label for=\"brand2\"><span></span>Send a task to '.$name.'</label>
                   	<textarea maxlength="200" maxlength="50" class="form-control" spellcheck="false" name="email_message" rows="auto" cols="50" ></textarea>';
                    echo '<p id="err'.$tworkers_hashid.'" style="color:red"></p><div class="content-body">
                      <div class="alert alert-success">

     <p class="text-success">Note: You can keep your Message Concise, You will be able to chat with this Tworker when your task is accepted</p>
   </div>';

                    echo " <div class=\"send-button\">
                                   <input class=\"form-control\"   type=\"button\" onclick=\"sendTask(this.form.elements[0].id,'$sess',this.form.elements[1].value,'$Username','$skill','$tworkers_hashid');this.form.reset()\" name=\"sentTask\" value=\"SEND TASK\">
                                 </div>
                               </form>";
                echo '</div>'; //div center end
                echo "</div>
                </div>
              </div>
            </div>
          </div>";






      }
    }
