<?php

header('Content-Type: application/json');
if($_POST['username']  != '' && $_POST['password']  != '' && $_POST['firstname']  != '' && $_POST['lastname']  != '' && $_POST['phone']  != '' ){
include("dbconnection.php");
$conn = dbconnection();

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับค่าจากการส่งข้อมูลแบบ POST
$username = $_POST['username'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// เตรียมคำสั่ง SQL เพื่อเพิ่มข้อมูลใหม่
$sql = "INSERT INTO user (username, password, firstname, lastname, phone , role) VALUES ('$username', '$hashed_password', '$firstname', '$lastname' , '$phone' , 'member')";

if ($conn->query($sql) === TRUE) {
    // สร้าง JSON response สำหรับการสมัครสมาชิกสำเร็จ
    $response = array("status" => "success", "message" => "สมัครสมาชิกสำเร็จ");
    echo json_encode($response);
} else {
    // สร้าง JSON response สำหรับการสมัครสมาชิกล้มเหลว
    $response = array("status" => "error", "message" => "ล้มเหลวโปรดลองอีกรอบ Error: " . $sql . "<br>" . $conn->error);
    echo json_encode($response);
}

// ปิดการเชื่อมต่อ
$conn->close();
}else {
    $response = array("status" => "notfound", "message" => "กรุณากรอกข้อมูลให้ครบ");
    echo json_encode($response);
}
?>
