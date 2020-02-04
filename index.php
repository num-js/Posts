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
			<h3>Login</h3>
			<form class="form" method="post">
				<input class="form-control" type="text" name="email" placeholder="Email"> <br>
				<input class="form-control" type="password" name="password" placeholder="password"> <br>
				<input type="submit" name="login" value="Login" class="btn btn-success">
				<a href="register.php" class="" style="padding-left: 10px;"> Register </a>
			</form>
		</div>
	</div>
</body>
</html>

<?php
	if (isset($_POST['login'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		require_once 'conn.php';
		$query = "SELECT * FROM `users` WHERE `email`='$email' && `password`='$password' ";
		$query_run = mysqli_query($conn, $query);
		if ($query_run) {
			$_SESSION['post_email'] = $email;
			header('Location:home.php');
		}else{
			echo "Wrong Email & Password";
			echo '
				<script>
				     alert("Wrong UserName and Password...Please try to Login again");
				</script>
			      ';
		}
	}
?>