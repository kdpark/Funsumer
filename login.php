<? session_start();ob_start();
	$id = $_SESSION['userid'];
	if($id)
	{
        // 세션 로그인 카운터
        include "dbconn.php";
        $sql = "select visit_count from member m where m.id=$id";
        $result = mysql_query($sql, $connect);
        $total_record = mysql_num_rows($result);
        for($i=0;$i<$total_record;$i++)
        {
            mysql_data_seek($result, $i);
            $row = mysql_fetch_array($result);
            // row 로 받아온 상태!
            $count = $row[0];
        }
        $count++;
        
        $sql = "update member set visit_count=$count, login_time=NOW() where id=$id";
        mysql_query($sql, $connect);        
		
		$sql = "select university from member where id='$id'";
		$result = mysql_query($sql,$connect);
		$sch = mysql_fetch_array($result);
		
		$sql = "select*from event where target='$sch[0]' and present='1'";
		$result = mysql_query($sql,$connect);
		$rows = mysql_num_rows($result);
		$row = mysql_fetch_array($result);			
		if($rows!=0){
			/*echo(" <script> post_to_url('./event/',{'eventnumber':".$row[1]."}); </script> ");*/
			echo(" <script> top.location.href='./party/' </script> ");
		}
		else{
			echo(" <script> top.location.href='./party/' </script> ");
		}
	}	
    else{		
		$id = $_COOKIE["usercookie"];
		if($id)
		{
			// 세션 로그인 카운터
			include "dbconn.php";
			$sql = "select visit_count from member m where m.id=$id";
			$result = mysql_query($sql, $connect);
			$total_record = mysql_num_rows($result);
			for($i=0;$i<$total_record;$i++)
			{
				mysql_data_seek($result, $i);
				$row = mysql_fetch_array($result);
				// row 로 받아온 상태!
				$count = $row[0];
			}
			$count++;
			
			$sql = "update member set visit_count=$count, login_time=NOW() where id=$id";
			mysql_query($sql, $connect);  
			
			/*$sql = "select party_id from event where present='1'";
			$result = mysql_query($sql,$connect);
			$rows = mysql_num_rows($result);
			if($rows){
				for($i=0;$i<$rows;$i++){
					mysql_data_seek($result,$i);
					$partyids = mysql_fetch_array($result);
					
					$sqll = "select*from partyjoin where member_id='$id' and party_id='$partyids[0]'";
					$resultl = mysql_query($sqll,$connect);
					$rr = mysql_num_rows($resultl);
					if($rr){
						mysql_close();
						echo(" <script> top.location.href='event'; </script> ");       
					}
					else{
						mysql_close();
						echo(" <script> top.location.href='party'; </script> ");       
					}
				}
			}
			else{			
				mysql_close();
				echo(" <script> top.location.href='party'; </script> ");       
			}*/
			$sql = "select university from member where id='$id'";
			$result = mysql_query($sql,$connect);
			$sch = mysql_fetch_array($result);
			
			$sql = "select*from event where target='$sch[0]' and present='1'";
			$result = mysql_query($sql,$connect);
			$rows = mysql_num_rows($result);
			$row = mysql_fetch_array($result);			
			if($rows!=0){
				/*echo(" <script> post_to_url('./event/',{'eventnumber':".$row[1]."}); </script> ");*/
				echo(" <script> top.location.href='./party/' </script> ");
			}
			else{
				echo(" <script> top.location.href='./party/'; </script> ");
			}
		}	
	}	
    
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
<script src="js/ajax.js"></script>
<script language='javascript'>
function post_to_url(path, params, method) {
    method = method || "post"; // Set method to post by default, if not specified.
    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
    for(var key in params) {
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", key);
        hiddenField.setAttribute("value", params[key]);
        form.appendChild(hiddenField);
    }
    document.body.appendChild(form);
    form.submit();
}

function a(ind){
	if(ind==0){		
		new ajax.xhr.Request("eventunivchange.php","school=성신여자고등학교",nothingdo,'POST');
		top.location.href='./party/';
	}	
}

function nothingdo(){
}
</script>
</head>
<body>
<?
	$textfield = $_POST['textfield'];
	$textfield2 = $_POST['textfield2'];
	// 로그인창 미입력
	if(!$textfield) {
		echo("<script> post_to_url(\"index.php\",{\"er\":\"1\"}); </script>");
		exit;
		
	}

	if(!$textfield2) {
		echo("<script> post_to_url(\"index.php\",{\"er\":\"1\", \"ed\":\"$textfield\"}); </script>");
		exit;
	}	
	
	// 먼저 이메일 있는지 검색
	include "dbconn.php";
	$sql = "select * from member where email='$textfield'";
	$result = mysql_query($sql, $connect);
	$num_match = mysql_num_rows($result);

	if(!$num_match) // 없으면 오류
	{
		echo("<script> post_to_url(\"index.php\",{\"er\":\"2\", \"ed\":\"$textfield\"}); </script>");
		
	}
	else // 있으면 비밀번호 검사
	{
		$row = mysql_fetch_array($result);
		$db_passwd = $row[password];

		$sql2 = "select PASSWORD('$textfield2')";
		$result2 = mysql_query($sql2, $connect);
		$row2 = mysql_fetch_array($result2);		

		if($row2[0] != $db_passwd) // 비밀번호 불일치
		{
			echo("<script> post_to_url(\"index.php\",{\"er\":\"2\", \"ed\":\"$textfield\"}); </script>");
			
		}
		else // 비밀번호도 맞았을때!
		{			
			
			
			
			include "dbconn.php";
			$mail1 = $textfield;
			$sql = "select m.id from member m where m.email='$mail1'";
			$result = mysql_query($sql, $connect);
			$total_record = mysql_num_rows($result);
			for($i=0;$i<$total_record;$i++)
			{
				mysql_data_seek($result, $i);
				$row = mysql_fetch_array($result);
				// row 로 받아온 상태!
				$id = $row[0];
			}
			
			if(!$checkbox){ // 로그인 유지 아닐때 - 세션으로 저장
				
				$_SESSION['userid'] =  $id;
			}
			else // 로그인 유지 했을때 - 쿠키로 저장 1년치
			{
				$cookie = setcookie("usercookie", $id,time()+60*60*24*365,'/');
			}
			
			// 로그인했을때 방문 카운터
			$sql = "select visit_count from member m where m.id=$id";
			$result = mysql_query($sql, $connect);
			$total_record = mysql_num_rows($result);
			for($i=0;$i<$total_record;$i++)
			{
				mysql_data_seek($result, $i);
				$row = mysql_fetch_array($result);
				// row 로 받아온 상태!
				$count = $row[0];
			}
			$count++;
			
			// 반영
			$sql = "update member set visit_count=$count, login_time=NOW() where id=$id";
			mysql_query($sql, $connect);
			
			/*$sql = "select party_id from event where present='1'";
			$result = mysql_query($sql,$connect);
			$rows = mysql_num_rows($result);
			
			$ct = 0;
			if($rows){
				for($i=0;$i<$rows;$i++){
					mysql_data_seek($result,$i);
					$partyids = mysql_fetch_array($result);
					
					$sqll = "select*from partyjoin where member_id='$id' and party_id='$partyids[0]'";
					$resultl = mysql_query($sqll,$connect);
					$rr = mysql_num_rows($resultl);
					
					if($rr){
						//mysql_close();
						$ct = 1;
					}
					else{
						//mysql_close();
					}
					
				}
			}
			else{			
				echo(" <script> top.location.href='party'; </script> ");       
			}
			mysql_close();
			
			if($ct){
				echo(" <script> top.location.href='event'; </script> ");       
			}
			else{
				echo(" <script> top.location.href='party'; </script> ");     
			}*/
			$sql = "select university from member where id='$id'";
			$result = mysql_query($sql,$connect);
			$sch = mysql_fetch_array($result);
			
			/*$sql = "select*from event where target='$sch[0]' and present='1'";
			$result = mysql_query($sql,$connect);
			$rows = mysql_num_rows($result);
			$row = mysql_fetch_array($result);			
			if($rows!=0){
				echo(" <script> post_to_url('./event/',{'eventnumber':".$row[1]."}); </script> ");
			}
			else{
				
			$sql = "select*from member where id='$id' and university like '%성신여%'";				
			$result = mysql_query($sql,$connect);
			$ok = mysql_num_rows($result);
			if($ok && $ok!="성신여자고등학교"){
				echo(" <script> if(confirm('\'성신여자고등학교\'에서 현재 이벤트를 진행중입니다. \'성신여자고등학교\' 재학생이시면 이벤트에 참여하실 수 있습니다. 재학중인 학교가 \'성신여자고등학교\'가 맞습니까?')){ a(0); }else{  top.location.href='party'; } </script> ");
				/*echo(" <script> top.location.href='party'; </script> ");*/
			//}
		//	else{
				echo(" <script> top.location.href='party'; </script> ");
		//	}
								
								
		//	}			
		}
	}
?>
</body>
