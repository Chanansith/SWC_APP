<?php

function getFactor(){
    include "connection.php";
    $sql = "SELECT * FROM lca_factor";

    // ใช้ prepare และ execute เพื่อดำเนินการคำสั่ง SQL
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // ดึงผลลัพธ์เป็น array
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}




?>