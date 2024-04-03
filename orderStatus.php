<?php

    include_once "connection.php";

    session_start();
    $farmer_id = $_SESSION['farmer_id'];
    $vehicleId = $_GET['vehicle_id'];
    $currentDate = date('Y-m-d H:i:s');

    $status = mysqli_query($conn, "UPDATE vehicle SET status = 'Rented' WHERE vehicle_id = $vehicleId");

    $status2 = mysqli_query($conn, "UPDATE `order` SET status = 'Placed' WHERE farmer_id = $farmer_id");

    $status3 = mysqli_query($conn, "UPDATE `order` SET transaction_date = '$currentDate' WHERE farmer_id = $farmer_id");

    if($status && $status2 && $status3){
        echo '<script>';
        echo 'alert("Order Placed Successfully");';
        echo 'window.location.href = "cart_test.php";';
        echo '</script>';
    }
    else {
        echo '<script>';
        echo 'alert("Order could not be placed!");';
        echo 'window.location.href = "cart_test.php";';
        echo '</script>';
    }
?>