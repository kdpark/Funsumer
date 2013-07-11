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
	
	$mynoteid = $_POST['mynoteid'];
	$friend = $_POST['friend'];
	
    if(!$mynoteid)
    {		
		$mynoteid = $id;		
    }
		
	include "../dbconn.php";

	//////////// 이름 얻기 : me 는 로그인한 세션의 정보
	$sql = "select * from member m where m.id='$id'";
	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result);
	$me = mysql_fetch_array($result);
	$j_me = json_encode($me);
	
	// user 로 띄워줌 : 요청한 페이지 id 정보
	$sql = "select * from member m where m.id='$mynoteid'";
	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result);
	$user = mysql_fetch_array($result);
	$j_user = json_encode($user);
	
	// user 가 가입한 파티
	$sql = "select p.pname, p.id, p.pic, j.visit_count, p.p_public from partyjoin j, party p where j.member_id='$user[id]' and j.party_id = p.id order by visit_count desc";
	$result=mysql_query($sql, $connect);
	$NumberOfParty = mysql_num_rows($result);
	
	for($i=0;$i<$NumberOfParty;$i++)
	{
		mysql_data_seek($result, $i);
		$joinedparty = mysql_fetch_array($result);
		$party[$i]=$joinedparty[0];
		$arrPartyid[$i]=$joinedparty[1];
		$parpic[$i] = $joinedparty[2];
		$visitcount[$i]=$joinedparty[3];
		$ppublik[$i] = $joinedparty[4];
		$sql1 = "select*from partyjoin where member_id='$id' and party_id='$arrPartyid[$i]'";
		$rst = mysql_query($sql1,$connect);
		$or[$i] = mysql_num_rows($rst);
	}
	/*for($i=$NumberOfParty;$i<($NumberOfParty+6);$i++)
	{
		$party[$i] ="";
		$arrPartyid[$i] = 0;
	}*/

	$j_partyname = json_encode($party);
	$j_partyid = json_encode($arrPartyid);
	$j_partypic = json_encode($parpic);
	$j_ppublik = json_encode($ppublik);
	$j_or = json_encode($or);	
	
	// user의 친구 수
	$sql = "select id from friendship where mem1='$user[id]'";
	$result = mysql_query($sql, $connect);
	$NumUserFriend = mysql_num_rows($result);
	
	//페이지 여부
	$isthismypage = 0;
	if($id == $mynoteid)
	{
		$isthismypage = 1;	
	}
	
	$sql = "select university from member where id='$id'";
	$result = mysql_query($sql,$connect);
	$sch = mysql_fetch_array($result);
	
	$sql = "select*from event where target='$sch[0]' and present='1'";
	$result = mysql_query($sql,$connect);
	$rows = mysql_num_rows($result);
	$row = mysql_fetch_array($result);	
	$evnum = $row[1];

		
?>
<!doctype html>
<html>
<head>
        <meta http-equiv="content-type" content="text/html;  charset=utf-8" />
        <meta name="Author" content="Funsumer" />
        <meta name="viewport" content="width=1040" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7, IE=9" />
          
        <title>FUNSUMER</title>
        
        <script src="../js/ajax.js"></script>
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <script type="text/javascript" src="../js/placeholder.js"></script>
        <script type="text/javascript" src="../js/Scrollbar/easing.js"></script>
        <script type="text/javascript" src="../js/Scrollbar/mousewheel.js"></script>

        <link rel="stylesheet" type="text/css" href="../css/common/Base.css">
		<link rel="stylesheet" type="text/css" href="../css/common/Board.css">
        <link rel="stylesheet" type="text/css" href="../css/common/Fullscreen.css">
        <link rel="stylesheet" type="text/css" href="../css/common/Scrollview.css">
        <link rel="stylesheet" type="text/css" href="../css/note/Note.css">

        <script type="text/javascript" src="../js/common/Base.js"></script>
		<script type="text/javascript" src="../js/common/Board.js"></script>
        <script type="text/javascript" src="../js/common/Fullscreen.js"></script>
        <script type="text/javascript" src="../js/common/Buttons.js"></script>
        <script type="text/javascript" src="../js/note/Note.js"></script>
        <script src="../js/note/notevari.js"></script>
        <script language="javascript">
		//php set variables
			var u_partyname = eval('(<?=$j_partyname?>)');
			var u_partyid = eval('(<?=$j_partyid?>)');
			var u_partypic = eval('(<?=$j_partypic?>)');
			var u_ppub = eval('(<?=$j_ppublik?>)');
			var or = eval('(<?=$j_or?>)');
			var u_partynum = <?=$NumberOfParty?>;
			var me = eval('(<?=$j_me?>)');
			var user = eval('(<?=$j_user?>)');			
			var isthismypage = <?=$isthismypage?>;		
			var note=1;	
		</script>
       <!--[if IE 9]>
        <link rel="stylesheet" type="text/css" href="../css/common/For_IE9_common.css">
		<link rel="stylesheet" type="text/css" href="../css/note/For_IE9_note.css">
        <![endif]-->
        
												        <!--// IE9 under-->        
        <!--[if  lt IE 9]>
        <link rel="stylesheet" type="text/css" href="../css/common/For_IE8_common.css">
        <script src="../js/IE8.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/note/For_IE8_note.css">
        <script src="../js/IE8.js"></script>
        <![endif]-->

</head>

<!-- <body onLoad="infovotenum();LoadArticle();loadnoteinfo();Upartyload();alarm();invmeparty();reqfriend();frkloading();flg(<? echo $friend ?>);visitquery();"> -->
<body onLoad="infovotenum();LoadArticle();loadnoteinfo();Upartyload();alarm();invmeparty();reqfriend();flg(<? echo $friend ?>);visitquery();">

<div id='chromeinstall'>펀슈머에서 지원하지 않는 브라우저입니다. 더 나은 서비스를 위해 <a href="https://www.google.com/intl/ko/chrome/browser/features.html">Chrome</a>을 설치해 주세요.</div>

<div id="ScrollTop">Scroll <br>to Top</div> <!--// 0420 스크롤탑 -->
<iframe src="../imgiframe.php" style="display:none;" id="imgiframe"></iframe>
<!--<div id="a" style="position:fixed; width:100px; height:200px; background-color:#000; color:#FFF"></div>-->
<div id="fullscreen_bg"></div>
<div id="win_alarm">
    
</div>
<div id="win_board_original">
    
</div> <!--// win_board_original -->
<div id="win_add_party">
	<div class="container pie">
        <div class="partyname">
        <!--0429--> <div class="title">새로 만들 파티명을 입력해주세요.</div>
            <div class="top"></div>
            <div class="mid"><input type="text" placeholder="Party name ..."/></div>
            <div class="bot"></div>
        </div> <!--// partyname -->
        
        <!-- 0613 시작 -->
        <div class="partysetting" style="display:none;">

            <div class="header">
                <div class="title">파티 권한을 설정해보세요.</div>
            </div> <!--// header -->
            
            <div class="container">
                <div class="show">
                    <div class="title">파티명 노출 여부</div>
                    <div class="container">
                        <div class="button">
                            <div class="on selected">공개</div>
                            <div class="off">비공개</div>
                        </div>
                        <div class="explain">
                            <div class="on selected"><h1>공개</h1>를 선택하시면 파티명이 가려지지 않고 어디서든 노출됩니다.</div>
                            <div class="off"><h1>비공개</h1>를 선택하시면 파티명이 검색되지 않고, <br>파티 회원 이외에 유저에겐 노출 되지 않습니다.<br>가입은 파티쉐가 유저에게 초대장을 보내면 할 수 있습니다.</div>
                        </div>
                    </div>
                </div>
                <div class="allow">
                    <div class="title">가입 권한 관리</div>
                    <div class="container">
                        <div class="button">
                            <div class="on selected">자유</div>
                            <div class="off">승인</div>
                        </div>
                        <div class="explain">
                            <div class="on selected"><h1>자유</h1>를 선택하시면 누구든지 쉽게 가입 할 수 있습니다.</div>
                            <div class="off"><h1>승인</h1>을 선택하시면 파티쉐의 승인을 통해 가입 할 수 있습니다.</div>
                        </div>
                    </div>
                </div>
            </div> <!--// container -->
        
        </div> <!--// partysetting -->
        <!-- 0613 끝 -->
        
        <div class="invite_Fri">
<!--0429--> <div class="title">파티에 초대할 친구들을 선택해주세요.</div>
            <div class="top"></div>
            <div class="mid">
            	<div id="win_add_party_friends">
                        <div class="ScrollBox">
                            <div class="container">
                                <div class="content">
                                        
                                </div> <!--// Content -->
                            </div> <!--// Container -->
                            <div class="dragger_container">
                                <div class="dragger"></div>
                            </div>
                        </div> <!-- ScrollBox -->
                    </div> <!--// win_add_party_friends -->
            </div> <!--// mid -->
            <div class="bot"></div>
        </div> <!--// invite_Fri -->
        <div class="footer">
        	<div class="number"><h1>0</h1> 명에게 초대장을 보냅니다.</div>
            <div class="Button2_red position" onClick="createparty();">Create It
            	<div class="Button2_red_word">Create It</div>
            </div>
        </div> <!--// footer -->
    </div> <!--// container -->
</div> <!--// win_friend_invite -->

<div id="body_gradient"></div>

<div id="wrapbox" class="pie">

    <div id="header">
   		<div class="nav pie">
        	<ul class="logo"><img src="../images/party/Header/header_logo.png" height="16" alt="" onClick="<? if($evnum!=0){ echo "post_to_url('../event/',{'eventnumber':$evnum});"; }else{ echo "post_to_url('../party/',{});"; } ?>" style="cursor:pointer;" /></ul>
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
        <div id="tapmsg" style="position:absolute; width:100px; height:50px; top:-15px; left:50px;"></div>
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
        </div>
        
        <div class="Tap2">
            <div class="mynote"><img src="../images/base/tap2_mynote.png" width="20" alt="" title="마이노트" /></div>
            <div class="myparty"><img src="../images/base/tap2_mypartylist.png" width="20" alt="" title="마이 파티리스트"/></div>
        </div>
        
    </div> <!--// Header -->
    
    <div id="container">
    
    	<div class="baseinfo">
	        <div class="divbaseinfo">
                <div id="box">
                    <div id="boxok" style="display:none; text-align:center; position:absolute; width:200px; height:20px; top:300px; left:374px; background-color:#FFF; color:#000; opacity:0.6; z-index:10;" onClick="ysubmit();">완료하려면 클릭하세요</div>
                </div>
            </div>
        	<div class="gradient"></div>
        	<div class="info">
            	<div class="prof_pic pie">
                	<img src="../" alt="" class="pie" />
                    <div class="prof_over"></div>
                </div>
                <div class="prof_info nanumbold">
                	<div class="name"></div>
                    <div class="info"></div>
                	<div class="vote_number mine"></div>
                	<div class="friend_number"></div>
					<div class="explain">
						<div class="vote"><? echo $user[0] ?> 님이 받은 인기투표 수 입니다. <br>친구들에게도 투표를 해주세요!</div>
					</div>
                </div>
                
            </div> <!--// info -->
            <div class="button">
            
                <div class="mine modi_cover"><img src="../images/note/modi_cover.png" alt="" /></div>
                <div class="mine list_friend"><img src="../images/note/list_friend.png" alt="" /></div>
                <div class="mine add_party"><img src="../images/note/add_party.png" alt="" /></div>
            
            	<div class="noyours vote"><img src="../images/note/vote.png" alt="" /></div>
                <div class="noyours add_friend"><img src="../images/note/add_friend.png" alt="" /></div>
                
            	<div class="yours vote"><img src="../images/note/vote.png" alt="" /></div>
                <div class="yours ok_friend"><img src="../images/note/add_friendok.png" alt="" /></div>
                <div class="yours list_friend"><img src="../images/note/list_friend.png" alt="" /></div>
                
            </div> <!--// button -->
        </div> <!--// baseinfo -->
        
        <div id="pre_party">
		
            <div class="title">
                가입한 파티목록
            </div>
			
            <div class="more">
            	<a onClick="post_to_url('../party/',{'mynoteid':user[4]});">전체보기</a>
            </div>
            
            <div class="arrow_L arrow"></div>
            
            <div class="contents">
    
                <div id="section" class="section">
                                                            
                </div>
                
            </div>
            
            <div class="arrow_R arrow"></div>
        
        </div> <!--// Pre_party -->
        
        <div class="mine wholist">
        	<div class="left">
            	<div class="title">마이 팬슈머</div>
                <div class="questionmark">?</div>
					
                    <div class="pop">				<!--// ? :: 팝업창 -->
                    
                        <div class="content">
                        
                            <div class="list">
                            
                                <div class="white">
                                
                                	<div class="text">
                                
		                                나에게 관심있는 친구들입니다. <br>친구들과 (함께)파티를 즐겨보세요.
                                
                                	</div>
                                    
                                    <div class="close"></div>
                                    
                                </div> <!--// white -->
                            
                            </div> <!--// list -->
                        
                        </div> <!--// content -->
                    
                    </div> <!--// pop -->
			</div>
            <div class="right">
          		<div class="nonecard" style="display:none">
                	fansumer가 없습니다. 친구를 사귀어 보세요!
                </div>                
            </div>
        </div>
        
        <div class="boundary yours"></div>
		<div class="boundary yours noyours"></div>
        
        <div class="board">

        	<div class="Lfield">
            	<div class="preview">
                	<div class="title">
                    	게시물 미리보기
                       </div>
                       
                	<div class="content">
                        <div class="list">
                        
                            <div class="cards nonecards" onClick="gotobyScroll(this);">
                                <div class="white">
                                	<div class="text">
                                    <a></a>
                                    </div>

                                    <div class="pic">
                                        <div class="img" id="pre_card0">
                                            <img src="" alt="" />
                                        </div>
                                    </div> <!--// pic -->      
                                </div>
                            </div> <!--// cards -->
                            
                            <div class="cards nonecards" onClick="gotobyScroll(this);">
                                <div class="white">
                                    
                                    <div class="text">
                                    <a></a>
                                    </div>

                                    <div class="pic">
                                        <div class="img" id="pre_card1">
                                            <img src="" alt="" />
                                        </div>
                                    </div> <!--// pic -->                                

                                    
                                </div>
                            </div> <!--// cards -->
                            
                            <div class="cards nonecards" onClick="gotobyScroll(this);">
                                <div class="white">
                                    
                                    <div class="text">
                                    <a></a>
                                    </div>

                                    <div class="pic">
                                        <div class="img" id="pre_card2">
                                            <img src="" alt="" />
                                        </div>
                                    </div> <!--// pic -->                                

                                    
                                </div>
                            </div> <!--// cards -->
                            
                            <div class="cards nonecards" onClick="gotobyScroll(this);">
                                <div class="white">
                                    
                                    <div class="text">
                                    <a></a>
                                    </div>

                                    <div class="pic">
                                        <div class="img" id="pre_card3">
                                            <img src="" alt="" />
                                        </div>
                                    </div> <!--// pic -->                                

                                    
                                </div>
                            </div> <!--// cards -->
                            
                            <div class="cards nonecards" onClick="gotobyScroll(this);">
                                <div class="white">
                                    
                                    <div class="text">
                                    <a></a>
                                    </div>

                                    <div class="pic">
                                        <div class="img" id="pre_card4">
                                            <img src="" alt="" />
                                        </div>
                                    </div> <!--// pic -->                                

                                    
                                </div>
                            </div> <!--// cards -->
                            
                            <div class="cards nonecards" onClick="gotobyScroll(this);">
                                <div class="white">
                                	<div class="text">
                                    <a></a>
                                    </div>

                                    <div class="pic">
                                        <div class="img" id="pre_card5">
                                            <img src="" alt="" />
                                        </div>
                                    </div> <!--// pic -->                                

                                </div>
                            </div> <!--// cards -->
                            
                        </div> <!--// list -->
    
                    </div> <!--// content-->
                    
                    <div class="controll">
                            
                            <div class="white">
                            
                                <div class="midposition">
                                
                                    <div class="left" style="cursor:pointer"><</div>
                                    <div class="num">01</div>
                                    <div class="right" style="cursor:pointer">></div>
                        
                                </div>
                            
                            </div>
                        
                        </div>
                   
                </div> <!--// preview -->
                <div class="bg"></div>
            </div> <!--// Lfield -->
            <div class="Rfield">
             <div class="title">
                    내가 쓴 글 모아보기
                </div>
            	<div class="write">
                	<div class="title">
                    	<div class="top"></div>
                        <div class="mid"><input type="text" placeholder="제목추가 ..."/></div>
                        <div class="bot"></div>
                    </div> <!--// title -->
                    <div class="contents">
                    	<div class="top"></div>
                        <div class="mid">
                        	<textarea placeholder="포스트 작성하기 ..."></textarea>
                        </div>
                        <div class="bot"></div>
                     </div> <!--// contents -->
                    <div class="buttons">
                    	<div class="camera"><img src="../images/board/button_camera.png" alt=""/></div>
                        <div class="anounce"><img src="../images/board/button_anounce.png" alt=""/></div>
                        <div class="postit">
                        	<div class="Button2_red" onClick="writeArticle();">Post It
                            	<div class="Button2_red_word">Post It</div>
                            </div>
                        </div>
                        <div class="publicsetting">
                        	<div class="button" alt="0"><img src="../images/board/public.png" height="12" alt="" />공개 설정</div>
                            <div class="menu">
                            	<li class="checked" alt="0"><img src="../images/board/checked.png" alt="" />전체 공개</li>
                            	<li alt="1"><img src="../images/board/nonechecked.png" alt="" />친구 공개</li>
                            </div> <!--// menu -->
                        </div> <!--// publicsetting --> <!-- 0507 -->
                    </div> <!--// buttons -->
                    
                    <div class="cameraspace">
                    
                    	<div class="photopart">
                        	<div class="photo">
                            	<div class="photo1 photos">
                                	<div class="img"><img src="" height="100%" alt="" /></div>
                                	<div class="frame"></div>
                                    <div class="close"></div>
                                </div>
                            	<!--<div class="photo2 photos">
                                	<div class="img"><img src="../images/p3.png" height="100%"alt="" /></div>
                                	<div class="frame"></div>
                                    <div class="close"></div>
                                </div>
                            	<div class="photo3 photos">
                                	<div class="img"><img src="../images/p4.png" height="100%"alt="" /></div>
                                	<div class="frame"></div>
                                    <div class="close"></div>
                                </div>
                            	<div class="photo4 photos">
                                	<div class="img"></div>
                                	<div class="frame"></div>

                                    <div class="close"></div>
                                </div>
                            	<div class="photo5 photos">
                                	<div class="img"></div>
                                	<div class="frame"></div>
                                    <div class="close"></div>
                                </div>-->
                                <div class="addphoto" onClick="tempimageupload();"></div>
                            </div> <!--// photo -->
                            <div class="explain"></div>
                        </div> <!--// photopart -->
                        
                        <div class="framepart">
                        	<div class="explain">배치를 선택해 보세요.</div>
                            <div class="frame">
                            	<div class="frame1 each_frame">
                                	<ul class="outline case1">
                                    	<li class="XL">1</li>
                                        <li class="XL">2</li>
                                    </ul>
                                    <ul class="outline case2">
                                    	<li class="L">1</li>
                                        <li class="L">2</li>
                                    </ul>
                                </div> <!--// frame1 -->
                                
                                <div class="frame2 each_frame">
                                	<ul class="outline case1">
                                    	<li class="XL">1</li>
                                        <li class="L">2</li>
                                        <li class="L">3</li>
                                    </ul>
                                    <ul class="outline case2">
                                    	<li class="L">1</li>
                                        <li class="L">2</li>
                                        <li class="XL">3</li>
                                    </ul>
                                    <ul class="outline case3">
                                    	<li class="S">1</li>
                                    	<li class="S">2</li>
                                    	<li class="S">3</li>
                                    </ul>
                                </div> <!--// frame2 -->
                                
                                <div class="frame3 each_frame">
                                	<ul class="outline case1">
                                    	<li class="XL">1</li>
                                        <li class="L">2</li>
                                        <li class="L">3</li>
                                        <li class="XL">4</li>
                                    </ul>
                                    <ul class="outline case2">
                                    	<li class="XL">1</li>
                                        <li class="S">2</li>
                                        <li class="S">3</li>
                                        <li class="S">4</li>
                                    </ul>
                                    <ul class="outline case3">
                                    	<li class="S">1</li>
                                        <li class="S">2</li>
                                        <li class="S">3</li>
                                        <li class="XL">4</li>
                                    </ul>
                                    <ul class="outline case4">
                                    	<li class="L">1</li>
                                        <li class="L">2</li>
                                        <li class="L">3</li>
                                        <li class="L">4</li>
                                    </ul>
                                </div> <!--// frame3 -->
                                <div class="frame4 each_frame">
                                	<ul class="outline case1">
                                    	<li class="XL">1</li>
                                        <li class="L">2</li>
                                        <li class="L">3</li>
                                        <li class="L">4</li>
                                        <li class="L">5</li>
                                    </ul>
                                    <ul class="outline case2">
                                    	<li class="L">1</li>
                                        <li class="L">2</li>
                                        <li class="XL">3</li>
                                        <li class="L">4</li>
                                        <li class="L">5</li>
                                    </ul>
                                    <ul class="outline case3">
                                    	<li class="L">1</li>
                                        <li class="L">2</li>
                                        <li class="S">3</li>
                                        <li class="S">4</li>
                                        <li class="S">5</li>
                                    </ul>
                                    <ul class="outline case4">
                                        <li class="S">1</li>
                                        <li class="S">2</li>
                                        <li class="S">3</li>
                                    	<li class="L">4</li>
                                        <li class="L">5</li>
                                    </ul>
                                </div> <!--// frame4 -->
                            </div> <!--// frame -->
                        </div> <!--// framepart -->
                    </div> <!--// cameraspace -->
                </div> <!--// write -->
                
                <div id="board_contents" class="contents">
                <div class="nonepost" style="display:none;"><img src="../images/basic/board/noneboard.png"></div>
				
                    
                </div> <!--//contents -->
                
            </div> <!--// Rfield -->
        
        </div><!--// board -->
        
    </div> <!--// Container -->
    
    <div id="container2">
    
		<div id="friendlist">
        
        	<div class="gradient_top"></div>

			<div class="header">
            	<div class="profile">
                	 <div class="name nanumbold"><? echo $user[name]."  ($user[ename])" ?></div>
                	<div class="pic"><img src="../../<? echo $user[profilepic] ?>" alt="" class="pie" /></div>                   
	                <div class="button pie">
                        <div class="outline pie"></div>
                        <img src="../images/note/back.png" alt="" />
                        </div>
                </div>
            </div>
            
            <div class="gradient_down"></div>
            
            <div class="contents">
            	<div class="title">
                	<div class="img"></div>
                    <div class="search">
                        <div class="ico-search"><img src="../images/party/Container/searchmember.png" width="14" height="14" alt="" /></div>
                        <div class="text-search"><input type="text" placeholder="멤버검색" id="friendlist_sch"; class="friendlist_input" onKeyUp="friendlist_search(this);" /></div>
                    </div>
                </div>
                <div class="subtitle">
                    <div class="Button_gray position" onClick="facebook();">친구 찾아보기
                        <div class="Button_gray_word">친구 찾아보기</div>
                    </div>
                	<div class="text">
                		더 많은 친구들을 찾아보세요. 잊고 지냈던 그들과 다시 만날 수 있습니다.
                    </div>
                </div>
                <div class="container">
          
                    
                </div> <!--// container -->
                
            </div> <!-- contents -->

        </div> <!--// friendlist -->
    
    </div> <!--// container2 -->
    
    <div id="copyright">
    
        <div class="contents">
        
            <div class="right">
    
                <ul class="terms" onClick="location.href='../legal/'">이용약관&nbsp;&nbsp;&middot;</ul>
                <ul class="policy" onClick="location.href='../privacy/'">개인정보 취급방침&nbsp;&nbsp;&middot;</ul>
                <ul class="ads" onClick="location.href='../ads/'">광고문의&nbsp;&nbsp;&middot;</ul>
                <ul class="Carecenter" onClick="location.href='../support/'">고객센터&nbsp;&nbsp;&middot;</ul>
            
            </div>

            <div class="left">Funsumer © 2013</div>
        
        </div>
    
    </div> <!--// copyright -->

</div> <!--// Wrapbox -->

<script>
$(window).load(function() {
	mCustomScrollbars();
});

function mCustomScrollbars(){
	$("#invite-party-contents").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","no",10); 
	$("#invite-member-contents").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","no",10); 
	$("#alarm-message-contents").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","no",10);
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
