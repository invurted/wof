<?php
//allow sessions to be passed so we can see if the user is logged in
session_start();
 
//connect to the database so we can check, edit, or insert data to our users table
//$con = mysql_connect('localhost', 'root', '') or die(mysql_error());
//$db = mysql_select_db('loginTut', $con) or die(mysql_error());
 
//include out functions file giving us access to the protect() function made earlier
include "./functions.php";
include "./dog.php"; 
?>
<html>
	<head>
		<title>Login with Users Online Tutorial</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php
 
		//if the login session does not exist therefore meaning the user is not logged in
		if(strcmp($_SESSION['uid'],"") == 0){
			//display and error message
			echo "<center>You need to be logged in to user this feature!</center>";
		}else{
			//otherwise continue the page
 
			//this is out update script which should be used in each page to update the users online time
			$time = date('U')+50;
			$update = mysql_query("UPDATE `users` SET `online` = '".$time."' WHERE `id` = '".$_SESSION['uid']."'");
			?>
			<div id="border">
				<table cellpadding="2" cellspacing="0" border="0" width="100%">
					<tr>
						<td><b>Users Online:</b></td>
						<td>
						<?php
 
						//select all rows where there online time is more than the current time
						$res = mysql_query("SELECT * FROM `users` WHERE `online` > '".date('U')."'");
 
						//loop for each row
						while($row = mysql_fetch_assoc($res)){
							//echo  each username found to be online with a dash to split them
							echo $row['username']." - ";
						}
 
						?>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center"><a href="logout.php">Logout</a></td>
					</tr>
				</table>
			</div>
			<?php
 
		//make sure you close the check if their online
		}
 
		?>
	</body>
</html>
