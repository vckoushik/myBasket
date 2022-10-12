<?php
session_start();
require_once 'config/connect.php';
if(!isset($_SESSION['customer']) & empty($_SESSION['customer'])){
	header('location: login.php');
}
$uid = $_SESSION['customerid'];
if(isset($_POST) & !empty($_POST)){

        $cardnum = $_POST['cardnum'];
        $cardname = $_POST['cardname'];
        $expiry = $_POST['expiry'];
        $cvv=$_POST['cardcvv'];
        $sql ="INSERT INTO carddetails(uid,cardnumber,cardname,expiry,cvv) VALUES('$uid','$cardnum','$cardname','$expiry','$cvv')";
        $res = mysqli_query($connection, $sql);
        if($res)
        {
            header("location:thank-you.php");
        }
        else{
            header("location:checkout-page.php");
        }
    }
?>