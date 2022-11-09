<?php 
session_start();
require_once 'config/connect.php'; 
$uid = $_SESSION['customerid'];
if(isset($_POST) & !empty($_POST)){
	
	$review = filter_var($_POST['review'], FILTER_SANITIZE_STRING);
	$pid= $_POST['prodid'];
	$stars=$_POST['stars'];
	$revsql = "INSERT INTO reviews (pid, uid, review,stars) VALUES ($pid, $uid, '$review','$stars')";
	$revres = mysqli_query($connection, $revsql);
	if($revres){
		$smsg = "Review Submitted Successfully";
	}else{
		$fmsg = "Failed to Submit Review";
	}
	
	header("location: single-product.php?id={$pid}");
}
?>