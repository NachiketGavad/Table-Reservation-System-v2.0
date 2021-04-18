<?php
require_once '../database/conn.php';
$conn->query("UPDATE `transaction` SET `status` = 'canceled by manager' WHERE `transaction_id` =  '$_REQUEST[transaction_id]'") or die(mysqli_error($conn));
header("location:transaction.php");
?>