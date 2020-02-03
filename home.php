<?php

	session_start();
	echo "Welcome ".$_SESSION['user_name'];

?>

<br><br><br>
<a href="insert.php">Insert</a>  
<br><br>
<a href="display.php">Display</a> 
<br>