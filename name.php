<?php
	require 'database/conn.php';
	$query = $conn->query("SELECT * FROM `customer` WHERE `customer_id` = '$_SESSION[customer_id]'") or die(mysqli_error($conn));
	$fetch = $query->fetch_array();
	$name = $fetch['customer_name'];
?>