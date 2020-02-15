<?php 
	include_once 'header.php';
?>
	<div class="jumbotron">
		<div class="col-6">
			<h3>Create New User</h3>
			<form class="form" method="post">
				<label>Name*</label>
				<input class="form-control" type="text" name="name" id="name" placeholder="Name" title="Enter Characters only" required>
				
				<label>Email*</label>
				<input class="form-control" type="email" name="email" placeholder="Email" title="Please Enter a Correct Email" required>
				
				<label>Password*</label>
				<input class="form-control" type="password" name="password" placeholder="Password" title="Please Enter Password morethan 3 characters or Numbers" required>
				
				<label>Mobile No*</label>
				<input class="form-control" type="number" name="mobileno" id="mobileno" placeholder="Mobile Number" title="Enter Mobile Number Digits" required>
				<br>

				<input type="submit" name="register" id="register" value="Create New User" class="btn btn-success">
			</form>
		</div>
	</div>
<?php 
	include_once 'footer.php';

	require_once 'conn.php';

	if (isset($_POST['register'])) {
		$name = mysqli_real_escape_string($conn,$_POST['name']);
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$password = mysqli_real_escape_string($conn,$_POST['password']);
		$mobileno = mysqli_real_escape_string($conn,$_POST['mobileno']);

		echo $query = " INSERT INTO `users` (`name`, `email`, `password`, `mobileno`) VALUES ('$name', '$email', '$password', '$mobileno') ";

		$query_run = mysqli_query($conn, $query);
		if ($query_run) {
			echo '
				<script>
					alert("User Added...");
					window.location="manage_users.php";
				</script>
				';
		}else{
			echo "<center style='color:red;'> Error Occured... <br> User not Added </center>";
			echo '
				<script>
				     alert("Error Occured... User not Added");
				</script>
			      ';
		}
	}
?>