<?php
ob_start();
// $page_name = "Home";
// define("REC_PATH", dirname(dirname(__FILE__)));
// include REC_PATH.'/includes/header.php';
//
//
session_start();

authenticateUser('contact');
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
if(isset($_GET['t'])){
  $tid = $_GET['t'];
}
if(isset($_GET['o'])){
  $oid = $_GET['o'];
}
if(isset($_GET['i'])){
  $iid = $_GET['i'];
}

$client_info = getTworker($econn, $tid);
extract($client_info);
$uname = ucwords($tworkers_firstname);

$contact_info = getContactInfo($econn, $oid,$tid);
extract($contact_info);
$cname = ucwords($contact_name);

$contact_Skill = getContactSkill($econn, $iid);





$page = "contact_info";
include 'includes/header.php';
 ?>
<input type="hidden" id="session" name="" value="<?php echo $sid  ?>">

             <div class="content">
                 <?php //include 'includes/task_tab.php' ?>
                 <!-- content-control -->
                 <div class="content-control">



                     <!--breadcrumb-->
                     <ul class="breadcrumb">
                         <li><a href="dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
                         <li><a href="contact">Directory</a></li>
                         <li class="active">Info</li>

                     </ul>




                     </div>
                     <!--/breadcrumb--
                 <!-- /content-control -->

                 <div class="content-body">
                   <div class="col-md-4">
                     <div class="directory-content">
                       <div class="directory-header">

                         <div class="directory-title">
                         <h3>Contact Info</h3>
                         </div>
                         <button type="button" class="btn btn-default" data-toggle="modal" data-target="#customModal2">Location</button>
                       </div>
                       <div class="directory-body">
                       <div class="directory-top">
                         <div class="display-picture" style=" background-image:url('<?php echo $tworkers_image ?>');">


                         </div>

                         <div class="name-holder">
                           <p><?php echo $cname ?></p>
                         </div>

                       </div>


                       <div class="info">
                         <ul class="directory-holder">

                           <li class="contacts">
                             <span id="directory-anchor">

                               <div class="directory-avater">
                                 <i id="ico"  class="flaticon-smartphone-1
                 "></i>
                               </div>
                               <a href="tel:<?php echo $contact_phone?>"><p><?php echo $contact_phone  ?></p></a>


                             </span>
                           </li>
                           <li class="contacts">
                             <span id="directory-anchor" >

                               <div class="directory-avater">
                                 <i id="ico"  class="flaticon-briefcase"></i>
                               </div>

                               <p><?php echo $contact_Skill['contact_category']  ?></p>

                             </span>
                           </li>
                           <li class="contacts">
                             <span id="directory-anchor">

                               <div class="directory-avater">
                                 <i id="ico"  class="flaticon-user-6"></i>
                               </div>

                               <p><?php echo $contact_type  ?></p>

                             </span>
                           </li>




                         </ul>


                       </div>

                       </div>
                       <div class="modal modal-center modal-fullwidth fade" id="customModal2" tabindex="-1" role="dialog" aria-labelledby="customModal2Label" aria-hidden="true">
                                <div  class="modal-dialog animated bounceIn">
                                    <div class="modal-content bg-darknight" style="height:auto">
                                        <div class="modal-body text-white">
                                          <div class="" style="text-align: center">

                                          <div id="map" style="width:100%; height:300px; margin-left: 10px; " >

                                          </div>





                                          </div>



                                                         </div>

                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->

                     </div>

                   </div>


<!-- <div class="clearfix">

</div> -->
<input type="hidden" id="contact" name="" value="">



                     <!--//////////////////////////Tbody End ///////////////////////////////////////////////////////////////////////////
                     ////////////////////////////////////////////////  -->



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
         <script>
         function initMap() {
           var point = {lat:<?php echo $tworkers_lat ?>, lng:<?php echo $tworkers_long ?>};
           var map = new google.maps.Map(document.getElementById('map'), {
             zoom: 17,
             center: point
           });
           var marker = new google.maps.Marker({
             position: point,
             map: map
           });
         }
         </script>
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCScwCRZOo5trTCzyk9vqNbhFAkT4-cgRU&callback=initMap"
         async defer></script>
         <script type="text/javascript" src="/js/contactAjax.js">
         </script>

     </body>

 <!-- Mirrored from stilearning.com/items/preview/stilearn-admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 24 Dec 2017 16:54:14 GMT -->
 </html>
