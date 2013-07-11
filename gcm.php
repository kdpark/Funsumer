<?
/*$headers = array(
 'Content-Type:application/json',
 'Authorization:key=AIzaSyAulyO4EdZWoOvTb3-G_Fwv4c0wQLHcoyo'
);

$arr   = array();
$arr['data'] = array();
$arr['data']['msg'] = "1234"; 
$arr['registration_ids'] = array();
$arr['registration_ids'][0] = "APA91bGUoa_g7EhgyEDwoeMrrXjQzmXTsEWvWJbLpgRJ3um2W4026x5ROEjzZykuK09Gds08Pw9SMgIgL6Vp4Ar_wV6qHeoVWnXUa6mThQqk1I11BW_GsXc2aL93rYCv51-E-Y7udti7";

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
?>*/




//------------------------------------------------------------------------------
// ????? ??? php ????.
// ?????? ?? curl ??? ??? ???.
// ????? curl ? ??????, ?? fsockopen ?? ???.
//------------------------------------------------------------------------------
$msg = "1234";
$send_time = date('YmdHis');
$timeout = 5;
$gcm_api_key = "AIzaSyAulyO4EdZWoOvTb3-G_Fwv4c0wQLHcoyo";

$gcm_data = array('registration_ids'=>array('APA91bGUoa_g7EhgyEDwoeMrrXjQzmXTsEWvWJbLpgRJ3um2W4026x5ROEjzZykuK09Gds08Pw9SMgIgL6Vp4Ar_wV6qHeoVWnXUa6mThQqk1I11BW_GsXc2aL93rYCv51-E-Y7udti7'),
                  'time_to_live'=>60,
                  'data'=>array('msg'=>$msg,
                                'lecture_code'=>$lecture_code,
                                'teacher_code'=>$teacher_code,
                                'notice'=>"",
                                'send_time'=>$send_time));

$fp = fsockopen("ssl://android.googleapis.com", 443, $errno, $errstr, $timeout);
if(!$fp)
{
  echo "RET_CODE=FALSE\n";
  echo "RET_MSG=Fail to connect google [".$errno."] [".$errstr."]\n";
  writeLog("FALSE", "Fail to connect google  GCM [".$errno."] [".$errstr."]");
  exit;
}

fputs($fp, "POST /gcm/send HTTP/1.0\r\n".
           "Host: android.googleapis.com\r\n".
           "Content-Type: application/json\r\n".
           "Content-length: ".strlen(json_encode($gcm_data))."\r\n".
           "Authorization: key=".$gcm_api_key."\r\n\r\n".
           json_encode($gcm_data) . "\r\n\r\n");

$response = "";
while(!feof($fp))
{
  $response .= fgets($fp);
}
fclose($fp);

// GCM ????, ??? ????.
$body_index = strpos($response, "\r\n\r\n");
if($body_index === FALSE)
{
  echo "RET_CODE=FALSE\n";
  echo "RET_MSG=GCM response error\n";
  writeLog("FALSE", "GCM Send fail\n".$response);
  exit;
}

// GCM ????, ?? ??? ??? ????.
$response_body = substr($response, $body_index + 4);
$response_json = json_decode($response_body);
$success_count = $response_json->{'success'};
if($success_count <= 0)
{
  // ?? ?? ?????, gcm ? ???, 
  // NotRegistered ??? ???? ??.
  $err_obj = $response_json->{'results'}[0];
  $err_msg = $err_obj->{'error'};
  echo "RET_CODE=FALSE\n";
  echo "RET_MSG=GCM Send fail\n";
  writeLog("FALSE", "GCM Send fail : ".$err_msg);
  exit;
}

echo "RET_CODE=TRUE\n";
echo "RET_MSG=\n";
writeLog("TRUE", "push send OK. android GCM");
exit;


?>