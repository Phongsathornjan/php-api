<?php 
header('Content-Type: application/json');

include("dbconnection.php");
$con = dbconnection();

$query = "SELECT `product_id`, `product_name`, `product_stock`, `product_price`, `past_stock` FROM `livebasket` ";
$exe = mysqli_query($con,$query);

$arr = [];
while($row=mysqli_fetch_array($exe))
{
    $arr[]=$row;
}

$json = json_encode($arr);
// Output the JSON
echo $json;

?>