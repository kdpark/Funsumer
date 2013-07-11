<?php
header("Content-Type: text/html; charset=UTF-8");
/*$db_host = 'localhost';
$db_id = 'user';
$db_pw = 'vjstbaj';
$db_name = 'funsumer';
$conn = mysql_connect($db_host, $db_id, $db_pw);

if(!$conn) die("unable to connect to mysql : " . mysql_error());


mysql_select_db($db_name) or die("unable to select db : " . mysql_error());

mysql_query("set names utf8");
*/
include "../dbconn.php";

$mynoteid = $_REQUEST['mynoteid'];
$regID = $_REQUEST['regID'];	//RegistrationID 

$sql = "update member set mobile='$regID' where id='$mynoteid'";	
//$sql = "insert into personinfo(reg_id) values('$regID')";
mysql_query($sql,$connect);
mysql_close();
?>