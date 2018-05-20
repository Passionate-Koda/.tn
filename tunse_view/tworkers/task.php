<?php
ob_start();
session_start();
authenticateTworker('myDashboard');
if(isset($_SESSION['t_id'])){
  $sid = $_SESSION['t_id'];
}

$getInfo = getTworker($econn, $sid);
extract($getInfo);

if(isset($_GET['updLoc'])){
  if($_GET['updLoc'] == "upt"){
    updateTworkersLocation($econn, $sid, $_POST['my_lat'], $_POST['my_long']);
  }
}

$info = getTaskInfo($econn, $_GET['id']);
extract($info);
$formattedDate = decodeDate($task_created);
$formattedTime = decodeTime($time_created);

$client_info = getUser($econn, $client_id);
extract($client_info);
$uname = ucwords($username);
$msg = "$tworkers_firstname accepted your task request";
$msg2 = "$tworkers_firstname declined your task request";

if(isset($_GET['id'])){
  $getid = $_GET['id'];

}

$page = "task";
include 'includes/header.php';
 ?>


             <div class="content">
                 <?php include 'includes/task_tab.php' ?>
                 <!-- content-control -->
                 <div class="content-control">
                     <!--breadcrumb-->
                     <ul class="breadcrumb">
                       <li><a href="myDashboard"><i class="fa fa-home"></i> Dashboard</a></li>
                       <li class="active">Task Request</li>
                     </ul>
                     </div>
                     <!--/breadcrumb--
                 <!-- /content-control -->

                 <div class="content-body">
                   <div class="callout callout-success">
                    <h5> Tips on Task Handling</p>
                     <ul>
  <li><p class="text-success">You should review and attend to your tasks on time! Dont keep taskers waiting</p></li>
</ul>



                   </div>
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#customModal2">Review Task</button>
<div class="modal modal-center modal-fullwidth fade" id="customModal2" tabindex="-1" role="dialog" aria-labelledby="customModal2Label" aria-hidden="true">
                                <div  class="modal-dialog animated bounceIn">
                                    <div class="modal-content bg-darknight">
                                        <div class="modal-body text-white">
                                          <div class="" style="text-align: center">
                                            <hr>

                                            <p><img style=" margin-left: auto;margin-right: auto;text-align: center;display: table-cell;vertical-align: middle;max-height: 350px;max-width: 350px;" src="asset/images/dummy/0c31c9dc.profile.jpg" style="height: 100px; width: 150px" class="img-responsive" alt="Fountain" class="img-rounded img-responsive"></p>
                                            <hr>
                                            <h1>Task Details</h1>
                                            <p><strong>User:</strong> <?php echo $uname ?></p>
                                            <p><strong>Task:</strong> <?php echo $task ?></p>
                                            <p><strong>Date:</strong> <?php echo $formattedDate ?></p>
                                            <p><strong>Time:</strong> <?php echo $formattedTime ?></p>


                                          </div>

                                             <div class="clearfix">
                                                 <div class="pull-right">
                                                     <button  type="button" onclick="updateTask('<?php echo $_GET['id'] ?>','1');redirect('myDashboard');sendNotif('<?php echo $msg2 ?>','<?php echo $hash_id ?>','<?php echo $sid ?>', '<?php echo $getid ?>', 'decline')" class="btn btn-sm btn-warning" data-dismiss="modal">Decline</button>
                                                     <button type="button" onclick="updateTask('<?php echo $_GET['id'] ?>','2'); sendNotif('<?php echo $msg ?>','<?php echo $hash_id ?>','<?php echo $sid ?>', '<?php echo $getid ?>', 'reply');addContact('<?php echo $sid ?>', '<?php echo $task_category ?>','<?php echo $uname ?>','<?php echo $phonenumber ?>','<?php echo $hash_id ?>', 'Client')" id="msg" form="passwordCheck" class="btn btn-sm btn-primary">Accept</button>
                                                 </div>
                                             </div>

                                                         </div>

                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->



                                 </div><!--/content-body -->
             </div><!--/content -->
           </section>

        <!--/content section -->


         <!-- side-right -->
         <?php include 'includes/normal.php' ?>


         <!-- section footer -->
         <a rel="to-top" href="#top"><i class="fa fa-arrow-up"></i></a>
    <?php include 'includes/footer.php' ?>
<input type="hidden" id="session" name="" value="<?php echo $sid  ?>">
    <!-- <input type="hidden" id="taskNot" name="" value="">
    <input type="hidden" id="dtaskNot" name="" value="">
    <input type="hidden" id="ataskNot" name="" value=""> -->

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
         <script type="text/javascript" src="jss/td_ajax.js">

         </script>
         <script type="text/javascript" src="jss/t_ajax.js">

         </script>

     </body>

 <!-- Mirrored from stilearning.com/items/preview/stilearn-admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 24 Dec 2017 16:54:14 GMT -->
 </html>
