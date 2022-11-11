			<div class="menu-wrap">
				<div id="mobnav-btn">Menu <i class="fa fa-bars"></i></div>
				<ul class="sf-menu">
					<li>
						<a href="index.php">Dashboard</a>
					</li>
					<li>
						<a href="#">Categories</a>
						<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
						<ul>
							<li><a href="categories.php">View Categories</a></li>
							<li><a href="addcategory.php">Add Category</a></li>
						</ul>
					</li>
					<li>
						<a href="#">Products</a>
						<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
						<ul>
							<li><a href="products.php">View Products</a></li>
							<li><a href="addproduct.php">Add Product</a></li>
						</ul>
					</li>

					<li>
						<a href="#">Orders</a>
						<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
						<ul>
							<li><a href="orders.php">View Orders</a></li>
						</ul>
					</li>
					<li>
						<a href="#">Customers</a>
						<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
						<ul>
							<li><a href="customers.php">View Customers</a></li>
							<li><a href="reviews.php">View Reviews</a></li>
						</ul>
					</li>
					<li>
						<a href="#">My Account</a>
						<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
						<ul>
							<li><a href="">Edit Profile</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
				
				<div style="float:right;color:white;padding-top:2rem;font-size:15px;" class="header-xtra s-user">
					<strong>Hi, <?php echo $_SESSION['email']?></strong>
				</div>
			</div>
			
		</div>
	</header>