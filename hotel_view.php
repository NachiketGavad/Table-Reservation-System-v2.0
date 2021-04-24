    <?php include "database/conn.php";
    // include 'validate.php';
    // include 'name.php';
    $hotel_id = $_GET['hotel_id'];
    $_SESSION['hotel_id'] = $hotel_id;
    $sql = "SELECT  * FROM `hotel` WHERE hotel_id ='" . $hotel_id . "' ";
    $result = $conn->query($sql);
    $data = mysqli_query($conn, $sql);
    $customer_id = $_GET['customer_id'];
    $sql1 = "SELECT  * FROM `customer` WHERE customer_id ='" . $customer_id . "' ";
    $total = mysqli_num_rows($data);
    if ($total != 0) {
        while ($result = mysqli_fetch_assoc($data)) { ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Hotel View</title>

                <link rel="stylesheet" href="css/hotelView.css">
                <style>
                    body::before {
                        content: "";
                        background: url('photo/<?php echo  $result['photo'];  ?>') no-repeat center center/cover;
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100vw;
                        height: 100vh;
                        z-index: -1;
                    }
                </style>
            </head>

            <body>
                <header>
                    <?php
                    // $max = 4 * $result['capacity'];
                    // echo $max;
                    echo " " . $result['hotel_name'] . "";
                    echo " (";
                    echo  $result['hotel_location'];
                    $capacity = $result['capacity'];
                    echo ")" ?>
                </header>
        <?php }
    } else {
        echo "0 results";
    }
        ?>
        <div class="cap">
            Hotel Total Capacity = <?php echo $capacity, "Tables" ?>
            <form method="post">
                <div class="form-component">
                    <label for="date">Enter Date : </label>
                    <input type="date" name="date" id="datetimecheck">
                </div>

                <div class="form-component">
                    <label for="time_slot">Enter Time Slot : </label>
                    <select name="time_slot" id="time_slot">
                        <option value="breakfast">Breakfast</option>
                        <option value="lunch">Lunch</option>
                        <option value="dinner">Dinner</option>
                    </select>
                </div>
                <!-- <div class="form-component">
                    <label for="no_of_people">Enter No. of People : </label>
                    <input type="number" min="1" max="<?php echo $max ?>" value="1" name="no_of_people">
                </div> -->
                <div class="button">
                    <button name="check_avail" class="view-btn-check">check</button>
                    <button name="add_guest" class="view-btn"> Submit</button>
                    <!-- <a href="add_query_reserve.php?hotel_id=<?php echo $hotel_id ?>&customer_id=<?php echo $customer_id ?>" class="view-btn" name="add_guest"> submit</a> -->
                    <a href="view_menu.php?hotel_id=<?php echo $hotel_id ?>&customer_id=<?php echo $customer_id ?>" class="view-btn-menu">Menu</a>
                </div>
                <a href="user_home.php?customer_id=<?php echo $customer_id ?>" class="view-btn-close"> close</a>
            </form>
            <?php include 'add_query_reserve.php' ?>
        </div>
            </body>
            <script src="js/sweetalert.min.js"></script>

            </html>