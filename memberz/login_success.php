<?
session_start();

echo "Welcome ". $_SESSION['first_name'] ." ". $_SESSION['last_name'] ."! You have made it to the members area!<br /><br />";

echo "Your user level is ". $_SESSION['user_level']." which enables you access to the following areas: <br />";

if($_SESSION['user_level'] == 0){
	echo "- Forums<br />- Chat Room<br />";
}
if($_SESSION['user_level'] == 1){
	echo "- Forums<br />- Chat Room<br />- Moderator Area<br />";
}

echo "<br /><a href=logout.php>Logout</a>";

?>