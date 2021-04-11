<?php 
	session_start();
	if(!ISSET($_SESSION['owner_id'])){
		header("location:owner_login.php");
	}