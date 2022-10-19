<?php 
ob_start();
session_start();
require_once 'config/connect.php';
include 'includes/header.php'; 
include 'includes/nav.php'; 
if(!isset($_SESSION['customer']) & empty($_SESSION['customer'])){
    header('location: login.php');
}
$uid = $_SESSION['customerid'];
$cart = isset($_SESSION['cart'])?$_SESSION['cart']:null;
?>

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<h1>Order Details</h1>
						<p>Checkout the order details!</p>
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
									
									<th class="product-image">Product Image</th>
									<th class="product-name">Name</th>
									<th class="product-price">Price</th>
									<th class="product-quantity">Quantity</th>
									<th class="product-total">Total</th>
								</tr>
							</thead>
							<tbody>
                            <?php

                                if(isset($_GET['id']) & !empty($_GET['id'])){
                                    $oid = $_GET['id'];
                                }else{
                                    header('location: my-account.php');
                                }
                                $ordsql = "SELECT * FROM orders WHERE uid='$uid' AND id='$oid'";
                                $ordres = mysqli_query($connection, $ordsql);
                                $ordr = mysqli_fetch_assoc($ordres);

                                $orditmsql = "SELECT * FROM orderitems o JOIN products p WHERE o.orderid=$oid AND o.pid=p.id";
                                $orditmres = mysqli_query($connection, $orditmsql);
                                while($orditmr = mysqli_fetch_assoc($orditmres)){
                                ?>
								<tr class="table-body-row">
									
									<td class="product-image"><a href="single-product.php?id=<?php echo $orditmr['pid']; ?>" ><img src="admin/<?php echo $orditmr['thumb']; ?>"  alt=""></a></td>
									<td class="product-name"><?php echo substr($orditmr['name'], 0 , 30); ?></td>
									<td class="product-price">$<?php echo $orditmr['productprice']; ?></td>
									<td class="product-quantity"><input type="number" placeholder="0" value="<?php echo $orditmr['pquantity']; ?>"></td>
									<td class="product-total">$<?php echo ($orditmr['productprice']*$orditmr['pquantity']); ?></td>
								</tr>
								<?php 
					            }?>
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="total-section">
						<table class="total-table">
							<thead class="total-table-head">
								<tr class="table-total-row">
									<th colspan="2">Order Details</th>
									
								</tr>
							</thead>
							<tbody>
								<tr class="total-data">
									<td><strong>Order Total: </strong></td>
									<td>$  <?php echo $ordr['totalprice']; ?></td>
								</tr>
								<tr class="total-data">
									<td><strong>Status: </strong></td>
									<td><?php echo $ordr['orderstatus']; ?></td>
								</tr>
								<tr class="total-data">
									<td><strong>Order placed on: </strong></td>
									<td><?php echo $ordr['timestamp']; ?></td>
								</tr>
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
    <?php include 'includes/footer.php' ?>