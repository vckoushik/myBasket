<?php
	session_start();
	require_once '../config/connect.php';
	if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
		header('location: login.php');
	}

	if(isset($_GET) & !empty($_GET)){
		$id = $_GET['id'];
	}else{
		header('location: categories.php');
	}

	if(isset($_POST) & !empty($_POST)){
		$id = mysqli_real_escape_string($connection, $_POST['id']);
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
					$filepath = $location.$name;
					if(move_uploaded_file($tmp_name, $filepath)){
						$smsg = "Uploaded Successfully";
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
			$filepath = $_POST['filepath'];
		}	

		$sql = "UPDATE category SET name='$catname', description='$description',  thumb='$filepath' WHERE id = $id";
		$res = mysqli_query($connection, $sql);
		if($res){
			$smsg = "category Updated";
		}else{
			$fmsg = "Failed to Update category";
		}
	}
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
	
<section id="content">
	<div class="content-blog">
		<div class="container">
		<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
		<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
			<form method="post" enctype="multipart/form-data">
			  <div class="form-group">
			    <label for="categoryname">Category Name</label>
			    <?php 	
					$sql = "SELECT * FROM category WHERE id=$id";
					$res = mysqli_query($connection, $sql); 
					$r = mysqli_fetch_assoc($res); 
				?>
				<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
			    <input type="text" class="form-control" name="categoryname" id="Categoryname" placeholder="Category Name" value="<?php echo $r['name'];  ?>">
			  </div>
			  <div class="form-group">
			    <label for="categorydescription">Category Description</label>
			    <textarea class="form-control" name="categorydescription" rows="3"><?php echo $r['description'];?></textarea>
			  </div>
			  <div class="form-group">
			    <label for="categoryimage">Category Image</label>
			    <?php if(isset($r['thumb']) & !empty($r['thumb'])){ ?>
			    <br>
			    	<img src="<?php echo $r['thumb'] ?>" widht="100px" height="100px">
			    	<a href="delcatimg.php?id=<?php echo $r['id']; ?>">Delete Image</a>
			    <?php }else{ ?>
			    <input type="file" name="categoryimage" id="categoryimage">
			    <p class="help-block">Only jpg/png are allowed.</p>
			    <?php } ?>
			  </div>
			  
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
			
		</div>
	</div>

</section>
<?php include 'inc/footer.php' ?>
