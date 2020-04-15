<?php

//login to phpmyadmin
$dbHost = "127.0.0.1";
$dbUser = "ahmad13";
$dbPassword="";
$db1Name = "c9_tables";
$db2Name = "loginsystem";
$dbPort = "3306";

$conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $db1Name, $dbPort);
$conn2 = mysqli_connect($dbHost, $dbUser, $dbPassword, $db2Name, $dbPort);

?>      