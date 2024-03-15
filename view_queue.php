
<?php 
header('Content-Type: application/json');

include("dbconnection.php");
$con = dbconnection();

  

    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $id_booker = $_POST['id_booker'];

    if($_POST['admininsert'] != ''){
        for ($i = 10; $i <= 16; $i++) {
            $sql = "INSERT INTO `bookings`(`booking_datetime`, `queue_status`) VALUES ('$year-$month-$day $i:00:00','available')";
            mysqli_query($con,$sql);
          }
        
    }

    if($_POST['booktime'] != ''){
        $booktime = $_POST['booktime'];
        if($_POST['cancel'] == 'cancel'){
            $sql = "UPDATE bookings SET bookings.queue_status ='available', bookings.id_booker = '' WHERE bookings.booking_datetime = '$year-$month-$day $booktime'";
            }else{
                $sql = "UPDATE bookings SET bookings.queue_status ='booked', bookings.id_booker = '$id_booker' WHERE bookings.booking_datetime = '$year-$month-$day $booktime'";
            }
        mysqli_query($con,$sql);
        }

    $sql = "SELECT bookings.booking_datetime, bookings.queue_status, bookings.id_booker FROM bookings WHERE bookings.booking_datetime 
    BETWEEN '$year-$month-$day 10:00:00' AND '$year-$month-$day 18:00:00' ORDER BY bookings.booking_datetime ";

$exe = mysqli_query($con,$sql);

$arr = [];
while($row=mysqli_fetch_array($exe))
{
    $arr[]=$row;
}

$json = json_encode($arr);
// Output the JSON
echo $json;


?>