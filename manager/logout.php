<?php
	session_start();
	session_unset();
	header("location:manager_login.php");
?>