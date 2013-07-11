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
	$articleID = $_POST['articleID'];
	
	$sql = "select origin from article where id='$articleID'";
	$result = mysql_query($sql,$connect);
	$origin_ID = mysql_fetch_array($result);
	
	$sql = "select distinct a.a_content, a.time, a.party, a.mynote, m.name, m.id, m.profilepic, a.pic, a.scrapper, a.notice, a.caption from article a, member m, party p where a.id=$origin_ID[0] and m.id=a.mem order by a.time desc";
	$result = mysql_query($sql,$connect);
	$total_record = mysql_num_rows($result);
	
	if($total_record){
		echo "NumberOfArticle: $total_record, ";		
		echo "article: [";
		
		$row = mysql_fetch_array($result);
		
		 $sql0 = "select*from member where id='$row[8]'";
		 $result0 = mysql_query($sql0,$connect);
		 $scrapping = mysql_fetch_array($result0);
		 
		// row 로 받아온 상태!
		$j = $i+1;
		$contents = toJS($row[0]);
		echo "{\r\n";
		echo "articleID: \"$origin_ID[0]\","; // 글번호 (삭제 예정)
		echo "author: \"$row[4]\","; //(글쓴이)
		echo "authorID: \"$row[5]\","; //(글쓴이)
		echo "authorProfile: \"$row[6]\","; //(글쓴이프로필사진)
		echo "content: \"$contents\","; // 글내용
		echo "time: \"$row[1]\","; // 날짜
		echo "apic: \"$row[7]\","; // 글 사진
		echo "scrapID: \"$scrapping[4]\",";
		echo "scrapName: \"$scrapping[0]\",";
		echo "scrapPic: \"$scrapping[11]\",";
		echo "notice: \"$row[9]\",";
		echo "caption: \"$row[10]\",";
		
		if($row[2]==0){
			echo "isparty: 0,";
			echo "belong: \"$row[4] 님의 마이노트\",";
			echo "belongID: $row[5],";
		}
		else{
			echo "isparty: 1,";
			$sql1 = "select pname from party where id='$row[2]'";
			$result1 = mysql_query($sql1,$connect);
			$oo = mysql_fetch_array($result1);
			echo "belong: \"$oo[0]\",";
			echo "belongID: $row[2],";
		}
		
		$sql01 = "select id from article where origin='$origin_ID[0]'";
		$result01 = mysql_query($sql01, $connect);
		$exa = mysql_num_rows($result01);
		echo "ScrapNum: \"$exa\", ";
		
		/*$sql9 = "select admin from party where id='$partyid'";
		$result9 = mysql_query($sql9, $connect);
		$padmin = mysql_fetch_array($result9);
		echo "belongAdmin: \"$padmin[0]\", ";
		echo "notice: \"$row[9]\", ";*/
		
		/////////// 좋아요 싫어요 기능!!!
			$sql2 = "select a.point from article_like a where a.mem=$id and a.article=$origin_ID[0]";
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
			
			// 이 글을 좋아하는 사람
			$sql2 = "select m.name, m.id, m.profilepic from member m, article_like a where a.article=$origin_ID[0] and a.point=1 and m.id=a.mem order by a.time desc";
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
			$sql2 = "select m.name, m2.name, r.r_content, r.time, m2.id, r.id, m2.profilepic from member m, member m2, reply r, article a where a.mem=m.id and r.r_article=a.id and m2.id=r.r_mem and a.id=$origin_ID[0] order by r.time desc";
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
			//opt 3 : 댓글 , toid : 글id
			echo "}\r\n";		
			echo "]\r\n";
	}
	mysql_close();
?>
}
]]></data>
</result>