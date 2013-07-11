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
	
	$sql = "select distinct j.member_id, m.gender from member m, partyjoin j where j.party_id=$pid and m.id=j.member_id";
	$result = mysql_query($sql,$connect);
	$ex = mysql_num_rows($result);
	
	for($i=0;$i<$ex;$i++){
		mysql_data_seek($result,$i);
		$row = mysql_fetch_array($result);
		
		if($row[0]!=1){
			$mid_array[$i] = $row[0];			
			$mid_gender[$i] = $row[1];
			
			$sql1 = "select*from friend_vote where to_mem='$row[0]'";
			$result1 = mysql_query($sql1,$connect);
			$mid_vote[$i] = mysql_num_rows($result1);		
		}
	}
	
	for($i=0;$i<$ex;$i++){
		if($mid_gender[$i]==1){
			if(!$man){
				$man = $mid_array[$i];
				$manvote = $mid_vote[$i];
			}
			else{
				if($manvote < $mid_vote[$i]){
					$man = $mid_array[$i];
					$manvote = $mid_vote[$i];
				}
				else{
					continue;
				}
			}
		}
		else{		
			if(!$woman){
				$woman = $mid_array[$i];
				$womanvote = $mid_vote[$i];
			}
			else{
				if($womanvote < $mid_vote[$i]){
					$woman = $mid_array[$i];
					$womanvote = $mid_vote[$i];
				}
				else{
					continue;
				}
			}
		}		
	}
	
	if($man){
		$sql = "select name, profilepic from member where id='$man'";
		$result = mysql_query($sql,$connect);
		$maninfo = mysql_fetch_array($result);
		echo "manid: $man, ";
		echo "manname: \"$maninfo[0]\", ";
		echo "manpic: \"$maninfo[1]\", ";
		echo "manvote: \"$manvote\"";
		if($woman){
		echo ", ";
		}
	}
	
	if($woman){
		$sql = "select name, profilepic from member where id='$woman'";
		$result = mysql_query($sql,$connect);
		$womaninfo = mysql_fetch_array($result);
		echo "womanid: $woman, ";
		echo "womanname: \"$womaninfo[0]\", ";
		echo "womanpic: \"$womaninfo[1]\", ";
		echo "womanvote: \"$womanvote\"";
	}
	
	mysql_close();
?>
}
]]></data>
</result>