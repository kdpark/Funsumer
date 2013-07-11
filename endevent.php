<? session_start();										
	$id = $_COOKIE["usercookie"];						
    if(!$id)
    {
	    $id = $_SESSION['userid'];	    
    }
	
    include "dbconn.php";
	
	$sql = "select university from member where id='$id'";
	$result = mysql_query($sql,$connect);
	$sch = mysql_fetch_array($result);
	
	$sql = "select*from event where target='$sch[0]'";
	$result = mysql_query($sql,$connect);
	$rows = mysql_num_rows($result);
	$row = mysql_fetch_array($result);			
	$evnum = $row[1];
	
	$sql = "select present from event where event_num='$row[1]'";
	$result = mysql_query($sql,$connect);
	$ok = mysql_fetch_array($result);
	
	if($rows!=0 && $ok[0]!=0){
		$sql = "update event set present='0' where event_num='$evnum'";
		mysql_query($sql,$connect);
	}
	else{
		//nothing
	}
	
	mysql_close();
?>
