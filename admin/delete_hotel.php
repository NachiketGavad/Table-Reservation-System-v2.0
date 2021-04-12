<?php
	require_once '../database/conn.php';
	$conn->query("DELETE FROM `hotel` WHERE `hotel_id` = '$_REQUEST[hotel_id]'") or die(mysqli_error($conn));
	header("location:hotel.php");
