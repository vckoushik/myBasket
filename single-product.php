<?php
ob_start();
session_start();
require_once 'config/connect.php';
include 'includes/header.php';
include 'includes/nav.php';
if (isset($_GET['id']) & !empty($_GET['id'])) {
	$id = $_GET['id'];
	$prodsql = "SELECT * FROM products WHERE id=$id";
	$prodres = mysqli_query($connection, $prodsql);
	$prodr = mysqli_fetch_assoc($prodres);
} else {
	header("location:index.php");
}

$uid = $_SESSION['customerid'];

?>
<script>
	$(':radio').change(function() {
		console.log('New star rating: ' + this.value);
	});
</script>
<style>
	.content {
		width: 420px;
		margin-top: 100px;
	}

	.ratings {

		background-color: #fff;
		padding: 54px;
		border: 1px solid rgba(0, 0, 0, 0.1);
		box-shadow: 0px 10px 10px #E0E0E0;
	}

	.product-rating {

		font-size: 50px;
	}

	/* .stars i {

		font-size: 18px;
		color: orange;
	} */

	.rating-text {
		margin-top: 10px;
	}

	.rating {
		display: inline-block;
		position: relative;
		height: 50px;
		line-height: 50px;
		font-size: 50px;
	}

	.rating label {
		position: absolute;
		top: 0;
		left: 0;
		height: 100%;
		cursor: pointer;
	}

	.rating label:last-child {
		position: static;
	}

	.rating label:nth-child(1) {
		z-index: 5;
	}

	.rating label:nth-child(2) {
		z-index: 4;
	}

	.rating label:nth-child(3) {
		z-index: 3;
	}

	.rating label:nth-child(4) {
		z-index: 2;
	}

	.rating label:nth-child(5) {
		z-index: 1;
	}

	.rating label input {
		position: absolute;
		top: 0;
		left: 0;
		opacity: 0;
	}

	.rating label .icon {
		float: left;
		color: transparent;
	}

	.rating label:last-child .icon {
		color: #000;
	}

	.rating:not(:hover) label input:checked~.icon,
	.rating:hover label:hover input~.icon {
		color: #09f;
	}

	.rating label input:focus:not(:checked)~.icon:last-child {
		color: #000;
		text-shadow: 0 0 5px #09f;
	}

	.card {
		border-radius: 5px;
		background-color: #fff;
		padding-left: 60px;
		padding-right: 60px;
		margin-top: 30px;
		padding-top: 30px;
		padding-bottom: 30px;
	}

	.rating-box {
		width: 130px;
		height: 130px;
		margin-right: auto;
		margin-left: auto;
		background-color: #FBC02D;
		color: #fff;
	}

	.rating-label {
		font-weight: bold;
	}

	/* Rating bar width */
	.rating-bar {
		width: 300px;
		padding: 8px;
		border-radius: 5px;
	}

	/* The bar container */
	.bar-container {
		width: 100%;
		background-color: #f1f1f1;
		text-align: center;
		color: white;
		border-radius: 20px;
		cursor: pointer;
		margin-bottom: 5px;
	}

	/* Individual bars */
	.bar-5 {
		width: 70%;
		height: 13px;
		background-color: #FBC02D;
		border-radius: 20px;

	}

	.bar-4 {
		width: 30%;
		height: 13px;
		background-color: #FBC02D;
		border-radius: 20px;

	}

	.bar-3 {
		width: 20%;
		height: 13px;
		background-color: #FBC02D;
		border-radius: 20px;

	}

	.bar-2 {
		width: 10%;
		height: 13px;
		background-color: #FBC02D;
		border-radius: 20px;

	}

	.bar-1 {
		width: 0%;
		height: 13px;
		background-color: #FBC02D;
		border-radius: 20px;

	}

	td {
		padding-bottom: 10px;
	}

	.star-active {
		color: #FBC02D;
		margin-top: 10px;
		margin-bottom: 10px;
	}

	.star-active:hover {
		color: #F9A825;
		cursor: pointer;
	}

	.star-inactive {
		color: #CFD8DC;
		margin-top: 10px;
		margin-bottom: 10px;
	}

	.blue-text {
		color: #0091EA;
	}

	.content {
		font-size: 18px;
	}

	.profile-pic {
		width: 90px;
		height: 90px;
		border-radius: 100%;
		margin-right: 30px;
	}

	.pic {
		width: 80px;
		height: 80px;
		margin-right: 10px;
	}

	.vote {
		cursor: pointer;
	}
</style>

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
					<img src="<?php echo $prodr['thumb']; ?>" alt="">
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

<!--Product Reviews -->
<div class="contact-from-section mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mb-5 mb-lg-0">
				<div class="form-title">
					<h2>Reviews</h2>
					<p>Feel free to write your review.</p>
				</div>
				<div id="form_status"></div>
				<div class="contact-form">
					<form type="POST" method="post" id="form" action="process-reviews.php">
						<?php
						$usersql = "SELECT u.email, u1.firstname, u1.lastname FROM users u JOIN usersmeta u1 WHERE u.id=u1.uid AND u.id=$uid";
						$userres = mysqli_query($connection, $usersql);
						$userr = mysqli_fetch_assoc($userres);
						?>
						<p>
							<input type="text" placeholder="Name" name="name" id="name" value="<?php echo $userr['firstname'] . " " . $userr['lastname']; ?>" disabled>
						</p>
						<p class="rating">
							<label>
								<input type="radio" name="stars" value="1" />
								<span class="icon">★</span>
							</label>
							<label>
								<input type="radio" name="stars" value="2" />
								<span class="icon">★</span>
								<span class="icon">★</span>
							</label>
							<label>
								<input type="radio" name="stars" value="3" />
								<span class="icon">★</span>
								<span class="icon">★</span>
								<span class="icon">★</span>
							</label>
							<label>
								<input type="radio" name="stars" value="4" />
								<span class="icon">★</span>
								<span class="icon">★</span>
								<span class="icon">★</span>
								<span class="icon">★</span>
							</label>
							<label>
								<input type="radio" name="stars" value="5" />
								<span class="icon">★</span>
								<span class="icon">★</span>
								<span class="icon">★</span>
								<span class="icon">★</span>
								<span class="icon">★</span>
							</label>
						</p>
						<p><textarea name="review" id="message" cols="30" rows="6" placeholder="Enter your review"></textarea></p>

						<input type="hidden" name="prodid" value="<?php echo $_GET['id'] ?>">
						<p><input type="submit" value="Submit Review"></p>
					</form>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="contact-form-wrap">
					<div class="content text-center">
						<?php
						$productid = $_GET['id'];
						$csql = "SELECT count(*) as rcount  FROM reviews  WHERE pid=$productid";
						$tsql = "SELECT sum(stars) as total  FROM reviews  WHERE pid=$productid";
						$chkrevres = mysqli_query($connection, $csql);
						$chkr = mysqli_fetch_assoc($chkrevres);

						$rcount = $chkr['rcount'];
						$chkres = mysqli_query($connection, $tsql);
						$chkr1 = mysqli_fetch_assoc($chkres);
						$total = $chkr1['total'];
						$rating = 0;
						$star_rating = 0;
						if ($rcount != 0) {
							$star_rating = (int) $total / $rcount;
							$rating = $total / $rcount;
						}
						?>
						<div class="ratings">
							<span class="product-rating"><?php echo $rating ?></span><span>/5</span>
							<div class="stars">
								<?php for ($i = 0; $i < $star_rating; $i++) { ?>
									<i class="fa fa-star"></i>
								<?php } ?>
							</div>
							<div class="rating-text">
								<span><?php echo $rcount ?> ratings & reviews</span>
							</div>

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
</div>
<!-- End of reviews -->
<!-- Display Reviews-->
<div class="container">
	<div class="row">
		<div class="col-lg-8 offset-lg-2 text-center">
			<div class="section-title">
				<h3><span class="orange-text">Product <span> Reviews</h3>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid px-1 py-5 mx-auto">
	
		<?php 
					$selrevsql = "SELECT u.firstname, u.lastname, r.`timestamp`, r.review,r.stars FROM reviews r JOIN usersmeta u WHERE r.uid=u.uid AND r.pid=$id LIMIT 5";
					$selrevres = mysqli_query($connection, $selrevsql);
					while($selrevr = mysqli_fetch_assoc($selrevres)){
				?>
		<div class="row justify-content-center">
		<div class="col-xl-7 col-lg-8 col-md-10 col-12 text-center mb-5">
			<div class="card">

				<div class="row d-flex">
				
					<!-- <div class="">
						<img class="profile-pic" src="https://i.imgur.com/V3ICjlm.jpg">
					</div> -->
					<div class="d-flex flex-column">
						<h3 class="mt-2 mb-0"><?php echo $selrevr['firstname']." ". $selrevr['lastname']; ?></h3>
						<div>
							<p class="text-left"><span class="text-muted"><?php echo $selrevr['stars']?></span>
							<?php
								for($i=0;$i<$selrevr['stars'];$i++)
								{
									echo '<span class="fa fa-star star-active"></span>';
								}
							
							?>
								
							</p>
						</div>
					</div>
					<div class="ml-auto">
						<p class="text-muted pt-5 pt-sm-3"><?php echo $selrevr['timestamp']; ?></p>
					</div>
					
				</div>
				<div class="row text-left">
					<p class="content"><?php echo $selrevr['review']; ?></p>
				</div>
				
			</div>
			
		</div>
		
	</div>
	<?php } ?>
</div>
<!--Display Reviews End-->
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

			while ($relr = mysqli_fetch_assoc($relres)) {
				$name = $relr['name'];
				$name = substr($name, 0, 30);
			?>
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.php?id=<?php echo $relr['id']; ?>"><img src="<?php echo $relr['thumb']; ?>" alt=""></a>
						</div>
						<h3><?php echo $name ?></h3>
						<p class="product-price">$ <?php echo $relr['price']; ?> </p>
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