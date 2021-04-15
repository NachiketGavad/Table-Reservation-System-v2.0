<?php
require_once 'database/conn.php';
if (isset($_POST['add_guest'])) {
    $hotel_id = $_GET['hotel_id'];
    $customer_id = $_GET['customer_id'];
    // echo $hotel_id;
    // echo $customer_id;
    $checkin = $_POST['date'];
    echo $checkin. " ";
    $table_no = 1;
    $status = 'checkin';
    if ($checkin < date("Y-m-d", strtotime('+1 HOURS'))) {
        echo 'Must be present date';
    } else {
        $query = $conn->query("SELECT * FROM `transaction` WHERE `date` = '$checkin ' && `hotel_id` = '$hotel_id' && `status` = 'checkin'") or die(mysqli_error($conn));
        while ($fetch = $query->fetch_array()) {
            echo $fetch['table_no'] . " ";
        }
        $row = $query->num_rows;
        $query1 = $conn->query("SELECT * FROM `hotel` WHERE `hotel_id` = '$hotel_id' ") or die(mysqli_error(die));
        $fetch1 = $query1->fetch_array();
        echo $row . " ";
        $capacity = $fetch1['capacity'];
        echo $capacity . " ";
        $capacity = $capacity - $row;
        echo $capacity;
        if ($capacity == 0) {
            echo "\n No Table is empty, please try another time";
        } else {
            $query2 = $conn->query("INSERT INTO `transaction` (`customer_id`, `hotel_id`, `table_no`, `status`, `date`) VALUES (`$customer_id`,`$hotel_id`,`$table_no`,`$status`,`$checkin`)") or die(mysqli_error($conn));
        }
    }
}
