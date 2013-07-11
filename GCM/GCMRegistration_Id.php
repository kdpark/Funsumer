<?
$temp_id = $_POST['id'];
$temp_pw = $_POST['pw'];
$reg_id = $_POST['reg_id'];
	$connect = mysql_connect("localhost", "user", "vjstbaj") or die("DB ??? ??? ? ????");
	mysql_query("set names utf8");
	mysql_select_db("funsumer", $connect);
	
	$sql = "update personinfo set reg_id='$reg_id' where id='$temp_id' and pw='$temp_pw'";
	mysql_query($sql,$connect);


echo "Success";
	

?>


