<?php
require_once '../database/conn.php';
$owner_id = $_SESSION['owner_id'];
if (isset($_POST['add_hotel'])) {
    $hotel_name = $_POST['hotel_name'];
    $capacity = $_POST['capacity'];
    $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
    $photo_name = addslashes($_FILES['photo']['name']);
    $photo_size = getimagesize($_FILES['photo']['tmp_name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], "../photo/" . $_FILES['photo']['name']);
    $hotel_location = $_POST['hotel_location'];
    $conn->query("INSERT INTO `hotel` (hotel_name, capacity, photo,hotel_location,owner_id) VALUES('$hotel_name', '$capacity', '$photo_name','$hotel_location','$owner_id')") or die(mysqli_error($conn));
    header("location:hotel.php");
}
