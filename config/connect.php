<?php
$connection = mysqli_connect('sql310.epizy.com', '	epiz_32983026', 'HzEgTsKRTb', 'epiz_32983026_ecomphp');
if(!$connection){
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>