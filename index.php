<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/main_page.css">
    <link rel="stylesheet" media="screen and (max-width: 1170px)" href="css/phone.css">
</head>

<body>
    <nav id="navbar">
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#services">User</a></li>
            <li><a href="#contact">Contact Us</a></li>
        </ul>
    </nav>

    <section id="home">
        <h1 class="h-primary">Welcome to the Table Reservation System</h1>
        <p>The main aim of our project is to provide a paper-less restaurant table management system. It also aims at
            providing low-cost reliable automation of the existing systems. </p>
        <p>Restaurant is a kind of business that serves people all over world with readymade food. It is necessary for
            the restaurants to keep track of its day-to-day activities & record the details of customers to keep the
            restaurant running smoothly & successfully. </p>
    </section>

    <section id="services">
        <h1 class="h-primary center">User</h1>
        <div class="user">
            <div class="user-item">
                <img src="images/customer.jpg" alt="image not loaded" height="250" width="350">
                <a href="user_home.php" class="view-btn">Customer</a>
            </div>
            <div class="user-item">
                <img src="images/owner.jpg" alt="image not loaded" height="250" width="350">
                <a href="admin/home.php" class="view-btn">Owner</a>
            </div>
            <div class="user-item">
                <img src="images/manager.jpg" alt="image not loaded" height="250" width="350">
                <a href="manager/home.php" class="view-btn">Manager</a>
            </div>
        </div>
    </section>
    <section id="contact">
        <div class="cap">
            <strong>
                <h3>CONTACT US</h3>
            </strong>
            <hr>
            <h4>Nachiket Gavad - +91 9673380472</h4>
            <h4>Harsh Shukla - +91 8976114751</h4>
            <h4>Farzam Sayed - +91 9967752622 </h4>
        </div>
    </section>
    <footer>
        <div class="center">
            Copyright &copy; Mini Project 1B. All rights reserved!
        </div>
    </footer>
</body>

</html>