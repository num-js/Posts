<?php
	session_start();
	if (isset($_SESSION['post_email'])) {
		header('Location:home.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<title>Posts</title>
</head>
<body>
	<br>
	<div class="container col-lg-6">
		<div class="jumbotron" style="padding: 20px;">
			<h3>Register</h3>
			<form class="form" method="post">
				<input class="form-control" type="text" name="name" placeholder="Name"> <br>
				<input class="form-control" type="email" name="email" placeholder="Email"> <br>
				<input class="form-control" type="password" name="password" placeholder="password"> <br>
				<input class="form-control" type="number" name="mobileno" placeholder="Mobile Number"> <br>
				<input type="submit" name="register" value="Register" class="btn btn-success">
				<a href="index.php" class="" style="padding-left: 10px;"> LogIn </a>
			</form>
		</div>
	</div>
</body>
</html>
	
<?php
	if (isset($_POST['register'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$mobileno = $_POST['mobileno'];

		require_once 'conn.php';
		$query = " INSERT INTO `users` (`name`, `email`, `password`, `mobileno`) VALUES ('$name', '$email', '$password', '$mobileno') ";
		$query_run = mysqli_query($conn, $query);
		if ($query_run) {
			echo '
				<script>
					alert("You are Registered Successfully... Now You can Login");
					window.location="index.php";
				</script>
				';
		}else{
			echo "<center style='color:red;'> You are not Registered <br> Please Try Again </center>";
			echo '
				<script>
				     alert("You are not Registered... Please Try Again");
				</script>
			      ';
		}
	}
?>