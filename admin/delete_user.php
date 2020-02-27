<?php
	session_start();
	require_once 'conn.php';

	if (isset($_POST['user_id'])) {
		$user_id = $_POST['user_id'];

		$query = "DELETE FROM `users` WHERE `id`='$user_id' ";
			$query_run = mysqli_query($conn, $query);
			if ($query_run) {
				echo '
					<script>
						alert("User Removed Successfully");
						window.location = "manage_users.php";
					</script>
					';
			}else{
				echo '
					<script>
						alert("Error Occured!!! Post not Deleted");
						window.location = "manage_users.php";
					</script>
					';
			}
	}
?>
