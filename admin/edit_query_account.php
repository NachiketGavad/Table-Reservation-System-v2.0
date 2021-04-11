<?php
	require_once '../database/conn.php';
	if(ISSET($_POST['edit_account'])){
		$name = $_POST['name'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$conn->query("UPDATE `manager` SET `manager_name` = '$name', `username` = '$username', `password` = '$password' WHERE `manager_id` = '$_REQUEST[manager_id]'") or die(mysqli_error($conn));
		header("location:account.php");
	}	