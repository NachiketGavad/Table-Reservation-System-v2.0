<!DOCTYPE html>
<?php
require_once 'validate.php';
require 'name.php';
$owner_id = $_SESSION['owner_id'];
?>
<html lang="en">

<head>
	<title>Manager Accounts</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css " />
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>

<body>
	<nav style="background-color:rgba(0, 0, 0, 0.1);" class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand">Manager Accounts</a>
			</div>
			<ul class="nav navbar-nav pull-right ">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <?php echo $name; ?></a>
					<ul class="dropdown-menu">
						<li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container-fluid">
		<ul class="nav nav-pills">
			<li><a href="home.php">Home</a></li>
			<li class="active"><a href="account.php">Manager Accounts</a></li>
			<li><a href="hotel.php">Hotel</a></li>
		</ul>
	</div>
	<br />
	<div class="container-fluid">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="alert alert-info">Manager Accounts</div>
				<a class="btn btn-success" href="add_account.php"><i class="glyphicon glyphicon-plus"></i> Create New Account</a>
				<br />
				<br />
				<table id="table" class="table table-bordered">
					<thead>
						<tr>
							<th>Name</th>
							<th>Username</th>
							<th>Password</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = $conn->query("SELECT * FROM `manager` WHERE owner_id = $owner_id") or die(mysqli_error("$conn"));
						while ($fetch = $query->fetch_array()) {
						?>
							<tr>
								<td><?php echo $fetch['manager_name'] ?></td>
								<td><?php echo $fetch['username'] ?></td>
								<td><?php echo md5($fetch['password']) ?></td>
								<td><a class="btn btn-warning" href="edit_account.php?manager_id=<?php echo $fetch['manager_id'] ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a> <a class="btn btn-danger" onclick="confirmationDelete(this); return false;" href="delete_account.php?manager_id=<?php echo $fetch['manager_id'] ?>"><i class="glyphicon glyphicon-remove"></i> Delete</a></center>
								</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<br />
	<br />
	<div style="text-align:right; margin-right:10px;" class="navbar navbar-default navbar-fixed-bottom">
		<label>&copy; Mini Project 1B </label>
	</div>
</body>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
	function confirmationDelete(anchor) {
		var conf = confirm("Are you sure you want to delete this record?");
		if (conf) {
			window.location = anchor.attr("href");
		}
	}
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#table").DataTable();
	});
</script>

</html>