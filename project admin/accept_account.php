<?php
include '../database/conn.php';
// $name = $_POST['owner_name'];
// $username = $_POST['username'];
// $password = $_POST['password'];
$owner_tmp_id = $_GET['owner_tmp_id'];
$query = $conn->query("SELECT * FROM `owner_tmp` WHERE `owner_tmp_id` = '$owner_tmp_id'") or die(mysqli_error("$conn"));
$fetch = $query->fetch_array();

$username = $fetch['username'];
$password = $fetch['password'];
$fname = $fetch["owner_name"];
$contact = $fetch["contactno"];
$hotel_name = $fetch['hotel_name'];

$sql = "Select * from owner where username='$username'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);

// This sql query is use to check if 
// the username is already present  
// or not in our Database 
if ($num == 0) {
	$sql1 = "INSERT INTO `owner` ( `username`,  
	`owner_name`,`password`) VALUES ('$username',  
	'$fname','$password')";

	$result = mysqli_query($conn, $sql1);

	$query1 = $conn->query(("UPDATE `owner_tmp` SET `approved`= 'yes' WHERE `owner_tmp_id` = '$owner_tmp_id'"));
} else {
?>
	<script type="text/javascript">
		swal("Exists", "Username not available", "error");
	</script>
<?php
}
header("location:home.php");
?>