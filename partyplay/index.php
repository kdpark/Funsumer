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
	$partyid = $_POST['partyid'];

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
	
	if(!$partyid){
		echo "<script> alert('데이터가 올바르게 전송되지 않았습니다'); location.href='../party'; </script>";
	}
		
	// user 로 띄워줌 : 요청한 페이지 id 정보
	$sql = "select * from member m where m.id='$mynoteid'";
	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result);
	$user = mysql_fetch_array($result);
	$j_user = json_encode($user);
	
	// user 가 가입한 파티
	$sql = "select p.pname, p.id, p.pic, j.visit_count from partyjoin j, party p where j.member_id='$user[id]' and j.party_id = p.id order by visit_count desc";
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
		
	}	
	for($i=$NumberOfParty;$i<6;$i++)
	{
		$party[$i] ="";
		$arrPartyid[$i] = 0;
	}
	
	$j_partyname = json_encode($party);
	$j_partyid = json_encode($arrPartyid);
	$j_partypic = json_encode($parpic);

	//페이지 여부
	$isthismypage = 0;
	if($id == $mynoteid)
	{
		$isthismypage = 1;	
	}
	
	$sql = "select*from party_join where mem='$id' and party='$partyid'";
	$result = mysql_query($sql,$connect);
	$pj = mysql_num_rows($result);	
	
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
		
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
          
        <title>FUNSUMER</title>
        <script src="../js/ajax.js"></script>
        <script type="text/javascript"src="../js/jquery.js"></script>
        <script type="text/javascript"src="../js/jquery-ui.js"></script>
        <script type="text/javascript"src="../js/placeholder.js"></script>
        <script type="text/javascript" src="../js/Scrollbar/easing.js"></script>
        <script type="text/javascript" src="../js/Scrollbar/mousewheel.js"></script>

        <link rel="stylesheet" type="text/css" href="../css/common/Base.css">
		<link rel="stylesheet" type="text/css" href="../css/common/Board.css">
        <link rel="stylesheet" type="text/css" href="../css/common/Fullscreen.css">
        <link rel="stylesheet" type="text/css" href="../css/common/Scrollview.css">
        <link rel="stylesheet" type="text/css" href="../css/partyplay/Partyplay.css">
		<link rel="stylesheet" type="text/css" href="../css/partyplay/Infomation.css">

        <script type="text/javascript"src="../js/common/Base.js"></script>
		<script type="text/javascript"src="../js/common/Board.js"></script>
        <script type="text/javascript"src="../js/common/Fullscreen.js"></script>
        <script type="text/javascript"src="../js/common/Buttons.js"></script>
        <script type="text/javascript"src="../js/partyplay/Partyplay.js"></script>
        <script type="text/javascript"src="../js/partyplay/PartyPlayScript.js"></script>
        <script type="text/javascript"src="../js/partyplay/pvari.js"></script>
        
       <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="css/main-party-IE.css">
        <![endif]-->
        
        <!--[if IE 9]>
        <link rel="stylesheet" type="text/css" href="../css/common/For_IE9.css">
        <![endif]-->
        
												        <!--// IE9 under-->        
        <!--[if  lt IE 9]>
        <link rel="stylesheet" type="text/css" href="../css/common/For_IE8_common.css">
        <script src="../js/IE8.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/party/For_IE8_account.css">
        <script src="../js/IE8.js"></script>
		
        <![endif]-->
		 <script language="javascript">
		//php set variables
			/*var u_partyname = eval('(<?=$j_partyname?>)');
			var u_partyid = eval('(<?=$j_partyid?>)');
			var u_partypic = eval('(<?=$j_partypic?>)');
			var u_partynum = <?=$NumberOfParty?>;*/
			var me = eval('(<?=$j_me?>)');
			var user = eval('(<?=$j_user?>)');			
			var isthismypage = <?=$isthismypage?>;
			var partyid = <?=$partyid?>;
			var pj = <?=$pj?>;
			var mynoteid = <?=$mynoteid?>;	
			var note=2;		
		</script>
</head>

<body onLoad="Upartyload();LoadPartyInfo();Popsumer();LoadArticle();alarm();invmeparty();reqfriend();visitquery();">
<div id='chromeinstall'>펀슈머에서 지원하지 않는 브라우저입니다. 더 나은 서비스를 위해 <a href="https://www.google.com/intl/ko/chrome/browser/features.html">Chrome</a>을 설치해 주세요.</div>

<div id="ScrollTop">Scroll <br>to Top</div> <!--// 0420 스크롤탑 -->
<iframe src="../imgiframe.php" style="display:none;" id="imgiframe"></iframe>
<div id="loaderDiv"><img src="../loading/1.gif" alt="" id="loadimg" /></div>

<div id="fullscreen_bg"></div>
<div id="win_alarm">
    
</div>
<div id="partyadminpage">
    
    <div class="power">
        <div class="contents">
        
            <div class="header">
            	<div class="title">파티 권한 설정하기</div>
                <div class="close">취소하기</div>
                <div class="save">설정 저장하기</div>
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
                            <div class="off"><h1>비공개</h1>를 선택하시면 파티명이 검색되지 않고, 파티 회원 이외에 유저에겐 노출 되지 않습니다.<br>가입은 파티쉐가 유저에게 초대장을 보내면 할 수 있습니다.</div>
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
        
        </div>
    </div><!--// power -->
    
    <div class="member">
        <div class="contents">
        
            <div class="header">
            	<div class="title">파티 멤버들 관리하기</div>
                <div class="close">닫기</div>
            </div> <!--// header -->
    
            <div class="container">                                                
                <div id="partyadmin_member_container">
                    <div class="ScrollBox">
                        <div class="container">
                        
                            <div class="content">
                            
                                <div class="searcharea">                         
                                    <div class="search">
                                        <div class="ico-search"><img src="../images/party/Container/searchmember.png" width="14" height="14" alt="" /></div>
                                        <div class="text-search"><input type="text" id="member_sch" placeholder="멤버검색" onKeyUp="memberlist_search(this);"/></div>
                                    </div>
                                </div>
                                
                                <div class="listwrap">
                                    <div class="noresult">검색결과가 없습니다.</div>
                                                                       
                                </div> <!--// listwrap -->
                                
                            </div> <!--// content -->
                        </div> <!--// container -->
                        <div class="dragger_container">
                            <div class="dragger"></div>
                        </div>
                    </div> <!--// scrollBox -->
                </div> <!--// Partyadmin_member_container -->
            </div> <!--// container -->
        </div> <!--// contents -->
    </div><!--// member -->
    
    <div class="request">
        <div class="contents">
        
            <div class="header">
            	<div class="title">가입 승인요청 관리하기</div>
                <div class="close">닫기</div>
            </div> <!--// header -->
            
            <div class="container">
            
                <div id="partyadmin_invite_container">
                    <div class="ScrollBox">
                        <div class="container">
                        
                            <div class="content">
                                
                                <div class="listwrap">
                                <div class="noinvite">가입요청이 없습니다.</div>
                                    
                                    
                                </div> <!--// listwrap -->
                                
                            </div> <!--// content -->
                        </div> <!--// container -->
                        <div class="dragger_container">
                            <div class="dragger"></div>
                        </div>
                    </div> <!--// scrollBox -->
                </div> <!--// Partyadmin_invite_container -->
            
            </div> <!--// container -->
        
        </div> <!--// contents -->
    </div><!--// invite -->
    
</div> <!--// partyadminpage --> <!-- 0411 -->

<div id="win_friend_invite">
	<div class="container pie">
    	<div class="title">
        	<div id="Invite_Num_Text" class="text">0&nbsp;명에게 초대장을 보냅니다.</div>
            <div class="Button2_red right">Send It
            	<div class="Button2_red_word" onClick="invitefriendtomyparty();">Send It</div>
            </div>
        </div>
        <div class="contents">
        
           
            
        </div> <!--// contents -->
    </div> <!--// container -->
</div> <!--// win_friend_invite -->

<div id="win_anounce_original">
	
</div> <!--// win_anounce_original -->

<div id="win_board_original">
    
</div> <!--// win_board_original -->

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
        </div>
        
        <div class="Tap2">
            <div class="mynote"><img src="../images/base/tap2_mynote.png" width="20" alt="" title="마이노트" /></div>
            <div class="myparty"><img src="../images/base/tap2_mypartylist.png" width="20" alt="" title="마이 파티리스트"/></div>
        </div>
        
    </div> <!--// Header -->
      
    <div class="gapbackground"></div>
    
    <div id="container">
    
    	<div class="party">
        	<div class="title ">
            	<ul class="pname"></ul>
                <ul class="pregi Button_red" style="display:none;" onClick="if(confirm('파티에 가입하시겠습니까?')){ partyjoinquery(); }">
                파티&nbsp;가입하기
                <li class="Button_red_word">파티&nbsp;가입하기</li>                
                </ul>
            </div> <!--// party > title -->
            
<Div class="info_area">
            
            <div class="pic ">	            
            		<div class="scrollbasepic">
                    	<div id="box">
                        	<div id="boxok" style="display:none; text-align:center; position:absolute; width:200px; height:20px; top:100px; left:324px; background-color:#FFF; opacity:0.5; color:#00F; z-index:10;" onClick="ysubmit();">
                            	완료하려면 클릭하세요
                            </div>
                        </div>
                    </div>
                    
                    <div class="basepic">    
                    
                        <div class="setting">
                            <div class="ico Onoff_basepic_setting_ico_menu">
                                <img src="../images/partyplay/settingbutton.png" width="30" alt="" />
                                <div class="explain explain_pop"><h1>파티 설정버튼</h1>입니다.<br>커버사진도 바꾸고, 권한도 설정 할 수 있습니다.</div>
                            </div>
                            <div class="menu">
                            	<div class="request">가입 승인요청 관리하기</div>
                                <div class="member">가입한 멤버들 관리하기</div>
                                <div class="power">파티 권한 설정하기</div>
                                <div class="cover">커버 사진 수정하기</div>                            	
                            </div>
                        </div> <!-- 0411 -->

                        <div class="invite_friend explain_pop">
                            <div class="text">이 파티에 <h1><a>친구들을 초대해보세요!</a></h1> <br>파티가 더욱 즐거워 집니다!</div>
                            <div class="close">X</div>
                        </div> <!-- 0411 -->
                                 
                    </div> <!--// basepic -->
                    
                    <div class="party_title"> 
                    	<div class="party_name">파티명 : <h1></h1></div>
                        <div class="partyssier">파티쉐 : <h1></h1></div>
                        <div class="member">멤버 : <h1>0</h1>명</div>
                        <div class="since">Created By <h1></h1></div>
                        <div class="join Button_red_9pt before_click">파티 가입하기</div>
                    </div> <!-- 0411 -->
                
            </div> <!--// party > pic -->
            
            <div class="info">
            	<div class="title">
                	<div class="relation">
                    	<div class="title"></div>
                        <div class="contents">자유로운 파티 활동으로 Relation을 늘려 보세요!</div>
                    </div> <!-- relation -->
                    <div class="since">
                    	<div class="title"></div>
                        <div class="contents"></div>
                    </div> <!--// since -->
                    <div class="member">
                        <div class="img"></div>
                        <div id="P_Mem_Num" class="number"></div>
                    </div>
                    <div class="writing">
                        <div class="img"></div>
                        <div id="P_Ar_Num" class="number"></div>
                    </div>
                </div> <!--// party > info > title -->
                <div class="contents">
                	<div class="popularpeople">
						<div class="title">
                        	<div class="img">스타슈머</div>
							<div class="questionmark Onoff_starsumer_questionmark">?</div>
                            
                                <div class="pop explain_pop">				<!--// ? :: 팝업창 -->
 
 									<div class="text">
                                       <h1>스타슈머!</h1> 인기쟁이들!<br>
                                       파티내에서 가장 인기 있는 사람들입니다.<br>
                                       많은 친구들과 인기투표를 통해,<br>
                                       <h1>스타슈머</h1>에 도전해 보세요!
                                   	</div>
                                    
                                    <div class="close">X</div>
                                
                                </div> <!--// pop -->
                                        
                            <div class="date">★</div>
                        </div>
                        <div class="contents">
                        	<div class="male pie ppevent">
                            	<div class="nonexist"></div>
                                <div class="exist">
                                    <div class="pic">
                                    	<img src="" width="158" height="158" alt="" />
                                    	<div class="namebg"></div>
                                        <div class="nametext pie">
                                        	<div class="img"><img src="../images/party/Container/ppexmale.png" alt=""></div>
                                            <div class="name"></div>
                                        </div>
                                    </div>
                                    <div class="score">
                                    	<img src="../images/party/Container/heart.png" alt=""/> 
                                    </div>
                                </div>
                            </div>
                            <div class="female pie ppevent">
                            	<div class="nonexist"></div>
                                <div class="exist">
                                    <div class="pic">
                                    	<img src="" width="158" height="158" alt="" />
                                    	<div class="namebg"></div>
                                        <div class="nametext pie">
                                        	<div class="img"><img src="../images/party/Container/ppexfemale.png" alt="" /></div>
                                            <div class="name"></div>
                                        </div>
                                    </div>
                                    <div class="score">
                                    	<img src="../images/party/Container/heart.png" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!--// pouplarpeople -->
                    <div class="member">
                    	<div class="title">
                        	<div class="img">파티에 가입한 멤버들</div>
                            <div class="more">more</div>
                        </div> <!-- 0411 -->
                        <div class="contents">
                        	
                        	<div id="Party_Members_0">								
                            	<div class="name_position">
                                	<div class="name pie"></div>
                                    <div class="arrow"></div>
                                </div>
                            </div>

                        	<div id="Party_Members_1">								
                            	<div class="name_position">
                                	<div class="name pie"></div>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                            
                        	<div id="Party_Members_2">
                            	<div class="name_position">
                                	<div class="name pie"></div>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                            
                        	<div id="Party_Members_3">
                            	<div class="name_position">
                                	<div class="name pie"></div>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                            
                        	<div id="Party_Members_4">
                            	<div class="name_position">
                                	<div class="name pie"></div>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                            
                        	<div id="Party_Members_5">
                            	<div class="name_position">
                                	<div class="name pie"></div>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                            
                        	<div id="Party_Members_6">
                            	<div class="name_position">
                                	<div class="name pie"></div>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                            
                        	<div id="Party_Members_7">
                            	<div class="name_position">
                                	<div class="name pie"></div>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                            
                        	<div id="Party_Members_8">
                            	<div class="name_position">
                                	<div class="name pie"></div>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                            
                        	<div id="Party_Members_9">
                            	<div class="name_position">
                                	<div class="name pie"></div>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                            
                        	<div id="Party_Members_10">
                            	<div class="name_position">
                                	<div class="name pie"></div>
                                    <div class="arrow"></div>
                                </div>
                            </div>
                                                    	
                        </div> <!--// contents -->
                    </div> <!--// members -->
                    <div class="anounce">
                        <div class="title">
                            <div class="img">파티 공지사항</div>
                            <div class="more">more</div>
                        </div> <!-- 0411 -->
                        <div id="anounce_contents" class="contents">
                            <div class="nonexist">파티에 공지글을 올려보세요.</div>
                            <div class="exist">
                            
                                <div class="subtitle text-color-chg2"></div>
                                <div class="info">
                                	<div class="time"></div>                                   
                                </div>
                                
                            </div> <!--// exist -->
                            
                        </div> <!-- contents -->
                        
                    </div> <!--// anounce -->
                </div>	<!--// party > info > contents -->
                <div class="footer"></div> <!--// party > info > footer -->
            </div> <!--// party > info -->

</Div> <!--// info_area --> 

		<div id="info_memberpage">

			<div class="header">
            	<div class="img"></div>
            </div>
            
            <div class="contents">
            	<div class="title">
                	 <div class="back"></div>
                     <div class="text">
                    	이 파티에 <h1><a>친구들을 초대해보세요!</a></h1> 파티가 더욱 즐거워 집니다!
                    </div>
                </div>
                
                <div class="subtitle">
                	<div class="title">파티에 가입한 멤버 전체보기</div>
                    
                    <div class="search">
                        <div class="ico-search"><img src="../images/party/Container/searchmember.png" width="14" height="14" alt="" /></div>
                        <div class="text-search"><input type="text" placeholder="멤버검색" id="friendlist_sch" onKeyUp="friendlist_search(this);"/></div>
                    </div>
                </div>
               
                <div id="Party_MemberList_All" class="container">                
                	
                    <!--*************************************************************************파티 멤버 목록 전체보기*********************************************************-->
                    
                </div> <!--// container -->
                
            </div> <!-- contents -->

        </div> <!--// info_memberpage -->
        
        
        
        
		<div id="info_anouncepage">

			<div class="header">
            	<div class="img"></div>
            </div>
            
            <div class="contents">
            	<div class="title">
                	<div class="back"></div>
                    <div class="text">
                    	작은 소모임, 각종 중요한 정보들을 한눈에 보여주세요!, 파티쉐가 파티원에게 직접 공지권한을 줄 수도 있습니다.
                    </div>
                </div>
                <div class="container">
					<div class="Rfield">
                    	<div class="contents" id="anounce_container">
	                    </div>
                    </div>                	
                </div> <!--// container -->
                
            </div> <!-- contents -->

        </div> <!--// info_anouncepage -->
        
        
        

        </div> <!-- //party -->
        
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
                    이 파티에 포스팅 된 글 보기
                </div>
            	<div class="write">
                	<div class="title">
                    	<div class="top"></div>
                        <div class="mid"><input type="text" placeholder="제목 추가 ..."/></div>
                        <div class="bot"></div>
                    </div> <!--// title -->
                    <div class="contents">
                    	<div class="top"></div>
                        <div class="mid">
                        	<textarea placeholder="포스트 작성하기..."></textarea>
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
                            	<li alt="2"><img src="../images/board/nonechecked.png" alt="" />멤버 공개</li>
                            </div> <!--// menu -->
                        </div> <!--// publicsetting --> <!-- 0507 -->
                    </div> <!--// buttons -->
                    
                    <div class="cameraspace">
                    
                    	<div class="photopart">
                        	<div class="photo">
                            	<div class="photo1 photos">
                                	<div class="img"><img src="" height="100%"alt="" /></div>
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
                                <div class="addphoto"  onClick="tempimageupload();"></div>
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
        
    <div id="wrapBoxfooter"></div> <!--// footer -->

	<div id="for_IE8"></div>

</div> <!--// Wrapbox -->

<script>
$(window).load(function() {
	mCustomScrollbars();
});

function mCustomScrollbars(){
	$("#alarm-message-contents").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","no",10);
	$("#invite-party-contents").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","no",10); 
	$("#invite-member-contents").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","no",10); 	
	$("#partyadmin_invite_container").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","yes",10);
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
