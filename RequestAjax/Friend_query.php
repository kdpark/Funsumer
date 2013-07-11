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
	//친구등록
	$fid = $_POST['fid'];
	$fopt = $_POST['fopt'];
	
	if($fopt==1){
		$sql = "select*from friendship where mem1='$id' and  mem2='$fid'";
		$result = mysql_query($sql,$connect);
		$exa = mysql_num_rows($result);
		if($exa){	//이미 친구이면
		//echo "0";
		}
		else{	//친구요청 받은 상태
		//echo "1";
			$sql1 = "select*from friend_req where from_mem='$fid' and to_mem='$id'";
			$result1 = mysql_query($sql1,$connect);
			$faccept = mysql_num_rows($result1);
			if($faccept){
				//echo "2";
				$sql2 = "insert into friendship(id, mem1, mem2, time) values(NULL, '$id', '$fid', NOW())";
				mysql_query($sql2,$connect);
				$sql2 = "insert into friendship(id, mem1, mem2, time) values(NULL, '$fid', '$id', NOW())";
				mysql_query($sql2,$connect);
				$sql2 = "delete from friend_req where from_mem='$fid' and to_mem='$id'";
				mysql_query($sql2,$connect);
			}			
			else{	//요청 보낸상태거나 처음보는상태
				$sql1 = "select*from friend_req where from_mem='$id' and to_mem='$fid'";
				$result1 = mysql_query($sql1,$connect);
				$faccep2 = mysql_num_rows($result1);
				if($faccep2){	//요청을 보낸상태
				
				}
				else{	//처음보는 상태				
					$sql2 = "insert into friend_req(id, from_mem, to_mem, time) values(NULL, '$id', '$fid', NOW())";
					mysql_query($sql2,$connect);
				}
			}
			
		}
	}
	else if($fopt==2){
		$sql = "delete from friend_req where from_mem='$fid' and to_mem='$id'";
		mysql_query($sql,$connect);
	}
	
	mysql_close();
?>
}
]]></data>
</result>