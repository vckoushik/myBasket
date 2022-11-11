<?php 
session_start();
require_once 'config/connect.php';
include 'inc/header.php'; 
require_once 'config/connect.php';
	if(!isset($_SESSION['customer']) & empty($_SESSION['customer'])){
		header('location: login.php');
	}?>
<?php include 'inc/nav.php'; ?>
	
	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container">
				<div class="row">
					<div class="page_header text-center">
						<h2>Shop</h2>
						<p>You can order products from here</p>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div id="shop-mason" class="shop-mason-4col">

							<?php 
								$per_page_record = 4; 
								$page=1;
								if(isset($_GET['page']) && !empty($_GET['page']))
								{
									$page=$_GET['page'];
								} 
								$start_from = ($page-1) * $per_page_record; 
								 
								$sql = "SELECT * FROM products";
								if(isset($_GET['id']) & !empty($_GET['id'])){
									$id = $_GET['id'];
									$sql .= " WHERE catid=$id";
								}
								else if(isset($_GET['search_key']) & !empty($_GET['search_key']))
								{
									$key=$_GET['search_key'];
									$sql .=" WHERE name like '%$key%'";
								}
								$sql .="  LIMIT $start_from, $per_page_record";
						
								$res = mysqli_query($connection, $sql);
								while($r = mysqli_fetch_assoc($res)){
							?>
								<div class="sm-item isotope-item">
									<div class="product">
										<div class="product-thumb">
											<img src="<?php echo $r['thumb']; ?>" class="img-responsive" width="250px" alt="">
											<div class="product-overlay">
												<span>
												<a href="single.php?id=<?php echo $r['id']; ?>" class="fa fa-link"></a>
												<a href="addtocart.php?id=<?php echo $r['id']; ?>" class="fa fa-shopping-cart"></a>
												</span>					
											</div>
										</div>
										<div class="rating">
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
										</div>
										<h2 class="product-title"><a href="single.php?id=<?php echo $r['id']; ?>"><?php echo $r['name']; ?></a></h2>
										<div class="product-price">INR <?php echo $r['price']; ?>.00/-<span></span></div>
									</div>
								</div>
							<?php } ?>

								
							</div>
						</div>
						<div class="clearfix"></div>
						<?php
						$page=1;
						$sql = "SELECT count(*) FROM products";
						if(isset($_GET['id']) & !empty($_GET['id'])){
							$id = $_GET['id'];
							$sql .= " WHERE catid=$id";
						}
						else if(isset($_GET['search_key']) & !empty($_GET['search_key']))
						{
							$key=$_GET['search_key'];
							$sql .=" WHERE name like '%$key%'";
						}

						$rs_result = mysqli_query($connection, $sql);
						$row = mysqli_fetch_row($rs_result);     
						$total_records = $row[0]; 
						$total_pages = ceil($total_records / $per_page_record);     
						$pagLink = ""; 
						echo "<div class='page_nav'>"  ;
						if($page>=2){   
							echo "<a href='index.php?page=".($page-1)."'> <i class='fa fa-angle-left'></i> </a>";   
						} 
						for ($i=1; $i<=$total_pages; $i++) {   
							if ($i == $page) {   
								$pagLink .= "<a class = 'active' href='index.php?page="  
																  .$i."'>".$i." </a>";   
							}               
							else  {   
								$pagLink .= "<a href='index.php?page=".$i."'>   
																  ".$i." </a>";     
							}   
						  };     
						  echo $pagLink;
						  if($page<$total_pages){   
							echo "<a href='index.php?page=".($page+1)."'> <i class='fa fa-angle-right'></i> </a>";   
						}   
						
						?>
						<!-- Pagination 
						<div class="page_nav">
						
						
							<a href=""><i class="fa fa-angle-left"></i></a>
							<a href="" class="active">1</a>
							<a href="">2</a>
							<a href="">3</a>
							<a class="no-active">...</a>
							<a href="">9</a>
							<a href=""><i class="fa fa-angle-right"></i></a>
						</div>
						End Pagination -->
					</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php include 'inc/footer.php' ?>
