<?php

// get data from request
$vehicle_id = $_POST['vehicle_id'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$price = $_POST['price'];

include_once "connection.php";

// get session variables
session_start();
$farmer_id = $_SESSION['farmer_id'];

// check farmer already has an active order
$orderRequest = mysqli_query($conn, 
        "SELECT order_id 
        FROM `order`
        WHERE farmer_id = '$farmer_id' 
        AND status = 'In Cart'");
$matched_order = mysqli_num_rows($orderRequest);
$order_id;

if ($matched_order == 0) {
    // there is no order, create a order
    $insertOrder = mysqli_query($conn, 
            "INSERT INTO `order` (`farmer_id`, `status`) 
            VALUES ('$farmer_id', 'In Cart')");
    if ($insertOrder) {
        // get order_id
        $order_id = $conn->insert_id;
    } else {
        echo "Failed";
    }
} else {
    $orderRow=mysqli_fetch_row($orderRequest);
    $order_id = $orderRow[0];
}

// insert line item
$insertLineItem = mysqli_query($conn, 
            "INSERT INTO line_item (order_id, vehicle_id, start_date, end_date, price) 
            VALUES ('$order_id', '$vehicle_id', '$start_date', '$end_date', '$price')");
if ($insertLineItem) {
    echo "Success";
} else {
    echo "Failed";
}

?>