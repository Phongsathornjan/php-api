
<?php 
header('Content-Type: application/json');

if($_POST['product_name']  != '' && $_POST['product_stock']  != '' && $_POST['product_price']  != ''){
include("dbconnection.php");
$conn = dbconnection();

$product_name = $_POST['product_name'];
$product_stock = $_POST['product_stock'];
$product_price = $_POST['product_price'];
$product_detail = $_POST['product_detail'];

$sql = "INSERT INTO `product`(`product_name`, `product_stock`, `product_price`, `product_detail`) VALUES ('$product_name','$product_stock','$product_price','$product_detail')";

if ($conn->query($sql) === TRUE) {
    // สร้าง JSON response สำหรับการสมัครสมาชิกสำเร็จ
    $response = array("status" => "success", "message" => "เพิ่มสินค้าสำเร็จ");
    echo json_encode($response);
} else {
    // สร้าง JSON response สำหรับการสมัครสมาชิกล้มเหลว
    $response = array("status" => "error", "message" => "ล้มเหลวโปรดลองอีกรอบ Error: " . $sql . "<br>" . $conn->error);
    echo json_encode($response);
}

}else{
    $response = array("status" => "fill_in_blank", "message" => "กรุณากรอกข้อมูลให้ครบ");
    echo json_encode($response);
}

?>