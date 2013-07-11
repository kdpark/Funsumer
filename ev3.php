<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<? 
    include "dbconn.php";
	
	$evnum = $_POST['evnum'];
	
	$sql = "select*from event2 where target1='$evnum' or target2='$evnum' and present='1'";
	$result = mysql_query($sql,$connect);
	$rows = mysql_num_rows($result);
	
	if($rows){
		
	}
	else{
		if($evnum==1){	//휘경
			$sql = "select target from event where event_num='$evnum'";
			$result = mysql_query($sql,$connect);
			$oo = mysql_fetch_array($result);
			
			$sql = "select*from member where university='$oo[0]' and gender='2'";
			$result = mysql_query($sql,$connect);
			$rows = mysql_num_rows($result);
			$counts = 0;
					
			for($i=0;$i<$rows;$i++){
				mysql_data_seek($result,$i);
				$row = mysql_fetch_array($result);
				
				$sqll = "select*from friend_vote where to_mem='$row[4]' and time > '2013-06-07'";
				$resultl = mysql_query($sqll,$connect);
				$vote = mysql_num_rows($resultl);
				$ii = $vote;
				
				if($row[4]!=1 && $ii!=0 && $row[4]!=3 && $row[4]!=5 && $row[4]!=2){
					$f_id[$counts] = $row[4];
									
					$sqll = "select*from friend_vote where to_mem='$row[4]' and time > '2013-06-07'";
					$resultl = mysql_query($sqll,$connect);
					$vote = mysql_num_rows($resultl);
					$f_vote[$counts] = $vote;
									
					$counts++;
				}//if
			}//for
			
			for($i=0;$i<$counts-1;$i++){
				for($j=$i;$j<$counts;$j++){
					if($f_vote[$i] < $f_vote[$j]){
						$temp = $f_id[$i];
						$f_id[$i] = $f_id[$j];
						$f_id[$j] = $temp;
						
						$temp = $f_vote[$i];
						$f_vote[$i] = $f_vote[$j];
						$f_vote[$j] = $temp;
					}
				}		
			}
			for($i=0;$i<3;$i++){				
				$sql = "insert into event2(id, target1, target2, begin_time, end_time, present, member, position) values(NULL, '1', '2', '2013-06-14 00:00:00', '2013-06-21 00:00:00', '1', '$f_id[$i]', '1')";
				mysql_query($sql,$connect);
			}
			//************************************************************************************************************************************************************************************************//
			$evnum = 2;
			$sql = "select target from event where event_num='$evnum'";
			$result = mysql_query($sql,$connect);
			$oo = mysql_fetch_array($result);
			
			$sql = "select*from member where university='$oo[0]' and gender='2'";
			$result = mysql_query($sql,$connect);
			$rows = mysql_num_rows($result);
			$counts = 0;
					
			for($i=0;$i<$rows;$i++){
				mysql_data_seek($result,$i);
				$row = mysql_fetch_array($result);
				
				$sqll = "select*from friend_vote where to_mem='$row[4]' and time > '2013-06-07'";
				$resultl = mysql_query($sqll,$connect);
				$vote = mysql_num_rows($resultl);
				$ii = $vote;
				
				if($row[4]!=1 && $ii!=0 && $row[4]!=3 && $row[4]!=5 && $row[4]!=2){
					$f_id[$counts] = $row[4];
									
					$sqll = "select*from friend_vote where to_mem='$row[4]' and time > '2013-06-07'";
					$resultl = mysql_query($sqll,$connect);
					$vote = mysql_num_rows($resultl);
					$f_vote[$counts] = $vote;
									
					$counts++;
				}//if
			}//for
			
			for($i=0;$i<$counts-1;$i++){
				for($j=$i;$j<$counts;$j++){
					if($f_vote[$i] < $f_vote[$j]){
						$temp = $f_id[$i];
						$f_id[$i] = $f_id[$j];
						$f_id[$j] = $temp;
						
						$temp = $f_vote[$i];
						$f_vote[$i] = $f_vote[$j];
						$f_vote[$j] = $temp;
					}
				}		
			}
			for($i=0;$i<3;$i++){				
				$sql = "insert into event2(id, target1, target2, begin_time, end_time, present, member, position) values(NULL, '1', '2', '2013-06-14 00:00:00', '2013-06-21 00:00:00', '1', '$f_id[$i]', '2')";
				mysql_query($sql,$connect);
			}
		}
		else if($evnum==2){	//해성여***********************************************************************************************************************************//
			$sql = "select target from event where event_num='$evnum'";
			$result = mysql_query($sql,$connect);
			$oo = mysql_fetch_array($result);
			
			$sql = "select*from member where university='$oo[0]' and gender='2'";
			$result = mysql_query($sql,$connect);
			$rows = mysql_num_rows($result);
			$counts = 0;
			
			for($i=0;$i<$rows;$i++){
				mysql_data_seek($result,$i);
				$row = mysql_fetch_array($result);
				
				$sqll = "select*from friend_vote where to_mem='$row[4]' and time > '2013-06-07'";
				$resultl = mysql_query($sqll,$connect);
				$vote = mysql_num_rows($resultl);
				$ii = $vote;
				
				if($row[4]!=1 && $ii!=0 && $row[4]!=3 && $row[4]!=5 && $row[4]!=2){
					$f_id[$counts] = $row[4];
									
					$sqll = "select*from friend_vote where to_mem='$row[4]' and time > '2013-06-07'";
					$resultl = mysql_query($sqll,$connect);
					$vote = mysql_num_rows($resultl);
					$f_vote[$counts] = $vote;
									
					$counts++;
				}//if
			}//for
			
			for($i=0;$i<$counts-1;$i++){
				for($j=$i;$j<$counts;$j++){
					if($f_vote[$i] < $f_vote[$j]){
						$temp = $f_id[$i];
						$f_id[$i] = $f_id[$j];
						$f_id[$j] = $temp;
						
						$temp = $f_vote[$i];
						$f_vote[$i] = $f_vote[$j];
						$f_vote[$j] = $temp;
					}
				}		
			}			
			for($i=0;$i<3;$i++){				
				$sql = "insert into event2(id, target1, target2, begin_time, end_time, present, member, position) values(NULL, '1', '2', '2013-06-14 00:00:00', '2013-06-21 00:00:00', '1', '$f_id[$i]', '2')";
				mysql_query($sql,$connect);
			}
			//************************************************************************************************************************************************************************************************//
			$evnum = 1;
			$sql = "select target from event where event_num='$evnum'";
			$result = mysql_query($sql,$connect);
			$oo = mysql_fetch_array($result);
			
			$sql = "select*from member where university='$oo[0]' and gender='2'";
			$result = mysql_query($sql,$connect);
			$rows = mysql_num_rows($result);
			$counts = 0;
			
			for($i=0;$i<$rows;$i++){
				mysql_data_seek($result,$i);
				$row = mysql_fetch_array($result);
				
				$sqll = "select*from friend_vote where to_mem='$row[4]' and time > '2013-06-07'";
				$resultl = mysql_query($sqll,$connect);
				$vote = mysql_num_rows($resultl);
				$ii = $vote;
				
				if($row[4]!=1 && $ii!=0 && $row[4]!=3 && $row[4]!=5 && $row[4]!=2){
					$f_id[$counts] = $row[4];
									
					$sqll = "select*from friend_vote where to_mem='$row[4]' and time > '2013-06-07'";
					$resultl = mysql_query($sqll,$connect);
					$vote = mysql_num_rows($resultl);
					$f_vote[$counts] = $vote;
					
					$counts++;
				}//if
			}//for
			
			for($i=0;$i<$counts-1;$i++){
				for($j=$i;$j<$counts;$j++){
					if($f_vote[$i] < $f_vote[$j]){
						$temp = $f_id[$i];
						$f_id[$i] = $f_id[$j];
						$f_id[$j] = $temp;
						
						$temp = $f_vote[$i];
						$f_vote[$i] = $f_vote[$j];
						$f_vote[$j] = $temp;
					}
				}		
			}
			for($i=0;$i<3;$i++){					
				$sql = "insert into event2(id, target1, target2, begin_time, end_time, present, member, position) values(NULL, '1', '2', '2013-06-14 00:00:00', '2013-06-21 00:00:00', '1', '$f_id[$i]', '1')";
				mysql_query($sql,$connect);
			}
		}
		
	}
	
	mysql_close();
?>
