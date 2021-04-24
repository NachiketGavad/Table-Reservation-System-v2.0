<?php 
	session_start();
	if(!ISSET($_SESSION['admin_id'])){
		header("location:admin_login.php");
	}