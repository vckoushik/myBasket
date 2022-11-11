<?php
	session_start();
	require_once '../config/connect.php';
	if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
		header('location: login.php');
	}

	if(isset($_POST) & !empty($_POST)){
		$catname = mysqli_real_escape_string($connection, $_POST['categoryname']);
		$description = mysqli_real_escape_string($connection, $_POST['categorydescription']);

		if(isset($_FILES) & !empty($_FILES)){
			$name = $_FILES['categoryimage']['name'];
			$size = $_FILES['categoryimage']['size'];
			$type = $_FILES['categoryimage']['type'];
			$tmp_name = $_FILES['categoryimage']['tmp_name'];

			$max_size = 10000000;
			$extension = substr($name, strpos($name, '.') + 1);

			if(isset($name) && !empty($name)){
				if(($extension == "jpg" || $extension == "jpeg") && $type == "image/jpeg" && $size<=$max_size){
					$location = "uploads/";
					if(move_uploaded_file($tmp_name, $location.$name)){
						//$smsg = "Uploaded Successfully";
						$sql = "INSERT INTO category (name, description, thumb) VALUES ('$catname', '$description', '$location$name')";
						$res = mysqli_query($connection, $sql);
						if($res){
							//echo "Product Created";
							header('location: categories.php');
						}else{
							$fmsg = "Failed to Create Category";
						}
					}else{
						$fmsg = "Failed to Upload File";
					}
				}else{
					$fmsg = "Only JPG files are allowed and should be less that 1MB";
				}
			}else{
				$fmsg = "Please Select a File";
			}
		}else{

			$sql = "INSERT INTO category (name, description) VALUES ('$catname', '$description')";
			$res = mysqli_query($connection, $sql);
			if($res){
				header('location: products.php');
			}else{
				$fmsg =  "Failed to Create Product";
			}
		}
	}
?>
<?php include 'inc/header.php'; ?> 
<?php include 'inc/nav.php'; ?>
	
<section id="content">
	<div class="content-blog">
		<div><h1><strong>Add a new category</strong></h1></div>
		<div class="clearfix space70"></div>
		<div class="container">
		<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
		<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
			<!-- <form method="post">
			  <div class="form-group">
			    <label for="Productname">Category Name</label>
			    <input type="text" class="form-control" name="categoryname" id="Categoryname" placeholder="Category Name">
			  </div>
			  
			  <button type="submit" class="btn btn-default">Submit</button>
			</form> -->

			<form method="post" enctype="multipart/form-data">
			<div class="form-group">
			    <label for="categoryname">Category Name</label>
			    <input type="text" class="form-control" name="categoryname" id="Categoryname" placeholder="Category Name">
			  </div>
			  <div class="form-group">
			    <label for="categorydescription">Category Description</label>
			    <textarea class="form-control" name="categorydescription" rows="3"></textarea>
			  </div>
			  <div class="form-group">
			    <label for="categoryimage">Category Image</label>
			    <input type="file" name="categoryimage" id="productimage">
			    <p class="help-block">Only jpg/png are allowed.</p>
			  </div>
			   
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
			
		</div>
	</div>

</section>
<?php include 'inc/footer.php' ?>
