<?php
// PHP array

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i>รายงานสรุปขยะติดเชื้อ
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Main</a></li>
      <li><a href="<?= base_url('Contract') ?>"> รายงานสรุปขยะติดเชื้อ</a></li>
    </ol>
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
                    label: 'สรุปรายงาน',
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
                    label: 'Sales', // ชื่อของ dataset
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
