<?php
/* Program: petDisplay.php
* Desc: Displays all pets in selected category.
*/
?>
<html>
<head><title>Pet Catalog</title></head>
<body>
<?php
$user = "pfinder";
$host = "localhost";
$password = "grommit";
$database = "pfinder";
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
$user = "Adam"; //horse was typed in a form by user
$query = "select * from u_s,user,system,faction\n"
    . "where u_s.user_id = user.user_id AND\n"
    . " u_s.system_id = system.system_id AND\n"
    . " u_s.faction_id = faction.faction_id\n"
    . "ORDER BY user.username LIMIT 0, 30 ";
$result = mysqli_query($cxn,$query)
or die (.Couldn.t execute query..);
/* Display results in a table */
$pettype = ucfirst($pettype)..s.;
echo .<h1>$pettype</h1>\n.;
echo .<table cellspacing=.15.>\n.;
echo .<tr><td colspan=.3.><hr /></td></tr>\n.;
while($row = mysqli_fetch_assoc($result))
{
extract($row);
$f_price = number_format($price,2);
echo .<tr>\n
<td>$petName</td>\n
<td>$petDescription</td>\n
<td style=.text-align: right.>\$$f_price</td>\n
</tr>\n.;
echo .<tr><td colspan=.3.><hr /></td></tr>\n.;
}
echo .</table>\n.;
?>
</body></html>
