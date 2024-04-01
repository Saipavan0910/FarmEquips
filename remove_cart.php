<?php

include_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['lineId'])) {

    $lineId = mysqli_real_escape_string($conn, $_POST['lineId']);

    $deleteQuery = "DELETE FROM line_item WHERE line_id = '$lineId'";
    mysqli_query($conn, $deleteQuery);
    header("Location: cart_test.php");
    exit();
}
?>
