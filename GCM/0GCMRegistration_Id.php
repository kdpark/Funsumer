<?
$temp_id = $_POST['id'];
$temp_pw = $_POST['pw'];
$temp_reg_id = $_POST['reg_id'];

$myServer = "localhost,1433)";
$myUser = "user";
$myPass = "vjstbaj";
$myDB = "funsumer";
$db = mssql_connect($myServer, $myUser, $myPass) or die ("error");
mssql_select_db($myDB,$db) or die ("error");




$result=mssql_query("update personinfo set reg_id = '$temp_reg_id' where id='$temp_id' and pw='$temp_pw'");


echo "Success";
	

?>


