<?php 
header('Content-Type: application/json');

include("dbconnection.php");
$con = dbconnection();

if(isset($_GET["iddelete"])){
    $idd = $_GET["iddelete"];
    $sql = "DELETE FROM `product` WHERE product_id = $idd";
    mysqli_query($con, $sql);
}

if(isset($_GET["idsearch"])){
    $ids = $_GET["idsearch"];
    $query = "SELECT `product_id`, `product_name`, `product_stock`, `product_price`, `product_detail` FROM `product` WHERE product_id = $ids";

}else{
    $query = "SELECT `product_id`, `product_name`, `product_stock`, `product_price`, `product_detail` FROM `product` ";

}

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