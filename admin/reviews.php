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
        <span class="dashboard">Reviews</span>
      </div>
      <div class="profile-details">
        <!--<img src="images/profile.jpg" alt="">-->
        <span class="admin_name"><?php echo $_SESSION['email']?></span>
       
      </div>
    </nav>
    <?php
    //$ordCountSql = "SELECT  FROM orders";


    $cuSql = "SELECT count(r.id) as c FROM reviews r JOIN products p WHERE r.pid=p.id";
    $cures = mysqli_query($connection, $cuSql);
    $cus = mysqli_fetch_assoc($cures);


    ?>
    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Reviews</div>
            <div class="number"><?php echo $cus['c'] ?></div>
            <div class="indicator">
              <span class="text"></span>
            </div>
          </div>
          <i class='bx bxs-message cart four'></i>
        </div>
      </div>

      <!--table-->
      <div class="container">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Product Name</th>
						<th>Review</th>
						<th>Posted On</th>
					</tr>
				</thead>
				<tbody>
				<?php 	
					$sql = "SELECT r.id, p.name, r.review, r.`timestamp` FROM reviews r JOIN products p WHERE r.pid=p.id";
					$res = mysqli_query($connection, $sql); 
					while ($r = mysqli_fetch_assoc($res)) {
				?>
					<tr>
						<th scope="row"><?php echo $r['id']; ?></th>
						<td><?php echo substr($r['name'], 0, 20); ?></td>
						<td><?php echo $r['review']; ?></td>
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