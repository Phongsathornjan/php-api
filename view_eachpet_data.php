<?php 
header('Content-Type: application/json');

include("dbconnection.php");
$con = dbconnection();

if(isset($_GET["idpet"])){
$id_pet = $_GET['idpet'];

$sql = "SELECT * FROM `pets` WHERE pet_id = '$id_pet'";

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