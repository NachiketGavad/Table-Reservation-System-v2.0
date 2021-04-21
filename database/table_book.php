<?php
function table_book($conn, $checkin, $time_slot, $hotel_id, $customer_id, $table_req, $capacity, $status)
{
    $table_no = 1;
    $query = $conn->query("SELECT * FROM `transaction` WHERE `date` = '$checkin ' && `time_slot` = '$time_slot' && `hotel_id` = '$hotel_id' && `status` = 'Reserved' ORDER BY table_no asc") or die(mysqli_error($conn));
    while ($fetch = $query->fetch_array()) {
        if ($table_no == $fetch['table_no']) {
            $table_no++;
        }
    }
    $row = $query->num_rows;
    // echo $row;
    // echo $capacity . " ";
    $newcapacity = $capacity - $row;
    // echo $newcapacity;
    // echo $row . " ";
    if ($newcapacity == 0) { ?>
        <script>
            swal("Error", "All Tables are sold, please try another time", "error");
        </script>
        <?php
    } else {
        $query2 = $conn->query("INSERT INTO `transaction` (`customer_id`, `hotel_id`, `table_no`, `status`, `date`,`time_slot`) VALUES ('$customer_id','$hotel_id','$table_no','$status','$checkin','$time_slot')") or die(mysqli_error($conn));
        if ($query2) { ?>
            <script>
                swal("Table is reserved", "Please reach the hotel on reserved date <?php echo $checkin;  ?> and time slot <?php echo $time_slot;  ?>, Table no is <?php echo $table_no;  ?> . \nTo Cancel Reservation go to Transaction tab.", "success");
            </script>
        <?php }
    }
}

function check_avail($conn)
{
    $hotel_id = $_GET['hotel_id'];
    $customer_id = $_SESSION['customer_id'];
    // echo $customer_id;
    // echo $hotel_id;
    $checkin = $_POST['date'];
    $time_slot = $_POST['time_slot'];
    // $no_of_people = $_POST['no_of_people'];
    // $table_req = $no_of_people / 4;
    // $table_req = (int)$table_req;
    // $table_req_rem = $no_of_people % 4;
    // // echo $table_req . " ";
    // // echo $table_req_rem;
    // if ($table_req_rem == 0) {
    //     $table_req =  $table_req;
    // } else {
    //     $table_req =  $table_req + 1;
    // }
    // echo $table_req . " "; //no of tables required
    // echo $no_of_people;
    // echo $checkin . " ";
    $todaydate = date('Y-m-d');
    $query3 = $conn->query("UPDATE `transaction` SET `status` = 'checkout' WHERE `transaction`.`status` = 'Reserved' && `transaction`.`date` < '$todaydate' ");
    $table_no = 1;
    $status = 'Reserved';
    if ($checkin < date("Y-m-d", strtotime('+1 HOURS'))) { ?>
        <script>
            swal("Error", "Must be present date", "error");
        </script>
    <?php
    } else {
        $query = $conn->query("SELECT * FROM `transaction` WHERE `date` = '$checkin ' && `time_slot` ='$time_slot' && `hotel_id` = '$hotel_id' && `status` = 'Reserved' ORDER BY table_no asc") or die(mysqli_error($conn));
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
            swal("Availability", "Remaining Tables on date " +
                "'<?php echo $checkin ?>'" + " on time slot " + "'<?php echo $time_slot ?>'" + " in Hotel " +
                "'<?php echo $hotel_name ?>'" + " are " +
                "'<?php echo $newcapacity ?>'");
        </script>
        <?php
        if ($newcapacity == 0) { ?>
            <script>
                swal("Error", "No Table is empty, please try another time", "error");
            </script>
<?php
        }
        // elseif ($newcapacity < $table_req) { 
        // <!-- <script>
        //     swal("Error", "Required number of tables not present, please try another time", "error");
        // </script> -->

        // <!-- // } -->
    }
}
?>