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
	$req_party = $_POST['req_party'];
	$permis = $_POST['permis'];	
	$publik = $_POST['publik'];

	$sql = "update party set p_public='$publik' where id='$req_party'";
	mysql_query($sql,$connect);
	
	$sql = "update party set p_permission='$permis' where id='$req_party'";
	mysql_query($sql,$connect);
	
	mysql_close();
?>
}
]]></data>
</result>