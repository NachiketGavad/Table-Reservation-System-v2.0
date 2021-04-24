<?php

include "../database/conn.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $conn->query("SELECT * FROM `admin` WHERE `username` = '$username' && `password` = '$password' ") or die(mysqli_error(die));
    $fetch = $query->fetch_array();
    $row = $query->num_rows;

    if ($row > 0) {
        session_start();
        $_SESSION['admin_id'] = $fetch['admin_id'];
        header("location:home.php");
    } else {
?>
        <script src="../js/sweetalert.min.js"></script>
        <script>
            swal("Error", "Invalid username or password", "error");
        </script><?php
                }
            }
                    ?>