<?php

$vehiclenumber = $_POST['vehicleNumber'];
$model = $_POST['model'];
$description = $_POST['description'];
$price = $_POST['price'];
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];

include_once "connection.php";

session_start();
$owner_id = $_SESSION['owner_id'];
$vehicleId = $_GET['vehicle_id'];

$status = mysqli_query($conn, "UPDATE vehicle SET vehicle_num = '$vehiclenumber', model = '$model', description = '$description', price = '$price', startdate = '$startdate', enddate = '$enddate' WHERE vehicle_id = $vehicleId");

if($status){
    echo '<script>';
    echo 'alert("Equipment Updated Successfully!");';
    echo 'window.location.href = "ownerprofile.php";';
    echo '</script>';
}
else{
    echo '<script>';
    echo 'alert("Equipment Updation Failed");';
    echo 'window.location.href = "ownerprofile.php";';
    echo '</script>';
}

?>