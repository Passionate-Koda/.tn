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
?>

<input type="hidden" id="session" name="" value="<?php echo $sid ?>">
<div class="content">
  <!-- <?php// include 'includes/task_tab.php' ?> -->
  <!-- content-control -->
  <div class="content-control">



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
