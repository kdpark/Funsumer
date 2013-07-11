<? session_start(); ob_start();
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
	$sql = "select distinct m2.name, m.from_mem, m2.profilepic, m.article_id, a.mynote, a.party, m.mread, m.mtype, m.time, m.id from member m2, message m, article a where m.to_mem=$id and m2.id=m.from_mem and a.id=m.article_id order by m.time desc";
	$result = mysql_query($sql,$connect);
	$row = mysql_num_rows($result);
	
	if($row){
		echo "Num: $row, ";
		echo "alarm: [\r\n";
		for($i=0;$i<$row;$i++){
			mysql_data_seek($result,$i);
			
			$ar = mysql_fetch_array($result);
			
			if($ar[5]){
				$sql2 = "select pname, id from party where id='$ar[5]'";
				$result2 = mysql_query($sql2,$connect);
				$rr = mysql_fetch_array($result2);
				$fromid = $rr[1];
				$from = $rr[0];
			}else{
				$sql2 = "select name, id from member where id='$ar[4]'";
				$result2 = mysql_query($sql2,$connect);
				$rr = mysql_fetch_array($result2);
				$fromid = $rr[1];
				$from = $rr[0]."님의 노트";
			}
			
			if($i>0) echo ", ";
			echo "{\r\n";
			echo "mname: \"$ar[0]\", ";
			echo "mid: \"$ar[1]\", ";
			echo "mpic: \"$ar[2]\", ";
			echo "articleID: \"$ar[3]\", ";
			echo "from: \"$from\", ";
			echo "fromid: \"$fromid\", ";
			echo "read: \"$ar[6]\", ";
			echo "type: \"$ar[7]\", ";
			echo "time: \"$ar[8]\", ";
			echo "alarm_id: \"$ar[9]\" ";
			echo "}\r\n";
		}
		echo "],\r\n";		
	}
		
	$discount=0;
	$count=0;
	$sql = "select p.id, p.pname, p.pic from party p where p.admin='$id' order by p.id";
	$result = mysql_query($sql,$connect);
	$nums = mysql_num_rows($result);
	
	if($nums){
		for($i=0;$i<$nums;$i++){
			mysql_data_seek($result,$i);
			$p = mysql_fetch_array($result);
						
			$sql1 = "select*from party_join where party='$p[0]'";
			$result1 = mysql_query($sql1,$connect);
			$row1 = mysql_num_rows($result1);
							
			if($row1){
				for($j=0;$j<$row1;$j++){
					mysql_data_seek($result1,$j);
					$o = mysql_fetch_array($result1);
					if($o[4]==0){
					}
					else{
						$discount++;
					}							
				}
				if(($row1-$discount)>0){
					$pid[$count] = $p[0];
					$pname[$count] = $p[1];
					$pjoin[$count] = ($row1-$discount);
					$ppic[$count] = $p[2];
					$count++;			
				}
			}
		}
		echo "joinnum: $count, joinwant: [";
		for($i=0;$i<$count;$i++){
			if($i>0) echo ", ";
			echo "{";
			echo "party_id: \"$pid[$i]\", ";
			echo "party_name: \"$pname[$i]\", ";
			echo "party_join: \"$pjoin[$i]\", ";
			echo "party_pic: \"$ppic[$i]\" ";
			echo "}";
		}
		echo "], ";
	}
	else{
		echo "joinnum: 0, ";
	}	
	
	$sql = "select*from party_join where mem='$id'";	
	$result = mysql_query($sql,$connect);
	$menum = mysql_num_rows($result);
	$menum = mysql_num_rows($result);
	if($menum){
		$count = 0;
		for($i=0;$i<$menum;$i++){
			mysql_data_seek($result,$i);
			$m = mysql_fetch_array($result);
			
			if($m[4]!=0){
				$sql1 = "select id, pname, pic from party where id='$m[2]'";
				$result1 = mysql_query($sql1,$connect);
				$rr = mysql_fetch_array($result1);
								
				$p_id[$count] = $rr[0];
				$p_name[$count] = $rr[1];
				$p_pic[$count] = $rr[2];
				if($m[4]==1){
					$p_confirm[$count] = 1;
				}
				else if($m[4]==2){
					$p_confirm[$count] = 2;
				}
				$count++;
			}			
		}
		echo "menum: $count, mejoin: [";
			for($i=0;$i<$count;$i++){
				
				if($i>0) echo ", ";
				
				if($m[4]==1){	//가입됨
					echo "{";
					echo "partyid: \"$p_id[$i]\", ";
					echo "partyname: \"$p_name[$i]\", ";
					echo "partypic: \"$p_pic[$i]\", ";
					echo "confirms: \"$p_confirm[$i]\" ";
					echo "}";
				}
				else if($m[4]==2){	//거절됨
					echo "{";
					echo "partyid: \"$p_id[$i]\", ";
					echo "partyname: \"$p_name[$i]\", ";
					echo "partypic: \"$p_pic[$i]\", ";
					echo "confirms: \"$p_confirm[$i]\" ";
					echo "}";
				}
			}
		echo "]";
	}
	else{
		echo "menum: 0";
	}
		
	mysql_close();
?>
}
]]></data>
</result>