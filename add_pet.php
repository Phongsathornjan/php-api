<?php 
header('Content-Type: application/json');

include("dbconnection.php");
$con = dbconnection();

if($_POST['pet_name']  != '' && $_POST['ownername']  != '' && $_POST['species']  != '' && $_POST['breed']  != '' && $_POST['birthdate']  != '' && $_POST['weight']  != ''){
    $pet_name = $_POST['pet_name'];
    $ownername = $_POST['ownername'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $birthdate = $_POST['birthdate'];
    $weight = $_POST['weight'];



$sql = "INSERT INTO `pets`(`pet_name`, `species`, `breed`, `owner_name`, `birthdate`, `weight`) VALUES ('$pet_name','$species','$breed','$ownername','$birthdate','$weight')";

if ($con->query($sql) === TRUE) {
    // สร้าง JSON response สำหรับการสมัครสมาชิกสำเร็จ
    $response = array("status" => "success", "message" => "ลงทะเบียนสำเร็จ");
    echo json_encode($response);
}else {
    // สร้าง JSON response สำหรับการสมัครสมาชิกล้มเหลว
    $response = array("status" => "error", "message" => "ล้มเหลวโปรดลองอีกรอบ Error: " . $sql . "<br>" . $con->error);
    echo json_encode($response);
}


}else {
    // สร้าง JSON response สำหรับการสมัครสมาชิกล้มเหลว
    $response = array("status" => "invalid", "message" => "กรุณากรอกข้อมูลให้ครบ");
    echo json_encode($response);
}
?>

