<script src="js/sweetalert.min.js"></script>

<?php
require_once 'database/conn.php';
include 'validate.php';
include 'name.php';

if (isset($_POST['check_avail'])) {

    $hotel_id = $_SESSION['hotel_id'];
    $customer_id = $_SESSION['customer_id'];
    $checkin = $_POST['date'];
    // echo $checkin . " ";
    $todaydate = date('Y-m-d');
    $query3 = $conn->query("UPDATE `transaction` SET `status` = 'checkout' WHERE `transaction`.`status` = 'checkin' && `transaction`.`date` < '$todaydate' ");
    $table_no = 1;
    $status = 'checkin';
    if ($checkin < date("Y-m-d", strtotime('+1 HOURS'))) { ?>
        <script>
            swal("Error","Must be present date", "error");
        </script>
    <?php
    } else {
        $query = $conn->query("SELECT * FROM `transaction` WHERE `date` = '$checkin ' && `hotel_id` = '$hotel_id' && `status` = 'checkin' ORDER BY table_no asc") or die(mysqli_error($conn));
        while ($fetch = $query->fetch_array()) {
            if ($table_no == $fetch['table_no']) {
                $table_no++;
            }
        }
        $row = $query->num_rows;
        $query1 = $conn->query("SELECT * FROM `hotel` WHERE `hotel_id` = '$hotel_id' ") or die(mysqli_error(die));
        $fetch1 = $query1->fetch_array();
        $capacity = $fetch1['capacity'];
        $newcapacity = $capacity - $row;
        $hotel_name = $fetch1['hotel_name'];
        // echo "Remaining Tables on \n date " . $checkin . " in Hotel " . $fetch1['hotel_name'] . " are " . $newcapacity; 
    ?>
        <script>
            swal('Availability', 'Remaining Tables on date ' +
                    '<?php echo $checkin ?>' + ' in Hotel ' +
                    '<?php echo $hotel_name ?>' + ' are ' +
                    '<?php echo $newcapacity ?>');
        </script>
        <?php
        if ($newcapacity == 0) { ?>
            <script>
                swal("Error", "No Table is empty, please try another time", "error");
            </script>
<?php
        }
    }
}

?>
<?php

if (isset($_POST['add_guest'])) {
    $hotel_id = $_GET['hotel_id'];
    $customer_id = $_GET['customer_id'];
    $checkin = $_POST['date'];
    // echo $checkin . " ";
    $todaydate = date('Y-m-d');
    $query3 = $conn->query("UPDATE `transaction` SET `status` = 'checkout' WHERE `transaction`.`status` = 'checkin' && `transaction`.`date` < '$todaydate' ");
    $table_no = 1;
    $status = 'Reserved';
    if ($checkin < date("Y-m-d", strtotime('+1 HOURS'))) { ?>
        <script>
            swal("Error", "Must be present date", "error");
        </script>
        <?php
    } else {
        $query = $conn->query("SELECT * FROM `transaction` WHERE `date` = '$checkin ' && `hotel_id` = '$hotel_id' && `status` = 'checkin' ORDER BY table_no asc") or die(mysqli_error($conn));
        while ($fetch = $query->fetch_array()) {
            if ($table_no == $fetch['table_no']) {
                $table_no++;
            }
        }
        $row = $query->num_rows;
        $query1 = $conn->query("SELECT * FROM `hotel` WHERE `hotel_id` = '$hotel_id' ") or die(mysqli_error(die));
        $fetch1 = $query1->fetch_array();
        // echo $row . " ";
        $capacity = $fetch1['capacity'];
        // echo $capacity . " ";
        $newcapacity = $capacity - $row;
        // echo $newcapacity;
        if ($newcapacity == 0) { ?>
            <script>
                swal("Error", "All Tables are sold, please try another time", "error");
            </script>
            <?php
        } else {
            $query2 = $conn->query("INSERT INTO `transaction` (`customer_id`, `hotel_id`, `table_no`, `status`, `date`) VALUES ('$customer_id','$hotel_id','$table_no','$status','$checkin')") or die(mysqli_error($conn));
            if ($query2) { ?>
                <script>
                    swal("", "Table is reserved, Please reach the hotel on reserved date , Table no is <?php echo $table_no;  ?> . To Cancel Reservation go to Transaction tab", "success");
                </script>
            <?php } else {
            ?>
                <script>
                    swal("Error", "There is some Technical error in System", "error");
                </script>
<?php }
        }
    }
}

?>