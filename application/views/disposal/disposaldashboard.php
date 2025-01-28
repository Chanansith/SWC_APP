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
  
<!-- <iframe src="https://onedrive.live.com/:x:/g/personal/F9F8EE280C08A614/EWquEOarz4FBg_4Aze2jHS8BpEbsJJwkkAtw6ZfxnZX3FA?resid=F9F8EE280C08A614!se610ae6acfab418183fe00cdeda31d2f&ithint=file%2Cxlsx&e=jThOcS&migratedtospo=true&redeem=aHR0cHM6Ly8xZHJ2Lm1zL3gvYy9mOWY4ZWUyODBjMDhhNjE0L0VXcXVFT2FyejRGQmdfNEF6ZTJqSFM4QnBFYnNKSndra0F0dzZaZnhuWlgzRkE_ZT1qVGhPY1M" 
          frameborder="0" 
          marginheight="0" 
          marginwidth="0" 
          scrolling="auto" 
          allowfullscreen>
  </iframe> -->

</section>

<section class="content">
 
 <div class="row">
   <div class="col-xs-12 text-right">
     <div class="form-group">
      
     </div>
   </div>
 </div>
 <div class="row">
   <div class="col-xs-12">
     <div class="box">
       <div class="box-header">
         <h3 class="box-title">รายงานสรุปขยะติดเชื้อ</h3>
         <div class="box-tools">
       
         </div>
       </div><!-- /.box-header -->
       <div class="box-body table-responsive no-padding">
       <canvas id="myChart" width="400" height="200"></canvas>
       <br>
       กราฟแท่ง
       <canvas id="myBarChart" width="400" height="200"></canvas>
    
       </div><!-- /.box-body -->
      
     </div><!-- /.box -->
   </div>
 </div>
</section>
  <!-- /.content -->
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   
<script type="text/javascript">
    var datas = <?php echo json_encode($summary_dis1); ?>;
    var x_label = <?php echo json_encode($x_label); ?>;
   var ctx = document.getElementById('myChart').getContext('2d');
        
        var myChart = new Chart(ctx, {
            type: 'line', // เลือกประเภทกราฟเป็น 'line'
            data: {
                labels: x_label, // ใส่ชื่อของแกน X
                datasets: [{
                    label: 'ปริมาณขยะติดเชื้อ',
                    data: datas, // ข้อมูลในกราฟ (ค่า Y)
                    fill: false, // กราฟไม่เติมสีด้านล่าง
                    borderColor: 'rgb(75, 192, 192)', // สีของเส้น
                    tension: 0.1 // ความโค้งของเส้น
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top', // ตำแหน่งของป้ายชื่อ
                    },
                    tooltip: {
                        enabled: true // เปิดใช้งาน Tooltip
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true // แสดงแกน Y เริ่มจาก 0
                    }
                }
            }
        });

        var ctx_bar = document.getElementById('myBarChart').getContext('2d');
        var myBarChart = new Chart(ctx_bar, {
            type: 'bar', // ประเภทกราฟที่ต้องการ
            data: {
                labels: x_label, // Label ของแกน X
                datasets: [{
                    label: 'ปริมาณขยะติดเชื้อ', // ชื่อของ dataset
                    data:datas, // ข้อมูลที่จะแสดงบนแกน Y
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // สีพื้นหลังของแท่ง
                    borderColor: 'rgba(54, 162, 235, 1)', // สีขอบของแท่ง
                    borderWidth: 1 // ความหนาของขอบ
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // กำหนดให้แกน Y เริ่มต้นจาก 0
                    }
                }
            }
        });
</script>

<script>




    </script>
