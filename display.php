<!DOCTYPE html>
<html>
<head>
	<title>Displaying Data</title>
	<style type="text/css">
		table{
			background:black;
			color: white;
			font-size: 20px;
			font-family: papyrus;
		}
		h1{
			color: red;
		}
	</style>
</head>
<body>

	<div class="d1" align="Center">
		<h1>March 2019</h1>
<?php
	//connection
  $con=mysqli_connect("localhost","root","","md_db") or die("cant Connect");
	

			$query="SELECT * FROM entry";
			$result=mysqli_query($con,$query);
			if(mysqli_num_rows($result) > 0){
				echo '<table class="table" border="2" ';
				
				  echo "<tr>";
				  	 echo "<th>Sl no. </th>";
				     echo "<th>Date </th>";
				     echo "<th>Particular </th>";
				     echo "<th>Amount </th>";
				     echo "<th>resion(opt) </th>";
				  echo "</tr>";
				  while($row=mysqli_fetch_assoc($result)){
				  	echo "<tr>";
				  	   echo "<td>" . $row["id"] . "</td>";
				  	   echo "<td>" . $row["date"] . "</td>";
				  	   echo "<td>" . $row["particular"] . "</td>";
				  	   echo "<td>" . $row["amount"] . "</td>";
				  	   echo "<td>" . $row["resion"] . "</td>";
				  	echo "</tr>";
				  }
				echo '</table>';
			    }
			    else{
			      echo "0 Results";
			  }
?>
	   </div>

</body>
</html>