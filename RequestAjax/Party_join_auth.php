<? session_start();ob_start();
	$id = $_SESSION['userid'];
	if(!$id)
	{
	    $id = $_COOKIE["usercookie"];
    }
    
    if(!$id)
    {
		// 로그아웃
	     echo(" <script> top.location.href='../index.php'; </script> ");
    }
    
    include "../dbconn.php";
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
	$opt = $_POST['opt'];
	$pid = $_POST['pid'];
	if($opt==1){	//보여주기
		$sql = "select distinct m.id, m.name, m.profilepic from member m, party_join j where j.party='$pid' and m.id=j.mem and j.auth='0'";
		$result = mysql_query($sql,$connect);
		$num = mysql_num_rows($result);
		if($num){
			
			echo "num: $num, member: [";
			for($i=0;$i<$num;$i++){
				mysql_data_seek($result,$i);
				$row = mysql_fetch_array($result);
				
				if($i>0) echo ",";
				echo "{";
				echo "mid: \"$row[0]\", ";
				echo "mname: \"$row[1]\", ";
				echo "mpic: \"$row[2]\", ";
				echo "}";
			}
			echo "]\r\n";
		
		}
	}
	else if($opt==2){	//수락하기
		$mid = $_POST['mid'];
		$sql = "select*from partyjoin where member_id='$mid' and party_id='$pid'";
		$result = mysql_query($sql, $connect);
		$num = mysql_num_rows($result);
		if(!$num)
		{
			$sql = "insert into partyjoin(member_id, party_id, visit_count, id, join_time, visit_time) values ('$mid','$pid', 1, NULL, NOW(), NOW())";
			mysql_query($sql, $connect);	
			$sql = "update party_join set auth='1' where mem='$mid' and party='$pid'";		
			mysql_query($sql,$connect);
		}
	}
	else if($opt==3){	//거절하기
		$mid = $_POST['mid'];
		$sql = "update party_join set auth='2' where mem='$mid' and party='$pid'";		
		mysql_query($sql,$connect);
	}
	mysql_close();
?>
}
]]></data>
</result>