<?php
require_once '../database/conn.php';
$conn->query("UPDATE `transaction` SET `status` = 'canceled by hotel owner' WHERE `transaction_id` =  '$_REQUEST[transaction_id]'") or die(mysqli_error($conn));
header("location:transaction.php");
