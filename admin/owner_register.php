<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Registration</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/header.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <form method="post">
        <div class="icon">
            <img src="../icons/user.png" alt="">
        </div>
        <div class="login-container">
            <div class="main">
                <h1>Register Owner</h1>
                <p class="login-item">Please fill in this form to create an account.</p>
                <hr class="login-item">
                <label for="Username">Username</label><br>
                <input type="text" placeholder="Enter Username" name="username" class="login-item" required><br>
                <label>Details</label>
                <div class="login-item">
                    <input type="text" placeholder="owner name" name="owner_name" required="required" />
                </div>
                <div class="login-item">
                    <input type="text" placeholder="Hotel Name" name="hotel_name" required="required" />
                </div>
                <div class="login-item">
                    <input type="tel" placeholder="Contact No." name="contactno" required="required" pattern="[0-9]\{10}" />
                </div>
                <div class="login-item">
                    <label for="psw">Password</label><br>
                    <input type="password" placeholder="Enter Password" name="password" class="login-item" required>
                </div>
                <div class="login-item"></div>
                <label for="pswrepeat">Confirm Password</label><br>
                <input type="password" placeholder="Confirm Password" name="cpassword" class="login-item" required>
            </div>
            <div class="login-item">
                <button type="submit" class="center">Sign Up</button>
                <button type="reset" class="center">Reset</button>
            </div>
            <p class="center"> Already have an account? <a href="owner_login.php">Login here</a>.</p>

        </div>

</body>

</html>
<!-- here is one  -->

<?php

$showAlert = false;
$showError = false;
$exists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Include file which makes the 
    // Database Connection. 
    include "../database/conn.php";

    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $fname = $_POST["owner_name"];
    $contact = $_POST["contactno"];
    $hotel_name = $_POST['hotel_name'];

    $sql = "Select * from owner_tmp where username='$username'";

    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

    // This sql query is use to check if 
    // the username is already present  
    // or not in our Database 
    if ($num == 0) {
        if (($password == $cpassword) && $exists == false) {

            $sql = "INSERT INTO `owner_tmp` ( `username`,  
                `owner_name`,`contactno`,`hotel_name`,`password`,`approved`) VALUES ('$username',  
                '$fname','$contact','$hotel_name','$password','no')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                $showAlert = true;
            }
        } else {
            $showError = "Passwords do not match";
        }
    } // end if  

    if ($num > 0) {
        $exists = "Username not available";
    }
} //end if    

?>
<!-- here is second  -->
<script src="js/sweetalert.min.js"></script>
<?php


if ($showAlert) {
?>
    <script type="text/javascript">
       swal("Registration Successful");
        location.href = 'owner_login.php';
    </script>
<?php
    // header("location:login.php");
    // echo ' 
    // <strong>Success!</strong> Your account is  
    // now created and you can login.  
    // ';
}
if ($showError) {

?>
    <script type="text/javascript">
        swal("Error", "<?php echo $showError ?> ", "error");
    </script>
<?php
}

if ($exists) {
?>
    <script type="text/javascript">
        swal("Exists", "<?php echo $exists ?>", "error");
    </script>
<?php
}

?>