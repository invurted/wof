<?php
session_start(); // Must start session first thing
/* 
Created By Adam Khoury @ www.flashbuilding.com 
-----------------------June 20, 2008----------------------- 
*/
// See if they are a logged in member by checking Session data
$toplinks = "";
if (isset($_SESSION['id'])) {
	// Put stored session variables into local php variable
    $userid = $_SESSION['id'];
    $username = $_SESSION['username'];
	$toplinks = '<a href="member_profile.php?id=' . $userid . '">' . $username . '</a> &bull; 
	<a href="member_account.php">Account</a> &bull; 
	<a href="logout.php">Log Out</a>';
} else {
	echo 'Please <a href="login.php">log in</a> to access your account';
    exit(); 
}
?>
<?php
//Connect to the database through our include 
include_once "connect_to_mysql.php";
// Query member data from the database and ready it for display
$sql = mysql_query("SELECT * FROM members WHERE id='$userid'"); 
while($row = mysql_fetch_array($sql)){
$country = $row["country"];
$state = $row["state"];
$city = $row["city"];
$accounttype = $row["accounttype"];	
$bio = $row["bio"];	
}
// Give different options or display depending on which user type it is
if ($accounttype == "a") {
	$userOptions = "You get options for Normal User";
} else if ($accounttype == "b") {
	$userOptions = "You get options for Expert User";
} else {
	$userOptions = "You get options for Super User";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Member Account</title>
<style type="text/css">
<!--
body {margin: 0px}
-->
</style>
</head>
<body>
<table style="background-color: #CCC" width="100%" border="0" cellpadding="12">
  <tr>
    <td width="78%"><h1>My Logo Image</h1></td>
    <td width="22%"><?php echo $toplinks; ?></td>
  </tr>
</table>
<h3><?php echo "$username"; ?></h3>
<table width="768" cellpadding="3" cellspacing="3" style="line-height:1.5em;">
  <tr>
    <td width="139" valign="top" bgcolor="#E4E4E4">YOUR ACCOUNT<br />
        <a href="edit_info.php" target="_self">Edit Information </a><br />
    <a href="edit_pic.php" target="_self">Edit Picture</a><br />	
	<a href="member_profile.php?id=<?php echo "$userid"; ?>" target="_self">View Profile</a><br />
	</td>
     <!-- See the more advanced member system tutorial to see how to place default placeholder pic until member uploads one -->
    <td width="174" valign="top"><div align="center"><img src="memberFiles/<?php echo "$userid"; ?>/pic1.jpg" alt="Ad" width="150" /></div></td>
    <td width="423" valign="top">
      Country: <?php echo "$country"; ?> <br />
      State: <?php echo "$state"; ?><br />
      City: <?php echo "$city"; ?><br />
    </td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">Bio:<br />
        <br />
      <br />
    <?php echo "$bio"; ?></td>
  </tr>
</table>
</body>
</html>