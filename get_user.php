
<?php 
header('Content-Type: application/json');

include("dbconnection.php");
$con = dbconnection();

$id = $_GET["id"];

$query = "SELECT * FROM `user` WHERE id = '$id'";
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