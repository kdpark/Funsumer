<? session_start();
	$id = $_SESSION['userid'];
	if(!$id)
	{
	    $id = $_COOKIE["usercookie"];
    }
    
    if(!$id)
    {
		// 로그아웃
	    echo(" <script> top.location.href='index.php'; </script> ");
    }
    
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
	include "dbconn.php";
	$school = $_POST['school'];
	
	$sql = "update member set university='$school' where id='$id'";
	mysql_query($sql,$connect);
	
	$sql = "select id from party where pname='$school'";
	$result = mysql_query($sql,$connect);
	$row = mysql_num_rows($result);
	
	if($row){
		$rows = mysql_fetch_array($result);
		$sql = "insert into partyjoin(member_id, party_id, visit_count, bookmark, id, join_time, visit_time, notice) values('$id', '$rows[0]', '1', '0', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '0')";
		mysql_query($sql,$connect);
	}
	else{
		
	}
	mysql_close();
?>
