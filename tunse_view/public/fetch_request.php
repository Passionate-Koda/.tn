<?php
if(isset($_POST['session'])){
  $sess = $_POST['session'];
}
if(isset($_POST['skill_id'])){
  $skill = $_POST['skill_id'];
}
$getInfo = getUser($econn, $_POST['session']);
extract($getInfo);
$stmt = $econn->prepare("SELECT * FROM tworker_skill WHERE skill_id = :gd");
$stmt->bindParam(':gd', $skill);
$stmt->execute();
$tworkerid = [];
while($row = $stmt->fetch(PDO::FETCH_BOTH)){
  extract($row);
  $tworkerid[] = $tworker_id;
}
$tw = implode(',', $tworkerid);
// var_dump($tworkerid);
$range = 3000;
if(isset($_POST['range'])){
  if(isset($_POST['rating'])){
    $filter = "tworkers_rating DESC";
    $range = $_POST['range'];
  }
  if(isset($_POST['distance'])){
    $filter = "distance";
    $range = $_POST['range'];
  }
}else{
  $filter = "tworkers_rating DESC";
}
$statement = $econn->prepare("SELECT
  *, (
    3959 * acos (
      cos ( radians($latitude) )
      * cos( radians( tworkers_lat ) )
      * cos( radians( tworkers_long ) - radians($longitude) )
      + sin ( radians($latitude) )
      * sin( radians( tworkers_lat ) )
    )
  ) AS distance
  FROM tworkers
  HAVING distance < $range
  AND tworkers_id IN ($tw)
  ORDER BY $filter
  LIMIT 0 , 20 ");
  $statement->bindParam(':twid', $tworker_id);
  $statement->execute();
  while($info = $statement->fetch(PDO::FETCH_BOTH)){
    extract($info);
    $name= ucwords($tworkers_firstname).' '.ucwords($tworkers_surname);
    // echo '<li><a href="tworkersBoard?t='.$tworkers_hashid.'" data-target="#myModal1"><h3>'.$name.'</h3>
    //   <p>'.$tworkers_description.'</p>
    //   <p>'.$tworkers_lga.'</p>
    // </a></li><hr><br>';
    $show = $tworkers_rating / 5 * 100;
    $tdes = previewBody($tworkers_description,9);
    echo '<a href="#" data-toggle="modal" data-target="#myModal'.$tworkers_hashid.'"><div class="item  col-xs-4 col-lg-4 list-group-item">
    <div class="thumbnail" style="width:100px; margin:0;float:left">
    <div style="width:100px; border:2px solid green; height:100px; background-image:url('.$tworkers_image.'); background-size:cover; background-repeat:no-repeat; background-position:center;"></div>
    </div>
    <div class="table-text" style=" height:100px;width:30%;  float:left;">
    <span class="spancarname">Within '.ceil($distance).'km</span>
    </div>
    <div class="table-text" style=" height:100px;width:30%; float:left; position:absolute; right:0px">
    <h4 ><span class="spancarname">'.$name.'</span></h4>
    <p class="gridViewPrice hide">
    </p>
    <div class="other-details">
    <div class="clearfix"></div>
    <p class="listing-item-area"><span class="cityname"><i class="fa fa-map-marker"></i>'.' '.$tworkers_lga.'</span></p>
    <div class="stars-outer">
    <div class="stars-inner" style="width:'.$show.'%" ></div>
    </div><span class="cityname">'.' '.$tworkers_rating.'</span>
    </div>
    </div>
    </div></a>';
  }
