<?php 
$max_per_day=0;
$imw_status_daily=0;
$pending_count=0;
$approved_count=0;
$receive_count=0;
if (!empty($monitoring_record)) {
 $max_per_day=$monitoring_record[0]->max_per_day;
 $imw_status_daily=$monitoring_record[0]->imw_status_daily;

}
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Disposal dashboard
      <small>Control Panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> หน้ากลัก </a></li>
      <li class="active">แผงควบคุม</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $imw_status_daily ?> kg</h3>

              <p>IMW Status Daily</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('disposal/contract/') ?>" class="small-box-footer"> เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            <h3><?php echo $max_per_day ?> kg</h3>

              <p>Max Per Day</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url('disposal/contract') ?>" class="small-box-footer"> เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $pending_count; ?></h3>

              <p>Pending</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-people"></i>
            </div>
            <a href="<?php echo base_url('contract/') ?>" class="small-box-footer"> เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $approved_count ?></h3>

              <p>Approved</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-home"></i>
            </div>
            <a href="<?php echo base_url('contract/') ?>" class="small-box-footer"> เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> 
   
</div>
  
<iframe src="https://1drv.ms/x/c/f9f8ee280c08a614/EWquEOarz4FBg_4Aze2jHS8BpEbsJJwkkAtw6ZfxnZX3FA?e=jThOcS"
            frameborder="0" 
            marginheight="0" 
            marginwidth="0" 
            width="100%" 
            height="100%" 
            scrolling="auto">
  </iframe>

</section>
  <!-- /.content -->
</div>