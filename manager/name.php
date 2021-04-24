<?php
	require '../database/conn.php';
	$query = $conn->query("SELECT * FROM `manager` WHERE `manager_id` = '$_SESSION[manager_id]'") or die(mysqli_error($conn));
	$fetch = $query->fetch_array();
	$name = $fetch['username'];
	$owner_id = $fetch['owner_id'];
	
	$query1 = $conn->query("SELECT * FROM `hotel` where owner_id='$owner_id'") or die(mysqli_error($conn));
	$fetch1 = $query1->fetch_array();
	$_SESSION['hotel_id'] = $fetch1['hotel_id'];
?>