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
	$num = $_POST['num'];
	$array = $_POST['array'];
	$pid = $_POST['pid'];
	
	$friends = explode(',',$array);
	
	$sql = "select pname from party where id='$pid'";
	$result = mysql_query($sql,$connect);
	$row = mysql_fetch_array($result);
	$pname = $row[0];
	
	for($i=0;$i<$num;$i++){
		$sql = "select*from partyjoin where member_id='$friends[$i]' and party_id='$pid'";
		$result = mysql_query($sql,$connect);
		$row = mysql_fetch_array($result);
		
		if($row){
		}
		else{
			$sql = "select*from party_invite where from_mem='$id' and to_mem='$friends[$i]'";
			$result = mysql_query($sql,$connect);
			$exa = mysql_num_rows($result);
			if($exa){
			}
			else{
				$sql = "insert into party_invite(id, from_mem, to_mem, time, invp_id, invp_name) values(NULL, '$id', '$friends[$i]', CURRENT_TIMESTAMP, '$pid', '$pname')";
				$result = mysql_query($sql,$connect);
			}
		}
	}
	
	mysql_close();
?>
}
]]></data>
</result>