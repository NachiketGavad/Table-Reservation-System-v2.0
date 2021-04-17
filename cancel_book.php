<?php
require_once 'database/conn.php';
$conn->query("UPDATE `transaction` SET `status` = 'canceled by user' WHERE `transaction_id` =  '$_REQUEST[transaction_id]'") or die(mysqli_error($conn));
header("location:transaction.php");
?>