<?php

$page = "home";
include 'includes/header.php';
 ?>


             <div class="content">
                 <?php include 'includes/task_tab.php' ?>
                 <!-- content-control -->
                 <div class="content-control">
                     <!--breadcrumb-->
                     <ul class="breadcrumb">
                         <li><a href="index-2.html"><i class="fa fa-home"></i> Dashboard</a></li>
                     </ul>
                     </div>
                     <!--/breadcrumb--
                 <!-- /content-control -->

                 <div class="content-body">




                                 </div><!--/content-body -->
             </div><!--/content -->
           </section>

        <!--/content section -->


         <!-- side-right -->
         <?php include 'includes/normal.php' ?>


         <!-- section footer -->
         <a rel="to-top" href="#top"><i class="fa fa-arrow-up"></i></a>
    <?php include 'includes/footer.php' ?>



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

     </body>

 <!-- Mirrored from stilearning.com/items/preview/stilearn-admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 24 Dec 2017 16:54:14 GMT -->
 </html>















<?php
ob_start();
session_start();
authenticateUser();
if(isset($_SESSION['u_id'])){
  $sid = $_SESSION['u_id'];
  $getInfo = getUser($econn, $sid);
  extract($getInfo);
}
  //var_dump($hash_id);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to tunse</title>
  </head>
  <style>
.hide{
  display:none;
}

</style>
<body onpageshow="getPendingTaskCount();getTaskCount(); getNofication('<?php echo $hash_id ?>');getNoficationCount('<?php echo $hash_id ?>')">
    <h1>Welcome to Tunse</h1>
<?php
  $Username = ucfirst($username);
  echo "Welcome, $Username";
?>
<br>
<nav>
<ul>
<a href="/u_platform"><li>Home</li></a>
<a href="/u_messages"><li>Messages</li></a>
<a//var_dump='vis("showNot", "show");vis("showcls", "show")'  href="#"><li>Notification &nbsp<span id="notCnt"></span></li></a>
<a href="#"><li>Pending Tasks &nbsp <span id="ptaskNot"></span></li></a>
<a href="#"><li>Tasks &nbsp <span id="taskNot"></span></li></a>
<a href="/u_platform"><li>My Account</li></a>
<a id="logout" href=""><li>Logout</li></a>
</ul>
</nav>
<div  id="showNot" class="hide"></div><div id="showcls" class="hide"><a id="clse" href="">X</a></div>
<hr>

<form class="" action="index.html" method="post">
  <select onchange="getWorkers(this.value)"class="" name="">
    <?php getSkill($econn) ?>
  </select>
<div >
  <ul id="showWkr">
  </ul>
</div>
</form>
<script type="text/javascript" src="u_ajax">
</script>
  </body>
</html>
