<!DOCTYPE html>
<?php
include "database/conn.php";
require_once 'validate.php';
require 'name.php';
$customer_id = $_SESSION['customer_id'];
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer History</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/user.css">
    <style>
    </style>
</head>

<body>
    <?php
    include 'user_header.php';
    ?><div class="body">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="alert alert-info text-centre">Transaction / Live</div>
                    <?php
                    $sql = "Select * from customer where customer_id='$customer_id'";

                    $result = mysqli_query($conn, $sql);

                    $num = mysqli_num_rows($result);
                    ?>
                    <table id="table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Hotel Name</th>
                                <th>Photo</th>
                                <th>Date</th>
                                <th>Time slot</th>
                                <th>Table No.</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query1 = $conn->query("SELECT * FROM `customer` where customer_id='$customer_id'") or die(mysqli_error($conn));
                            $query = $conn->query("SELECT * FROM `transaction` where customer_id='$customer_id' && status = 'Reserved' order by date") or die(mysqli_error($conn));
                            $fetch1 = $query1->fetch_array();
                            while ($fetch = $query->fetch_array()) {
                                $hotel_id = $fetch['hotel_id'];
                                $query2 = $conn->query("SELECT * FROM `hotel` where hotel_id='$hotel_id'") or die(mysqli_error($conn));
                                while ($fetch2 = $query2->fetch_array()) {
                            ?>
                                    <tr>
                                        <td><?php echo $fetch1['customer_name'] ?></td>
                                        <td><?php echo $fetch2['hotel_name']; ?></td>
                                        <td>
                                            <img src="photo/<?php echo $fetch2['photo']; ?>" height="80px" width="100px" alt="not loaded" />
                                        </td>
                                        <td><?php echo $fetch['date']; ?></td>
                                        <td><?php echo $fetch['time_slot']; ?></td>
                                        <td><?php echo $fetch['table_no']; ?></td>
                                        <td><?php echo $fetch['status'];
                                            if ($fetch['status'] == 'Reserved') { ?>
                                                <a class="btn btn-danger ms-5" onclick="confirmationDelete(this); return false;" href="cancel_book.php?transaction_id=<?php echo $fetch['transaction_id'] ?>">Cancel</a>
                                            <?php
                                            } ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script src="js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
    function confirmationDelete(anchor) {
        var conf = confirm("Are you sure you want to Cancel the booking?");
        if (conf) {
            window.location = anchor.attr("href");
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#table").DataTable();
    });
</script>

</html>