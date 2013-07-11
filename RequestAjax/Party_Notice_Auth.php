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
	$pid = $_POST['pid'];
	$fid = $_POST['fid'];
	$position = $_POST['position'];
	
	if($position==1){
		$sql = "update partyjoin set notice='1' where party_id='$pid' and member_id='$fid'";
		mysql_query($sql,$connect);
	}
	else{
		$sql = "update partyjoin set notice='0' where party_id='$pid' and member_id='$fid'";
		mysql_query($sql,$connect);
	}
	
			
	mysql_close();
?>
}
]]></data>
</result>