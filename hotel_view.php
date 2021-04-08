<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel View</title>
    <link rel="stylesheet" href="css/hotelView.css">
</head>

<body>
    <?php include "database/conn.php";
    $hotel_id = $_GET['hotel_id'];
    $sql = "SELECT  * FROM `hotel` WHERE hotel_id ='" . $hotel_id . "' ";
    $result = $conn->query($sql);
    $data = mysqli_query($conn, $sql);
    $total = mysqli_num_rows($data);
    if ($total != 0) {
        while ($result = mysqli_fetch_assoc($data)) {
    echo " " . $result['hotel_name'] . "";
  } }
  else {
        echo "0 results";
    }
    ?>
</body>

</html>