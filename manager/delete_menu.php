<?php
require_once '../database/conn.php';
$conn->query("DELETE FROM `menu` WHERE `menu_id` = '$_REQUEST[menu_id]'") or die(mysqli_error($conn));

//for menu_id reset
$conn->query("set @autoid :=0");
$conn->query("update menu set menu_id = @autoid := (@autoid+1)");
$conn->query("alter table menu Auto_Increment = 1");
header("location:menu.php");
