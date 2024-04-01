<?php
// Include database connection
include_once "connection.php";

// Check if the form is submitted for item removal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['lineId'])) {
    // Sanitize the input
    $lineId = mysqli_real_escape_string($conn, $_POST['lineId']);

    // Delete the item from the cart
    $deleteQuery = "DELETE FROM line_item WHERE line_id = '$lineId'";
    mysqli_query($conn, $deleteQuery);
    header("Location: cart_test.php");
    exit();
}
?>
