<?php
define("DB_PATH", dirname(dirname(__FILE__)));
include DB_PATH."/tunse_models/entity_db.php";
include DB_PATH."/tunse_models/interface_db.php";
// include DB_PATH."/tunse_models/archive_db.php";

// function that checks if email exists
function doesEmailExist($dbconn, $input){
  $result = false;
  $stmt = $dbconn->prepare("SELECT * FROM tworkers WHERE tworkers_email = :em");
  $stmt->bindParam(":em", $input);
  $stmt->execute();
  $count = $stmt->rowCount();
  if($count>0){
    $result = true;
  }
  return $result;
}
function getContactID($dbconn, $co,$chid){

  $state = $dbconn->prepare("SELECT * FROM contacts WHERE contact_owner = :sid AND contact_hash_id = :chid");
  $state->bindParam(":sid", $co);
  $state->bindParam(":chid", $chid);
  $state->execute();
  while($row = $state->fetch(PDO::FETCH_BOTH)){
  extract($row);
  $result = $contact_id;
  }
  return $result;
}

function enterReview($dbconn,$post,$uid,$tid){
  try{
  $stmt = $dbconn->prepare("INSERT INTO review VALUES(NULL,:tid,:rt,:rv,:uid)");
  $data = [
    ":tid" =>$tid,
    ":rt" => $post['star'],
    ":rv" => $post['review'],
    ":uid"=> $uid
  ];
  $stmt->execute($data);
}catch(PDOException $e){
  die("We cannot post this Review at this time, Please Try again");
}

$totalrate = 0;
$rate = 0;
$stmt2 = $dbconn->prepare("SELECT * FROM review WHERE tworkers_hash_id=:thid");
$data2= [
  ":thid"=> $tid
];
$stmt2->execute($data2);
while($row = $stmt2->fetch(PDO::FETCH_BOTH)){
extract($row);
$rate +=  $rating;
$totalrate = $rate / $stmt2->rowCount();

}

$stmt3 = $dbconn->prepare("UPDATE tworkers SET tworkers_rating=:trt WHERE tworkers_hashid=:hid ");
$stmt3->bindParam(":trt",$totalrate);
$stmt3->bindParam(":hid",$tid);
$stmt3->execute();
}

function decodeDate($date){
  $split = explode('-',$date);
  $month = $split[1];
  $day = $split[2];
  $year = $split[0];

  if($month == 1 ){
    $month = "January";
  }
  if($month == 2 ){
    $month = "February";
  }
  if($month == 3 ){
    $month = "March";
  }
  if($month == 4){
    $month = "April";
  }
  if($month == 5){
    $month = "May";
  }
  if($month == 6 ){
    $month = "June";
  }
  if($month == 7 ){
    $month = "July";
  }
  if($month == 8 ){
    $month = "August";
  }
  if($month == 9 ){
    $month = "September";
  }
  if($month == 10 ){
    $month = "October";
  }
  if($month == 11 ){
    $month = "November";
  }
  if($month == 12 ){
    $month = "December";
  }
  $newDate = $month.' '.$day.', '.$year;
  return $newDate;
}


function decodeTime($time){
  $tm = explode(":",$time);

  if($tm['0'] < 12){
    $time = $tm['0'].':'.$tm['1'].'am';
  }

  if($tm['0'] == 12){
    $time = $tm['0'].':'.$tm['1'].'pm';
  }

  if($tm['0'] == 13){
    $time = '1'.':'.$tm['1'].'pm';
  }
  if($tm['0'] == 14 ){
    $time = '2'.':'.$tm['1'].'pm';
  }
  if($tm['0'] == 15 ){
    $time = '3'.':'.$tm['1'].'pm';
  }
  if($tm['0'] == 16 ){
    $time = '4'.':'.$tm['1'].'pm';
  }
  if($tm['0'] == 17 ){
    $time = '5'.':'.$tm['1'].'pm';
  }
  if($tm['0'] == 18 ){
    $time = '6'.':'.$tm['1'].'pm';
  }
  if($tm['0'] == 19 ){
    $time = '7'.':'.$tm['1'].'pm';
  }
  if($tm['0'] == 20 ){
    $time = '8'.':'.$tm['1'].'pm';
  }
  if($tm['0'] == 21 ){
    $time = '9'.':'.$tm['1'].'pm';
  }
  if($tm['0'] == 22 ){
    $time = '10'.':'.$tm['1'].'pm';
  }
  if($tm['0'] == 23 ){
    $time = '11'.':'.$tm['1'].'pm';
  }
  if($tm['0'] == 00 ){
    $time = '12'.':'.$tm['1'].'am';
  }
  return $time;
}


function compressImage($files, $name, $quality,$upDIR ) {
  $rnd = rand(0000000, 9999999);
  $strip_name = str_replace(" ", "_", $_FILES[$name]['name']);

  $filename= $rnd.$strip_name;
  $destination_url = $upDIR.$filename;

  $info = getimagesize($files[$name]['tmp_name']);

    		if ($info['mime'] == 'image/jpeg')
        			$image = imagecreatefromjpeg($files[$name]['tmp_name']);

    		elseif ($info['mime'] == 'image/gif')
        			$image = imagecreatefromgif($files[$name]['tmp_name']);

   		elseif ($info['mime'] == 'image/png')
        			$image = imagecreatefrompng($files[$name]['tmp_name']);

    		imagejpeg($image, $destination_url, $quality);

  return $destination_url;
}

function authenticateUser($url){
  if(!isset($_SESSION['u_id'])){
    $mes = "You are not Signed In, Please Sign in your to account";
    $message = preg_replace('/\s+/', '_', $mes);
    header("Location: tunsehome?msg=$message&ret=$url");
  }
}

function authenticateTworker($url){
  if(!isset($_SESSION['t_id'])){
    $mes = "You are not Signed In, Please login or register to access the Dashboard";
    $message = preg_replace('/\s+/', '_', $mes);
    header("Location: tworkers_login?msg=$message&ret=$url ");
  }
}

function doesPhoneNumberExist($dbconn, $input){
  $result = false;
  $stmt = $dbconn->prepare("SELECT * FROM tworkers WHERE tworkers_phonenumber = :tp");
  $stmt->bindParam(":tp", $input);
  $stmt->execute();
  $count = $stmt->rowCount();
  if($count>0){
    $result = true;
  }
  return $result;
}

function previewBody($string, $count){
  $original_string = $string;
  $words = explode(' ', $original_string);
  if(count($words) > $count){
    $words = array_slice($words, 0, $count);
    $string = implode(' ', $words);
  }
  return $string;
}



//function that display errors
function displayErrors($error, $field){
  $result = "";
  if(isset($error[$field])){
    $result = '<div class="alert alert-danger" role="alert">
    <strong>Alert! </strong>'.$error[$field].
    '</div>';
  }
  return $result;
}

// functions that does registration
function registerTworker($dbconn,$input){
  $result = [];
  $hash  = password_hash($input['hash'], PASSWORD_BCRYPT);
  $idrand = rand(000000000000,99999999999);
  $idprocess = $idrand.$input['firstname'];
    $hash_id = str_shuffle($idprocess);

  $stmt = $dbconn->prepare("INSERT INTO tworkers(tworkers_surname, tworkers_firstname, tworkers_middlename,tworkers_phonenumber,tworkers_email,tworkers_hash,tworkers_term, tworkers_reg_date,tworkers_hashid) VALUES(:ts, :tf,:tm, :tp,:te, :hs,:trm,now(),:hid) ");

  $data = [
    ':ts' => $input['surname'],
    ':tf' => $input['firstname'],
    ':tm' => $input['middlename'],
    ':tp' => $input['phonenumber'],
    ':te' => $input['email'],
    ':hs' => $hash,
    ':trm'=>$input['term'],
    ':hid'=>$hash_id
  ];
// ////var_dump($hash);
  $stmt->execute($data);


  $ran = rand(0000000000,999999999);
  $process = $ran.$input['email'];
  $token = str_shuffle($process);


$updatever = $dbconn->prepare("INSERT INTO verify VALUES(NULL,:hid,:tk,NOW(),NOW())");
$data2 = [
  'hid' => $hash_id,
  'tk' => $token
];
$updatever->execute($data2);
  $result[] = $hash_id;
  $result[] = $token;


return $result;

}





function loginTworker($dbconn, $input){

  $result =[];
  $stmt = $dbconn->prepare("SELECT * FROM tworkers WHERE tworkers_email = :e");
  $stmt->bindParam(':e', $input['email']);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_BOTH);
  ////var_dump($row);
////var_dump($row['tworkers_hash']);
  if($stmt->rowCount() > 0 && password_verify($input['hash'], $row['tworkers_hash'])){
    extract($row);
    $_SESSION['t_id'] = $tworkers_hashid;
    if(isset($_GET['ret'])){
      $url = $_GET['ret'];
      header("Location:/".$url);
    }else{
    header("Location:/myDashboard");
    //var_dump($_SESSION['t_id']);
}

  }else{
    $message = "invalid password or Email";
    $msg = str_replace(' ', '_', $message);
    header("Location:/tworkers_login?msg=$msg");
  }
}

function changeProfilePictures($dbconn, $destn,$hid){
  $getInfo = getUser($dbconn, $hid);
  $img = $getInfo['image'];
  try{
    $stmt = $dbconn->prepare("UPDATE client SET image=:bd WHERE hash_id =:hid");
    $data = [
      ":bd"=>$destn,
      ":hid"=> $hid
    ];
    $stmt->execute($data);
  }catch(PDOException $e ){
    die("Upload Fail, Please Try Again Later");
  }
  if($img !== NULL){
      unlink($img);
  }
  header("Location:dashboard");


}

function changeTProfilePictures($dbconn, $destn,$hid){
  $getInfo = getTworker($dbconn,$hid);
  $img = $getInfo['tworkers_image'];

  try{
    $stmt = $dbconn->prepare("UPDATE tworkers SET tworkers_image=:bd WHERE tworkers_hashid =:hid");
    $data = [
      ":bd"=>$destn,
      ":hid"=> $hid
    ];
    $stmt->execute($data);
  }catch(PDOException $e ){
    die("Upload Fail, Please Try Again Later");
  }
  if($img !== NULL){
      unlink($img);
  }
  header("Location:myDashboard");
}

function getTworker($dbconn, $sess){
  $stmt = $dbconn->prepare("SELECT * FROM tworkers WHERE tworkers_hashid = :th");
  $stmt->bindParam(':th', $sess);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_BOTH);
  return $row;
}


function getContact($dbconn, $sess){
  $stmt = $dbconn->prepare("SELECT * FROM contacts WHERE contact_owner = :th");
  $stmt->bindParam(':th', $sess);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_BOTH);
  return $row;
}

function getContactInfo($dbconn, $sess,$ses){
  $stmt = $dbconn->prepare("SELECT * FROM contacts WHERE contact_owner = :th AND contact_hash_id = :ch");
  $stmt->bindParam(':th', $sess);
  $stmt->bindParam(':ch', $ses);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_BOTH);
  return $row;
}

function getContactSkill($dbconn, $sess){
  $stmt = $dbconn->prepare("SELECT contact_category FROM contacts WHERE contact_id = :th");
  $stmt->bindParam(':th', $sess);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_BOTH);
  return $row;
}



function updateTworkersLocation($dbconn, $sess, $lat, $long){
  if($lat == "null" || $long == "null"){

  }else{
  $stmt = $dbconn->prepare("UPDATE tworkers SET tworkers_lat=:lt, tworkers_long=:lng WHERE tworkers_hashid=:sid ");
  $stmt->bindParam(":lng", $long);
  $stmt->bindParam(":lt", $lat);
  $stmt->bindParam(":sid", $sess);
    $stmt->execute();
  }
}

function addSkill($dbconn, $input, $sess){
  $info =  getTworker($dbconn, $sess);
  extract($info);
  $stmt = $dbconn->prepare("INSERT INTO tworker_skill VALUES(NULL, :tid, :sk,NOW() )");
  $stmt->bindParam(':tid', $tworkers_id );
  $stmt->bindParam(':sk', $input['skill']);
  $stmt->execute();
}

function completeRegistration($dbconn, $input, $sess, $dess){
  $stmt = $dbconn->prepare("UPDATE tworkers SET tworkers_dob=:td, tworkers_state=:ts, tworkers_lga=:tl, tworkers_image=:img, tworkers_address=:ta, tworkers_description=:tdes WHERE tworkers_hashid=:sid");
  $stmt->bindParam(":td", $input['dob']);
  $stmt->bindParam(":ts", $input['state']);
  $stmt->bindParam(":tl", $input['lga']);
  $stmt->bindParam(":ta", $input['address']);
  $stmt->bindParam(":tdes", $input['description']);
  $stmt->bindParam(":sid", $sess);
  $stmt->bindParam(":img", $dess);

  $stmt->execute();

  addSkill($dbconn, $input, $sess);
  $message = "Thank you for compliance";

  $msg = str_replace(' ', '_', $message);

  ////var_dump($input);
  header("Location:myDashboard?success=$msg");
}

function getState($dbconn){
  $stmt = $dbconn->prepare("SELECT * FROM states");
  $stmt->execute();
  while($row= $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);
    echo '<option value="'.$state_id.'">'.$name.'</option>';
  }
}

function getSkill($dbconn){
  $stmt = $dbconn->prepare("SELECT * FROM skill");
  $stmt->execute();
  while($row= $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);
    echo '<a href="#" data-target="#myModal1"><option value="'.$skill_id.'">'.$skill.'</option></a>';
  }
}



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//USER FUNCTIONS



function registerUser($dbconn,$input){

  $stmt = $dbconn->prepare("INSERT INTO client(firstname, lastname, username, phonenumber,state,lga,nationality,term,reg_date) VALUES(:fn,:ln,:un,:pn,:st,:lg,:ct,:trm,now()) ");
  $data = [
    ':fn' => $input['firstname'],
    ':ln' => $input['lastname'],
    ':un' => $input['username'],
    ':pn' => $input['phonenumber'],
    ':st' => $input['state'],
    ':lg' => $input['lga'],
    ':ct' => $input['country'],
    ':trm'=> $input['term']
  ];
  $stmt->execute($data);
  return $input['phonenumber'];
}

function getNewInfo($dbconn, $input, $getNum ){
  $hash  = password_hash($input['hash'], PASSWORD_BCRYPT);
  $getStmt = $dbconn->prepare("SELECT * FROM client WHERE phonenumber = :ps ");

  $getStmt->bindParam(':ps', $getNum);
  $getStmt->execute();
  //var_dump($getNum);

  $row = $getStmt->fetch(PDO::FETCH_BOTH);
  extract($row);
  $name = $username;
  //var_dump($name);
  //var_dump($user_id);
  $rnd = rand(000000000000000,99999999999999);
  $proc = $name.$rnd;
  $hash_id = str_shuffle($proc);
  //var_dump($hash);

  $sethash = $dbconn->prepare("UPDATE client SET hash_id =:hid WHERE phonenumber =:pd");
  $sethash->bindParam(":pd", $getNum);
  $sethash->bindParam(":hid", $hash_id);
  $sethash->execute();

  $setLoginDetail = $dbconn->prepare("INSERT INTO user_login_details(user_id, email_address, phone_number, hash ) VALUES(:uid,:em, :pk, :hs)");
  $setLoginDetail->bindParam(":uid", $user_id);
  $setLoginDetail->bindParam(":em", $input['email']);
  $setLoginDetail->bindParam(":pk", $input['phonenumber']);
  $setLoginDetail->bindParam(":hs", $hash);
  $setLoginDetail->execute();

   $vran = rand(0000000000,999999999);
  $process = $vran.$input['email'];
  $token = str_shuffle($process);


$updatever = $dbconn->prepare("INSERT INTO verify VALUES(NULL,:hid,:tk,NOW(),NOW())");
$data2 = [
  'hid' => $hash_id,
  'tk' => $token
];
$updatever->execute($data2);
$result = [];
  $result[] = $hash_id;
  $result[] = $token;

return $result;
}

function doesUserEmailExist($dbconn, $input){
  $result = false;
  $stmt = $dbconn->prepare("SELECT * FROM user_login_details WHERE email_address = :em");
  $stmt->bindParam(":em", $input);
  $stmt->execute();
  $count = $stmt->rowCount();
  if($count>0){
    $result = true;
  }
  return $result;
}

function doesUserPhoneNumberExist($dbconn, $input){
  $result = false;
  $stmt = $dbconn->prepare("SELECT * FROM user_login_details WHERE phone_number = :tp");
  $stmt->bindParam(":tp", $input);
  $stmt->execute();
  $count = $stmt->rowCount();
  if($count>0){
    $result = true;
  }
  return $result;
}

function doesUsernameExist($dbconn, $input){
  $result = false;
  $stmt = $dbconn->prepare("SELECT * FROM client WHERE username = :tp");
  $stmt->bindParam(":tp", $input);
  $stmt->execute();
  $count = $stmt->rowCount();
  if($count>0){
    $result = true;
  }
  return $result;
}

function getUser($dbconn, $sess){
  $stmt = $dbconn->prepare("SELECT * FROM client WHERE hash_id = :th");
  $stmt->bindParam(':th', $sess);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_BOTH);
  return $row;
}

function updateUsersLocation($dbconn, $sess, $lat, $long){
  $stmt = $dbconn->prepare("UPDATE client SET lat=:lt, long=:lng WHERE hash_id =:sid ");
  $stmt->bindParam(":lng", $long);
  $stmt->bindParam(":lt", $lat);
  $stmt->bindParam(":sid", $sess);
  if($lat == NULL || $long == NULL){
    echo '<p>Location Update Ready, Please Ensure your Location is on and <input id="my_long" type="submit" value="Update Location" name="submit">';
  }else{
    $stmt->execute();
  }
}


function getCountry($dbconn){
  $stmt = $dbconn->prepare("SELECT * FROM country");
  $stmt->execute();
  while($row= $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);
    echo '<option value="'.$nicename.'">'.$nicename.'</option>';
  }
}

function loginUser($dbconn, $input){

  $result =[];
  $stmt = $dbconn->prepare("SELECT * FROM user_login_details WHERE email_address = :e");
  $stmt->bindParam(':e', $input['email']);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_BOTH);
  //////var_dump($row);

  if($stmt->rowCount() > 0 && password_verify($input['hash'], $row['hash'])){
    extract($row);

    $getHashId = $dbconn->prepare("SELECT hash_id FROM client WHERE user_id=:uid");
    $getHashId->bindParam(':uid', $user_id);
    $getHashId->execute();
    $info = $getHashId->fetch(PDO::FETCH_BOTH);
    extract($info);
    $_SESSION['u_id'] = $hash_id;
    if(isset($_GET['ret'])){
      $url = $_GET['ret'];
      header("Location:/$url");
    }else{
    header("Location:/tunsehome");
  }
    //////var_dump($_SESSION['u_id']);


  }else{

    $message = "invalid password or Email";
    $msg = str_replace(' ', '_', $message);
    header("Location:/tunsehome?msg=$msg");
    ////var_dump($msg);
  }
}

function getTworkerSkills($dbconn, $get){

$stmt = $dbconn->prepare("SELECT * FROM tworkers WHERE tworkers_hashid = :thid");
$stmt->bindParam(':thid', $get);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_BOTH);
extract($row);
// ////var_dump($tworkers_id);

$statement = $dbconn->prepare("SELECT * FROM tworker_skill WHERE tworker_id = :tid ");
$statement->bindParam(':tid', $tworkers_id);
$statement->execute();

while($info = $statement->fetch(PDO::FETCH_BOTH)){
  extract($info);
  // ////var_dump($skill_id);
  $skill = $dbconn->prepare("SELECT * FROM skill WHERE skill_id = :sid ");
  //////var_dump($skill);
  $skill->bindParam(':sid', $skill_id);
  $skill->execute();

  $resp = $skill->fetch(PDO::FETCH_BOTH);
    //////var_dump($resp);
    extract($resp);
    echo'<li>'.$skill.'</li>';
}
}

function sendNotification($dbconn,$hash_id,$msg,$type,$type_id){
  $stmt = $dbconn->prepare("INSERT INTO notification VALUES(NULL, :ns, :ownid, :cnt, :noti,:type,:tyid, NOW(), NOW()) ");
  $data =[
    ":ns" => 0,
    ":ownid" => $hash_id,
    ":cnt" => 1,
    ":noti"=> $msg,
    ":type"=> $type,
    ":tyid"=> $type_id,

  ];
  $stmt->execute($data);

}

function sendTask($dbconn,$sess,$input,$get, $uname){
  $ran = rand(00000,9999);
  $diffran = "taskto".$ran;
  $task_hashid = $sess.$diffran.$get;
  $count = 1;


  $stmt = $dbconn->prepare("INSERT INTO task VALUES(NULL,:thid, :ci, :tsk, :tid,0,:cnt,NOW(),NOW())");
  $stmt->bindParam(':ci', $sess);
  $stmt->bindParam(':tsk', $input);
  $stmt->bindParam(':tid', $get);
  $stmt->bindParam(':cnt', $count);
  $stmt->bindParam(':thid', $task_hashid);

  $stmt->execute();
  ////var_dump($count);
  ////var_dump($task_hashid);

  $type = "task";

  sendNotification($dbconn, $get, "You have recieved a $type  from $uname", $type,$task_hashid);
}

function setReadNotification($dbconn, $get){
  $stmt = $dbconn->prepare("DELETE FROM notification WHERE type_id = :gt");

  $stmt->bindParam(":gt", $get);
  $stmt->execute();
}

function getTaskInfo($dbconn, $get){
  $stmt= $dbconn->prepare("SELECT * FROM task WHERE task_hashid = :gt");

  $stmt->bindParam(":gt", $get);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_BOTH);
  return $row;
}








?>
