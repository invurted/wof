<?php
/* 
Created By Adam Khoury @ www.flashbuilding.com 
-----------------------June 20, 2008----------------------- 
*/
// Set error message as blank upon arrival to page
$errorMsg = "";
// First we check to see if the form has been submitted 
if (isset($_POST['username'])){
	//Connect to the database through our include 
	include_once "connect_to_mysql.php";
	// Filter the posted variables
	$username = ereg_replace("[^A-Za-z0-9]", "", $_POST['username']); // filter everything but numbers and letters
	$country = ereg_replace("[^A-Z a-z0-9]", "", $_POST['country']); // filter everything but spaces, numbers, and letters
	$state = ereg_replace("[^A-Z a-z0-9]", "", $_POST['state']); // filter everything but spaces, numbers, and letters
	$city = ereg_replace("[^A-Z a-z0-9]", "", $_POST['city']); // filter everything but spaces, numbers, and letters
	$accounttype = ereg_replace("[^a-z]", "", $_POST['accounttype']); // filter everything but lowercase letters
	$email = stripslashes($_POST['email']);
	$email = strip_tags($email);
	$email = mysql_real_escape_string($email);
	$password = ereg_replace("[^A-Za-z0-9]", "", $_POST['password']); // filter everything but numbers and letters
	// Check to see if the user filled all fields with
	// the "Required"(*) symbol next to them in the join form
	// and print out to them what they have forgotten to put in
	if((!$username) || (!$country) || (!$state) || (!$city) || (!$accounttype) || (!$email) || (!$password)){
		
		$errorMsg = "You did not submit the following required information!<br /><br />";
		if(!$username){
			$errorMsg .= "--- User Name";
		} else if(!$country){
			$errorMsg .= "--- Country"; 
		} else if(!$state){ 
		    $errorMsg .= "--- State"; 
	   } else if(!$city){ 
	       $errorMsg .= "--- City"; 
	   } else if(!$accounttype){ 
	       $errorMsg .= "--- Account Type"; 
	   } else if(!$email){ 
	       $errorMsg .= "--- Email Address"; 
	   } else if(!$password){ 
	       $errorMsg .= "--- Password"; 
	   }
	} else {
	// Database duplicate Fields Check
	$sql_username_check = mysql_query("SELECT id FROM members WHERE username='$username' LIMIT 1");
	$sql_email_check = mysql_query("SELECT id FROM members WHERE email='$email' LIMIT 1");
	$username_check = mysql_num_rows($sql_username_check);
	$email_check = mysql_num_rows($sql_email_check); 
	if ($username_check > 0){ 
		$errorMsg = "<u>ERROR:</u><br />Your User Name is already in use inside our system. Please try another.";
	} else if ($email_check > 0){ 
		$errorMsg = "<u>ERROR:</u><br />Your Email address is already in use inside our system. Please try another.";
	} else {
		// Add MD5 Hash to the password variable
       $hashedPass = md5($password); 
		// Add user info into the database table, claim your fields then values 
		$sql = mysql_query("INSERT INTO members (username, country, state, city, accounttype, email, password, signupdate) 
		VALUES('$username','$country','$state','$city','$accounttype','$email','$hashedPass', now())") or die (mysql_error());
		// Get the inserted ID here to use in the activation email
		$id = mysql_insert_id();
		// Create directory(folder) to hold each user files(pics, MP3s, etc.) 
		mkdir("memberFiles/$id", 0755); 
		// Start assembly of Email Member the activation link
		$to = "$email";
		// Change this to your site admin email
		$from = "admin@somewebsite.com";
		$subject = "Complete your registration";
		//Begin HTML Email Message where you need to change the activation URL inside
		$message = '<html>
		<body bgcolor="#FFFFFF">
		Hi ' . $username . ',
		<br /><br />
		You must complete this step to activate your account with us.
		<br /><br />
		Please click here to activate now &gt;&gt;
		<a href="http://www.somewebsite.com/activation.php?id=' . $id . '">
		ACTIVATE NOW</a>
		<br /><br />
		Your Login Data is as follows: 
		<br /><br />
		E-mail Address: ' . $email . ' <br />
		Password: ' . $password . ' 
		<br /><br /> 
		Thanks! 
		</body>
		</html>';
		// end of message
		$headers = "From: $from\r\n";
		$headers .= "Content-type: text/html\r\n";
		$to = "$to";
		// Finally send the activation email to the member
		mail($to, $subject, $message, $headers);
		// Then print a message to the browser for the joiner 
		print "<br /><br /><br /><h4>OK $firstname, one last step to verify your email identity:</h4><br />
		We just sent an Activation link to: $email<br /><br />
		<strong><font color=\"#990000\">Please check your email inbox in a moment</font></strong> to click on the Activation <br />
		Link inside the message. After email activation you can log in.";
		exit(); // Exit so the form and page does not display, just this success message
	} // Close else after database duplicate field value checks
  } // Close else after missing vars check
} //Close if $_POST
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Member Registration</title>
</head>
<body>
<table width="600" align="center" cellpadding="4">
  <tr>
    <td width="7%">REGISTER AS A MEMBER HERE </td>
  </tr>
</table>
<table width="600" align="center" cellpadding="5">
  <form action="join_form.php" method="post" enctype="multipart/form-data">
    <tr>
      <td colspan="2"><font color="#FF0000"><?php echo "$errorMsg"; ?></font></td>
    </tr>
    <tr>
      <td width="163"><div align="right">User Name:</div></td>
      <td width="409"><input name="username" type="text" value="<?php echo "$username"; ?>" /></td>
    </tr>
    <tr>
      <td><div align="right">Country:</div></td>
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
      <td><div align="right">State: </div></td>
      <td><input name="state" type="text" value="<?php echo "$state"; ?>" /></td>
    </tr>
    <tr>
      <td><div align="right">City: </div></td>
      <td>
        <input name="city" type="text" value="<?php echo "$city"; ?>" />
      </td>
    </tr>
    <tr>
      <td><div align="right">Account Type: </div></td>
      <td><select name="accounttype">
        <option value="<?php echo "$accounttype"; ?>"><?php echo "$accounttype"; ?></option>
        <option value="a">Normal User</option>
        <option value="b">Expert User</option>
        <option value="c">Super User</option>
      </select></td>
    </tr>
    <tr>
      <td><div align="right">Email: </div></td>
      <td><input name="email" type="text" value="<?php echo "$email"; ?>" /></td>
    </tr>
    <tr>
      <td><div align="right"> Password: </div></td>
      <td><input name="password" type="password" value="<?php echo "$password"; ?>" /> 
      <font size="-2" color="#006600">(letters or numbers only, no spaces no symbols)</font></td>
    </tr>
    <tr>
      <td><div align="right"> Captcha: </div></td>
      <td>Add Captcha Here for security</td>
    </tr>    
    <tr>
      <td><div align="right"></div></td>
      <td><input type="submit" name="Submit" value="Submit Form" /></td>
    </tr>
  </form>
</table>
</body>
</html>