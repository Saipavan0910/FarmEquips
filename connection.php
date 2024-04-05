<?php

$conn = new mysqli("localhost", "root", "", "new_farmflow");

if($conn->error){
    echo "Database Not Working!";
}

$timestampFile = 'last_run.txt';
$lastRun = @file_get_contents($timestampFile);
$currentTime = time();

if (!$lastRun || ($currentTime - $lastRun) > 60) {
    $currentTime = time();
    $sql = "UPDATE `order` o
        INNER JOIN line_item l ON o.order_id = l.order_id
        SET o.status = 'Done'
        WHERE o.status = 'Placed' AND l.end_date < CURDATE()";

    if ($conn->query($sql) === TRUE) {

    } else {
        
    }
    file_put_contents($timestampFile, $currentTime);
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