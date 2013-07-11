<?
	$connect = mysql_connect("localhost", "user", "vjstbaj") or die("DB 서버에 연결할 수 없습니다");
	mysql_query("set names utf8");
	mysql_select_db("funsumer", $connect);

$opt = $_GET['opt'];
$LoginID = $_GET['LoginID'];
$LoginPass = $_GET['LoginPass'];
$mynoteid = $_GET['mynoteid'];
$partyid = $_GET['partyid'];
$userid = $_GET['userid'];
$afrom = $_GET['afrom'];
$articleID = $_GET['articleID'];
//********************************************************************************OPT=1 / LOGIN API*******************************************************************//
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
				echo "{ Result: ".json_encode(0).", Result_data: ".json_encode($UserInfo[id])."}";
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


//**********************************************************************OPT=2 / GET USER INFO API*******************************************************************//

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
					echo "Result_WidePic: ".json_encode($gui[12])." ";
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


//**********************************************************************OPT=3 / GET USER FRIEND LIST API*******************************************************************//


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
								echo "Fid: ".json_encode($finfo[1])." ";						
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

//**********************************************************************OPT=4 / GET USER PARTY LIST API*******************************************************************//

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
					
						if($upl_exa){		// 파티가 1명 이상 존재		
						echo "{ Result: ".json_encode(0).", Result_data: [";			
							for($i=0;$i<$upl_exa;$i++){
								mysql_data_seek($result,$i);
								$gupi = mysql_fetch_array($result);
								
								$sql2 = "select pname, pic from party where id='$gupi[0]'";
								$result2 = mysql_query($sql2,$connect);
								$finfo = mysql_fetch_array($result2, $connect);
								
								if($i>0) echo ", ";
								echo "{\r\n";
								echo "Pname: ".json_encode($finfo[0]).", ";
								echo "Ppic: ".json_encode($finfo[1]).", ";
								echo "Pid: ".json_encode($gupi[0])." ";						
								echo "}\r\n";						
							}
							echo "]\r\n}\r\n";
						}
						else{
							echo "{ Result: ".json_encode(1)."}";	
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

//**********************************************************************OPT=5 / GET REQUEST ARTICLE INFORMATION API*******************************************************************//

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
								$sql = "select distinct a.a_content, a.time, a.id, m2.name, m2.id, m2.profilepic, a.party, m.name, m.id, a.pic, a.scrapper from member m, member m2, article a where m.id=$userid and a.mynote=m.id and m2.id=a.mem order by a.time desc";
								$result = mysql_query($sql,$connect);
								$note_exa = mysql_num_rows($result);
								if($note_exa){	//*********Mynote Contents Loading********************//
								echo "{\r\n Result: ".json_encode(0).", Result_data: [";
									for($i=0;$i<$note_exa;$i++){
										mysql_data_seek($result,$i);
										$noteArticle = mysql_fetch_array($result);																
										
										if($i>0) echo ", ";
										echo "{\r\n";
										echo "ArticleID: ".json_encode($noteArticle[2]).", ";
										echo "Author: ".json_encode($noteArticle[3]).", ";
										echo "AuthorID: ".json_encode($noteArticle[4]).", ";
										echo "AuthorPic: ".json_encode($noteArticle[5]).", ";
																			
										if($noteArticle[6]==0){
											$sql2 = "select name, id from member where id='$userid'";	//Article From
											$result2 = mysql_query($sql2,$connect);
											$UName = mysql_fetch_array($result2);
											echo "ArticleFrom: ".json_encode($UName[0].'의 마이노트').", ";
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
								$sql = "select distinct a.a_content, a.time, a.id, m.name, m.id, m.profilepic, a.pic, a.scrapper, a.notice from party p, article a, member m where p.id=$partyid and a.party=p.id and m.id=a.mem order by a.time desc";
								$result = mysql_query($sql, $connect);
								$party_exa = mysql_num_rows($result);
								if($party_exa){
									echo "{\r\nResult: ".json_encode(0).", Result_data: [";
									for($i=0;$i<$party_exa;$i++){
										mysql_data_seek($result, $i);
										$partyArticle = mysql_fetch_array($result);
										if($i>0) echo ", ";
										
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
											
									}							
									echo "\r\n]\r\n}";
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
			else if($afrom==0){		//****************************** WHATSUP		
				if($mynoteid){					
					$sql = "select*from member where id='$mynoteid'";
					$result = mysql_query($sql,$connect);
					$me_exa = mysql_num_rows($result);
					if($me_exa){		// 존재하는 mynote						
						$sql = "select distinct a.a_content, a.time, a.id, m2.name, m2.id, m2.profilepic, a.party, m2.name, a.pic, a.scrapper from member m, member m2, article a, friendship f where m.id=$mynoteid and f.mem1=m.id and f.mem2=m2.id and m2.id=a.mem order by a.time desc";
						$result = mysql_query($sql, $connect);
						$total_recording = mysql_num_rows($result);
						if($total_recording){
							echo "{\r\n Result: ".json_encode(0).", Result_data: [";
							
							for($i=0;$i<$total_recording;$i++){
								mysql_data_seek($result, $i);
								$whatsupArticle = mysql_fetch_array($result);
								
								if($i>0) echo ", ";			
								
								echo "{\r\n";
								echo "ArticleID: ".json_encode($whatsupArticle[2]).", ";
								echo "Author: ".json_encode($whatsupArticle[3]).", ";
								echo "AuthorID: ".json_encode($whatsupArticle[4]).", ";
								echo "AuthorPic: ".json_encode($whatsupArticle[5]).", ";																
								
								if($whatsupArticle[6]==0)
								{
									echo "ArticleFrom: ".json_encode($whatsupArticle[7].'님의 마이노트').", ";	
									echo "Isparty: ".json_encode(0).", ";	
									$sql2 = "select id from member where name='$whatsupArticle[7]'";
									$result2 = mysql_query($sql2,$connect);
									$belong = mysql_fetch_array($result2);									
									echo "Belong: ".json_encode($belong[0]).", ";
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
		}		
		else{		// afrom 누락
			echo "{\r\n Result: ".json_encode(3).", Error_text: ".json_encode('Invalid Need Parameter ErrorCode : 15')."}\r\n";
		}	
		echo "]\r\n}\r\n";
}


//*************************************************************************************OPT=6 / GET USER WHO LIST API*******************************************************************//

else if($opt==6){
	echo "{\r\ngwlAPI: [";
	if($mynoteid){
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
					$total_score[$i] = 0;
					
					$allid[$i]=$all[0];
						$sql1 = "select count from visit where from_mem='$allid[$i]' and to_mem='$myid'"; 	//나한테 들어온 횟수 점수환산
						$result1 = mysql_query($sql1,$connect);			
						$counting = mysql_fetch_array($result1);
						if($counting[0]){							
							$total_score[$i] = $counting[0] * 0.01;
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
								$sql3 = "select*from partyjoin where member_id='$myid' and party_id='$partyid[0]'";
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
						$sql4 = "select*from friend_vote where to_mem='$myid' and from_mem='$allid[$i]'";
						$result4 = mysql_query($sql4,$connect);
						$votenum = mysql_num_rows($result4);
						if($votenum){
							$total_score[$i] += 2*$votenum;
						}
						else{
							$total_score[$i] += 0;
						}
						if($allid[$i]==$myid){
							$total_score[$i] = -1;
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
				for($i=0;$i<6;$i++){
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
								$sql7 = "select*from partyjoin where member_id='$myid' and party_id='$partyid[0]'";
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

//****************************************************************************OPT=7 GET PARTY INFORMATION API***************************************************************************//

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
							echo "{ Result: ".json_encode(0).", PartyName: ".json_encode($pt_info[0]).", PartyPic: ".json_encode($pt_info[7]).", ";
							echo "PartySSierID: ".json_encode($pt_info[1]).", ";
							$sql2 = "select name, profilepic from member where id='$pt_info[1]'";
							$result2 = mysql_query($sql2,$connect);
							$PSS = mysql_fetch_array($result2);
							echo "PartySSierName: ".json_encode($PSS[0]).", ";
							echo "PartySSierPic: ".json_encode($PSS[1]).", ";
							
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
										echo "Party_Ann_aTime: ".json_encode($Ann_atime[$i]).", ";
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
									echo "Party_Mem_ID: ".json_encode($pm_data[0])." ";
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

//****************************************************************************OPT=8  API GET COMMENT INFORMATION API ***************************************************************************//
else if($opt==8){
	echo "{\r\n gaciAPI: [";
	if($mynoteid){
		if($articleID){
			echo "{\r\nResult: 0, ";
			// 댓글 표시 !!
			$sql2 = "select m.name, m2.name, r.r_content, r.time, m2.id, r.id, m2.profilepic from member m, member m2, reply r, article a where a.mem=m.id and r.r_article=a.id and m2.id=r.r_mem and a.id=$articleID order by r.time";
			$result2 = mysql_query($sql2, $connect);
			$total_record = mysql_num_rows($result2);
			echo "Article_Comment_Num: ".json_encode($total_record)." ";
			
			if($total_record){
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
				echo "]\r\n";
			}
			else{//if-totalrecord
				echo "{\r\n Result: ".json_encode(1).", Error_text: ".json_encode('Don\'t exist Contents ErrorCode : 36')."}\r\n"; 
			}
			echo "}\r\n";
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


//****************************************************************************OPT=9  API***************************************************************************//
//****************************************************************************OPT=10  API***************************************************************************//
//****************************************************************************OPT=11  API***************************************************************************//



//****************************************************************************			OPT 누락시			***************************************************************************//


else{
	echo "\r\n Funsumer API Version=\"1.0\" Lastest Update By 12-12-19 18:30";
}

//***************************************************************************************시험용 대선어플********************************************************************************//
/*
else if($opt==1000){	//대선어플?
	if($elec==1){
		$sql = "select moon from test where id='1'";
		$result = mysql_query($sql,$connect);
		$moon = mysql_fetch_array($result);
		
		$moon[0] = $moon[0] + 1;
		$sql = "update test set moon='$moon[0]' where id='1'";
		mysql_query($sql,$connect);
	}
	else{
		$sql = "select park from test where id='1'";
		$result = mysql_query($sql,$connect);
		$park = mysql_fetch_array($result);
		
		$park[0] = $park[0] + 1;
		$sql = "update test set park='$park[0]' where id='1'";
		mysql_query($sql,$connect);
	}
	$sql = "select*from test where id='1'";
	$result = mysql_query($sql,$connect);
	$re = mysql_fetch_array($result);
	
	echo "{\r\n";
	echo "Result: [";
	echo "{\r\n";
	echo "Moon: ".json_encode($re[1]).", ";
	echo "Park: ".json_encode($re[2])." ";
	echo "}\r\n";
	echo "\r\n]";
	echo "\r\n}";
}*/
mysql_close();
?>