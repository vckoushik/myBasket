<?php 
session_start();
require_once 'config/connect.php';
include 'includes/header.php';
include 'includes/nav.php';
	if(!isset($_SESSION['customer']) & empty($_SESSION['customer'])){
		header('location: login.php');
	}
?>
<script>
	window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}
</script>
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<?php 
						if(!isset($_GET['id']))
						{
							
							echo("<h1>Shop</h1><p>Shop your favourite products.</p>");
						}
						else{
							$catid=$_GET['id'];
							$csql = "SELECT * FROM category WHERE id=$catid";
							$cres = mysqli_query($connection, $csql);
							$cr=mysqli_fetch_row($cres);
							
							echo("<h1>$cr[1]</h1><p>$cr[3]</p>");
						}
						?>
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- products -->
	<div class="product-section mt-150 mb-150">
		<div class="container">

			<div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                    <ul>
                    <?php if(isset($_GET['id'])) {?>
                        <li data-filter="*"><a style="color: inherit;text-decoration: inherit;" href="shop.php">All</a></li>
                    <?php } else{ ?>
                        <li class='active' data-filter="*"><a style="color: inherit;text-decoration: inherit;" href="shop.php">All</a></li>

                    <?php }
							$catsql = "SELECT * FROM category LIMIT 6";
							$catres = mysqli_query($connection, $catsql);
                            
							while($catr = mysqli_fetch_assoc($catres)){
                            $cid =$catr['id'];
                            $cname=$catr['name'];
                             
                            
                            
                            if(isset($_GET['id'])){
                                if ($_GET['id']== $catr['id']){
                                    echo("<li class='active' data-filter='.strawberry'><a style='color: inherit;text-decoration: inherit;' href='shop.php?id=$cid'>$cname</a></li>");
                                }
                                else{
                                echo("<li  data-filter='.strawberry'><a style='color: inherit;text-decoration: inherit;' href='shop.php?id=$cid'>$cname</a></li>");

                                }
                            }
                            else
                                echo("<li  data-filter='.strawberry'><a style='color: inherit;text-decoration: inherit;' href='shop.php?id=$cid'>$cname</a></li>");
                            
                            
                        }?>
                            
                        </ul>
                    </div>
                </div>
            </div>

			<div class="row product-lists">
            <?php 
								$rcount =0;
								$per_page_record = 30 ; 
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
                                $name=$r['name'];
                                $name=substr($name,0,30);
								
								if($rcount%3==0 && $rcount!=0)
								{
									echo "<div class='row product-lists'>";
								}
								$rcount+=1;
							?>
				
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item" >
						<div class="product-image" >
							<a  href="single-product.php?id=<?php echo $r['id']; ?>"><img src="<?php echo $r['thumb']; ?>" alt=""></a>
						</div>
						<h3><?php echo $name ?></h3>
						<p class="product-price"><span>Per Kg</span>$ <?php echo $r['price']; ?> </p>
						<a href="addtocart.php?id=<?php echo $r['id']; ?>" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
				<?php
				if($rcount%3==0 && $rcount!=0)
				{
					echo "</div> ";
				}
				}?>
			</div>
            
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="pagination-wrap">
						<ul>
                        <?php
						
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
						
						if($page>=2){   
							echo "<li><a href='shop.php?page=".($page-1)."'> <i class='fa fa-angle-left'></i> </a></li>";   
						} 
						for ($i=1; $i<=$total_pages; $i++) {   
							if ($i == $page) {
								if(isset($_GET['id']) & !empty($_GET['id']))
								{
									$catid=$_GET['id'];
									$pageparam = $i."&id=".$catid;
									
									$pagLink .= "<li><a class = 'active' href='shop.php?page=$pageparam'>".$i." </a>/<li>";   
								}
								else
									$pagLink .= "<li><a class = 'active' href='shop.php?page=".$i."'>".$i." </a>/<li>";   
							}               
							else  {  
								if(isset($_GET['id']) & !empty($_GET['id']))
								{
									$catid=$_GET['id'];
									$pageparam = $i."&id=".$catid;
									
									$pagLink .= "<li><a  href='shop.php?page=$pageparam'>".$i." </a>/<li>";   
								}
								else 
									$pagLink .= "<li><a href='shop.php?page=".$i."'>".$i." </a></li>";     
							}   
						  };     
						  echo $pagLink;
						  if($page<$total_pages){   
							echo "<li><a href='shop.php?page=".($page+1)."'> <i class='fa fa-angle-right'></i> </a></li>";   
						}   
						
						?>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end products -->

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
