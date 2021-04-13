<?php
	require_once '../database/conn.php';
	$conn->query("DELETE FROM `menu` WHERE `menu_id` = '$_REQUEST[menu_id]'") or die(mysqli_error($conn));
	header("location:menu.php");
?>