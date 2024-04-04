<?php 
header('Content-Type: application/json');
include("dbconnection.php");
$conn = dbconnection();

$product_id = $_POST['product_id'];
$past_stock = $_POST['past_stock'];
$num_of_delete = $_POST['num_of_delete'];
$sum = $past_stock - $num_of_delete;
$sql = "UPDATE `product` SET `product_stock`='$sum' WHERE product_id = $product_id";
if ($conn->query($sql) === TRUE) {
    // สร้าง JSON response สำหรับการสมัครสมาชิกสำเร็จ
    $response = array("status" => "success", "message" => "ทำรายการสำเร็จ");
    echo json_encode($response);
} else {
    // สร้าง JSON response สำหรับการสมัครสมาชิกล้มเหลว
    $response = array("status" => "error", "message" => "ล้มเหลวโปรดลองอีกรอบ Error: " . $sql . "<br>" . $conn->error);
    echo json_encode($response);
}

$sql = "DELETE FROM livebasket";
$conn->query($sql);

?>