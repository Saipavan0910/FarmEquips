<?php

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
    echo "Regsitration Successful";
    
    $result = mysqli_query($conn, "SELECT * FROM pan_details where pancardnum = '$pan'");

    if($result){
        $row = mysqli_fetch_assoc($result);
        $income = $row['income'];
        $subsidy = $income*0.01;     // draft

        if($user_type == "owner") {
            mysqli_query($conn, "INSERT INTO owner(user_id) VALUES (LAST_INSERT_ID())");
        } else {
            mysqli_query($conn, "INSERT INTO farmer(user_id, income, subsidy) VALUES (LAST_INSERT_ID(), '$income', '$subsidy')");
        }        
    }

    header("location: Farming_website.html");
}
else {
    echo "Registration Unsuccessful. Please Try Again!!";
}
?>