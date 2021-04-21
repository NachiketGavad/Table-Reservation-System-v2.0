<script src="js/sweetalert.min.js"></script>

<?php
require_once 'database/conn.php';
include 'validate.php';
include 'name.php';
include 'database/table_book.php';

if (isset($_POST['check_avail'])) {
    check_avail($conn);
}

?>
<?php

if (isset($_POST['add_guest'])) {
    $hotel_id = $_GET['hotel_id'];
    $customer_id = $_GET['customer_id'];
    // echo $customer_id;
    // echo $hotel_id;
    $checkin = $_POST['date'];
    $time_slot = $_POST['time_slot'];
    // $no_of_people = $_POST['no_of_people'];
    // $table_req = $no_of_people / 4;
    // $table_req = (int)$table_req;
    $table_req = 0;
    // $table_req_rem = $no_of_people % 4;
    // echo $table_req . " ";
    // echo $table_req_rem;
    // if ($table_req_rem == 0) {
    //     $table_req =  $table_req;
    // } else {
    //     $table_req =  $table_req + 1;
    // }
    // echo $table_req . " "; //no of tables required
    // echo $time_slot;
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
        // echo $checkin;
        // echo $hotel_id;
        $query1 = $conn->query("SELECT * FROM `hotel` WHERE `hotel_id` = '$hotel_id' ") or die(mysqli_error(die));
        $fetch1 = $query1->fetch_array();
        $capacity = $fetch1['capacity'];
        // echo $customer_id;
        $query5 = $conn->query("SELECT * FROM `transaction` WHERE `date` = '$checkin ' && `time_slot` = '$time_slot' && `hotel_id` = '$hotel_id' && `status` = 'Reserved' && `customer_id` = '$customer_id'") or die(mysqli_error($conn));
        // while ($fetch5 = $query5->fetch_array()) {
        //     echo 1;
        // }
        $valid = $query5->num_rows;
        // echo $valid;
        if ($valid >= 5) { ?>
            <script>
                alert("You have already 5 Entries in hotel");
               // console.log('1');
            </script>
            <?php
        } else
        if ($checkin == $todaydate) {
            $dt = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
            $d = $dt->format('H:i:s');
            // $d = '11:00:00';
            // echo " this is doller d " . $d;

            // $d =  date("h:i:sa");
            if ($time_slot == 'breakfast') {
                $t = '10:00:00';
                // echo " this is user entered date " . $checkin;
                // echo " this is for comparing with user entered date " . $todaydate;
                // echo " this is doller t " . $t;
                if ($t < $d) { ?>
                    <script>
                        swal("Error : Time over", "You can't book for breakfast for today after 10am", "error");
                        console.log('1');
                    </script>
                <?php
                } else {
                    table_book($conn, $checkin, $time_slot, $hotel_id, $customer_id, $table_req, $capacity, $status);
                }
            } elseif ($time_slot == 'lunch') {
                $t = '15:00:00';
                if ($t < $d) { ?>
                    <script>
                        swal("Error : Time over", "You can't book for lunch for today after 3pm", "error");
                    </script>
                <?php
                } else {
                    table_book($conn, $checkin, $time_slot, $hotel_id, $customer_id, $table_req, $capacity, $status);
                }
            } elseif ($time_slot == 'dinner') {
                $t = '22:00:00';
                if ($t < $d) { ?>
                    <script>
                        swal("Error : Time over", "You can't book for dinner for today after 10pm", "error");
                    </script>
<?php
                } else {
                    table_book($conn, $checkin, $time_slot, $hotel_id, $customer_id, $table_req, $capacity, $status);
                }
            }
        } else {
            table_book($conn, $checkin, $time_slot, $hotel_id, $customer_id, $table_req, $capacity, $status);
        }
    }
}

?>