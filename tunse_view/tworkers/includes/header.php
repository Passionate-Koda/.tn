<?php  header("cache-control:no-cache"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>Tunse - Connect you to reliable artisans</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="tunse">

        <meta http-equiv="x-pjax-version" content="v173">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!-- fav and touch icons -->
        <!-- <link rel="apple-touch-icon-precomposed" sizes="144x144" href="asset/ico/favico-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="asset/ico/favico-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="asset/ico/favico-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="asset/ico/favico-57-precomposed.png"> -->

        <link rel="shortcut icon" href="asset/ico/tunse.jpg">
        <link rel="shortcut icon" href="asset/ico/favico.html">

        <link rel="stylesheet" href="asset/styles/9281c719.vendor.css"/>
        <link rel="stylesheet" href="asset/styles/style.css"/>
        <link rel="stylesheet" type="text/css" href="asset/fonts/flaticon.css">
        <link rel="stylesheet" type="text/css" href="asset/font/flaticon.css">
        <link rel="stylesheet" href="asset/styles/3fc417cd.main.css"/>
<?php if($page == "chat"){ ?>
  <script type="text/javascript">
  setInterval(function(){
  active('<?php echo $_GET['s']?>','<?php echo $_GET['r']?>');
  }, 3000);
  </script>

<?php } ?>
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
        <![endif]-->
    </head>
<?php if($page == "directory" || $page == "contact_info" || $page == "message"){ ?>
  <body onpageshow="getNofication();getNoficationCount();getContact()">
<?php }elseif($page == "tdashboard"){ ?>
<body onpageshow="getNofication();getNoficationCount();getAcceptedTaskCount();getDeclinedTaskCount()">


<?php }elseif($page == "task"){ ?>
<body onpageshow="getNofication();getNoficationCount(); updateNotif('<?php echo $getid ?>');getAcceptedTaskCount();getDeclinedTaskCount()">

<?php }else{ ?>

    <body class="animated fadeIn">
        <!-- section header -->
<?php } ?>

            <header class="header">
              <input type="hidden" id="session" name="" value="<?php echo $sid  ?>">

            <!-- header brand -->
            <div class="header-brand">
                <!-- <h2><a data-pjax=".content-body" href="index.php"><span class="text-primary">Sti</span>learn</a></h2> -->
                <a data-pjax=".content-body" href="index.php">
                    <img class="brand-logo" src="asset/images/dummy/logo2.png" alt="Tunse Logo">
                </a>
              
            </div><!-- header brand -->

            <!-- header-profile -->
            <div class="header-profile">
                <div class="profile-nav">
                    <span class="profile-username"><?php echo ucwords($tworkers_firstname)  ?></span>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu animated flipInX pull-right" role="menu">
                        <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i> Inbox</a></li>
                        <li><a href="#"><i class="fa fa-tasks"></i> Tasks</a></li>
                        <li class="divider"></li>
                        <li><a href="tlogout"><i class="fa fa-sign-out"></i> Log Out</a></li>
                    </ul>
                </div>
                <div class="profile-picture" style="background-image:url(<?php echo $tworkers_image ?>); background-size:cover; background-position:center; background-repeat:no-repeat;">
                    <!-- <img alt="me" src="<?php// echo $tworkers_image ?>"> -->
                </div>
            </div><!-- header-profile -->

            <!-- header menu -->
            <ul class="hidden-xs header-menu pull-right">
             
                <li>
                    <a href="#" title="Notifications" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <span id="notCnt" class="badge badge-success">0</span>
                        <i class="header-menu-icon icon-only fa fa-bell"></i>
                    </a>
                    <ul id="not" class="dropdown-menu dropdown-extend animated fadeInDown pull-right" role="menu">
                        <li class="dropdown-header">Notifications</li><!-- /dropdown-header -->
                        <li class="notif-minimal" data-toggle="niceScroll" data-scroll-cursorcolor="#ecf0f1">

                            <!-- /notif-item -->
                        </li><!-- /dropdown-alert -->
                        <li class="dropdown-footer bg-cloud">

                        </li><!-- /dropdown-footer -->
                    </ul><!-- /dropdown-extend -->
                </li><!-- /header-menu-item -->
                <li>
                    <a href="#" title="Inboxs" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <span class="badge badge-warning animated animated-repeat flash" id=msgNotCnt >0</span>
                        <i class="header-menu-icon icon-only fa fa-envelope-o"></i>
                    </a>
                    <ul id="msgNot" class="dropdown-menu dropdown-extend animated fadeInDown pull-right" role="menu">
                        <!-- /dropdown-header -->
                        <!-- /dropdown-footer -->
                    </ul><!-- /dropdown-extend -->
                </li><!-- /header-menu-item -->
            </ul><!--/header-menu pull-right-->
        </header><!--/header-->


        <!-- content section -->

            <section class="section">


            <!-- DONT FORGET REPLACE IT FOR PRODUCTION! -->
            <aside class="side-left">
                <ul class="sidebar">
                    <li>
                        <a href="myDashboard" data-pjax=".content-body">
                            <i class="sidebar-icon fa fa-home"></i>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li>
                        <a href="tworkersContact" data-pjax=".content-body">
                            <i class="sidebar-icon fa fa-archive "></i>
                            <span class="sidebar-text">Directory</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li>
                        <a href="tworkersMessage" data-pjax=".content-body">
                            <i class="sidebar-icon fa fa-envelope"></i>
                            <span class="sidebar-text">Messages</span>
                        </a>
                    </li><!--/sidebar-item-->
                        </ul><!--/sidebar-child-->
                    </li><!--/sidebar-item-->
                </ul><!--/sidebar-->
            </aside><!--/side-left-->
