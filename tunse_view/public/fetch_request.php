<?php


if(isset($_GET['get'])){
  $getData = intval($_GET['get']);
  if($_GET['get'] == "$getData"){
    $stmt = $econn->prepare("SELECT * FROM tworker_skill WHERE skill_id = :gd");
    $stmt->bindParam(':gd', $getData);
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

        $tdes = previewBody($tworkers_description,9);

        echo '<div class="item  col-xs-4 col-lg-4">
          <div class="thumbnail">
            <a href="#" data-toggle="modal" data-target="#myModal'.$tworkers_hashid.'"><div style="width:auto; border:2px solid green; height:50vh; background-image:url('.$tworkers_image.'); background-size:cover; background-repeat:no-repeat; background-position:center;"></div></a>
            <div class="table-text">
              <h4 ><a href="#" data-toggle="modal" data-target="#myModal'.$tworkers_hashid.'"  class="click-search"><span class="spancarname">'.$name.'</span></a></h4>
              <p class="gridViewPrice hide">
              </p>
              <div class="other-details">

                <div class="clearfix"></div>
                <a href="#" data-toggle="modal" data-target="#myModal'.$tworkers_hashid.'">
                  <p class="listing-item-area"><span class="cityname"><i class="fa fa-map-marker"></i>'.' '.$tworkers_lga.'</span></p>

                </a>
              </div>
              <div class="clearfix"></div>
              <div class="list-form">
                <div class="phone-info">
                </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>';






      }
    }
  }
}
