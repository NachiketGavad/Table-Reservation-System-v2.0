
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
<?php include 'header.php'; ?>
    <form method="POST">
        <div class="icon">
            <img src="icons/user.png" alt="">
        </div>
        <div class="login-container">
            <div class="main">
                <h1>Login</h1>
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

            <p class="center">Don't have an account? <a href="customer_signup.php">Sign up now</a>.</p>
        </div>
    </form>
    <?php require_once "customer_login_query.php"; ?>
</body>

</html>