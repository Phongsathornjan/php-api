<?php 
header('Content-Type: application/json');

include("dbconnection.php");
$con = dbconnection();

if(isset($_GET["iddelete"])){
    $idd = $_GET["iddelete"];
    $sql = "DELETE FROM `user` WHERE id = $idd";
    mysqli_query($con, $sql);
}

$query = "SELECT * FROM `user` WHERE 1";
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