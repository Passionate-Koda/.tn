<?php
ob_start();
// $page_name = "Home";
// define("REC_PATH", dirname(dirname(__FILE__)));
// include REC_PATH.'/includes/header.php';
//
//
session_start();
session_write_close();

authenticateUser('u_message');
if(isset($_SESSION['u_id'])){
  $sid = $_SESSION['u_id'];
  $getInfo = getUser($econn, $sid);
  extract($getInfo);
}

// if(isset($_GET['id'])){
//   $getid = $_GET['id'];
//   setReadNotification($econn, $getid );
// }

// $info = getTaskInfo($econn, $_GET['id']);
// extract($info);
//
$client_info = getTworker($econn, $_GET['r']);
extract($client_info);
$uname = ucwords($tworkers_firstname);
$page = "chat";
include 'includes/header.php';
if(array_key_exists("submit",$_POST)){
$error = [];
if(empty($_POST['review'])){
  $error['review'] = "Please Enter Review";
}
if(empty($error)){
  $clean = array_map('trim', $_POST);
  enterReview($econn,$clean,$sid,$tworkers_hashid);
}
}
?>

<input type="hidden" id="session" name="" value="<?php echo $sid ?>">
<div class="content">
  <!-- <?php// include 'includes/task_tab.php' ?> -->
  <!-- content-control -->
  <div class="content-control">
  <style>
/*
@import url(http://fonts.googleapis.com/css?family=Roboto:500,100,300,700,400);

* {
margin: 0;
padding: 0;
font-family: roboto;
}
*/



.cont {
width: 93%;
max-width: 350px;
text-align: center;
margin: 4% auto;
padding: 30px 0;
background: #111;
color: #EEE;
border-radius: 5px;
border: thin solid #444;
overflow: hidden;
}

hr {
margin: 20px;
border: none;
border-bottom: thin solid rgba(255,255,255,.1);
}

div.title { font-size: 2em; }



div.stars {
width: 270px;
display: inline-block;
}

input.star { display: none; }

label.star {
float: right;
padding: 10px;
font-size: 36px;
color: #444;
transition: all .2s;
}

input.star:checked ~ label.star:before {
content: '\f005';
color: #FD4;
transition: all .25s;
}

input.star-5:checked ~ label.star:before {
color: #FE7;
text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
content: '\f006';
font-family: FontAwesome;
}
</style>



    <!--breadcrumb-->
    <ul class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
      <li><a href="u_message">Inbox</a></li>
      <li class="active">Chat</li>

    </ul>




  </div>
  <!--/breadcrumb--
  <!-- /content-control -->

  <div class="content-body">
    <div class="col-md-4">
      <div class="c-content">
        <div class="c-header">

          <div class="title">

          <h3><a href=""><span class="flaticon-exit"><span></a>&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp<span class="flaticon-chat"><span> TunChat</h3>


          </div>
          <div class="title-name">
            <h3><span class="flaticon-user"><span><?php echo $uname ?></h3>

          </div>
          <div class="title-name" style="left:70%">
            <button class="btn btn-default" data-toggle="modal" data-target="#customModal2">Review</button>
          </div>
          <div class="title-name" style="left:30%">
            <?php
            $cidd = getContactID($econn,$_GET['s'],$_GET['r']);
             echo '<button class="btn btn-default"><a href="contact?o='.$_GET['s'].'&t='.$_GET['r'].'&i='.$cidd.'">View Info<a/></button>' ?>
          </div>


          <div class="modal modal-center modal-fullwidth fade" id="customModal2" tabindex="-1" role="dialog" aria-labelledby="customModal2Label" aria-hidden="true">
            <div  class="modal-dialog animated bounceIn">
              <div class="modal-content bg-darknight">
                <div class="modal-body text-white">
                  <div class="" style="text-align: center">
                    <hr>
                    <p><img style=" margin-left: auto;margin-right: auto;text-align: center;display: table-cell;vertical-align: middle;max-height: 350px;max-width: 350px;" src="<?php echo $tworkers_image ?>" style="height: 100px; width: 150px" class="img-responsive" alt="Fountain" class="img-rounded img-responsive"></p>
                    <hr>
                    <h1>Rate Tworker</h1>
                    <form action="" method="post">
                    <div class="cont">
                      <div class="stars">

                          <input class="star star-5" id="star-5-2" type="radio" name="star" value="5" required/>
                          <label class="star star-5" for="star-5-2"></label>
                          <input class="star star-4" id="star-4-2" type="radio" name="star" value="4" required/>
                          <label class="star star-4" for="star-4-2"></label>
                          <input class="star star-3" id="star-3-2" type="radio" name="star" value="3" required/>
                          <label class="star star-3" for="star-3-2"></label>
                          <input class="star star-2" id="star-2-2" type="radio" name="star" value="2" required/>
                          <label class="star star-2" for="star-2-2"></label>
                          <input class="star star-1" id="star-1-2" type="radio" name="star" value="1" required/>
                          <label class="star star-1" for="star-1-2"></label>

                      </div>

                    </div>
                    <div class="cont">
                    <textarea class="form-control" name="review" rows="8" cols="auto" required></textarea>
                    <input class="form-control" type="submit" name="submit" value="Review">
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->





        </div>
        <div class="msg-background">
          <ul id="mess" class="c-holder-msg" style="padding: 5px;">
            <span>Message Loading...</span>
            <!--Message appears here from database  -->
          </ul>
        </div>
        <div class="chatbox-footer">
                        <form id="msgForm" action="" method="post" class="chat-form">

                            <div class="form-group">
                                <button id="textButton" type="submit" class="btn" title="Send"><i class="fa fa-share"></i></button>
                                <textarea id="text" class="chat-input" name="" placeholder="Type a message" required="yes" rows="auto" cols="80"></textarea>
                                <!-- <input id="text" type="text" class="chat-input" name="" placeholder="Type a message" required="yes"> -->
                            </div>
                        </form>
                    </div><!-- /chatbox -->
      </div>

    </div>


  </div><!--/content-body -->
</div><!--/content -->
</section>

<!--/content section -->


<!-- side-right -->
<?php include 'includes/normal.php' ?>


<!-- section footer -->
<a rel="to-top" href="#top"><i class="fa fa-arrow-up"></i></a>
<?php include 'includes/footer.php' ?>
<input type="hidden" id="contact" name="" value="">
<input id="r" type="hidden" name="" value="<?php echo $_GET['r']?>">
<input id="s" type="hidden" name="" value="<?php echo $_GET['s']?>">
<input id="sAl" type="hidden" name="" value="<?php echo ucwords($username)?>">
<input id="rAl" type="hidden" name="" value="<?php echo $uname?>">

<!-- javascript
================================================== -->
<script src="asset/scripts/39914ff3.vendor-main.js"></script>
<script src="asset/scripts/756399db.vendor-usefull.js"></script>
<script src="asset/scripts/e7058f60.vendor-form.js"></script>
<script src="asset/scripts/fc9d433c.vendor-editor.js"></script>
<!--[if lte IE 8]>
<script src="asset/scripts/eae815b5.excanvas.js"></script>
<![endif]-->
<script src="asset/scripts/2ce1156c.vendor-graph.js"></script>
<script src="asset/scripts/37a77790.vendor-table.js"></script>
<script src="asset/scripts/1581b2aa.vendor-maps.js"></script>
<script src="asset/scripts/5f4fd25b.vendor-util.js"></script>


<!-- required stilearn template js -->
<script src="asset/scripts/5917523f.main.js"></script>
<!-- This scripts will be reload after pjax or if popstate event is active (use with class .re-execute) -->
<script src="asset/scripts/89c3d6c9.initializer.js"></script>

<script>
(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
  function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
  e=o.createElement(i);r=o.getElementsByTagName(i)[0];
  e.src='../../../../www.google-analytics.com/analytics.js';
  r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
  ga('create','UA-71722129-1');ga('send','pageview');
  </script>
  <script type="text/javascript" src="js/message_ajax.js">
</script>
</script>


</body>
<!-- Mirrored from stilearning.com/items/preview/stilearn-admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 24 Dec 2017 16:54:14 GMT -->
</html>
