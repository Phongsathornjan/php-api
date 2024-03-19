<?php

header('Content-Type: application/json');
if($_POST['username']  != '' && $_POST['password']  != '' && $_POST['firstname']  != '' && $_POST['lastname']  != '' && $_POST['phone']  != '' && $_POST['role']  != '' ){
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
$role = $_POST['role'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "SELECT * FROM user WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $response = array("status" => "already", "message" => "มีบัญชีผู้ใช้นี้อยู่แล้ว");
    echo json_encode($response);
    
} else {
   
$sql = "INSERT INTO user (username, password, firstname, lastname, phone , role) VALUES ('$username', '$hashed_password', '$firstname', '$lastname' , '$phone' , '$role')";

if ($conn->query($sql) === TRUE) {
    // สร้าง JSON response สำหรับการสมัครสมาชิกสำเร็จ
    $response = array("status" => "success", "message" => "สมัครสมาชิกสำเร็จ");
    echo json_encode($response);
} else {
    // สร้าง JSON response สำหรับการสมัครสมาชิกล้มเหลว
    $response = array("status" => "error", "message" => "ล้มเหลวโปรดลองอีกรอบ Error: " . $sql . "<br>" . $con->error);
    echo json_encode($response);
}
}


// ปิดการเชื่อมต่อ
$conn->close();
}else {
    $response = array("status" => "fill_in_blank", "message" => "กรุณากรอกข้อมูลให้ครบ");
    echo json_encode($response);
}
?>
