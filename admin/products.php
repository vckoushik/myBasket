<?php
session_start();
require_once '../config/connect.php';
if (!isset($_SESSION['email']) & empty($_SESSION['email'])) {
  header('location: login.php');
  //  echo basename(__FILE__)
}
?>
<?php include 'includes/header.php'; ?>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Products</span>
      </div>
      <form class="search-box" id="search">
      
        <input type="text" name="search_key" placeholder="Search..." autocomplete="off">
        <i class='bx bx-search' onclick="document.getElementById('search').submit();"></i>
      
      </form>
      <div class="profile-details">
        <!--<img src="images/profile.jpg" alt="">-->
        <span class="admin_name"><?php echo $_SESSION['email']?></span>
       
      </div>
    </nav>
    <?php
    //$ordCountSql = "SELECT  FROM orders";

    $prodSql = "SELECT COUNT(*) as c FROM products";
    $pres = mysqli_query($connection, $prodSql);
    $prd = mysqli_fetch_assoc($pres);


    ?>
    <div class="home-content">
      <div class="overview-boxes">
        
        
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Products</div>
            <div class="number"><?php echo $prd['c'] ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bxs-box cart three'></i>
        </div>
        
      </div>
      <div class="container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Product Name</th>
						<th>Category Name</th>
						<th>Thumbnail</th>
						<th>Operations</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = "SELECT * FROM products";
					if(isset($_GET) && !empty($_GET))
					{
						$skey = $_GET['search_key'];
						if( is_numeric($skey))
						{
							$sql .= " WHERE id=$skey";
						}
						else{
							$sql .= " WHERE name LIKE '%$skey%'";
						}
					}

					$res = mysqli_query($connection, $sql);
					while ($r = mysqli_fetch_assoc($res)) {
            $thumb=$r['thumb'];
					?>
						<tr>
							<th scope="row"><?php echo $r['id']; ?></th>
							<td><span class='product'><?php echo $r['name']; ?></span></td>
							<td><?php echo $r['catid']; ?></td>
							<td><?php if ($r['thumb']) {
									echo "Yes";
								} else {
									echo "No";
								} ?></td>
							<td><a href="editproduct.php?id=<?php echo $r['id']; ?>">Edit</a> | <a href="delproduct.php?id=<?php echo $r['id']; ?>">Delete</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

		</div>
	
      
  </section>

  <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
      sidebar.classList.toggle("active");
      if (sidebar.classList.contains("active")) {
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
  </script>

</body>

</html>