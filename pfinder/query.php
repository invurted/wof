<html>
<head><title>Test query</title></head>
<body>
Argh

<?php 
$host = 'localhost';
$user = 'pfinder';
$passwd = 'grommit';
$dbname = 'pfinder';

if (!$cxn = mysqli_connect($host,$user,$passwd,$dbname))
 { $message = mysqli_error($cxn);
   echo "$message";
   die(); }
$sql = "select u_s.user_id,user.username as username,system.system_maker,system.system_name \n"
    . "as game,faction.faction_name as faction\n"
    . "from u_s,user,system,faction\n"
    . "where u_s.user_id = user.user_id AND\n"
    . "u_s.system_id = system.system_id AND\n"
    . "u_s.faction_id = faction.faction_id\n"
    . "ORDER BY user.username LIMIT 0, 30 ";

$result = mysqli_query($cxn,$sql) or die("Couldn't execute query");
echo "<table>";
while($row = mysqli_fetch_assoc($result))
{ extract($row);
 echo "<tr><td>$username</td>\n
  <td>$system_maker</td>\n
  <td>$game</td>\n
  <td>$faction</td>\n
  </tr>";
}
echo "</table>";
?>
</body>
</html>
