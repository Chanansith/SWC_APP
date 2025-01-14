

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i>รายงานสรุปขยะติดเชื้อ
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Main</a></li>
      <li><a href="<?= base_url('Contract') ?>"> Transportation and travel times</a></li>
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
            <h3 class="box-title">Transportation and travel times</h3>
            <div class="box-tools">
          
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
          <canvas id="myChart" width="400" height="200"></canvas>
          <br>
        
          </div><!-- /.box-body -->
         
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   
<script type="text/javascript">
   var ctx = document.getElementById('myChart').getContext('2d');
        var datas=[65,59,80,81,56];
        var myChart = new Chart(ctx, {
            type: 'line', // เลือกประเภทกราฟเป็น 'line'
            data: {
                labels: ['January', 'February', 'March', 'April', 'May'], // ใส่ชื่อของแกน X
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
</script>

<script>




    </script>
