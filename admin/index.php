<?php
session_start();
require_once '../config/connect.php';
function startsWith($string, $startString)
{
	$len = strlen($startString);
	return (substr($string, 0, $len) === $startString);
}
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
        <span class="dashboard">Dashboard</span>
      </div>
      <div class="profile-details">
        <!--<img src="images/profile.jpg" alt="">-->
        <span class="admin_name"><?php echo $_SESSION['email']?></span>
       
      </div>
    </nav>
    <?php
    //$ordCountSql = "SELECT  FROM orders";
    $ordSql = "SELECT COUNT(*) as c , SUM(totalprice) as tot FROM orders";
    $ores = mysqli_query($connection, $ordSql);
    $ord = mysqli_fetch_assoc($ores);

    $prodSql = "SELECT COUNT(*) as c FROM products";
    $pres = mysqli_query($connection, $prodSql);
    $prd = mysqli_fetch_assoc($pres);

    $cuSql = "SELECT COUNT(*) as c FROM users u JOIN usersmeta u1 WHERE u.id=u1.uid";
    $cures = mysqli_query($connection, $cuSql);
    $cus = mysqli_fetch_assoc($cures);


    ?>
    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Order</div>
            <div class="number"><?php echo $ord['c'] ?></div>
            <div class="indicator">
              <!-- <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span> -->
            </div>
          </div>
          <i class='bx bx-cart-alt cart'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Sales</div>
            <div class="number">$<?php echo round($ord['tot']) ?></div>
            <div class="indicator">
              <!-- <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span> -->
            </div>
          </div>
          <i class='bx bxs-cart-add cart two'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Products</div>
            <div class="number"><?php echo $prd['c'] ?></div>
            <div class="indicator">
              <!-- <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span> -->
            </div>
          </div>
          <i class='bx bx-box cart three'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Customers</div>
            <div class="number"><?php echo $cus['c'] ?></div>
            <div class="indicator">
              
              <span class="text"></span>
            </div>
          </div>
          <i class='bx bxs-user cart four'></i>
        </div>
      </div>

      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">Recent Sales</div>
          <?php
          $sql = "SELECT o.id, o.totalprice, o.orderstatus, o.paymentmode, o.`timestamp`, u.firstname, u.lastname FROM orders o JOIN usersmeta u WHERE o.uid=u.uid ";
          if (isset($_GET) && !empty($_GET)) {
            $skey = $_GET['search_key'];
            if (is_numeric($skey)) {
              $sql .= " AND o.id=$skey";
            } else {
              $sql .= " AND u.firstname LIKE '%$skey%' OR u.lastname LIKE '%$skey%'";
            }
            $sql .= " ORDER BY o.id DESC LIMIT 10";
          }
          $sql .= " ORDER BY o.id DESC LIMIT 10";
          $latestres = mysqli_query($connection, $sql);
          $timearr = array();
          $nameArr = array();
          $statusArr = array();
          $totArr = array();

          while ($r = mysqli_fetch_assoc($latestres)) {

            array_push($timearr, $r['timestamp']);
            array_push($nameArr, $r['firstname'] . " " . $r['lastname']);
            array_push($statusArr, $r['orderstatus']);
            array_push($totArr, $r['totalprice']);
          }
          $count = count($timearr);
          ?>
          <div class="sales-details">
            <ul class="details">
              <li class="topic">Date</li>

              <?php
              for ($i = 0; $i < $count; $i++) {
                echo "<li><a href='#'>$timearr[$i]</a></li>";
              }
              ?>


            </ul>
            <ul class="details">
              <li class="topic">Customer</li>
              <?php
              for ($i = 0; $i < $count; $i++) {
                echo "<li><a href='#'>$nameArr[$i]</a></li>";
              }
              ?>

            </ul>
            <ul class="details">
              <li class="topic">Sales</li>
              <?php
              for ($i = 0; $i < $count; $i++) {
                echo "<li><a href='#'>$statusArr[$i]</a></li>";
              }
              ?>
            </ul>
            <ul class="details">
              <li class="topic">Total</li>
              
              <?php
              for ($i = 0; $i < $count; $i++) {
                echo "<li><a href='#'>$ $totArr[$i]</a></li>";
              }
              ?>
            </ul>
          </div>
         
        </div>
        <div class="top-sales box">
         
          <div class="title">Top Seling Product</div>
          <ul class="top-sales-details">
          <?php
            $topsql = "select thumb,name,price from products where id in (SELECT pid as c from orderitems group by pid order by c DESC) limit 8;";
            $topres = mysqli_query($connection, $topsql);
            
            while ($r = mysqli_fetch_assoc($topres)) {
              $thumb = $r['thumb'];
              if (startsWith($r['thumb'], "http") == false) {
                $thumb = substr($thumb, 6);
              }
              $name =$r['name'];
              $price=$r['price'];
              echo "<li><a href='#'><img src='$thumb' alt=''><span class='product'>$name</span></a><span class='price'>$ $price</span></li>";    
            }
          ?>
            
           
          </ul>
        </div>
      </div>
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