<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Approved</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css " />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" href="../css/header.css">
    <style>
        a {
            font-size: 17.6px;
        }
        a:hover{
            text-decoration: none;
        }

    </style>
</head>

<body>
    <nav class="navbar">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="../index.php">Menu</a></li>
            <li><a href="owner_approved.php">Approved</a></li>
        </ul>
    </nav>
    <h3 class="text-center">Approved Requests</h3>
    <div class="container-fluid">
            <hr>

        <?php
        require '../database/conn.php';
        ?>
        <table id="table" class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = $conn->query("SELECT * FROM `owner_tmp` where approved = 'yes'") or die(mysqli_error());
                while ($fetch = $query->fetch_array()) {
                ?>
                    <tr>
                        <td><?php echo $fetch['owner_name'] ?></td>
                        <td><?php echo $fetch['username'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#table").DataTable();
    });
</script>

</html>