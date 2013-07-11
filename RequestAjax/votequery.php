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
	$uid = $_POST['uid'];
	$sql = "select NOW();";
	$result = mysql_query($sql,$connect);
	$current_now = mysql_fetch_array($result);
	$current_day = explode(" ",$current_now[0]);
	$devi_day = explode("-",$current_day[0]);
	
	if($opt==2){
	
		$sql = "select time from friend_vote where from_mem='$id' and to_mem='$uid' order by time desc";
		$result = mysql_query($sql,$connect);
		$a = mysql_num_rows($result);
		if($a){
			mysql_data_seek($result,0);	
			$dbtime = mysql_fetch_array($result);
			$db_time = explode("-",$dbtime[0]);
			
			if($dbtime[0]==$current_day[0]){
				echo "P: 0";
			}
			else{
				echo "P: 1";
			}			
		}
		else{
			echo "P: 1";
		}

	}
	else if($opt==1){	
		$sql = "select time from friend_vote where from_mem='$id' and to_mem='$uid' order by time desc";
		$result = mysql_query($sql,$connect);
		$a = mysql_num_rows($result);
		if($a){
			mysql_data_seek($result,0);	
			$dbtime = mysql_fetch_array($result);
			$db_time = explode("-",$dbtime[0]);
			
		}
				
		if($db_time[0] < $devi_day[0]){
			$sql = "insert into friend_vote(id, from_mem, to_mem, time) values(NULL, '$id', '$uid', '$current_day[0]')";
			mysql_query($sql,$connect);
		}
		else if($db_time[0] == $devi_day[0]){
			if($db_time[1] < $devi_day[1]){
				$sql = "insert into friend_vote(id, from_mem, to_mem, time) values(NULL, '$id', '$uid', '$current_day[0]')";
				mysql_query($sql,$connect);
			}
			else if($db_time[1] == $devi_day[1]){
				if($db_time[2] < $devi_day[2]){
					$sql = "insert into friend_vote(id, from_mem, to_mem, time) values(NULL, '$id', '$uid', '$current_day[0]')";
					mysql_query($sql,$connect);
				}
				else{
					break;
				}
			}
			else{
				break;
			}
		}
		else{
			break;
		}
	
	}
	
	mysql_close();
?>
}
]]></data>
</result>