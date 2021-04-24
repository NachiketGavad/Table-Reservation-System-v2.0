<?php
include "../database/conn.php";
$conn->query("UPDATE `owner_tmp` SET `approved`= 'declined' WHERE `owner_tmp_id` = '$_REQUEST[owner_id]'") or die(mysqli_error(""));
header("location: home.php");

//owner_tmp reset
$conn->query("set @autoid :=0");
$conn->query("update owner_tmp set owner_tmp_id = @autoid := (@autoid+1)");
$conn->query("alter table owner_tmp Auto_Increment = 1");
header("location:home.php");
