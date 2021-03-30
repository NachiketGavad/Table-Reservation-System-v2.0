<?php
    // Create connection
    $server = "localhost";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($server, $username, $password,"tabresnew");
    // Check connection
    if ($conn->connect_error)  {
        die("Connection failed: " . $conn->connect_error);
    } 
?>