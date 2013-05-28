<?php
$dbhost = "localhost";
$dbuser = "invurted_pfinder";
$dbpass = "JTczKOmnE6.a7Rq?bU";
$dbname = "invurted_playerfinder";

$conn = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error());
mysql_select_db($dbname,$conn) or die(mysql_error());

?>

