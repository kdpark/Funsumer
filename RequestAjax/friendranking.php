<? session_start();ob_start();
	$id = $_COOKIE["usercookie"];
    if(!$id)
    {
	    $id = $_SESSION['userid'];	    
    }
    if(!$id)
    {
		// 로그아웃
	     echo(" <script> top.location.href='../index.php'; </script> ");
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
	//전체사용자의 ID받아옴
	$sql = "select id from member";
	$result=mysql_query($sql,$connect);
	$allNumber = mysql_num_rows($result);
	
	for($i=0;$i<$allNumber;$i++){
		mysql_data_seek($result,$i);
		$all = mysql_fetch_array($result);
		if($all[0]!=1){
		
		$total_score[$i] = 0;
		
		$allid[$i]=$all[0];
			$sql1 = "select count from visit where from_mem='$allid[$i]' and to_mem='$me[id]'"; 	//나한테 들어온 횟수 점수환산
			$result1 = mysql_query($sql1,$connect);			
			$counting = mysql_fetch_array($result1);
			if($counting[0]){							
				$total_score[$i] = $counting[0] * 1;
			}
			else{
				$total_score[$i] = 0;
			}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$c_party = 0;
			$sql2 = "select party_id from partyjoin where member_id='$allid[$i]'";			//나와 파티 중첩도 점수환산
			$result2 = mysql_query($sql2,$connect);
			$partynum = mysql_num_rows($result2);
			if($partynum){
				for($j=0;$j<$partynum;$j++){
					mysql_data_seek($result2,$j);
					$partyid = mysql_fetch_array($result2);
					$sql3 = "select*from partyjoin where member_id='$me[id]' and party_id='$partyid[0]'";
					$result3 = mysql_query($sql3,$connect);
					$samepartynum = mysql_num_rows($result3);
					if($samepartynum){
						$c_party += 1;
					}
					else{
						$c_party += 0;
					}
				}
				$total_score[$i] += (5*($c_party*($c_party+1)))/2;
			}
			else{
				$total_score[$i] += 0; 
			}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$sql4 = "select*from friend_vote where to_mem='$me[id]' and from_mem='$allid[$i]'";
			$result4 = mysql_query($sql4,$connect);
			$votenum = mysql_num_rows($result4);
			if($votenum){
				$total_score[$i] += 2*$votenum;
			}
			else{
				$total_score[$i] += 0;
			}
			if($allid[$i]==$me[id]){
				$total_score[$i] = -1;
			}
		}
	}
	
	
	
	//최종 10명 산출
	for($i=0;$i<$allNumber;$i++){
		for($j=($i+1);$j<$allNumber;$j++){
			if($total_score[$i]<$total_score[$j]){
				$temp = $total_score[$j];
				$total_score[$j] = $total_score[$i];
				$total_score[$i] = $temp;
				
				$temp1 = $allid[$j];
				$allid[$j] = $allid[$i];
				$allid[$i] = $temp1;
			}
			
		}
	}
	if($total_score[0]<1){
		echo "friendnone: \"1\", ";
	}
	echo "friendrank: [";
	for($i=0;$i<10;$i++){
		if($i>0) echo ",\r\n";
		echo "{\r\n";
		$sql5 = "select*from member where id='$allid[$i]'";
		$result5 = mysql_query($sql5,$connect);
		$finfo = mysql_fetch_array($result5);
		
		$c_party = 0;
			$sql6 = "select party_id from partyjoin where member_id='$allid[$i]'";			//나와 파티 중첩도 점수환산
			$result6 = mysql_query($sql6,$connect);
			$partynum = mysql_num_rows($result6);
			if($partynum){
				for($j=0;$j<$partynum;$j++){
					mysql_data_seek($result6,$j);
					$partyid = mysql_fetch_array($result6);
					$sql7 = "select*from partyjoin where member_id='$me[id]' and party_id='$partyid[0]'";
					$result7 = mysql_query($sql7,$connect);
					$samepartynum = mysql_num_rows($result7);
					if($samepartynum){
						$c_party += 1;
					}
					else{
						$c_party += 0;
					}
				}
			}
			else{
				$c_party = 0;
			}
		
				echo "fname: \"$finfo[0]\", ";
				echo "fid: \"$finfo[4]\", ";
				echo "fpic: \"$finfo[11]\", ";
				echo "fparty: \"$c_party\", ";
				echo "totalscore: \"$total_score[$i]\" ";
				echo "}\r\n";		
			
	}
	echo "]";
	
	
	mysql_close();
?>
}
]]></data>
</result>