<?php
ob_start();
session_start();
require_once 'config/connect.php';
$uid = $_SESSION['customerid'];
if(!isset($_SESSION['customer']) & empty($_SESSION['customer'])){
		header('location: login.php');
	}
if(isset($_GET['id']) & !empty($_GET['id'])){
	$pid = $_GET['id'];
	$sql1 = "SELECT * FROM wishlist where uid=$uid ";
	$res1=mysqli_query($connection, $sql1);
	$found=false;
	while($wishr = mysqli_fetch_assoc($res1)){
		if($wishr['pid'] ==$pid)
		{
			$found=true;
			break;
		}
	}
	echo($found);
	if($found==false)
	{	
	echo $sql = "INSERT INTO wishlist (pid, uid) VALUES ($pid, $uid)";
	$res = mysqli_query($connection, $sql);
	}
		header('location: wishlist.php');
		//echo "redirect to wish list page";
	
}
else{
	header('location: wishlist.php');
}

?>