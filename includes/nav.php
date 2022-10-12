<!-- header -->
<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="index.html">
								<img src="assets/img/logo.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li><a href="shop.php">Home</a></li>
								<li><a href="about.php">About</a></li>
								<li><a href="#">Categories</a>
									<ul class="sub-menu">
									<?php
										$catsql = "SELECT * FROM category";
										$catres = mysqli_query($connection, $catsql);
										while($catr = mysqli_fetch_assoc($catres)){
									?>
										<li><a href="shop.php?id=<?php echo $catr['id']; ?>"><?php echo $catr['name']; ?></a></li>
										<?php } 
										$contains = (isset($_SESSION['cart']) & !empty($_SESSION['cart']))?true:false;
										?>	
									</ul>
								</li>
								<li><a href="news.html">My Account</a>
									<ul class="sub-menu">
										<li><a href="wishlist.php">My WishList</a></li>
										<li><a href="orders-page.php">My Orders</a></li>
										<li><a href="logout.php">Logout</a></li>
									</ul>
								</li>
								<li><a href="contact.html">Contact</a></li>
								<li><a href="shop.html">Shop</a>
									<ul class="sub-menu">
										<li><a href="shop.html">Shop</a></li>
										<li><a href="checkout.html">Check Out</a></li>
										<li><a href="single-product.html">Single Product</a></li>
										<li><a href="cart.html">Cart</a></li>
									</ul>
								</li>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" <?php if((isset($_SESSION['cart']) & !empty($_SESSION['cart'])))
											echo("style='color:orange'");
											else echo(""); ?> href="cart-page.php"><i class="fas fa-shopping-cart"></i></a>
										<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->
	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Search For:</h3>
							<form>
							<input type="text" placeholder="Keywords" name="search_key">
							<button type="submit">Search <i class="fas fa-search"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search arewa -->