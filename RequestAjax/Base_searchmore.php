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
	$value = $_POST['value'];
	$opt = $_POST['opt'];
	
	if($value!=""){
		if($opt==1){	//사람
			$sql = "select*from member where name like '%$value%'";
			$result = mysql_query($sql,$connect);
			$pre = mysql_num_rows($result);
						
			echo "Type: 1, ";
			echo "Numbers: $pre, ";
			echo "people: [";
			if($pre){			
				for($i=0;$i<$pre;$i++){
					mysql_data_seek($result,$i);
					$searchname = mysql_fetch_array($result);
					
					$sql1 = "select distinct p.id, j.party_id from partyjoin j, partyjoin p where j.member_id='$searchname[4]' and p.party_id=j.party_id and p.member_id='$id'";
					$result1 = mysql_query($sql1,$connect);
					$sharenum = mysql_num_rows($result1);
					
					$memberid[$i] = $searchname[4];
					$membername[$i] = $searchname[0];
					$memberpic[$i] = $searchname[11];
					$membercount[$i] = $sharenum;
					
					if($id == $searchname[4]){
						$fstat[$i] = 0;	//본인
					}
					else{					
						$sql2 = "select*from friendship where mem1='$id' and mem2='$searchname[4]'";
						$result2 = mysql_query($sql2,$connect);
						$exa = mysql_num_rows($result2);
						if($exa){	//친구
							$fstat[$i] = 1;
						}
						else{
							$sql3 = "select*from friend_req where from_mem='$id' and to_mem='$searchname[4]'";
							$result3 = mysql_query($sql3,$connect);
							$exa = mysql_num_rows($result3);
							if($exa){	//요청보냄
								$fstat[$i] = 2;
							}
							else{
								$sql4 = "select*from friend_req where to_mem='$id' and from_mem='$searchname[4]'";
								$result4 = mysql_query($sql4,$connect);
								$exa = mysql_num_rows($result4);
								if($exa){	//요청받음
									$fstat[$i] = 3;
								}
								else{	//無
									$fstat[$i] = 4;
								}
							}
						}
					}
					
				}
				for($i=0;$i<$pre-1;$i++){
					for($j=$i+1;$j<$pre;$j++){
						if($membercount[$i] < $membercount[$j]){
							$temp = $membercount[$i];
							$membercount[$i] = $membercount[$j];
							$membercount[$j] = $temp;
							
							$temp = $memberid[$i];
							$memberid[$i] = $memberid[$j];
							$memberid[$j] = $temp;
							
							$temp = $membername[$i];
							$membername[$i] = $membername[$j];
							$membername[$j] = $temp;
							
							$temp = $memberpic[$i];
							$memberpic[$i] = $memberpic[$j];
							$memberpic[$j] = $temp;
							
							$temp = $fstat[$i];
							$fstat[$i] = $fstat[$j];
							$fstat[$j] = $temp;
						}
					}
				}
				
				for($i=0;$i<$pre;$i++){
					if($i>0) echo ",\r\n";			
					echo "{\r\n";
					echo "name: \"$membername[$i]\", ";
					echo "id: \"$memberid[$i]\", ";
					echo "pic: \"$memberpic[$i]\", ";
					echo "pcount: \"$membercount[$i]\", ";
					echo "fstat: \"$fstat[$i]\"";
					echo "}\r\n";
				}
				
				
				
			}	
			
			echo "],\r\n";
		}
		else if($opt==2){	//파티
			$sql = "select*from party where pname like '%$value%'";
			$result = mysql_query($sql,$connect);
			$pn = mysql_num_rows($result);
			
			echo "Type: 2, ";
			$discounter = 0;
			if($pn){
				for($i=0;$i<$pn;$i++){
					mysql_data_seek($result,$i);
					$searchparty = mysql_fetch_array($result);
					
					$sql1 = "select distinct f.mem2, j.id from friendship f, partyjoin j where f.mem1='$id' and j.party_id='$searchparty[2]' and j.member_id=f.mem2";
					$result1 = mysql_query($sql1,$connect);
					$rnum = mysql_num_rows($result1);
					
					$sqll = "select*from partyjoin where member_id='$id' and party_id='$searchparty[2]'";
					$rst = mysql_query($sqll,$connect);
					$or = mysql_num_rows($rst);
					
					if($or==1 || $searchparty[9]==0){
						$partyid[$i] = $searchparty[2];
						$partyname[$i] = $searchparty[0];
						$partypic[$i] = $searchparty[7];
						$partyadmin[$i] = $searchparty[1];
						$partycount[$i] = $rnum;
					}
					else{
						$discounter++;
					}
				}
				for($i=0;$i<($pn-$discounter)-1;$i++){
					for($j=$i+1;$j<($pn-$discounter);$j++){
						if($partycount[$i] < $partycount[$j]){
							$temp = $partycount[$i];
							$partycount[$i] = $partycount[$j];
							$partycount[$j] = $temp;
							
							$temp = $partyid[$i];
							$partyid[$i] = $partyid[$j];
							$partyid[$j] = $temp;
							
							$temp = $partypic[$i];
							$partypic[$i] = $partypic[$j];
							$partypic[$j] = $temp;
							
							$temp = $partyname[$i];
							$partyname[$i] = $partyname[$j];
							$partyname[$j] = $temp;
							
							$temp = $partyadmin[$i];
							$partyadmin[$i] = $partyadmin[$j];
							$partyadmin[$j] = $temp;
						}
					}
				}
			}
			echo "Numberss: ".($pn-$discounter).", ";
			echo "parties: [";
			for($i=0;$i<($pn-$discounter);$i++){
				if($i>0) echo ",\r\n";			
				echo "{\r\n";
				echo "pname: \"$partyname[$i]\", ";
				echo "pid: \"$partyid[$i]\", ";
				echo "ppic: \"$partypic[$i]\", ";
				echo "padmin: \"$partyadmin[$i]\", ";
				echo "pcount: \"$partycount[$i]\"";
				echo "}\r\n";
			}
			echo "]\r\n";
		}	
	}
	mysql_close();
?>
}
]]></data>
</result>