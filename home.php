<?php
	session_start();
	require_once 'conn.php';
	if (!isset($_SESSION['post_email'])) {
		header('Location:index.php');
	}

	$query = "SELECT * FROM `posts` ORDER BY `posts`.`post_id` DESC";
	$query_run = mysqli_query($conn, $query);
	$result = mysqli_num_rows($query_run);

	$post_by_email = $_SESSION['post_email'];
	
	$query1 = "SELECT name FROM `users` WHERE email='$post_by_email' ";
	$query_run1 = mysqli_query($conn, $query1);
	$result1 = mysqli_num_rows($query_run1);
	if ($result1) {
		while ($row1 = mysqli_fetch_assoc($query_run1)) {
			$post_by_name = $row1['name'];
		}
	}
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
	<link href="https://fonts.googleapis.com/css?family=Nosifer&display=swap" rel="stylesheet">
	<title>Posts</title>
	<style type="text/css">
		.img-hover-zoom--slowmo img {
		  transform-origin: 50% 65%;
		  transition: transform 5s, filter 3s ease-in-out;
		  /*filter: brightness(150%);*/
		}

		/* The Transformation */
		.img-hover-zoom--slowmo:hover img {
		  /*filter: brightness(100%);*/
		  transform: scale(3);
		}

	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
	    <div class="container-fluid">
	    	<a href="#" class="rounded"></a>

	        <a class="text-white" style="font-family: 'Nosifer', cursive; cursor: pointer;"><h2>POSTS</h2></a>
	        
	        <a href="logout.php" title="LogOut" class="btn btn-danger btn-sm"style="float: right;"><span class="fa fa-sign-out"></span></a>
	    </div>
	</nav>
	<div class="container">
		<div class="jumbotron" style="padding-top: 0px">
			<br>
					<!-- Modal -->
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#postsModal" style="float: left;"><span class="fa fa-plus"></span> Write Posts</button>
			<br>
			<div class="col-lg-4">
				<div class="modal" id="postsModal">
					<br>
					<center>
					<div class="jumbotron col-lg-4" style="padding: 10px">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<br>
						<h4><u>Write your Post</u></h4>
						<form method="post" class="form" enctype="multipart/form-data">
							<textarea rows="3"  class="col-12 form-control" type="text" name="post_content" placeholder="Write your Post" required></textarea>
							<br>
							<p class="text-left">Upload Image 
							<input type="file" name="image" placeholder="Upload Image">
							</p>

							<input type="submit" name="savePost" value="Post" class="btn btn-success">
						</form>
					</div>
					</center>
				</div>
			</div>

			<hr>
			<div>
				<?php
					if ($result) {
						while ($row = mysqli_fetch_assoc($query_run)) {
				?>
				<center>
				<div class="col-lg-8 col-sm-12">
					<div class="card col-12" style="margin:0px; padding: 0px;">
						<div align="left" class="card-body">
							<u style="float: right;"><small><?php echo $row['post_by_name']; ?></small></u>
							<b><?php echo $row['post_content'];?></b>
							<br>
							<br>
							<?php
								if ($row['post_image']) {
							?>
								<center>
									<div align="center" class="col-lg-8 jumbotron" style="padding: 0px;">
										<div class="img-hover-zoom--slowmo">
											<img align="center" width="100%" height="100%" src="<?php echo $row['post_image']; ?>">
										</div>
									</div>
								</center>
							<?php
								}
							?>
								
						</div>
					</div>
				</div>
				</center>
				<?php
						}
					}else{
						echo "<center style='color:red'> No Posts Found </center>";
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
			//Image Uplaoding
		$image = $_FILES['image'];
		if ($image != '') {
		   $imagename = $image['name'];
		   $imagetype = $image['type'];
		   $imagetmp_name = $image['tmp_name'];
		   $imageerror = $image['error'];
		   $imagesize = $image['size'];
				//For File Extension
		   $imageext = explode('.',$imagename);
		   $imagecheck = strtolower(end($imageext));

		   		//Required File Extensions 
		   $imageextstored = array('jpg','jpeg','png');
	   		//searching Extensions
		   if (in_array($imagecheck, $imageextstored)) {
		   		$destinationimage = 'post_images/'.$imagename;
		   		move_uploaded_file($imagetmp_name, $destinationimage);
		   	}
		}else{
			$destinationimage = '';
		}

		$query = " INSERT INTO `posts` (`post_by_name`,`post_by_email`,`post_content`,`post_image`) VALUES ('$post_by_name','$post_by_email','$post_content','$destinationimage') ";
		$query_run = mysqli_query($conn, $query);
		if ($query_run) {
			echo '
				<script>
					alert("Your Post is Uploaded...");
					window.location="index.php";
				</script>
				';
		}else{
			echo '
				<script>
					alert("Your Post is not Uploaded... Please try again");
				</script>
			';
		}
	}
?>