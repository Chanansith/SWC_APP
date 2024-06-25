<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title><?php echo $pageTitle; ?></title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.4 -->
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- FontAwesome 4.3.0 -->
  <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/main.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons 2.0.0 -->
  <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->




  <style>
 body {
	font-family: "Open Sans", sans-serif;
	height: 100vh;
	background: url("assets/img/3.png") 50% fixed;
	background-size: cover;
  }
    .error {
      color: red;
      font-weight: normal;
    }
    .dropdown,.dropdown-toggle {
   
    }
    .main-header {
      width: 100%;
      background-color:#00A9FF;
      color: #066C72;

    }
    
  </style>
  
  <script type="text/javascript">
    var baseURL = "<?php echo base_url(); ?>";
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- DataTables -->

<!-- prettier-ignore -->
<script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
    ({key: "AIzaSyB6HBpHxcgpVgxAcaVso4vYU9l-_WML5EM", v: "weekly"});</script>
</head>
<!-- <body class="sidebar-mini skin-black-light"> -->

<body class="skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->

      <nav class="navbar navbar-static-top" role="navigation" style="margin-left: 0;">
        <!-- Sidebar toggle button-->
       
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
         

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 เกี่ยวกับ SWC
              </a>

            </li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 ผลิตภัณฑ์และบริการ
              </a>

            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle">
                 พันธมิตร/ลูกค้า
              </a>

            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle">
                 รายงานสรุปผลการบำบัด
              </a>

            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle"">
                 ติดต่อสอบถาม
              </a>

            </li>
            <li class="dropdown">
              <a href="index.php/login" class="dropdown-toggle" >
                 สมัครสมาชิก/เข้าสู่ระบบ
              </a>

            </li>
          </ul>
        </div>
      </nav>
    </header>


  