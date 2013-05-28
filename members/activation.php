<html>
<body>
<h2>ACTIVATION RESULTS</h2> 
<? 
/* 
Created By Adam Khoury @ www.flashbuilding.com 
-----------------------June 19, 2008-----------------------
*/
//Connect to the database through our include 
include_once "connect_to_mysql.php";
// Get the member id from the URL variable
$id = $_REQUEST['id'];
$id = ereg_replace("[^0-9]", "", $id); // filter everything but numbers for security
if (!$id) {
	echo "Missing Data to Run";
	exit();	
}
// Update the database field named 'email_activated' to 1
$sql = mysql_query("UPDATE members SET emailactivated='1' WHERE id='$id'"); 
// Check the database to see if all is right now 
$sql_doublecheck = mysql_query("SELECT * FROM members WHERE id='$id' AND emailactivated='1'"); 
$doublecheck = mysql_num_rows($sql_doublecheck); 
if($doublecheck == 0){ 
// Print message to the browser saying we could not activate them
print "<br /><br /><div align=\"center\"><h3><strong><font color=red>Your account could not be activated!</font></strong><h3><br /></div>"; 
} elseif ($doublecheck > 0) {
// Print a success message to the browser cuz all is good 
// And supply the user with a link to your log in page, please alter that link line 
print "<br /><br /><h3><font color=\"#0066CC\"><strong>Your account has been activated!<br /><br />
</strong></font><a href=\"http://www.somewebsite.com/login.php\">Click Here</a> to log in now.</h3>"; 
} 
?>
</body>
</html>