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
$uid = $_POST['uid'];
	$sql = "select*from friendship where mem1='$uid'";
	$result = mysql_query($sql,$connect);
	$ex = mysql_num_rows($result);
	echo "frnum: \"$ex\", ";
	$sql = "select*from friend_vote where to_mem='$uid'";
	$result = mysql_query($sql,$connect);
	$ex = mysql_num_rows($result);
	echo "votenum: \"$ex\"";
	
	mysql_close();
?>
}
]]></data>
</result>