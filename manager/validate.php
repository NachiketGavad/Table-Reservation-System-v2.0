<?php 
	session_start();
	if(!ISSET($_SESSION['manager_id'])){
		header("location:manager_login.php");
	}