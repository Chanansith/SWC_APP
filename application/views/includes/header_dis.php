<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>DISPOSAL</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.4 -->
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- FontAwesome 4.3.0 -->
  <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons 2.0.0 -->
  <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
  <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />


  <style>
    .error {
      color: red;
      font-weight: normal;
    }

 
        #map {
            height: 500px;
            width: 100%;
        }
    
    iframe {
      width: 100%;
      height: 100%;
      border: none;
    }
  </style>
  <!-- jQuery 2.1.4 -->
  <!-- <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script> -->
  <script type="text/javascript">
    var baseURL = "<?php echo base_url(); ?>";
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- DataTables -->
  <!-- <script src="<?php echo base_url('assets/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script> -->
  <!-- include summernote css/js -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- <body class="sidebar-mini skin-black-light"> -->

<body class="skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo base_url_api; ?>disposal" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>DISPOSAL</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>SWC DISPOSAL</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
          
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="user-image" alt="User Image" />
                <span class="hidden-xs"><?php echo $name; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="img-circle" alt="User Image" />
                  <p>
                    <?php echo $name; ?>
                    <small><?php echo $role_text; ?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <!-- <div class="pull-left">
                    <a href="<?php echo base_url(); ?>loadChangePass" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Change Password</a>
                  </div> -->
                  <div class="pull-right">
                    <a href="<?php echo base_url_api; ?>disposal/signout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> -->
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">MAIN NAVIGATION</li>
          <!-- <li class="treeview">
            <a href="<?php echo base_url(); ?>dashboard">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
            </a>
          </li> -->
          <!-- <li class="treeview">
              <a href="#" >
                <i class="fa fa-plane"></i>
                <span>New Task</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#" >
                <i class="fa fa-ticket"></i>
                <span>My Tasks</span>
              </a>
            </li> -->
          <?php
          if ($role == ROLE_ADMIN || $role == ROLE_MANAGER) {
          ?>
            <!-- <li class="treeview">
              <a href="#" >
                <i class="fa fa-thumb-tack"></i>
                <span>Task Status</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#" >
                <i class="fa fa-upload"></i>
                <span>Task Uploads</span>
              </a>
            </li> -->
          <?php
          }

          ?>

          <li class="treeview">
            <a href="#">
              <!-- <i class="fa fa-cubes"></i> -->
              <span>สัญญา</span>
               <i class="fa fa-angle-right pull-right"></i> 
            </a>
            <ul class="treeview-menu">
         
              <li class="treeview">
                <a href="<?php echo base_url_api; ?>disposal/addcontract">
                  <i class="fa fa-plus-circle"></i>
                  <span>สร้างสัญญา</span>
                </a>
              </li>
              <li class="treeview">
                <a href="<?php echo base_url_api; ?>disposal/contract">
                  <i class="fa fa-cubes"></i>
                  <span>รายการสัญญา</span>
                </a>
              </li>
            </ul> 
          </li>

        
          <li class="treeview">
            <a href="#">
              <!-- <i class="fa fa-cubes"></i> -->
              <span>งานขนส่ง</span>
               <i class="fa fa-angle-right pull-right"></i> 
            </a>
            <ul class="treeview-menu">
             
              <li class="treeview">
                <a href="<?php echo base_url_api; ?>disposal/transportitem">
                  <i class="fa fa-cubes"></i>
                  <span>รายการ</span>
                </a>
              </li>
            </ul> 
          </li>
          <li class="treeview">
            <a href="#">
              <!-- <i class="fa fa-cubes"></i> -->
              <span>รายงาน</span>
               <i class="fa fa-angle-right pull-right"></i> 
            </a>
            <ul class="treeview-menu">
             
              <li class="treeview">
                <a href="<?php echo base_url_api; ?>disposal/summarydisposal">
                  <i class="fa fa-cubes"></i>
                  <span>สรุปยอดขยะติดเชื้อ</span>
                </a>
              </li>
            </ul> 
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>