<? 
/*  Database Information - Required!!  */
/* -- Configure the Variables Below --*/
$dbhost = 'localhost';
$dbusername = 'root';
$dbpasswd = 'grommit';
$database_name = 'member';

/* Database Stuff, do not modify below this line */

$connection = mysql_pconnect("$dbhost","$dbusername","$dbpasswd") 
	or die ("Couldn't connect to server.");
	
$db = mysql_select_db("$database_name", $connection)
	or die("Couldn't select database.");
?>