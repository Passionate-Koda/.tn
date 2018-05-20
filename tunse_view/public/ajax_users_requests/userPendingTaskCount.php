<?php



if(isset($_SESSION['u_id'])){
  $sess = $_SESSION['u_id'];
}

$cnt = "0";
$state = $econn->prepare("SELECT task_count FROM task WHERE client_id = :sid && consent = 0 ");
$state->bindParam(":sid", $_POST['session']);
$state->execute();

while($row = $state->fetch(PDO::FETCH_BOTH)){
  extract($row);
    $cnt += $task_count;
}

echo $cnt;
  ?>
