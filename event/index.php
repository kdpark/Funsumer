<? ini_set ( 'session.cache_limiter' , 'private' ); session_start();	
	$id = $_COOKIE["usercookie"];						
    if(!$id)
    {
	    $id = $_SESSION['userid'];	    
    }
    if(!$id)
    {
	    echo("<script> top.location.href='../index.php'; </script>");     
    }
	
	$eventnumber = $_POST['eventnumber'];	
	$mynoteid = $_POST['mynoteid'];
	
    if(!$mynoteid)
    {
    	$mynoteid = $id;
    }
	
	if(!$eventnumber){
		echo ("<script> location.href='../party/' </script>");
	}
	
	include "../dbconn.php";

	//////////// 이름 얻기 : me 는 로그인한 세션의 정보
	$sql = "select * from member m where m.id='$id'";
	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result);
	$me = mysql_fetch_array($result);
	$j_me = json_encode($me);	

	$sql = "select*from event where event_num='$eventnumber' order by id";
	$result = mysql_query($sql,$connect);
	$rows = mysql_num_rows($result);
	
	$indexing = ($rows/3);

	if($rows){
		for($i=0;$i<$rows;$i++){
			mysql_data_seek($result,$i);
			$row = mysql_fetch_array($result);
			$target = $row[2];
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
	}
	
	//$time = "2013-05-25 10:00:00";
	$t = strtotime($time);     
	$interval = $t - time();
	
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

	$j_first_grade = json_encode($first_grade);
	$j_first_pname = json_encode($first_pname);
	$j_first_pic = json_encode($first_pic);
	
	$j_second_grade = json_encode($second_grade);
	$j_second_pname = json_encode($second_pname);
	$j_second_pic = json_encode($second_pic);
	
	$j_third_grade = json_encode($third_grade);
	$j_third_pname = json_encode($third_pname);
	$j_third_pic = json_encode($third_pic);
	
	$j_first_vote = json_encode($first_vote);
	$j_second_vote = json_encode($second_vote);
	$j_third_vote = json_encode($third_vote);
	
	$j_top1_id = json_encode($top1_id);
	$j_top1_name = json_encode($top1_name);
	$j_top1_pic = json_encode($top1_pic);
	
	$j_top2_id = json_encode($top2_id);
	$j_top2_name = json_encode($top2_name);
	$j_top2_pic = json_encode($top2_pic);
	
	$j_top3_id = json_encode($top3_id);
	$j_top3_name = json_encode($top3_name);
	$j_top3_pic = json_encode($top3_pic);
	
	$sql = "select NOW()";
	$result = mysql_query($sql,$connect);
	$oo = mysql_fetch_array($result);	
	$nowtime = explode(" ",$oo[0]);
	
	if($nowtime[0] > "2013-06-13") $tvalue = 1;
	else $tvalue = 2;
	//first_grade, first_pname, first_pic
	
?>
<!doctype html>
<html>
<head>
        <meta http-equiv="content-type" content="text/html;  charset=utf-8" />
        <meta name="Author" content="Funsumer" />
        <meta name="viewport" content="width=960" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7, IE=9" />
          
        <title>FUNSUMER</title>
        
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <script type="text/javascript" src="../js/placeholder.js"></script>
        <script type="text/javascript" src="../js/Scrollbar/easing.js"></script>
        <script type="text/javascript" src="../js/Scrollbar/mousewheel.js"></script>

        <link rel="stylesheet" type="text/css" href="../css/common/Base.css">
        <link rel="stylesheet" type="text/css" href="../css/common/Fullscreen.css">
        <link rel="stylesheet" type="text/css" href="../css/common/Scrollview.css">
        <link rel="stylesheet" type="text/css" href="../css/event/event.css">

        <script type="text/javascript" src="../js/common/Base.js"></script>
        <script type="text/javascript" src="../js/event/event.js"></script>
        <script type="text/javascript" src="../js/wassup/wvari.js"></script>
        <script type="text/javascript" src="../js/common/board.js"></script>
        <script type="text/javascript" src="../js/common/Fullscreen.js"></script>
        <script type="text/javascript" src="../js/ajax.js"></script>
         <script language="javascript">
			var me = eval('(<?=$j_me?>)');
			var mynoteid = <?=$mynoteid?>;
			
			var first_id = eval('(<?=$j_first_grade?>)');
			var first_name = eval('(<?=$j_first_pname?>)');
			var first_pic = eval('(<?=$j_first_pic?>)');
			var first_vote = eval('(<?=$j_first_vote?>)');
			var top1_id = eval('(<?=$j_top1_id?>)');
			var top1_name = eval('(<?=$j_top1_name?>)');
			var top1_pic = eval('(<?=$j_top1_pic?>)');
			
			var second_id = eval('(<?=$j_second_grade?>)');
			var second_name = eval('(<?=$j_second_pname?>)');
			var second_pic = eval('(<?=$j_second_pic?>)');
			var second_vote = eval('(<?=$j_second_vote?>)');
			var top2_id = eval('(<?=$j_top2_id?>)');
			var top2_name = eval('(<?=$j_top2_name?>)');
			var top2_pic = eval('(<?=$j_top2_pic?>)');
			
			var third_id = eval('(<?=$j_third_grade?>)');
			var third_name = eval('(<?=$j_third_pname?>)');
			var third_pic = eval('(<?=$j_third_pic?>)');
			var third_vote = eval('(<?=$j_third_vote?>)');
			var top3_id = eval('(<?=$j_top3_id?>)');
			var top3_name = eval('(<?=$j_top3_name?>)');
			var top3_pic = eval('(<?=$j_top3_pic?>)');
						
			var gradenum = <?=$indexing?>;
			var evnum = <?=$eventnumber?>;		
			var tvalue = <?=$tvalue?>;	
		</script>
        <!--[if IE 9]>
        <link rel="stylesheet" type="text/css" href="../css/common/For_IE9_common.css">
		<link rel="stylesheet" type="text/css" href="../css/party/For_IE9_party.css">
        <![endif]-->
        
												        <!--// IE9 under-->        
        <!--[if  lt IE 9]>
        <link rel="stylesheet" type="text/css" href="../css/common/For_IE8_common.css">
        <script src="../js/IE8.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/party/For_IE8_account.css">
        <script src="../js/IE8.js"></script>
		
		<style>
			#header { top: 40px !important }
		</style>
		
        <![endif]-->

</head>

<body onLoad="partyload();alarm();invmeparty();reqfriend();showCountdown(<? echo $interval; ?>);">
<div id='chromeinstall'>펀슈머에서 지원하지 않는 브라우저입니다. 더 나은 서비스를 위해 <a href="https://www.google.com/intl/ko/chrome/browser/features.html">Chrome</a>을 설치해 주세요.</div>

<div id="body_gradient"></div>

<div id="fullscreen_bg"></div>
<div id="win_alarm">
    
</div>

    <div id="header">
    
   		<div class="nav pie">
        	<ul class="logo"><img style="cursor:pointer" src="../images/party/Header/header_logo.png" height="16" alt="" onClick="post_to_url('../../event/',{'eventnumber':<? echo $eventnumber; ?>})"/></ul>
            <ul class="nav-menu">
                <li class="nav-wassup">
                	party
                    <li class="SDT-wassup">party</li>
                    <li class="SDD-wassup">party</li>                    
                </li>
                <li class="nav-note">
                	note
                    <li class="SDT-note">note</li>
                    <li class="SDD-note">note</li>                    
                </li>
                <li class="nav-party">
                	wassup
                    <li class="SDT-party">wassup</li>
                    <li class="SDD-party">wassup</li>                    
                </li>
			</ul>
            <ul class="nav-search pie">
            	<li class="wht-nav-search"></li>
                <li class="ch-ico-search"><img src="../images/party/Header/header_searchICOov.png" height="12" alt="" /></li>
                <li class="ico-search"><img src="../images/party/Header/header_searchICO.png" height="12" alt="" /></li>
                <li class="text-search"><input id="sch" type="text" align="left" onKeyUp="ajax_search();" /></li>
            </ul>
            
                    <div class="win-search pie">
                
                    <div class="noresult">검색결과가 없습니다.</div>
                
                    <div class="pple-search">
                        <div class="title"></div>
                        <div class="contents">
                        
                                                        
                        </div>
                    </div>
                    
					<div id="m_s_more" class="footer">'사람' 검색결과 더 보기</div>
                    
                    <div class="party-search">
                        <div class="title"></div>
                        <div class="contents">
                        
                                                    
                        </div>
                    </div>
                    
                    <div id="p_s_more" class="footer">'파티' 검색결과 더 보기</div>
                    
                </div>
            
        </div>
        
        <div class="Tap">

        
        	<div class="topline"></div>
	
     <div class="alarm-message">
            <div class="ico_alarm">
					<img src="../images/party/Tap/alarm-message.png" width="26" alt="" /> <!-- 0429 -->
                	<div class="number-alarm"></div>
                </div>   	
            <div class="win-alarm pie">
                <div class="title">최신 알림</div>
                
                <div id="alarm-message-contents">
                    <div class="ScrollBox">
                        <div class="container">
                            <div class="content">
                                        
                            </div> <!--// Content -->
                        </div> <!--// Container -->
                        <div class="dragger_container">
                            <div class="dragger"></div>
                        </div>
                        
                    </div> <!-- ScrollBox -->
                </div> <!--// alarm-message-contents -->

                <div class="bottom"></div>
                
            </div> <!--// Win-alarm -->
        </div> <!--// alarm-message -->
        
        <div class="invite-party">
            <div class="ico_pinvite">
                	<div class="number-party"></div>
                </div>   	
            <div class="win-party pie">
                <div class="title">파티초대 관리</div>
                
                <div id="invite-party-contents">
                    <div class="ScrollBox">
                        <div class="container">
                            <div class="content">
                                        
                            </div> <!--// Content -->
                        </div> <!--// Container -->
                        <div class="dragger_container">
                            <div class="dragger"></div>
                        </div>
                        
                    </div> <!-- ScrollBox -->
                </div> <!--// invite-party-contents -->

                <div class="bottom"></div>
                
            </div> <!--// Win-party -->
        </div> <!--// Invite-party -->
        
        <div class="invite-member">
            <div class="ico_minvite">
                	<div class="number-member"></div>
                </div>
            <div class="win-member pie">
                <div class="title">친구요청 관리</div>
                
                <div id="invite-member-contents">
                    <div class="ScrollBox">
                        <div class="container">
                            <div class="content">
                                
                            </div> <!--// Content -->
                        </div> <!-- Container -->
                        <div class="dragger_container">
                            <div class="dragger"></div>
                        </div>
                        
                    </div> <!--// ScrollBox -->
                </div> <!--// invite-member-contents -->
                
                <div class="bottom"></div>
                        
            </div> <!--// Win-member -->
        </div> <!--// Invite-member -->
        
        <div class="setting ">
        	<div class="ico_set"></div>
            <div class="win-setting pie">
	
                <div class="title">설정</div>
                <div class="contents">
                    <div class="admin" alt="0">계정관리</div>
                        <div class="logout" alt="1">로그아웃</div>
                        <div class="clientcenter" alt="2">고객센터</div>
                </div>
                <div class="bottom"></div>
            
            </div> <!--// Win-setting -->
        
        </div> <!--// Setting -->
        </div> <!--// Tap -->
        
        <div class="Tap2">
        	<div class="mynote"><img src="../images/base/tap2_mynote.png" width="20" alt="" title="마이노트" /></div>
            <div class="myparty"><img src="../images/base/tap2_mypartylist.png" width="20" alt="" title="마이 파티리스트"/></div>
        </div>
    
</div> <!--// Header -->

<div id="wrapbox">
    
    <div id="container">
    
    	<div class="partylist">
        
         	<div class="title">
            	<? echo $target ?> 인기 피자 이벤트
                <div class="way" style="cursor:pointer;">피자를 얻는방법 ?</div> <!-- 0523 -->
                <div class="way1" style="cursor:pointer;" onClick="post_to_url('../event2/',{'eventnumber':evnum});">얼짱대표 선발전</div>
            </div>
        
        	<div class="info">
            
                <div class="left">
                	<div class="img"><img src="../images/event/time.png" height="20" alt="" /></div>
                    <div class="time">
                    	<div class="day number"></div>
                        <div class="gap gap_day">일</div>
                        <div class="hour number"></div>
                        <div class="gap">:</div>
                        <div class="minute number"></div>
                        <div class="gap">:</div>
                        <div class="second number"></div>
                    </div> <!--// time -->
                </div> <!--// left -->
                
                <div class="right">
                    <div class="pic" style="cursor:pointer" onClick="post_to_url('../../note/',{});"><img src="../<? echo $me[profilepic]; ?>" alt="" class="pie" /></div>
                    <div class="button">
                        <div class="friends nanumbold"><a onClick="post_to_url('../../note/',{'friend':1});">친구목록</a></div>
                        <div class="partys nanumbold"><a onClick="post_to_url('../../party/',{});">파티목록</a></div>
                    </div> <!--// button -->
                </div> <!--// right -->

                <div class="explain"><? echo $target; ?>에만 주어진 기회!<br>
이제 여러분에게 피자 10판이 갑니다.<br>
최고의 인기반이 되어보세요!
				</div>
                
            </div> <!--// info -->
            
            <div class="ranker_titles"></div>
            
            <div class="ranker">
            
                <div class="content">
                
                	<div id="rank_stu3" class="student3 students">
                    
                    	<div class="title">3학년</div>
                        
                        <div class="content">
                        
                        	<div class="nonexist">
                            
                            	<div class="title">아직 1등이 없습니다.</div>
                                
                            	<div class="explain">1등을 위해 도전해 보세요!<br>인기투표를 통해 1등을 쟁취하세요!<br>피자 10판이 갑니다~</div>
                                <div class="way"><a>인기투표 방법 알아보기 <img src="../images/event/arrow.png" height="8" alt="" /></a></div>
                            
                            </div> <!--// nonexist -->
                        
	                        <div class="exist">
                        	
                                <div class="medal"><img src="../images/event/medal1.png" height="80" alt="" /></div>
                                
                                <div class="cards">
                                
                                    <div class="img">
                                    
                                    	<img src="" alt="" />
                                        
                                        <div class="starsumer">
                                        	<div class="left">
                                            	<div class="img"><img src="" alt="" /></div>
                                            </div>
                                            <div class="right">
                                            	<div class="title"><img src="../images/event/crown.png" height="15" alt="" /></div>
                                                <div class="name"></div>
                                            </div>
                                        </div> <!--// starsumer -->
                                        
                                    </div> <!--// img -->
                                    
                                    <div class="name nanumbold">
                                        <div class="left"></div>
                                        <div class="right"><img src="../images/party/Container/heart.png" alt=""/></div>
                                    </div>
                                </div> <!--// cards -->
                                
                            </div> <!--// exist -->
                            
                        </div> <!--// content -->
                        
                    </div>
                    
                    <div id="rank_stu2" class="student2 students">
                    
                        <div class="title">2학년</div>
                    
                        <div class="content">
                        
                        	<div class="nonexist">
                            
                            	<div class="title">아직 1등이 없습니다.</div>
                                
                            	<div class="explain">1등을 위해 도전해 보세요!<br>인기투표를 통해 1등을 쟁취하세요!<br>피자 10판이 갑니다~</div>
                                <div class="way"><a>인기투표 방법 알아보기 <img src="../images/event/arrow.png" height="8" alt="" /></a></div>
                            
                            </div> <!--// nonexist -->
                        
	                        <div class="exist">
                                
                                <div class="medal"><img src="../images/event/medal2.png" height="80" alt="" /></div>
                                
                                <div class="cards">
                                
                                    <div class="img">
                                    
                                    	<img src="" alt="" />
                                        
                                        <div class="starsumer">
                                        	<div class="left">
                                            	<div class="img"><img src="" alt="" /></div>
                                            </div>
                                            <div class="right">
                                            	<div class="title"><img src="../images/event/crown.png" height="15" alt="" /></div>
                                                <div class="name"><a></a></div>
                                            </div>
                                        </div> <!--// starsumer -->
                                        
                                    </div> <!--// img -->
                                    
                                    <div class="name nanumbold">
                                        <div class="left"></div>
                                        <div class="right"><img src="../images/party/Container/heart.png" alt=""/></div>
                                    </div>
                                </div> <!--// cards -->
                                
                            </div> <!--// exist -->
                            
                        </div> <!--// content -->
                        
                    </div>
                    
                    <div id="rank_stu1" class="student1 students">
                    
                        <div class="title">1학년</div>
                    
                        <div class="content">
                        
                        	<div class="nonexist">
                            
                            	<div class="title">아직 1등이 없습니다.</div>
                                
                            	<div class="explain">1등을 위해 도전해 보세요!<br>인기투표를 통해 1등을 쟁취하세요!<br>피자 10판이 갑니다~</div>
                                <div class="way"><a>인기투표 방법 알아보기 <img src="../images/event/arrow.png" height="8" alt="" /></a></div>
                            
                            </div> <!--// nonexist -->
                        
	                        <div class="exist">
                        	
                                <div class="medal"><img src="../images/event/medal3.png" height="80" alt="" /></div>
                                
                                <div class="cards">
                                
                                    <div class="img">
                                    
                                    	<img src="" alt="" />
                                        
                                        <div class="starsumer">
                                        	<div class="left">
                                            	<div class="img"><img src="" alt="" /></div>
                                            </div>
                                            <div class="right">
                                            	<div class="title"><img src="../images/event/crown.png" height="15" alt="" /></div>
                                                <div class="name"><a></a></div>
                                            </div>
                                        </div> <!--// starsumer -->
                                        
                                    </div> <!--// img -->
                                    
                                    <div class="name nanumbold">
                                        <div class="left"></div>
                                        <div class="right"><img src="../images/party/Container/heart.png" alt=""/></div>
                                    </div>
                                </div> <!--// cards -->
                                
                            </div> <!--// exist -->
                            
                        </div> <!--// content -->
                    
                    </div>
                </div> <!--// content -->
            </div> <!--// ranker -->
            
            <div class="list">
            
                <div id="stu3" class="student3 students">
                                   
                </div> <!--// student3 -->

                <div id="stu2" class="student2 students">
                
                </div> <!--// student2 -->
            
                <div id="stu1" class="student1 students">
                  
                </div> <!--// student1 -->
                
            </div> <!--// list -->
        	
        </div> <!--// partylist -->
        
        <div id="tutorial">
        	<img src="../images/event/tutorial_<? echo $eventnumber ?>.png" alt="" />
        </div>

        <div id="copyright">
        
            <div class="contents">
            
            	<div class="left">Funsumer © 2013</div>
            
            	<div class="right">
        
                    <ul class="terms">이용약관</ul>
                    <ul class="policy">보호정책</ul>
                    <ul class="ads">광고문의</ul>
                    <ul class="Carecenter">고객센터</ul>
                
                </div>
            
            </div>
        
        </div> <!--// copyright -->
        
    </div> <!--// Container -->

</div> <!--// Wrapbox -->

<script>
$(window).load(function() {
	mCustomScrollbars();
});

function mCustomScrollbars(){
	$("#invite-party-contents").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","no",10); 
	$("#invite-member-contents").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","no",10); 
	$("#win_add_party_friends").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","no",10); 
}

/* function to fix the -10000 pixel limit of jquery.animate */
$.fx.prototype.cur = function(){
    if ( this.elem[this.prop] != null && (!this.elem.style || this.elem.style[this.prop] == null) ) {
      return this.elem[ this.prop ];
    }
    var r = parseFloat( jQuery.css( this.elem, this.prop ) );
    return typeof r == 'undefined' ? 0 : r;
}

/* function to load new content dynamically */
function LoadNewContent(id,file){
	$("#"+id+" .customScrollBox .content").load(file,function(){
		mCustomScrollbars();
	});
}
</script>
<script src="../js/Scrollbar/mScrollbar.js"></script>

</body>
</html>
