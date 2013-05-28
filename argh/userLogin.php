<?php // userLogin.php

/**
 * RELATED MANUAL PAGES
 * http://php.net/session_start
 * http://php.net/count
 * http://php.net/hash
 * http://php.net/strtolower
 *
 * MYSQLI PAGES
 * http://php.net/mysqli_connect
 * http://php.net/mysqli_connect_error
 * http://php.net/mysqli_query
 * http://php.net/mysqli_errno
 * http://php.net/mysqli_error
 */

// First and foremost we start the session, this MUST come
// before any output, including whitespace
session_start();

// Check if the user is already logged in
if( isset($_SESSION['username']) ) {
   die('You are already logged in');
}

// Next we check if the form was submitted
if( count($_POST) > 0 ) {
   // Array to hold errors
   $errors = array();
   
   // Check that the necessary data was submitted
   if( empty($_POST['username']) ) {
      $errors[] = 'You must supply a username';
   }
   if( empty($_POST['password']) ) {
      $errors[] = 'You must supply a password';
   }
   
   // If no missing fields, continue to database
   if( count($errors) == 0 ) {
      // Connect to mysql
      include 'mysql_info.php';
      $conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
      
      // Check if the connection failed
      if( !$conn ) {
         die('Failed to connect '.mysqli_connect_error());
      }
      
      // Hash the password to match against DB
      // Using strtolower on the username so only password is case sensitive
      $password = hash('sha256',strtolower($_POST['username']).$_POST['password']);
      
      // Prepare username for query
      $username = mysqli_real_escape_string($conn,$_POST['username']);
      
      // create query to find user in DB
      $query = sprintf("SELECT 1 FROM `users` WHERE `username` = '%s' AND `password` = '%s'",
                       $username, $password);
      
      // Attempt to query database for user
      $res = mysqli_query($conn,$query);
      
      // Check if the query was successful
      if( !$res ) {
         $errors[] = 'Error selecting user from database, MySQL said:<br>
               ('.mysqli_errno($conn).') '.mysqli_error($conn);
      } else {
         // Check if the result returned a row
         if( mysqli_num_rows($res) > 0 ) {
            // Successfully logged in
            $_SESSION['username'] = $_POST['username'];
            die('You have successfully logged in.');
         } else {
            // Username/password mismatch
            $errors[] = 'Your username and password combination wasn\'t found. Please try again.';
         }
      }
   }
}

// Output the form
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Derokorian User Login</title>
   </head>
   <body>
      <?php echo isset($errors) && count($errors) > 0 ? '<span style="color:red">'.implode('<br>',$errors).'</span><br>' : ''; ?>
      <form action="" method="post">
         <label for="username">Username:</label><input type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>"/><br>
         <label for="password">Password:</label><input type="password" name="password" /><br>
         <input type="submit" value="Log in" />
      </form>
   </body>
</html>
