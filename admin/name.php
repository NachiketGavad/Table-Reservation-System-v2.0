<?php
	require '../database/conn.php';
	$query = $conn->query("SELECT * FROM `owner` WHERE `owner_id` = '$_SESSION[owner_id]'") or die(mysqli_error($conn));
	$fetch = $query->fetch_array();
	$name = $fetch['owner_name'];
?>