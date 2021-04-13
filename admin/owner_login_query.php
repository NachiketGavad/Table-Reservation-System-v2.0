<?php

include "../database/conn.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $conn->query("SELECT * FROM `owner` WHERE `username` = '$username' && `password` = '$password' ") or die(mysqli_error(die));
    $fetch = $query->fetch_array();
    $row = $query->num_rows;

    if ($row > 0) {
        session_start();
        $_SESSION['owner_id'] = $fetch['owner_id'];
        $_SESSION['hotel_id'] = $fetch['hotel_id'];

        header("location:home.php");
    } else {
?>
        <script>
            alert("Invalid username or password");
        </script><?php
                }
            }
                    ?>