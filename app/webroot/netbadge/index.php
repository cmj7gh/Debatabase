<?php

// is it set?
if ( !isset($_SERVER['REMOTE_USER']) || ($_SERVER['REMOTE_USER']=="") ) {
  die ("No REMOTE_USER is set!");
 }
$username = $_SERVER['REMOTE_USER'];
//$username = "mst3k"; // for debugging!

// database login
if ( !mysql_pconnect('localhost', 'wash', 'w3fNIFi73da') )
  die('Could not connect: ' . mysql_error());
mysql_select_db("wash");

// is the user in the users table?
$query = "select * from users where email='$username@virginia.edu'";
$result = mysql_query($query);
$num = mysql_numrows($result);
if ( $num > 1 )
  die("There are " . mysql_numrows($query) . " users with that username!");

// if not, put them there as a provie and add the associated entry in Provies table
if ( $num == 0 ) {
  $query = "insert into users set first_name='', last_name='', email='$username@virginia.edu', role=null, created=now(), modified=now()";
  mysql_query($query);
  $userid = mysql_insert_id();
  //mysql_insert_id gives us the id of the recently-inserted user
  $query = "insert into provies set user_id=" . $userid . ", service_to_sarge=false, service_to_officer=false, is_active=true, points=0, inductions_elligible=false, created=now(), modified=now()";
  mysql_query($query);
  //and create their alumni profile
  $query = "insert into alumni set user_id=" . $userid . ", created=now(), modified=now()";
  mysql_query($query);
 }

// get their user id
$query = "select * from users where email='$username@virginia.edu'";
$result = mysql_query($query);
if ( mysql_numrows($result) != 1 )
  die ("Error creating user account!");
$id = mysql_result($result,0,"id");

// invalidate their other authentication entries
$query = "update authentications set valid=false where user_id=$id";
mysql_query($query);

// create a new (valid) auth entry
$uniqid = uniqid("",true);
$ipaddr = $_SERVER['REMOTE_ADDR'];
$query = "insert into authentications set user_id=$id, ipaddr='$ipaddr', value='$uniqid', valid=true, created=now()";
mysql_query($query);

// set the auth entry as a cookie
setcookie("REMOTE_AUTH",$uniqid,0,"/~wash");

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html><head>
<meta http-equiv="refresh" content="0; URL=/~wash/users/netbadge">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Netbadge redirect page</title>
</head>
<?php $_SESSION['REMOTE_USER'] = $_SERVER['REMOTE_USER']; ?>
<p>You really want to be <a href="/~wash/users/netbadge">here</a>; redirecting now...</p>
</body></html>
