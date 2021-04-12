<?php
require_once '../database/conn.php';
if (isset($_POST['edit_hotel'])) {
	$hotel_name = $_POST['hotel_name'];
	$capacity = $_POST['capacity'];
	$photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
	$photo_name = addslashes($_FILES['photo']['name']);
	$photo_size = getimagesize($_FILES['photo']['tmp_name']);
	move_uploaded_file($_FILES['photo']['tmp_name'], "../photo/" . $_FILES['photo']['name']);
	$hotel_location = $_POST['hotel_location'];
	$conn->query("UPDATE `hotel` SET `hotel_name` = '$hotel_name', `capacity` = '$capacity','hotel_location'='$hotel_location', `photo` = '$photo_name' WHERE `hotel_id` = '$_REQUEST[hotel_id]'") or die(mysqli_error($conn));
	header("location:hotel.php");
}
