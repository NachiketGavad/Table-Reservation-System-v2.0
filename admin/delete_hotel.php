<?php
require_once '../database/conn.php';
$conn->query("DELETE FROM `hotel` WHERE `hotel_id` = '$_REQUEST[hotel_id]'") or die(mysqli_error($conn));
$conn->query("DELETE FROM `menu` WHERE `hotel_id` = '$_REQUEST[hotel_id]'") or die(mysqli_error($conn));

//for hotel_id reset
$conn->query("set @autoid :=0");
$conn->query("update hotel set hotel_id = @autoid := (@autoid+1)");
$conn->query("alter table hotel Auto_Increment = 1");

//for menu_id reset
$conn->query("set @autoid :=0");
$conn->query("update menu set menu_id = @autoid := (@autoid+1)");
$conn->query("alter table menu Auto_Increment = 1");
header("location:hotel.php");
