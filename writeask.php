<?  
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
	$content = $_POST['content'];	
		
	$content = htmlspecialchars($content);
	$content = addslashes($content); 
	$content = str_replace("\n","<br>",$content);	
	
	$sql = "insert into article(id,mem, party, mynote, time, a_content, a_open) values (NULL,'-1', '-1', '-1', CURRENT_TIMESTAMP, '$content', '2')";
	mysql_query($sql,$connect);
	
	echo "Result: \"1\"";
			
	mysql_close();
?>
}
]]></data>
</result>