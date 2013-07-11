<?
$headers = array(
 'Content-Type:application/json',
 'Authorization:key=AIzaSyBi8EZkG-n9K00B1P98SaroKnE555DuuSw'
);

$temp_id = $_POST['id'];
$temp_msg = $_POST['msg'];




$myServer = "localhost,1433)";
$myUser = "user";
$myPass = "vjstbaj";
$myDB = "funsumer";
$db = mssql_connect($myServer, $myUser, $myPass) or die ("error");
mssql_select_db($myDB,$db) or die ("error");


$result=mssql_query("select reg_id from personinfo where id = '$temp_id'");

$reg_id = mssql_result($result, 0, "reg_id");

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