<?php

include "../database/conn.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $conn->query("SELECT * FROM `owner` WHERE `username` = '$username' && `password` = '$password' ") or die(mysqli_error(die));
    $fetch = $query->fetch_array();
    $row = $query->num_rows;

    if ($row > 0) {
        session_start();
        $_SESSION['id'] = $fetch['owner_id'];

        header("location:#");
    } else {
?>
        <script>
            alert("Invalid username or password");
        </script><?php
                }
            }
                    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Login Page</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <form method="POST">
        <div class="icon">
            <img src="../icons/user.png" alt="">
        </div>
        <div class="login-container">
            <div class="main">
                <h1>Manager Login</h1>
                <p class="login-item">Please fill the details to Login.</p>
                <hr class="login-item">
                <label for="Username"><b>User Name</b></label><br>
                <input type="text" placeholder="Enter Username" name="username" required class="login-item">

                <div class="login-item">
                    <label for="psw"><b>Password</b></label><br>
                    <input type="password" placeholder="Enter Password" name="password" required class="login-item">
                </div>
                <div class="login-item">
                    <button type="submit" name="login" class="center">Login</button>
                    <button type="reset" class="center">Reset</button>
                </div>
            </div>
        </div>
    </form>
    <?php require_once "manager_login_query.php"; ?>
</body>
</html>