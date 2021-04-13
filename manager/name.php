<?php
	require '../database/conn.php';
	$query = $conn->query("SELECT * FROM `manager` WHERE `manager_id` = '$_SESSION[manager_id]'") or die(mysqli_error($conn));
	$fetch = $query->fetch_array();
	$name = $fetch['manager_name'];
?>