<?php

$conn = new mysqli("localhost", "root", "", "farmflow");

if($conn->error){
    echo "Database Not Working!";
}
echo "Database Is Working!\n";

?>