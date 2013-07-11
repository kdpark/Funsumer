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
	$sql = "select distinct j.party_id, p.pname from partyjoin j, party p where j.member_id=$id and p.id=j.party_id order by j.visit_count desc";
	$result = mysql_query($sql,$connect);
	$pnum = mysql_num_rows($result);
	echo "NumberOfParty: \"$pnum\", Party: [";
	for($i=0;$i<$pnum;$i++){
		mysql_data_seek($result,$i);
		$row = mysql_fetch_array($result);
		
		if($i>0) echo ", ";
		echo "{\r\n";
		echo "pid: \"$row[0]\", ";
		echo "pname: \"$row[1]\" ";
		echo "}\r\n";
		
	}
	echo "\r\n]";
	mysql_close();
?>
}
]]></data>
</result>