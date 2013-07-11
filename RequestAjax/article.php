<? session_start();ob_start();
	$id = $_SESSION['userid'];
	if(!$id)
	{
	    $id = $_COOKIE["usercookie"];
    }
    
    if(!$id)
    {
		// 로그아웃
	     /*echo(" <script> top.location.href='index.php'; </script> ");*/
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
	$mynoteid = $_POST['mynoteid'];
	$partyid = $_POST['partyid'];
	$whatsup = $_POST['whatsup'];
	// $mynoteid=1~xxx mynote 보기
	// $partyid=1~xxx party 글 보기
	// $id 는 현재 세션의 id
		
	//////////// 이름 얻기
	$sql = "select m.name from member m where m.id='$id'";
	$result = mysql_query($sql, $connect);
	$row = mysql_fetch_array($result);
	$total_record = mysql_num_rows($result);
	$name = $row[0];
	
	$sql = "select m.name from member m where m.id='$mynoteid'";
	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result);
	
	$row = mysql_fetch_array($result);
	$mynotename = $row[0];
		
	if($mynoteid) // mynote 글 요청
	{
		// mynote 에 남겨진 글을 조회함!		
		$sql = "select distinct a.a_content, a.time, a.id, m2.name, m2.id, a.party, m.name, m2.profilepic, m.id, a.pic, a.scrapper, a.notice, a.caption, a.a_open from member m,  member m2, article a where m.id=$mynoteid and a.mynote=m.id and m2.id=a.mem order by a.time desc";
		$result = mysql_query($sql, $connect);
		$total_record = mysql_num_rows($result);
				
		for($i=0;$i<$total_record;$i++)
		{
			mysql_data_seek($result, $i);
			$row = mysql_fetch_array($result);
			
			if($row[5]!=0){
				$sqll = "select p_public from party where id='$row[5]'";
				$rst = mysql_query($sqll,$connect);
				$ost = mysql_fetch_array($rst);
				
				$sqll = "select*from partyjoin where member_id='$id' and party_id='$row[5]'";
				$rst = mysql_query($sqll,$connect);
				$oost = mysql_num_rows($rst);
				if($ost[0]==0 || $oost==1){
				}
				else{
					$discounter++;
					continue;
				}
			}
			
			if($id!=$mynoteid){
				$ssql = "select*from partyjoin where party_id='$row[5]' and member_id='$id'";
				$rresult = mysql_query($ssql,$connect);
				$tt = mysql_num_rows($rresult);
			}
			if($id==$mynoteid || $row[13]!=2 || $tt!=0){
				$ma = true;
			}
			else{
				$ma = false;
			}
		
			if($id!=$mynoteid){
				$ssql = "select*from friendship where mem1='$id' and mem2='$mynoteid'";
				$rresult = mysql_query($ssql,$connect);
				$tt = mysql_num_rows($rresult);
			}
			if($row[13]==0 || $tt!=0 || $id==$mynoteid){
				$nf = true;
			}
			else{
				$nf = false;
			}
			
			if($row[13]!=2 && $nf){				
			}
			else if($row[13]==2 && $ma){				
			}
			else{
				$discounter++;
			}
		}
		
		echo "NumberOfArticle: ".($total_record-$discounter).", ";
		echo "Admin: $mynoteid, ";
		echo "article: [";
		$cc=0;
		for($i=0;$i<$total_record;$i++)
		{
			mysql_data_seek($result, $i);
			$row = mysql_fetch_array($result);
			
			if($row[5]!=0){
				$sqll = "select p_public from party where id='$row[5]'";
				$rst = mysql_query($sqll,$connect);
				$ost = mysql_fetch_array($rst);
				
				$sqll = "select*from partyjoin where member_id='$id' and party_id='$row[5]'";
				$rst = mysql_query($sqll,$connect);
				$oost = mysql_num_rows($rst);
			}
			
			if($row[5]==0 || $ost[0]==0 || $oost==1){
				
			
				if($id!=$mynoteid){
					$ssql = "select*from partyjoin where party_id='$row[5]' and member_id='$id'";
					$rresult = mysql_query($ssql,$connect);
					$tt = mysql_num_rows($rresult);
				}
				if($id==$mynoteid || $row[13]!=2 || $tt!=0){
					$memberauth = true;
				}
				else{
					$memberauth = false;
				}
				
				
				
				if($id!=$mynoteid){
					$ssql = "select*from friendship where mem1='$id' and mem2='$mynoteid'";
					$rresult = mysql_query($ssql,$connect);
					$tt = mysql_num_rows($rresult);
				}
				if($row[13]==0 || $tt!=0 || $id==$mynoteid){
					$notefrien = true;
				}
				else{
					$notefrien = false;
				}
				
				if($row[13]!=2 && $notefrien){
					$arauth = true;
				}
				else if($row[13]==2 && $memberauth){
					$arauth = true;
				}
				else{
					$arauth = false;
				}
				
				if($arauth){
					
					if($cc>0)
					 echo ",\r\n";
					// row 로 받아온 상태!
					$cc++;
					
					$sql0 = "select*from member where id='$row[10]'";
					$result0 = mysql_query($sql0,$connect);
					$scrapping = mysql_fetch_array($result0);
								 
					$j = $i+1;
					echo "{\r\n";			
					echo "articleID: \"$row[2]\", "; // 글번호 (삭제 예정)
					echo "author: \"$row[3]\", "; //(글쓴이)
					echo "authorID: \"$row[4]\", "; //(글쓴이id)
					echo "authorProfile: \"$row[7]\", "; //(글쓴이프로필사진)
					echo "content: \"$row[0]\", "; // 글내용
					echo "time: \"$row[1]\", "; // 날짜
					echo "apic: \"$row[9]\", "; // 글 사진
					echo "scrapID: \"$scrapping[4]\", ";
					echo "scrapName: \"$scrapping[0]\", ";
					echo "scrapPic: \"$scrapping[11]\", ";
					echo "notice: \"$row[11]\", ";
					echo "caption: \"$row[12]\", ";
					
					if($row[5]==0)
					{
						echo "isparty: 0,";
						echo "belong: \"$row[6]의 노트\", ";
						echo "belongID: $row[8], ";
						echo "belongAdmin: 0, ";
					}
					else
					{
						$query1 = "select p.pname, p.admin from party p where p.id=$row[5]";
						$result1 = mysql_query($query1,$connect);
						$sol = mysql_fetch_array($result1);
						echo "isparty: 1, ";
						echo "belong: \"$sol[0]\", "; // 파티 유무	
						echo "belongID: $row[5], ";
						echo "belongAdmin: \"$sol[1]\", ";		
					}
					
					
					$sql01 = "select id from article where origin='$row[2]'";
					$result01 = mysql_query($sql01,$connect);
					$exa = mysql_num_rows($result01);
					echo "ScrapNum: \"$exa\", ";
					
					/////////// 좋아요 싫어요 기능!!!
					$sql2 = "select a.point from article_like a where a.mem=$id and a.article=$row[2]";
					$result2 = mysql_query($sql2, $connect);
					$total_record2 = mysql_num_rows($result2);
					if($total_record2==0) // 투표한적 없음. 링크 띄워줌
					{
						echo "vote: 0,";				
					}
					else // 투표 했으면 안 띄워줌
					{
						echo "vote: 1,";
					}
					
					// 이 글을 좋아하는 사람
					$sql2 = "select m.name, m.id, m.profilepic from member m, article_like a where a.article=$row[2] and a.point=1 and m.id=a.mem order by a.time desc";
					$result2 = mysql_query($sql2, $connect);
					$total_record2 = mysql_num_rows($result2);
					echo "likenum: $total_record2, ";
					echo "like: [";
					for($k=0;$k<$total_record2;$k++)
					{
						if($k>0)
							echo ",\r\n";
						mysql_data_seek($result2, $k);
						$row2 = mysql_fetch_array($result2);
						// row 로 받아온 상태!
										
						echo "{\r\n";
						echo "id : \"$row2[1]\", ";
						echo "name: \"$row2[0]\", ";
						echo "profile : \"$row2[2]\" ";
						echo "}\r\n";
					}
					echo "],\r\n";
		
		
					// 댓글 표시 !!
					$sql2 = "select m.name, m2.name, r.r_content, r.time, m2.id, r.id, m2.profilepic from member m, member m2, reply r, article a where a.mem=m.id and r.r_article=a.id and m2.id=r.r_mem and a.id=$row[2] order by r.time";
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
						echo "rid: \"$row2[5]\", "; // reply id
						echo "mid: \"$row2[4]\", "; // 댓글 쓴 사람 id
						echo "name: \"$row2[1]\", "; // 댓글 쓴 사람 이름
						echo "text: \"$row2[2]\", ";
						echo "profile: \"$row2[6]\", "; // 프로필 사진
						echo "time: \"$row2[3]\" ";
						echo "}\r\n";
					}
					echo "]\r\n";
					//opt 3 : 댓글 , toid : 글id
					echo "}\r\n";
				}				
			}//if condition
		}//for
		echo "]";
		
	}
	
	
	//////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	else if($partyid)
	{
		// party name 받아오기
		$sql = "select p.pname from party p where p.id='$partyid'";
		$result = mysql_query($sql, $connect);
		$total_record = mysql_num_rows($result);
		$row = mysql_fetch_array($result);
		$pname = $row[0];
		
		///////// 파티 방문 통계량!!
		
		
		
		/////////////// 파티 가입원이 아니면 글 남기면 안됨!!
		// $id 가 $partyjoin 의 $partyid 에 가입이 되어있나?
		$sql = "select * from partyjoin p where p.party_id='$partyid' and p.member_id='$id'";
		$result = mysql_query($sql, $connect);
		$total_record = mysql_num_rows($result);
		
		
		
		// 되어있다면, 글 남기기
		if($total_record)
		{
			
			$isjoined =1;
			
		}
		else		// 글 남기고 싶으면 가입하세요
		{
			
		}

		
		
		////////////////
		// 글 받아오기//
		////////////////
		
		$sql = "select m.id, m.name, m.ename, m.profilepic from member m, party p where m.id=p.admin and p.id=$partyid";
		$result = mysql_query($sql, $connect);
		$admin = mysql_fetch_array($result);
		
		
		$sql = "select distinct a.a_content, a.time, a.id, m.name, m.id, m.profilepic, a.pic, a.scrapper, a.notice, a.caption, a.a_open from party p, article a, member m where p.id=$partyid and a.party=p.id and m.id=a.mem order by a.time desc";
		$result = mysql_query($sql, $connect);
		$total_record = mysql_num_rows($result);
		
		$discounter = 0;
		for($i=0;$i<$total_record;$i++)
		{
			mysql_data_seek($result, $i);
			$row = mysql_fetch_array($result);
			
			$sqll = "select p_public from party where id='$partyid'";
			$rst = mysql_query($sqll,$connect);
			$ost = mysql_fetch_array($rst);
			
			$sqll = "select*from partyjoin where member_id='$id' and party_id='$partyid'";
			$rst = mysql_query($sqll,$connect);
			$oost = mysql_num_rows($rst);
			
			if($row[10]!=2 || $oost!=0){
				
			}
			else{
				$discounter++;
			}
					
		}		
		
		if($ost[0]==0 || $oost==1){
			
			echo "NumberOfArticle: ".($total_record-$discounter).", ";
			echo "Admin: $admin[0], AdminName: \"$admin[1]\", AdminEname: \"$admin[2]\", AdminProf: \"$admin[3]\", ";
			echo "article: [";
			$cc=0;
			for($i=0;$i<$total_record;$i++)
			{
				mysql_data_seek($result, $i);
				$row = mysql_fetch_array($result);
				
				$sqll = "select*from partyjoin where member_id='$id' and party_id='$partyid'";
				$rst = mysql_query($sqll,$connect);
				$oost = mysql_num_rows($rst);
				
				if($row[10]!=2 || $oost==1){
					// row 로 받아온 상태!
					if($cc>0)
					 echo ",\r\n";
					$cc++;
					 
					 $sql0 = "select*from member where id='$row[7]'";
					 $result0 = mysql_query($sql0,$connect);
					 $scrapping = mysql_fetch_array($result0);
					 
					// row 로 받아온 상태!
					$j = $i+1;
					$contents = toJS($row[0]);
					echo "{\r\n";
					echo "articleID: \"$row[2]\","; // 글번호 (삭제 예정)
					echo "author: \"$row[3]\","; //(글쓴이)
					echo "authorID: \"$row[4]\","; //(글쓴이)
					echo "authorProfile: \"$row[5]\","; //(글쓴이프로필사진)
					echo "content: \"$contents\","; // 글내용
					echo "time: \"$row[1]\","; // 날짜
					echo "apic: \"$row[6]\","; // 글 사진
					echo "scrapID: \"$scrapping[4]\",";
					echo "scrapName: \"$scrapping[0]\",";
					echo "scrapPic: \"$scrapping[11]\",";
					echo "isparty: 1,";
					echo "belong: \"$pname\",";
					echo "belongID: $partyid,";
					$sql9 = "select admin from party where id='$partyid'";
					$result9 = mysql_query($sql9, $connect);
					$padmin = mysql_fetch_array($result9);
					echo "belongAdmin: \"$padmin[0]\", ";
					echo "notice: \"$row[8]\", ";
					echo "caption: \"$row[9]\", ";
					
					/////////// 좋아요 싫어요 기능!!!
					$sql2 = "select a.point from article_like a where a.mem=$id and a.article=$row[2]";
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
					
					$sql01 = "select id from article where origin='$row[2]'";
					$result01 = mysql_query($sql01,$connect);
					$exa = mysql_num_rows($result01);
					echo "ScrapNum: \"$exa\", ";
					
					// 이 글을 좋아하는 사람
					$sql2 = "select m.name, m.id, m.profilepic from member m, article_like a where a.article=$row[2] and a.point=1 and m.id=a.mem order by a.time desc";
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
					$sql2 = "select m.name, m2.name, r.r_content, r.time, m2.id, r.id, m2.profilepic from member m, member m2, reply r, article a where a.mem=m.id and r.r_article=a.id and m2.id=r.r_mem and a.id=$row[2] order by r.time desc";
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
				}
			}
			echo "]";
		}	//if-oost	
	}
	
	////////////////////////////////////////////////////////////what's up
	/////////////////////////////////////////////////////
	////////////////////////////////////////////
	else if($whatsup)
	{
		// 받아온 값으로... 뉴스피드 만들어줘야함.
	
		$sql = "select distinct a.a_content, a.time, a.id, m2.name, m2.id, a.party, m2.name, m2.profilepic, a.pic, a.scrapper, a.notice, a.caption, a.a_open from member m, member m2, article a, friendship f where m.id=$whatsup and f.mem1=m.id and f.mem2=m2.id and m2.id=a.mem order by a.time desc";
		$result = mysql_query($sql, $connect);
		$total_record = mysql_num_rows($result);
		
		$discounter = 0;
		
		for($i=0;$i<$total_record;$i++){
			mysql_data_seek($result, $i);
			$row = mysql_fetch_array($result);
			
			if($row[5]!=0){
				$sqll = "select p_public from party where id='$row[5]'";
				$rst = mysql_query($sqll,$connect);
				$ost = mysql_fetch_array($rst);
				
				$sqll = "select*from partyjoin where member_id='$id' and party_id='$row[5]'";
				$rst = mysql_query($sqll,$connect);
				$oost = mysql_num_rows($rst);
				if($ost[0]==0 || $oost==1){
				}
				else{
					$discounter++;
					continue;
				}
			}
			
			$ssql = "select*from partyjoin where party_id='$row[5]' and member_id='$id'";
			$rresult = mysql_query($ssql,$connect);
			$tt = mysql_num_rows($rresult);
			
			if($row[12]!=2 || $tt!=0){
				$ma = true;
			}
			else{
				$ma = false;
			}
			
			if($row[12]==2 && !$ma){				
				$discounter++;
			}
		}
		
		echo "NumberOfArticle: ".($total_record-$discounter).", ";
		echo "Admin: -99, "; // whatsup 의 절대적 관리자는 없음.
		echo "article: [";
		$cc = 0;
		for($i=0;$i<$total_record;$i++)
		{
			mysql_data_seek($result, $i);
			$row = mysql_fetch_array($result);
			
			if($row[4]!=1){
			
			if($row[5]!=0){
				$sqll = "select p_public from party where id='$row[5]'";
				$rst = mysql_query($sqll,$connect);
				$ost = mysql_fetch_array($rst);
				
				$sqll = "select*from partyjoin where member_id='$id' and party_id='$row[5]'";
				$rst = mysql_query($sqll,$connect);
				$oost = mysql_num_rows($rst);
			}
			
			if($row[5]==0 || $ost[0]==0 || $oost==1){	
							
				$ssql = "select*from partyjoin where party_id='$row[5]' and member_id='$id'";
				$rresult = mysql_query($ssql,$connect);
				$tt = mysql_num_rows($rresult);
				
				if($row[12]!=2 || $tt!=0){
					$memberauth = true;
				}
				else{
					$memberauth = false;
				}
					
				
				if($row[12]!=2 || $memberauth){
					$arauth = true;
				}			
				else{
					$arauth = false;
				}
			
				if($arauth){
				
					if($cc>0)
					 echo ",\r\n";
					 
					 $cc++;
					// row 로 받아온 상태!
					
					$sql0 = "select*from member where id='$row[9]'";
					$result0 = mysql_query($sql0,$connect);
					$scrapping = mysql_fetch_array($result0);
					 
					$j = $i+1;
					echo "{\r\n";
					echo "articleID: \"$row[2]\","; // 글번호 (삭제 예정)
					echo "author: \"$row[3]\","; //(글쓴이)
					echo "authorID: \"$row[4]\","; //(글쓴이id)
					echo "authorProfile: \"$row[7]\","; //(글쓴이프로필사진)
					echo "content: \"$row[0]\","; // 글내용
					echo "time: \"$row[1]\","; // 날짜
					echo "apic: \"$row[8]\","; // 글 사진
					echo "scrapID: \"$scrapping[4]\",";
					echo "scrapName: \"$scrapping[0]\",";
					echo "scrapPic: \"$scrapping[11]\",";
					echo "notice: \"$row[10]\", ";
					echo "caption: \"$row[11]\", ";
					
					if($row[5]==0)
					{
						$sql1 = "select distinct m.name, m.id from member m, article a where a.id='$row[2]' and m.id=a.mynote";
						$result1 = mysql_query($sql1, $connect);
						$aaa = mysql_fetch_array($result1);
						echo "isparty: 0,";
						echo "belong: \"$aaa[0]의 노트\",";
						echo "belongID: $aaa[1],";
						echo "belongAdmin: 0, ";
					}
					else
					{
						$query1 = "select p.pname, p.admin from party p where p.id=$row[5]";
						$result1 = mysql_query($query1,$connect);
						$sol = mysql_fetch_array($result1);
						echo "isparty: 1,";
						echo "belong: \"$sol[0]\","; // 파티 유무	
						echo "belongID: $row[5],";
						echo "belongAdmin: \"$sol[1]\", ";		
					}
					
					$sql01 = "select id from article where origin='$row[2]'";
					$result01 = mysql_query($sql01,$connect);
					$exa = mysql_num_rows($result01);
					echo "ScrapNum: \"$exa\", ";
					
					/////////// 좋아요 싫어요 기능!!!
					$sql2 = "select a.point from article_like a where a.mem=$id and a.article=$row[2]";
					$result2 = mysql_query($sql2, $connect);
					$total_record2 = mysql_num_rows($result2);
					if($total_record2==0) // 투표한적 없음. 링크 띄워줌
					{
						echo "vote: 0,";				
					}
					else // 투표 했으면 안 띄워줌
					{
						echo "vote: 1,";
					}
					
					// 이 글을 좋아하는 사람
					$sql2 = "select m.name, m.id, m.profilepic from member m, article_like a where a.article=$row[2] and a.point=1 and m.id=a.mem order by a.time desc";
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
		
		
					// 댓글 표시 !!
					$sql2 = "select m.name, m2.name, r.r_content, r.time, m2.id, r.id, m2.profilepic from member m, member m2, reply r, article a where a.mem=m.id and r.r_article=a.id and m2.id=r.r_mem and a.id=$row[2] order by r.time desc";
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
						echo "rid: \"$row2[5]\","; // reply id
						echo "mid: \"$row2[4]\","; // 댓글 쓴 사람 id
						echo "name: \"$row2[1]\","; // 댓글 쓴 사람 이름
						echo "text: \"$row2[2]\",";
						echo "profile: \"$row2[6]\","; // 프로필 사진
						echo "time: \"$row2[3]\"";
						echo "}\r\n";
					}
					echo "]\r\n";
					//opt 3 : 댓글 , toid : 글id
					echo "}\r\n";
				}//arauth
			}//if
			}
		}//for
		echo "]";
		
	}
	mysql_close();	
	
	
?>
}
]]></data>
</result>