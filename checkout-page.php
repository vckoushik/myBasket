<?php 
ob_start();
session_start();
require_once 'config/connect.php';
include 'includes/header.php'; 
include 'includes/nav.php'; 
require_once 'process-order.php';
if(!isset($_SESSION['customer']) & empty($_SESSION['customer'])){
	header('location: login.php');
}
$cart = isset($_SESSION['cart'])?$_SESSION['cart']:null;
$uid = $_SESSION['customerid'];
$form2=false;
if(isset($_POST) & !empty($_POST)){
	if($_POST['agree'] == true){
		$country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
		$fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
		$lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
		$company = filter_var($_POST['company'], FILTER_SANITIZE_STRING);
		$address1 = filter_var($_POST['address1'], FILTER_SANITIZE_STRING);
		$address2 = filter_var($_POST['address2'], FILTER_SANITIZE_STRING);
		$city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
		$state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
		$phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
		$payment = filter_var($_POST['payment'], FILTER_SANITIZE_STRING);
		$zip = filter_var($_POST['zipcode'], FILTER_SANITIZE_NUMBER_INT);
		
		$sql = "SELECT * FROM usersmeta WHERE uid=$uid";
		$res = mysqli_query($connection, $sql);
		$r = mysqli_fetch_assoc($res);
		$count = mysqli_num_rows($res);
		
		if($count == 1){
			//update data in usersmeta table
			$orderid =null;
			$usql = "UPDATE usersmeta SET country='$country', firstname='$fname', lastname='$lname', address1='$address1', address2='$address2', city='$city', state='$state',  zip='$zip', company='$company', mobile='$phone' WHERE uid=$uid";
			$ures = mysqli_query($connection, $usql) or die(mysqli_error($connection));
			if($ures){

				$total = 0;
				foreach ($cart as $key => $value) {
					//echo $key . " : " . $value['quantity'] ."<br>";
					$ordsql = "SELECT * FROM products WHERE id=$key";
					$ordres = mysqli_query($connection, $ordsql);
					$ordr = mysqli_fetch_assoc($ordres);

					$total = $total + ($ordr['price']*$value['quantity']);
				}

				$iosql = "INSERT INTO orders (uid, totalprice, orderstatus, paymentmode) VALUES ('$uid', '$total', 'Order Placed', '$payment')";
				$iores = mysqli_query($connection, $iosql) or die(mysqli_error($connection));
				if($iores){
					//echo "Order inserted, insert order items <br>";
					$orderid = mysqli_insert_id($connection);
					foreach ($cart as $key => $value) {
						//echo $key . " : " . $value['quantity'] ."<br>";
						$ordsql = "SELECT * FROM products WHERE id=$key";
						$ordres = mysqli_query($connection, $ordsql);
						$ordr = mysqli_fetch_assoc($ordres);

						$pid = $ordr['id'];
						$productprice = $ordr['price'];
						$quantity = $value['quantity'];


						$orditmsql = "INSERT INTO orderitems (pid, orderid, productprice, pquantity) VALUES ('$pid', '$orderid', '$productprice', '$quantity')";
						$orditmres = mysqli_query($connection, $orditmsql) or die(mysqli_error($connection));
						$orderid = mysqli_insert_id($connection);
					}
				}
				// if(isset($_POST['zipcode']) & !empty($_POST['zipcode']))
				// 	sendmail($_SESSION['customer'], $orderid);
				if($payment == "cod")
					header("location:thank-you.php");
				else{
					$form2=true;
				}
				
			
				
			}
		}else{
			//insert data in usersmeta table
			$isql = "INSERT INTO usersmeta (country, firstname, lastname, address1, address2, city, state, zip, company, mobile, uid) VALUES ('$country', '$fname', '$lname', '$address1', '$address2', '$city', '$state', '$zip', '$company', '$phone', '$uid')";
			$ires = mysqli_query($connection, $isql) or die(mysqli_error($connection));
			if($ires){

				$total = 0;
				foreach ($cart as $key => $value) {
					//echo $key . " : " . $value['quantity'] ."<br>";
					$ordsql = "SELECT * FROM products WHERE id=$key";
					$ordres = mysqli_query($connection, $ordsql);
					$ordr = mysqli_fetch_assoc($ordres);

					$total = $total + ($ordr['price']*$value['quantity']);
				}

				$iosql = "INSERT INTO orders (uid, totalprice, orderstatus, paymentmode) VALUES ('$uid', '$total', 'Order Placed', '$payment')";
				$iores = mysqli_query($connection, $iosql) or die(mysqli_error($connection));
				if($iores){
					//echo "Order inserted, insert order items <br>";
					$orderid = mysqli_insert_id($connection);
					foreach ($cart as $key => $value) {
						//echo $key . " : " . $value['quantity'] ."<br>";
						$ordsql = "SELECT * FROM products WHERE id=$key";
						$ordres = mysqli_query($connection, $ordsql);
						$ordr = mysqli_fetch_assoc($ordres);

						$pid = $ordr['id'];
						$productprice = $ordr['price'];
						$quantity = $value['quantity'];


						$orditmsql = "INSERT INTO orderitems (pid, orderid, productprice, pquantity) VALUES ('$pid', '$orderid', '$productprice', '$quantity')";
						$orditmres = mysqli_query($connection, $orditmsql) or die(mysqli_error($connection));
						//if($orditmres){
							//echo "Order Item inserted redirect to my account page <br>";
						//}
					}
				}
				header("location:thank-you.php");
			}

		}
	}

}

$sql = "SELECT * FROM usersmeta WHERE uid=$uid";
$res = mysqli_query($connection, $sql);
$r = mysqli_fetch_assoc($res);

?>
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Fresh and Organic</p>
						<h1>Check Out Product</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- check out section -->
    
	<div class="checkout-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
                
					<div class="checkout-accordion-wrap">
						<div class="accordion" id="accordionExample">
						  <div class="card single-accordion">
						    <div class="card-header" id="headingOne">
						      <h5 class="mb-0">
						        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						          Shipping Address
						        </button>
						      </h5>
						    </div>

						    <div id="collapseOne" class="collapse <?php echo ($form2!=true)?"show":"";?>" aria-labelledby="headingOne" data-parent="#accordionExample">
						      <div class="card-body">
						        <div class="billing-address-form">
                                <form method="post">
										
                                        <label>First </label>
                                        <p><input name="fname"  placeholder="Firstname" value="<?php if(!empty($r['firstname'])){ echo $r['firstname']; } elseif(isset($fname)){ echo $fname; } ?>" type="text"></p>
                                        <label>LastName</label>
                                        <p><input name="lname"  placeholder="Lastname" value="<?php if(!empty($r['lastname'])){ echo $r['lastname']; } elseif(isset($lname)){ echo $lname; } ?>" type="text"></p>
						        		<label>Company </label>
                                        <p><input name="company" type="text" placeholder="Company" value="<?php if(!empty($r['company'])){ echo $r['company']; }elseif(isset($company)){ echo $company; } ?>"></p>
                                        <label>Address </label>
                                        <p><input name="address1" placeholder="Street address" value="<?php if(!empty($r['address1'])){ echo $r['address1']; } elseif(isset($address1)){ echo $address1; } ?>" type="text"></p>
							            <p><input name="address2"  placeholder="Apartment, suite, unit etc. (optional)" value="<?php if(!empty($r['address2'])){ echo $r['address2']; }elseif(isset($address2)){ echo $address2; } ?>" type="text"></p>
						        		<label>City </label>
                                        <p><input name="city"  placeholder="City" value="<?php if(!empty($r['city'])){ echo $r['city']; }elseif(isset($city)){ echo $city; } ?>" type="text"></p>
						        		<label>State </label>
                                        <p><input name="state"  value="<?php if(!empty($r['state'])){ echo $r['state']; }elseif(isset($state)){ echo $state; } ?>" placeholder="State" type="text"></p>
						        		<label>Postal Code </label>
                                        <p><input name="zipcode"  placeholder="Postcode / Zip" value="<?php if(!empty($r['zip'])){ echo $r['zip']; }elseif(isset($zip)){ echo $zip; } ?>" type="text"></p>
                                        <label>Country </label>
										<p><input name="country"  placeholder="Country" value="<?php if(!empty($r['country'])){ echo $r['country']; }elseif(isset($country)){ echo $country; } ?>" type="text"></p>
										<label>Phone </label>
                                        <p><input name="phone"  id="billing_phone" placeholder="" value="<?php if(!empty($r['mobile'])){ echo $r['mobile']; }elseif(isset($phone)){ echo $phone; } ?>" type="text"></p>
                                        
                                        <p><textarea name="bill" id="bill" cols="30" rows="10" placeholder="Say Something"></textarea></p>
										<label>Choose a Payment Method</label><br>
										<input name="payment" id="radio1" class="css-checkbox" type="radio" value="cod"><span> Cash On Delivery</span><br>
                                        <input name="payment" id="radio3" class="css-checkbox" type="radio" value="card"><span> Card Payment</span><br><br>
                                    
										<input name="agree" id="checkboxG2" class="css-checkbox" type="checkbox" value="true"> I've read and accept the term conditions</br>
										<p><input type="submit"></p>
								</form>
						        </div>
						      </div>
						    </div>
						  </div>
						  <div class="card single-accordion">
						    <div class="card-header" id="headingTwo">
						      <h5 class="mb-0">
						        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						          Card Payment
						        </button>
						      </h5>
						    </div>
						    <div id="collapseTwo" class="collapse <?php echo ($form2==true)?"show":"";?>" aria-labelledby="headingTwo" data-parent="#accordionExample">
						      <div class="card-body">
						        <div class="billing-address-form">
                                    <form method="post" action="processcard.php">
						        	<p>Enter your card details</p>
									<p><input type="text" name="cardnum" placeholder="card number" required></p>
									<p><input type="text" name="cardname" placeholder="Name on the Card" required></p>
									<p><input type="text" name="expiry" placeholder="Expiry MM/YY" required></p>
									<p><input type="text" name="cardcvv" placeholder="CVV" required></p>
                                    <p><input type="submit" value="pay"></p>
								</form>
                                </div>
						      </div>
						    </div>
						  </div>
						  
						</div>
                        
					</div>
				</div>

				
				</div>
			</div>
		</div>
	
</div>
	<!-- end check out section -->

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