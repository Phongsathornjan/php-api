<?php 

function dbconnection()
{
    $con=mysqli_connect("localhost","root","","vet_database");
    return $con;
}

?>