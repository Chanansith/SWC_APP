<?php
session_start();

// ตรวจสอบว่ามีข้อมูลส่งมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tableData'])) {
    $tableData = $_POST['tableData'];

    // เก็บข้อมูลลงใน session
    $_SESSION['tableData'] = $tableData;


    
    // ส่งคำตอบกลับไปยัง AJAX
   echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
}
?>