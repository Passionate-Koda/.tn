<?php



// function getContactSkill($dconn, $id){
//   $result = [];
// $statement = $dconn->prepare("SELECT * FROM tworker_skill WHERE tworker_id = :tid ");
// $statement->bindParam(':tid', $id);
// $statement->execute();
//
// while($info = $statement->fetch(PDO::FETCH_BOTH)){
//   extract($info);
//   //var_dump($skill_id);
function getTaskSkill($dconn, $post){

  $skill = $dconn->prepare("SELECT * FROM skill WHERE skill_id = :sid ");
  //var_dump($skill);
  $skill->bindParam(':sid', $post);
  $skill->execute();

  $resp = $skill->fetch(PDO::FETCH_BOTH);
    //var_dump($resp);
    extract($resp);
return $skill;
}


$cat = getTaskSkill($econn, $_POST['contactId']);
$check = $econn->prepare("SELECT * FROM contacts WHERE contact_category = :ccat AND contact_hash_id = :ch AND contact_owner = :co");
$check->bindParam(":ccat", $cat);
$check->bindParam(":ch", $_POST['contactHash']);
$check->bindParam(":co", $_POST['contactOwner']);
$check->execute();
$count = $check->rowCount();
var_dump($count);

if($count>0){
$msg = "You have already added this Contact, Please Check Your <a href=\"contact\">Directory</a>";
var_dump($msg);

}else{
$stmt = $econn->prepare("INSERT INTO contacts VALUES(NULL,:co, :cc, :ctype,:cname,:cphone,:chash,NOW(),NOW())");
$stmt->bindParam(":co", $_POST['contactOwner']);
$stmt->bindParam(":cc", $cat);
$stmt->bindParam(":cname", $_POST['contactName']);
$stmt->bindParam(":cphone", $_POST['contactPhone']);
$stmt->bindParam(":chash", $_POST['contactHash']);
$stmt->bindParam(":ctype", $_POST['contactType']);
$stmt->execute();
}
