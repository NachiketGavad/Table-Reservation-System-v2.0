<?php 
	session_start();
	if(!ISSET($_SESSION['customer_id'])){
		header("location:customer_login.php");
	}