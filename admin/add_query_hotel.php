<?php
require_once '../database/conn.php';
$owner_id = $_SESSION['owner_id'];
if (isset($_POST['add_hotel'])) {
    $hotel_name = $_POST['hotel_name'];
    $capacity = $_POST['capacity'];
    $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
    $photo_name = addslashes($_FILES['photo']['name']);
    $photo_size = getimagesize($_FILES['photo']['tmp_name']);

    $photo_tmp_name = $_FILES['photo']['tmp_name'];
    $photo_new_name = $_FILES['photo']['name'];

    $photo_new_name_ext = pathinfo($photo_new_name, PATHINFO_EXTENSION);
    if ($photo_new_name_ext == "jpg" or $photo_new_name_ext == "jpeg" or $photo_new_name_ext == "png") {
        $photo_new_name = pathinfo($photo_new_name, PATHINFO_FILENAME);
        $photo_new_name = $photo_new_name . "_" . date('YmjHis') . "." . $photo_new_name_ext;

        move_uploaded_file($photo_tmp_name, "../photo/" . $photo_new_name);
        $hotel_location = $_POST['hotel_location'];
        $conn->query("INSERT INTO `hotel` (hotel_name, capacity, photo,hotel_location,owner_id) VALUES('$hotel_name', '$capacity', '$photo_new_name','$hotel_location','$owner_id')") or die(mysqli_error($conn));

        $sql = $conn->query("SELECT * FROM `hotel` WHERE `owner_id` = '$owner_id'") or die(mysqli_error($conn));
        $result = $sql->fetch_array();
        $hotel_id = $result['hotel_id'];
        // echo $hotel_id;
        $conn->query("UPDATE `owner` SET `hotel_id` = '$hotel_id' WHERE `owner`.`owner_id` = $owner_id") or die(mysqli_error($conn));
        header("location:hotel.php");
    } else {
?>
        <script src="../js/sweetalert.min.js"></script>
        <script>
            swal("File format not supported", "Only jpg, jpeg, png format supported", "error");
        </script>
<?php
    }
}
