<?php
 
#### Validation functions ####

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
