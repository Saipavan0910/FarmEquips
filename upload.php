<?php

$vehiclenumber = $_POST['vehicleNumber'];
$vehicle_type = $_POST['vehicleType'];
$description = $_POST['description'];
$price = $_POST['price'];

include_once "connection.php";

session_start();
$owner_id = $_SESSION['owner_id'];
$status = mysqli_query($conn, "insert into vehicle (owner_id, vehicle_num, vehicle_type, description, price) values ('$owner_id', '$vehiclenumber', '$vehicle_type', '$description', '$price')");

if($status){
    echo "Regsitration Successful";
}
else{
    echo "Registration Unsuccessful. Please Try Again!!";
}

?>