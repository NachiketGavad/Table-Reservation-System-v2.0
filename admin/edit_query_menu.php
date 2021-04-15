<?php
require_once '../database/conn.php';
$hotel_id = $_SESSION['hotel_id'];
if (isset($_POST['edit_menu'])) {
    $menu_name = $_POST['menu_name'];
    $price = $_POST['price'];
    $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
    $photo_name = addslashes($_FILES['photo']['name']);
    $photo_size = getimagesize($_FILES['photo']['tmp_name']);

    
    $photo_tmp_name = $_FILES['photo']['tmp_name'];
    $photo_new_name = $_FILES['photo']['name'];

    $photo_new_name_ext = pathinfo($photo_new_name, PATHINFO_EXTENSION);
    $photo_new_name = pathinfo($photo_new_name, PATHINFO_FILENAME);
    $photo_new_name = $photo_new_name."_".date('YmjHis').".".$photo_new_name_ext  ;

    move_uploaded_file($_FILES['photo']['tmp_name'], "../photo/menu/" . $_FILES['photo']['name']);
    $conn->query("UPDATE `menu` SET `menu_name` = '$menu_name', `price` = '$price', `photo` = '$photo_new_name',`hotel_id` = '$hotel_id' WHERE `menu_id` = '$_REQUEST[menu_id]'") or die(mysqli_error($conn));
    header("location:menu.php");
}
