<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <title>View Menu</title>
    <style>
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Menu</h2>
        <hr>
        <div class="row mt-4">
            <?php include "database/conn.php";
            $hotel_id = $_GET['hotel_id'];
            $customer_id = $_GET['customer_id'];
            $sql = "SELECT  * FROM `menu` where `hotel_id` = $hotel_id ";
            $result = $conn->query($sql);
            $data = mysqli_query($conn, $sql);
            $total = mysqli_num_rows($data);
            if ($total != 0) {
                while ($result = mysqli_fetch_assoc($data)) {
            ?>
                    <div class="col-md-3 my-2">
                        <div class="card" style="width: 15rem;">
                            <div class="card-body border border-primary">
                                <img src="photo/menu/<?php echo  $result['photo']; ?>" class="card-img-top" alt="..." height="120" width="100">
                                <h5 class="card-title">Item Name : <?php echo  $result['menu_name'];  ?></h5>
                                <h5 class="card-text">Price : <?php echo $result['price'];  ?></h5>
                            </div>
                        </div>
                    </div>
            <?php }
            } else {
                echo "<center>Hotel Owner/Managers has not set the menu</center>";
            }
            ?>
        </div>
    </div>
    <div class="wrapper text-center mt-4">
        <a href="hotel_view.php?hotel_id=<?php echo $hotel_id ?>&customer_id=<?php echo $customer_id ?>" class="btn-warning text-center border py-1 px-2" style="text-decoration: none;"> close</a>
        <!-- Optional JavaScript; choose one of the two! -->
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
</body>

</html>