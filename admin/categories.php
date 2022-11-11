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
        <span class="dashboard">Categories</span>
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
    $cuSql = "SELECT COUNT(*) as c FROM category";
    $cures = mysqli_query($connection, $cuSql);
    $cus = mysqli_fetch_assoc($cures);


    ?>
    <div class="home-content">
      <div class="overview-boxes">
        
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Categories</div>
            <div class="number"><?php echo $cus['c'] ?></div>
            <div class="indicator">
              <span class="text"></span>
            </div>
          </div>
          <i class='bx bxs-category cart three'></i>
        </div>
      </div>

      <!--table-->
      <div class="container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Category Name</th>
						<th>Description</th>
						<th>Operations</th>
					</tr>
				</thead>
				<tbody>
				<?php 	
					$sql = "SELECT * FROM category";
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
				?>
					<tr>
						<th scope="row"><?php echo $r['id']; ?></th>
						<td><?php echo $r['name']; ?></td>
						<td><?php echo $r['description']; ?></td>
						<td><a href="editcategory.php?id=<?php echo $r['id']; ?>">Edit</a> | <a href="delcategory.php?id=<?php echo $r['id']; ?>">Delete</a></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			
		</div>
      <!-- end of table-->
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