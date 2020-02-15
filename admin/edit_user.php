<?php 
	include_once 'header.php';

		require_once 'conn.php';

	if (isset($_POST['user_id'])) {
		$user_id = $_POST['user_id'];
		$_SESSION['user_id'] = $user_id;
		
		$query = "SELECT * FROM `users` WHERE `id` = '$user_id' ";

		$query_run = mysqli_query($conn, $query);
		if ($query_run) {
			while ($row = mysqli_fetch_assoc($query_run)) {
?>
	<div class="jumbotron">
		<div class="col-6">
			<form method="post" class="form">
				<label>Name*</label>
				<input class="form-control" type="text" name="name" id="name" placeholder="Name" title="Enter Characters only" value="<?php echo $row['name']; ?>" required>
				
				<label>Email*</label>
				<input class="form-control" type="email" name="email" placeholder="Email" title="Please Enter a Correct Email" value="<?php echo $row['email']; ?>" required>
				
				<label>Password*</label>
				<input class="form-control" type="password" name="password" placeholder="Password" value="<?php echo $row['password']; ?>" required>
				
				<label>Mobile No*</label>
				<input class="form-control" type="number" name="mobileno" id="mobileno" placeholder="Mobile Number"  title="Enter Mobile Number Digits" value="<?php echo $row['mobileno']; ?>" required>
				<span id="mobilenospan"></span>
				<br>

				<input type="submit" name="save_changes" id="save_changes" value="Save Changes" class="btn btn-success">
			</form>
		</div>
	</div>


<?php 
			}
		}
	}
?>

<?php 
	include_once 'footer.php';
?>

<?php
	if (isset($_POST['save_changes'])) {
		
		$name = mysqli_real_escape_string($conn,$_POST['name']);
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$password = mysqli_real_escape_string($conn,$_POST['password']);
		$mobileno = mysqli_real_escape_string($conn,$_POST['mobileno']);

		$user_id = $_SESSION['user_id'];

		echo $query = " UPDATE `users` SET name='$name',email='$email',password='$password',mobileno='$mobileno' WHERE `id` = '$user_id' ";
		$query_run = mysqli_query($conn, $query);
		if ($query_run) {
			echo '
				<script>
					alert("Data Updated Successfully");
					window.location="manage_users.php";
				</script>
				';
		}else{
			echo "<center style='color:red;'> Error Occured <br> Data Not Updated </center>";
			echo '
				<script>
				     alert("Data not Updated...");
				</script>
			      ';
		}
	}
?>