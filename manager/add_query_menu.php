<?php
require_once '../database/conn.php';
$hotel_id = $_SESSION['hotel_id'];
if (isset($_POST['add_menu'])) {
    $menu_name = $_POST['menu_name'];
    $price = $_POST['price'];
    $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
    $photo_name = addslashes($_FILES['photo']['name']);
    $photo_size = getimagesize($_FILES['photo']['tmp_name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], "../photo/menu" . $_FILES['photo']['name']);
    $conn->query("INSERT INTO `menu` (menu_name, price, photo,hotel_id) VALUES('$menu_name', '$price', '$photo_name','$hotel_id')") or die(mysqli_error($conn));
    header("location:menu.php");
}
