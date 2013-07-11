<?session_start();ob_start();
	$id = $_COOKIE["usercookie"];
    if(!$id)
    {
	    $id = $_SESSION['userid'];	    
    }
    
	
	//////////// 이름 얻기 : me 는 로그인한 세션의 정보
	include "../dbconn.php";
	$sql = "select * from member m where m.id='$id'";
	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result);
	$me = mysql_fetch_array($result);
    
	require("../util.php");
	
	header("Content-type: text/xml; charset=utf-8");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache,must-revalidate");
	echo "<?xml version='1.0' encoding='utf-8' ?>";
?>

<result>
	<code>success</code>
    <data><![CDATA[
               
         {
         
<?
	$sql = "select * from friend_req where to_mem='$id'";
	$result=mysql_query($sql, $connect);
	$reqme = mysql_num_rows($result);
	
	echo "NumberOfReq: $reqme, ";
	echo "friendreq: [";
				
	if($reqme){
		for($i=0;$i<$reqme;$i++){
			mysql_data_seek($result,$i);
			$reqpart=mysql_fetch_array($result);
			
			$sql2="select*from member where id='$reqpart[1]'";
			$result2=mysql_query($sql2,$connect);
			$reqmefriend=mysql_fetch_array($result2);
			
			if($i>0){
				echo ", \r\n";
			}
			
			echo "{\r\n";
			echo "reqme_id: \"$reqmefriend[4]\", ";
			echo "reqme_name: \"$reqmefriend[0]\", ";
			echo "reqme_pic: \"$reqmefriend[11]\", ";
			echo "reqme_time: \"$reqpart[3]\"";
			echo "}\r\n";
		}
	}		
	echo "]";	
	mysql_close();
?>
}
]]></data>
</result>