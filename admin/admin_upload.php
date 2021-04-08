<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Upload</title>
    <link rel="stylesheet" href="..//css/adminUpload.css">
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
    <div class="upload-container">
        <form action="../upload.php" method="post" enctype="multipart/form-data">
            Select Image File to Upload:
            <input type="file" name="file">
            <input type="text" name="hotel_name">
            <input type="text" name="capacity">
            <input type="submit" name="submit" value="Upload">
        </form>
        <hr>
    </div>

    </div>

    <?php
    // Include the database configuration file
    include '../database/conn.php';
    ?>

</body>

</html>