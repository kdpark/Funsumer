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
	$partyid = $_POST['partyid'];
	
	$sql = "select distinct n.ar_num, a.a_content, a.time, a.pic, a.scrapper, m.name, m.id, m.profilepic, p.pname, n.title from notice n, article a, member m, party p where n.party=$partyid and a.id=n.ar_num and m.id=a.mem and p.id=$partyid order by a.time desc";
	$result = mysql_query($sql,$connect);
	$total_record = mysql_num_rows($result);
	
	if($total_record){
		echo "Num: \"$total_record\", article: [";
		for($i=0;$i<$total_record;$i++){
			if($i>0) echo ", ";
			mysql_data_seek($result,$i);
			$row = mysql_fetch_array($result);
			
			$sql0 = "select*from member where id='$row[4]'";
			$result0 = mysql_query($sql0,$connect);
			$scrapping = mysql_fetch_array($result0);
			
			echo "{\r\n";
			echo "Title: \"$row[9]\", ";
			echo "articleID: \"$row[0]\", ";
			echo "author: \"$row[5]\", ";
			echo "authorProfile: \"$row[7]\", ";
			echo "authorID: \"$row[6]\", ";
			echo "content: \"$row[1]\", ";
			echo "time: \"$row[2]\", ";
			echo "apic: \"$row[3]\", ";
			echo "scrapper: \"$scrapping[0]\", ";
			echo "scrapperID: \"$scrapping[4]\", ";
			echo "scrapperPic: \"$scrapping[11]\", ";
			echo "isparty: 1, ";
			echo "belong: \"$row[8]\",";
			echo "belongID: $partyid,";			
			
			/////////// 좋아요 싫어요 기능!!!
			$sql2 = "select a.point from article_like a where a.mem=$id and a.article=$row[0]";
			$result2 = mysql_query($sql2, $connect);
			$total_record2 = @mysql_num_rows($result2);
			if($total_record2==0) // 투표한적 없음. 링크 띄워줌
			{
				echo "vote: 0,";				
			}
			else // 투표 했으면 안 띄워줌
			{
				echo "vote: 1,";
			}
			
			$sql01 = "select id from article where origin='$row[0]'";
			$result01 = mysql_query($sql01,$connect);
			$exa = mysql_num_rows($result01);
			echo "ScrapNum: \"$exa\", ";
			
			// 이 글을 좋아하는 사람
			$sql2 = "select m.name, m.id, m.profilepic from member m, article_like a where a.article=$row[0] and a.point=1 and m.id=a.mem order by a.time desc";
			$result2 = mysql_query($sql2, $connect);
			$total_record2 = mysql_num_rows($result2);
			echo "likenum: $total_record2,";
			echo "like: [";
			for($k=0;$k<$total_record2;$k++)
			{
				if($k>0)
					echo ",\r\n";
				mysql_data_seek($result2, $k);
				$row2 = mysql_fetch_array($result2);
				// row 로 받아온 상태!
				echo "{\r\n";
				echo "id : \"$row2[1]\",";
				echo "name: \"$row2[0]\",";
				echo "profile : \"$row2[2]\"";				
				echo "}\r\n";
			}
			echo "],\r\n";
						
			//echo "댓글내용 : ".$row[r_content];
			$sql2 = "select m.name, m2.name, r.r_content, r.time, m2.id, r.id, m2.profilepic from member m, member m2, reply r, article a where a.mem=m.id and r.r_article=a.id and m2.id=r.r_mem and a.id=$row[0] order by r.time desc";
			$result2 = mysql_query($sql2, $connect);
			$total_record2 = mysql_num_rows($result2);
			echo "NumberOfComment: $total_record2, ";
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
			
			echo "}\r\n";
		}
		echo "]\r\n";
	}
	mysql_close();
?>
}
]]></data>
</result>