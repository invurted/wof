<?
$server="localhost";
$user="root";
$pass="bart544";
$database="dugunumuzvar";
$table="users";
mysql_connect($server,$user,$pass);
mysql_select_db($database);
$actnow="ekle";
$dosya="users";
$unique="USERNO";
$silinecek=$$unique;
if (!$order) $order=$unique;
if (!$sort) $sort="asc";if (!$start) $start="0";
if (!$Hc) $Hc=50;
if ($Sayfa) $start=$Sayfa*$Hc;
$rowColors=Array("#99cccc","#cccccc");
if ($act=="ekle")
{
$USERNAME=addslashes($USERNAME);
$USERPASS=addslashes($USERPASS);
$USERFULLNAME=addslashes($USERFULLNAME);
$USEREMAIL=addslashes($USEREMAIL);
$USERGSM=addslashes($USERGSM);
$q="insert into $table (USERNAME,USERPASS,USERFULLNAME,USEREMAIL,USERGSM) values ('$USERNAME','$USERPASS','$USERFULLNAME','$USEREMAIL','$USERGSM')";
$qinsert=mysql_query($q);
}
if ($act=="sil")
{
$q="delete from $table where $unique='$silinecek'";
$qdelete=mysql_query($q);
}
if ($act=="upd")
{
$USERNAME=addslashes($USERNAME);
$USERPASS=addslashes($USERPASS);
$USERFULLNAME=addslashes($USERFULLNAME);
$USEREMAIL=addslashes($USEREMAIL);
$USERGSM=addslashes($USERGSM);
$q="update $table set USERNAME='$USERNAME',USERPASS='$USERPASS',USERFULLNAME='$USERFULLNAME',USEREMAIL='$USEREMAIL',USERGSM='$USERGSM' where $unique='$silinecek'";
$qupdate=mysql_query($q);
}
?>
<?
//phpFormBuilder Version 1.7 by Baris Kayar (barishkayar@yahoo.com)
//2002(cl)  The FormBuilder Group http://pfb.sourceforge.net

echo 
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<html>
<head>
<meta http-equiv=\"content-language\" content=\"TR\">
<meta http-equiv=\"content-type\" content=\"text/html; charset=windows-1254\">
<meta http-equiv=\"content-type\" content=\"text/html; charset=iso-8859-9\">
	<title>users powered by phpFormBuilder</title>";
?>
<style>
BODY,TD {
	font-family: Verdana, Arial, Geneva;
	font-size: 9pt;
	color : #000000;
}

A {
	font-family: "Tahoma", Arial;
	font-size: 9pt;
	font-weight: normal;
	text-decoration : none;
}

A:HOVER {
	font-family: "Tahoma", Arial;
	font-size: 9pt;
	font-weight: normal;
	text-decoration : underline;
}
A:VISITED {
	font-family: "Tahoma", Arial;
	font-size: 9pt;
	font-weight: normal;
	text-decoration : none;
}
.about {
           	font-size: 8pt;
			color: #000000;
			text-decoration : none;
		  }

A.linkler {
           	font-size: 8pt;
			color: #000000;
			font-weight: normal;
			text-decoration : none;
		  }

A.linkler:VISITED {
           	font-size: 8pt;
			color: #000000;
			font-weight: normal;
			text-decoration : none;
			}

A.linkler:HOVER {
           	font-size: 8pt;
			color: #000000;
			font-weight: normal;
			text-decoration : none;
			background: #809DAA;
			}
</style>
</head><body marginheight=0 marginwidth=0 topmargin=0 leftmargin=0>
<script language="JavaScript">
function uleynsubmitedilirmi() {
with (document.users)
{
}
}
</script>
<script>
function uleynsubmitedilirmi2() {
with (document.limit)
{
if (Hc.value=="") 
				{
				alert ("Limit  must fill!");
				Hc.focus();
				return false;
				}
if (isNaN (Hc.value)) 
				{
				alert ("Limit  must be integer!");
				Hc.focus();
				return false;
				}
}
}
function uleynsubmitedilirmi3() {
with (document.page)
{
if (Sayfa.value=="") 
				{
				alert ("Page  must fill!");
				Sayfa.focus();
				return false;
				}
if (isNaN (Sayfa.value)) 
				{
				alert ("Page  must be integer!");
				Sayfa.focus();
				return false;
				}
}
}
</script>
<table width="100%" border=1><tr><td width="100%" align="center" valign="top"><table width="600">
<tr><td width="590" height="30" valign="middle" bgcolor="#CFCFCF">
<b>Database :</b> <? echo $database;?> | <b>Table :</b> <? echo $table;?>
</td></tr>
</table><br>
<a href="<? echo "$dosya.php?start=$start&order=$order&sort=$sort&Hc=$Hc&filtre=$filtre";?>"><b>New Record</b></a>
<?
$filtre=str_replace("\\","",$filtre);
if ($filtre) $where="where $filtre"; else $where="";
$q="select $unique,USERNAME,USERPASS,USERFULLNAME,USEREMAIL,USERGSM from $table $where order by $order $sort limit $start,".($Hc+1);
$qselect=mysql_query($q);
$listRc=mysql_numrows($qselect);
if ($listRc>$Hc) $listRowc=$Hc; else $listRowc=$listRc;
echo "<table border=1>";
echo 	"<tr>
		<td bgcolor=\"#66ccff\"><a href=\"$dosya.php?order=$unique&sort=desc&start=$start&Hc=$Hc&filtre=$filtre\">&lt;&lt;</a><b>&nbsp;$unique&nbsp;</b><a href=\"$dosya.php?order=$unique&sort=asc&start=$start&Hc=$Hc&filtre=$filtre\">&gt;&gt;</a></td>
		<td bgcolor=\"#66ccff\"><a href=\"$dosya.php?order=USERNAME&sort=desc&start=$start&Hc=$Hc&filtre=$filtre\">&lt;&lt;</a><b>&nbsp;USERNAME&nbsp;</b><a href=\"$dosya.php?order=USERNAME&sort=asc&start=$start&Hc=$Hc&filtre=$filtre\">&gt;&gt;</a></td>
		<td bgcolor=\"#66ccff\"><a href=\"$dosya.php?order=USERPASS&sort=desc&start=$start&Hc=$Hc&filtre=$filtre\">&lt;&lt;</a><b>&nbsp;USERPASS&nbsp;</b><a href=\"$dosya.php?order=USERPASS&sort=asc&start=$start&Hc=$Hc&filtre=$filtre\">&gt;&gt;</a></td>
		<td bgcolor=\"#66ccff\"><a href=\"$dosya.php?order=USERFULLNAME&sort=desc&start=$start&Hc=$Hc&filtre=$filtre\">&lt;&lt;</a><b>&nbsp;USERFULLNAME&nbsp;</b><a href=\"$dosya.php?order=USERFULLNAME&sort=asc&start=$start&Hc=$Hc&filtre=$filtre\">&gt;&gt;</a></td>
		<td bgcolor=\"#66ccff\"><a href=\"$dosya.php?order=USEREMAIL&sort=desc&start=$start&Hc=$Hc&filtre=$filtre\">&lt;&lt;</a><b>&nbsp;USEREMAIL&nbsp;</b><a href=\"$dosya.php?order=USEREMAIL&sort=asc&start=$start&Hc=$Hc&filtre=$filtre\">&gt;&gt;</a></td>
		<td bgcolor=\"#66ccff\"><a href=\"$dosya.php?order=USERGSM&sort=desc&start=$start&Hc=$Hc&filtre=$filtre\">&lt;&lt;</a><b>&nbsp;USERGSM&nbsp;</b><a href=\"$dosya.php?order=USERGSM&sort=asc&start=$start&Hc=$Hc&filtre=$filtre\">&gt;&gt;</a></td>
		</tr>";
$i=0;
while($i<$listRowc)
{
echo "<tr>";
$j=0;
while ($j<mysql_num_fields($qselect))
	 {
	 echo "<td bgcolor=\"".$rowColors[$i%2]."\">";
	 echo mysql_result($qselect,$i,$j);
	 echo "</td>";
	 $j++;
	 }
echo "<td bgcolor=\"".$rowColors[$i%2]."\"><a href=\"$dosya.php?act=sil&$unique=".mysql_result($qselect,$i,"$unique")."&order=$order&sort=$sort&start=$start&Hc=$Hc&filtre=$filtre\"><b>Delete</b></a></td>";
echo "<td bgcolor=\"".$rowColors[$i%2]."\"><a href=\"$dosya.php?act=deg&$unique=".mysql_result($qselect,$i,"$unique")."&order=$order&sort=$sort&start=$start&Hc=$Hc&filtre=$filtre\"><b>Update</b></a></td>";
echo "</tr>";
$i++;
}
echo "</table>";
if ($start>=$Hc) 
	$prevlink=	"<a href=\"$dosya.php?start=".
				($start-$Hc).
				"&Hc=$Hc&order=$order&sort=$sort&filtre=$filtre\">".
				"<b>previous page &lt;&lt;</b></a>&nbsp;&nbsp;";
	else 
	$prevlink=	"previous page &lt;&lt;&nbsp;&nbsp;";

if ($listRc>$Hc)
	$nextlink=	"&nbsp;&nbsp;<a href=\"$dosya.php?start=".($start+$Hc).
				"&Hc=$Hc&order=$order&sort=$sort&filtre=$filtre\">".
				"<b>&gt;&gt; next page</b></a>";
	else 
	$nextlink=	"&nbsp;&nbsp;&gt;&gt;next page";
echo "<table><tr>";
echo "<td align=center valign=middle>$prevlink</td>";
echo "<td align=center valign=middle>$nextlink</td>";
echo 	"</tr><tr><td align=center valign=middle>";
echo
"<form method=post name=limit action=\"$dosya.php?order=$order&sort=$sort&start=$start&filtre=$filtre\"
onsubmit=\"return uleynsubmitedilirmi2();\">
Limit:<input type=text name=Hc maxlength=3 size=5 value=\"$Hc\">
<input type=submit value=Go>
</form></td><td align=center>";
echo
"<form method=post name=page action=\"$dosya.php?order=$order&sort=$sort&start=$start&Hc=$Hc&filtre=$filtre\"
onsubmit=\"return uleynsubmitedilirmi3();\">
Page:<input type=text name=Sayfa maxlength=3 size=5 value=\"$Sayfa\">
<input type=submit value=Go>
</form></td></tr>";
echo 
"<tr><td align=center colspan=2>".
"<form method=post name=filtre action=\"$dosya.php?order=$order&sort=$sort&start=$start&Hc=$Hc\">
Filter:<input type=text name=filtre maxlength=255 size=30 value=\"$filtre\">
<input type=submit value=Go><br>
 Example: id>'3' and title like '%x%'
</form></td></tr>";
echo "</table>";
if ($act=="deg")
{
$q="select * from $table where $unique='$silinecek'";
$qselect=mysql_query($q);
$actnow="upd";
$USERNAME=mysql_result($qselect,0,"USERNAME");
$USERPASS=mysql_result($qselect,0,"USERPASS");
$USERFULLNAME=mysql_result($qselect,0,"USERFULLNAME");
$USEREMAIL=mysql_result($qselect,0,"USEREMAIL");
$USERGSM=mysql_result($qselect,0,"USERGSM");
}
?>
<hr width="600">
<form name="<? echo $table;?>" action="<? echo "$dosya.php?act=$actnow&$unique=$silinecek&order=$order&sort=$sort&start=$start&Hc=$Hc&filtre=$filtre";?>" method="post"  onsubmit="return uleynsubmitedilirmi();">
<table><tr><td>USERNAME</td><td><input type="text" size="20" maxlength="20" name="USERNAME" value="<? echo $USERNAME; ?>"></td></tr>
<tr><td>USERPASS</td><td><input type="text" size="20" maxlength="20" name="USERPASS" value="<? echo $USERPASS; ?>"></td></tr>
<tr><td>USERFULLNAME</td><td><input type="text" size="20" maxlength="20" name="USERFULLNAME" value="<? echo $USERFULLNAME; ?>"></td></tr>
<tr><td>USEREMAIL</td><td><input type="text" size="20" maxlength="20" name="USEREMAIL" value="<? echo $USEREMAIL; ?>"></td></tr>
<tr><td>USERGSM</td><td><input type="text" size="20" maxlength="20" name="USERGSM" value="<? echo $USERGSM; ?>"></td></tr>

<tr><td colspan=2 align="center"><input type="Submit" value="  Ok  " name="submit">&nbsp;&nbsp;<input type="reset" name="reset" value="Cancel"></td></tr>
</table></form>
</td></tr><tr><td align=center>powered by <a href="http://pfb.sourceforge.net/" target="_blank" class="linkler">phpFormBuilder</a></td></tr></table>
<? mysql_close();?>
</body></html>