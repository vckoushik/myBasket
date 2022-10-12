<?php 
ob_start();
session_start();
require_once 'config/connect.php';
include 'includes/header.php';
include 'includes/nav.php';
if(isset($_GET['id']) & !empty($_GET['id'])){
	$id = $_GET['id'];
	$prodsql = "SELECT * FROM products WHERE id=$id";
	$prodres = mysqli_query($connection, $prodsql);
	$prodr = mysqli_fetch_assoc($prodres);
}else{
	header('location: index.php');
}

$uid = $_SESSION['customerid'];
if(isset($_POST) & !empty($_POST)){
	
	$review = filter_var($_POST['review'], FILTER_SANITIZE_STRING);

	$revsql = "INSERT INTO reviews (pid, uid, review) VALUES ($id, $uid, '$review')";
	$revres = mysqli_query($connection, $revsql);
	if($revres){
		$smsg = "Review Submitted Successfully";
	}else{
		$fmsg = "Failed to Submit Review";
	}
}

?>
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>See more Details</p>
						<h1>Single Product</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- single product -->
	<div class="single-product mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="single-product-img">
						<img src="admin/<?php echo $prodr['thumb']; ?>" alt="">
					</div>
				</div>
				<div class="col-md-7">
					<div class="single-product-content">
						<h3><?php echo $prodr['name']; ?></h3>
						<p class="single-product-pricing"><span>Per Kg</span> $<?php echo $prodr['price']; ?></p>
						<p><?php echo $prodr['description']; ?></p>
						<div class="single-product-form">
							<form method="get" action="addtocart.php">
								<input type="hidden" name="id" value="<?php echo $prodr['id']; ?>">
								<input type="number" name="quant" placeholder="1">
								</br>
								<input type="submit" class="button btn-small" value='Add to Cart'>
							</form>
							</br>
							<a href="addtowishlist.php?id=<?php echo $prodr['id']; ?>">Add to WishList</a>
							<?php 
								$prodcatsql = "SELECT * FROM category WHERE id={$prodr['catid']}"; 
								$prodcatres = mysqli_query($connection, $prodcatsql);
								$prodcatr = mysqli_fetch_assoc($prodcatres);
								?>
                            <p><strong>Categories: </strong><?php echo $prodcatr['name']; ?></p>
						</div>
						<h4>Share:</h4>
						<ul class="product-share">
							<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
							<li><a href=""><i class="fab fa-twitter"></i></a></li>
							<li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
							<li><a href=""><i class="fab fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end single product -->

	<!-- more products -->
	<div class="more-products mb-150">
		<div class="container">
       
			<div class="row">
            
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">Related</span> Products</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
					</div>
				</div>
			</div>
			<div class="row">
            <?php
                $relsql = "SELECT * FROM products WHERE id != $id ORDER BY rand() LIMIT 3";
                $relres = mysqli_query($connection, $relsql);
               
                while($relr = mysqli_fetch_assoc($relres)){
                    $name= $relr['name'];
                    $name=substr($name,0,30);
                ?>
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.php?id=<?php echo $relr['id']; ?>"><img src="admin/<?php echo $relr['thumb']; ?>"  alt=""></a>
						</div>
						<h3><?php echo $name ?></h3>
						<p class="product-price"><span>Per Kg</span> <?php echo $relr['price']; ?> </p>
						<a href="addtocart.php?id=<?php echo $relr['id']; ?>" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
                <?php } ?>
				
			</div>
		</div>
	</div>
	<!-- end more products -->

	<!-- logo carousel -->
	<div class="logo-carousel-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="logo-carousel-inner">
						<div class="single-logo-item">
							<img src="assets/img/company-logos/1.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/2.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/3.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/4.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/5.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end logo carousel -->
    <?php include 'includes/footer.php' ?>