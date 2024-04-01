<?php

$conn = new mysqli("localhost", "root", "", "new_farmflow");

if($conn->error){
    echo "Database Not Working!";
}

$status = mysqli_query($conn, "SELECT * FROM vehicle");

while ($row = mysqli_fetch_assoc($status)){
    $vehicle = $row['vehicle_id'];
    $date = $row['enddate'];
    
    $currentTimestamp = strtotime(date("Y-m-d"));
    $databaseTimestamp = strtotime($date);

    if($currentTimestamp > $databaseTimestamp){
        $execute = mysqli_query($conn, "DELETE FROM vehicle where vehicle_id = $vehicle");
    }
}

?>