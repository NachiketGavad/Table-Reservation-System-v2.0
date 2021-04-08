<!DOCTYPE html>
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
            <li><a href="#">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Menu</a></li>
        </ul>
    </nav>
    <section>
        <div class="heading">
            <h3>HOTEL LIST</h3>
        </div>
        <?php
        require_once 'database/conn.php';
        $query = $conn->query("SELECT * FROM `hotel` ORDER BY `hotel_id` ASC") or die(mysqli_error($conn));
        while ($fetch = $query->fetch_array()) {
        ?>
            <div class="well" style="height:300px; width:100%;">
                <div style="float:left; border:2px solid black">
                    <img src="photo/<?php echo $fetch['photo'] ?>" height="200" width="280" />
                </div>
                <div style="float:left; margin-left:10px;">
                    <h3><?php echo $fetch['hotel_name'] ;echo " ("; echo  $fetch['hotel_location']; echo")" ?></h3>
                    <br />
                    <a href="hotel_view.php?hotel_id=<?php echo $fetch['hotel_id'] ?>" class="view-btn"> View</a>
                </div>
            </div>
        <?php
        }
        ?>
    </section>
    <aside></aside>
</body>

</html>