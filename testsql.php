<?php
 echo "<html>
  <head><title>Test MySQL</title></head>
  <body>";
$host = "localhost";
$user = "pfinder";
$password = "grommit";

$cxn = msqli_connect($host,$user,$password);
$sql = "SHOW DATABASES";
$result = mysqli_query($cxn,$sql);
if ($result == false)
 { echo "<p>Error: ".mysqli_error($cxn)."</p>"; }
 else
 { if(mysqli_num_rows($result) < 1)
   { echo "<p>No current database</p>"; }
   else
   { echo "<ol>";
     while($row = mysqli_fetch_row($result))
     { echo "<li>$row{0}</li>"; }
     echo "</ol>"; }
   }
}
?>
