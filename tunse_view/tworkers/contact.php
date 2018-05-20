<?php
ob_start();
session_start();
authenticateTworker('tworkersContact');
if(isset($_SESSION['t_id'])){
  $sid = $_SESSION['t_id'];
}

$getInfo = getTworker($econn, $sid);
extract($getInfo);

if(isset($_GET['updLoc'])){
  if($_GET['updLoc'] == 'upt'){
    updateTworkersLocation($econn, $sid, $_POST['my_lat'], $_POST['my_long']);
  }
}




$page = "directory";
include 'includes/header.php';
?>


<div class="content">
  <!-- <?php// include 'includes/task_tab.php' ?> -->
  <!-- content-control -->
  <div class="content-control">



    <!--breadcrumb-->
    <ul class="breadcrumb">
      <li><a href="myDashboard"><i class="fa fa-home"></i> Dashboard</a></li>
      <li class="active">Directory</li>

    </ul>




  </div>
  <!--/breadcrumb--
  <!-- /content-control -->

  <div class="content-body">
    <div class="col-md-4">
      <div class="c-content">
        <div class="c-header">

          <div class="title">
          <h3>Directory</h3>
          </div>


        </div>
        <ul id="contact" class="c-holder">
          <span>Contact Loading...</span>
<!--Contact appears here from the database  -->


        </ul>
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


<script type="text/javascript" src="jss/bootstrap.min.js"></script>
    <script type="text/javascript" src="jss/contactAjax.js">
</script>
<!-- javascript
================================================== -->
<script type="text/javascript" src="asset/scripts/39914ff3.vendor-main.js"></script>
<script type="text/javascript" src="asset/scripts/756399db.vendor-usefull.js"></script>
<script type="text/javascript" src="asset/scripts/e7058f60.vendor-form.js"></script>
<script type="text/javascript" src="asset/scripts/fc9d433c.vendor-editor.js"></script>
<!--[if lte IE 8]>
<script src="asset/scripts/eae815b5.excanvas.js"></script>
<![endif]-->
<script type="text/javascript" src="asset/scripts/2ce1156c.vendor-graph.js"></script>
<script type="text/javascript" src="asset/scripts/37a77790.vendor-table.js"></script>
<script type="text/javascript" src="asset/scripts/1581b2aa.vendor-maps.js"></script>
<script type="text/javascript" src="asset/scripts/5f4fd25b.vendor-util.js"></script>


<!-- required stilearn template js -->
<script type="text/javascript" src="asset/scripts/5917523f.main.js"></script>
<!-- This scripts will be reload after pjax or if popstate event is active (use with class .re-execute) -->
<script type="text/javascript" src="asset/scripts/89c3d6c9.initializer.js"></script>

<script type="text/javascript">
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
