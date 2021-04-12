<!DOCTYPE html>
<?php
require_once 'validate.php';
require 'name.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Interface</title>
    <link rel="stylesheet" href="css/user.css">
</head>

<body>
    <nav class="navbar">
        <ul>
            <li><a href="user_home.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="index1.php">Menu</a></li>
        </ul>
    </nav>
    <section>
        <div class="heading">
            <h3>HOTEL LIST</h3>
        </div>
        <?php
        require_once 'database/conn.php';
        $query = $conn->query("SELECT * FROM `hotel` ORDER BY `hotel_id` ASC") or die(mysqli_error($conn));
        $query1 = $conn->query("SELECT * FROM `customer`") or die(mysqli_error($conn));
        $fetch1 = $query1->fetch_array();
        while ($fetch = $query->fetch_array()) {
        ?>
            <div class="well" style="height:300px; width:100%;">
                <div style="float:left; border:2px solid black">
                    <img src="photo/<?php echo $fetch['photo'] ?>" height="200" width="280" />
                </div>
                <div style="float:left; margin-left:10px;">
                    <h3><?php echo $fetch['hotel_name'];
                        echo " (";
                        echo  $fetch['hotel_location'];
                        echo ")" ?></h3>
                    <br />
                    <a href="hotel_view.php?hotel_id=<?php echo $fetch['hotel_id'] ?>&customer_id=<?php echo $fetch1['customer_id'] ?>" class="view-btn"> View</a>
                </div>
            </div>
        <?php
        }
        ?>
    </section>
    <aside></aside>
</body>

</html>