<?php
	session_start();
	require_once '../config/connect.php';
	if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
		header('location: login.php');
	}
?>
<?php include 'inc/header.php'; ?>
<?php 	
    $sales=[];
    for ($i = 1; $i <= 6; $i++) 
    {
      $months[] = date("Y-m%", strtotime( date( 'Y-m-01' )." -$i months"));
    }
    //var_dump($months);
    //echo $month;
          for($i=0;$i<4;$i++)
          {

          $sql1= "SELECT SUM(totalprice) from orders where MONTH(timestamp)=(MONTH(now())-$i) and YEAR(timestamp)=YEAR(now())";
					//$sql = "SELECT o.id, o.totalprice, o.orderstatus, o.paymentmode, o.`timestamp`, u.firstname, u.lastname FROM orders o JOIN usersmeta u WHERE o.uid=u.uid ORDER BY o.id DESC";
					$res = mysqli_query($connection, $sql1); 
            while ($r = mysqli_fetch_row($res))
          {
              
              if(isset($r[0]))
                $sales[$i]= $r[0];
              else
                $sales[$i]=0;
          }
        }
       // print_r($sales);
				?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChart1);
      
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          <?php for($i=0;$i<4;$i++) {
            echo"[";
            
            ?>
          ['2004',  10000,      400],
         <?php }?>
        ]);

        var options = {
          title: 'Weekly Revenue',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
      function drawChart1() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  10000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Weekly Orders',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart1'));

        chart.draw(data, options);
      }
    </script>
<?php include 'inc/nav.php'; ?>
	
	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container">
				<div class="row">
					<div class="page_header text-center">
						<h2>Dashboard</h2>
						<!-- <p>You can order products from here</p> -->
					</div>
          
					<div class="col-md-6">
						<div class="row">
							<div id="curve_chart" style="width: 550px; height: 300px"></div>
						</div>

					</div>

					<div class="col-md-6">
						<div class="row">
							<div id="curve_chart1" style="width: 550px; height: 300px"></div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
<?php include 'inc/footer.php' ?>
