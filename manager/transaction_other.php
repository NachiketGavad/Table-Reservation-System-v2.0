<!DOCTYPE html>
<?php
require_once 'validate.php';
require 'name.php';
$hotel_id = $_SESSION['hotel_id'];
?>
<html lang="en">

<head>
    <title>Hotel Online Reservation</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css " />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <style>
th{
    text-align: center;
}
    </style>
</head>

<body>
    <nav style="background-color:rgba(0, 0, 0, 0.1);" class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand">Hotel Online Reservation</a>
            </div>
            <ul class="nav navbar-nav pull-right ">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <?php echo $name; ?></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <ul class="nav nav-pills">
            <li><a href="home.php">Home</a></li>
            <li><a href="hotel.php">Hotel</a></li>
            <li class="active"><a href="transaction.php">Transaction</a></li>
        </ul>
    </div>
    <br />
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="alert alert-info">Transaction / 
                <a href="transaction.php" class="btn btn-success">Live</a>
                <a href="transaction_other.php"class="btn btn-warning">Other</a>
                </div>
                <table id="table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Hotel Name</th>
                            <th>Photo</th>
                            <th>Date</th>
                            <th>Time Slot</th>
                            <th>Table No.</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = $conn->query("SELECT * FROM `transaction` where hotel_id='$hotel_id' && status != 'Reserved' order by date") or die(mysqli_error($conn));
                        while ($fetch = $query->fetch_array()) {
                            $customer_id = $fetch['customer_id'];
                            $query2 = $conn->query("SELECT * FROM `hotel` where hotel_id='$hotel_id'") or die(mysqli_error($conn));
                            $fetch2 = $query2->fetch_array();
                            $query1 = $conn->query("SELECT * FROM `customer` where customer_id='$customer_id'") or die(mysqli_error($conn));
                            while ($fetch1 = $query1->fetch_array()) {
                        ?>
                                <tr class="text-center">
                                    <td><?php echo $fetch1['customer_name'] ?></td>
                                    <td><?php echo $fetch2['hotel_name']; ?></td>
                                    <td>
                                        <img src="../photo/<?php echo $fetch2['photo']; ?>" height="80px" width="100px" alt="not loaded" />
                                    </td>
                                    <td><?php echo $fetch['date']; ?></td>
                                    <td><?php echo $fetch['time_slot']; ?></td>
                                    <td><?php echo $fetch['table_no']; ?></td>
                                    <td><?php echo $fetch['status']; ?> </td>
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
    <br />
    <br />
    <div style="text-align:right; margin-right:10px;" class="navbar navbar-default navbar-fixed-bottom">
        <label>&copy; Mini Project 1B </label>
    </div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
    function confirmationDelete(anchor) {
        var conf = confirm("Are you sure you want to delete this record?");
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