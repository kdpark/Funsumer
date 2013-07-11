<? session_start();
	$id = $_SESSION['userid'];
	if(!$id)
	{
	    $id = $_COOKIE["usercookie"];
    }
    
    if(!$id)
    {
	    echo(" <script> top.location.href='index.php'; </script> ");
    }
    
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
	//$pid : party id
	//$id : session
	//$popt : option
	include "../dbconn.php";
	
	$pid = $_POST['pid'];	
	
		$sql = "select*from visit where from_mem='$id' and to_mem='$pid'";	
		$result = mysql_query($sql,$connect);
		$sub = mysql_num_rows($result);
		
		if($sub){
			$counting = mysql_fetch_array($result);
			$upcount = $counting[3] + 1;
			$sql = "update visit set count='$upcount' where from_mem='$id' and to_mem='$pid'";
			mysql_query($sql,$connect);
		}
		else{
			$sql = "insert into visit(id, from_mem, to_mem, count, to_party) values(NULL, '$id', '$pid', '1', '0')";
			mysql_query($sql,$connect);
		}
		
	mysql_close();
		

?>
