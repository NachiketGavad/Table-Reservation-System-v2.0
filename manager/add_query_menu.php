<?php
require_once '../database/conn.php';
$hotel_id = $_SESSION['hotel_id'];
if (isset($_POST['add_menu'])) {
    $menu_name = $_POST['menu_name'];
    $price = $_POST['price'];
    $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
    $photo_name = addslashes($_FILES['photo']['name']);
    $photo_size = getimagesize($_FILES['photo']['tmp_name']);

    $photo_tmp_name = $_FILES['photo']['tmp_name'];
    $photo_new_name = $_FILES['photo']['name'];

    $photo_new_name_ext = pathinfo($photo_new_name, PATHINFO_EXTENSION);
    if ($photo_new_name_ext == "jpg" or $photo_new_name_ext == "jpeg" or $photo_new_name_ext == "png") {
        $photo_new_name = pathinfo($photo_new_name, PATHINFO_FILENAME);
        $photo_new_name = $photo_new_name . "_" . date('YmjHis') . "." . $photo_new_name_ext;

        move_uploaded_file($photo_tmp_name, "../photo/menu/" . $photo_new_name);
        $conn->query("INSERT INTO `menu` (menu_name, price, photo,hotel_id) VALUES('$menu_name', '$price', '$photo_new_name','$hotel_id')") or die(mysqli_error($conn));
        header("location:menu.php");
    } else {
?>
        <script src="../js/sweetalert.min.js"></script>
        <script>
            swal("File format not supported", "Only jpg, jpeg, png format supported", "error");
        </script>
<?php
    }
}
