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
	$sql = "select party_id from partyjoin where member_id='$id'";
	$result = mysql_query($sql,$connect);
	$userpartynum = mysql_num_rows($result);
	for($i=0;$i<$userpartynum;$i++){
		mysql_data_seek($result,$i);
		$a = mysql_fetch_array($result);
		$userpartylist[$i] = $a[0];
	}


	$req_party = $_POST['req_party'];
	
	$sql = "select member_id from partyjoin where party_id='$req_party' order by join_time";
	$result = mysql_query($sql,$connect);
	$user_pnum = mysql_num_rows($result);
	
	if($user_pnum){
		echo "MemberNum: \"$user_pnum\", Member: [\r\n";
		for($i=0;$i<$user_pnum;$i++){
			$ct = 0;	
			mysql_data_seek($result,$i);
			$upi= mysql_fetch_array($result);	
			if($i>0) echo ", ";
			echo "{\r\n";
					$sql1 = "select m.name, m.profilepic from member m where m.id=$upi[0]";
					$result1 = mysql_query($sql1,$connect);
					$re_data = mysql_fetch_array($result1);
					echo "Fid: \"$upi[0]\", ";
					echo "Fname: \"$re_data[0]\", ";
					echo "Fpic: \"$re_data[1]\", ";
					
					if($upi[0]==$id){
						echo "Fparty: \"-1\", Fstat: \"5\"";
					}
					else{							
							for($j=0;$j<$userpartynum;$j++){								
								$sql2 = "select*from partyjoin where member_id='$upi[0]' and party_id='$userpartylist[$j]'";	
								$result2 = mysql_query($sql2,$connect);
								$aa = mysql_num_rows($result2);							
								if($aa){									
									$ct = $ct + 1;
								}
							}
							echo "Fparty: \"$ct\", ";
							 			
							$sql2 = "select*from friendship where mem1='$id' and mem2='$upi[0]'";
							$result2 = mysql_query($sql2,$connect);
							$a = mysql_num_rows($result2);
							if($a){
								echo "Fstat: \"1\" ";
							}
							else{
								$sql3 = "select*from friend_req where from_mem='$id' and to_mem='$upi[0]'";
								$result3 = mysql_query($sql3,$connect);
								$b = mysql_num_rows($result3);
								if($b){
									echo "Fstat: \"2\" ";
								}
								else{
									$sql4 = "select*from friend_req where from_mem='$upi[0]' and to_mem='$id'";
									$result4 = mysql_query($sql4,$connect);
									$c = mysql_num_rows($result4);
									if($c){
										echo "Fstat: \"3\" ";
									}
									else{
										echo "Fstat: \"4\" ";
									}
								}
							}
					}
			
			echo "}\r\n";
		}
		echo "]\r\n";
	}		
	
mysql_close();
?>
}
]]></data>
</result>