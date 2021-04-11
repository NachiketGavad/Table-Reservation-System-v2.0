<?php
	session_start();
	session_unset('owner_id');
	header("location:owner_login.php");
?>