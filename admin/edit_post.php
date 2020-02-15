<?php 
	include_once 'header.php';
	
	require_once 'conn.php';

	if (isset($_POST['post_id'])) {
		$post_id = $_POST['post_id'];
		$_SESSION['post_id'] = $post_id;
		
		
		$query = "SELECT * FROM `posts` WHERE `post_id` = '$post_id' ";

		$query_run = mysqli_query($conn, $query);
		if ($query_run) {
			while ($row = mysqli_fetch_assoc($query_run)) {
				$_SESSION['post_image'] = $row['post_image'];
?>
	<div class="jumbotron">
		<div class="col-6">
			<form method="post" class="form" enctype="multipart/form-data">
				<textarea rows="3"  class="col-12 form-control" type="text" name="post_content" placeholder="Write your Post" required><?php echo $row['post_content']; ?></textarea>
				<br>
				<center>
					<div align="center" class="col-lg-8 jumbotron" style="padding: 0px;">
						<img align="center" width="100%" height="100%" src="../<?php echo $row['post_image']; ?>">
					</div>
				</center>
				<div class="row">
					<p class="text-left">Upload new Image <input type="file" name="image" placeholder="Upload Image"> </p>
				</div>
				<input type="submit" name="savePost" value="Save Changes" class="btn btn-success">
			</form>
		</div>
	</div>


<?php 
			}
		}
	}
?>

<?php 
	include_once 'footer.php';
?>

<?php
	if (isset($_POST['savePost'])) {
		$post_content = $_POST['post_content'];
			//Image Uplaoding
		$destinationimage = $_SESSION['post_image'];

		if ($_FILES['image'] != '') {
			$image = $_FILES['image'];
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
	   	    }
		}else{
		   	$destinationimage = $_SESSION['post_image'];
		}

		   $post_id = $_SESSION['post_id'];

	   		move_uploaded_file($imagetmp_name, $destinationimage);

			$query = " UPDATE `posts` SET post_content='$post_content',post_image='$destinationimage' WHERE post_id='$post_id' ";
			$query_run = mysqli_query($conn, $query);
			if ($query_run) {
				echo '
					<script>
						alert("Your Post is Uploaded...");
						window.location="manage_posts.php";
					</script>
					';
			}else{
				echo '
					<script>
						alert("Your Post is not Uploaded... Please try again");
						window.location="manage_posts.php";
					</script>
				';
			}
	}
?>