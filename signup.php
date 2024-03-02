<?php

$firstname = $_POST['firstName'];
$lastname = $_POST['lastName'];
$username = $_POST['usernameSignUp'];
$password = $_POST['passwordSignUp'];
$user_type = $_POST['userTypeSignUp'];
$phone = $_POST['phone'];
$location = $_POST['location'];
$aadhar = $_POST['aadharNumber'];
$pan = $_POST['panNumber'];

include_once "connection.php";

$status = mysqli_query($conn, "insert into user_details (username, password, user_type, aadhar_card, pan_card, location, phone_number) values ('$username', '$password', '$user_type', '$aadhar', '$pan', '$location', '$phone')");

if($status){

    if($user_type == "owner") {
        mysqli_query($conn, "INSERT INTO owner(user_id) VALUES (LAST_INSERT_ID())");
    } else {
        mysqli_query($conn, "INSERT INTO farmer(user_id) VALUES (LAST_INSERT_ID())");
    }
    
    echo "Regsitration Successful";
    header("location: Farming_website.html");
}
else {
    echo "Registration Unsuccessful. Please Try Again!!";
}
?>