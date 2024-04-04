<?php 
header('Content-Type: application/json');

include("dbconnection.php");
$con = dbconnection();

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "DELETE FROM `livebasket` WHERE product_id = $id";
    mysqli_query($con, $sql);
}
?>