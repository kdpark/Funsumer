<? session_start();ob_start();
	$id = $_SESSION['userid'];
	if(!$id)
	{
	    $id = $_COOKIE["usercookie"];
    }
    
    if(!$id)
    {
		// 로그아웃
	    /* echo(" <script> top.location.href='index.php'; </script> ");*/
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
	
	$popt = $_POST['popt'];
	$pid = $_POST['pid'];
	$newname = $_POST['newname'];
	$tag1 = $_POST['tag1'];
	$tag2 = $_POST['tag2'];
	$tag3 = $_POST['tag3'];
	
	$newname = htmlspecialchars($newname);
	$newname = addslashes($newname); 
	$newname = str_replace("\n","&nbsp;",$newname);	
	
		
	switch($popt)
	{
		case 1: // 파티 참여하기
		
		$sql = "select*from partyjoin where member_id='$id' and party_id='$pid'";
		$result = mysql_query($sql, $connect);
		$num = mysql_num_rows($result);
		if(!$num)
		{	
			$sql = "select p_permission from party where id='$pid'";		
			$result = mysql_query($sql,$connect);
			$p = mysql_fetch_array($result);
			$permis = $p[0];
			
			if($permis==0){
				$sql = "insert into partyjoin(member_id, party_id, visit_count, id, join_time, visit_time) values ('$id','$pid', 1, NULL, NOW(), NOW())";
				mysql_query($sql, $connect);
			}
			else{
				$sql = "insert into party_join(id, mem, party, time) values (NULL, '$id', '$pid', NOW())";
				mysql_query($sql,$connect);
			}
		}
		
		break;
		
		case 2: // 파티 탈퇴하기
		$sql = "select*from party where admin='$id' and id='$pid'";
		$result = mysql_query($sql,$connect);
		$rows = mysql_num_rows($result);
		
		if($rows){
			echo "Result: \"1\" ";
		}
		else{
			$sql = "delete from partyjoin where member_id='$id' and party_id='$pid'";
			mysql_query($sql, $connect);
			echo "Result: \"0\" ";
		}
		
		break;
		
		case 3: // 파티 만들기
		// party_query.php?&newname=fadfas&popt=3;으로 호출하면 됨!!
		
		// party 에 insert 한 후, admin 추가 해주고, partyjoin에도 insert
		$sql = "select*from party where pname='$newname'";		
		$result = mysql_query($sql,$connect);
		$ex = mysql_num_rows($result);
		
		if($ex){
			echo "pdouble: 1";
		}
		else{
			$sql = "insert into party(pname, admin, id, time, widey) values('$newname','$id', NULL, NOW(), '0')";
			mysql_query($sql, $connect);
			
			$sql = "select*from party where pname='$newname'";
			$result = mysql_query($sql, $connect);
			$row = mysql_fetch_array($result);
					
			
			$sql = "insert into partyjoin(member_id, party_id, visit_count, id, join_time, visit_time, notice) values ('$id','$row[2]', 1, NULL, NOW(), NOW(), '1')";
			mysql_query($sql, $connect);		
					
			echo "pid: \"$row[2]\"";
		}
		break;
		
		case 4: // 파티 해체하기
		// party 운영자일 경우에만 실행가능
		// pid 에 해당하는 party 테이블 , partyjoin table 삭제 !!
		// party 삭제
		$sql = "delete from party where id='$pid'";
		mysql_query($sql, $connect);
		$sql = "delete from partyjoin where party_id='$pid'";
		mysql_query($sql, $connect);
		
		// 파티에 있던 글 모두 삭제!
		$sql = "delete from article where party='$pid'";
		
		break;
		
		case 5: // 파티 visitcount update
		$sql = "select p.visit_count from partyjoin p where p.party_id='$pid' and member_id='$id'";
		$result = mysql_query($sql, $connect);
		$numberOfres = mysql_num_rows($result);
		if($numberOfres) // 가입한 파티라면! 방문횟수 +1
		{
			$row = mysql_fetch_array($result);			
			$row[0]++;
			$sql = "update partyjoin set visit_count='$row[0]' where party_id='$pid' and member_id='$id'";
			mysql_query($sql, $connect);
			$sql = "update partyjoin set visit_time=NOW() where party_id='$pid' and member_id='$id'";
			mysql_query($sql, $connect);
		}
		else{
			$sql = "select*from visit where from_mem='$id' and to_party='$pid'";
			$result = mysql_query($sql,$connect);
			$sub = mysql_num_rows($result);
			
			if($sub){
				$counting = mysql_fetch_array($result);
				$upcount = $counting[3]+1;
				$sql = "update visit set count='$upcount' where from_mem='$id' and to_party='$pid'";
				mysql_query($sql,$connect);
			}
			else{
				$sql = "insert into visit(id, from_mem, to_mem, count, to_party) values(NULL, '$id', '0', '1', '$pid')";
				mysql_query($sql, $connect);
			}
		}
		
		break;
		case 6: //파티초대장 삭제하기
		$sql = "delete from party_invite where to_mem='$id' and invp_id='$pid'";
		mysql_query($sql,$connect);
		$sql = "select*from visit where from_mem='$id' and to_party='$pid'";
		$result = mysql_query($sql,$connect);
		$exa = mysql_num_rows($result);
		if($exa){
			$sql = "delete from visit where from_mem='$id' and to_party='$pid'";
			mysql_query($sql,$connect);
		}
		
		break;
	}
	mysql_close();	
	
	

?>
}
]]></data>
</result>