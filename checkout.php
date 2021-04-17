<?php
session_start();
$hotel_id = $_SESSION['hotel_id'];
$todaydate = date('Y-m-d');
$query3 = $conn->query("UPDATE `transaction` SET `status` = 'checkout' WHERE `transaction`.`status` = 'checkin' && `transaction`.`date` < '$todaydate' ");
