<?php
require_once '../database/conn.php';
$hotel_id = $_SESSION['hotel_id'];
if (isset($_POST['edit_menu'])) {
    $menu_name = $_POST['menu_name'];
    $price = $_POST['price'];
    $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
    $photo_name = addslashes($_FILES['photo']['name']);
    $photo_size = getimagesize($_FILES['photo']['tmp_name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], "../photo/menu/" . $_FILES['photo']['name']);
    $conn->query("UPDATE `menu` SET `menu_name` = '$menu_name', `price` = '$price', `photo` = '$photo_name',`hotel_id` = '$hotel_id' WHERE `menu_id` = '$_REQUEST[menu_id]'") or die(mysqli_error($conn));
    header("location:menu.php");
}
