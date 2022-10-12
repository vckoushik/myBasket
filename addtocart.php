<?php
session_start();
if(isset($_GET) & !empty($_GET)){
	$id = $_GET['id'];
	if(isset($_GET['quant']) & !empty($_GET['quant']))
	{ 
		$quant = $_GET['quant']; 
	}else{ 
		$quant = 1;
	}
	if(!isset($_SESSION['cart'][$id] ))
		$_SESSION['cart'][$id] = array("quantity" => $quant); 
	else
		$_SESSION['cart'][$id]["quantity"]+=$quant;
	header('location: cart-page.php');

}else{
	header('location: cart-page.php');
}
echo "<pre>";
print_r($_SESSION['cart']);
echo "</pre>";
?>