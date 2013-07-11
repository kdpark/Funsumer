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
	$articleID = $_POST['articleID'];
	$opt = $_POST['opt'];
	$startindex = $_POST['startindex'];
	$cases = $_POST['cases'];
	
	if($opt==1){	//alview
		//echo "댓글내용 : ".$row[r_content];
		$sql2 = "select m.name, m2.name, r.r_content, r.time, m2.id, r.id, m2.profilepic from member m, member m2, reply r, article a where a.mem=m.id and r.r_article=a.id and m2.id=r.r_mem and a.id=$articleID order by r.time desc";
		$result2 = mysql_query($sql2, $connect);
		$total_record2 = mysql_num_rows($result2);
		echo "NumberOfComment: $total_record2, ";
		echo "cases: $cases, ";
		echo "comment: [";
		for($k=0;$k<$total_record2;$k++)
		{
			if($k>0)
				echo ",\r\n";
			mysql_data_seek($result2, $k);
			$row2 = mysql_fetch_array($result2);
			// row 로 받아온 상태!
			echo "{\r\n";
			echo "rid: \"$row2[5]\",";
			echo "mid: \"$row2[4]\",";
			echo "name: \"$row2[1]\",";
			echo "text: \"$row2[2]\",";
			echo "profile: \"$row2[6]\","; // 프로필 사진
			echo "time: \"$row2[3]\"";
			echo "}\r\n";
		}
		echo "]\r\n";	
	}
	else if($opt==2){	//moreview
		$sql2 = "select m.name, m2.name, r.r_content, r.time, m2.id, r.id, m2.profilepic from member m, member m2, reply r, article a where a.mem=m.id and r.r_article=a.id and m2.id=r.r_mem and a.id=$articleID order by r.time desc";
		$result2 = mysql_query($sql2, $connect);
		$total_record2 = mysql_num_rows($result2);
		echo "NumberOfComment: $total_record2, ";
		if($startindex==0){ $a = 3; }
		else{ $a = $startindex; }
		
		$lastindex = $startindex + 50;
		
		echo "ST: $a, ";		
		echo "ED: $lastindex, ";
		echo "cases: $cases, ";
		echo "comment: [";
		
		for($k=$startindex;$k<$lastindex;$k++)
		{
			if($k>0)
				echo ",\r\n";
			mysql_data_seek($result2, $k);
			$row2 = mysql_fetch_array($result2);
			// row 로 받아온 상태!
			echo "{\r\n";
			echo "rid: \"$row2[5]\",";
			echo "mid: \"$row2[4]\",";
			echo "name: \"$row2[1]\",";
			echo "text: \"$row2[2]\",";
			echo "profile: \"$row2[6]\","; // 프로필 사진
			echo "time: \"$row2[3]\"";
			echo "}\r\n";
		}
		echo "]\r\n";			
	}
	mysql_close();
?>
}
]]></data>
</result>