<?php
	session_start();

	unset($_SESSION['post_email']);

	header("Location:index.php");
?>