<?php

include "../database/conn.php";

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = $conn->query("SELECT * FROM `manager` WHERE `username` = '$username' && `password` = '$password' ") or die(mysqli_error(die));
	$fetch = $query->fetch_array();
	$row = $query->num_rows;
	// $owner_id=$fetch['owner_id']
	// $query1 = $conn->query("SELECT * FROM `owner` WHERE `owner_id` = '$owner_id' ") or die(mysqli_error(die));

	if ($row > 0) {
		session_start();
		$_SESSION['manager_id'] = $fetch['manager_id'];
		$_SESSION['owner_id'] = $fetch['owner_id'];
		$owner_id =	$_SESSION['owner_id'];
		echo $owner_id;
		$query1 = $conn->query("SELECT * FROM `hotel` WHERE `owner_id` = '$owner_id'") or die(mysqli_error(die));
		$fetch1 = $query1->fetch_array();
		$hotel_id = $fetch1['hotel_id'];
		$todaydate = date('Y-m-d');
		$query3 = $conn->query("UPDATE `transaction` SET `status` = 'checkout' WHERE `transaction`.`status` = 'checkin' && `transaction`.`date` < '$todaydate' ");
		header("location:home.php");
	} else {
?>
		<script>
			alert("Invalid username or password");
		</script><?php
				}
			}
					?>