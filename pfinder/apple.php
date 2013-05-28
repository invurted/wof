<?php
$host = "192.168.150.10";
$user = "root";
$pass = "grommit99";
$dbname = "pfinder";

// Connect to Database
$link = mysql_connect($host, $user, $pass) or die (mysql_error());
mysql_select_db($dbname) or die();
// mysql_select_db("pfinder") or die(mysql_error());
?>
