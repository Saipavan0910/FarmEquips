<?php

include_once "connection.php";

session_start();
$owner_id = $_SESSION['owner_id'];
$vehicleId = $_GET['vehicle_id'];

$status = mysqli_query($conn, "DELETE FROM vehicle WHERE vehicle_id = $vehicleId");

if($status){
    echo '<script>';
    echo 'alert("Equipment Deleted Successfully.");';
    echo 'window.location.href = "ownerprofile.php";';
    echo '</script>';
}

?>