<?php 
header('Content-Type: application/json');

include("dbconnection.php");
$conn = dbconnection();

$product_id = $_POST['product_id'];
$product_stock = $_POST['product_stock'];

$sql = "UPDATE `product` SET `product_stock`= $product_stock WHERE product_id = $product_id";

if ($conn->query($sql) === TRUE) {
    // สร้าง JSON response สำหรับการสมัครสมาชิกสำเร็จ
    $response = array("status" => "success", "message" => "อัพเดทสำเร็จ");
    echo json_encode($response);
} else {
    // สร้าง JSON response สำหรับการสมัครสมาชิกล้มเหลว
    $response = array("status" => "error", "message" => "ล้มเหลวโปรดลองอีกรอบ Error: " . $sql . "<br>" . $conn->error);
    echo json_encode($response);
}



?>