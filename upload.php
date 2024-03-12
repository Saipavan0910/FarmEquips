<?php

$vehiclenumber = $_POST['vehicleNumber'];
$product_id = $_POST['vehicleType'];
$description = $_POST['description'];
$price = $_POST['price'];
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];

include_once "connection.php";

session_start();
$owner_id = $_SESSION['owner_id'];
$status = mysqli_query($conn, "insert into vehicle (owner_id, vehicle_num, product_id, description, price, startdate, enddate) values ('$owner_id', '$vehiclenumber', '$product_id', '$description', '$price', '$startdate', '$enddate')");

if($status){
    echo "Regsitration Successful";
}
else{
    echo "Registration Unsuccessful. Please Try Again!!";
}

?>