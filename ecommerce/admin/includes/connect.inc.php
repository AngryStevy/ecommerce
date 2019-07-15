<?php 
$hostname= "localhost";
$user = "root";
$dbPassword = "";
$dbName = "ecommerce";
$conn = mysqli_connect($hostname,$user,$dbPassword,$dbName) 
or die("the connection to the server failed".mysqli_connect_error());


?>