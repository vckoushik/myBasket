<?php 
	ob_start();
	session_start();
	require_once 'config/connect.php';
	if(!isset($_SESSION['customer']) & empty($_SESSION['customer'])){
		header('location: login.php');
	}

include 'includes/header.php'; 
include 'includes/nav.php'; 
$uid = $_SESSION['customerid'];
$cart = isset($_SESSION['cart'])?$_SESSION['cart']:null;
?>

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						
						<h1>My Wishlist</h1>
                        <p>View all your favourite products</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- cart -->
	<div class="cart-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									
                                    <th class="product-remove"></th>
									<th class="product-image">Product Image</th>
									<th class="product-name">Name</th>
									<th class="product-price">Price</th>
									<th class="product-quantity">Added On</th>
									
								</tr>
							</thead>
							<tbody>
                                <?php
                                    $wishsql = "SELECT p.thumb,p.name, p.price, p.id AS pid, w.id AS id, w.`timestamp` FROM wishlist w JOIN products p WHERE w.pid=p.id AND w.uid='$uid'";
                                    $wishres = mysqli_query($connection, $wishsql);
                                    while($wishr = mysqli_fetch_assoc($wishres)){
                                     
                                ?>
                            
								<tr class="table-body-row">
                                    <td class="product-remove"><a href="delwishlist.php?id=<?php echo $wishr['id']; ?>"><i class="far fa-window-close"></i></a></td>
									<td class="product-image"><a href="single.php?id=<?php echo $wishr['pid']; ?>" ><img src="<?php echo $wishr['thumb']; ?>"  alt=""></a></td>
									<td class="product-name"><?php echo substr($wishr['name'], 0 , 30); ?></td>
									<td class="product-price">$<?php echo $wishr['price']; ?></td>
									<td class="product-quantity"><?php echo $wishr['timestamp']; ?></td>
									
                                    </td>
								</tr>
								
					            <?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end cart -->

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
 <?php include 'includes/footer.php'?>