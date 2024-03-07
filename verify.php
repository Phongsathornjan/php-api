<?php 
header('Content-Type: application/json');

if($_POST['username']  != '' && $_POST['password']  != ''){
include("dbconnection.php");
$conn = dbconnection();

$username = $_POST['username'];
$password = $_POST['password'];

// เตรียมคำสั่ง SQL เพื่อค้นหา username ในฐานข้อมูล
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // พบ username ในฐานข้อมูล
    $row = $result->fetch_assoc();
    // ตรวจสอบว่ารหัสผ่านตรงกันหรือไม่
    if (password_verify($password, $row['password'])) {
        // รหัสผ่านตรงกัน
        // สร้าง JSON response โดยคืนค่า role
        $response = array("status" => "success", "role" => $row["role"]);
        echo json_encode($response);
    } else {
        // รหัสผ่านไม่ตรงกัน
        // สร้าง JSON response โดยคืนค่า 'ไม่พบบัญชีนี้'
        $response = array("status" => "no_match_pass", "message" => "รหัสผ่านผิด");
        echo json_encode($response);
    }
} else {
    // ไม่พบ username ในฐานข้อมูล
    // สร้าง JSON response โดยคืนค่า 'ไม่พบบัญชีนี้'
    $response = array("status" => "no_username", "message" => "ไม่พบบัญชีนี้");
    echo json_encode($response);
}

// ปิดการเชื่อมต่อ
$conn->close();
}else{
    $response = array("status" => "fill_in_blank", "message" => "กรุณากรอกข้อมูลให้ครบ");
    echo json_encode($response);
}
?>