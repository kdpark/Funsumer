<? session_start();
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
    
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?

	//$content : 글 내용
	//$toid : 대상 아이디 (mynote 에는 대상 회원id, party 에는 대상 party id, 댓글에서는 글의 id)
	//$id : session id (본인)
	//$opt : option
	//$deleteid
	include "dbconn.php";
	
	
	//echo $db_img;
	//
	$pic = $_POST['pic'];
	$title = $_POST['title'];
	$opt = $_POST['opt'];
	$oopt = $_POST['oopt'];
	$toid = $_POST['toid'];
	$content = $_POST['content'];	
	$aopen = $_POST['aopen'];
	
	$content = htmlspecialchars($content);
	$content = addslashes($content); 
	$content = str_replace("\n","<br>",$content);	
	
	$scrapcontent = htmlspecialchars($scrapcontent);
	$scrapcontent = addslashes($scrapcontent); 
	$scrapcontent = str_replace("\n","<br>",$scrapcontent);	
	
	$notice = $_POST['notice'];
	$origin_article = $_POST['origin_article'];
	
	
	switch($opt)
	{
		case 1: // mynote 글!
		if(!$pic){
			$sql = "insert into article(id,mem, party, mynote, time, a_content, a_open) values (NULL,'$id', '0', '$toid', CURRENT_TIMESTAMP, '$content', '$aopen')";	
			mysql_query($sql,$connect);
		}
		else{
			$sql = "select NOW()";
			$result = mysql_query($sql,$connect);
			$nowar = mysql_fetch_array($result);
			$fnmae = substr($nowar[0],0,4).substr($nowar[0],5,2).substr($nowar[0],8,2).substr($nowar[0],11,2).substr($nowar[0],14,2).substr($nowar[0],17,2);		
			
			$pic_copy = 'upload/Article/'.$id.'_NOTE_'.$fnmae;//확장자 없이 파일이름까지만 사용한다.
			
			if (!is_file($pic)) {				
			   echo "Result: \"3\""; // 파일이 아니라 처리할 수 없어
			}
			 
			$size = @getimagesize($pic);
			if (empty($size[2])) {	
			   echo "Result: \"4\""; // 이미지 파일이 아니야
			}
			
			if ($size[2] != 1 && $size[2] != 2 && $size[2] != 3) {			
			   echo "Result: \"5\""; // 지원하지 않는 이미지타입이야 gif/jpg/png만 가능
			}
			
			$extension = image_type_to_extension($size[2]);
			$path_copyfile .= $extension;
			
			switch($size[2]){
			
			  case 1 : //gif
			
				$im = @imagecreatefromgif($pic);
			
				if ($im === false) {
					echo "Result: \"6\"";
					//이미지 리소스 가져오기 실패
				}
				
				$result_save = @imagegif($im, $pic_copy);
			
				break;
			
			  case 2 : //jpg
			
				$im = @imagecreatefromjpeg($pic);
			
				if ($im === false) {
					echo "Result: \"7\"";	
				   //이미지 리소스 가져오기 실패
				}
				
				$result_save = @imagejpeg($im, $pic_copy);
			
				break;
			
			  case 3 : //png
			
				$im = @imagecreatefrompng($pic);
			
				if ($im === false) {
			
				  echo "Result: \"8\"";
				  //이미지 리소스 가져오기 실패
				}
				
				$result_save = @imagepng($im, $pic_copy);
			
				break;
			}
			
			@imagedestroy($im);
			
			if ($result_save === false) {
			
			   echo "Result: \"9\"";
			   //이미지 복사 실패
			}
			
			if (is_file($pic_copy)) echo "Result: \"2\""; //이미지 복사 성공
			else echo "Result: \"10\""; // 이미지 복사 실패				
				
			$sql = "insert into article(id,mem, party, mynote, time, a_content, pic, a_open) values (NULL,'$id', '0', '$toid', CURRENT_TIMESTAMP, '$content', '$pic_copy', '$aopen')";	
			mysql_query($sql, $connect) or die(mysql_error());
			
			
			if (file_exists($pic)) {
				unlink($pic);
			}
	
			
		}
		$sql = "select a.id from article a where a.mynote='$toid' order by time desc";
		$result = mysql_query($sql,$connect);
		$aaa = mysql_fetch_array($result);
		
		if($id != $toid){
			$sql = "select*from message where from_mem='$id' and to_mem='$toid' and article_id='$aaa[0]' and mtype='0'";
			$result = mysql_query($sql,$connect);
			$alarmnum = mysql_num_rows($result);
			
			if($alarmnum){
				$sql2 = "delete from message where from_mem='$id' and to_mem='$toid' and article_id='$aaa[0]' and mtype='0'";
				mysql_query($sql2,$connect);
				$sql = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$id', '$toid', '$aaa[0]', CURRENT_TIMESTAMP, '0', '0')";
				mysql_query($sql,$connect);
			}
			else{
				$sql = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$id', '$toid', '$aaa[0]', CURRENT_TIMESTAMP, '0', '0')";
				mysql_query($sql,$connect);
			}
		}
		
		mysql_close();
		break;
		
		case 2: // party 글!
		if(!$notice){
			if(!$pic){
				$sql = "insert into article(id,mem, party, mynote, time, a_content, a_open) values (NULL,'$id', '$toid', '$id', CURRENT_TIMESTAMP, '$content', '$aopen')";
				mysql_query($sql,$connect);
			}
			else{
				$sql = "select NOW()";
				$result = mysql_query($sql,$connect);
				$nowar = mysql_fetch_array($result);
				$fnmae = substr($nowar[0],0,4).substr($nowar[0],5,2).substr($nowar[0],8,2).substr($nowar[0],11,2).substr($nowar[0],14,2).substr($nowar[0],17,2);		
				
				$pic_copy = 'upload/Article/'.$id.'_PARTY_'.$fnmae;//확장자 없이 파일이름까지만 사용한다.
				
				if (!is_file($pic)) {				
				   echo "Result: \"3\""; // 파일이 아니라 처리할 수 없어
				}
				 
				$size = @getimagesize($pic);
				if (empty($size[2])) {	
				   echo "Result: \"4\""; // 이미지 파일이 아니야
				}
				
				if ($size[2] != 1 && $size[2] != 2 && $size[2] != 3) {			
				   echo "Result: \"5\""; // 지원하지 않는 이미지타입이야 gif/jpg/png만 가능
				}
				
				$extension = image_type_to_extension($size[2]);
				$path_copyfile .= $extension;
				
				switch($size[2]){
				
				  case 1 : //gif
				
					$im = @imagecreatefromgif($pic);
				
					if ($im === false) {
						echo "Result: \"6\"";
						//이미지 리소스 가져오기 실패
					}
					
					$result_save = @imagegif($im, $pic_copy);
				
					break;
				
				  case 2 : //jpg
				
					$im = @imagecreatefromjpeg($pic);
				
					if ($im === false) {
						echo "Result: \"7\"";	
					   //이미지 리소스 가져오기 실패
					}
					
					$result_save = @imagejpeg($im, $pic_copy);
				
					break;
				
				  case 3 : //png
				
					$im = @imagecreatefrompng($pic);
				
					if ($im === false) {
				
					  echo "Result: \"8\"";
					  //이미지 리소스 가져오기 실패
					}
					
					$result_save = @imagepng($im, $pic_copy);
				
					break;
				}
				
				@imagedestroy($im);
				
				if ($result_save === false) {
				
				   echo "Result: \"9\"";
				   //이미지 복사 실패
				}
				
				if (is_file($pic_copy)) echo "Result: \"2\""; //이미지 복사 성공
				else echo "Result: \"10\""; // 이미지 복사 실패				
					
				$sql = "insert into article(id,mem, party, mynote, time, a_content, pic, a_open) values (NULL,'$id', '$toid', '$id', CURRENT_TIMESTAMP, '$content', '$pic_copy', '$aopen')";
				mysql_query($sql, $connect) or die(mysql_error());
				
				
				if (file_exists($pic)) {
					unlink($pic);
				}
			}
		}
		else{	//공지글
			if(!$pic){
				$sql = "insert into article(id,mem, party, mynote, time, a_content, notice, a_open) values (NULL,'$id', '$toid', '$id', CURRENT_TIMESTAMP, '$content', '1', '$aopen')";
				mysql_query($sql,$connect);
				
				$sql = "select id from article where mem='$id' and party='$toid' and mynote='$id' and a_content='$content'";
				$result = mysql_query($sql,$connect);
				$r = mysql_fetch_array($result);
				
				$sql = "insert into notice(id, party, ar_num, title) values(NULL, '$toid', '$r[0]', '$title')";
				mysql_query($sql,$connect);
			}
			else{
				$sql = "select NOW()";
				$result = mysql_query($sql,$connect);
				$nowar = mysql_fetch_array($result);
				$fnmae = substr($nowar[0],0,4).substr($nowar[0],5,2).substr($nowar[0],8,2).substr($nowar[0],11,2).substr($nowar[0],14,2).substr($nowar[0],17,2);		
				
				$pic_copy = 'upload/Article/'.$id.'_PARTY_'.$fnmae;//확장자 없이 파일이름까지만 사용한다.
				
				if (!is_file($pic)) {				
				   echo "Result: \"3\""; // 파일이 아니라 처리할 수 없어
				}
				 
				$size = @getimagesize($pic);
				if (empty($size[2])) {	
				   echo "Result: \"4\""; // 이미지 파일이 아니야
				}
				
				if ($size[2] != 1 && $size[2] != 2 && $size[2] != 3) {			
				   echo "Result: \"5\""; // 지원하지 않는 이미지타입이야 gif/jpg/png만 가능
				}
				
				$extension = image_type_to_extension($size[2]);
				$path_copyfile .= $extension;
				
				switch($size[2]){
				
				  case 1 : //gif
				
					$im = @imagecreatefromgif($pic);
				
					if ($im === false) {
						echo "Result: \"6\"";
						//이미지 리소스 가져오기 실패
					}
					
					$result_save = @imagegif($im, $pic_copy);
				
					break;
				
				  case 2 : //jpg
				
					$im = @imagecreatefromjpeg($pic);
				
					if ($im === false) {
						echo "Result: \"7\"";	
					   //이미지 리소스 가져오기 실패
					}
					
					$result_save = @imagejpeg($im, $pic_copy);
				
					break;
				
				  case 3 : //png
				
					$im = @imagecreatefrompng($pic);
				
					if ($im === false) {
				
					  echo "Result: \"8\"";
					  //이미지 리소스 가져오기 실패
					}
					
					$result_save = @imagepng($im, $pic_copy);
				
					break;
				}
				
				@imagedestroy($im);
				
				if ($result_save === false) {
				
				   echo "Result: \"9\"";
				   //이미지 복사 실패
				}
				
				if (is_file($pic_copy)) echo "Result: \"2\""; //이미지 복사 성공
				else echo "Result: \"10\""; // 이미지 복사 실패				
					
				$sql = "insert into article(id,mem, party, mynote, time, a_content, pic, notice, a_open) values (NULL,'$id', '$toid', '$id', CURRENT_TIMESTAMP, '$content', '$pic_copy', '1', '$aopen')";
				mysql_query($sql, $connect) or die(mysql_error());
				
				$sql = "select id from article where mem='$id' and party='$toid' and mynote='$id' and a_content='$content'";
				$result = mysql_query($sql,$connect);
				$r = mysql_fetch_array($result);
				
				$sql = "insert into notice(id, party, ar_num, title) values(NULL, '$toid', '$r[0]', '$title')";
				mysql_query($sql,$connect);
				
				if (file_exists($pic)) {
					unlink($pic);
				}
			}
		}
		
		$sql = "select a.id from article a where a.party='$toid' order by time desc";
		$result = mysql_query($sql,$connect);
		$aaa = mysql_fetch_array($result);
				
		$sql = "select member_id from partyjoin where party_id='$toid'";
		$result = mysql_query($sql,$connect);
		$rows = mysql_num_rows($result);	
				
		if($rows){			
			for($i=0;$i<$rows;$i++){
				mysql_data_seek($result,$i);
				
				$row = mysql_fetch_array($result);
				if($id != $row[0]){
					$sql2 = "select*from message where from_mem='$id' and to_mem = '$row[0]' and article_id='$aaa[0]' and mtype='0'";
					$result2 = mysql_query($sql2,$connect);
					$alarmnum = mysql_num_rows($result2);
					if($alarmnum){
						$sql = "delete from message where from_mem='$id' and to_mem='$row[0]' and article_id='$aaa[0]' and mtype='0'";
						mysql_query($sql,$connect);
					}
					else{
						$sql = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$id', '$row[0]', '$aaa[0]', CURRENT_TIMESTAMP, '0', '0')";
						mysql_query($sql,$connect);
					}
				}				
				
			}//for
		}
		
		mysql_close();		
		break;
		
		case 3: // 댓글 달기!
		
		$content = str_replace("<br>","",$content);
		$content = str_replace("\n","",$content);
		
		$sql = "select*from article where id='$toid'";
		$result = mysql_query($sql,$connect);
		$ex_a = mysql_num_rows($result);
		
		if($ex_a){
			$sql = "insert into reply(id,r_mem, r_article, r_content, time) values (NULL,'$id', '$toid', '$content',CURRENT_TIMESTAMP)";
			mysql_query($sql, $connect);		
		}
		
		$sql = "select a.mem from article a where a.id='$toid'";
		$result = mysql_query($sql,$connect);
		$row = mysql_fetch_array($result);
		
		if($id != $row[0]){
			$sql2 = "select*from message where from_mem='$id' and to_mem='$row[0]' and article_id='$toid' and mtype='1'";
			$result2 = mysql_query($sql2,$connect);
			$r2 = mysql_num_rows($result2);
			if($r2){
				$sql2 = "delete from message where from_mem='$id' and to_mem='$row[0]' and article_id='$toid' and mtype='1'";
				mysql_query($sql2,$connect);
				$sql2 = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$id', '$row[0]', '$toid', CURRENT_TIMESTAMP, '0', '1')";
				mysql_query($sql2,$connect);
			}
			else{
				$sql = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$id', '$row[0]', '$toid', CURRENT_TIMESTAMP, '0', '1')";
				mysql_query($sql,$connect);
			}
		}
		
		$sql = "select r_mem from reply r where r_article='$toid'";	
		$result = mysql_query($sql,$connect);
		$rows = mysql_num_rows($result);
		if($rows){
			for($i=0;$i<$rows;$i++){
				mysql_data_seek($result,$i);
				$oo = mysql_fetch_array($result);
				
				if($id != $oo[0]){
					$sql2 = "select*from message where from_mem='$id' and to_mem='$oo[0]' and article_id='$toid' and mtype='1'";
					$result2 = mysql_query($sql2,$connect);
					$r2 = mysql_num_rows($result2);
					if($r2){
						$sql2 = "delete from message where from_mem='$id' and to_mem='$oo[0]' and article_id='$toid' and mtype='1'";
						mysql_query($sql2,$connect);
						$sql2 = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$id', '$oo[0]', '$toid', CURRENT_TIMESTAMP, '0', '1')";
						mysql_query($sql2,$connect);
					}
					else{
						$sql2 = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$id', '$oo[0]', '$toid', CURRENT_TIMESTAMP, '0', '1')";
						mysql_query($sql2,$connect);
					}
				}
				
			}
		}
		

		break;	
		
		case 4: // 글 지우기
		
		// $delete article id = $toid
		//사진삭제
		$sql = "select pic, notice from article where id='$toid'";
		$result = mysql_query($sql, $connect);
		$delpic = mysql_fetch_array($result);
		
		 if( is_file($delpic[0]) )
		 {
		 	unlink($delpic[0]);
		 }
		if($delpic[1]!=0){
			$sql = "delete from notice where ar_num='$toid'";
			mysql_query($sql,$connect);			
		}
		
		// id 에 맞는 글을 삭제한다.
		$sql = "delete from article where id='$toid'";
		mysql_query($sql, $connect);
		// toid 에 달린 like 정보 지우기
		$sql = "delete from article_like where article='$toid'";
		mysql_query($sql, $connect);
		// toid 에 달린 댓글 지우기
		$sql = "delete from reply where r_article='$toid'";
		mysql_query($sql, $connect);
		// toid에 달린 알림 지우기
		$sql = "delete from message where article_id='$toid' and mtype='0'";
		mysql_query($sql,$connect);
		
		break;
		
		case 5: // 댓글 지우기
		// 출처 파악	

		$sql = "delete from reply where id='$toid'";
		mysql_query($sql, $connect);
		
		$sql = "delete from message where article_id='$toid' and mtype='1'";
		mysql_query($sql,$connect);
		break;		
		
		case 6: 
		
		
		break;	
		
		case 7: //스크랩하기
			$sql = "select*from article where id='$origin_article'";
			$result = mysql_query($sql,$connect);
			$row = mysql_fetch_array($result);
			
			if($row[8]){
				$originman = $row[8];
			}
			else{
				$originman = $row[1];
			}
			
			if($row[10]){
				$origin_a = $row[10];
			}
			else{
				$origin_a = $origin_article;
			}
			
			
			if($row[7]){
				$sql = "select NOW()";
				$result = mysql_query($sql,$connect);
				$nowar = mysql_fetch_array($result);
				$fnmae = substr($nowar[0],0,4).substr($nowar[0],5,2).substr($nowar[0],8,2).substr($nowar[0],11,2).substr($nowar[0],14,2).substr($nowar[0],17,2);		
			
				if($oopt==1){
					$pic_copy = 'upload/Article/'.$id.'_SCRAP_N_'.$fnmae;//확장자 없이 파일이름까지만 사용한다.
				}
				else if($oopt==2){
					$pic_copy = 'upload/Article/'.$id.'_SCRAP_P_'.$fnmae;//확장자 없이 파일이름까지만 사용한다.
				}
				
				if (!is_file($row[7])) {				
				   echo "Result: \"3\""; // 파일이 아니라 처리할 수 없어
				}
				 
				$size = @getimagesize($row[7]);
				if (empty($size[2])) {	
				   echo "Result: \"4\""; // 이미지 파일이 아니야
				}
				
				if ($size[2] != 1 && $size[2] != 2 && $size[2] != 3) {			
				   echo "Result: \"5\""; // 지원하지 않는 이미지타입이야 gif/jpg/png만 가능
				}
				
				$extension = image_type_to_extension($size[2]);
				$path_copyfile .= $extension;
				
				switch($size[2]){
				
				  case 1 : //gif
				
					$im = @imagecreatefromgif($pic);
				
					if ($im === false) {
						echo "Result: \"6\"";
						//이미지 리소스 가져오기 실패
					}
					
					$result_save = @imagegif($im, $pic_copy);
				
					break;
				
				  case 2 : //jpg
				
					$im = @imagecreatefromjpeg($row[7]);
				
					if ($im === false) {
						echo "Result: \"7\"";	
					   //이미지 리소스 가져오기 실패
					}
					
					$result_save = @imagejpeg($im, $pic_copy);
				
					break;
				
				  case 3 : //png
				
					$im = @imagecreatefrompng($row[7]);
				
					if ($im === false) {
				
					  echo "Result: \"8\"";
					  //이미지 리소스 가져오기 실패
					}
					
					$result_save = @imagepng($im, $pic_copy);
				
					break;
				}
				
				@imagedestroy($im);
				
				if ($result_save === false) {
				
				   echo "Result: \"9\"";
				   //이미지 복사 실패
				}
				
				if (is_file($pic_copy)) echo "Result: \"2\""; //이미지 복사 성공
				else echo "Result: \"10\""; // 이미지 복사 실패				
			}
								
			if($oopt==1){ // mynote 글!
				$sql = "insert into article(id, mem, party, mynote, time, a_content, caption, pic, scrapper, notice, origin) values (NULL,'$id', '0', '$toid', CURRENT_TIMESTAMP, '$row[5]', '$content', '$pic_copy', '$originman', '$row[9]', '$origin_a')";	
				mysql_query($sql, $connect) or die(mysql_error());
				
				
				$sql = "select a.id from article a where a.mynote='$toid' order by time desc";
				$result = mysql_query($sql,$connect);
				$aaa = mysql_fetch_array($result);
				
				if($id != $toid){
					$sql = "select*from message where from_mem='$id' and to_mem='$toid' and article_id='$aaa[0]' and mtype='0'";
					$result = mysql_query($sql,$connect);
					$alarmnum = mysql_num_rows($result);
					
					if($alarmnum){
						$sql2 = "delete from message where from_mem='$id' and to_mem='$toid' and article_id='$aaa[0]' and mtype='0'";
						mysql_query($sql2,$connect);
						$sql = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$id', '$toid', '$aaa[0]', CURRENT_TIMESTAMP, '0', '0')";
						mysql_query($sql,$connect);
					}
					else{
						$sql = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$id', '$toid', '$aaa[0]', CURRENT_TIMESTAMP, '0', '0')";
						mysql_query($sql,$connect);
					}
				}
				
				
				break;
			}
			else if($oopt==2){ // party 글!
				$sql = "insert into article(id,mem, party, mynote, time, a_content, caption, pic, scrapper, notice, origin) values (NULL,'$id', '$toid', '0', CURRENT_TIMESTAMP, '$row[5]', '$content', '$pic_copy', '$originman', '$row[9]', '$origin_a')";  
				mysql_query($sql, $connect) or ide(mysql_error());;
				
				$sql = "select a.id from article a where a.party='$toid' order by time desc";
				$result = mysql_query($sql,$connect);
				$aaa = mysql_fetch_array($result);
						
				$sql = "select member_id from partyjoin where party_id='$toid'";
				$result = mysql_query($sql,$connect);
				$rows = mysql_num_rows($result);	
						
				if($rows){			
					for($i=0;$i<$rows;$i++){
						mysql_data_seek($result,$i);
						
						$row = mysql_fetch_array($result);
						if($id != $row[0]){
							$sql2 = "select*from message where from_mem='$id' and to_mem = '$row[0]' and article_id='$aaa[0]' and mtype='0'";
							$result2 = mysql_query($sql2,$connect);
							$alarmnum = mysql_num_rows($result2);
							if($alarmnum){
								$sql = "delete from message where from_mem='$id' and to_mem='$row[0]' and article_id='$aaa[0]' and mtype='0'";
								mysql_query($sql,$connect);
							}
							else{
								$sql = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$id', '$row[0]', '$aaa[0]', CURRENT_TIMESTAMP, '0', '0')";
								mysql_query($sql,$connect);
							}
						}				
						
					}//for
				}
				break;
			}
			
			
			
			
		break;
	}
	mysql_close();
?>
