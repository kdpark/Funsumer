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
	$req_id = $_POST['req_id'];
	
	$sql = "select party_id from partyjoin where member_id='$id'";
	$result = mysql_query($sql,$connect);
	$user_pnum = mysql_num_rows($result);
	
	if($user_pnum){
		for($i=0;$i<$user_pnum;$i++){
			mysql_data_seek($result,$i);
			$upi= mysql_fetch_array($result);
			$user_pid[$i] = $upi[0];
		}
	}
	
	$sql = "select distinct f.mem2, m.name, m.profilepic from friendship f, member m where f.mem1=$req_id and m.id=f.mem2";
	$result = mysql_query($sql,$connect);
	$friendship_num= mysql_num_rows($result);
	echo "FriendNum: \"$friendship_num\", Friend: [\r\n";
	for($i=0;$i<$friendship_num;$i++){
		$count[$i]=0;
		mysql_data_seek($result,$i);
		$friend_info = mysql_fetch_array($result);
		$FID[$i] = $friend_info[0];
		$FNM[$i] = $friend_info[1];
		$FPC[$i] = $friend_info[2];			
		
		for($j=0;$j<$user_pnum;$j++){			
			$sql2= "select*from partyjoin where member_id='$friend_info[0]' and party_id='$user_pid[$j]'";
			$result2 = mysql_query($sql2,$connect);
			$cp = mysql_num_rows($result2);
			if($cp!=0){
				$count[$i] = $count[$i]+1;
			}
		}
		
		if($id == $friend_info[0]){
			$FSTAT[$i]=0;
		}
		else{
			$sql2 = "select*from friendship where mem1='$id' and mem2='$friend_info[0]'";
			$result2 = mysql_query($sql2,$connect);
			$a = mysql_num_rows($result2);
			if($a){
				$FSTAT[$i] = 1;
			}
			else{
				$sql3 = "select*from friend_req where from_mem='$id' and to_mem='$friend_info[0]'";
				$result3 = mysql_query($sql3,$connect);
				$b = mysql_num_rows($result3);
				if($b){
					$FSTAT[$i] = 2;
				}
				else{
					$sql4 = "select*from friend_req where from_mem='$friend_info[0]' and to_mem='$id'";
					$result4 = mysql_query($sql4,$connect);
					$c = mysql_num_rows($result4);
					if($c){
						$FSTAT[$i] = 3;
					}
					else{
						$FSTAT[$i] = 4;
					}
				}
			}
			
		}
	}
	
	for($i=0;$i<$friendship_num-1;$i++){
		for($j=$i+1;$j<$friendship_num;$j++){
			if($count[$i] < $count[$j]){
				$temp = $count[$i];
				$count[$i] = $count[$j];
				$count[$j] = $temp;
				$temp = $FID[$i];
				$FID[$i] = $FID[$j];
				$FID[$j] = $temp;
				$temp = $FNM[$i];
				$FNM[$i] = $FNM[$j];
				$FNM[$j] = $temp;
				$temp = $FPC[$i];
				$FPC[$i] = $FPC[$j];
				$FPC[$j] = $temp;
				$temp = $FSTAT[$i];
				$FSTAT[$i] = $FSTAT[$j];
				$FSTAT[$j] = $temp;
			}
		}		
	}
	
	for($i=0;$i<$friendship_num;$i++){
		if($i>0) echo ", ";	
		echo "{\r\n";
		echo "Fid: \"$FID[$i]\", ";
		echo "Fname: \"$FNM[$i]\", ";
		echo "Fpic: \"$FPC[$i]\", ";
		echo "Fparty: \"$count[$i]\", ";
		echo "Fstat: \"$FSTAT[$i]\" ";
		echo "}\r\n";
	}
	
		
		
		echo "]\r\n";
		mysql_close();
?>
}
]]></data>
</result>