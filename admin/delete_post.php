<?php
	session_start();
	require_once 'conn.php';

	if (isset($_POST['post_id'])) {
		$post_id = $_POST['post_id'];

		$query = "DELETE FROM `posts` WHERE `post_id`='$post_id' ";
			$query_run = mysqli_query($conn, $query);
			if ($query_run) {
				echo '
					<script>
						alert("Post Deleted");
						window.location = "manage_posts.php";
					</script>
					';
			}else{
				echo '
					<script>
						alert("Post not Deleted");
						window.location = "manage_posts.php";
					</script>
					';
			}
	}
?>
