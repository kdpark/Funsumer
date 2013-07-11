<? session_start();ob_start();
	$id = $_SESSION['userid'];
	if(!$id)
	{
	    $id = $_COOKIE["usercookie"];
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
	$dlength = $_POST['dlength'];
	$list = $_POST['list'];
	$array = explode(",",$list);
	$count = 0;
	for($i=0;$i<$dlength;$i++){
		if($array[$i]){
			$sql = "select*from member where facebook='$array[$i]'";
			$result = mysql_query($sql,$connect);
			$ex = mysql_num_rows($result);
			if($ex){
				$row = mysql_fetch_array($result);
				$fbname[$count] = $row[0];
				$fbid[$count] = $row[4];
				$fbpic[$count] = $row[11];
				$count++;			
			}
		}
	}	
	echo "num: $count, ";
	
	echo "fbfriend: [";
	for($i=0;$i<$count;$i++){
		if($id!=$fbid[$i]){
			if($i>0) echo ",\r\n";
			echo "{";
			echo "name: \"$fbname[$i]\", ";
			echo "id: \"$fbid[$i]\", ";
			echo "pic: \"$fbpic[$i]\", ";
			
			$sql2 = "select*from friendship where mem1='$id' and mem2='$fbid[$i]'";
			$result2 = mysql_query($sql2,$connect);
			$ex2 = mysql_num_rows($result2);
			if($ex2){
				echo "stat: \"1\"";	//already friend
			}
			else{
				echo "stat: \"2\"";
			}
			
			echo "}";
		}
	}
	echo "]";
	
	
	mysql_close();
?>
}
]]></data>
</result>