<?php 
header('Content-Type: application/json');

include("dbconnection.php");
$conn = dbconnection();

$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_stock = $_POST['product_stock'];
$product_price = $_POST['product_price'];
$past_stock = $_POST['past_stock'];

$sql = "INSERT INTO `livebasket`(`product_id`, `product_name`, `product_stock`, `product_price`, `past_stock`) VALUES ('$product_id','$product_name','$product_stock','$product_price','$past_stock')";

if ($conn->query($sql) === TRUE) {
    // สร้าง JSON response สำหรับการสมัครสมาชิกสำเร็จ
    $response = array("status" => "success", "message" => "เพิ่มลงตระกร้าเรียบร้อย");
    echo json_encode($response);
} else {
    // สร้าง JSON response สำหรับการสมัครสมาชิกล้มเหลว
    $response = array("status" => "error", "message" => "ล้มเหลวโปรดลองอีกรอบ Error: " . $sql . "<br>" . $conn->error);
    echo json_encode($response);
}



?>