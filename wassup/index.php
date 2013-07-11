<? session_start();						
	$id = $_COOKIE["usercookie"];						
    if(!$id)
    {
	    $id = $_SESSION['userid'];	    
    }
    if(!$id)
    {
	    echo("<script> top.location.href='../index.php'; </script>");     
    }

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
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <script type="text/javascript" src="../js/placeholder.js"></script>
        <script type="text/javascript" src="../js/Scrollbar/easing.js"></script>
        <script type="text/javascript" src="../js/Scrollbar/mousewheel.js"></script>

        <link rel="stylesheet" type="text/css" href="../css/common/Base.css">
		<link rel="stylesheet" type="text/css" href="../css/common/Board.css">
        <link rel="stylesheet" type="text/css" href="../css/common/Fullscreen.css">
        <link rel="stylesheet" type="text/css" href="../css/common/Scrollview.css">
        <link rel="stylesheet" type="text/css" href="../css/wassup/Wassup.css">

        <script type="text/javascript" src="../js/common/Base.js"></script>
		<script type="text/javascript" src="../js/common/Board.js"></script>
        <script type="text/javascript" src="../js/common/Fullscreen.js"></script>
        <script type="text/javascript" src="../js/common/Buttons.js"></script>
        <script type="text/javascript" src="../js/wassup/Wassup.js"></script>
        <script src="../js/wassup/wvari.js"></script>
        <script language="javascript">
		//php set variables			
			var me = eval('(<?=$j_me?>)');			
			var note=3;				
		</script>
        <!--[if IE 9]>
        <link rel="stylesheet" type="text/css" href="../css/common/For_IE9_common.css">
		<link rel="stylesheet" type="text/css" href="../css/wassup/For_IE9_wassup.css">
        <![endif]-->
        
												        <!--// IE9 under-->        
                <!--[if  lt IE 9]>
        <link rel="stylesheet" type="text/css" href="../css/common/For_IE8_common.css">
        <script src="../js/IE8.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/party/For_IE8_account.css">
        <script src="../js/IE8.js"></script>
		
		<style>
			#header { top: 40px !important }
			#wrapbox { top: 80px }
		</style>
		
        <![endif]-->

</head>

<!-- <body onLoad="LoadArticle();frkloading();loadwassupinfo();alarm();invmeparty();reqfriend();">  frkloading -->
<body onLoad="LoadArticle();loadwassupinfo();alarm();invmeparty();reqfriend();">

<div id='chromeinstall'>펀슈머에서 지원하지 않는 브라우저입니다. 더 나은 서비스를 위해 <a href="https://www.google.com/intl/ko/chrome/browser/features.html">Chrome</a>을 설치해 주세요.</div>

<div id="ScrollTop">Scroll <br>to Top</div> <!--// 0420 스크롤탑 -->
<div id="body_gradient"></div>

<div id="fullscreen_bg"></div>
<div id="win_alarm">
    
</div>
<div id="win_board_original">
    
</div>

<div id="header">
    <div class="nav pie">
        <ul class="logo"><img src="../images/party/Header/header_logo.png" height="16" alt="" style="cursor:pointer" onClick="<? if($evnum!=0){ echo "post_to_url('../event/',{'eventnumber':$evnum});"; }else{ echo "post_to_url('../party/',{});"; } ?>" /></ul>
        <ul class="nav-menu">
            <li class="nav-party">
                wassup
                <li class="SDT-party">wassup</li>
                <li class="SDD-party">wassup</li>                    
            </li>
            <li class="nav-note">
                note
                <li class="SDT-note">note</li>
                <li class="SDD-note">note</li>                    
            </li>
            <li class="nav-wassup">
                party
                <li class="SDT-wassup">party</li>
                <li class="SDD-wassup">party</li>                    
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
	
       <div class="topline"></div> <!-- 0429 -->
	
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

<div id="wrapbox" class="pie">
    
    <div id="container">

        <div class="headline">
            <div class="pic pie"><img src="../" alt="" class="pie" /></div>
            <div class="namediv nanumbold pie">
                <div class="name"></div>
                <div class="img"><img src="../images/wassup/arrowD.png"></div>
            </div>
            <div class="pop nanumbold pie">
                <div class="content pie">
                    <div class="name"></div>
                    <div class="info"></div>
                </div>
            </div>
            <div class="button">
                <div class="friensumer Button_gray position">마이 팬슈머
                <div class="Button_gray_word">마이 팬슈머</div>
                </div>
                <div class="friendlist Button_gray">친구목록
                <div class="Button_gray_word">친구목록</div>
                </div>
            </div>
		</div> <!--// headline -->
        
       	<div class="wholist" style="display:none;">
        	<div class="innerDiv" style="opacity:0">
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
			</div> <!--// innerDiv -->
        </div> <!--// wholist -->
        
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
                
                <div id="board_contents" class="contents">
                
                  <div class="title">
                    포스트 내용보기
                </div>
                  <div id="find_friend" class="posts find_friend">
                        <div class="header">
                        </div> <!--// header -->
                        <div class="container">
	                        <div class="button">
                            	<img src="../images/basic/wassup/facebook.png" width="25" alt="" /><a onClick="facebook();">페이스북 인증하기</a>
                            </div>
                            <div class="text">
                            	페이스북 인증하기를 하시면, 펀슈머에 가입 된 페이스북 친구를 찾을 수 있고<br>
                                페이스북 친구들에게 초대장을 날려 함께 펀슈머를 이용 할 수 있습니다.
                            </div> <!--// text -->
                            
                            <div class="author">새롭게 이빨터는 SNS, 이제 Funsumer 하세요!</div>
                    
                    </div> <!--// container -->
                    
                </div> <!--// find_friend -->          
                    
                </div> <!--//contents -->
                
            </div> <!--// Rfield -->
        
        </div><!--// board -->
        
    </div> <!--// Container -->
            
    <div id="copyright">
    
        <div class="contents">
        
            <div class="right">
    
                <ul class="terms" onClick="location.href='../legal/'">이용약관&nbsp;&nbsp;&middot;</ul>
                <ul class="policy" onClick="location.href='../privacy/'">개인정보 취급방침&nbsp;&nbsp;&middot;</ul>
                <ul class="ads" onClick="location.href='../ad/'">광고문의&nbsp;&nbsp;&middot;</ul>
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
	$("#alarm-message-contents").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","no",10);
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
