<?php
require_once '../database/conn.php';
if (isset($_POST['edit_hotel'])) {
	$hotel_id = $_SESSION['hotel_id'];
	// echo $hotel_id;
	$capacity = $_POST['capacity'];
	// $conn->query("UPDATE `hotel` SET  `capacity` = '$capacity' WHERE `hotel_id` = '$_REQUEST[hotel_id]'") or die(mysqli_error($conn));

	$query = $conn->query("SELECT * FROM `hotel` WHERE `hotel_id` = '$hotel_id'") or die(mysqli_error($conn));
	$fetch = $query->fetch_array();
	$old_capacity = $fetch['capacity'];
	// echo $old_capacity;

	$sql = $conn->query("SELECT * FROM `transaction` WHERE `hotel_id` = '$hotel_id' && `status` = 'Reserved' ")  or die(mysqli_error($conn));
	$num = $sql->num_rows;
	// echo $num;

	if ($num != 0) {
		if ($capacity >= $old_capacity) {
			$conn->query("UPDATE `hotel` SET  `capacity` = '$capacity'  WHERE `hotel_id` = '$hotel_id'") or die(mysqli_error($conn));
			header("location:hotel.php");
		} else { ?>
			<script src="../js/sweetalert.min.js"></script>
			<script>
				swal("Error", "You can't decrease hotel's table capacity while there are reservations in hotel", "error");
			</script>
<?php
		}
	} else if ($num == 0) {
		$conn->query("UPDATE `hotel` SET `capacity` = '$capacity'  WHERE `hotel_id` = '$hotel_id'") or die(mysqli_error($conn));
		header("location:hotel.php");
	}
}
