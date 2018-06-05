<?php

ob_start();
session_start();
authenticateTworker('myDashboard');
if(isset($_SESSION['t_id'])){
  $sid = $_SESSION['t_id'];
}
if(isset($_GET['updLoc'])){
  if($_GET['updLoc'] == "upt"){
    updateTworkersLocation($econn, $sid, $_POST['my_lat'], $_POST['my_long']);
  }
}
$getInfo = getTworker($econn, $sid);
extract($getInfo);

$page = "tdashboard";
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
                   <div class="callout callout-success">

                       <?php
                       if(isset($_GET['msg'])){
          $msg = str_replace('_', ' ', $_GET['msg']);
        echo  "<div class=\"alert alert-danger\" role=\"alert\">
					<strong>Warning! </strong>$msg
				</div>";
        } ?>
        <?php if(isset($_GET['success'])){
          $msg = str_replace('_', ' ', $_GET['success']);
        echo  "<div class=\"alert alert-success\" role=\"alert\">
					<strong>Successful! </strong>$msg
				</div>";
        }
                       ?>

                     <?php if($tworkers_dob == NULL){?>

                       To continue, Please Complete your registration <a href="c_registration">here</a>
                     <?php }else{ ?>
                     <h3>Welcome </h3>

                     <?php }?>


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
         <script type="text/javascript" src="jss/t_ajax.js">

         </script>

     </body>

 <!-- Mirrored from stilearning.com/items/preview/stilearn-admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 24 Dec 2017 16:54:14 GMT -->
 </html>
