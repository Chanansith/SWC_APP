<?php
include "connection.php";
function getFactor(){
    $sql = "SELECT * FROM lca_factor";

    // ใช้ prepare และ execute เพื่อดำเนินการคำสั่ง SQL
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // ดึงผลลัพธ์เป็น array
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json'); // ตั้งค่า Content-Type เป็น JSON
    echo json_encode($results, JSON_PRETTY_PRINT); // แปลง array เป็น JSON และจัดรูปแบบให้สวยงาม
}


if ($_GET['act']=="factor"){
    getFactor();
}

?>