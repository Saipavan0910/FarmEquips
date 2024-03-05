<?php

$conn = new mysqli("localhost", "root", "", "new_farmflow");

if($conn->error){
    echo "Database Not Working!";
}

?>