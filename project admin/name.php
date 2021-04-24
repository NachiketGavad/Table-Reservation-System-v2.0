<?php
	require '../database/conn.php';
	$query = $conn->query("SELECT * FROM `admin` WHERE `admin_id` = '$_SESSION[admin_id]'") or die(mysqli_error($conn));
	$fetch = $query->fetch_array();
	$name = $fetch['name'];
?>