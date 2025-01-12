<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
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
</body>
</html>
