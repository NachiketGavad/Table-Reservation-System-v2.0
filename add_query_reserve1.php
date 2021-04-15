<?php
	require_once 'database/conn.php';
	if(ISSET($_POST['add_guest'])){
		$hotel_id = $_GET['hotel_id'];
		echo $hotel_id;
		$sql = "SELECT  * FROM `hotel` WHERE hotel_id ='" . $hotel_id . "' ";
		$result = $conn->query($sql);
		$data = mysqli_query($conn, $sql);
		$customer_id = $_GET['customer_id'];

		//fetch1 for customer details
		$sql1 = "SELECT  * FROM `customer` WHERE customer_id ='" . $customer_id . "' ";
		$total = mysqli_num_rows($data);
		$query1 = $conn->query($sql1);
		$fetch1 = $query1->fetch_array();

		// $conn->query("INSERT INTO `guest` (firstname, middlename, lastname, address, contactno) VALUES('$firstname', '$middlename', '$lastname', '$address', '$contactno')") or die(mysqli_error($conn));
		// $query = $conn->query("SELECT * FROM `guest` WHERE `firstname` = '$firstname' && `lastname` = '$lastname' && `contactno` = '$contactno'") or die(mysqli_error($conn));
		// $fetch = $query->fetch_array();
		// $query2 = $conn->query("SELECT * FROM `transaction` WHERE `date` = '$checkin'  && `status` = 'Pending'") or die(mysqli_error($conn));
		// $row = $query2->num_rows;
		if($checkin < date("Y-m-d", strtotime('+1 HOURS'))){	
				echo "<script>alert('Must be present date')</script>";
			}else{
				if($row > 0){
					echo "<div class = 'col-md-4'>
								<label style = 'color:#ff0000;'>Not Available Date</label><br />";
							$q_date = $conn->query("SELECT * FROM `transaction` WHERE `status` = 'Pending'") or die(mysqli_error($conn));
							while($f_date = $q_date->fetch_array()){
								echo "<ul>
										<li>	
											<label class = 'alert-danger'>".date("M d, Y", strtotime($f_date['checkin']."+8HOURS"))."</label>	
										</li>
									</ul>";
							}
						"</div>";
				}
           else{	
						if($guest_id = $fetch['guest_id']){
							$table_id = $_REQUEST['table_id'];
							$conn->query("INSERT INTO `transaction`(guest_id, status, date) VALUES('$guest_id', 'Pending', '$checkin')") or die(mysqli_error($conn));
							header("location:reply_reserve.php");
						}else{
							echo "<script>alert('Error Javascript Exception!')</script>";
						}
				}	
			}	
			echo $hotel_id ;
			echo $customer_id ;
	}
