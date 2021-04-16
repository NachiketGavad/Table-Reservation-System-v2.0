<?php
// echo $hotel_id;
// echo $customer_id;
// echo $query." ";
// echo $fetch['table_no'] . " ";
require_once 'database/conn.php';
if (isset($_POST['add_guest'])) {
    $hotel_id = $_GET['hotel_id'];
    $customer_id = $_GET['customer_id'];
    $checkin = $_POST['date'];
    echo $checkin . " ";
    $table_no = 1;
    $status = 'checkin';
    if ($checkin < date("Y-m-d", strtotime('+1 HOURS'))) { ?>
        <script>
            alert('Must be present date');
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
        echo $row . " ";
        $capacity = $fetch1['capacity'];
        echo $capacity . " ";
        $newcapacity = $capacity - $row;
        echo $newcapacity;
        if ($newcapacity == 0) { ?>
            <script>
                alert('No Table is empty, please try another time');
            </script>
            <?php
        } else {
            $query2 = $conn->query("INSERT INTO `transaction` (`customer_id`, `hotel_id`, `table_no`, `status`, `date`) VALUES ('$customer_id','$hotel_id','$table_no','$status','$checkin')") or die(mysqli_error($conn));
            if ($query2) { ?>
                <script>
                    alert('Table is reserved, please reach the hotel on reserved date , Table no is <?php echo $table_no;  ?>');
                </script>
            <?php } else {
            ?>
                <script>
                    alert('There is some Technical error in System');
                </script>
<?php }
        }
    }
}


?>