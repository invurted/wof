<?php //userRegister.php

/**
 * RELATED MANUAL PAGES
 * http://php.net/isset
 * http://php.net/empty
 * http://php.net/count
 * http://php.net/implode
 * http://php.net/filter_var
 * http://php.net/sprintf
 * http://php.net/hash
 * http://php.net/strtolower
 *
 * MYSQLI PAGES
 * http://php.net/mysqli_connect
 * http://php.net/mysqli_connect_error
 * http://php.net/mysqli_errno
 * http://php.net/mysqli_error
 * http://php.net/mysqli_query
 */


// First we check if the form was submitted
if( count($_POST) > 0 ) {
   // Array to catch errors with
   $errors = array();
   
   // Check each field to make sure they were filled in
   if( empty($_POST['username']) ) {
      $errors[] = 'You must supply a username';
   }
   if( empty($_POST['email']) ) {
      $errors[] = 'You must supply an email';
   }
   if( empty($_POST['pass1']) ) {
      $errors[] = 'You must supply a password';
   }
   if( empty($_POST['pass2']) ) {
      $errors[] = 'You must confirm your password';
   }
   
   // if no errors continue to validation
   if( count($errors) == 0 ) {
      // Check for valid email
      if( !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) ) {
         $errors[] = 'You must supply a valid email';
      }
      
      // Check the username
      if( !preg_match('/^[a-z][a-z0-9]+$/i',$_POST['username']) ) {
         $errors[] = 'Your username must begin with a letter, and only contain letters and numbers.';
      }
      
      // check that passwords are the same
      if( $_POST['pass1'] != $_POST['pass2'] ) {
         $errors[] = 'Your passwords do not match';
      }
      
      // If no errors continue to database
      if( count($errors) == 0 ) {
         // include mysql connection information
         include 'mysql_info.php';
         
         // connect to mysql
         $conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
         
         // Check if the connection failed
         if( !$conn ) {
            die('Failed to connect '.mysqli_connect_error());
         }
         
         // Hash the password to prevent knowing what it is
         // we use the username as a salt so we can recreate the hash on login
         // using strtolower on the user name so only the password is case sensitive
         $pass = hash('sha256',strtolower($_POST['username']).$_POST['pass1']);
         
      	// prepare data for database
         $username = mysqli_real_escape_string($conn,$_POST['username']);
         $email = mysqli_real_escape_string($conn,$_POST['email']);
         
         // Create the insert query, using real_escape_string to prevent SQL Injection
         $query = sprintf("INSERT INTO `users` (`username`,`email`,`password`) VALUES ('%s','%s','%s')",
                          $username, $email, $pass);
         
         // Attempt insert the new user
         if( mysqli_query($conn,$query) ) {
            die('You have successfully registered as '.$_POST['username'].'<br /><a href="/userLogin.php">Click here</a> to log in.');
         } else {
            // Insert failed, set error message
            $errors[] = 'Error adding user to database, MySQL said:<br>
               ('.mysqli_errno($conn).') '.mysqli_error($conn).'</span>';
         }
      }
   }
}

//output the form
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Derokorian User Registration</title>
   </head>
   <body>
      <?php echo isset($errors) && count($errors) > 0 ? '<span style="color:red">'.implode('<br>',$errors).'</span><br>' : ''; ?>
      <form action="" method="post">
         <label for="username">Username:</label><input type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>"/><br>
         <label for="email">Email:</label><input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"/><br>
         <label for="pass1">Password:</label><input type="password" name="pass1" /><br>
         <label for="pass2">Confirm Pass:</label><input type="password" name="pass2" /><br>
         <input type="submit" value="Register" />
      </form>
   </body>
</html>