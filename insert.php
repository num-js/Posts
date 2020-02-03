<!DOCTYPE html>
<html>
<head>
	<title>LogIn</title>
	<style type="text/css">
		table{
			font-size: 30px;
			font-family: cursive;
		}
	</style>
</head>
<body>

	<form action="" method="post">
		<table align="center">
			<tr>
				<td>Date</td>
				<td><input type="date" name="date" required></td>
			</tr>
			<tr>
				<td>Particular</td>
				<td><input type="text" name="particular" required></td>
			</tr>
			<tr>
				<td>Amount</td>
				<td><input type="text" name="amount" required></td>
			</tr>
			<tr>
				<td>resion(opt)</td>
				<td><input type="text" name="resion"></td>
			</tr>
			<tr>
			    <td align="center" colspan="2">
			    	<input type="submit" name="submit" value="Insert Data">
			    </td>
		    </tr>
		</table>
	</form>
</body>
</html>

<?php
		  
		//connection
	$con=mysqli_connect("localhost","root","","md_db") or die("cant Connect");
	
	    //Fetching Data
  if(isset($_POST['submit']))
  {
	  
	  $date=$_POST['date'];
	  $particular=$_POST['particular'];
	  $amount=$_POST['amount'];
	  $resion=$_POST['resion'];

	 $query="INSERT INTO `entry`(`date`, `particular`, `amount`, `resion`) VALUES ('$date','$particular','$amount','$resion')";
	 $run=mysqli_query($con, $query);
	 if($run==true){
	 	echo "Data Inserted <br> <a href='display.php'>Click here to Display </a>";
	 }	 
	 else{
	 	echo "Failed to insert Data";
	 }
  }
?>

