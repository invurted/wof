<?php
$host = "192.168.150.10";
$user = "root";
$pass = "grommit99";
$dbase = "pfinder";

$link = mysql_connect($host, $user, $pass) or die (mysql_error());
mysql_select_db($dbase) or die(mysql_error());
?>
