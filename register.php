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
	<link href="https://fonts.googleapis.com/css?family=Nosifer&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<title>Posts</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
	    <div class="container-fluid">

	    	<a href=""></a>
	        <a class="text-white text-center" style="font-family: 'Nosifer', cursive; align:center; cursor: pointer;"><h3>POSTS</h3></a>
	        <a href="admin" class="btn btn-light"style="float: right;">Admin <span class="fa fa-admin"></span></a>
	    </div>
	</nav>
	<br>
	<div class="container col-lg-6">
		<div class="jumbotron" style="padding: 20px;">
			<h3>Register</h3>
			<form class="form" method="post">
				<label>Name*</label>
				<input class="form-control" type="text" name="name" id="name" placeholder="Name" pattern="^[a-zA-Z\s]+$" title="Enter Characters only" required>
				
				<label>Email*</label>
				<input class="form-control" type="email" name="email" placeholder="Email" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$" title="Please Enter a Correct Email" required>
				
				<label>Password*</label>
				<input class="form-control" type="password" name="password" placeholder="Password" pattern=".{3,}" title="Please Enter Password morethan 3 characters or Numbers" required>
				
				<label>Mobile No*</label>
				<input class="form-control" type="number" name="mobileno" id="mobileno" placeholder="Mobile Number"  pattern="^[0-9]{10}$" title="Enter Mobile Number Digits" required>
				<span id="mobilenospan"></span>
				<br>

				<input type="submit" name="register" id="register" value="Register" class="btn btn-success" disabled>
				<a href="index.php" style="padding-left: 10px;"> LogIn </a>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#mobileno').keyup(function(){
				var mobilenolen = Number(document.getElementById('mobileno').value.length);
				if (mobilenolen == 10) {
					$('#mobilenospan').html("<span style='color:green'>Mobile Number is Ok</span> <br>");
					allok = 1;
					document.getElementById('register').disabled=false;
				}else{
					$('#mobilenospan').html("<span style='color:red'>Please Enter 10 Digits</span> <br>");
					allok = 0;
				}
			});
		});
	</script>
</body>
</html>
	
<?php
		require_once 'conn.php';
	
	if (isset($_POST['register'])) {
		$name = mysqli_real_escape_string($conn,$_POST['name']);
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$password = mysqli_real_escape_string($conn,$_POST['password']);
		$mobileno = mysqli_real_escape_string($conn,$_POST['mobileno']);

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