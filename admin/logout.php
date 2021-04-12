<?php
	session_start();
	session_unset();
	header("location:owner_login.php");
?>