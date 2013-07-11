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
	$anum = $_POST['anum'];
	$aid = $_POST['aid'];
	
	$arid = explode(",",$aid);
	
	for($i=0;$i<$anum;$i++){
		$sql = "update message m set m.mread='1' where m.id='$arid[$i]'";	
		mysql_query($sql,$connect);	
	}
	
	$sql = "delete from party_join where mem='$id' and auth='1'";
	mysql_query($sql,$connect);
	
	$sql = "delete from party_join where mem='$id' and auth='2'";
	mysql_query($sql,$connect);
	
	mysql_close();
?>
}
]]></data>
</result>