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
	
	$sql = "select admin from party where id='$req_party'";
	$result = mysql_query($sql,$connect);
	$admin = mysql_fetch_array($result);
	
	$sql = "select id, name, profilepic from member where id='$admin[0]'";
	$result = mysql_query($sql,$connect);
	$ad_p = mysql_fetch_array($result);
	
	$sql = "select member_id, notice from partyjoin where party_id='$req_party'";
	$result = mysql_query($sql,$connect);
	$user_pnum = mysql_num_rows($result);
	
	if($user_pnum){
		echo "MemberNum: \"$user_pnum\", Admin: \"$admin[0]\", Member: [\r\n";
		
		echo "{\r\n";
		echo "Fid: \"$ad_p[0]\", ";
		echo "Fname: \"$ad_p[1]\", ";
		echo "Fpic: \"$ad_p[2]\", ";
		echo "Fnotice: \"1\" ";
		echo "}\r\n";
		
		for($i=0;$i<$user_pnum;$i++){
			mysql_data_seek($result,$i);
			$upi= mysql_fetch_array($result);	
			
			if($upi[0]==$admin[0]){
			}
			else{			
				if($user_pnum>1) echo ", ";
				echo "{\r\n";
				$sql1 = "select m.name, m.profilepic from member m where m.id=$upi[0]";
				$result1 = mysql_query($sql1,$connect);
				$re_data = mysql_fetch_array($result1);
				echo "Fid: \"$upi[0]\", ";
				echo "Fname: \"$re_data[0]\", ";
				echo "Fpic: \"$re_data[1]\", ";
				echo "Fnotice: \"$upi[1]\" ";
				echo "}\r\n";
			}
		}
		echo "]\r\n";
	}		
	mysql_close();
?>
}
]]></data>
</result>