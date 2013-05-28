<?php
// See if we can in fact for sure get connected to that database for querying
include_once "connect_to_mysql.php";
// If the script makes it past that first line we are good to go using that one line
// in every script we create that requires a connection to that database
echo "<br /><h2>You are successfully connected to your database.</h2><br /><br />
Otherwise you would see an include warning, or a mysql connection error.<br /><br />
Happy coding!
";
?>