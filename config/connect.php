<?php
$connection = mysqli_connect('sql12.freesqldatabase.com','sql12564317', 'L2BaJie2XV', 'sql12564317');
if(!$connection){
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>
