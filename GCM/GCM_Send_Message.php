<?
$headers = array(
 'Content-Type:application/json',
 'Authorization:key=AIzaSyAulyO4EdZWoOvTb3-G_Fwv4c0wQLHcoyo'
);

$temp_id = $_POST['id'];
$temp_msg = $_POST['msg'];

	$connect = mysql_connect("localhost", "user", "vjstbaj") or die("DB ??? ??? ? ????");
	mysql_query("set names utf8");
	mysql_select_db("funsumer", $connect);

	$sql = "select reg_id from personinfo where id='$temp_id'";
	$result = mysql_query($sql,$connect);
	$a = mysql_fetch_array($result);
	$reg_id = $a[0];

echo "Reg_id = $reg_id";






$arr   = array();
$arr['data'] = array();
$arr['data']['msg'] = "$temp_msg"; 
$arr['registration_ids'] = array();
$arr['registration_ids'][0] = "$reg_id";



$ch = curl_init();


curl_setopt($ch, CURLOPT_URL,    'https://android.googleapis.com/gcm/send');
curl_setopt($ch, CURLOPT_HTTPHEADER,  $headers);
curl_setopt($ch, CURLOPT_POST,    true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arr));
$response = curl_exec($ch);
echo $response;
curl_close($ch);
?>