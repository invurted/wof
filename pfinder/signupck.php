<?php include 'apple.php';

$username=$_POST['userid'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$userfname=$_POST['userfname'];
$userlname=$_POST['userlname'];
$useremail=$_POST['useremail'];

if(isset($todo) and $todo=="post")
{ $status = "OK";
  $msg="Oops: ";
  if(!isset($username) or strlen($username) <3)
  { $msg=$msg."User id should be =3 or more than 3 char length<BR>";
   $status= "NOTOK";}
  if(mysql_num_rows(mysql_query("SELECT username FROM user WHERE username = '$username'")))
  { $msg=$msg."Username already exists. Please try another one<BR>";
    $status= "NOTOK";}
  if (strlen($password) < 3 )
  { $msg=$msg."Password must be more than 3 char legth<BR>";
    $status= "NOTOK";}
  if ( $password <> $password2 )
  { $msg=$msg."Both passwords are not matching<BR>";
   $status= "NOTOK";}
  if($status<>"OK")
  { echo "<font face='Verdana' size='2' color=red>$msg</font><br><input type='button' value='Retry' onClick='history.go(-1)'>";
  }
  else
   { $hashed_password = crypt($password);
     $stored = crypt($password, $hashed_password);
     if(mysql_query("insert into user(username,user_password,user_email,user_fname,user_lname) values('$userid','$stored','$useremail','$userfname','$userlname')")) 
   
     { echo "<font face='Verdana' size='2' color=green>Welcome, You have successfully signed up</font>";}
     else
     { echo "Database Problem, please contact Site admin"; echo mysql_error(); }
   }
}
?>