<? session_start();ob_start();
	$id = $_COOKIE["usercookie"];
    if(!$id)
    {
	    $id = $_SESSION['userid'];	    
    }
    
	
	//////////// 이름 얻기 : me 는 로그인한 세션의 정보
	include "dbconn.php";
	$sql = "select * from member m where m.id='$id'";
	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result);
	$me = mysql_fetch_array($result);
    
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
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$name = $_POST['name'];
	$ename = $_POST['ename'];
	$birth = $_POST['birth'];
	$univ = $_POST['univ'];
	$gender = $_POST['gender'];
	$pic = $_POST['pic'];
	
	$sql = "select*from member where email='$email'";
	$result = mysql_query($sql,$connect);
	$exa = mysql_num_rows($result);
	
	if($exa){
		echo "Result: \"1\"";
	}
	else{
		$register_day=date("Y-m-d (H:i)");
		$ip=$REMOTE_ADDR;
		if(!$pic){
			if($gender==1){
				$profile = "images/base/male160.png";
			}else if($gender==2){
				$profile = "images/base/female160.png";
			}
			$sql = "insert into member(name, ename, email, password, id, auth, birth, university, gender, login_time, profilepic)";
			$sql.="values('$name', '$ename', '$email', PASSWORD('$pass'), null, 'N', '$birth', '$univ', '$gender', NOW(), '$profile')";
			mysql_query($sql, $connect);
			
			$sql = "select id from party where pname='$univ'";
			$result = mysql_query($sql,$connect);
			$rows = mysql_num_rows($result);
			if($rows){
				$row = mysql_fetch_array($result);
				
				$sql = "select id from member where email='$email'";
				$result = mysql_query($sql,$connect);
				$meid = mysql_fetch_array($result);
				
				$sql = "insert into partyjoin(member_id, party_id, visit_count, bookmark, id, join_time, visit_time,  notice) values('$meid[0]', '$row[0]', '1', '0', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '0')";
				mysql_query($sql,$connect);
								
			}			
			
			$sql = "select event_num from event where present='1' and target='$univ'";
			$result = mysql_query($sql,$connect);
			$ev = mysql_num_rows($result);
			if($ev){
				$evn = mysql_fetch_array($result);
				$evnum = $evn[0];
			}
			else{
				$evnum = 0;
			}
						
			echo "Result: \"2\", ";
			$sql = "select id from member where email='$email'";
			$result = mysql_query($sql,$connect);
			$meid = mysql_fetch_array($result);
			echo "ID: \"$meid[0]\", " ;
			echo "evnum: \"$evnum\" ";
			$_SESSION['userid'] = $meid[0];
			
		}//if
		else{
			$sql = "insert into member(name, ename, email, password, id, auth, birth, university, gender, login_time, profilepic)";
			$sql.="values('$name', '$ename', '$email', PASSWORD('$pass'), null, 'N', '$birth', '$univ', '$gender', NOW(), '')";
			mysql_query($sql, $connect);	
						
			$sql = "select NOW()";
			$result = mysql_query($sql,$connect);
			$nowar = mysql_fetch_array($result);
			$fnmae = substr($nowar[0],0,4).substr($nowar[0],5,2).substr($nowar[0],8,2).substr($nowar[0],11,2).substr($nowar[0],14,2).substr($nowar[0],17,2);
			
			$sql = "select id from member where email='$email'";
			$result = mysql_query($sql,$connect);
			$meid = mysql_fetch_array($result);
			
			$pic_copy = 'upload/profilepic/'.$meid[0].'_profilepic_'.$fnmae;//확장자 없이 파일이름까지만 사용한다.
			
			if (!is_file($pic)) {				
			   //echo "Result: \"3\""; // 파일이 아니라 처리할 수 없어
			}
			 
			$size = @getimagesize($pic);
			if (empty($size[2])) {	
			  // echo "Result: \"4\""; // 이미지 파일이 아니야
			}
			
			if ($size[2] != 1 && $size[2] != 2 && $size[2] != 3) {			
			  // echo "Result: \"5\""; // 지원하지 않는 이미지타입이야 gif/jpg/png만 가능
			}
			
			$extension = image_type_to_extension($size[2]);
			$path_copyfile .= $extension;
			
			switch($size[2]){
			
			  case 1 : //gif
			
				$im = @imagecreatefromgif($pic);
			
				if ($im === false) {
					//echo "Result: \"6\"";
					//이미지 리소스 가져오기 실패
				}
				
				$result_save = @imagegif($im, $pic_copy);
			
				break;
			
			  case 2 : //jpg
			
				$im = @imagecreatefromjpeg($pic);
			
				if ($im === false) {
					//echo "Result: \"7\"";	
				   //이미지 리소스 가져오기 실패
				}
				
				$result_save = @imagejpeg($im, $pic_copy);
			
				break;
			
			  case 3 : //png
			
				$im = @imagecreatefrompng($pic);
			
				if ($im === false) {
			
				  //echo "Result: \"8\"";
				  //이미지 리소스 가져오기 실패
				}
				
				$result_save = @imagepng($im, $pic_copy);
			
				break;
			}
			
			@imagedestroy($im);
			
			if ($result_save === false) {
			
			  // echo "Result: \"9\"";
			   //이미지 복사 실패
			}
			
			if (is_file($pic_copy)){ echo "Result: \"2\", "; echo "ID: \"$meid[0]\", "; }
				
			$sql = "update member set profilepic='$pic_copy' where id='$meid[0]'";					
			mysql_query($sql,$connect);
			
			
			if (file_exists($pic)) {
				unlink($pic);
			}
			$sql = "select id from party where pname='$univ'";
			$result = mysql_query($sql,$connect);
			$rows = mysql_num_rows($result);
			if($rows){
				$row = mysql_fetch_array($result);
				
				$sql = "select id from member where email='$email'";
				$result = mysql_query($sql,$connect);
				$meid = mysql_fetch_array($result);
				
				$sql = "insert into partyjoin(member_id, party_id, visit_count, bookmark, id, join_time, visit_time,  notice) values('$meid[0]', '$row[0]', '1', '0', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '0')";
				mysql_query($sql,$connect);
								
			}	
			$sql = "select event_num from event where present='1' and target='$univ'";
			$result = mysql_query($sql,$connect);
			$ev = mysql_num_rows($result);
			if($ev){
				$evn = mysql_fetch_array($result);
				$evnum = $evn[0];
			}
			else{
				$evnum = 0;
			}
			echo "evnum: \"$evnum\" ";		
		}
		
		$_SESSION['userid'] = $meid[0];		
		/*$sql = "insert into partyjoin(member_id, party_id, visit_count, bookmark, id, join_time) values('$meid[0]','19','1','0',NULL,CURRENT_TIMESTAMP);";
		mysql_query($sql,$connect);*/
		$sql = "insert into friendship(id, mem1, mem2, time) values(NULL, '$meid[0]', '1', CURRENT_TIMESTAMP)";
		mysql_query($sql,$connect);
		$sql = "insert into friendship(id, mem1, mem2, time) values(NULL, '1', '$meid[0]', CURRENT_TIMESTAMP)";
		mysql_query($sql,$connect);
	}
	
	mysql_close();
?>
}
]]></data>
</result>