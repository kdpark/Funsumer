<?
$temp_id = $_POST['id'];
$temp_pw = $_POST['pw'];

$myServer = "localhost";
$myUser = "user";
$myPass = "vjstbaj";
$myDB = "funsumer";
$db = mssql_connect($myServer, $myUser, $myPass) or die ("error");
mssql_select_db($myDB,$db) or die ("error");

$result=mysql_query("insert into personinfo(id, pw) values('$temp_id', '$temp_pw')");

$result=mssql_query("select reg_id from personinfo where id='$temp_id' and pw='$temp_pw'");

$reg_id=mssql_result($result, 0, "reg_id");
echo $reg_id;
	

?>

