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
$cart = (isset($_SESSION['cart']))?$_SESSION['cart'] : null;
?>

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						
						<h1>My Orders</h1>
                        <p>View all the orders you placed</p>
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
									
                                    <th class="product-remove"><strong>Order</strong></th>
                                    <th class="product-name"><strong>Date</strong></th>
                                    <th class="product-price"><strong>Status<strong></th>
                                    <th class="product-quantity"><strong>Payment Mode</strong></th>
                                    <th class="product-total"><strong>Total<s/trong></th>
                                    <th class="product-name"><strong>#</strong></th>
								</tr>
							</thead>
							<tbody>
                            <?php
                                    $ordsql = "SELECT * FROM orders  WHERE uid='$uid' ORDER BY id desc";
                                    $ordres = mysqli_query($connection, $ordsql);
                                    
                                    while($ordr = mysqli_fetch_assoc($ordres)){
                                        if($ordr['orderstatus'] == 'Cancelled'){
                                            $color='red';
                                        }
                                        else if($ordr['orderstatus'] == 'Order Placed')
                                        {
                                            $color ='green';
                                        }
                                        else if($ordr['orderstatus'] == 'In Progress')
                                        {
                                            $color='orange';
                                        }
                                        else{
                                            $color='blue';
                                        }
                                ?>
								<tr class="table-body-row">
									<td class="product-remove">CO-<?php echo $ordr['id']; ?></td>
									<td class="product-name"><?php echo $ordr['timestamp']; ?></td>
									<td class="product-price" style='color:<?php echo $color ?>'><?php echo $ordr['orderstatus']; ?></td>
									<td class="product-quantity"><?php echo $ordr['paymentmode']; ?></td>
									<td class="product-total">$<?php echo $ordr['totalprice']; ?></td>
									<td class="product-total"><a href="single-order.php?id=<?php echo $ordr['id']; ?>">View</a>
                                    <?php if($ordr['orderstatus'] != 'Cancelled'){?>
                                    | <a href="cancel-order.php?id=<?php echo $ordr['id']; ?>">Cancel</a>
                                    <?php } ?>
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
    <?php include 'includes/footer.php' ?>