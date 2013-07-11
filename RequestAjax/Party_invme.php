<? session_start();ob_start();
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
	$sql = "select * from party_invite where to_mem='$id' order by time desc";
	$result=mysql_query($sql, $connect);
	$invnum = mysql_num_rows($result);
	
	echo "NumberOfInv: $invnum, ";
	echo "partyinv: [";
				
	if($invnum){
		for($i=0;$i<$invnum;$i++){
			mysql_data_seek($result,$i);
			$invpart=mysql_fetch_array($result);
			
			$sql2="select*from member where id='$invpart[1]'";
			$result2=mysql_query($sql2,$connect);
			$invmefriend=mysql_fetch_array($result2);
			
			if($i>0){
				echo ", \r\n";
			}
			
			echo "{\r\n";
			echo "invme_id: \"$invmefriend[4]\", ";
			echo "invme_name: \"$invmefriend[0]\", ";
			echo "invme_pic: \"$invmefriend[11]\", ";
			echo "invparty_id : \"$invpart[4]\", ";
			echo "invparty_name : \"$invpart[5]\", ";
			echo "invtime: \"$invpart[3]\"";
			echo "}\r\n";
		}
	}		
	echo "]";	
	mysql_close();
?>
}
]]></data>
</result>