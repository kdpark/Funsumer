<? session_start();ob_start();
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
    
    include "dbconn.php";
	require("util.php");
	
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
$partyid = $_POST['partyid'];

if($opt==1){
	$sql = "select widethumbpic, widey from member where id='$id'";
	$result = mysql_query($sql,$connect);
	$value = mysql_fetch_array($result);
	$size = getimagesize($value[0]);
	echo "Widepic: \"$value[0]\", Height:\"$size[1]\", Y:\"$value[1]\"";
}
else if($opt==2){
	$sql = "select profilepic from member where id='$id'";
	$result = mysql_query($sql,$connect);
	$value = mysql_fetch_array($result);
	echo "Profilepic: \"$value[0]\"";
}
else if($opt==3){
	$sql = "select pic from party where id='$partyid'";
	$result = mysql_query($sql,$connect);
	$value = mysql_fetch_array($result);
	$size = getimagesize($value[0]);
	echo "Pic: \"$value[0]\", Height: \"$size[1]\" ";
}

?>
}
]]></data>
</result>