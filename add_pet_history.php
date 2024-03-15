<?php 
header('Content-Type: application/json');

include("dbconnection.php");
$con = dbconnection();

if($_POST['idpet']  != '' && $_POST['symptom']  != '' && $_POST['treatment']  != '' ){
    $idpet = $_POST['idpet'];
    $symptom = $_POST['symptom'];
    $treatment = $_POST['treatment'];

$sql = "INSERT INTO `pethistory`(`symptom`, `treatment_history`, `date_of_treatment`, `pet_id`) VALUES ('$symptom','$treatment',NOW(),'$idpet')";

if ($con->query($sql) === TRUE) {
    // สร้าง JSON response สำหรับการสมัครสมาชิกสำเร็จ
    $response = array("status" => "success", "message" => "เพิ่มประวัติการรักษาสำเร็จ");
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

