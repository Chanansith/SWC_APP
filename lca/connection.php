<?php
$host = 'swc-center-db.mysql.database.azure.com'; // ชื่อโฮสต์ Azure MySQL
$dbname = 'swc_logictic'; // ชื่อฐานข้อมูล
$username = 'npltygockt'; // ชื่อผู้ใช้
$password = 'E2tNUajT$DwaAqJN'; // รหัสผ่าน
$ssl_ca = 'DigiCertGlobalRootCA.crt.pem'; // ตำแหน่งของไฟล์ใบรับรอง

try {
    // สร้าง DSN (Data Source Name)
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

    // ตัวเลือกสำหรับการเชื่อมต่อ
    $options = [
        PDO::MYSQL_ATTR_SSL_CA => $ssl_ca, // ระบุใบรับรอง SSL
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true, // เปิดใช้งานการตรวจสอบใบรับรอง
    ];

    // สร้างการเชื่อมต่อ PDO
    $conn = new PDO($dsn, $username, $password, $options);

    // ตั้งค่าโหมดการรายงานข้อผิดพลาด
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Connected successfully";

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>