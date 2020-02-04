<?php
	session_start();
	require_once 'conn.php';
	if (!isset($_SESSION['post_email'])) {
		header('Location:index.php');
	}

	$query = "SELECT * FROM `posts` ";
	$query_run = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<title>Posts</title>
</head>
<body>
	<br>
	<div class="container">
		<div class="jumbotron">
			<h3 align="center" float="center"><u>POSTS</u></h3>
			<a href="logout.php" class="btn btn-danger"style="float: right;">LogOut <span class="fa fa-sign-out"></span></a>
					<!-- Modal -->
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#postsModal" style="float: left;"> Create Posts &nbsp;<span class="fa fa-plus"></span></button>

			<div class="col-lg-4">
				<div class="modal" id="postsModal">
					<br>
					<center>
					<div class="jumbotron col-lg-4" style="padding: 10px">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<br>
						<h4><u>Write your Post</u></h4>
						<form method="post" class="form">
							<textarea rows="5" class="col-12 form-control" type="text" name="post_content" placeholder="Write Post"> </textarea>
							<br>
							<input type="submit" name="savePost" value="Post" class="btn btn-success">
						</form>
					</div>
					</center>
				</div>
			</div>

			<hr>
			<div>
				<?php
					if ($query_run) {
						while ($row = mysqli_fetch_assoc($query_run)) {
				?>
				<center>
				<div class="col-lg-8">
					<div class="card">
						<div align="left" class="card-body">
							<u style="float: right;"><small><?php echo $row['post_by']; ?></small></u> <br>
							<?php echo $row['post_content'];  ?>
						</div>
					</div>
				</div>
				</center>
				<?php
						}
					}else{
						echo "No Records Found";
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>

<?php
	if (isset($_POST['savePost'])) {
		$post_content = $_POST['post_content'];
		$post_by = $_SESSION['post_email'];
		$query = " INSERT INTO `posts` (`post_by`,`post_content`) VALUES ('$post_by','$post_content') ";
		$query_run = mysqli_query($conn, $query);

		if ($query_run) {
			echo '
				<script>
					alert("Your Post is not Uploaded... Please try again");
				</script>
				';
			header("Location:home.php");
		}else{
			echo '
				<script>
					alert("Your Post is not Uploaded... Please try again");
				</script>
			';
		}

	}
?>