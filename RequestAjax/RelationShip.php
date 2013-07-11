<? session_start();ob_start();
	$id = $_COOKIE["usercookie"];
    if(!$id)
    {
	    $id = $_SESSION['userid'];	    
    }
    
	
	//////////// 이름 얻기 : me 는 로그인한 세션의 정보
	include "../dbconn.php";
	$sql = "select * from member m where m.id='$id'";
	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result);
	$me = mysql_fetch_array($result);
    
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
	$mynoteid = $_POST['mynoteid'];
	if($id==$mynoteid){
		echo "Fstat: 0";
	}
	else{	
		$sql = "select*from friendship where mem1='$id' and mem2='$mynoteid'";
		$result = mysql_query($sql,$connect);
		$ex = mysql_num_rows($result);
		if($ex){
			echo "Fstat: 1";
		}
		else{
			$sql1 = "select*from friend_req where from_mem='$id' and to_mem='$mynoteid'";
			$result1 = mysql_query($sql1,$connect);
			$ex1 = mysql_num_rows($result1);
			if($ex1){
				echo "Fstat: 2";	
			}
			else{
				$sql2 = "select*from friend_req where from_mem='$mynoteid' and to_mem='$id'";
				$result2 = mysql_query($sql2,$connect);
				$ex2 = mysql_num_rows($result2);
				if($ex2){
					echo "Fstat: 3";
				}
				else{
					echo "Fstat: 4";
				}
			}			
		}
	}
	mysql_close();
?>
}
]]></data>
</result>