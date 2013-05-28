<?php
session_start(); // Must start session first thing
/* 
Created By Adam Khoury @ www.flashbuilding.com 
-----------------------June 20, 2008----------------------- 
*/
// Here we run a login check
if (!isset($_SESSION['id'])) { 
   echo 'Please <a href="login.php">log in</a> to access your account';
   exit(); 
}
//Connect to the database through our include 
include_once "connect_to_mysql.php";
// Place Session variable 'id' into local variable
$id = $_SESSION['id'];
// Process the form if it is submitted
if ($_POST['state']) {
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $bio = $_POST['bio'];
    $sql = mysql_query("UPDATE members SET country='$country', state='$state', city='$city', bio='$bio' WHERE id='$id'"); 
    echo 'Your account info has been updated, visitors to your profile will now see the new info.<br /><br />
To return to your profile edit area, <a href="member_account.php">click here</a>';
exit();
} // close if post
?>
<?php
// Query member data from the database and ready it for display
$sql = mysql_query("SELECT * FROM members WHERE id='$id' LIMIT 1");
while($row = mysql_fetch_array($sql)){
$country = $row["country"];
$state = $row["state"];
$city = $row["city"];
$accounttype = $row["accounttype"];
$bio = $row["bio"];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Your Account Info</title>
<script type="text/javascript">
<!-- Form Validation -->
function validate_form ( ) { 
valid = true; 
if ( document.form.country.value == "" ) { 
alert ( "State must not be blank." ); 
valid = false;
}
if ( document.form.state.value == "" ) { 
alert ( "State must not be blank." ); 
valid = false;
}
if ( document.form.city.value == "" ) { 
alert ( "City must not be blank." ); 
valid = false;
}
return valid;
}
<!-- Form Validation -->
</script>
</head>
<body>
     <div align="center">
       <h3><br />
         Edit your account info here<br />  
       <br />
       </h3>
     </div>
     <table align="center" cellpadding="8" cellspacing="8">
      <form action="edit_info.php" method="post" enctype="multipart/form-data" name="form" id="form" onsubmit="return validate_form ( );">
     <tr>
      <td>Country:</td>
      <td><select name="country">
      <option value="<?php echo "$country"; ?>"><?php echo "$country"; ?></option>
      <option value="Australia">Australia</option>
      <option value="Canada">Canada</option>
      <option value="Mexico">Mexico</option>
      <option value="United Kingdom">United Kingdom</option>
      <option value="United States">United States</option>
      <option value="Zimbabwe">Zimbabwe</option>
      </select></td>
    </tr>
        <tr>
          <td><div align="right">State:</div></td>
          <td><input name="state" type="text" id="state" value="<?php echo "$state"; ?>" size="30" maxlength="64" /></td>
        </tr>  
        <tr>
          <td><div align="right">City:</div></td>
          <td><input name="city" type="text" id="city" value="<?php echo "$city"; ?>" size="30" maxlength="24" /></td>
        </tr>
        <tr>
          <td class="style7"><div align="right">Bio:</div></td>
          <td><textarea name="bio" cols="42" rows="8" id="bio"><?php echo "$bio"; ?></textarea></td>
        </tr>				
        <tr>
          <td>&nbsp;</td>
          <td><input name="Submit" type="submit" value="Submit Changes" /></td>
        </tr>
      </form>
</table>
</body>
</html>