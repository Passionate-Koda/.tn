<?php


if(isset($_GET['get'])){
  $getLocal = intval($_GET['get']);
  if($_GET['get'] == "$getLocal"){
    // $getit =  getLga($iconn, $getLocal)
    // echo $getit;


$stmt = $iconn->prepare("SELECT * FROM locals WHERE state_id=:lc");
$stmt->bindParam(':lc', $getLocal);
$stmt->execute();
echo '<option value="">--select LGA</option>';
while($row = $stmt->fetch(PDO::FETCH_BOTH)){
  extract($row);
  echo '<option value="'.$local_name.'">'.$local_name.'</option>';
}

}
}
 ?>
