<?php
//session_start();




$cnt = "0";
$state = $econn->prepare("SELECT task_count FROM task WHERE tworkers_id = :sid && consent = 2 ");
$state->bindParam(":sid", $_POST['session']);
$state->execute();

while($row = $state->fetch(PDO::FETCH_BOTH)){
  extract($row);
    $cnt += $task_count;
}

echo $cnt;


  ?>
