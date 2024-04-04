<?php
$vehiclenumber = $_POST['vehicleNumber'];
$product_id = $_POST['vehicleType'];
$model = $_POST['model'];
$description = $_POST['description'];
$price = $_POST['price'];
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];

if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
$uploadDir = './images/uploads/'; 
$imageName = $_FILES['image']['name'];
$targetPath = $uploadDir . $imageName;

if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
include_once "connection.php";
session_start();
$owner_id = $_SESSION['owner_id'];

$status = mysqli_query($conn, "INSERT INTO vehicle (owner_id, vehicle_num, product_id, model, description, price, startdate, enddate, `image`)
VALUES ('$owner_id', '$vehiclenumber', '$product_id', '$model', '$description', '$price', '$startdate', '$enddate', '$targetPath')");

if ($status) {
    echo '<script>';
    echo 'alert("Equipment Registered Successfully!");';
    echo 'window.location.href = "upload.html";';
    echo '</script>';
} else {
echo '<script>';
echo 'alert("Equipment Registration Failed");';
echo 'window.location.href = "upload.html";';
echo '</script>';
}
} else {
echo '<script>';
echo 'alert("Failed to move uploaded file.");';
echo 'window.location.href = "upload.html";';
echo '</script>';
}
} else {
echo '<script>';
echo 'alert("Error uploading file.");';
echo 'window.location.href = "upload.html";';
echo '</script>';
}
?>