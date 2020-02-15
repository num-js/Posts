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
	<link href="https://fonts.googleapis.com/css?family=Nosifer&display=swap" rel="stylesheet">
	<title>Posts</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
	    <div class="container-fluid">

	    	<a href=""></a>
	        <a class="text-white text-center" style="font-family: cursive; align:center; cursor: pointer;"><h3>POSTS</h3></a>
	        <a href="admin" class="btn btn-light"style="float: right;">Admin <span class="fa fa-admin"></span></a>
	    </div>
	</nav>
	<br>
	<div class="container col-lg-6">
		<div class="jumbotron" style="padding: 20px;">
			<h3>Login</h3>
			<form class="form" method="post">
				<input class="form-control" type="text" name="email" placeholder="Email" required> <br>
				<input class="form-control" type="password" name="password" placeholder="password" required> <br>
				<input type="submit" name="login" value="Login" class="btn btn-success">
				<a href="register.php" class="" style="padding-left: 10px;"> Register </a>
			</form>
		</div>
	</div>
</body>
</html>

<?php
	if (isset($_POST['login'])) {
			require_once 'conn.php';
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$password = mysqli_real_escape_string($conn,$_POST['password']);

		if ($email != '' && $password != '') {
			$query = "SELECT * FROM `users` WHERE `email`='$email' && `password`='$password' ";
			$query_run = mysqli_query($conn, $query);
			$result = mysqli_num_rows($query_run);
			if ($result) {
				$_SESSION['post_email'] = $email;
				header('Location:home.php');
			}else{
				echo "<center style='color:red;'>Wrong Email & Password <br> Please try to Login again</center>";
				echo '
					<script>
					     alert("Wrong UserName and Password...");
					</script>
				      ';
			}
		}else{
			echo "<center style='color:red;'>Please Enter Email & Password</center>";
		}
	}
?>