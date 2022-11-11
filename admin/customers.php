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
        <span class="dashboard">Customers</span>
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
    $cuSql = "SELECT COUNT(*) as c FROM users u JOIN usersmeta u1 WHERE u.id=u1.uid";
    $cures = mysqli_query($connection, $cuSql);
    $cus = mysqli_fetch_assoc($cures);
    ?>
    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Customers</div>
            <div class="number"><?php echo $cus['c'] ?></div>
            <div class="indicator">
              
            </div>
          </div>
          <i class='bx bxs-user cart four'></i>
        </div>
      </div>

      <!--table-->
      <div class="container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Customer Name</th>
						<th>Customer Mobile</th>
						<th>Customer Email</th>
						<th>Customer From</th>
					</tr>
				</thead>
				<tbody>
				<?php 	
					$sql = "SELECT * FROM users u JOIN usersmeta u1 ON u.id=u1.uid";
          if(isset($_GET) && !empty($_GET))
					{
						$skey = $_GET['search_key'];
						if( is_numeric($skey))
						{
							$sql .= " WHERE u1.uid=$skey";
						}
						else{
							$sql .= " WHERE u1.firstname LIKE '%$skey%' OR u1.firstname LIKE '%$skey%'";
						}
					}
					$res = mysqli_query($connection, $sql); 
					while ($r = mysqli_fetch_assoc($res)) {
				?>
					<tr>
						<th scope="row"><?php echo $r['uid']; ?></th>
						<td><?php echo $r['firstname'] . " " . $r['lastname']; ?></td>
						<td><?php echo $r['mobile']; ?></td>
						<td><?php echo $r['email']; ?></td>
						<td><?php echo $r['timestamp']; ?></td>
						
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