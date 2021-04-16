<?php

include "database/conn.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $conn->query("SELECT * FROM `customer` WHERE `username` = '$username' && `password` = '$password' ") or die(mysqli_error(die));
    $fetch = $query->fetch_array();
    $row = $query->num_rows;

    if ($row > 0) {
        session_start();
        $_SESSION['customer_id'] = $fetch['customer_id'];

        header("location:user_home.php");
    } else {
?> <script>
            alert("Invalid username or password");
        </script><?php
                }
            }