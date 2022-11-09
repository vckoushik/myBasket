<?php 
session_start();
require_once 'config/connect.php';
include 'includes/header.php'; 
include 'includes/nav.php'; 
if(!isset($_SESSION['customer']) & empty($_SESSION['customer'])){
	header('location: login.php');
}
$cart = isset($_SESSION['cart'])?$_SESSION['cart']:null;
?>

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Fresh and Organic</p>
						<h1>Cart</h1>
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
				<div class="col-lg-8 col-md-12">
					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th class="product-remove"></th>
									<th class="product-image">Product Image</th>
									<th class="product-name">Name</th>
									<th class="product-price">Price</th>
									<th class="product-quantity">Quantity</th>
									<th class="product-total">Total</th>
								</tr>
							</thead>
							<tbody>
                            <?php
					
                                $total = 0;
								if(!empty($cart)){
                                    foreach ($cart as $key => $value) {
                                        //echo $key . " : " . $value['quantity'] ."<br>";
                                        $cartsql = "SELECT * FROM products WHERE id=$key";
                                        $cartres = mysqli_query($connection, $cartsql);
                                        $cartr = mysqli_fetch_assoc($cartres);

                                    
                                ?>
								<tr class="table-body-row">
									<td class="product-remove"><a href="delcart.php?id=<?php echo $key; ?>"><i class="far fa-window-close"></i></a></td>
									<td class="product-image"><a href="single-product.php?id=<?php echo $cartr['id']; ?>" ><img src="admin/<?php echo $cartr['thumb']; ?>"  alt=""></a></td>
									<td class="product-name"><?php echo substr($cartr['name'], 0 , 30); ?></td>
									<td class="product-price">$<?php echo $cartr['price']; ?></td>
									<td class="product-quantity"><input type="number" placeholder="0" value="<?php echo $value['quantity']; ?>"></td>
									<td class="product-total">$<?php echo ($cartr['price']*$value['quantity']); ?></td>
								</tr>
								<?php $total = $total + ($cartr['price']*$value['quantity']);
					            }}?>
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="total-section">
						<table class="total-table">
							<thead class="total-table-head">
								<tr class="table-total-row">
									<th>Total</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody>
								<tr class="total-data">
									<td><strong>Subtotal: </strong></td>
									<td>$ <?php echo $total; ?></td>
								</tr>
								<tr class="total-data">
									<td><strong>Shipping: </strong></td>
									<td>$ 0</td>
								</tr>
								<tr class="total-data">
									<td><strong>Total: </strong></td>
									<td>$ <?php echo $total; ?></td>
								</tr>
							</tbody>
						</table>
						<div class="cart-buttons">
							<!-- <a href="cart.html" class="boxed-btn">Update Cart</a> -->
							<a href="checkout-page.php" class="boxed-btn black">Check Out</a>
						</div>
					</div>

					<!-- <div class="coupon-section">
						<h3>Apply Coupon</h3>
						<div class="coupon-form-wrap">
							<form action="index.html">
								<p><input type="text" placeholder="Coupon"></p>
								<p><input type="submit" value="Apply"></p>
							</form>
						</div>
					</div> -->
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
    <?php include 'includes/footer.php' ?>