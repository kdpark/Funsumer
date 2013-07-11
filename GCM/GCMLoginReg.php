<?
$temp_id = $_POST['id'];
$temp_pw = $_POST['pw'];

	$connect = mysql_connect("localhost", "user", "vjstbaj");
	mysql_query("set names utf8");
	mysql_select_db("funsumer", $connect);
		
	$sql = "select reg_id from personinfo where id='$temp_id' and pw='$temp_pw'";
	$result = mysql_query($sql,$connect);
	$a = mysql_fetch_array($result);
	
	$reg_id=$a[0];
	echo $reg_id;
	

?>

