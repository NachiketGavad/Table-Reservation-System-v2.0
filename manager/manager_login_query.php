<?php
	require_once "../database/conn.php";
	if(ISSET ($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$query = $conn->query("SELECT * FROM `manager` WHERE `username` = '$username' && `password` = '$password'") or die(mysqli_error($conn));
		$fetch = $query->fetch_array();
		$row = $query->num_rows;
		
		if($row > 0){
			session_start();
			$_SESSION['manager_id'] = $fetch['manager_id'];
			header('location:home.php');
		}else{
			// echo "<center><label style = 'color:red;'>Invalid username or password</label></center>";
		}
	}
?>