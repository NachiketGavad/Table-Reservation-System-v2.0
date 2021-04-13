<!DOCTYPE html>
<?php
require_once 'validate.php';
require 'name.php';
?>
<html lang="en">

<head>
	<title>Hotel Online Reservation</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css " />
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>

<body>
	<nav style="background-color:rgba(0, 0, 0, 0.1);" class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand">Hotel Online Reservation</a>
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
			<li><a href="account.php">Manager Accounts</a></li>
			<li class="active"><a href="hotel.php">Hotel</a></li>
		</ul>
	</div>
	<br />
	<div class="container-fluid">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="alert alert-info">Hotel / Change Hotel Details</div>
				<br />
				<div class="col-md-4">
					<?php
					$query = $conn->query("SELECT * FROM `hotel` WHERE `hotel_id` = '$_REQUEST[hotel_id]'") or die(mysqli_error($conn));
					$fetch = $query->fetch_array();
					?>
					<form method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>Hotel Name</label>
							<input type="varchar" min="0" max="9999" value="<?php echo $fetch['hotel_name'] ?>" class="form-control" name="hotel_name" readonly/>
						</div>
						<div class="form-group">
							<label>Capacity</label>
							<input type="number" min="0" max="9999" value="<?php echo $fetch['capacity'] ?>" class="form-control" name="capacity" />
						</div>
						<div class="form-group">
							<label>Hotel Location</label>
							<input type="varchar" min="0" max="9999" value="<?php echo $fetch['hotel_location'] ?>" class="form-control" name="hotel_location" readonly/>
						</div>
						<div class="form-group">
							<label>Photo </label>
							<div id="preview" style="width:150px; height :150px; border:1px solid #000;">
								<img src="../photo/<?php echo $fetch['photo'] ?>" id="lbl" width="100%" height="100%" />
							</div>
						</div>
						<br />
						<div class="form-group">
							<button name="edit_hotel" class="btn btn-warning form-control"><i class="glyphicon glyphicon-edit"></i> Save Changes</button>
						</div>
					</form>
					<?php require_once 'edit_query_hotel.php' ?>
				</div>
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
<script type="text/javascript">
	$(document).ready(function() {
		$pic = $('<img id = "image" width = "100%" height = "100%"/>');
		$lbl = $('<center id = "lbl">[Photo]</center>');
		$("#photo").change(function() {
			$("#lbl").remove();
			var files = !!this.files ? this.files : [];
			if (!files.length || !window.FileReader) {
				$("#image").remove();
				$lbl.appendTo("#preview");
			}
			if (/^image/.test(files[0].type)) {
				var reader = new FileReader();
				reader.readAsDataURL(files[0]);
				reader.onloadend = function() {
					$pic.appendTo("#preview");
					$("#image").attr("src", this.result);
				}
			}
		});
	});
</script>

</html>