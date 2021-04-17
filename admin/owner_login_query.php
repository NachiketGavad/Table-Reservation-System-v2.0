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
        $hotel_id = $_SESSION['hotel_id'];
        $todaydate = date('Y-m-d');
        $query3 = $conn->query("UPDATE `transaction` SET `status` = 'checkout' WHERE `transaction`.`status` = 'checkin' && `transaction`.`date` < '$todaydate' ");
        header("location:home.php");
    } else {
?>
        <script src="js/sweetalert.min.js"></script>
        <script>
            swal("Error", "Invalid username or password", "error");
        </script><?php
                }
            }
                    ?>