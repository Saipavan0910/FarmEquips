<?php

include_once "connection.php";

$username = $_POST['username'];
$password = $_POST['password'];

$status = mysqli_query($conn, "select * from users where username = '$username' and password = '$password'");

$matched_user = mysqli_num_rows($status);

if($matched_user == 0){
    echo "Invalid Login";
} else{
    echo "Login Successfull!";
    header("location: Equip.html");
}

?>