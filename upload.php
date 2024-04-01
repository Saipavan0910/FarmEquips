<?php

$vehiclenumber = $_POST['vehicleNumber'];
$product_id = $_POST['vehicleType'];
$model = $_POST['model'];
$description = $_POST['description'];
$price = $_POST['price'];
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];

include_once "connection.php";

session_start();
$owner_id = $_SESSION['owner_id'];
$status = mysqli_query($conn, "insert into vehicle (owner_id, vehicle_num, product_id, model,  description, price, startdate, enddate) values ('$owner_id', '$vehiclenumber', '$product_id', '$model', '$description', '$price', '$startdate', '$enddate')");

if($status){
    echo '<script>';
    echo 'alert("Equipment Registered Successfully!");';
    echo 'window.location.href = "upload.html";';
    echo '</script>';
}
else{
    echo '<script>';
    echo 'alert("Equipment Registration Failed");';
    echo 'window.location.href = "upload.html";';
    echo '</script>';
}

?>