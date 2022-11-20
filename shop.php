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
							<img src="http://www.doritos.com/sites/doritos.com/themes/doritos/img/logo-big.jpg" alt="">
						</div>
						<div class="single-logo-item">
							<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAAB9CAMAAADQgdxqAAAAnFBMVEX////TEUXSAD/SADzRADfRADXRADnTC0PQADDQAC3QADL++vv77e/99/jPACn88fPOAB/44uXPACX00tf55+r33eHXOlnww8rfcYPssLnrq7XvvcXjg5TVN1H119vqpbDXTF7NABPhfYrkipnWLlLaVmrnnabnlKLWQVfdX3bYRF7TIUPdaXrZSmbUJUvheYzaX2nfgYXiipHMAACAiqe7AAAM/UlEQVR4nO1baZuiuBbWBBL2RVRQ3EoFVNDqqfn//+3mnCSgll29lH2rn3l4P8yUEMLZt9CDQY8ePXr06NGjR48ePXr06NGjR48ePXr06PHfQhiHX03CM+BWxbTIv5qKzyOuDcKJM/tqOj6LeEmHAmTqfzUln8QF+RgOI++rKfkU/IJJPrj1U/4+yctF+qeJ+h1sDcnHkB5/wrTSZu84ppn8ebp+FeVoqBn5oZzdpB4RLpaai/8HaT/GuHOG1Gz5aN4v9OJrJYWZw+Valv15In8Ef5Vd6stK/VpRRdqQ2/ceEu6WdV0fWytKlkwv/gsYSc8jg5NpLH+NOdEKMe+yiLczHS5AX9TaNWvXDo2vNi3vSCHUmnP5MzzSlo/X25WrjanEb+zwwlybFcD62tzprwMknBXqQmO1fBS3S+dWp6oKLlRBx8aQD780/sbfpFA5VR7SEcc2t7lwZnfit6EGm+MFbtuSkeILawBvYSo7MtbySmV+j4+1eWVGkSsYw5hA93mKOgw+b1mTZnosf6OS8Mu9pYgjJynOTurmYXyzOA9Q/FQtFw5TY/IoxoMZMELqT/OxtgxCR8Wvtg7u7NCFnEgaVt4GXqO45SMBsjmtjxxW2LOBi0UlK4QA97CN9WkPSaUQzfV36PUfmm6YX0adqaikPDPUJW7eJcIxkE1IKW2P78eDBooYCnzMoAyg28/yMThqbT80rrTJmtJ9d3m2MbsEMORLTAtpy8eoun8JkM/Aw0EzxnaQgy/xQKgtPIGuzM8XyUP5dk7jBzeTb9Vi9s+dG7p5LbWoM1+AfWCrD7a8L/9QDQ5c3cFfZOK/cB3pdo6OYp9EITXCp+MHN7MkSzbJ+Za5JpBsBFOpTXpCPlRU4lF2vxP4NceEia4iCrAGU2gJVyBesON7pf8yUmnrrHnkC8fk9Vx5N4yUKuISMnOTAHUJol4rfbDh/N0uU6pSoA9S47aXG5p/90AgFz6lgq+wB2IPlVvOduk2v6rmQp246UmY4hYjjyg33DcpDm417y10HYBbw187YNzY+Uugnk7ElQW83L53qd9EIba1dw9veecqKa8yQvhNJTziiHA9noKl16FgT16m9vy9Xid7MCxwhxQqXb4MS8jlqCKMD/T0BMNCRvjQ+tYREE+u7oWz3brjw9voDraGRZUjM/LKwsvcaB4lo0wwySC4x6CI4SgdY06ZirUe6JFfHoWZ38CM8OBNy2S1s6MoehBwEUddgDhIGAhY2Ewl06Bp5u1j4fyfnSq+JjZQDXIqwDOsTNqyLXYIMdBEn4pY44l+qbd8YToZTrZDqAF58NjQclsnQMx3U7B0nhYYrgjdtqlg1ViMMUN6/Zmo+LwAKZCzF0PA59wduGiQpnIQd5zsXh85fTgps+MC7oS3Cg9Xu73JgjaVJlqQYWWpEoPbDxlpVIVID7DjDgRLs1TNr9pkE76Z0tIYmEwqtiSXAfRQGAwmgwrChSVC7xu6/iu+3c23xsg0X/JBWs6TK4NYrU+Bxaj1bzx+O02v6pi4OkeQlen+nsz0oAIS5+bhER9hQZSDYLxFRYwSzCV8r/vcwaTtnqCedSGwOaXKF1xcck30i9XgDfRhyJ4l2VBhp9wYpmtmscvhNfddgfG8uBigd7acr/cmYW1F6Fd7vEFZfWeZ/htVZFLGjg/dz21wBTFALrOXobSLrYzeWiErW1DOAqwDhcWuhKnySzJIMM1AClyDp5DGy0AfDFOUt41gPdvPBlmAdseCiEz3dmThfMU4zAcp1ALkrAJPylEu1jDL3dI4X5Ebn5T9y/T2GOuR6LedGvnAwRXZhIM5mpbxpvaBUjbKkrN4TyAWvgqxk8KNa6DUzlwlDX46wgYMQtfAKxwUymGiCiYu/8OvSoXJBR1RZe0F1N3cCCphB43DnWNnVnrCOTQf+7lEtZkWeL+McLGVQH+EbnNEpYcn8csQ2gFyg3jgwzqSpaghAxJrQrsyjU3hmbEjRYGxG1P/iZuU6o6AcLBQWUgxDAzhESISqdHLMwdsXdtMGXElB2H0HzAyCGP0w50MwwZIopS6OSEjO1vm6ViUtFBPz1SihK0tpLRsW3phVxDnvJOMFjVuIAjm+zCtmmM2RXooAe/L5cTPAstyMYwbUyQULYPo4QDof8jYCe1xdU/8ezSmkqqwBb9RUQuIgokWFiNQpYO1bVVFCqqW+r+0XQzDhO5mhtwr0bexlnQHM3yKTiHz+kuZqXAqU7SdjBAY+pCsvoWJGpiVx9By8uHknux7eIVKi6josTQBcgaBCsfntZCEL+iB2OYVbddiLdC8xy/6giGnwkrWrJQaf9E2McOhBj2hd5cyntfih4tS17U6Wpw6ukgOgg9ai+yVBj/DiL9syxQQykwGCQpuCPKh4AgLC2xe7D3UrVakaoeZtizz7A86WfNa3bbVQUSCA0hCkBpvivLA1Ck3GMmEMkeRyuYW3ZxiK5Taylw+wqrWQpZjDyJJxZeA/UP7VEKoAtJ0KYAOi2jU00wFGilraOIRJyJ06+uyTNvbAonnGx80igxilMBkCx4CIqkgbhuy4QBGhvRjH1EHUa1CE0cZCtQjoswdippgDX2UAXabSTKNNqSPpQKEics4qjyMM1nepIJ8B0SC9qMb+ZV8RwRakE4ny5pQyvQlhWoCspKTyV1LeIB9yEjc6kMdGGhvhgk2xlq6OIncx3H+6Y2U2en6ObmopHvR+jU7w4S2gEDxJqoD6UkjtI7JQRoWDDhSKRncPZHXwYRXFwZurquuM/2Rj4Sndq4rDwyg10DKoKZJ0AKwcjDAd8cnfBM3tBQqPTN1SnUpl3NJOQr2G1OFUiUeZGSykWFtCdKQIU4odBKviVTmfiw0gPtWE1nAhCDQx627xlEfRAmF4rq58l2cpM91kU8gJQomFddsHnvjpDzu2xOEVnYqIVGR8gcxHtdFwgrDjTLAzPcrlaoxxLp66E33+jiCVpOT+vO8XKKr4bSTZh9MYOe6jG9lulcijkB2mfpBD8LOwjJoM4YlWpyRSa5GpgE4jTfRs6ihUc2yF3jcBBYTnWzYKFIVKDQOopB80RvwdjNjRCC8gfw4fxGcyGqGfmdOBxhP26epLEM9tTGn7iBu1OYEEsRscz3qbaHfz4fNYrt5axkZmrLJJAfvmpHuOdFFluaqY+T2rrVU0Y8XalDHjQ8GZTunfbKW9aYeWRsL93WkiyO+X5xHD9kQkU7LghNKRfxv2O197KAH48P903QdFsGmDfa3MJalDuvkOJbp2vpgnuF3xwIjFfaPypisPI06bXND7WpfjyPhjXyyuKLc8mTX3/FBVW/xpkvx9vBLOBi0xG+6Zeo4otEuHsRaQMSWFdPlg1H2rPUQ3Z1qpxTBN7FYvbyRF2GbPN7QqwvG0dPeDXAW0L1cPUHrtgEsTEoINUhxVpwQjrXzZGmI6p6wy1FRzo0C8kU8vVEVfzzc0palabC3qhWNVXrjoiJarRNRirZ0c+sEWlvV+iFqn2HzSdSqBzK4f2Vb5qErvN1Zczo1uyQ8aZVQLJUHq2zPSDHPVaqlFxXIixvdjz7wdDh+kKu60dFEM6I70GQ/MgjhhFjBXDrb5BiZBjPt6JjKNZWe5GFPJWpOFTvJqLlxT3/s+aI01pKhjnqFH09iv1T1nnPSvWH6cqWP4OOBn48N0NXoqFUoadpLk6opiiK70qw3r3blVZOTb5htmxudEsNmaJsiZr3/IMpdzS9an+bV8U04YyqUsKtz4J1OMdxZ/uioJd1HQXQdn/3NVcDtrnofnxl5aZ6nnfTdZLbbzdP79BWuG6qiCyfRtttyftZB50bw7twamYyZgb37YSMi5J2ubkZ3SvP89FE58DuIdwbT4Vy4fKtQPyeG9gZ2vH3GT6vXrHonkZ/CSlkmfT+B/wziymwP4LlZdUaXn7pyQTXXT4JqFnl9nD9pEC2wvkD9rKZTV4e9XgNfJhA1vXjux0TjAg2WBNOnbZugDzj7BUbUq7PFGXyZwM1mXeJoqfxgj9+At768RP9eyqc5SV4ziMXb2AdGZDuNeIU4zYLUdWGYbzbPs4AWz7TVSqiDM0gP2HrYOpK6mYXke7JtIodnh5cnYw09pb3zVZ/efYsGYwBZUsAwnH88fft65DDJtiAEYl3NuhoCohXb+vBRG3jQc6Pk04FHWfBVgdQHrVujxUkqFDV4dGu9fSGRPwM4pOPTeBBuobondWs/MZ5qvwoLg9jrFH/A0Z+JsZwin48BlITGoSs1cOLPp/MpnqI+PEj/m5CqA3z8n7W5KpnQ1YcEhyVB9tf/y4G86ykYu/nAsWzbMW6+/eV2JTAxdNc3ym4r8bkeQ7H7zz3/TjQ2pYwZxmtyJ3V/ahDR4VKn+IlDj78B6+2imj2i1d8W02mx/Ss/n/9FhPF/458H9ejRo0ePHj169OjRo0ePHj169OjRo0ePHt/B/wBCKtXHYYMCXAAAAABJRU5ErkJggg==" alt="">
						</div>
						<div class="single-logo-item">
							<img src="data:image/png;base64,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" alt="">
						</div>
						<div class="single-logo-item">
							<img src="https://quaker.co.uk/assets/images/q_brandmark.png" alt="">
						</div>
						<div class="single-logo-item">
						<img src="https://i.pinimg.com/736x/15/44/b2/1544b2472705a9d14ffbdcfb0735dc95--cheetos-logo-google.jpg" alt="">
						</div>
					</div>
				</div>
			</div>
	</div>
	</div>
	<!-- end logo carousel -->
	<?php include 'includes/footer.php' ?>
