<?
	$connect = mysql_connect("localhost", "user", "vjstbaj") or die("DB 서버에 연결할 수 없습니다");
	mysql_query("set names utf8");
	mysql_select_db("funsumer", $connect);	//connection

//resizeImage
function resizeImage($image,$width,$height,$scale,$result) {
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);	
	
	if($width > 493){
		$newImageWidth = ceil(493);
		$newImageHeight = ceil(($height*493)/$width);
	}
			
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
		case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
	}
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	
	switch($imageType) {
		case "image/gif":
			imagegif($newImage,$image); 
			break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$image);  
			break;
	}
	
	chmod($image, 0777);
	return $image;
}

//resizeImage_Profile
function resizeImage_Profile($image,$width,$height,$scale,$result) {
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);	
	
	if($resul == $width){
		$newImageWidth = ceil($oriwidth);
		$newImageHeight = ceil($oriheight);
	}
	else{	
		if($width > $height){
			$newImageHeight = ceil($result);
			$newImageWidth = ceil(($width*$result)/$height);
		}
		else{
			$newImageWidth = ceil($result);
			$newImageHeight = ceil(($height*$result)/$width);
		}
	}
		
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
		case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
	}
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	
	switch($imageType) {
		case "image/gif":
			imagegif($newImage,$image); 
			break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$image);  
			break;
	}
	
	chmod($image, 0777);
	return $image;
}

//resizeImage_Wide
function resizeImage_Wide($image,$width,$height,$scale,$result) {
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);	
	
	if($width == $result){
		$newImageWidth = ceil($oriwidth);
		$newImageHeight = ceil($oriheight);
	}
	else{
		if($result==920){
			$newImageWidth = $result;
			$newImageHeight = (($height*$result)/$width);
			if($newImageHeight < 560){
				$newImageHeight = ceil(560);
			$newImageWidth = (($width*560)/$height);
			}
		}
		else{
			$newImageWidth = ceil($result);
			$newImageHeight = ceil(($height * $result)/$width);
		}
	}
	
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
		case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
	}
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	
	switch($imageType) {
		case "image/gif":
			imagegif($newImage,$image); 
			break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$image);  
			break;
	}
	
	chmod($image, 0777);
	return $image;
}

//resizeImage_Party
function resizeImage_Party($image,$width,$height,$scale,$result_w,$result_h) {
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);	
	
	if($result_w == $width && $result_h == $height){
		$newImageWidth = ceil($width);
		$newImageHeight = ceil($height);
	}
	else{		
		if($width > $height){
			$newImageHeight = ceil($result_h);
			if((($width*$result_h)/$height) < $result_w){
				$newImageWidth = ceil($result_w);	
				$newImageHeight = ceil(($height*$result_w)/$width);
			}
			else{
				$newImageWidth = ceil(($width*$result_h)/$height);
			}		
		}
		else{
			$newImageWidth = ceil($result_w);
			if((($height*$result_w)/$width) < $result_h){
				$newImageHeight = ceil($result_h);	
				$newImageWidth = ceil(($width*$result_h)/$height);
			}
			else{
				$newImageHeight = ceil(($height*$result_w)/$width);
			}		
		}
	}
			
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
		case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
	}
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	
	switch($imageType) {
		case "image/gif":
			imagegif($newImage,$image); 
			break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$image);  
			break;
	}
	
	chmod($image, 0777);
	return $image;
}

function getHeight($image) {
	$size = getimagesize($image);
	$height = $size[1];
	return $height;
}
//You do not need to alter these functions
function getWidth($image) {
	$size = getimagesize($image);
	$width = $size[0];
	return $width;
}

//**********************************************************************************************************************************************************************//
//**********************************************************************************************************************************************************************//
//**********************************************************************************************************************************************************************//
//********************************************************************************		 GET 		********************************************************************//
//**********************************************************************************************************************************************************************//
//**********************************************************************************************************************************************************************//
//**********************************************************************************************************************************************************************//

$opt = $_GET['opt'];
$LoginID = $_GET['LoginID'];
$LoginPass = $_GET['LoginPass'];
$mynoteid = $_GET['mynoteid'];
$partyid = $_GET['partyid'];
$userid = $_GET['userid'];
$afrom = $_GET['afrom'];
$articleID = $_GET['articleID'];

//******************************************************************************** OPT=1 / LOGIN API*******************************************************************// 로그인

if($opt==1){		// Login API
	$sql = "select*from member where email='$LoginID'";	// ID Existence
	$result = mysql_query($sql, $connect);
	$id_exa = mysql_num_rows($result);
	echo "{\r\n LoginAPI: [";
	if($LoginID && $LoginPass){		//	ID와 Pass가 제대로 들어온 경우
		if($id_exa){	//	ID가 존재하면
			$UserInfo = mysql_fetch_array($result);
			$UserPassword = $UserInfo[password];
			
			$sql2 = "select PASSWORD('$LoginPass')";
			$result2 = mysql_query($sql2, $connect);
			$UPass = mysql_fetch_array($result2);
			if($UPass[0] == $UserPassword){		//	PassWord 일치
					
				if($rows!=0){
					echo "{ Result: ".json_encode(0).", Result_data: ".json_encode($UserInfo[id])." }";
				}
				else{
					echo "{ Result: ".json_encode(0).", Result_data: ".json_encode($UserInfo[id])." }";
				}				
			}
			else{			//PassWord 불일치
				echo "{ Result: ".json_encode(1).", Error_text: ".json_encode('비밀번호가 일치하지 않습니다. ErrorCode : 1')."}";
			}
		}
		else{
			echo "{ Result: ".json_encode(1).", Error_text: ".json_encode('존재하지 않는 ID입니다. ErrorCode : 1')."}";
		}
	}
	else{
		echo "{ Result: ".json_encode(2).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 2')." }";
	}
	echo " ] }";
}

//******************************************************************************** OPT=2 / GET USER INFO API***********************************************************// 노트 정보 읽어오기

else if($opt==2){		// Get User Information
	$sql = "select*from member where id='$userid'";
	$result = mysql_query($sql,$connect);
	$me_exa = mysql_num_rows($result);
	echo "{\r\n guiAPI: [";
	if($mynoteid){
		$sql1 = "select name from member where id='$mynoteid'";
		$result1 = mysql_query($sql1,$connect);
		$setconn = mysql_num_rows($result1);
		if($setconn){
			if($userid){
				if($me_exa){
					$gui = mysql_fetch_array($result);
					echo "{ Result: ".json_encode(0).", ";
					echo "Result_Name: ".json_encode($gui[0]).", ";
					echo "Result_Ename: ".json_encode($gui[1]).", ";
					echo "Result_Birth: ".json_encode($gui[6]).", ";
					echo "Result_Univ: ".json_encode($gui[14]).", ";
					echo "Result_ProfilePic: ".json_encode($gui[11]).", ";
					echo "Result_WidePic: ".json_encode($gui[12]).", ";
					
					$sql2 = "select NOW();";
					$result2 = mysql_query($sql2,$connect);
					$current_now = mysql_fetch_array($result2);
					$current_day = explode(" ",$current_now[0]);
					$sql2 = "select time from friend_vote where from_mem='$mynoteid' and to_mem='$userid' order by time desc";
					$result2 = mysql_query($sql2,$connect);
					$a = mysql_num_rows($result2);
					if($a){
						mysql_data_seek($result2,0);	
						$dbtime = mysql_fetch_array($result2);
						$db_time = explode("-",$dbtime[0]);
						
						if($dbtime[0]==$current_day[0]){
							echo "Result_Vote: ".json_encode(1).", ";
						}
						else{
							echo "Result_Vote: ".json_encode(0).", ";
						}			
					}
					else{
						echo "Result_Vote: ".json_encode(0).", ";
					}
					$sql2 = "select*from friendship where mem1='$userid'";
					$result2 = mysql_query($sql2,$connect);
					$fnum = mysql_num_rows($result2);
					echo "Result_Fnum: ".json_encode($fnum).", ";
					$sql2 = "select*from friend_vote where to_mem='$userid'";
					$result2 = mysql_query($sql2,$connect);
					$vnum = mysql_num_rows($result2);
					echo "Result_Vnum: ".json_encode($vnum).", ";
					
					if($userid==$mynoteid){
						echo "Result_Fstat: ".json_encode(0)." ";	//본인
					}
					else{
						$sqll = "select*from friendship where mem1='$mynoteid' and mem2='$userid'";
						$resultl = mysql_query($sqll,$connect);
						$alreadyfriend = mysql_num_rows($resultl);
						if($alreadyfriend){
							echo "Result_Fstat: ".json_encode(1)." ";	//이미친구
						}
						else{
							$sqll = "select*from friend_req where from_mem='$mynoteid' and to_mem='$userid'";
							$resultl = mysql_query($sqll,$connect);
							$alreadyreq = mysql_num_rows($resultl);
							if($alreadyreq){
								echo "Result_Fstat: ".json_encode(2)." ";	//요청보낸상태
							}
							else{
								$sqll = "select*from friend_req where from_mem='$userid' and to_mem='$mynoteid'";
								$resultl = mysql_query($sqll,$connect);
								$alreadyrec = mysql_num_rows($resultl);
								if($alreadyrec){
									echo "Result_Fstat: ".json_encode(3)." ";	//요청받은상태
								}
								else{
									echo "Result_Fstat: ".json_encode(4)." ";	//無관계
								}
							}
						}
					}
					
					echo "}\r\n";
				}
				else{
					echo "{ Result: ".json_encode(1).", Error_text: ".json_encode('존재하지 않는 회원입니다. ErrorCode : 3')." }";
				}
			}
			else{
				echo "{ Result: ".json_encode(2).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 20')."}";
			}
		}
		else{
			echo "{ Result: ".json_encode(1).", Error_text: ".json_encode('접속자 정보가 잘못되었습니다. ErrorCode : 23')." }";
		}
	}
	else{
		echo "{ Result: ".json_encode(2).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 4')."}";
	}
	echo "]\r\n}";
}

//******************************************************************************** OPT=3 / GET USER FRIEND LIST API****************************************************// 친구목록 불러오기

else if($opt==3){
	echo "{\r\n guflAPI: [";
	if($mynoteid){	
		$sql1 = "select name from member where id='$mynoteid'";
		$result1 = mysql_query($sql1,$connect);
		$setconn = mysql_num_rows($result1);
		if($setconn){
			if($userid){
				$sql = "select*from member where id='$userid'";
				$result = mysql_query($sql,$connect);
				$mem_exa = mysql_num_rows($result);		
				
				if($mem_exa){	
					$sql = "select mem2 from friendship where mem1 = '$userid'";
					$result = mysql_query($sql,$connect);
					$ufl_exa = mysql_num_rows($result);
					
					
						if($ufl_exa){		// 친구가 1명 이상 존재	
							echo "{ Result: ".json_encode(0).", Result_data: [";				
							for($i=0;$i<$ufl_exa;$i++){
								mysql_data_seek($result,$i);
								$gufi = mysql_fetch_array($result);
								
								$sql2 = "select name, id, profilepic from member where id='$gufi[0]'";
								$result2 = mysql_query($sql2,$connect);
								$finfo = mysql_fetch_array($result2, $connect);
								
								if($i>0) echo ", ";
								echo "{\r\n";
								echo "Fname: ".json_encode($finfo[0]).", ";
								echo "Fpic: ".json_encode($finfo[2]).", ";
								echo "Fid: ".json_encode($finfo[1]).", ";
								$ssql = "select party_id from partyjoin where member_id='$finfo[1]'";
								$results = mysql_query($ssql,$connect);
								$exxa = mysql_num_rows($results);
								if($exxa!=0){
									$ct = 0;
									for($j=0;$j<$exxa;$j++){
										mysql_data_seek($results,$j);
										$pids = mysql_fetch_array($results);
										
										$sqlss = "select*from partyjoin where member_id='$mynoteid' and party_id='$pids[0]'";
										$resultss = mysql_query($sqlss,$connect);
										$rrr = mysql_num_rows($resultss);
										if($rrr){
											$ct++;
										}										
									}
									echo "Fparty: ".json_encode($ct).", ";
									$ct=0;
								}
								else{
									echo "Fparty: ".json_encode(0).", ";
								}
								
								$sqlz = "select NOW();";
								$resultz = mysql_query($sqlz,$connect);
								$current_now = mysql_fetch_array($resultz);
								$current_day = explode(" ",$current_now[0]);								
								$ssql = "select*from friend_vote where from_mem='$mynoteid' and to_mem='$finfo[1]' and time='$current_day[0]'";
								$results = mysql_query($ssql,$connect);
								$okok = mysql_num_rows($results);
								if($okok){
									echo "Fvote: ".json_encode(1)." ";
								}
								else{
									echo "Fvote: ".json_encode(0)." ";
								}
								
								
								echo "}\r\n";						
							}
							echo "]\r\n}\r\n";
						}
						else{
							echo "{ Result: ".json_encode(1)."}";	
						}			
					
				}
				else{
					echo "{ Result: ".json_encode(2).", Error_text: ".json_encode('존재하지 않는 회원입니다. ErrorCode : 5')."}";
				}
			}
			else{
				echo "{ Result: ".json_encode(3).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 21')."}";
			}
		}
		else{
			echo "{ Result: ".json_encode(2).", Error_text: ".json_encode('접속자 정보가 잘못되었습니다. ErrorCode : 24')."}";
		}
	}
	else{
		echo "{ Result: ".json_encode(3).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 6')."}";
	}
	echo "]\r\n}\r\n";
}

//******************************************************************************** OPT=4 / GET USER PARTY LIST API*****************************************************// 파티목록 불러오기

else if($opt==4){
	echo "{\r\n guplAPI: [";
	if($mynoteid){	


		$sql1 = "select name from member where id='$mynoteid'";
		$result1 = mysql_query($sql1,$connect);
		$setconn = mysql_num_rows($result1);
		if($setconn){
			if($userid){
				$sql = "select*from member where id='$userid'";
				$result = mysql_query($sql,$connect);
				$mem_exa = mysql_num_rows($result);		
				
				if($mem_exa){
					$sql = "select party_id from partyjoin where member_id = '$userid'";
					$result = mysql_query($sql,$connect);
					$upl_exa = mysql_num_rows($result);
					
						if($upl_exa){		// 파티가 1개 이상 존재		
						echo "{ Result: ".json_encode(0).", Result_data: [";
							$cc=0;
							for($i=0;$i<$upl_exa;$i++){
								mysql_data_seek($result,$i);
								$gupi = mysql_fetch_array($result);
								
								$sql2 = "select pname, pic, p_public from party where id='$gupi[0]'";
								$result2 = mysql_query($sql2,$connect);
								$finfo = mysql_fetch_array($result2, $connect);
								
								if($finfo[2]!=0){
									$sqll = "select*from partyjoin where member_id='$mynoteid' and party_id='$gupi[0]'";
									$rst = mysql_query($sqll,$connect);
									$or = mysql_num_rows($rst);
								}
								
								if($finfo[2]==0 || $or!=0 || $mynoteid==$userid){								
									if($cc>0) echo ", ";
									$cc++;
									echo "{\r\n";
									echo "pname: ".json_encode($finfo[0]).", ";
									echo "ppic: ".json_encode($finfo[1]).", ";
									echo "pid: ".json_encode($gupi[0])." ";						
									echo "}\r\n";						
								}
							}
							echo "],";
							
							if($userid == $mynoteid){							
								$sql = "select pname, id, pic, p_public from party";
								$result = mysql_query($sql,$connect);
								$rows = mysql_num_rows($result);
								
								$count = 0;
								
								if($rows){
									for($i=0;$i<$rows;$i++){
										mysql_data_seek($result,$i);
										$pinfo = mysql_fetch_array($result);
										
										$ssql = "select*from partyjoin where party_id='$pinfo[1]' and member_id='$mynoteid'";
										$results = mysql_query($ssql,$connect);
										$numrows = mysql_num_rows($results);
										
										if($pinfo[3]!=1 || $numrows!=0){
							
											$sql1 = "select visit_count from partyjoin where party_id='$pinfo[1]'";
											$result1 = mysql_query($sql1,$connect);
											$count_rows = mysql_num_rows($result1);
											if($count_rows){
												for($j=0;$j<$count_rows;$j++){
													mysql_data_seek($result1,$j);
													$counts = mysql_fetch_array($result1);
													$party_visit_count[$count] += $counts[0];
												}//for-j
											}//if-count_rows
											
											$sql2 = "select time from party where id='$pinfo[1]'";
											$result2 = mysql_query($sql2,$connect);
											$timevalue = mysql_fetch_array($result2);
											$party_times[$count] = strtotime($timevalue[0]);
							
											$con_party_id[$count] = $pinfo[1];
											$con_party_name[$count] = $pinfo[0];
											$con_party_pic[$count] = $pinfo[2];
											
											$frequency[$count] = ($party_visit_count[$count] / $party_times[$count])*100;
											$count++;
										}
										else{
											
										}
									}//for
								}//if-rows
								
								for($i=0;$i<($count-1);$i++){
									for($j=$i;$j<$count;$j++){
										if($frequency[$i] < $frequency[$j]){
											$temp = $con_party_id[$j];
											$frequency[$j] = $frequency[$i];
											$frequency[$i] = $temp;
											
											$temp = $con_party_id[$j];
											$con_party_id[$j] = $con_party_id[$i];
											$con_party_id[$i] = $temp;
											
											$temp = $con_party_name[$j];
											$con_party_name[$j] = $con_party_name[$i];
											$con_party_name[$i] = $temp;
											
											$temp = $con_party_pic[$j];
											$con_party_pic[$j] = $con_party_pic[$i];
											$con_party_pic[$i] = $temp;
										}
									}
								}
								echo "con_party_num: ".json_encode($count).", con_party: [";
								for($i=0;$i<$count;$i++){
									if($i>0) echo ",";
									echo "{";
									echo "pid: ".json_encode($con_party_id[$i]).", ";
									echo "pname: ".json_encode($con_party_name[$i]).", ";
									echo "ppic: ".json_encode($con_party_pic[$i])." ";
									echo "}";
								}
								echo "]";														
							}
							else{
								echo "con_party_num: ".json_encode(0)." ";
							}
													
							
							echo "}";
						}
						else{
							echo "{ Result: ".json_encode(1).", ";	
							if($userid == $mynoteid){							
								$sql = "select pname, id, pic, p_public from party";
								$result = mysql_query($sql,$connect);
								$rows = mysql_num_rows($result);
								
								$count = 0;
								
								if($rows){
									for($i=0;$i<$rows;$i++){
										mysql_data_seek($result,$i);
										$pinfo = mysql_fetch_array($result);
										
										$ssql = "select*from partyjoin where party_id='$pinfo[1]' and member_id='$mynoteid'";
										$results = mysql_query($ssql,$connect);
										$numrows = mysql_num_rows($results);
										
										if($pinfo[3]!=1 || $numrows!=0){
							
											$sql1 = "select visit_count from partyjoin where party_id='$pinfo[1]'";
											$result1 = mysql_query($sql1,$connect);
											$count_rows = mysql_num_rows($result1);
											if($count_rows){
												for($j=0;$j<$count_rows;$j++){
													mysql_data_seek($result1,$j);
													$counts = mysql_fetch_array($result1);
													$party_visit_count[$count] += $counts[0];
												}//for-j
											}//if-count_rows
											
											$sql2 = "select time from party where id='$pinfo[1]'";
											$result2 = mysql_query($sql2,$connect);
											$timevalue = mysql_fetch_array($result2);
											$party_times[$count] = strtotime($timevalue[0]);
							
											$con_party_id[$count] = $pinfo[1];
											$con_party_name[$count] = $pinfo[0];
											$con_party_pic[$count] = $pinfo[2];
											
											$frequency[$count] = ($party_visit_count[$count] / $party_times[$count])*100;
											$count++;
										}
										else{
											
										}
									}//for
								}//if-rows
								
								for($i=0;$i<($count-1);$i++){
									for($j=$i;$j<$count;$j++){
										if($frequency[$i] < $frequency[$j]){
											$temp = $con_party_id[$j];
											$frequency[$j] = $frequency[$i];
											$frequency[$i] = $temp;
											
											$temp = $con_party_id[$j];
											$con_party_id[$j] = $con_party_id[$i];
											$con_party_id[$i] = $temp;
											
											$temp = $con_party_name[$j];
											$con_party_name[$j] = $con_party_name[$i];
											$con_party_name[$i] = $temp;
											
											$temp = $con_party_pic[$j];
											$con_party_pic[$j] = $con_party_pic[$i];
											$con_party_pic[$i] = $temp;
										}
									}
								}
								echo "con_party_num: ".json_encode($count).", con_party: [";
								for($i=0;$i<$count;$i++){
									if($i>0) echo ",";
									echo "{";
									echo "pid: ".json_encode($con_party_id[$i]).", ";
									echo "pname: ".json_encode($con_party_name[$i]).", ";
									echo "ppic: ".json_encode($con_party_pic[$i])." ";
									echo "}";
								}
								echo "]";
							}
							else{
								echo "con_party_num: ".json_encode(0)." ";
							}
							echo "}";
						}			
					
				}
				else{
					echo "{ Result: ".json_encode(2).", Error_text: ".json_encode('존재하지 않는 회원입니다. ErrorCode : 7')."}";
				}
			}
			else{
				echo "{ Result: ".json_encode(3).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 22')."}";
			}
		}
		else{
			echo "{ Result: ".json_encode(2).", Error_text: ".json_encode('접속자 정보가 잘못되었습니다. ErrorCode : 25')."}";
		}
	}
	else{
		echo "{ Result: ".json_encode(3).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 8')."}";
	}
	echo "]\r\n}\r\n";
}

//******************************************************************************** OPT=5 / GET REQUEST ARTICLE INFORMATION API*****************************************// 글 불러오기

else if($opt==5){
	echo "{\r\ngraiAPI: [";		
		if($afrom){
			if($afrom==1){		//**********************************  MYNOTE
				if($mynoteid){
					$sql1 = "select name from member where id='$mynoteid'";
					$result1 = mysql_query($sql1,$connect);
					$setconn = mysql_num_rows($result1);
					if($setconn){
						if($userid){
							$sql = "select*from member where id='$userid'";
							$result = mysql_query($sql,$connect);
							$me_exa = mysql_num_rows($result);
							if($me_exa){		// 존재하는 mynote
								$sql = "select distinct a.a_content, a.time, a.id, m2.name, m2.id, m2.profilepic, a.party, m.name, m.id, a.pic, a.scrapper, a.a_open from member m, member m2, article a where m.id=$userid and a.mynote=m.id and m2.id=a.mem order by a.time desc";
								$result = mysql_query($sql,$connect);
								$note_exa = mysql_num_rows($result);
								if($note_exa){	//*********Mynote Contents Loading********************//

								for($i=0;$i<$note_exa;$i++)
								{
									mysql_data_seek($result, $i);
									$row = mysql_fetch_array($result);
									
									if($row[6]!=0){
										$sqll = "select p_public from party where id='$row[6]'";
										$rst = mysql_query($sqll,$connect);
										$ost = mysql_fetch_array($rst);
										
										$sqll = "select*from partyjoin where member_id='$mynoteid' and party_id='$row[6]'";
										$rst = mysql_query($sqll,$connect);
										$oost = mysql_num_rows($rst);
									}
									
									if($mynoteid!=$userid){
										$ssql = "select*from partyjoin where party_id='$row[6]' and member_id='$mynoteid'";
										$rresult = mysql_query($ssql,$connect);
										$tt = mysql_num_rows($rresult);
									}
									if($mynoteid==$userid || $row[11]!=2 || $tt!=0){
										$ma = true;
									}
									else{
										$ma = false;
									}
								
									if($userid!=$mynoteid){
										$ssql = "select*from friendship where mem1='$mynoteid' and mem2='$userid'";
										$rresult = mysql_query($ssql,$connect);
										$tt = mysql_num_rows($rresult);
									}
									if($row[11]==0 || $tt!=0 || $id==$mynoteid){
										$nf = true;
									}
									else{
										$nf = false;
									}
								

								}//for
								
								echo "{\r\n Result: ".json_encode(0).", Result_data: [";
									$cc=0;
									for($i=0;$i<$note_exa;$i++){
										mysql_data_seek($result,$i);
										$noteArticle = mysql_fetch_array($result);																
										
										if($noteArticle[6]!=0){
											$sqll = "select p_public from party where id='$noteArticle[6]'";
											$rst = mysql_query($sqll,$connect);
											$ost = mysql_fetch_array($rst);
											
											$sqll = "select*from partyjoin where member_id='$mynoteid' and party_id='$noteArticle[6]'";
											$rst = mysql_query($sqll,$connect);
											$oost = mysql_num_rows($rst);
										}//if
										
										if($noteArticle[6]==0 || $ost[0]==0 || $oost==1){
											
											if($userid!=$mynoteid){
												$ssql = "select*from partyjoin where party_id='$noteArticle[6]' and member_id='$mynoteid'";
												$rresult = mysql_query($ssql,$connect);
												$tt = mysql_num_rows($rresult);
											}
											if($userid==$mynoteid || $noteArticle[11]!=2 || $tt!=0){
												$memberauth = true;
											}
											else{
												$memberauth = false;
											}																					
											
											if($userid!=$mynoteid){
												$ssql = "select*from friendship where mem1='$mynoteid' and mem2='$userid'";
												$rresult = mysql_query($ssql,$connect);
												$tt = mysql_num_rows($rresult);
											}
											if($noteArticle[11]==0 || $tt!=0 || $userid==$mynoteid){
												$notefrien = true;
											}
											else{
												$notefrien = false;
											}
											
											if($noteArticle[11]!=2 && $notefrien){
												$arauth = true;
											}
											else if($noteArticle[11]==2 && $memberauth){
												$arauth = true;
											}
											else{
												$arauth = false;
											}
											
											if($arauth){
											
												if($cc>0) echo ", ";
												$cc++;
												echo "{\r\n";
												echo "ArticleID: ".json_encode($noteArticle[2]).", ";
												echo "Author: ".json_encode($noteArticle[3]).", ";
												echo "AuthorID: ".json_encode($noteArticle[4]).", ";
												echo "AuthorPic: ".json_encode($noteArticle[5]).", ";
																					
												if($noteArticle[6]==0){
													$sql2 = "select name, id from member where id='$userid'";	//Article From
													$result2 = mysql_query($sql2,$connect);
													$UName = mysql_fetch_array($result2);
													echo "ArticleFrom: ".json_encode($UName[0].'의 노트').", ";
													echo "Isparty: ".json_encode(0).", ";
													echo "Belong: ".json_encode($UName[1]).", ";			
												}
												else{
													$query = "select pname from party where id='$noteArticle[6]'";
													$result0 = mysql_query($query,$connect);
													$ppp = mysql_fetch_array($result0);
													echo "ArticleFrom: ".json_encode($ppp[0]).", ";
													echo "Isparty: ".json_encode(1).", ";
													echo "Belong: ".json_encode($noteArticle[6]).", ";	
												}
												
												$sql2 = "select name, id from member where id='$noteArticle[10]'";		//Scrapper
												$result2 = mysql_query($sql2,$connect);
												$Scrap_exa = mysql_num_rows($result2);
												if($Scrap_exa){
													echo "Scrap_Check :".json_encode(1).", ";
													$Scrap = mysql_fetch_array($result2);
													echo "ScrapperID :".json_encode($Scrap[1]).", ";
													echo "ScrapperName :".json_encode($Scrap[0]).", ";
												}
												else{
													echo "Scrap_Check: ".json_encode(0).", ";
												}
																			
												$sql01 = "select id from article where origin='$noteArticle[2]'";
												$result01 = mysql_query($sql01,$connect);
												$eexa = mysql_num_rows($result01);
												echo "ScrapNum: ".json_encode($eexa).", ";
												
												echo "ArTime :".json_encode($noteArticle[1]).", ";
												echo "ArInfo :".json_encode($noteArticle[0]).", ";
												echo "ArPic :".json_encode($noteArticle[9]).", ";
												
												$sql2 = "select a.point from article_like a where a.mem=$mynoteid and a.article=$noteArticle[2]";
												$result2 = mysql_query($sql2, $connect);
												$total_record = mysql_num_rows($result2);
												if($total_record==0) // 투표한적 없음. 링크 띄워줌
												{
													echo "ArVote: ".json_encode(0).", ";				
												}
												else // 투표 했으면 안 띄워줌
												{
													echo "ArVote: ".json_encode(1).", ";
												}	
					
												// 이 글을 좋아하는 사람
												$sql2 = "select m.name, m.id, m.profilepic from member m, article_like a where a.article=$noteArticle[2] and a.point=1 and m.id=a.mem order by a.time desc";
												$result2 = mysql_query($sql2, $connect);
												$total_record = mysql_num_rows($result2);
												echo "Article_Like_Num: ".json_encode($total_record).", ";
												if($total_record){
													echo "Article_Like :[";
														for($k=0;$k<$total_record;$k++)
														{
															if($k>0)
																echo ",\r\n";
															mysql_data_seek($result2, $k);
															$row2 = mysql_fetch_array($result2);
															// row 로 받아온 상태!
																			
															echo "{\r\n";
															echo "Like_ID : ".json_encode($row2[1]).", ";
															echo "Like_Name: ".json_encode($row2[0]).", ";
															echo "Like_Pic : ".json_encode($row2[2])." ";
															echo "}\r\n";
														}
														echo "],\r\n";									
												}
												else{//if-totalrecord
													
												}
												
												// 댓글 표시 !!
												$sql2 = "select m.name, m2.name, r.r_content, r.time, m2.id, r.id, m2.profilepic from member m, member m2, reply r, article a where a.mem=m.id and r.r_article=a.id and m2.id=r.r_mem and a.id=$noteArticle[2] order by r.time";
												$result2 = mysql_query($sql2, $connect);
												$total_record = mysql_num_rows($result2);
												echo "Article_Comment_Num: ".json_encode($total_record)." ";
												
												
												
												echo "}\r\n";
											}
											
											
										}//if(비공개파티)
										
									}//for
									echo "]\r\n}\r\n";
									
								}
								else{	// 글이 없을때
									echo "{\r\n Result: ".json_encode(1)."\r\n}\r\n";
								}
							}
							else{	// 존재하지 않는 note
								echo "{\r\n Result: ".json_encode(2).", Error_text: ".json_encode('존재하지 않는 회원입니다. ErrorCode : 9')."}\r\n";
							}
						}
						else{			//userid 누락	
							echo "{\r\n Result: ".json_encode(3).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 10')."}\r\n";						
						}
					}
					else{	//set conn
						echo "{\r\n Result: ".json_encode(2).", Error_text: ".json_encode('접속자 정보가 잘못되었습니다. ErrorCode : 26')."}\r\n";
					}
				}
				else{	// mynoteid 누락
					echo "{\r\n Result: ".json_encode(3).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 11')."}\r\n";
				}
			}
			else if($afrom==2){				//********************************* PARTY
				if($partyid){
					if($mynoteid){						
						$sql1 = "select name from member where id='$mynoteid'";
						$result1 = mysql_query($sql1,$connect);
						$setconn = mysql_num_rows($result1);
						if($setconn){
							$sql = "select*from party where id='$partyid'";
							$result = mysql_query($sql,$connect);
							$pt_exa = mysql_num_rows($result);
							$pt_info = mysql_fetch_array($result);
							if($pt_exa){		// 존재하는 party						
								$sql = "select distinct a.a_content, a.time, a.id, m.name, m.id, m.profilepic, a.pic, a.scrapper, a.notice, a.a_open from party p, article a, member m where p.id=$partyid and a.party=p.id and m.id=a.mem order by a.time desc";
								$result = mysql_query($sql, $connect);
								$party_exa = mysql_num_rows($result);
								if($party_exa){
									

									for($i=0;$i<$party_exa;$i++)
									{
										mysql_data_seek($result, $i);
										$row = mysql_fetch_array($result);
										
										$sqll = "select p_public from party where id='$partyid'";
										$rst = mysql_query($sqll,$connect);
										$ost = mysql_fetch_array($rst);
										
										$sqll = "select*from partyjoin where member_id='$mynoteid' and party_id='$partyid'";
										$rst = mysql_query($sqll,$connect);
										$oost = mysql_num_rows($rst);
										
									}//for
									if($ost[0]==0 || $oost==1){
									
										echo "{\r\nResult: ".json_encode(0).", Result_data: [";
										$cc=0;
										for($i=0;$i<$party_exa;$i++){
											mysql_data_seek($result, $i);
											$partyArticle = mysql_fetch_array($result);
											
											$sqll = "select*from partyjoin where member_id='$mynoteid' and party_id='$partyid'";
											$rst = mysql_query($sqll,$connect);
											$oost = mysql_num_rows($rst);
											
											if($partyArticle[9]!=2 || $oost==1){
											
												if($cc>0) echo ", ";
												$cc++;
												
												echo "{\r\n";
												echo "ArticleID: ".json_encode($partyArticle[2]).", ";
												echo "Author: ".json_encode($partyArticle[3]).", ";
												echo "AuthorID: ".json_encode($partyArticle[4]).", ";
												echo "AuthorPic: ".json_encode($partyArticle[5]).", ";																
											
												$query1 = "select p.pname, p.id from party p where p.id=$pt_info[2]";
												$result1 = mysql_query($query1,$connect);
												$sol = mysql_fetch_array($result1);
												echo "ArticleFrom: ".json_encode($sol[0]).", ";
												echo "Isparty: ".json_encode(1).", ";
												echo "Belong: ".json_encode($sol[1]).", ";
												
												
												$sql2 = "select name, id from member where id='$partyArticle[7]'";		//Scrapper
												$result2 = mysql_query($sql2,$connect);
												$Scrap_exa = mysql_num_rows($result2);
												if($Scrap_exa){
													echo "Scrap_Check :".json_encode(1).", ";
													$Scrap = mysql_fetch_array($result2);
													echo "ScrapperID :".json_encode($Scrap[1]).", ";
													echo "ScrapperName :".json_encode($Scrap[0]).", ";
												}
												else{
													echo "Scrap_Check: ".json_encode(0).", ";
												}
												
												$sql01 = "select id from article where origin='$partyArticle[2]'";
												$result01 = mysql_query($sql01,$connect);
												$eexa = mysql_num_rows($result01);
												echo "ScrapNum: ".json_encode($eexa).", ";
												
												echo "ArTime :".json_encode($partyArticle[1]).", ";
												echo "ArInfo :".json_encode($partyArticle[0]).", ";
												echo "ArPic :".json_encode($partyArticle[6]).", ";
												
												$sql2 = "select a.point from article_like a where a.mem=$mynoteid and a.article=$partyArticle[2]";
												$result2 = mysql_query($sql2, $connect);
												$total_record = mysql_num_rows($result2);
												if($total_record==0) // 투표한적 없음. 링크 띄워줌
												{
													echo "ArVote: ".json_encode(0).", ";				
												}
												else // 투표 했으면 안 띄워줌
												{
													echo "ArVote: ".json_encode(1).", ";
												}
												
												// 이 글을 좋아하는 사람
												$sql2 = "select m.name, m.id, m.profilepic from member m, article_like a where a.article=$partyArticle[2] and a.point=1 and m.id=a.mem order by a.time desc";
												$result2 = mysql_query($sql2, $connect);
												$total_record = mysql_num_rows($result2);
												echo "Article_Like_Num: ".json_encode($total_record).", ";
												if($total_record){
													echo "Article_Like :[";
														for($k=0;$k<$total_record;$k++)
														{
															if($k>0)
																echo ",\r\n";
															mysql_data_seek($result2, $k);
															$row2 = mysql_fetch_array($result2);
															// row 로 받아온 상태!
																			
															echo "{\r\n";
															echo "Like_ID : ".json_encode($row2[1]).", ";
															echo "Like_Name: ".json_encode($row2[0]).", ";
															echo "Like_Pic : ".json_encode($row2[2])." ";
															echo "}\r\n";
														}
														echo "],\r\n";									
												}
												else{//if-totalrecord
													
												}
													
												// 댓글 표시 !!
												$sql2 = "select m.name, m2.name, r.r_content, r.time, m2.id, r.id, m2.profilepic from member m, member m2, reply r, article a where a.mem=m.id and r.r_article=a.id and m2.id=r.r_mem and a.id=$partyArticle[2] order by r.time";
												$result2 = mysql_query($sql2, $connect);
												$total_record = mysql_num_rows($result2);
												echo "Article_Comment_Num: ".json_encode($total_record)." ";
												
												
												echo "\r\n}";
											}//if-파티공개글 거르기
												
										}//for						
										echo "\r\n]\r\n}";									
									}//if-비공개파티 숨기기용
									else{
										//비공개파티 숨기기-Result추가해야할듯
									}
								}
								else{
									echo "{\r\n Result: ".json_encode(1)."\r\n}\r\n";
								}
							}
							else{				// 존재하지 않는 party
								echo "{\r\n Result: ".json_encode(2).", Error_text: ".json_encode('존재하지 않는 파티입니다. ErrorCode : 12')."}\r\n";
							}
						}
						else{	//set conn
							echo "{\r\n Result: ".json_encode(2).", Error_text: ".json_encode('접속자 정보가 잘못되었습니다. ErrorCode : 27')."}\r\n";
						}
					}
					else{	//mynoteid 누락
						echo "{\r\n Result: ".json_encode(3).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 13')."}\r\n";
					}
				}
				else{	//partyid 누락
					echo "{\r\n Result: ".json_encode(3).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 14')."}\r\n";
				}
			}						
		}		
		else if($afrom==0){		// wassup		
				if($mynoteid){					
					$sql = "select*from member where id='$mynoteid'";
					$result = mysql_query($sql,$connect);
					$me_exa = mysql_num_rows($result);
					if($me_exa){		// 존재하는 mynote						
						$sql = "select distinct a.a_content, a.time, a.id, m2.name, m2.id, m2.profilepic, a.party, m2.name, a.pic, a.scrapper, a.a_open from member m, member m2, article a, friendship f where m.id=$mynoteid and f.mem1=m.id and f.mem2=m2.id and m2.id=a.mem order by a.time desc";
						$result = mysql_query($sql, $connect);
						$total_recording = mysql_num_rows($result);
						if($total_recording){
							
							for($i=0;$i<$total_recording;$i++){
								mysql_data_seek($result, $i);
								$row = mysql_fetch_array($result);
								
								if($row[6]!=0){
									$sqll = "select p_public from party where id='$row[6]'";
									$rst = mysql_query($sqll,$connect);
									$ost = mysql_fetch_array($rst);
									
									$sqll = "select*from partyjoin where member_id='$mynoteid' and party_id='$row[6]'";
									$rst = mysql_query($sqll,$connect);
									$oost = mysql_num_rows($rst);
								}
								
								$ssql = "select*from partyjoin where party_id='$row[6]' and member_id='$mynoteid'";
								$rresult = mysql_query($ssql,$connect);
								$tt = mysql_num_rows($rresult);
								
								if($row[10]!=2 || $tt!=0){
									$ma = true;
								}
								else{
									$ma = false;
								}
							}
							
							
							echo "{\r\n Result: ".json_encode(0).", Result_data: [";
							$cc=0;
							for($i=0;$i<$total_recording;$i++){
								mysql_data_seek($result, $i);
								$whatsupArticle = mysql_fetch_array($result);
								
								if($whatsupArticle[4]!=1){
								
								if($whatsupArticle[6]!=0){
									$sqll = "select p_public from party where id='$whatsupArticle[6]'";
									$rst = mysql_query($sqll,$connect);
									$ost = mysql_fetch_array($rst);
									
									$sqll = "select*from partyjoin where member_id='$mynoteid' and party_id='$whatsupArticle[6]'";
									$rst = mysql_query($sqll,$connect);
									$oost = mysql_num_rows($rst);
								}								
								
								if($whatsupArticle[6]==0 || $ost[0]==0 || $oost==1){	
									$ssql = "select*from partyjoin where party_id='$whatsupArticle[6]' and member_id='$mynoteid'";
									$rresult = mysql_query($ssql,$connect);
									$tt = mysql_num_rows($rresult);
									
									if($whatsupArticle[10]!=2 || $tt!=0){
										$memberauth = true;
									}
									else{
										$memberauth = false;
									}
										
									
									if($whatsupArticle[10]!=2 || $memberauth){
										$arauth = true;
									}			
									else{
										$arauth = false;
									}
								
									if($arauth){
								
										if($cc>0) echo ", ";		
										$cc++;	
										
										echo "{\r\n";
										echo "ArticleID: ".json_encode($whatsupArticle[2]).", ";
										echo "Author: ".json_encode($whatsupArticle[3]).", ";
										echo "AuthorID: ".json_encode($whatsupArticle[4]).", ";
										echo "AuthorPic: ".json_encode($whatsupArticle[5]).", ";																
										
										if($whatsupArticle[6]==0)
										{
											$sql11 = "select distinct m.name, m.id from article a, member m where a.id=$whatsupArticle[2] and m.id=a.mynote";
											$result11 = mysql_query($sql11,$connect);
											$re = mysql_fetch_array($result11);
											echo "ArticleFrom: ".json_encode($re[0].'님의 노트').", ";	
											echo "Isparty: ".json_encode(0).", ";												
											echo "Belong: ".json_encode($re[1]).", ";
										}
										else
										{
											$query1 = "select p.pname, p.id from party p where p.id=$whatsupArticle[6]";
											$result1 = mysql_query($query1,$connect);
											$sol = mysql_fetch_array($result1);
											echo "ArticleFrom: ".json_encode($sol[0]).", ";
											echo "Isparty: ".json_encode(1).", ";
											echo "Belong: ".json_encode($sol[1]).", ";
										}							
										
										$sql2 = "select name, id from member where id='$whatsupArticle[9]'";		//Scrapper
										$result2 = mysql_query($sql2,$connect);
										$Scrap_exa = mysql_num_rows($result2);
										if($Scrap_exa){
											echo "Scrap_Check :".json_encode(1).", ";
											$Scrap = mysql_fetch_array($result2);
											echo "ScrapperID :".json_encode($Scrap[1]).", ";
											echo "ScrapperName :".json_encode($Scrap[0]).", ";
										}
										else{
											echo "Scrap_Check: ".json_encode(0).", ";
										}
										
										$sql01 = "select id from article where origin='$whatsupArticle[2]'";
										$result01 = mysql_query($sql01,$connect);
										$eexa = mysql_num_rows($result01);
										echo "ScrapNum: ".json_encode($eexa).", ";
										
										echo "ArTime :".json_encode($whatsupArticle[1]).", ";
										echo "ArInfo :".json_encode($whatsupArticle[0]).", ";
										echo "ArPic :".json_encode($whatsupArticle[8]).", ";
										
										$sql2 = "select a.point from article_like a where a.mem=$mynoteid and a.article=$whatsupArticle[2]";
										$result2 = mysql_query($sql2, $connect);
										$total_record = mysql_num_rows($result2);
										if($total_record==0) // 투표한적 없음. 링크 띄워줌
										{
											echo "ArVote: ".json_encode(0).", ";				
										}
										else // 투표 했으면 안 띄워줌
										{
											echo "ArVote: ".json_encode(1).", ";
										}
												
										// 이 글을 좋아하는 사람
										$sql2 = "select m.name, m.id, m.profilepic from member m, article_like a where a.article=$whatsupArticle[2] and a.point=1 and m.id=a.mem order by a.time desc";
										$result2 = mysql_query($sql2, $connect);
										$total_record = mysql_num_rows($result2);
										echo "Article_Like_Num: ".json_encode($total_record).", ";
										if($total_record){
											echo "Article_Like :[";
												for($k=0;$k<$total_record;$k++)
												{
													if($k>0)
														echo ",\r\n";
													mysql_data_seek($result2, $k);
													$row2 = mysql_fetch_array($result2);
													// row 로 받아온 상태!
																	
													echo "{\r\n";
													echo "Like_ID : ".json_encode($row2[1]).", ";
													echo "Like_Name: ".json_encode($row2[0]).", ";
													echo "Like_Pic : ".json_encode($row2[2])." ";
													echo "}\r\n";
												}
												echo "],\r\n";									
										}
										else{//if-totalrecord
											
										}		
										
										// 댓글 표시 !!
										$sql2 = "select m.name, m2.name, r.r_content, r.time, m2.id, r.id, m2.profilepic from member m, member m2, reply r, article a where a.mem=m.id and r.r_article=a.id and m2.id=r.r_mem and a.id=$whatsupArticle[2] order by r.time";
										$result2 = mysql_query($sql2, $connect);
										$total_record = mysql_num_rows($result2);
										echo "Article_Comment_Num: ".json_encode($total_record)." ";
										
										
										echo "\r\n}\r\n";
									}
								}//if-비공개파티 필터링
								}
							}//for
							echo "\r\n]\r\n}";
						}
						else{	// 글이 존재하지 않음
							echo "{\r\n Result: ".json_encode(1)."}\r\n";
						}
					}		
					else{		// 존재하지 않는 User
						echo "{\r\n Result: ".json_encode(2).", Error_text: ".json_encode('존재하지 않는 회원입니다. ErrorCode : 19')."}\r\n";
					}					
				}
				else{	//mynoteid 누락
					echo "{\r\n Result: ".json_encode(3).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 18')."}\r\n";
				}						
		}	
		else{
			echo "{\r\n Result: ".json_encode(3).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 15')."}\r\n";
		}
		echo "]\r\n}\r\n";
}

//******************************************************************************** OPT=6 / GET USER WHO LIST API*******************************************************// 팬슈머 불러오기

else if($opt==6){
	echo "{\r\ngwlAPI: [";
	if($mynoteid){
		$sql = "select * from member m where m.id='$mynoteid'";
		$result = mysql_query($sql, $connect);
		$total_record = mysql_num_rows($result);
		$me = mysql_fetch_array($result);
	
		$sql1 = "select name from member where id='$mynoteid'";
		$result1 = mysql_query($sql1,$connect);
		$setconn = mysql_num_rows($result1);
		if($setconn){
			$sql = "select*from member where id='$mynoteid'";
			$result = mysql_query($sql,$connect);
			$mem_exa = mysql_num_rows($result);
			if($mem_exa){		
				//전체사용자의 ID받아옴				
				$sql = "select id from member";
				$result=mysql_query($sql,$connect);
				$allNumber = mysql_num_rows($result);
				
				for($i=0;$i<$allNumber;$i++){
					mysql_data_seek($result,$i);
					$all = mysql_fetch_array($result);
					if($all[0]!=1){
					
					$total_score[$i] = 0;
					
					$allid[$i]=$all[0];
						$sql1 = "select count from visit where from_mem='$allid[$i]' and to_mem='$me[4]'"; 	//나한테 들어온 횟수 점수환산
						$result1 = mysql_query($sql1,$connect);			
						$counting = mysql_fetch_array($result1);
						if($counting[0]){
							$total_score[$i] = $counting[0] * 1;
						}
						else{
							$total_score[$i] = 0;
						}
				///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
						$c_party = 0;
						$sql2 = "select party_id from partyjoin where member_id='$allid[$i]'";			//나와 파티 중첩도 점수환산
						$result2 = mysql_query($sql2,$connect);
						$partynum = mysql_num_rows($result2);
						if($partynum){
							for($j=0;$j<$partynum;$j++){
								mysql_data_seek($result2,$j);
								$partyid = mysql_fetch_array($result2);
								$sql3 = "select*from partyjoin where member_id='$me[id]' and party_id='$partyid[0]'";
								$result3 = mysql_query($sql3,$connect);
								$samepartynum = mysql_num_rows($result3);
								if($samepartynum){
									$c_party += 1;
								}
								else{
									$c_party += 0;
								}
							}				
							$total_score[$i] += (5*($c_party*($c_party+1)))/2;
						}
						else{
							$total_score[$i] += 0; 
						}
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
						$sql4 = "select*from friend_vote where to_mem='$me[id]' and from_mem='$allid[$i]'";
						$result4 = mysql_query($sql4,$connect);
						$votenum = mysql_num_rows($result4);
						if($votenum){				
							$total_score[$i] += 2*$votenum;
						}
						else{
							$total_score[$i] += 0;
						}
						if($allid[$i]==$me[id]){
							$total_score[$i] = -1;
						}
					}
				}
				
				
				
				//최종 10명 산출
				for($i=0;$i<$allNumber;$i++){
					for($j=($i+1);$j<$allNumber;$j++){
						if($total_score[$i]<$total_score[$j]){
							$temp = $total_score[$j];
							$total_score[$j] = $total_score[$i];
							$total_score[$i] = $temp;
							
							$temp1 = $allid[$j];
							$allid[$j] = $allid[$i];
							$allid[$i] = $temp1;
						}
						
					}
				}
				echo "{ Result: ".json_encode(0).", Result_data: [";				
				for($i=0;$i<10;$i++){
					if($i>0) echo ",\r\n";
					echo "{\r\n";
					$sql5 = "select*from member where id='$allid[$i]'";
					$result5 = mysql_query($sql5,$connect);
					$finfo = mysql_fetch_array($result5);
					
					$c_party = 0;
						$sql6 = "select party_id from partyjoin where member_id='$allid[$i]'";			//나와 파티 중첩도 점수환산
						$result6 = mysql_query($sql6,$connect);
						$partynum = mysql_num_rows($result6);
						if($partynum){
							for($j=0;$j<$partynum;$j++){
								mysql_data_seek($result6,$j);
								$partyid = mysql_fetch_array($result6);
								$sql7 = "select*from partyjoin where member_id='$me[id]' and party_id='$partyid[0]'";
								$result7 = mysql_query($sql7,$connect);
								$samepartynum = mysql_num_rows($result7);
								if($samepartynum){
									$c_party += 1;
								}
								else{
									$c_party += 0;
								}
							}
						}
						else{
							$c_party = 0;
						}
					
							echo "Wname: ".json_encode($finfo[0]).", ";
							echo "Wid: ".json_encode($finfo[4]).", ";
							echo "Wpic: ".json_encode($finfo[11]).", ";
							echo "Wparty: ".json_encode($c_party).", ";
							echo "Wtotal: ".json_encode($total_score[$i])." ";
							echo "}\r\n";		
				}	
				echo "]\r\n}\r\n";
			}
			else{
				echo "{\r\n Result: ".json_encode(2).", Error_text: ".json_encode('존재하지 않는 회원입니다. ErrorCode : 16')."}\r\n";
			}
		}
		else{	//set conn
			echo "{\r\n Result: ".json_encode(2).", Error_text: ".json_encode('접속자 정보가 잘못되었습니다. ErrorCode : 29')."}\r\n";
		}
	}
	else{	// invalid parameter
		echo "{\r\n Result: ".json_encode(3).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 17')."}\r\n";
	}
	echo "]\r\n}\r\n";
}

//******************************************************************************** OPT=7 GET PARTY INFORMATION API*****************************************************// 파티 정보 읽어오기

else if($opt==7){
	echo "{\r\n gpiAPI: [";
	if($mynoteid){
		$sql1 = "select name from member where id='$mynoteid'";
		$result1 = mysql_query($sql1,$connect);
		$setconn = mysql_num_rows($result1);
		if($setconn){
			if($userid){
				if($partyid){
					$sql  = "select id from member where id='$userid'";
					$result = mysql_query($sql,$connect);
					$user_exa = mysql_num_rows($result);					
					if($user_exa){							
						$sql1 = "select*from party where id='$partyid'";
						$result1 = mysql_query($sql1,$connect);
						$pt_exa = mysql_num_rows($result1);
						$pt_info = mysql_fetch_array($result1);
						if($pt_exa){
							$sqls = "select*from partyjoin where member_id='$mynoteid' and party_id='$partyid'";							
							$results = mysql_query($sqls,$connect);
							$joined = mysql_num_rows($results);
							echo "{ Result: ".json_encode(0).", PartyName: ".json_encode($pt_info[0]).", PartyPic: ".json_encode($pt_info[7]).", joined: ".json_encode($joined).", ";
							echo "PartySSierID: ".json_encode($pt_info[1]).", ";
							$sql2 = "select name, profilepic from member where id='$pt_info[1]'";
							$result2 = mysql_query($sql2,$connect);
							$PSS = mysql_fetch_array($result2);
							echo "PartySSierName: ".json_encode($PSS[0]).", ";
							echo "PartySSierPic: ".json_encode($PSS[1]).", ";
							echo "p_public: ".json_encode($pt_info[9]).", ";
							echo "p_permission: ".json_encode($pt_info[10]).", ";
							$sql2 = "select a.notice, a.id, a.mem, a.time, a.a_content from article a where a.party='$partyid' order by a.time desc";
							$result2 = mysql_query($sql2,$connect);
							$ANC_Num = mysql_num_rows($result2);
							echo "Party_aNum: ".json_encode($ANC_Num).", ";
							if($ANC_Num!=0){
								$count = 0;								
								for($i=0;$i<$ANC_Num;$i++){
									mysql_data_seek($result2,$i);
									$Ann = mysql_fetch_array($result2);
									if($Ann[0]!=0){
										$Ann_aid[$count] = $Ann[1];
										$Ann_uid[$count] = $Ann[2];
										$Ann_atime[$count] = $Ann[3];
										$Ann_ainfo[$count] = $Ann[4];
										$count++;
									}
								}//for
								if($count){	//공지글 존재
									echo "Party_Ann_Num: ".json_encode($count).", Party_Ann_data: [";
									for($i=0;$i<$count;$i++){
										if($i>0) echo ", ";										
										echo "\r\n{\r\n";
										$sql3 = "select name, id, profilepic from member where id='$Ann_uid[$i]'";
										$result3 = mysql_query($sql3,$connect);
										$sol = mysql_fetch_array($result3);
										echo "Party_Ann_uID: ".json_encode($sol[1]).", ";
										echo "Party_Ann_uName: ".json_encode($sol[0]).", ";
										echo "Party_Ann_uPic: ".json_encode($sol[3]).", ";
										echo "Party_Ann_aID: ".json_encode($Ann_aid[$i]).", ";
										echo "Party_Ann_aInfo: ".json_encode($Ann_ainfo[$i]).", ";
										echo "Party_Ann_aTime: ".json_encode($Ann_atime[$i])." ";
										echo "}\r\n";
									}//for
									echo "\r\n], ";
								}
								else{	//공지글 없음
									echo "Party_Ann_Num: ".json_encode(0).", ";
								}
							}
							
							$sql2 = "select distinct j.member_id, m.name, m.profilepic from partyjoin j, member m where j.party_id=$partyid and m.id=j.member_id";
							$result2 = mysql_query($sql2,$connect);
							$PM_Num = mysql_num_rows($result2);
							
							if($PM_Num){	//파티 가입자
								echo "Party_Mem_Num: ".json_encode($PM_Num).", Party_Mem_data: [";
								for($i=0;$i<$PM_Num;$i++){
									mysql_data_seek($result2,$i);
									$pm_data = mysql_fetch_array($result2);
									if($i>0) echo ", ";
									echo "\r\n{\r\n";
									echo "Party_Mem_Name: ".json_encode($pm_data[1]).", ";
									echo "Party_Mem_Pic: ".json_encode($pm_data[2]).", ";
									echo "Party_Mem_ID: ".json_encode($pm_data[0]).", ";
									if($pm_data[0]==$mynoteid){
										echo "Party_Mem_Party: ".json_encode(-1).", Fstat: ".json_encode(0)." ";
									}
									else{
										$sqls = "select party_id from partyjoin where member_id='$pm_data[0]'";
										$results = mysql_query($sqls,$connect);
										$exxa = mysql_num_rows($results);
										
										$ct=0;										
										for($j=0;$j<$exxa;$j++){
											mysql_data_seek($results,$j);
											$rowss = mysql_fetch_array($results);
											
											$sqlz = "select*from partyjoin where member_id='$mynoteid' and party_id='$rowss[0]'";	
											$resultz = mysql_query($sqlz,$connect);
											$aa = mysql_num_rows($resultz);							
											if($aa){									
												$ct = $ct + 1;
											}
										}
										echo "Party_Mem_Party: ".json_encode($ct).", ";
										$ct=0;
										
										$ssql = "select*from friendship where mem1='$mynoteid' and mem2='$pm_data[0]'";
										$results = mysql_query($ssql,$connect);
										$ro = mysql_num_rows($results);
										if($ro){
											echo "Fstat: ".json_encode(1)." ";
										}
										else{
											$ssql = "select*from friend_req where from_mem='$mynoteid' and to_mem='$pm_data[0]'";
											$results = mysql_query($ssql,$connect);
											$ro1 = mysql_num_rows($results);
											if($ro1){
												echo "Fstat: ".json_encode(2)." ";
											}
											else{
												$ssql = "select*from friend_req where from_mem='$pm_data[0]' and to_mem='$mynoteid'";
												$results = mysql_query($ssql,$connect);
												$ro2 = mysql_num_rows($results);
												if($ro2){
													echo "Fstat: ".json_encode(3)." ";
												}
												else{
													echo "Fstat: ".json_encode(4)." ";
												}
											}
										}
										
									}
									
									
									echo "}\r\n";
								}
								echo "\r\n], ";
							}
							else{	//파티 가입자 없음
								echo "Party_Mem_Num: ".json_encode(0).", ";
							}
							
							echo "Result_data: [";
							$sql2 = "select distinct j.party_id, p.pname, p.pic from partyjoin j, party p where j.member_id=$userid and p.id=j.party_id";
							$result2 = mysql_query($sql2,$connect);
							$pnum = mysql_num_rows($result2);
							for($i=0;$i<$pnum;$i++){
								mysql_data_seek($result2,$i);
								$up_info = mysql_fetch_array($result2);
								if($i>0) echo ", ";
								echo "\r\n{\r\n";
								echo "Result_pID: ".json_encode($up_info[0]).", ";
								echo "Result_pName: ".json_encode($up_info[1]).", ";
								echo "Result_pPic: ".json_encode($up_info[2])." ";
								echo "\r\n}";
							}//for
							echo "\r\n]";
							echo "\r\n}";
						}
						else{	// 존재하지 않는 파티 
							echo "{\r\n Result: ".json_encode(1).", Error_text: ".json_encode('존재하지 않는 파티입니다. ErrorCode : 33')."}\r\n";
						}
					}
					else{	// 존재하지 않는 회원
						echo "{\r\n Result: ".json_encode(1).", Error_text: ".json_encode('존재하지 않는 회원입니다. ErrorCode : 28')."}\r\n";
					}			
				}
				else{	//partyid 누락
					echo "{\r\n Result: ".json_encode(2).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 32')."}\r\n";
				}
			}
			else{	//userid 누락
				echo "{\r\n Result: ".json_encode(2).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 31')."}\r\n";
			}
		}
		else{	//set conn
			echo "{\r\n Result: ".json_encode(1).", Error_text: ".json_encode('접속자 정보가 잘못되었습니다. ErrorCode : 29')."}\r\n";
		}
	}
	else{	//mynoteid 누락
		echo "{\r\n Result: ".json_encode(2).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 30')."}\r\n";
	}
	echo "\r\n]\r\n}";
}

//******************************************************************************** OPT=8  API GET COMMENT INFORMATION API *********************************************// 댓글 정보 읽어오기

else if($opt==8){
	echo "{\r\n gaciAPI: [";
	if($mynoteid){
		if($articleID){			
			// 댓글 표시 !!
			$sql2 = "select m.name, m2.name, r.r_content, r.time, m2.id, r.id, m2.profilepic from member m, member m2, reply r, article a where a.mem=m.id and r.r_article=a.id and m2.id=r.r_mem and a.id=$articleID order by r.time";
			$result2 = mysql_query($sql2, $connect);
			$total_record = mysql_num_rows($result2);
						
			if($total_record){
				echo "{\r\nResult: 0, ";
				echo "Article_Comment_Num: ".json_encode($total_record)." ";
				echo ", ";
				echo "Article_Comment: [";
				for($k=0;$k<$total_record;$k++)
				{
					if($k>0) echo ", ";
					mysql_data_seek($result2, $k);
					$row2 = mysql_fetch_array($result2);
					
					// row 로 받아온 상태!
					echo "{\r\n";
					echo "Comment_aID: ".json_encode($row2[5]).", "; // reply id
					echo "Comment_Name: ".json_encode($row2[1]).", "; // 댓글 쓴 사람 이름
					echo "Comment_ID: ".json_encode($row2[4]).", "; // 댓글 쓴 사람 id	
					echo "Comment_Pic: ".json_encode($row2[6]).", "; // 프로필 사진																			
					echo "Comment_Info: ".json_encode($row2[2]).", ";
					echo "Comment_Time: ".json_encode($row2[3])." ";
					echo "}\r\n";
				}
				echo "]\r\n}\r\n";
			}
			else{//if-totalrecord
				echo "{\r\n Result: ".json_encode(1).", Error_text: ".json_encode('Don\'t exist Contents ErrorCode : 36')."}\r\n"; 
			}
			
		}
		else{ //articleID
			echo "{\r\n Result: ".json_encode(2).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 35')."}\r\n"; 
		}
	}
	else{	//mynoteid
		echo "{\r\n Result: ".json_encode(2).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 34')."}\r\n"; //37
	}
	echo "]\r\n}\r\n";
}

//******************************************************************************** OPT=9  Event School ***************************************************************// 이벤트중인 학교


//****************************************************************************			OPT 누락시			***********************************************************//
else{
	//missing parameter opt
}

//**********************************************************************************************************************************************************************//
//**********************************************************************************************************************************************************************//
//**********************************************************************************************************************************************************************//
//******************************************************************************	POST	****************************************************************************//
//**********************************************************************************************************************************************************************//
//**********************************************************************************************************************************************************************//
//**********************************************************************************************************************************************************************//

$oopt = $_POST['oopt'];
$version_param = $_POST['version_param'];
$block = $_POST['block'];
$ask = $_POST['ask'];
$endevent = $_POST['endevent'];

//*************************************************************************** Event End   *****************************************************************************// 이벤트종료
if($endevent==1){
	$mynoteid = $_POST['mynoteid'];
	
	$sql = "select university from member where id='$mynoteid'";
	$result = mysql_query($sql,$connect);
	$sch = mysql_fetch_array($result);
	
	$sql = "select*from event where target='$sch[0]'";
	$result = mysql_query($sql,$connect);
	$rows = mysql_num_rows($result);
	$row = mysql_fetch_array($result);			
	$evnum = $row[1];
	
	$sql = "select present from event where event_num='$row[1]'";
	$result = mysql_query($sql,$connect);
	$ok = mysql_fetch_array($result);
	
	if($rows!=0 && $ok[0]!=0){
		$sql = "update event set present='0' where event_num='$evnum'";
		mysql_query($sql,$connect);
	}
	else{
		//nothing
	}
}

//*************************************************************************** ask   ***********************************************************************************// 문의보내기

if($ask==1){
	$content = $_POST['content'];		
	
	$content = htmlspecialchars($content);
	$content = addslashes($content); 
	$content = str_replace("\n","<br>",$content);	
	
	$sql = "insert into article(id,mem, party, mynote, time, a_content, a_open) values (NULL,'-1', '-1', '-1', CURRENT_TIMESTAMP, '$content', '2')";
	mysql_query($sql,$connect);
	
	echo "[{ Result: ".json_encode(1)." }]";
			
	mysql_close();
}

//*************************************************************************** Block Checking   ************************************************************************// 중복확인

if($block==1){	
	$emailadd = $_POST['emailadd'];
	$phone = $_POST['phone'];
	
	$sql = "select*from member where email='$emailadd'";
	$result = mysql_query($sql,$connect);
	$rows = mysql_num_rows($result);
	
	echo "[{";
	if($rows){
		echo "email_check: 1, ";
	}
	else{
		echo "email_check: 0, ";
	}
	
	$sql = "select*from member where phone='$phone'";
	$result = mysql_query($sql,$connect);
	$rows = mysql_num_rows($result);
	if($rows){
		echo "mobile_check: 1 ";
	}
	else{
		echo "mobile_check: 0 ";
		$sql = "insert into test(id,a,b,c,d,e) values(NULL,'$phone','0','0','0','0')";
		mysql_query($sql,$connect);
	}
	
	echo "}]";
}

//*************************************************************************** Version Checking ************************************************************************// 버전체크

if($version_param==1){
	$sql = "select phone from member where id='1'";
	$result = mysql_query($sql,$connect);
	$version = mysql_fetch_array($result);
	echo "[{ version: ".json_encode($version[0])." }]";
}

//***************************************************************************** OOPT=1 Regist API *********************************************************************// 가입하기

if($oopt==1){
	$reg_email = $_POST['reg_email'];
	$reg_name = $_POST['reg_name'];
	$reg_pass = $_POST['reg_pass'];
	$reg_phone = $_POST['reg_phone'];
	$reg_gender = $_POST['reg_gender'];
	$reg_univ = $_POST['reg_univ'];
	
	
	echo "{\r\n regAPI: [";
		$sql = "select*from member where email='$reg_email'";
		$result = mysql_query($sql,$connect);
		$reg_exa = mysql_num_rows($result);
		echo "Result: ".json_encode($reg_exa)." ";
		if($reg_exa){
			break;
		}
		else{
			if($reg_gender==1){
				$img = "images/base/male160.png";
			}
			else{
				$img = "images/base/female160.png";
			}
			$sql = "insert into member(name, email, password, phone, gender, profilepic, university, auth) values('$reg_name','$reg_email', PASSWORD('$reg_pass'),'$reg_phone', '$reg_gender','$img', '$reg_univ', 'N')";
			mysql_query($sql,$connect);
			echo ", ";
			$sql = "select id from member where email='$reg_email'";
			$result = mysql_query($sql,$connect);
			$id = mysql_fetch_array($result);
			
			$sql = "insert into friendship(id, mem1, mem2, time) values(NULL,'1','$id[0]',CURRENT_TIMESTAMP)";
			mysql_query($sql,$connect);
			$sql = "insert into friendship(id, mem1, mem2, time) values(NULL,'$id[0]','1',CURRENT_TIMESTAMP)";
			mysql_query($sql,$connect);
			
			$sql = "select id from party where pname='$reg_univ'";
			$result = mysql_query($sql,$connect);
			$rows = mysql_num_rows($result);
			if($rows){
				$row = mysql_fetch_array($result);
				
				$sql = "select id from member where email='$reg_email'";
				$result = mysql_query($sql,$connect);
				$meid = mysql_fetch_array($result);
				
				$sql = "insert into partyjoin(member_id, party_id, visit_count, bookmark, id, join_time, visit_time,  notice) values('$meid[0]', '$row[0]', '1', '0', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '0')";
				mysql_query($sql,$connect);
								
			}
			
			echo "ID: $id[0]";
		}
	echo "]\r\n}\r\n";
}

//***************************************************************************** OOPT=2 Write Article API ***************************************************************// 글쓰기

else if($oopt==2){
	//echo "{\r\n writeAPI: [";
	
	$sql = "select NOW()";
	$result = mysql_query($sql,$connect);
	$nowar = mysql_fetch_array($result);
	$fnmae = substr($nowar[0],0,4).substr($nowar[0],5,2).substr($nowar[0],8,2).substr($nowar[0],11,2).substr($nowar[0],14,2).substr($nowar[0],17,2);		

	$position = $_POST['position'];
	$mynoteid = $_POST['mynoteid'];
	$toid = $_POST['toid'];
	$content = $_POST['content'];
	$aopen = $_POST['aopen'];	
	
	$gcm_content = htmlspecialchars($content);
	$gcm_content = addslashes($content); 
	$gcm_content = str_replace("\n","\r",$content);
	
	$content = htmlspecialchars($content);
	$content = addslashes($content); 
	$content = str_replace("\n","<br>",$content);
	
	if($position==1){	//note
		if($mynoteid && $toid){
			if(!$_FILES['uploadedfile']['name']){	//no picture			
				$sql = "insert into article(id, mem, party, mynote, time, a_content, a_open) values (NULL,'$mynoteid', '0', '$toid', CURRENT_TIMESTAMP, '$content', '$aopen')";	
				mysql_query($sql,$connect);
				
				$sql = "select name from member where id='$mynoteid'";
				$result = mysql_query($sql,$connect);
				$mename = mysql_fetch_array($result);
				
				$sql = "select id from article where mem='$mynoteid' and mynote='$toid' and a_content='$content' order by time desc";
				$result = mysql_query($sql,$connect);
				$article = mysql_fetch_array($result);
				
				$sql = "select name, mobile from member where id='$toid'";	
				$result = mysql_query($sql,$connect);
				$device = mysql_fetch_array($result);
				if($device[1] || $device[1]!=""){
					echo "[";
						echo "{ ID : ".json_encode($device[1]).", ";
						echo "Name: ".json_encode($mename[0]).", ";
						echo "FROM_ID: ".json_encode($article).", ";
						echo "Info: ".json_encode($gcm_content).", ";
						echo "From: ".json_encode($device[0]."님의 노트");	//mynote
						echo "}\r\n";
					echo "]";
				}
			}
			else{	//picture
				$image_location = "../upload/Article/".$mynoteid."_NOTE_".$fnmae;
				$rimage_location = "upload/Article/".$mynoteid."_NOTE_".$fnmae;
				if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $image_location)) {	//이미지 업로드 성공
					$width = getWidth($image_location);
					$height = getHeight($image_location);
					$scale = 1;
					$uploaded = resizeImage($image_location,$width,$height,$scale);
					
					$sql = "insert into article(id,mem, party, mynote, time, a_content, pic, a_open) values (NULL,'$mynoteid', '0', '$toid', CURRENT_TIMESTAMP, '$content', '$rimage_location', '$aopen')";	
					mysql_query($sql, $connect) or die(mysql_error());
				} else {
					//이미지 업로드 실패
				}
			}
			
			$sql = "select a.id from article a where a.mynote='$toid' order by time desc";
			$result = mysql_query($sql,$connect);
			$aaa = mysql_fetch_array($result);
			
			if($mynoteid != $toid){
				$sql = "select*from message where from_mem='$mynoteid' and to_mem='$toid' and article_id='$aaa[0]' and mtype='0'";
				$result = mysql_query($sql,$connect);
				$alarmnum = mysql_num_rows($result);
				
				if($alarmnum){
					$sql2 = "delete from message where from_mem='$mynoteid' and to_mem='$toid' and article_id='$aaa[0]' and mtype='0'";
					mysql_query($sql2,$connect);
					$sql = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$mynoteid', '$toid', '$aaa[0]', CURRENT_TIMESTAMP, '0', '0')";
					mysql_query($sql,$connect);
				}
				else{
					$sql = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$mynoteid', '$toid', '$aaa[0]', CURRENT_TIMESTAMP, '0', '0')";
					mysql_query($sql,$connect);
				}
			}
			/*$sql = "select name, mobile from member where id='$toid'";	
			$result = mysql_query($sql,$connect);
			$device = mysql_fetch_array($result);
			if($device[1] || $device[1]!=""){
				echo "[";
					echo "{ \"ID\":\"$device[1]\", ";
					echo "\"Name\": \"$device[0]\", ";
					echo "\"FROM_ID\": \"$toid\", ";
					echo "\"Info\": \"$gcm_content\", ";
					echo "\"From\": \"$device[0]님의 노트\"";	//mynote
					echo "}\r\n";
				echo "]";
			}*/
		}	
		
	}
	else if($position==2){	//party
		if($mynoteid && $toid){
			$notice = $_POST['notice'];	
			
			if(!$notice){
				if(!$_FILES['uploadedfile']['name']){	//no picture
					$sql = "insert into article(id,mem, party, mynote, time, a_content, a_open) values (NULL,'$mynoteid', '$toid', '$mynoteid', CURRENT_TIMESTAMP, '$content', '$aopen')";
					mysql_query($sql,$connect);
					
					$sql = "select name from member where id='$mynoteid'";
					$result = mysql_query($sql,$connect);
					$mename = mysql_fetch_array($result);
					
					$sql = "select id from article where mem='$mynoteid' and party='$toid' and a_content='$content' order by time desc";
					$result = mysql_query($sql,$connect);
					$article = mysql_fetch_array($result);
					
					$sql = "select pname from party where id='$toid'";
					$result = mysql_query($sql,$connect);
					$pname = mysql_fetch_array($result);
						
					$sql = "select member_id from partyjoin where party_id='$toid'";
					$result = mysql_query($sql,$connect);
					$rows = mysql_num_rows($result);	
					
					$count = 0;
					if($rows){
						echo "[";
						for($i=0;$i<$rows;$i++){
							mysql_data_seek($result,$i);
							
							$row = mysql_fetch_array($result);
							$sql2 = "select mobile from member where id='$row[0]'";
							$result2 = mysql_query($sql2,$connect);
							$device = mysql_fetch_array($result2);
							
							if($device[0] || $device[0]!=""){			
									if($count>0) echo ", ";
									echo "{ ID : ".json_encode($device[0]).", ";
									echo "Name: ".json_encode($mename[0]).", ";
									echo "FROM_ID: ".json_encode($article[0]).", ";
									echo "Info: ".json_encode($gcm_content).", ";
									echo "From: ".json_encode($pname[0]);	//mynote
									echo "}\r\n";										
									$count++;
							}//if
							
						}//for
						echo "]";
					}//if
				}
				else{
					$image_location = "../upload/Article/".$mynoteid."_PARTY_".$fnmae;
					$rimage_location = "upload/Article/".$mynoteid."_PARTY_".$fnmae;
					if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $image_location)) {	//이미지 업로드 성공
						$width = getWidth($image_location);
						$height = getHeight($image_location);
						$scale = 1;
						$uploaded = resizeImage($image_location,$width,$height,$scale);
						
						$sql = "insert into article(id,mem, party, mynote, time, a_content, pic, a_open) values (NULL,'$mynoteid', '$toid', '$mynoteid', CURRENT_TIMESTAMP, '$content', '$rimage_location', '$aopen')";
						mysql_query($sql, $connect) or die(mysql_error());
					} else {
						//이미지 업로드 실패
					}
				}
			}
			else{
				$title = $_POST['title'];
				if(!$_FILES['uploadedfile']['name']){	//no picture
					$sql = "insert into article(id,mem, party, mynote, time, a_content, notice, a_open) values (NULL,'$mynoteid', '$toid', '$mynoteid', CURRENT_TIMESTAMP, '$content', '1', '$aopen')";
					mysql_query($sql,$connect);
					
					$sql = "select id from article where mem='$mynoteid' and party='$toid' and mynote='$mynoteid' and a_content='$content'";
					$result = mysql_query($sql,$connect);
					$r = mysql_fetch_array($result);
					
					$sql = "insert into notice(id, party, ar_num, title) values(NULL, '$toid', '$r[0]', '$title')";
					mysql_query($sql,$connect);
					
					$sql = "select name from member where id='$mynoteid'";
					$result = mysql_query($sql,$connect);
					$mename = mysql_fetch_array($result);
					
					$sql = "select id from article where mem='$mynoteid' and party='$toid' and a_content='$content' order by time desc";
					$result = mysql_query($sql,$connect);
					$article = mysql_fetch_array($result);
					
					$sql = "select pname from party where id='$toid'";
					$result = mysql_query($sql,$connect);
					$pname = mysql_fetch_array($result);
						
					$sql = "select member_id from partyjoin where party_id='$toid'";
					$result = mysql_query($sql,$connect);
					$rows = mysql_num_rows($result);	
					
					$count = 0;
					if($rows){
						echo "[";
						for($i=0;$i<$rows;$i++){
							mysql_data_seek($result,$i);
							
							$row = mysql_fetch_array($result);
							$sql2 = "select mobile from member where id='$row[0]'";
							$result2 = mysql_query($sql2,$connect);
							$device = mysql_fetch_array($result2);
							
							if($device[0] || $device[0]!=""){			
									if($count>0) echo ", ";
									echo "{ ID : ".json_encode($device[0]).", ";
									echo "Name: ".json_encode($mename[0]).", ";
									echo "FROM_ID: ".json_encode($article[0]).", ";
									echo "Info: ".json_encode($gcm_content).", ";
									echo "From: ".json_encode($pname[0]);	//mynote
									echo "}\r\n";											
									$count++;
							}//if
							
						}//for
						echo "]";
					}//if
				}
				else{
					$image_location = "../upload/Article/".$mynoteid."_PARTY_".$fnmae;
					$rimage_location = "upload/Article/".$mynoteid."_PARTY_".$fnmae;
					if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $image_location)) {	//이미지 업로드 성공
						$width = getWidth($image_location);
						$height = getHeight($image_location);
						$scale = 1;
						$uploaded = resizeImage($image_location,$width,$height,$scale);
						
						$sql = "insert into article(id,mem, party, mynote, time, a_content, pic, notice, a_open) values (NULL,'$mynoteid', '$toid', '$mynoteid', CURRENT_TIMESTAMP, '$content', '$rimage_location', '1', '$aopen')";
						mysql_query($sql, $connect) or die(mysql_error());
						
						$sql = "select id from article where mem='$mynoteid' and party='$toid' and mynote='$mynoteid' and a_content='$content'";
						$result = mysql_query($sql,$connect);
						$r = mysql_fetch_array($result);
						
						$sql = "insert into notice(id, party, ar_num, title) values(NULL, '$toid', '$r[0]', '$title')";
						mysql_query($sql,$connect);
					} else {
						//이미지 업로드 실패
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
						$sql2 = "select*from message where from_mem='$mynoteid' and to_mem = '$row[0]' and article_id='$aaa[0]' and mtype='0'";
						$result2 = mysql_query($sql2,$connect);
						$alarmnum = mysql_num_rows($result2);
						if($alarmnum){
							$sql = "delete from message where from_mem='$mynoteid' and to_mem='$row[0]' and article_id='$aaa[0]' and mtype='0'";
							mysql_query($sql,$connect);
						}
						else{
							$sql = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$mynoteid', '$row[0]', '$aaa[0]', CURRENT_TIMESTAMP, '0', '0')";
							mysql_query($sql,$connect);
						}
					}				
					
				}//for
			}
			/*$sql = "select distinct m.name, m.mobile, p.pname, j.member_id from member m, party p, partyjoin j where j.party_id=$toid and m.id=j.member_id and p.id=$toid";	
			$result = mysql_query($sql,$connect);
			$row = mysql_num_rows($result);
			if($row){
				echo "[";
				for($i=0;$i<$row;$i++){
					mysql_data_seek($result,$i);
					
					$device = mysql_fetch_array($result);
					if($device[1] || $device[1]!=""){						
							echo "{ \"ID\":\"$device[1]\", ";
							echo "\"Name\": \"$device[0]\", ";
							echo "\"FROM_ID\": \"$toid\", ";
							echo "\"Info\": \"$gcm_content\", ";
							echo "\"From\": \"$device[2]\"";	//Party
							echo "}\r\n";						
					}//if
				}//for
				echo "]";
			}//if*/
		}
	}
	//echo "]\r\n}";
}

//***************************************************************************** OOPT=3 Write Comment API ***************************************************************// 댓글쓰기

else if($oopt==3){		
	$toid = $_POST['toid'];
	$mynoteid = $_POST['mynoteid'];
	$content = $_POST['content'];
	$content = htmlspecialchars($content);
	$content = addslashes($content);
	$content = str_replace("\n"," ",$content);	
	
	if($toid && $mynoteid){
		$sql = "insert into reply(id,r_mem, r_article, r_content, time) values (NULL,'$mynoteid', '$toid', '$content',CURRENT_TIMESTAMP)";
		mysql_query($sql, $connect);
		
		$sql = "select a.party, a.mynote from article a where a.id=$toid";
		$result = mysql_query($sql, $connect);
		$row = mysql_fetch_array($result);
		$pid = $row[0];
		if($pid){
			$sql = "select pname from party where id='$pid'";
			$result = mysql_query($sql,$connect);
			$pname = mysql_fetch_array($result);
			
			$afrom = "$pname[0]";
		}
		else{
			$sql = "select name from member where id='$row[1]'";
			$result = mysql_query($sql,$connect);
			$mname = mysql_fetch_array($result);
			
			$afrom = "$mname[0]님의 노트";
		}
		
		/*echo "comment: [";
			$sql = "select distinct m.id, m.name, m.profilepic, r.id, r.time from member m, reply r where r.r_article=$toid and m.id=r_mem";
			$result = mysql_query($sql,$connect);;
			$row = mysql_fetch_array($result);
			echo "{\r\n";
			echo "mid : ".json_encode($row[0]).", ";
			echo "mname: ".json_encode($row[1]).", ";
			echo "mpic: ".json_encode($row[2]).", ";
			echo "rid: ".json_encode($row[3]).", ";
			echo "text: ".json_encode($content).", ";
			echo "time: ".json_encode($row[4])."";
			echo "}\r\n";			
		echo "], ";
		echo "gcm: [";*/
		echo "[\r\n";		
		
		$sql = "select name from member where id='$mynoteid'";
		$result = mysql_query($sql,$connect);
		$mn = mysql_fetch_array($result);
		
		$sql = "select distinct m.name, m.mobile, a.party, a.mynote from member m, article a where a.id=$toid and m.id=a.mem";
		$result = mysql_query($sql,$connect);
		$author = mysql_fetch_array($result);
			echo "{ ID:".json_encode($author[1]).", ";
			echo "Name: ".json_encode($mn[0]).", ";
			
			if($author[2]){//party
				echo "FROM_ID: ".json_encode($author[2]).", ";
			}
			else{//note
				echo "FROM_ID: ".json_encode($author[3]).", ";
			}
			
			echo "Info: ".json_encode($content).", ";
			echo "From: ".json_encode($afrom)."";
			echo "}\r\n";		
		
		
		$sql = "select distinct m.mobile from member m, reply r where r.r_article=$toid and m.id=r.r_mem";
		$result = mysql_query($sql, $connect);
		$total_record = mysql_num_rows($result);
		if($total_record){
			echo ",";
			for($i=0;$i<$total_record;$i++){
				mysql_data_seek($result,$i);
				$gid = mysql_fetch_array($result);
				
				if($i>0) echo ",";
				echo "{ ID:".json_encode($gid[0]).", ";
				echo "Name: ".json_encode($mn[0]).", ";
				
				/*if($author[2]){//party
					echo "FROM_ID: ".json_encode($author[2]).", ";
				}
				else{//note
					echo "FROM_ID: ".json_encode($author[3]).", ";
				}*/
				echo "FROM_ID: ".json_encode($toid).", ";
				
				echo "Info: ".json_encode($content).", ";
				echo "From: ".json_encode($afrom)."";
				echo "}\r\n";	
				}
		}
		else{
			//nothing comment
		}
		echo "]";
		$sql = "select a.mem from article a where a.id='$toid'";
		$result = mysql_query($sql,$connect);
		$row = mysql_fetch_array($result);
		
		if($mynoteid != $row[0]){		
			
			$sql2 = "select*from message where from_mem='$mynoteid' and to_mem='$row[0]' and article_id='$toid' and mtype='1'";
			$result2 = mysql_query($sql2,$connect);
			$r2 = mysql_num_rows($result2);
			if($r2){
				$sql2 = "delete from message where from_mem='$mynoteid' and to_mem='$row[0]' and article_id='$toid' and mtype='1'";
				mysql_query($sql2,$connect);
				$sql2 = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$mynoteid', '$row[0]', '$toid', CURRENT_TIMESTAMP, '0', '1')";
				mysql_query($sql2,$connect);				
			}
			else{
				$sql = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$mynoteid', '$row[0]', '$toid', CURRENT_TIMESTAMP, '0', '1')";
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
				
				if($mynoteid != $oo[0]){
					$sql2 = "select*from message where from_mem='$mynoteid' and to_mem='$oo[0]' and article_id='$toid' and mtype='1'";
					$result2 = mysql_query($sql2,$connect);
					$r2 = mysql_num_rows($result2);
					if($r2){
						$sql2 = "delete from message where from_mem='$mynoteid' and to_mem='$oo[0]' and article_id='$toid' and mtype='1'";
						mysql_query($sql2,$connect);
						$sql2 = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$mynoteid', '$oo[0]', '$toid', CURRENT_TIMESTAMP, '0', '1')";
						mysql_query($sql2,$connect);
					}
					else{
						$sql2 = "insert into message(id, from_mem, to_mem, article_id, time, mread, mtype) values(NULL, '$mynoteid', '$oo[0]', '$toid', CURRENT_TIMESTAMP, '0', '1')";
						mysql_query($sql2,$connect);
					}
				}
				
			}
		}
												
	}
}

//***************************************************************************** OOPT=4 Friend Vote API *****************************************************************// 인기투표

else if($oopt==4){		//인기투표
	$sql = "select NOW();";
	$result = mysql_query($sql,$connect);
	$current_now = mysql_fetch_array($result);
	$current_day = explode(" ",$current_now[0]);
	$devi_day = explode("-",$current_day[0]);
	
	$mynoteid = $_POST['mynoteid'];
	$userid = $_POST['userid'];
	$sql = "select time from friend_vote where from_mem='$mynoteid' and to_mem='$userid' order by time desc";
	$result = mysql_query($sql,$connect);
	$a = mysql_num_rows($result);
	if($a){
		mysql_data_seek($result,0);	
		$dbtime = mysql_fetch_array($result);
		$db_time = explode("-",$dbtime[0]);
		
	}
			
	if($db_time[0] < $devi_day[0]){
		$sql = "insert into friend_vote(id, from_mem, to_mem, time) values(NULL, '$mynoteid', '$userid', '$current_day[0]')";
		mysql_query($sql,$connect);
	}
	else if($db_time[0] == $devi_day[0]){
		if($db_time[1] < $devi_day[1]){
			$sql = "insert into friend_vote(id, from_mem, to_mem, time) values(NULL, '$mynoteid', '$userid', '$current_day[0]')";
			mysql_query($sql,$connect);
		}
		else if($db_time[1] == $devi_day[1]){
			if($db_time[2] < $devi_day[2]){
				$sql = "insert into friend_vote(id, from_mem, to_mem, time) values(NULL, '$mynoteid', '$userid', '$current_day[0]')";
				mysql_query($sql,$connect);
			}
			else{
				break;
			}
		}
		else{
			break;
		}
	}
	else{
		break;
	}
}

//***************************************************************************** OOPT=5 Count Visit API *****************************************************************// 접속수 체크

else if($oopt==5){	//접속 카운트
	$position = $_POST['position'];
	$toid = $_POST['toid'];	
	$mynoteid = $_POST['mynoteid'];
	
	if($position==1){	//노트 방문
		$sql = "select*from visit where from_mem='$mynoteid' and to_mem='$toid'";	
		$result = mysql_query($sql,$connect);
		$sub = mysql_num_rows($result);
		
		if($sub){
			$counting = mysql_fetch_array($result);
			$upcount = $counting[3] + 1;
			$sql = "update visit set count='$upcount' where from_mem='$mynoteid' and to_mem='$toid'";
			mysql_query($sql,$connect);
		}
		else{
			$sql = "insert into visit(id, from_mem, to_mem, count, to_party) values(NULL, '$mynoteid', '$toid', '1', '0')";
			mysql_query($sql,$connect);
		}
	}
	else if($position==2){	//파티 방문
		$sql = "select visit_count from partyjoin where party_id='$toid' and member_id='$mynoteid'";
		$result = mysql_query($sql, $connect);
		$numberOfres = mysql_num_rows($result);
		if($numberOfres) // 가입한 파티라면! 방문횟수 +1
		{
			$row = mysql_fetch_array($result);			
			$row[0]++;
			$sql = "update partyjoin set visit_count='$row[0]' where party_id='$toid' and member_id='$mynoteid'";
			mysql_query($sql, $connect);
			$sql = "update partyjoin set visit_time=NOW() where party_id='$toid' and member_id='$mynoteid'";
			mysql_query($sql, $connect);
		}
		else{
			$sql = "select*from visit where from_mem='$mynoteid' and to_party='$toid'";
			$result = mysql_query($sql,$connect);
			$sub = mysql_num_rows($result);
			
			if($sub){
				$counting = mysql_fetch_array($result);
				$upcount = $counting[3]+1;
				$sql = "update visit set count='$upcount' where from_mem='$mynoteid' and to_party='$toid'";
				mysql_query($sql,$connect);
			}
			else{
				$sql = "insert into visit(id, from_mem, to_mem, count, to_party) values(NULL, '$mynoteid', '0', '1', '$toid')";
				mysql_query($sql, $connect);
			}
		}		
	}
}

//***************************************************************************** OOPT=6 Make Party API ******************************************************************// 파티 만들기

else if($oopt==6){	//파티 생성
	$num = $_POST['num'];
	$array = $_POST['array'];
	$newname = $_POST['newname'];
	$mynoteid = $_POST['mynoteid'];

	$newname = htmlspecialchars($newname);
	$newname = addslashes($newname); 
	$newname = str_replace("\n","&nbsp;",$newname);	
	
	$sql = "select*from party where pname='$newname'";		
	$result = mysql_query($sql,$connect);
	$ex = mysql_num_rows($result);
		echo "[{";
	if($ex){
		echo "pid: 0";
	}
	else{
		$sql = "insert into party(pname, admin, id, time, widey) values('$newname','$mynoteid', NULL, NOW(), '0')";
		mysql_query($sql, $connect);
		
		$sql = "select*from party where pname='$newname'";
		$result = mysql_query($sql, $connect);
		$row = mysql_fetch_array($result);
		
		$sql = "insert into partyjoin(member_id, party_id, visit_count, id, join_time, visit_time, notice) values ('$mynoteid','$row[2]', 1, NULL, NOW(), NOW(), '1')";
		mysql_query($sql, $connect);		
				
		echo "pid: \"$row[2]\"";
		
		$friends = explode(',',$array);
		$pname = $row[0];
		if($num){
			for($i=0;$i<$num;$i++){
				$sql = "select*from partyjoin where member_id='$friends[$i]' and party_id='$row[2]'";
				$result = mysql_query($sql,$connect);
				$row1 = mysql_fetch_array($result);
				
				if($row1){
				}
				else{
					$sql = "select*from party_invite where from_mem='$mynoteid' and to_mem='$friends[$i]'";
					$result = mysql_query($sql,$connect);
					$exa = mysql_num_rows($result);
					if($exa){
					}
					else{
						$sql = "insert into party_invite(id, from_mem, to_mem, time, invp_id, invp_name) values(NULL, '$mynoteid', '$friends[$i]', CURRENT_TIMESTAMP, '$row[2]', '$pname')";
						$result = mysql_query($sql,$connect);
					}
				}
			}
		}
		
	}
	echo "}]";
}

//***************************************************************************** OOPT=7 Invite Party API ****************************************************************// 파티 초대하기

else if($oopt==7){	//파티 초대
	$num = $_POST['num'];
	$array = $_POST['array'];
	$pid = $_POST['pid'];
	$mynoteid = $_POST['mynoteid'];
	
	$friends = explode(',',$array);
	
	$sql = "select pname from party where id='$pid'";
	$result = mysql_query($sql,$connect);
	$row = mysql_fetch_array($result);
	$pname = $row[0];
	
	for($i=0;$i<$num;$i++){
		$sql = "select*from partyjoin where member_id='$friends[$i]' and party_id='$pid'";
		$result = mysql_query($sql,$connect);
		$row = mysql_fetch_array($result);
		
		if($row){
		}
		else{
			$sql = "select*from party_invite where from_mem='$mynoteid' and to_mem='$friends[$i]'";
			$result = mysql_query($sql,$connect);
			$exa = mysql_num_rows($result);
			if($exa){
			}
			else{
				$sql = "insert into party_invite(id, from_mem, to_mem, time, invp_id, invp_name) values(NULL, '$mynoteid', '$friends[$i]', CURRENT_TIMESTAMP, '$pid', '$pname')";
				$result = mysql_query($sql,$connect);
			}
		}
	}
}

//***************************************************************************** OOPT=8 Like Query API ******************************************************************// 좋아요

else if($oopt==8){	//좋아요
	$aid = $_POST['aid'];
	$mynoteid = $_POST['mynoteid'];
	
	$sql = "select point from article_like where mem='$mynoteid' and article='$aid'";
	$result = mysql_query($sql,$connect);
	$lk_exa = mysql_num_rows($result);
	if(!$lk_exa){	
		$sql = "insert into article_like(id, mem, article, point, time) values (NULL,'$mynoteid', '$aid', '1', NOW())";
		mysql_query($sql, $connect);		
	}
	else{
		$sql = "delete from article_like where mem='$mynoteid' and article='$aid'";
		mysql_query($sql,$connect);
	}

}

//***************************************************************************** OOPT=9 Scrap API ***********************************************************************// 스크랩

else if($oopt==9){ //스크랩
	$origin_article = $_POST['origin_article'];
	$mynoteid = $_POST['mynoteid'];
	$toid = $_POST['toid'];
	$content = $_POST['content'];
	$position = $_POST['position'];
	
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
	
		if($position==1){
			$pic_copy = 'upload/Article/'.$id.'_SCRAP_N_'.$fnmae;
		}
		else if($position==2){
			$pic_copy = 'upload/Article/'.$id.'_SCRAP_P_'.$fnmae;//확장자 없이 파일이름까지만 사용한다.
		}
		
		if (!is_file($row[7])) {				
		  // echo "Result: \"3\""; // 파일이 아니라 처리할 수 없어
		}
		 
		$size = @getimagesize($row[7]);
		if (empty($size[2])) {	
		   //echo "Result: \"4\""; // 이미지 파일이 아니야
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
		
			$im = @imagecreatefromjpeg($row[7]);
		
			if ($im === false) {
				//echo "Result: \"7\"";	
			   //이미지 리소스 가져오기 실패
			}
			
			$result_save = @imagejpeg($im, $pic_copy);
		
			break;
		
		  case 3 : //png
		
			$im = @imagecreatefrompng($row[7]);
		
			if ($im === false) {
		
			 // echo "Result: \"8\"";
			  //이미지 리소스 가져오기 실패
			}
			
			$result_save = @imagepng($im, $pic_copy);
		
			break;
		}
		
		@imagedestroy($im);
		
		if ($result_save === false) {
		
		   //echo "Result: \"9\"";
		   //이미지 복사 실패
		}
		
		/*if (is_file($pic_copy)) echo "Result: \"2\""; //이미지 복사 성공
		else echo "Result: \"10\""; // 이미지 복사 실패				
		*/
	}
	if($position==1){ // mynote 글!
		$sql = "insert into article(id, mem, party, mynote, time, a_content, caption, pic, scrapper, notice, origin) values (NULL,'$mynoteid', '0', '$toid', CURRENT_TIMESTAMP, '$row[5]', '$content', '$pic_copy', '$originman', '$row[9]', '$origin_a')";	
		mysql_query($sql, $connect) or die(mysql_error());
		break;
	}
	else if($position==2){ // party 글!
		$sql = "insert into article(id,mem, party, mynote, time, a_content, caption, pic, scrapper, notice, origin) values (NULL,'$mynoteid', '$toid', '0', CURRENT_TIMESTAMP, '$row[5]', '$content', '$pic_copy', '$originman', '$row[9]', '$origin_a')";  
		mysql_query($sql, $connect) or ide(mysql_error());;
		break;
	}	
}

//***************************************************************************** OOPT=10 StarSumer API ******************************************************************// 파티 스타슈머

else if($oopt==10){	//스타슈머
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
			if($mid_vote[$i]){
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
		}
		else{
			if($mid_vote[$i]){
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
	}
	echo "[{";
	if($man){
		echo "manok: ".json_encode(1).", ";
		echo "man: [";
		echo "{";
		$sql = "select name, profilepic from member where id='$man'";
		$result = mysql_query($sql,$connect);
		$maninfo = mysql_fetch_array($result);
		echo "manid: ".json_encode($man).", ";
		echo "manname: ".json_encode($maninfo[0]).", ";
		echo "manpic: ".json_encode($maninfo[1]).", ";
		echo "manvote: ".json_encode($manvote)."";		
		echo "}";
		echo "], ";
	}
	else{
		echo "manok: ".json_encode(0).", ";
	}
	
	if($woman){		
		echo "womanok: ".json_encode(1).", ";
		echo "woman: [";
		echo "{";
		$sql = "select name, profilepic from member where id='$woman'";
		$result = mysql_query($sql,$connect);
		$womaninfo = mysql_fetch_array($result);
		echo "womanid: ".json_encode($woman).", ";
		echo "womanname: ".json_encode($womaninfo[0]).", ";
		echo "womanpic: ".json_encode($womaninfo[1]).", ";
		echo "womanvote: ".json_encode($womanvote)."";
		echo "}";
		echo "]";
	}
	else{
		echo "womanok: ".json_encode(0)." ";
	}
	echo "}]";
}

//***************************************************************************** OOPT=11 Delete Article/Comment API *****************************************************// 글/댓글 삭제하기

else if($oopt==11){	//글,댓글 삭제
	$position = $_POST['position'];
	$toid = $_POST['toid'];
	
	if($position==1){ //글삭제		
		
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
		
	}
	else if($position==2){ //댓글 삭제
		$sql = "delete from reply where id='$toid'";
		mysql_query($sql, $connect);
	}
}

//***************************************************************************** OOPT=12 Join Party API *****************************************************************// 파티 가입하기

else if($oopt==12){	//파티 가입
	$mynoteid = $_POST['mynoteid'];
	$pid = $_POST['pid'];
	$position = $_POST['position'];
	
	if($position==1){
		$sql = "select*from partyjoin where member_id='$mynoteid' and party_id='$pid'";
		$result = mysql_query($sql, $connect);
		$num = mysql_num_rows($result);
		if(!$num)
		{	
			$sql = "select p_permission from party where id='$pid'";		
			$result = mysql_query($sql,$connect);
			$p = mysql_fetch_array($result);
			$permis = $p[0];
			
			if($permis==0){							
				$sql = "insert into partyjoin(member_id, party_id, visit_count, id, join_time, visit_time) values ('$mynoteid','$pid', 1, NULL, NOW(), NOW())";
				mysql_query($sql, $connect);
				$sql = "select*from visit where from_mem='$mynoteid' and to_party='$pid'";
				$result = mysql_query($sql,$connect);
				$exa = mysql_num_rows($result);
				if($exa){
					$sql = "delete from visit where from_mem='$mynoteid' and to_party='$pid'";
					mysql_query($sql,$connect);
				}				
			}
			else{
				$sql = "select*from party_join where mem='$mynoteid' and party='$pid'";
				$result = mysql_query($sql,$connect);
				$oo = mysql_num_rows($result);
				
				if(!$oo){
					$sql = "insert into party_join(id, mem, party, time) values (NULL, '$mynoteid', '$pid', NOW())";
					mysql_query($sql,$connect);
				}
			}
			
			$sql = "delete from party_invite where to_mem='$mynoteid' and invp_id='$pid'";
			mysql_query($sql,$connect);
			
		}	
	}
	else if($position==2){
		$sql = "delete from party_invite where to_mem='$mynoteid' and invp_id='$pid'";
		mysql_query($sql,$connect);
	}
}

//***************************************************************************** OOPT=13 Friend Query API ***************************************************************// 친구 관계

else if($oopt==13){	//친구 쿼리
	//친구등록
	$fid = $_POST['fid'];
	$fopt = $_POST['fopt'];
	$mynoteid = $_POST['mynoteid'];
	
	if($fopt==1){
		$sql = "select*from friendship where mem1='$mynoteid' and  mem2='$fid'";
		$result = mysql_query($sql,$connect);
		$exa = mysql_num_rows($result);
		if($exa){	//이미 친구이면
		//echo "0";
		}
		else{	//친구요청 받은 상태
		//echo "1";
			$sql1 = "select*from friend_req where from_mem='$fid' and to_mem='$mynoteid'";
			$result1 = mysql_query($sql1,$connect);
			$faccept = mysql_num_rows($result1);
			if($faccept){
				//echo "2";
				$sql2 = "insert into friendship(id, mem1, mem2, time) values(NULL, '$mynoteid', '$fid', NOW())";
				mysql_query($sql2,$connect);
				$sql2 = "insert into friendship(id, mem1, mem2, time) values(NULL, '$fid', '$mynoteid', NOW())";
				mysql_query($sql2,$connect);
				$sql2 = "delete from friend_req where from_mem='$fid' and to_mem='$mynoteid'";
				mysql_query($sql2,$connect);
			}			
			else{	//요청 보낸상태거나 처음보는상태
				$sql1 = "select*from friend_req where from_mem='$mynoteid' and to_mem='$fid'";
				$result1 = mysql_query($sql1,$connect);
				$faccep2 = mysql_num_rows($result1);
				if($faccep2){	//요청을 보낸상태
				
				}
				else{	//처음보는 상태				
					$sql2 = "insert into friend_req(id, from_mem, to_mem, time) values(NULL, '$mynoteid', '$fid', NOW())";
					mysql_query($sql2,$connect);
				}
			}
			
		}
	}
	else if($fopt==2){
		$sql = "delete from friend_req where from_mem='$fid' and to_mem='$mynoteid'";
		mysql_query($sql,$connect);
	}
}

//***************************************************************************** OOPT=14 Alarm New API ******************************************************************// 알람 읽어오기

else if($oopt==14){	//alarm new
	$mynoteid = $_POST['mynoteid'];
	
	$sql = "select distinct m2.name, m.from_mem, m2.profilepic, m.article_id, a.mynote, a.party, m.mread, m.mtype, m.time, m.id from member m2, message m, article a where m.to_mem=$mynoteid and m2.id=m.from_mem and a.id=m.article_id order by m.time desc";
	$result = mysql_query($sql,$connect);
	$row = mysql_num_rows($result);
	echo "[{";
	
	if($row){
		echo "Num: ".json_encode($row).", ";
		echo "alarm: [\r\n";
		for($i=0;$i<$row;$i++){
			mysql_data_seek($result,$i);
			
			$ar = mysql_fetch_array($result);
			
			if($ar[5]){
				$sql2 = "select pname, id from party where id='$ar[5]'";
				$result2 = mysql_query($sql2,$connect);
				$rr = mysql_fetch_array($result2);
				$fromid = $rr[1];
				$from = $rr[0];
			}else{
				$sql2 = "select name, id from member where id='$ar[4]'";
				$result2 = mysql_query($sql2,$connect);
				$rr = mysql_fetch_array($result2);
				$fromid = $rr[1];
				$from = $rr[0]."님의 노트";
			}
			
			if($i>0) echo ", ";
			echo "{\r\n";
			echo "mname: ".json_encode($ar[0]).", ";
			echo "mid: ".json_encode($ar[1]).", ";
			echo "mpic: ".json_encode($ar[2]).", ";
			echo "articleID: ".json_encode($ar[3]).", ";
			echo "from: ".json_encode($from).", ";
			echo "fromid: ".json_encode($fromid).", ";
			echo "read: ".json_encode($ar[6]).", ";
			echo "type: ".json_encode($ar[7]).", ";
			echo "time: ".json_encode($ar[8]).", ";
			echo "alarm_id: ".json_encode($ar[9])." ";
			echo "}\r\n";
		}
		echo "],\r\n";		
	}
	else{
		echo "Num: ".json_encode(0).", ";
	}
		
	$discount=0;
	$count=0;
	$sql = "select p.id, p.pname, p.pic from party p where p.admin='$mynoteid' order by p.id";
	$result = mysql_query($sql,$connect);
	$nums = mysql_num_rows($result);
	
	if($nums){
		for($i=0;$i<$nums;$i++){
			mysql_data_seek($result,$i);
			$p = mysql_fetch_array($result);
						
			$sql1 = "select*from party_join where party='$p[0]'";
			$result1 = mysql_query($sql1,$connect);
			$row1 = mysql_num_rows($result1);
							
			if($row1){
				for($j=0;$j<$row1;$j++){
					mysql_data_seek($result1,$j);
					$o = mysql_fetch_array($result1);
					if($o[4]==0){
					}
					else{
						$discount++;
					}							
				}
				if(($row1-$discount)>0){
					$pid[$count] = $p[0];
					$pname[$count] = $p[1];
					$pjoin[$count] = ($row1-$discount);
					$ppic[$count] = $p[2];
					$count++;			
				}
			}
		}
		echo "joinnum: ".json_encode($count).", joinwant: [";
		for($i=0;$i<$count;$i++){
			if($i>0) echo ", ";
			echo "{";
			echo "party_id: ".json_encode($pid[$i]).", ";
			echo "party_name: ".json_encode($pname[$i]).", ";
			echo "party_join: ".json_encode($pjoin[$i]).", ";
			echo "party_pic: ".json_encode($ppic[$i])." ";
			echo "}";
		}
		echo "], ";
	}
	else{
		echo "joinnum: ".json_encode(0).", ";
	}	
	
	$sql = "select*from party_join where mem='$mynoteid'";	
	$result = mysql_query($sql,$connect);
	$menum = mysql_num_rows($result);
	
	if($menum){
		$count = 0;
		for($i=0;$i<$menum;$i++){
			mysql_data_seek($result,$i);
			$m = mysql_fetch_array($result);
			
			if($m[4]!=0){
				$sql1 = "select id, pname, pic from party where id='$m[2]'";
				$result1 = mysql_query($sql1,$connect);
				$rr = mysql_fetch_array($result1);
								
				$p_id[$count] = $rr[0];
				$p_name[$count] = $rr[1];
				$p_pic[$count] = $rr[2];
				if($m[4]==1){
					$p_confirm[$count] = 1;
				}
				else if($m[4]==2){
					$p_confirm[$count] = 2;
				}
				$count++;
			}			
		}
		echo "menum: ".json_encode($count).", mejoin: [";
			for($i=0;$i<$count;$i++){
				
				if($i>0) echo ", ";
				
				if($m[4]==1){	//가입됨
					echo "{";
					echo "partyid: ".json_encode($p_id[$i]).", ";
					echo "partyname: ".json_encode($p_name[$i]).", ";
					echo "partypic: ".json_encode($p_pic[$i]).", ";
					echo "confirms: ".json_encode($p_confirm[$i])." ";
					echo "}";
				}
				else if($m[4]==2){	//거절됨
					echo "{";
					echo "partyid: ".json_encode($p_id[$i]).", ";
					echo "partyname: ".json_encode($p_name[$i]).", ";
					echo "partypic: ".json_encode($p_pic[$i]).", ";
					echo "confirms: ".json_encode($p_confirm[$i])." ";
					echo "}";
				}
			}
		echo "]";
	}
	else{
		echo "menum: ".json_encode(0).", mejoin: []";
	}
	
	echo "}]";
}

//***************************************************************************** OOPT=15 Alarm Read API *****************************************************************// 새로운 알람 읽기

else if($oopt==15){	//alarm read
	$anum = $_POST['anum'];
	$aid = $_POST['aid'];
	$mynoteid = $_POST['mynoteid'];
	
	$arid = explode(",",$aid);
	
	for($i=0;$i<$anum;$i++){
		$sql = "update message m set m.mread='1' where m.id='$arid[$i]'";	
		mysql_query($sql,$connect);	
	}
	
	$sql = "delete from party_join where mem='$mynoteid' and auth='1'";
	mysql_query($sql,$connect);
	
	$sql = "delete from party_join where mem='$mynoteid' and auth='2'";
	mysql_query($sql,$connect);
}

//***************************************************************************** OOPT=16 Alarm Article Load API *********************************************************// 알람글 읽어오기

else if($oopt==16){	//alarm Article Load
	$articleID = $_POST['articleID'];
	$mynoteid = $_POST['mynoteid'];
	
	$sql = "select id from article where id='$articleID'";
	$result = mysql_query($sql,$connect);
	$origin_ID = mysql_fetch_array($result);
	
	$sql = "select distinct a.a_content, a.time, a.party, a.mynote, m.name, m.id, m.profilepic, a.pic, a.scrapper, a.notice, a.caption from article a, member m, party p where a.id=$origin_ID[0] and m.id=a.mem order by a.time desc";
	$result = mysql_query($sql,$connect);
	$total_record = mysql_num_rows($result);
	
	if($total_record){
		echo "[{";
		echo "NumberOfArticle: ".json_encode($total_record).", ";		
		echo "article: [";
		
		$row = mysql_fetch_array($result);
		
		 $sql0 = "select*from member where id='$row[8]'";
		 $result0 = mysql_query($sql0,$connect);
		 $scrapping = mysql_fetch_array($result0);
		 
		// row 로 받아온 상태!
		$j = $i+1;
		$contents = toJS($row[0]);
		echo "{\r\n";
		echo "articleID: ".json_encode($origin_ID[0]).","; // 글번호 (삭제 예정)
		echo "author: ".json_encode($row[4]).","; //(글쓴이)
		echo "authorID: ".json_encode($row[5]).","; //(글쓴이)
		echo "authorProfile: ".json_encode($row[6]).","; //(글쓴이프로필사진)
		echo "content: ".json_encode($contents).","; // 글내용
		echo "time: ".json_encode($row[1]).","; // 날짜
		echo "apic: ".json_encode($row[7]).","; // 글 사진
		echo "scrapID: ".json_encode($scrapping[4]).",";
		echo "scrapName: ".json_encode($scrapping[0]).",";
		echo "scrapPic: ".json_encode($scrapping[11]).",";
		echo "notice: ".json_encode($row[9]).",";
		echo "caption: ".json_encode($row[10]).",";
		
		if($row[2]==0){
			echo "isparty: ".json_encode(0).",";
			$sqll = "select name from member where id='$row[3]'";
			$resultl = mysql_query($sqll,$connect);
			$ooo = mysql_fetch_array($resultl); 
			echo "belong: ".json_encode($ooo[0] + " 님의 노트").",";
			echo "belongID: ".json_encode($row[3]).",";
		}
		else{
			echo "isparty: ".json_encode(1).",";
			$sql1 = "select pname from party where id='$row[2]'";
			$result1 = mysql_query($sql1,$connect);
			$oo = mysql_fetch_array($result1);
			echo "belong: ".json_encode($oo[0]).",";
			echo "belongID: ".json_encode($row[2]).",";
		}
		
		$sql01 = "select id from article where origin='$origin_ID[0]'";
		$result01 = mysql_query($sql01, $connect);
		$exa = mysql_num_rows($result01);
		echo "ScrapNum: ".json_encode($exa).", ";
		
		/*$sql9 = "select admin from party where id='$partyid'";
		$result9 = mysql_query($sql9, $connect);
		$padmin = mysql_fetch_array($result9);
		echo "belongAdmin: \"$padmin[0]\", ";
		echo "notice: \"$row[9]\", ";*/
		
		/////////// 좋아요 싫어요 기능!!!
			$sql2 = "select a.point from article_like a where a.mem=$mynoteid and a.article=$origin_ID[0]";
			$result2 = mysql_query($sql2, $connect);
			$total_record2 = @mysql_num_rows($result2);
			if($total_record2==0) // 투표한적 없음. 링크 띄워줌
			{
				echo "vote: ".json_encode(0).",";				
			}
			else // 투표 했으면 안 띄워줌
			{
				echo "vote: ".json_encode(1).",";
			}
			
			// 이 글을 좋아하는 사람
			$sql2 = "select m.name, m.id, m.profilepic from member m, article_like a where a.article=$origin_ID[0] and a.point=1 and m.id=a.mem order by a.time desc";
			$result2 = mysql_query($sql2, $connect);
			$total_record2 = mysql_num_rows($result2);
			echo "likenum: ".json_encode($total_record2).",";
			/*echo "like: [";
			for($k=0;$k<$total_record2;$k++)
			{
				if($k>0)
					echo ",\r\n";
				mysql_data_seek($result2, $k);
				$row2 = mysql_fetch_array($result2);
				// row 로 받아온 상태!
				echo "{\r\n";
				echo "id : ".json_encode($row2[1]).",";
				echo "name: ".json_encode($row2[0]).",";
				echo "profile : ".json_encode($row2[2])."";				
				echo "}\r\n";
			}
			echo "],\r\n";*/
		
		
		//echo "댓글내용 : ".$row[r_content];
			$sql2 = "select m.name, m2.name, r.r_content, r.time, m2.id, r.id, m2.profilepic from member m, member m2, reply r, article a where a.mem=m.id and r.r_article=a.id and m2.id=r.r_mem and a.id=$origin_ID[0] order by r.time desc";
			$result2 = mysql_query($sql2, $connect);
			$total_record2 = mysql_num_rows($result2);
			echo "NumberOfComment: ".json_encode($total_record2).", ";
			echo "comment: [";
			for($k=0;$k<$total_record2;$k++)
			{
				if($k>0)
					echo ",\r\n";
				mysql_data_seek($result2, $k);
				$row2 = mysql_fetch_array($result2);
				// row 로 받아온 상태!
				echo "{\r\n";
				echo "rid: ".json_encode($row2[5]).",";
				echo "mid: ".json_encode($row2[4]).",";
				echo "name: ".json_encode($row2[1]).",";
				echo "text: ".json_encode($row2[2]).",";
				echo "profile: ".json_encode($row2[6]).","; // 프로필 사진
				echo "time: ".json_encode($row2[3])."";
				echo "}\r\n";
			}
			echo "]\r\n";
			//opt 3 : 댓글 , toid : 글id
			echo "}\r\n";		
			echo "]\r\n";
			
			
			echo "}]";
	}
}

//***************************************************************************** OOPT=17 Invite Party Message Read API **************************************************// 파티초대장 보기

else if($oopt==17){	//invite party message
	$mynoteid = $_POST['mynoteid'];
	$sql = "select * from party_invite where to_mem='$mynoteid' order by time desc";
	$result=mysql_query($sql, $connect);
	$invnum = mysql_num_rows($result);
	echo "[{";
	echo "NumberOfInv: ".json_encode($invnum).", ";
	echo "partyinv: [";
				
	if($invnum){
		for($i=0;$i<$invnum;$i++){
			mysql_data_seek($result,$i);
			$invpart=mysql_fetch_array($result);
			
			$sql2="select*from member where id='$invpart[1]'";
			$result2=mysql_query($sql2,$connect);
			$invmefriend=mysql_fetch_array($result2);
			
			if($i>0){
				echo ", \r\n";
			}
			
			echo "{\r\n";
			echo "invme_id: ".json_encode($invmefriend[4]).", ";
			echo "invme_name: ".json_encode($invmefriend[0]).", ";
			echo "invme_pic: ".json_encode($invmefriend[11]).", ";
			echo "invparty_id : ".json_encode($invpart[4]).", ";
			echo "invparty_name : ".json_encode($invpart[5]).", ";
			echo "invtime: ".json_encode($invpart[3])."";
			echo "}\r\n";
		}
	}		
	echo "]";	
	echo "}]";
}

//***************************************************************************** OOPT=18 Friend Request Message Read API ************************************************// 친구요청 보기

else if($oopt==18){	//friend req message
	$mynoteid = $_POST['mynoteid'];
	
	$sql = "select * from friend_req where to_mem='$mynoteid'";
	$result=mysql_query($sql, $connect);
	$reqme = mysql_num_rows($result);
	echo "[{";
	echo "NumberOfReq: ".json_encode($reqme).", ";
	echo "friendreq: [";
				
	if($reqme){
		for($i=0;$i<$reqme;$i++){
			mysql_data_seek($result,$i);
			$reqpart=mysql_fetch_array($result);
			
			$sql2="select*from member where id='$reqpart[1]'";
			$result2=mysql_query($sql2,$connect);
			$reqmefriend=mysql_fetch_array($result2);
			
			if($i>0){
				echo ", \r\n";
			}
			
			echo "{\r\n";
			echo "reqme_id: ".json_encode($reqmefriend[4]).", ";
			echo "reqme_name: ".json_encode($reqmefriend[0]).", ";
			echo "reqme_pic: ".json_encode($reqmefriend[11]).", ";
			echo "reqme_time: ".json_encode($reqpart[3])."";
			echo "}\r\n";
		}
	}		
	echo "]";	
	echo "}]";
}

//***************************************************************************** OOPT=19 Searching API ******************************************************************// 검색

else if($oopt==19){	//search
	$value = $_POST['value'];
	$mynoteid = $_POST['mynoteid'];
	
	if($mynoteid){
		echo "[{";
		if($value!=""){		
			$sql = "select*from member where name like '%$value%'";
			$result = mysql_query($sql,$connect);
			$pre = mysql_num_rows($result);					
			
			echo "Numbers: ".json_encode($pre).", ";
			echo "people: [";
			if($pre){			
				for($i=0;$i<$pre;$i++){
					mysql_data_seek($result,$i);
					$searchname = mysql_fetch_array($result);
					
					$sql1 = "select distinct p.id, j.party_id from partyjoin j, partyjoin p where j.member_id='$searchname[4]' and p.party_id=j.party_id and p.member_id='$mynoteid'";
					$result1 = mysql_query($sql1,$connect);
					$sharenum = mysql_num_rows($result1);
					
					$memberid[$i] = $searchname[4];
					$membername[$i] = $searchname[0];
					$memberpic[$i] = $searchname[11];
					$membercount[$i] = $sharenum;
					
					if($mynoteid == $searchname[4]){
						$fstat[$i] = 0;	//본인
					}
					else{					
						$sql2 = "select*from friendship where mem1='$mynoteid' and mem2='$searchname[4]'";
						$result2 = mysql_query($sql2,$connect);
						$exa = mysql_num_rows($result2);
						if($exa){	//친구
							$fstat[$i] = 1;
						}
						else{
							$sql3 = "select*from friend_req where from_mem='$mynoteid' and to_mem='$searchname[4]'";
							$result3 = mysql_query($sql3,$connect);
							$exa = mysql_num_rows($result3);
							if($exa){	//요청보냄
								$fstat[$i] = 2;
							}
							else{
								$sql4 = "select*from friend_req where to_mem='$mynoteid' and from_mem='$searchname[4]'";
								$result4 = mysql_query($sql4,$connect);
								$exa = mysql_num_rows($result4);
								if($exa){	//요청받음
									$fstat[$i] = 3;
								}
								else{	//無
									$fstat[$i] = 4;
								}
							}
						}
					}
					
				}
				for($i=0;$i<$pre-1;$i++){
					for($j=$i+1;$j<$pre;$j++){
						if($membercount[$i] < $membercount[$j]){
							$temp = $membercount[$i];
							$membercount[$i] = $membercount[$j];
							$membercount[$j] = $temp;
							
							$temp = $memberid[$i];
							$memberid[$i] = $memberid[$j];
							$memberid[$j] = $temp;
							
							$temp = $membername[$i];
							$membername[$i] = $membername[$j];
							$membername[$j] = $temp;
							
							$temp = $memberpic[$i];
							$memberpic[$i] = $memberpic[$j];
							$memberpic[$j] = $temp;
							
							$temp = $fstat[$i];
							$fstat[$i] = $fstat[$j];
							$fstat[$j] = $temp;
						}
					}
				}
				
				for($i=0;$i<$pre;$i++){
					if($i>0) echo ",\r\n";			
					echo "{\r\n";
					echo "name: ".json_encode($membername[$i]).", ";
					echo "id: ".json_encode($memberid[$i]).", ";
					echo "pic: ".json_encode($memberpic[$i]).", ";
					echo "pcount: ".json_encode($membercount[$i]).", ";
					echo "fstat: ".json_encode($fstat[$i])."";
					echo "}\r\n";
				}
				
				
				
			}	
			
			echo "],\r\n";
			
			//*********************************************************************************************************************************************************//
			
			$sql = "select*from party where pname like '%$value%'";
			$result = mysql_query($sql,$connect);
			$pn = mysql_num_rows($result);		
			
			$discounter = 0;
			if($pn){
				for($i=0;$i<$pn;$i++){
					mysql_data_seek($result,$i);
					$searchparty = mysql_fetch_array($result);
					
					$sql1 = "select distinct f.mem2, j.id from friendship f, partyjoin j where f.mem1='$mynoteid' and j.party_id='$searchparty[2]' and j.member_id=f.mem2";
					$result1 = mysql_query($sql1,$connect);
					$rnum = mysql_num_rows($result1);
					
					$sqll = "select*from partyjoin where member_id='$mynoteid' and party_id='$searchparty[2]'";
					$rst = mysql_query($sqll,$connect);
					$or = mysql_num_rows($rst);
					
					if($or==1 || $searchparty[9]==0){
						$partyid[$i] = $searchparty[2];
						$partyname[$i] = $searchparty[0];
						$partypic[$i] = $searchparty[7];
						$partyadmin[$i] = $searchparty[1];
						$partycount[$i] = $rnum;
					}
					else{
						$discounter++;
					}
				}
				for($i=0;$i<($pn-$discounter)-1;$i++){
					for($j=$i+1;$j<($pn-$discounter);$j++){
						if($partycount[$i] < $partycount[$j]){
							$temp = $partycount[$i];
							$partycount[$i] = $partycount[$j];
							$partycount[$j] = $temp;
							
							$temp = $partyid[$i];
							$partyid[$i] = $partyid[$j];
							$partyid[$j] = $temp;
							
							$temp = $partypic[$i];
							$partypic[$i] = $partypic[$j];
							$partypic[$j] = $temp;
							
							$temp = $partyname[$i];
							$partyname[$i] = $partyname[$j];
							$partyname[$j] = $temp;
							
							$temp = $partyadmin[$i];
							$partyadmin[$i] = $partyadmin[$j];
							$partyadmin[$j] = $temp;
						}
					}
				}
			}
			echo "Numberss: ".json_encode($pn-$discounter).", ";
			echo "parties: [";
			for($i=0;$i<($pn-$discounter);$i++){
				if($i>0) echo ",\r\n";			
				echo "{\r\n";
				echo "pname: ".json_encode($partyname[$i]).", ";
				echo "pid: ".json_encode($partyid[$i]).", ";
				echo "ppic: ".json_encode($partypic[$i]).", ";
				echo "padmin: ".json_encode($partyadmin[$i]).", ";
				echo "pcount: ".json_encode($partycount[$i])."";
				echo "}\r\n";
			}
			echo "]\r\n";
		}		
		echo "}]";
	}
}

//***************************************************************************** OOPT=20 Change Images(Profile/Wide) in Note API ****************************************// 노트 프로필/와이드 사진 변경

else if($oopt==20){	//사진 바꾸기 - Note
	$position = $_POST['position'];
	$mynoteid = $_POST['mynoteid'];
	
	$sql = "select NOW()";
	$result = mysql_query($sql,$connect);
	$nowar = mysql_fetch_array($result);
	$fnmae = substr($nowar[0],0,4).substr($nowar[0],5,2).substr($nowar[0],8,2).substr($nowar[0],11,2).substr($nowar[0],14,2).substr($nowar[0],17,2);		

	if($position == 1){	//profile
		$sql = "select profilepic from member where id='$mynoteid'";
		$result = mysql_query($sql,$connect);
		$row = mysql_fetch_array($result);
		
		if($row[0]!="images/base/male160.png" && $row[0]!= "images/base/female160.png"){
			chmod($save_dir , 0777);
			if (file_exists($row[0])) {
				unlink($row[0]);						
			}
			if (file_exists($row[0]."50")){
				unlink($row[0]."50");
			}
			if (file_exists($row[0]."38")){
				unlink($row[0]."38");
			}
			if (file_exists($row[0]."90")){
				unlink($row[0]."90");
			}
			if (file_exists($row[0]."_o")){
				unlink($row[0]."_o");
			}
		}
		
		$image_location = "../upload/profilepic/".$mynoteid."_profilepic_".$fnmae;
		$rimage_location = "upload/profilepic/".$mynoteid."_profilepic_".$fnmae;
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $image_location)) {	//이미지 업로드 성공
			$width = getWidth($image_location);
			$height = getHeight($image_location);
			$oriwidth = $width;
			$oriheight = $height;
			$scale = 1;
			$uploaded = resizeImage_Profile($image_location,$width,$height,$scale,160);
												
			for($i=0;$i<4;$i++){
				if($i==0){ $a=50; }else if($i==1){ $a=38; }else if($i==2){ $a=90; }else if($i==3){ $a=$oriwidth; }
					if($i!=3){
						$pic_copy = $image_location."$a";//확장자 없이 파일이름까지만 사용한다.
					}
					else{
						$pic_copy = $image_location."_o";//확장자 없이 파일이름까지만 사용한다.
					}

				if (!is_file($image_location)) {				
				   //echo "Result: \"3\""; // 파일이 아니라 처리할 수 없어
				}
				 
				$size = @getimagesize($image_location);
				if (empty($size[2])) {	
				   //echo "Result: \"4\""; // 이미지 파일이 아니야
				}
				
				if ($size[2] != 1 && $size[2] != 2 && $size[2] != 3) {			
				  // echo "Result: \"5\""; // 지원하지 않는 이미지타입이야 gif/jpg/png만 가능
				}
				
				$extension = image_type_to_extension($size[2]);
				$path_copyfile .= $extension;
				
				switch($size[2]){
				
				  case 1 : //gif
				
					$im = @imagecreatefromgif($image_location);
				
					if ($im === false) {
						//echo "Result: \"6\"";
						//이미지 리소스 가져오기 실패
					}
					
					$result_save = @imagegif($im, $pic_copy);
					$width = getWidth($pic_copy);
					$height = getHeight($pic_copy);
					$scale = 1;
					$uploaded = resizeImage_Profile($pic_copy,$width,$height,$scale,$a);
					break;
				
				  case 2 : //jpg
				
					$im = @imagecreatefromjpeg($image_location);
				
					if ($im === false) {
						//echo "Result: \"7\"";	
					   //이미지 리소스 가져오기 실패
					}
					
					$result_save = @imagejpeg($im, $pic_copy);
					$width = getWidth($pic_copy);
					$height = getHeight($pic_copy);
					$scale = 1;
					$uploaded = resizeImage_Profile($pic_copy,$width,$height,$scale,$a);
					break;
				
				  case 3 : //png
				
					$im = @imagecreatefrompng($image_location);
				
					if ($im === false) {
				
					  //echo "Result: \"8\"";
					  //이미지 리소스 가져오기 실패
					}
					
					$result_save = @imagepng($im, $pic_copy);
					$width = getWidth($pic_copy);
					$height = getHeight($pic_copy);
					$scale = 1;
					$uploaded = resizeImage_Profile($pic_copy,$width,$height,$scale,$a);
				
					break;
				}
				
				@imagedestroy($im);
				
				if ($result_save === false) {
				
				   //echo "Result: \"9\"";
				   //이미지 복사 실패
				}							
		
			}//for			
			
			$sql = "update member set profilepic='$rimage_location' where id='$mynoteid'";
			mysql_query($sql, $connect);
			echo "[{ Result: ".json_encode($rimage_location)." }]";
		} else {
			//이미지 업로드 실패
		}		
	}
	else if($position == 2){ //widepic
		$sql = "select widethumbpic from member where id='$mynoteid'";
		$result = mysql_query($sql,$connect);
		$row = mysql_fetch_array($result);
		
		if($row[0]!="index_background.jpg"){
			chmod($save_dir , 0777);
			if (file_exists($row[0])) {
				unlink($row[0]);
			}
			if (file_exists($row[0]."_o")) {
				unlink($row[0]."_o");
			}	
			if (file_exists($row[0]."_mobile")) {
				unlink($row[0]."_mobile");
			}				
		}
	
		$image_location = "../upload/widepic/".$mynoteid."_thumbpic_".$fnmae;
		$rimage_location = "upload/widepic/".$mynoteid."_thumbpic_".$fnmae;
		
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $image_location)) {	//이미지 업로드 성공
			$width = getWidth($image_location);
			$height = getHeight($image_location);
			$oriwidth = $width;
			$oriheight = $height;
			$scale = 1;
			$uploaded = resizeImage_Wide($image_location,$width,$height,$scale,920);
			
			for($i=0;$i<2;$i++){
						if($i==0){ $a=$oriwidth; }else if($i==1){ $a=600; }
										if($i!=1){
											$pic_copy = $image_location."_o";//확장자 없이 파일이름까지만 사용한다.
										}
										else{
											$pic_copy = $image_location."_mobile";//확장자 없이 파일이름까지만 사용한다.
										}
				
										if (!is_file($image_location)) {				
										  // echo "Result: \"3\""; // 파일이 아니라 처리할 수 없어
										}
										 
										$size = @getimagesize($image_location);
										if (empty($size[2])) {	
										  // echo "Result: \"4\""; // 이미지 파일이 아니야
										}
										
										if ($size[2] != 1 && $size[2] != 2 && $size[2] != 3) {			
										   //echo "Result: \"5\""; // 지원하지 않는 이미지타입이야 gif/jpg/png만 가능
										}
										
										$extension = image_type_to_extension($size[2]);
										$path_copyfile .= $extension;
										
										switch($size[2]){
										
										  case 1 : //gif
										
											$im = @imagecreatefromgif($image_location);
										
											if ($im === false) {
												//echo "Result: \"6\"";
												//이미지 리소스 가져오기 실패
											}
											
											$result_save = @imagegif($im, $pic_copy);
											$width = getWidth($pic_copy);
											$height = getHeight($pic_copy);
											$scale = 1;
											$uploaded = resizeImage_Wide($pic_copy,$width,$height,$scale,$a);
											break;
										
										  case 2 : //jpg
										
											$im = @imagecreatefromjpeg($image_location);
										
											if ($im === false) {
												//echo "Result: \"7\"";	
											   //이미지 리소스 가져오기 실패
											}
											
											$result_save = @imagejpeg($im, $pic_copy);
											$width = getWidth($pic_copy);
											$height = getHeight($pic_copy);
											$scale = 1;
											$uploaded = resizeImage_Wide($pic_copy,$width,$height,$scale,$a);
											break;
										
										  case 3 : //png
										
											$im = @imagecreatefrompng($image_location);
										
											if ($im === false) {
										
											  //echo "Result: \"8\"";
											  //이미지 리소스 가져오기 실패
											}
											
											$result_save = @imagepng($im, $pic_copy);
											$width = getWidth($pic_copy);
											$height = getHeight($pic_copy);
											$scale = 1;
											$uploaded = resizeImage_Wide($pic_copy,$width,$height,$scale,$a);
										
											break;
										}
										
										@imagedestroy($im);
										
										if ($result_save === false) {
										
										  // echo "Result: \"9\"";
										   //이미지 복사 실패
										}
										
									
										}//for
			
			$sql = "update member set widethumbpic='$rimage_location' where id='$mynoteid'";
			mysql_query($sql, $connect);
			echo "[{ Result: ".json_encode($rimage_location)." }]";
		} else {
			//이미지 업로드 실패
		}		
	}
	
}

//***************************************************************************** OOPT=21 Setting Myadmin API ************************************************************// 계정관리

else if($oopt==21){	//계정관리
	$position = $_POST['position'];
	$mynoteid = $_POST['mynoteid'];
	
	if($position==1){	//read
		$sql = "select name, ename, birth, gender, university, phone, facebook from member where id='$mynoteid'";
		$result = mysql_query($sql,$connect);
		$re = mysql_fetch_array($result);
		echo "[{";
		echo "Result_name: ".json_encode($re[0]).", ";
		echo "Result_ename: ".json_encode($re[1]).", ";
		echo "Result_birth: ".json_encode($re[2]).", ";
		echo "Result_gender: ".json_encode($re[3]).", ";
		echo "Result_univ: ".json_encode($re[4]).", ";
		echo "Result_phone: ".json_encode($re[5]).", ";
		if($re[6]){
			echo "Result_facebook: ".json_encode(1)." ";	
		}
		else{
			echo "Result_facebook: ".json_encode(0)." ";
		}		
		echo "}]";
	}
	else if($position==2){	//write
		$name = $_POST['name'];
		$ename = $_POST['ename'];
		$birth = $_POST['birth'];
		$gender = $_POST['gender'];
		$univ = $_POST['univ'];
		$phone = $_POST['phone'];

		$sql = "update member set name='$name' where id='$mynoteid'";
		$result = mysql_query($sql,$connect);
		$sql = "update member set ename='$ename' where id='$mynoteid'";
		$result = mysql_query($sql,$connect);
		$sql = "update member set birth='$birth' where id='$mynoteid'";
		$result = mysql_query($sql,$connect);
		$sql = "update member set phone='$phone' where id='$mynoteid'";
		$result = mysql_query($sql,$connect);
		$sql = "select profilepic from member where id='$mynoteid'";
		$result = mysql_query($sql,$connect);
		$a = mysql_fetch_array($result);
		if($a[0]=="images/base/male160.png" || $a[0]=="images/base/female160.png"){
			if($gender==1){
				$sql = "update member set profilepic='images/base/male160.png' where id='$mynoteid'";
				mysql_query($sql,$connect);
			}
			else{
				$sql = "update member set profilepic='images/base/female160.png' where id='$mynoteid'";
				mysql_query($sql,$connect);
			}
		}
		$sql = "update member set gender='$gender' where id='$mynoteid'";
		$result = mysql_query($sql,$connect);
		$sql = "update member set university='$univ' where id='$mynoteid'";
		$result = mysql_query($sql,$connect);		
	}
	else if($position==3){	//password change
		$p1 = $_POST['p1'];
		$p2 = $_POST['p2'];
		
		$sql = "select*from member where id='$mynoteid'";
		$result = mysql_query($sql,$connect);
		$me = mysql_fetch_array($result);
		
		$sql1 = "select PASSWORD('$p1')";
		$result1 = mysql_query($sql1,$connect);
		$row = mysql_fetch_array($result1);
		
		if($row[0] == $me[3]){
			$sql2 = "update member set password=PASSWORD('$p2') where id='$mynoteid'";
			mysql_query($sql2,$connect);
			
			echo "[{ ok: ".json_encode(1)." }]";
		}
		else{
			echo "[{ ok: ".json_encode(0)." }]";
		}
	}
}

//***************************************************************************** OOPT=22 Setting whether public API *****************************************************// 파티 공개설정 여부 변경하기

else if($oopt==22){
	$pid = $_POST['pid'];
	$permis = $_POST['permis'];
	$publik = $_POST['publik'];
	
	if($permis==1) $publik=1;
	
	$sql = "update party set p_public='$publik' where id='$pid'";
	mysql_query($sql,$connect);
	
	$sql = "update party set p_permission='$permis' where id='$pid'";
	mysql_query($sql,$connect);
}

//***************************************************************************** OOPT=23 API Setting Notice permission **************************************************//  파티 공지글쓰기 권한 부여하기

else if($oopt==23){
	$pid = $_POST['pid'];
	$mynoteid = $_POST['mynoteid'];
	$position = $_POST['position'];
	
	if($position==1){	//member load
		$sql = "select admin from party where id='$pid'";
		$result = mysql_query($sql,$connect);
		$admin = mysql_fetch_array($result);
		
		$sql = "select id, name, profilepic from member where id='$admin[0]'";
		$result = mysql_query($sql,$connect);
		$ad_p = mysql_fetch_array($result);
		
		$sql = "select member_id, notice from partyjoin where party_id='$pid'";
		$result = mysql_query($sql,$connect);
		$user_pnum = mysql_num_rows($result);
		
		if($user_pnum){
			echo "[{";
			echo "MemberNum: ".json_encode($user_pnum).", Admin: ".json_encode($admin[0]).", Member: [\r\n";
			
			echo "{\r\n";
			echo "Fid: ".json_encode($ad_p[0]).", ";
			echo "Fname: ".json_encode($ad_p[1]).", ";
			echo "Fpic: ".json_encode($ad_p[2]).", ";
			echo "Fnotice: ".json_encode(1)." ";
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
					echo "Fid: ".json_encode($upi[0]).", ";
					echo "Fname: ".json_encode($re_data[0]).", ";
					echo "Fpic: ".json_encode($re_data[1]).", ";
					echo "Fnotice: ".json_encode($upi[1])." ";
					echo "}\r\n";
				}
			}
			echo "]\r\n";
			echo "}]";
		}		
	}
	else if($position==2){	//change notice auth		
		$fid = $_POST['fid'];
		$auth = $_POST['position'];
		
		if($auth==1){
			$sql = "update partyjoin set notice='1' where party_id='$pid' and member_id='$fid'";
			mysql_query($sql,$connect);
		}
		else{
			$sql = "update partyjoin set notice='0' where party_id='$pid' and member_id='$fid'";
			mysql_query($sql,$connect);
		}
	}	
}

//***************************************************************************** OOPT=24 API Party Join Auth ************************************************************//  파티 가입승인 하기

else if($oopt==24){
	$position = $_POST['position'];
	$pid = $_POST['pid'];
	$mynoteid = $_POST['mynoteid'];
	
	$sql = "select admin from party where id='$pid'";
	$result = mysql_query($sql,$connect);
	$ok = mysql_fetch_array($result);
	
	if($ok[0] == $mynoteid){
	
		if($position==1){	//보여주기
			$sql = "select distinct m.id, m.name, m.profilepic from member m, party_join j where j.party='$pid' and m.id=j.mem and j.auth='0'";
			$result = mysql_query($sql,$connect);
			$num = mysql_num_rows($result);
			echo "[{";
			if($num){
				echo "num: ".json_encode($num).", member: [";
				for($i=0;$i<$num;$i++){
					mysql_data_seek($result,$i);
					$row = mysql_fetch_array($result);
					
					if($i>0) echo ",";
					echo "{";
					echo "mid: ".json_encode($row[0]).", ";
					echo "mname: ".json_encode($row[1]),", ";
					echo "mpic: ".json_encode($row[2])." ";
					echo "}";
				}
				echo "]\r\n";		
			}
			else{
				echo "num: ".json_encode(0)." ";
			}
			echo "}]";
		}
		else if($position==2){	//수락하기
			$mid = $_POST['mid'];
			
			$sql = "select*from partyjoin where member_id='$mid' and party_id='$pid'";
			$result = mysql_query($sql, $connect);
			$num = mysql_num_rows($result);
			if(!$num)
			{
				$sql = "insert into partyjoin(member_id, party_id, visit_count, id, join_time, visit_time) values ('$mid','$pid', 1, NULL, NOW(), NOW())";
				mysql_query($sql, $connect);	
				$sql = "update party_join set auth='1' where mem='$mid' and party='$pid'";		
				mysql_query($sql,$connect);
			}
		}
		else if($position==3){	//거절하기
			$mid = $_POST['mid'];
			
			$sql = "update party_join set auth='2' where mem='$mid' and party='$pid'";		
			mysql_query($sql,$connect);
		}
	
	}
}

//***************************************************************************** OOPT=25 Change Images(Wide) in Party API ***********************************************//  파티 커버사진 수정하기

else if($oopt==25){
	$mynoteid = $_POST['mynoteid'];
	$partyid = $_POST['partyid'];
	
	$sql = "select admin from party where id='$partyid'";
	$result = mysql_query($sql,$connect);
	$ok = mysql_fetch_array($result);
	
	if($ok[0] == $mynoteid){
	
		$sql = "select NOW()";
		$result = mysql_query($sql,$connect);
		$nowar = mysql_fetch_array($result);
		$fnmae = substr($nowar[0],0,4).substr($nowar[0],5,2).substr($nowar[0],8,2).substr($nowar[0],11,2).substr($nowar[0],14,2).substr($nowar[0],17,2);		
		
		$image_location = "../upload/party/".$partyid."_partypic_".$fnmae;
		$rimage_location = "upload/party/".$partyid."_partypic_".$fnmae;
		
		$sql = "select pic from party where id='$partyid'";
		$result = mysql_query($sql,$connect);
		$row = mysql_fetch_array($result);
		
		if($row[0]!="index_background.jpg" && $row[0]!='images/event/base.png'){
			chmod($save_dir , 0777);
			if (file_exists($row[0])) {
				unlink($row[0]);						
			}
			if (file_exists($row[0]."_s")){
				unlink($row[0]."_s");
			}
			if (file_exists($row[0]."_m")){
				unlink($row[0]."_m");
			}
			if (file_exists($row[0]."_o")){
				unlink($row[0]."_o");
			}
			if (file_exists($row[0]."_mobile")){
				unlink($row[0]."_mobile");
			}
		}
		if (move_uploaded_file ($_FILES['uploadedfile']['tmp_name'], $image_location)) {
			$sql = "update party set pic='$rimage_location' where id='$partyid'";
			mysql_query($sql,$connect);					
			
			$width = getWidth($image_location);
			$height = getHeight($image_location);
			$scale = 1;
			$uploaded = resizeImage_Party($image_location,$width,$height,$scale,828,252);
										
			for($i=0;$i<4;$i++){
				if($i==0){ $a=129; $b=86; $c="_s"; }else if($i==1){ $a=284; $b=190; $c="_m"; }else if($i==2){ $a=$oriwidth; $b=$oriheight; $c='_o'; }else if($i==3){ $a=600; $b=400; $c='_mobile'; }
					$pic_copy = $image_location."$c";//확장자 없이 파일이름까지만 사용한다.
	
					if (!is_file($image_location)) {				
					   //echo "Result: \"3\""; // 파일이 아니라 처리할 수 없어
					}
					 
					$size = @getimagesize($image_location);
					if (empty($size[2])) {	
					   //echo "Result: \"4\""; // 이미지 파일이 아니야
					}
					
					if ($size[2] != 1 && $size[2] != 2 && $size[2] != 3) {			
					   //echo "Result: \"5\""; // 지원하지 않는 이미지타입이야 gif/jpg/png만 가능
					}
					
					$extension = image_type_to_extension($size[2]);
					$path_copyfile .= $extension;
					
					switch($size[2]){
					
					  case 1 : //gif
					
						$im = @imagecreatefromgif($image_location);
					
						if ($im === false) {
							//echo "Result: \"6\"";
							//이미지 리소스 가져오기 실패
						}
						
						$result_save = @imagegif($im, $pic_copy);
						$width = getWidth($pic_copy);
						$height = getHeight($pic_copy);
						$scale = 1;
						$uploaded = resizeImage_Party($pic_copy,$width,$height,$scale,$a,$b);
						break;
					
					  case 2 : //jpg
					
						$im = @imagecreatefromjpeg($image_location);
					
						if ($im === false) {
							//echo "Result: \"7\"";	
						   //이미지 리소스 가져오기 실패
						}
						
						$result_save = @imagejpeg($im, $pic_copy);
						$width = getWidth($pic_copy);
						$height = getHeight($pic_copy);
						$scale = 1;
						$uploaded = resizeImage_Party($pic_copy,$width,$height,$scale,$a,$b);
						break;
					
					  case 3 : //png
					
						$im = @imagecreatefrompng($image_location);
					
						if ($im === false) {
					
						  //echo "Result: \"8\"";
						  //이미지 리소스 가져오기 실패
						}
						
						$result_save = @imagepng($im, $pic_copy);
						$width = getWidth($pic_copy);
						$height = getHeight($pic_copy);
						$scale = 1;
						$uploaded = resizeImage_Party($pic_copy,$width,$height,$scale,$a,$b);
					
						break;
					}
					
					@imagedestroy($im);
					
					if ($result_save === false) {
					
					  // echo "Result: \"9\"";
					   //이미지 복사 실패
					}
				}//for
				echo "[{ Result: ".json_encode($rimage_location)." }]";
		} //if , move_uploaded_file
			
	}
}

//***************************************************************************** OOPT=26 Event Party API ****************************************************************//  이벤트파티 띄우기

else if($oopt==26){	
	$mynoteid = $_POST['mynoteid'];
	$userid = $_POST['userid'];
	
	$sqll = "select university from member where id='$mynoteid'";
	$resultl = mysql_query($sqll,$connect);
	$sch = mysql_fetch_array($resultl);
	
	$sqll = "select*from event where target='$sch[0]' and present='1'";
	$resultl = mysql_query($sqll,$connect);
	$rows = mysql_num_rows($resultl);
	if($rows){
		$row = mysql_fetch_array($resultl);
		$eventnumber = $row[1];	
	
		$sql = "select*from event where event_num='$eventnumber' order by id";
		$result = mysql_query($sql,$connect);
		$rows = mysql_num_rows($result);
		$numbers = $rows;
		$indexing = ($rows/3);
	
		if($rows){			
			for($i=0;$i<$rows;$i++){
				mysql_data_seek($result,$i);
				$row = mysql_fetch_array($result);
				$time = $row[6];
				
				if($i<($rows/3)){
					$first_grade[$i] = $row[4];
					$first_vote[$i] = 0;
					$top1_id[$i] = 0;
					$top1_name[$i] = "";
					$top1_pic[$i] = "";
				}
				else if((($rows/3)-1)<$i && $i<(($rows/3)*2)){
					$second_grade[$i%($rows/3)] = $row[4];
					$second_vote[$i%($rows/3)] = 0;
					$top2_id[$i] = 0;
					$top2_name[$i] = "";
					$top2_pic[$i] = "";
				}
				else if(((($rows/3)*2)-1)<$i && $i<$rows){
					$third_grade[$i%($rows/3)] = $row[4];
					$third_vote[$i%($rows/3)] = 0;
					$top3_id[$i] = 0;
					$top3_name[$i] = "";
					$top3_pic[$i] = "";
				}			
			}
		}
		else{
			//데이터전송 실패?
			//이벤트 종료?
		}//if-rows
	}//if-rows
	$interval = -1;
	$t = strtotime($time);     
	$interval = $t - time();
	
	if($eventnumber!=0 && $interval > 0){
		echo "[{";
		echo "Alert: ".json_encode(0).", ";
		echo "school: ".json_encode("").", ";
		echo "Event: ".json_encode(1).", ";
		$sql = "select*from member where id='$mynoteid' and university='휘경여자고등학교' or university='해성여자고등학교' or university='성신여자고등학교'";
		$result = mysql_query($sql,$connect);
		$asdf = mysql_num_rows($result);
		
		if($asdf){
			$sql = "select university from member where id='$mynoteid'";
			$result = mysql_query($sql,$connect);
			$un = mysql_fetch_array($result);
			
			$sql = "select event_num from event where target='$un[0]'";
			$result = mysql_query($sql,$connect);
			$asdff = mysql_fetch_array($result);
			
			echo "ev2: ".json_encode($asdff[0]).", ";
		}
		else{
			echo "ev2: ".json_encode(0).", ";
		}
		for($i=0;$i<$rows;$i++){
			if($i<($rows/3)){
				$sql = "select pname, pic from party where id='$first_grade[$i]'";
				$result = mysql_query($sql,$connect);
				$fetch = mysql_fetch_array($result);
				
				$first_pname[$i] = $fetch[0];
				$first_pic[$i] = $fetch[1];
			}
			else if((($rows/3)-1)<$i && $i<(($rows/3)*2)){
				$ind = $i%($rows/3);
				$sql = "select pname, pic from party where id='$second_grade[$ind]'";
				$result = mysql_query($sql,$connect);
				$fetch = mysql_fetch_array($result);
				
				$second_pname[$i%($rows/3)] = $fetch[0];
				$second_pic[$i%($rows/3)] = $fetch[1];
			}
			else if(((($rows/3)*2)-1)<$i && $i<$rows){
				$ind = $i%($rows/3);
				$sql = "select pname, pic from party where id='$third_grade[$ind]'";
				$result = mysql_query($sql,$connect);
				$fetch = mysql_fetch_array($result);
				
				$third_pname[$i%($rows/3)] = $fetch[0];
				$third_pic[$i%($rows/3)] = $fetch[1];
			}		
		}
		$top_vote1 = 0; $top_vote_ind1 = 0; $top_vote2 = 0; $top_vote_ind2 = 0; $top_vote3 = 0; $top_vote_ind3 = 0;
		for($i=0;$i<$indexing;$i++){
			$sql = "select member_id from partyjoin where party_id='$first_grade[$i]'";
			$result = mysql_query($sql,$connect);
			$first = mysql_num_rows($result);
					
			for($j=0;$j<$first;$j++){
				mysql_data_seek($result,$j);
				$firstids = mysql_fetch_array($result);
				
				if($firstids[0]!=1){
					$sqll = "select*from friend_vote where to_mem='$firstids[0]'";
					$resultl = mysql_query($sqll,$connect);
					$rowl = mysql_num_rows($resultl);
					
					if($top_vote1 < $rowl){
						$top_vote1 = $rowl; $top_vote_ind1 = $firstids[0];
					}else{}
					
					$first_vote[$i] += $rowl;						
				}
			}
			if($top_vote1 != 0){			
				$ssql = "select name, id, profilepic from member where id='$top_vote_ind1'";
				$sresult = mysql_query($ssql,$connect);
				$sre = mysql_fetch_array($sresult);
				$top1_id[$i] = $sre[1];
				$top1_name[$i] = $sre[0];
				$top1_pic[$i] = $sre[2];
			}
			else{
				$top1_id[$i] = 0;
				$top1_name[$i] = "";
				$top1_pic[$i] = "";
			}
			$top_vote1 = 0;
			$top_vote_ind1 = 0;
			
			$sql2 = "select member_id from partyjoin where party_id='$second_grade[$i]'";
			$result2 = mysql_query($sql2,$connect);
			$second = mysql_num_rows($result2);
			
			for($k=0;$k<$second;$k++){
				mysql_data_seek($result2,$k);
				$secondids = mysql_fetch_array($result2);
				
				if($secondids[0]!=1){				
					$sqll = "select*from friend_vote where to_mem='$secondids[0]'";
					$resultl = mysql_query($sqll,$connect);
					$rowl = mysql_num_rows($resultl);
	
					if($top_vote2 < $rowl){
						$top_vote2 = $rowl; $top_vote_ind2 = $secondids[0];
					}else{}
					
					$second_vote[$i] += $rowl;
				}
			}
	
			if($top_vote2 != 0){			
				$sqls = "select name, id, profilepic from member where id='$top_vote_ind2'";
				$results = mysql_query($sqls,$connect);
				$sre = mysql_fetch_array($results);
				$top2_id[$i] = $sre[1];
				$top2_name[$i] = $sre[0];
				$top2_pic[$i] = $sre[2];
			}
			else{
				$top2_id[$i] = 0;
				$top2_name[$i] = "";
				$top2_pic[$i] = "";
			}
			$top_vote2 = 0;
			$top_vote_ind2 = 0;
			
			$sql3 = "select member_id from partyjoin where party_id='$third_grade[$i]'";
			$result3 = mysql_query($sql3,$connect);
			$third = mysql_num_rows($result3);
					
			for($l=0;$l<$third;$l++){
				mysql_data_seek($result3,$l);
				$thirdids = mysql_fetch_array($result3);
				
				if($thirdids[0]!=1){
					$sqll = "select*from friend_vote where to_mem='$thirdids[0]'";
					$resultl = mysql_query($sqll,$connect);
					$rowl = mysql_num_rows($resultl);
					if($l==0){ $top_vote3 = $rowl; $top_vote_ind3 = $thirdids[0]; }
					else{
						if($top_vote3 < $rowl){
							$top_vote3 = $rowl; $top_vote_ind3 = $thirdids[0];
						}else{}
					}
					$third_vote[$i] += $rowl;
				}
			}
			if($top_vote3 != 0){
				$sqll = "select name, id, profilepic from member where id='$top_vote_ind3'";
				$resultl = mysql_query($sqll,$connect);
				$sre = mysql_fetch_array($resultl);
				$top3_id[$i] = $sre[1];
				$top3_name[$i] = $sre[0];
				$top3_pic[$i] = $sre[2];
			}
			else{
				$top3_id[$i] = 0;
				$top3_name[$i] = "";
				$top3_pic[$i] = "";
			}
			$top_vote3 = 0;
			$top_vote_ind3 = 0;
		}
		echo "event_number: ".json_encode($eventnumber).", ";
		echo "interval: ".json_encode($interval).", ";
		echo "nums: ".json_encode($indexing).", ";
		echo "first: [";
		for($i=0;$i<$indexing;$i++){
			if($i>0) echo ",";
			echo "{";
			echo "first_party_id: ".json_encode($first_grade[$i]).", ";
			echo "first_party_name: ".json_encode($first_pname[$i]).", ";
			echo "first_party_pic: ".json_encode($first_pic[$i]).", ";
			echo "first_party_vote: ".json_encode($first_vote[$i]).", ";
			echo "first_top_id: ".json_encode($top1_id[$i]).", ";
			echo "first_top_name: ".json_encode($top1_name[$i]).", ";
			echo "first_top_pic: ".json_encode($top1_pic[$i])." ";				
			echo "}";
		}
		echo "], ";
		echo "second: [";
		for($i=0;$i<$indexing;$i++){
			if($i>0) echo ",";
			echo "{";
			echo "second_party_id: ".json_encode($second_grade[$i]).", ";
			echo "second_party_name: ".json_encode($second_pname[$i]).", ";
			echo "second_party_pic: ".json_encode($second_pic[$i]).", ";
			echo "second_party_vote: ".json_encode($second_vote[$i]).", ";
			echo "second_top_id: ".json_encode($top2_id[$i]).", ";
			echo "second_top_name: ".json_encode($top2_name[$i]).", ";
			echo "second_top_pic: ".json_encode($top2_pic[$i])." ";				
			echo "}";
		}
		echo "], ";
		echo "third: [";
		for($i=0;$i<$indexing;$i++){
			if($i>0) echo ",";
			echo "{";
			echo "third_party_id: ".json_encode($third_grade[$i]).", ";
			echo "third_party_name: ".json_encode($third_pname[$i]).", ";
			echo "third_party_pic: ".json_encode($third_pic[$i]).", ";
			echo "third_party_vote: ".json_encode($third_vote[$i]).", ";
			echo "third_top_id: ".json_encode($top3_id[$i]).", ";
			echo "third_top_name: ".json_encode($top3_name[$i]).", ";
			echo "third_top_pic: ".json_encode($top3_pic[$i])." ";				
			echo "}";
		}
		echo "]";
	}
	else{		
		$sql = "select university from member where id='$mynoteid' and university like '%해성여고%'";
		$result = mysql_query($sql,$connect);
		$ok = mysql_num_rows($result);
		echo "[{";
		
		
		$sql = "select university from member where id='$mynoteid' and university like '%성신여고%'";
		$result = mysql_query($sql,$connect);
		$ok = mysql_num_rows($result);
		if($ok){
			echo "Alert: ".json_encode(1).", ";
			echo "school: ".json_encode("성신여자고등학교").", ";
		}
		else{
			echo "Alert: ".json_encode(0).", ";
			echo "school: ".json_encode("").", ";
		}
			
		
		echo "Event: ".json_encode(0).", ";
		
		if($eventnumber==3){
			$time = '2013-06-21 00:00:00';
		}
		else{
			$time = '2013-06-14 00:00:00';
		}
		$t = strtotime($time);     
		$interval = $t - time();
		
		
		if($time=='2013-06-21 00:00:00'){
			$sql = "select*from member where id='$mynoteid' and university='성신여자고등학교'";
		}
		else{
			$sql = "select*from member where id='$mynoteid' and university='휘경여자고등학교' or university='해성여자고등학교'";
		}
		
		$result = mysql_query($sql,$connect);
		$asdf = mysql_num_rows($result);
		
		if($asdf && $interval > 0){
			$sql = "select university from member where id='$mynoteid'";
			$result = mysql_query($sql,$connect);
			$un = mysql_fetch_array($result);
			
			$sql = "select event_num from event where target='$un[0]'";
			$result = mysql_query($sql,$connect);
			$asdff = mysql_fetch_array($result);
			
			echo "ev2: ".json_encode($asdff[0]).", ";
		}
		else{
			echo "ev2: ".json_encode(0).", ";
		}		
		if($userid == $mynoteid) echo "Mypage: ".json_encode(1).", ";
		else echo "Mypage: ".json_encode(0).", ";
	
		// user의 파티목록
		$sql = "select party_id from partyjoin where member_id='$userid' order by visit_count desc";
		$result = mysql_query($sql,$connect);
		$p_exa = mysql_num_rows($result);
		
		$pcount = 0;
		if($p_exa){
			for($i=0;$i<$p_exa;$i++){
				mysql_data_seek($result,$i);
				$getpinfo = mysql_fetch_array($result);
				$sql2 = "select p.pname, p.id, p.pic, p.p_public from party p where p.id='$getpinfo[0]'";
				$result2 = mysql_query($sql2,$connect);
				$pinfo = mysql_fetch_array($result2);
				
				$sql1 = "select*from partyjoin where member_id='$mynoteid' and party_id='$getpinfo[0]'";
				$rst = mysql_query($sql1,$connect);
				$or = mysql_num_rows($rst);
				
				if($pinfo[3]!=1 || $or!=0){				
					$ppartyname[$pcount] = $pinfo[0];
					$ppartyid[$pcount] = $pinfo[1];
					$ppartypic[$pcount] = $pinfo[2];
					$pcount++;
				}
			}
			
		}
		
		echo "user_party_num: ".json_encode($pcount).", user_party: [";
		for($i=0;$i<$pcount;$i++){
			if($i>0) echo ",";
			echo "{";
			echo "pid: ".json_encode($ppartyid[$i]).", ";
			echo "pname: ".json_encode($ppartyname[$i]).", ";
			echo "ppic: ".json_encode($ppartypic[$i])." ";
			echo "}";
		}
		echo "], ";
		
		if($userid == $mynoteid){							
			$sql = "select pname, id, pic, p_public from party";
			$result = mysql_query($sql,$connect);
			$rows = mysql_num_rows($result);
			
			$count = 0;
			
			if($rows){
				for($i=0;$i<$rows;$i++){
					mysql_data_seek($result,$i);
					$pinfo = mysql_fetch_array($result);
					
					$ssql = "select*from partyjoin where party_id='$pinfo[1]' and member_id='$mynoteid'";
					$results = mysql_query($ssql,$connect);
					$numrows = mysql_num_rows($results);
					
					if($pinfo[3]!=1 || $numrows!=0){
		
						$sql1 = "select visit_count from partyjoin where party_id='$pinfo[1]'";
						$result1 = mysql_query($sql1,$connect);
						$count_rows = mysql_num_rows($result1);
						if($count_rows){
							for($j=0;$j<$count_rows;$j++){
								mysql_data_seek($result1,$j);
								$counts = mysql_fetch_array($result1);
								$party_visit_count[$count] += $counts[0];
							}//for-j
						}//if-count_rows
						
						$sql2 = "select time from party where id='$pinfo[1]'";
						$result2 = mysql_query($sql2,$connect);
						$timevalue = mysql_fetch_array($result2);
						$party_times[$count] = strtotime($timevalue[0]);
		
						$con_party_id[$count] = $pinfo[1];
						$con_party_name[$count] = $pinfo[0];
						$con_party_pic[$count] = $pinfo[2];
						
						$frequency[$count] = ($party_visit_count[$count] / $party_times[$count])*100;
						$count++;
					}
					else{
						
					}
				}//for
			}//if-rows
			
			for($i=0;$i<($count-1);$i++){
				for($j=$i;$j<$count;$j++){
					if($frequency[$i] < $frequency[$j]){
						$temp = $con_party_id[$j];
						$frequency[$j] = $frequency[$i];
						$frequency[$i] = $temp;
						
						$temp = $con_party_id[$j];
						$con_party_id[$j] = $con_party_id[$i];
						$con_party_id[$i] = $temp;
						
						$temp = $con_party_name[$j];
						$con_party_name[$j] = $con_party_name[$i];
						$con_party_name[$i] = $temp;
						
						$temp = $con_party_pic[$j];
						$con_party_pic[$j] = $con_party_pic[$i];
						$con_party_pic[$i] = $temp;
					}
				}
			}
			
			echo "con_party_num: ".json_encode($count).", con_party: [";
			for($i=0;$i<$count;$i++){
				if($i>0) echo ",";
				echo "{";
				echo "pid: ".json_encode($con_party_id[$i]).", ";
				echo "pname: ".json_encode($con_party_name[$i]).", ";
				echo "ppic: ".json_encode($con_party_pic[$i])." ";
				echo "}";
			}
			
		}
		else{
			echo "con_party_num: ".json_encode(0)." ";
		}
		
		echo "]";
		//contents party
	}
	echo "}]";	
}

//***************************************************************************** OOPT=27 Event Party join API ****************************************************************//  이벤트파티에 해당하는지 여부 물어보고 이벤트 참여시키기

else if($oopt==27){
	$mynoteid = $_POST['mynoteid'];
	$school = $_POST['school'];
	$sql = "update member set university='$school' where id='$mynoteid'";
	mysql_query($sql,$connect);
	
	$sql = "select id from party where pname='$school'";
	$result = mysql_query($sql,$connect);
	$row = mysql_num_rows($result);
	
	if($row){
		$rows = mysql_fetch_array($result);
		
		$sql = "select*from partyjoin where member_id='$mynoteid' and party_id='$rows[0]'";
		$result = mysql_query($sql,$connect);
		$ok = mysql_num_rows($result);
		if(!$ok){
			$sql = "insert into partyjoin(member_id, party_id, visit_count, bookmark, id, join_time, visit_time, notice) values('$mynoteid', '$rows[0]', '1', '0', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '0')";
			mysql_query($sql,$connect);
		}
	}
	else{
		
	}
}

//***************************************************************************** OOPT=28 Party out API ****************************************************************//  파티 탈퇴하기

else if($oopt==28){
	$mynoteid = $_POST['mynoteid'];
	$pid = $_POST['pid'];
	
	$sql = "select*from party where admin='$mynoteid' and id='$pid'";
	$result = mysql_query($sql,$connect);
	$row = mysql_num_rows($result);
	
	if($row){
		echo "[{ admin: ".json_encode(1)." }]";
	}
	else{	
		$sql = "delete from partyjoin where member_id='$mynoteid' and party_id='$pid'";
		mysql_query($sql, $connect);	
		echo "[{ admin: ".json_encode(0)." }]";
	}
}

//***************************************************************************** OOPT=29 PartiSsier election API ****************************************************************//  파티쉐 넘기기

else if($oopt==29){
	$mynoteid = $_POST['mynoteid'];
	$fid = $_POST['fid'];
	$pid = $_POST['pid'];
	if($mynoteid){
		$sql = "update party set admin='$fid' where id='$pid'";
		mysql_query($sql,$connect);
		$sql = "delete from partyjoin where member_id='$mynoteid' and party_id='$pid'";
		mysql_query($sql, $connect);	
	}
}

//***************************************************************************** OOPT=30    Face Election??  API ****************************************************************//  얼짱선정?

else if($oopt==30){
	$mynoteid = $_POST['mynoteid'];
	$evnum = $_POST['evnum'];
	
	if($evnum==3){
		$time = '2013-06-21 00:00:00';
	}
	else{
		$time = '2013-06-14 00:00:00';
	}
	$t = strtotime($time);     
	$interval = $t - time();
	
	$sql = "select target from event where event_num='$evnum'";
	$result = mysql_query($sql,$connect);
	$oo = mysql_fetch_array($result);
	
	$sql = "select*from member where university='$oo[0]' and gender='2'";
	$result = mysql_query($sql,$connect);
	$rows = mysql_num_rows($result);
	$counts = 0;
	
	if($rows){
		for($i=0;$i<$rows;$i++){
			mysql_data_seek($result,$i);
			$row = mysql_fetch_array($result);
			
			$sqll = "select*from friend_vote where to_mem='$row[4]' and time > '2013-06-07'";
			$resultl = mysql_query($sqll,$connect);
			$vote = mysql_num_rows($resultl);
			$ii = $vote;
			
			if($row[4]!=1 && $ii!=0 && $row[4]!=3){
				
				$f_id[$counts] = $row[4];
				$f_name[$counts] = $row[0];
				$f_pic[$counts] = $row[11];
				
				$sqll = "select*from friend_vote where to_mem='$row[4]' and time > '2013-06-07'";
				$resultl = mysql_query($sqll,$connect);
				$vote = mysql_num_rows($resultl);
				$f_vote[$counts] = $vote;
				$counts++;
			}
		}
		
		for($i=0;$i<$counts-1;$i++){
			for($j=$i;$j<$counts;$j++){
				if($f_vote[$i] < $f_vote[$j]){
					$temp = $f_id[$i];
					$f_id[$i] = $f_id[$j];
					$f_id[$j] = $temp;
					
					$temp = $f_name[$i];
					$f_name[$i] = $f_name[$j];
					$f_name[$j] = $temp;
					
					$temp = $f_pic[$i];
					$f_pic[$i] = $f_pic[$j];
					$f_pic[$j] = $temp;
					
					$temp = $f_vote[$i];
					$f_vote[$i] = $f_vote[$j];
					$f_vote[$j] = $temp;
				}
			}
		}
		
		echo "[{";
		echo "interval: ".json_encode($interval),", ";	
		echo "Number: ".json_encode($counts).", ";	
		echo "ranking: [";
		for($i=0;$i<$counts;$i++){		
			if($i>0) echo ", ";
			echo "{";
			echo "fid: ".json_encode($f_id[$i]).", ";;
			echo "fname: ".json_encode($f_name[$i]).", ";
			echo "fpic: ".json_encode($f_pic[$i]).", ";
			echo "fvote: ".json_encode($f_vote[$i]).", ";
			$sql = "select NOW();";
			$result = mysql_query($sql,$connect);
			$current_now = mysql_fetch_array($result);
			$current_day = explode(" ",$current_now[0]);
			$devi_day = explode("-",$current_day[0]);
			
			
				$sql = "select time from friend_vote where from_mem='$mynoteid' and to_mem='$f_id[$i]' order by time desc";
				$result = mysql_query($sql,$connect);
				$a = mysql_num_rows($result);
				if($a){
					mysql_data_seek($result,0);	
					$dbtime = mysql_fetch_array($result);
					$db_time = explode("-",$dbtime[0]);
					
					if($dbtime[0]==$current_day[0]){
						echo "voted: ".json_encode(0)." ";
					}
					else{
						echo "voted: ".json_encode(1)." ";
					}			
				}
				else{
					echo "voted: ".json_encode(1)." ";
				}
			echo "}";
		}
		echo "]";	
		echo "}]";
	}
	else{
		echo "[{ Interval: ".json_encode($interval).", Number: ".json_encode(0)." }]";
	}
}

//***************************************************************************** OOPT=31    Face Battle??  API ******************************************************************//  얼짱대전?

else if($oopt==31){
	$mynoteid = $_POST['mynoteid'];
	$eventnumber = $_POST['eventnumber'];
	
	echo "[{";
	
	if($eventnumber==1 || $eventnumber==2){
		echo "battle: ".json_encode(1).", ";
		
		$count=0;
	
		$sql = "select*from event2 where target1='$eventnumber' or target2='$eventnumber'";
		$result = mysql_query($sql,$connect);
		$rows = mysql_num_rows($result);
		
		$sqll = "select NOW();";
		$resultl = mysql_query($sqll,$connect);
		$current_now = mysql_fetch_array($resultl);
		$current_day = explode(" ",$current_now[0]);
		$devi_day = explode("-",$current_day[0]);
		
		for($i=0;$i<$rows;$i++){
			mysql_data_seek($result,$i);
			$row = mysql_fetch_array($result);
			if($i==0) $time = $row[4];
			
			$sql2 = "select name, id, profilepic from member where id='$row[6]'";
			$result2 = mysql_query($sql2,$connect);
			$member = mysql_fetch_array($result2);
			
			$fid[$count] = $member[1];
			$fname[$count] = $member[0];
			$fpic[$count] = $member[2];
			$fposi[$count] = $row[7];
			$sqll = "select*from friend_vote where to_mem='$row[6]' and time > '2013-06-13'";
			$resultl = mysql_query($sqll,$connect);
			$vote = mysql_num_rows($resultl);
			$fvote[$count] = $vote;		
	
			$sqll = "select time from friend_vote where from_mem='$mynoteid' and to_mem='$row[6]' order by time desc";
			$resultl = mysql_query($sqll,$connect);
			$a = mysql_num_rows($resultl);
			if($a){			
				mysql_data_seek($resultl,0);	
				$dbtime = mysql_fetch_array($resultl);
				$db_time = explode("-",$dbtime[0]);
				
				if($dbtime[0]==$current_day[0]){
					$fvoted[$count] = 0;
				}
				else{
					$fvoted[$count] = 1;
				}				
			}//if
			else{			
				$fvoted[$count] = 1;			
			}
			$count++;
		}
		
		$t = strtotime($time);     
		$interval = $t - time();
		echo "interval: ".json_encode($interval).", battle_array: [";
		
		for($i=0;$i<5;$i++){
			for($j=$i;$j<6;$j++){
				if($fvote[$i] < $fvote[$j]){
					$temp = $fid[$i];
					$fid[$i] = $fid[$j];
					$fid[$j] = $temp;
					
					$temp = $fname[$i];
					$fname[$i] = $fname[$j];
					$fname[$j] = $temp;
					
					$temp = $fpic[$i];
					$fpic[$i] = $fpic[$j];
					$fpic[$j] = $temp;
					
					$temp = $fvote[$i];
					$fvote[$i] = $fvote[$j];
					$fvote[$j] = $temp;
					
					$temp = $fposi[$i];
					$fposi[$i] = $fposi[$j];
					$fposi[$j] = $temp;
					
					$temp = $fvoted[$i];
					$fvoted[$i] = $fvoted[$j];
					$fvoted[$j] = $temp;
				}
				else{
				}
			}
		}
		
		for($i=0;$i<6;$i++){
			if($i>0) echo ",";
			echo "{";
			echo "fid: ".json_encode($fid[$i]).", ";
			echo "fname: ".json_encode($fname[$i]).", ";
			echo "fpic: ".json_encode($fpic[$i]).", ";
			echo "fvote: ".json_encode($fvote[$i]).", ";
			echo "fvoted: ".json_encode($fvoted[$i]).", ";
			echo "fposi: ".json_encode($fposi[$i])." ";
			echo "}";
		}
		echo "]";
	}
	else{
		echo "battle: ".json_encode(0).", interval: ".json_encode(0).", battle_array: []";
	}
	
	echo "}]";
}

//**********************************************************************************************************************************************************************//
//**********************************************************************************************************************************************************************//
//**********************************************************************************************************************************************************************//
//**********************************************************************************************************************************************************************//
//**********************************************************************************************************************************************************************//
//************************************************************************			 OOPT 누락시 		****************************************************************//
else{
	//missing parameter oopt
}


//**********************************************************************************************************************************************************************//
//**********************************************************************************************************************************************************************//
//*************************************************************************** OPTGCM Article Image Upload GCM **********************************************************//
$optgcm = $_POST['optgcm'];

if($optgcm==1){	//mynote 사진
	$toid = $_POST['toid'];
	$content = $_POST['content'];
	$mynoteid = $_POST['mynoteid'];
	$gcm_content = htmlspecialchars($content);
	$gcm_content = addslashes($content); 
	$gcm_content = str_replace("\n","\r",$content);
	
	$sql = "select name from member where id='$mynoteid'";
	$result = mysql_query($sql,$connect);
	$mename = mysql_fetch_array($result);
	
	$sql = "select id from article where mem='$mynoteid' and mynote='$toid' and a_content='$content' order by time desc";
	$result = mysql_query($sql,$connect);
	$article = mysql_fetch_array($result);
	
	$sql = "select name, mobile from member where id='$toid'";	
	$result = mysql_query($sql,$connect);
	$device = mysql_fetch_array($result);
	if($device[1] || $device[1]!=""){
		echo "[";
			echo "{ ID : ".json_encode($device[1]).", ";
			echo "Name: ".json_encode($mename[0]).", ";
			echo "FROM_ID: ".json_encode($article[0]).", ";
			echo "Info: ".json_encode($gcm_content).", ";
			echo "From: ".json_encode($device[0]."님의 노트");	//mynote
			echo "}\r\n";
		echo "]";
	}
}
else if($optgcm==2){
	$toid = $_POST['toid'];
	$content = $_POST['content'];
	$mynoteid = $_POST['mynoteid'];
	$gcm_content = htmlspecialchars($content);
	$gcm_content = addslashes($content); 
	$gcm_content = str_replace("\n","\r",$content);
	
	$sql = "select name from member where id='$mynoteid'";
	$result = mysql_query($sql,$connect);
	$mename = mysql_fetch_array($result);
	
	$sql = "select id from article where mem='$mynoteid' and party='$toid' and a_content='$content' order by time desc";
	$result = mysql_query($sql,$connect);
	$article = mysql_fetch_array($result);
	
	$sql = "select pname from party where id='$toid'";
	$result = mysql_query($sql,$connect);
	$pname = mysql_fetch_array($result);
		
	$sql = "select member_id from partyjoin where party_id='$toid'";
	$result = mysql_query($sql,$connect);
	$rows = mysql_num_rows($result);	
	
	$count = 0;
	if($rows){
		echo "[";
		for($i=0;$i<$rows;$i++){
			mysql_data_seek($result,$i);
			
			$row = mysql_fetch_array($result);
			$sql2 = "select mobile from member where id='$row[0]'";
			$result2 = mysql_query($sql2,$connect);
			$device = mysql_fetch_array($result2);
			
			if($device[0] || $device[0]!=""){			
					if($count>0) echo ", ";
					echo "{ ID : ".json_encode($device[0]).", ";
					echo "Name: ".json_encode($mename[0]).", ";
					echo "FROM_ID: ".json_encode($article[0]).", ";
					echo "Info: ".json_encode($gcm_content).", ";
					echo "From: ".json_encode($pname[0]);	//mynote
					echo "}\r\n";			
					$count++;
			}//if
			
		}//for
		echo "]";
	}//if
} //**********************************************************************************************************************************************************//
//**********************************************************************************************************************************************************************//
//**********************************************************************************************************************************************************************//

mysql_close();
?>