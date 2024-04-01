<?php

include_once "connection.php";

$username = $_POST['username'];
$password = $_POST['password'];

$status = mysqli_query($conn, "select user_type, user_id from user_details where username = '$username' and password = '$password'");

$matched_user = mysqli_num_rows($status);

if($matched_user == 0){
    echo '<script>';
    echo 'alert("Invalid Login Credentials!");';
    echo 'window.location.href = "Farming_website.html";';
    echo '</script>';
} else{
    $row=mysqli_fetch_row($status);
    echo  $row[0];

    session_start();
    $_SESSION['user_id'] = $row[1];
   
    if($row[0] == "owner") {
        $user_id = $_SESSION['user_id'];
        $owner_data = mysqli_query($conn, "select owner_id from owner where user_id = '$user_id'");
        $owner_row = mysqli_fetch_row($owner_data);
        $_SESSION['owner_id'] = $owner_row[0];
        header("location: upload.html");
    } else {
        $user_id = $_SESSION['user_id'];
        $farmer_data = mysqli_query($conn, "select farmer_id from farmer where user_id = '$user_id'");
        $farmer_row = mysqli_fetch_row($farmer_data);
        $_SESSION['farmer_id'] = $farmer_row[0];
        header("location: Equip.html");
    }
}

?>