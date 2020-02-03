<!DOCTYPE html>
<html>
<head>
	<title>LogIn</title>
	<style type="text/css">
		table{
			font-size: 30px;
			font-family: papyrus;
		}
	</style>
</head>
<body>

	<form action="" method="post">
		<table align="center">
			<tr>
				<td>Username*</td>
				<td><input type="text" name="username" required></td>
			</tr>
			<tr>
				<td>Password*</td>
				<td><input type="password" name="password" required></td>
			</tr>
			<tr>
			    <td align="center" colspan="2"><input type="submit" name="submit" value="LogIn"></td>
		    </tr>
		</table>
	</form>
</body>
</html>

<?php
		  //Session
		session_start();
		//connection
	$con=mysqli_connect("localhost","root","","md_db") or die("cant Connect");
	  //Ignoring Errors
	//error_reporting(0);
	
	    //Fetching Data
  if(isset($_POST['submit']))
  {
	  $username=$_POST['username'];
	  $password=$_POST['password'];

	 $query="SELECT * FROM login WHERE username='$username' && password='$password'";
	 $data=mysqli_query($con, $query);
	 $total=mysqli_num_rows($data);
	 
	 if ($total==1) {
	 	$_SESSION['user_name']=$username;
	 	header('location:home.php');
	 }
	 else{
	 	echo "Login Failed";
	 }
	 
  }
?>