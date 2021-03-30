<?php
    include "../database/conn.php";
	 $conn->query("DELETE FROM `manager` WHERE `manager_id` = '$_REQUEST[manager_id]'") or die(mysqli_error(""));
	 header("location: account.php");
?>