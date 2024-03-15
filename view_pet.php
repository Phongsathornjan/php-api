<?php 
header('Content-Type: application/json');

include("dbconnection.php");
$con = dbconnection();

if(isset($_GET["owner_name"])){
$owner_name = $_GET['owner_name'];

$sql = "SELECT `pet_id`, `pet_name`, `species`, `breed`, `owner_name`, `weight` FROM `pets` WHERE owner_name = '$owner_name'";

$exe = mysqli_query($con,$sql);

$arr = [];
while($row=mysqli_fetch_array($exe))
{
    $arr[]=$row;
}

$json = json_encode($arr);
// Output the JSON
echo $json;
}
?>