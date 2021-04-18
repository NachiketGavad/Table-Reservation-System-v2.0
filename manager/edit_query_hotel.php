<?php
require_once '../database/conn.php';
if (isset($_POST['edit_hotel'])) {
	$capacity = $_POST['capacity'];
	// $conn->query("UPDATE `hotel` SET  `capacity` = '$capacity' WHERE `hotel_id` = '$_REQUEST[hotel_id]'") or die(mysqli_error($conn));
	header("location:hotel.php");
}
