<?php 
header('Content-Type: application/json');

include("dbconnection.php");
$con = dbconnection();

if(isset($_GET["name"])){
$name = $_GET['name'];

$sql = "SELECT * FROM `bookings` WHERE id_booker = '$name' ORDER BY booking_datetime DESC";

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