<?php
 
function generate_code($length = 10)
{
 
    if ($length <= 0)
    {
        return false;
    }
 
    $code = "";
    $chars = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
    srand((double)microtime() * 1000000);
    for ($i = 0; $i < $length; $i++)
    {
        $code = $code . substr($chars, rand() % strlen($chars), 1);
    }
    return $code;
 
}
  
// Mail functions #####

function sendLostPasswordEmail($username, $email, $newpassword)
{
 
    global $domain;
    $message = "
You have requested a new password on http://www.$domain/,
 
Your new password information:
 
username:  $username
password:  $newpassword
 
 
Regards
$domain Administration
";
 
    if (sendMail($email, "Your password has been reset.", $message, "no-reply@$domain"))
    {
        return true;
    } else
    {
        return false;
    }
 
 
}
 
function sendMail($to, $subject, $message, $from)
{
 
 
    $from_header = "From: $from";
 
    if (mail($to, $subject, $message, $from_header))
    {
        return true;
    } else
    {
        return false;
    }
    return false;
}
 
function sendActivationEmail($username, $password, $uid, $email, $actcode)
{
    global $domain;
    $link = "http://www.$domain/activate.php?uid=$uid&actcode=$actcode";
    $message = "
Thank you for registering on http://www.$domain/,
 
Your account information:
 
username:  $username
password:  $password
 
Please click the link below to activate your account.
 
$link
 
Regards
$domain Administration
";
 
    if (sendMail($email, "Please activate your account.", $message, "no-reply@$domain"))
    {
        return true;
    } else
    {
        return false;
    }
}
 
// Display Functions ####

function show_userbox()
{
    // retrieve the session information
    $u = $_SESSION['username'];
    $uid = $_SESSION['loginid'];
    // display the user box
    echo "<div id='userbox'>
			Welcome $u
			<ul>
				<li><a href='./changepassword.php'>Change Password</a></li>
				<li><a href='./logout.php'>Logout</a></li>
			</ul>
		 </div>";
}
 
function show_changepassword_form(){
 
echo '<form action="./changepassword.php" method="post"> 
  <fieldset> 
  <legend>Change Password</legend> 
  <input type="hidden" value="'.$_SESSION['username'].'" name="username"> 
  <dl> 
    <dt> 
      <label for="oldpassword">Current Password:</label> 
    </dt> 
    <dd> 
      <input name="oldpassword" type="password" id="oldpassword" maxlength="15"> 
    </dd> 
  </dl> 
  <dl> 
    <dt> 
      <label for="password">New Password:</label> 
    </dt> 
    <dd> 
      <input name="password" type="password" id="password" maxlength="15"> 
    </dd> 
  </dl> 
  <dl> 
    <dt> 
      <label for="password2">Re-type new password:</label> 
    </dt> 
    <dd> 
      <input name="password2" type="password" id="password2" maxlength="15"> 
    </dd> 
  </dl> 
  <p> 
    <input name="reset" type="reset" value="Reset"> 
    <input name="change" type="submit" value="Reset Password"> 
  </p> 
  </fieldset> 
</form>
';
}
 
function show_loginform($disabled = false)
{
 
    echo '<form name="login-form" id="login-form" method="post" action="./index.php"> 
  <fieldset> 
  <legend>Please login</legend> 
  <dl> 
    <dt><label title="Username">Username: </label></dt> 
    <dd><input tabindex="1" accesskey="u" name="username" type="text" maxlength="30" id="username" /></dd> 
  </dl> 
  <dl> 
    <dt><label title="Password">Password: </label></dt> 
    <dd><input tabindex="2" accesskey="p" name="password" type="password" maxlength="15" id="password" /></dd> 
  </dl> 
  <ul> 
    <li><a href="./register.php" title="Register">Register</a></li> 
    <li><a href="./lostpassword.php" title="Lost Password">Lost password?</a></li> 
  </ul> 
  <p><input tabindex="3" accesskey="l" type="submit" name="cmdlogin" value="Login" ';
    if ($disabled == true)
    {
        echo 'disabled="disabled"';
    }
    echo ' /></p></fieldset></form>';
 
 
}
 
function show_lostpassword_form(){
 
	echo '<form action="./lostpassword.php" method="post"> 
	<fieldset><legend>Reset Password</legend>
  <dl> 
    <dt><label for="username">Username:</label></dt> 
    <dd><input name="username" type="text" id="username" maxlength="30">
    </dd> 
  </dl> 
   <dl> 
    <dt><label for="email">email:</label></dt> 
    <dd><input name="email" type="text" id="email" maxlength="255">
    </dd> 
  </dl> 
  <p> 
    <input name="reset" type="reset" value="Reset"> 
    <input name="lostpass" type="submit" value="Reset Password"> 
  </p> 
  </fieldset>
</form>';
 
}
 
function show_registration_form(){
 
	echo '<form action="./register.php" method="post"> 
	<fieldset><legend>Register</legend>
  <dl> 
    <dt><label for="username">Username:</label></dt> 
    <dd><input name="username" type="text" id="username" maxlength="30">
    </dd> 
  </dl> 
  <dl> 
    <dt><label for="password">Password:</label></dt> 
    <dd><input name="password" type="password" id="password" maxlength="15">
    </dd> 
  </dl> 
  <dl> 
    <dt><label for="password2">Re-type password:</label></dt> 
    <dd><input name="password2" type="password" id="password2" maxlength="15">
    </dd> 
  </dl> 
  <dl> 
    <dt><label for="email">email:</label></dt> 
    <dd><input name="email" type="text" id="email" maxlength="255">
    </dd> 
  </dl> 
  <p> 
    <input name="reset" type="reset" value="Reset"> 
    <input name="register" type="submit" value="Register"> 
  </p> 
  </fieldset>
</form>';
 
}

// Login Functions #####

 
function isLoggedIn()
{
 
    if (session_is_registered('loginid') && session_is_registered('username'))
    {
        return true; // the user is loged in
    } else
    {
        return false; // not logged in
    }
 
    return false;
 
}
 
function checkLogin($u, $p)
{
global $seed; // global because $seed is declared in the header.php file
 
    if (!valid_username($u) || !valid_password($p) || !user_exists($u))
    {
        return false; // the name was not valid, or the password, or the username did not exist
    }
 
    //Now let us look for the user in the database.
    $query = sprintf("
		SELECT loginid 
		FROM login 
		WHERE 
		username = '%s' AND password = '%s' 
		AND disabled = 0 AND activated = 1 
		LIMIT 1;", mysql_real_escape_string($u), mysql_real_escape_string(sha1($p . $seed)));
    $result = mysql_query($query);
    // If the database returns a 0 as result we know the login information is incorrect.
    // If the database returns a 1 as result we know  the login was correct and we proceed.
    // If the database returns a result > 1 there are multple users
    // with the same username and password, so the login will fail.
    if (mysql_num_rows($result) != 1)
    {
        return false;
    } else
    {
        // Login was successfull
        $row = mysql_fetch_array($result);
        // Save the user ID for use later
        $_SESSION['loginid'] = $row['loginid'];
        // Save the username for use later
        $_SESSION['username'] = $u;
        // Now we show the userbox
        return true;
    }
    return false;
}
 
// User Functions #####

function changePassword($username,$currentpassword,$newpassword,$newpassword2){
global $seed;	
	if (!valid_username($username) || !user_exists($username))
    {
        return false;
    }
    if (! valid_password($newpassword) || ($newpassword != $newpassword2)){
 
		return false;
	}
 
	// we get the current password from the database
    $query = sprintf("SELECT password FROM login WHERE username = '%s' LIMIT 1",
        mysql_real_escape_string($username));
 
    $result = mysql_query($query);
	$row= mysql_fetch_row($result);
 
	// compare it with the password the user entered, if they don't match, we return false, he needs to enter the correct password.
	if ($row[0] != sha1($currentpassword.$seed)){
 
		return false;	
	}
 
	// now we update the password in the database
    $query = sprintf("update login set password = '%s' where username = '%s'",
        mysql_real_escape_string(sha1($newpassword.$seed)), mysql_real_escape_string($username));
 
    if (mysql_query($query))
    {
		return true;
	}else {return false;}
	return false;
}
 
 
function user_exists($username)
{
    if (!valid_username($username))
    {
        return false;
    }
 
    $query = sprintf("SELECT loginid FROM login WHERE username = '%s' LIMIT 1",
        mysql_real_escape_string($username));
 
    $result = mysql_query($query);
 
    if (mysql_num_rows($result) > 0)
    {
        return true;
    } else
    {
        return false;
    }
 
    return false;
 
}
 
function activateUser($uid, $actcode)
{
 
    $query = sprintf("select activated from login where loginid = '%s' and actcode = '%s' and activated = 0  limit 1",
        mysql_real_escape_string($uid), mysql_real_escape_string($actcode));
 
    $result = mysql_query($query);
 
    if (mysql_num_rows($result) == 1)
    {
 
        $sql = sprintf("update login set activated = '1'  where loginid = '%s' and actcode = '%s'",
            mysql_real_escape_string($uid), mysql_real_escape_string($actcode));
 
        if (mysql_query($sql))
        {
            return true;
        } else
        {
            return false;
        }
 
    } else
    {
 
        return false;
 
    }
 
}
 
function registerNewUser($username, $password, $password2, $email)
{
 
    global $seed;
 
    if (!valid_username($username) || !valid_password($password) || 
        	!valid_email($email) || $password != $password2 || user_exists($username))
    {
        return false;
    }
 
 
    $code = generate_code(20);
    $sql = sprintf("insert into login (username,password,email,actcode) value ('%s','%s','%s','%s')",
        mysql_real_escape_string($username), mysql_real_escape_string(sha1($password . $seed))
		, mysql_real_escape_string($email), mysql_real_escape_string($code));
 
 
    if (mysql_query($sql))
    {
        $id = mysql_insert_id();
 
        if (sendActivationEmail($username, $password, $id, $email, $code))
        {
 
            return true;
        } else
        {
            return false;
        }
 
    } else
    {
        return false;
    }
    return false;
 
}
 
function lostPassword($username, $email)
{
 
	global $seed;
    if (!valid_username($username) || !user_exists($username) || !valid_email($email))
    {
 
        return false;
    }
 
    $query = sprintf("select loginid from login where username = '%s' and email = '%s' limit 1",
        $username, $email);
 
    $result = mysql_query($query);
 
    if (mysql_num_rows($result) != 1)
    {
 
        return false;
    }
 
 
    $newpass = generate_code(8);
 
    $query = sprintf("update login set password = '%s' where username = '%s'",
        mysql_real_escape_string(sha1($newpass.$seed)), mysql_real_escape_string($username));
 
    if (mysql_query($query))
    {
 
            if (sendLostPasswordEmail($username, $email, $newpass))
        {
            return true;
        } else
        {
            return false;
        }      
 
    } else
    {
        return false;
    }
 
    return false;
 
}
 
// Validation functions ####

function valid_email($email)
{
 
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email))
    {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }
    // Split it into sections to make life easier
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++)
    {
        if (!ereg("^(([A-Za-z0-9!#$%&#038;'*+/=?^_`{|}~-][A-Za-z0-9!#$%&#038;'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
            $local_array[$i]))
        {
            return false;
        }
    }
    if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1]))
    { // Check if domain is IP. If not, it should be valid domain name
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2)
        {
            return false; // Not enough parts to domain
        }
        for ($i = 0; $i < sizeof($domain_array); $i++)
        {
            if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i]))
            {
                return false;
            }
        }
    }
    return true;
}
 
function valid_username($username, $minlength = 3, $maxlength = 30)
{
 
    $username = trim($username);
 
    if (empty($username))
    {
        return false; // it was empty
    }
    if (strlen($username) > $maxlength)
    {
        return false; // to long
    }
    if (strlen($username) < $minlength)
    {
 
        return false; //toshort
    }
 
    $result = ereg("^[A-Za-z0-9_\-]+$", $username); //only A-Z, a-z and 0-9 are allowed
 
    if ($result)
    {
        return true; // ok no invalid chars
    } else
    {
        return false; //invalid chars found
    }
 
    return false;
 
}
 
function valid_password($pass, $minlength = 6, $maxlength = 15)
{
    $pass = trim($pass);
 
    if (empty($pass))
    {
        return false;
    }
 
    if (strlen($pass) < $minlength)
    {
        return false;
    }
 
    if (strlen($pass) > $maxlength)
    {
        return false;
    }
 
    $result = ereg("^[A-Za-z0-9_\-]+$", $pass);
 
    if ($result)
    {
        return true;
    } else
    {
        return false;
    }
 
    return false;
 
}
 
?>
