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
        <link rel="stylesheet" type="text/css" href="../css/common/Fullscreen.css">
        <link rel="stylesheet" type="text/css" href="../css/common/Scrollview.css">
        <link rel="stylesheet" type="text/css" href="../css/account/account.css">

        <script type="text/javascript" src="../js/common/Base.js"></script>
        <script type="text/javascript" src="../js/account/account.js"></script>
        <script type="text/javascript" src="../js/common/board.js"></script>
        <script type="text/javascript" src="../js/common/Fullscreen.js"></script>
        <script src="../js/wassup/wvari.js"></script>
        <script language="javascript">
		//php set variables			
			var me = eval('(<?=$j_me?>)');
		</script>
        <!--[if IE 9]>
        <link rel="stylesheet" type="text/css" href="../css/common/For_IE9_common.css">
		<link rel="stylesheet" type="text/css" href="../css/party/For_IE9_party.css">
        <![endif]-->
        
												        <!--// IE9 under-->        
        <!--[if  lt IE 9]>
        <link rel="stylesheet" type="text/css" href="../css/common/For_IE8_common.css">
        <script src="../js/IE8.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/party/For_IE8_party.css">
        <script src="../js/IE8.js"></script>
        <![endif]-->
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

<body onLoad="alarm();invmeparty();reqfriend();">
<div id='chromeinstall'>펀슈머에서 지원하지 않는 브라우저입니다. 더 나은 서비스를 위해 <a href="https://www.google.com/intl/ko/chrome/browser/features.html">Chrome</a>을 설치해 주세요.</div>


<div id="body_gradient"></div>

<div id="fullscreen_bg"></div>
<div id="win_alarm">
    
</div>
<div id="header">
    <div class="nav pie">
        <ul class="logo" style="cursor:pointer;" onClick="<? if($evnum!=0){ echo "post_to_url('../event/',{'eventnumber':$evnum});"; }else{ echo "post_to_url('../party/',{});"; } ?>"><img src="../images/party/Header/header_logo.png" height="16" alt="" /></ul>
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

<div id="wrapbox">
    
    <div id="container">
    
    	<div class="account">
        
        	<div class="title">
            	<div class="img"></div>
                <div class="button Button2_red">Save account
                	<div class="Button2_red_word">Save account</div>
                 </div>
            </div>
            <div class="content">
                <div class="list">
                    <div class="subtitle nanumbold">이메일</div>
                    <div class="text"><? echo $me[2] ?></div>
                </div>
                <div class="list">
                    <div class="subtitle nanumbold">비밀번호</div>
                    <div class="text">
                    	<div class="changepw nanumbold pie">비밀번호 변경하기</div>
                    </div>
                </div>
                <div class="list">
                    <div class="subtitle nanumbold">이름 (한글)</div>
                    <div class="text"><input id="name" type="text" value="<? echo $me[0] ?>" class="pie"></div>
                </div>
                <div class="list">
                    <div class="subtitle nanumbold">이름 (영문)</div>
                    <div class="name nanumbold">
                    	<div class="first">
                            <div class="title">First name</div>
	                        <div><input id="efname" type="text" value="<? $a=explode(" ",$me[1]); echo $a[1]  ?>" class="pie"></div>
                        </div>
                    	<div>
                            <div class="title">Last name</div>
	                        <div><input id="elname" type="text" value="<? echo $a[0] ?>" class="pie"></div>
                        </div>
                    </div>
                </div>
                <div class="list">
                    <div class="subtitle nanumbold">생년월일</div>
                    <div class="birth nanumbold">
                    	<ul><input id="birthy" type="text" class="year pie" value="<? echo substr($me[6],0,4) ?>">년</ul>
                        <ul><input id="birthm" type="text" class="month pie" value="<? echo substr($me[6],5,2) ?>">월</ul>
                        <ul><input id="birthd" type="text" class="day pie" value="<? echo substr($me[6],8,2) ?>">일</ul>
                     </div>
                </div>
                <div class="list">
                    <div class="subtitle nanumbold">성별</div>
                    <div class="select nanumbold">
                    	<ul><label><input id="genderm" type="radio" name="sex" value="0" <? if($me[10]==1){ echo "checked"; } ?>>남성</label></ul>
                        <ul><label><input id="genderw" type="radio" name="sex" value="1" <? if($me[10]==2){ echo "checked"; } ?>>여성</label></ul>
                    </div>
                </div>
                <div class="list">
                    <div class="subtitle nanumbold">학교</div>
                    <div class="text"><input id="univ" type="text" value="<? echo $me[14] ?>" class="pie"></div>
                </div>
                <div class="list">
                    <div class="subtitle nanumbold"></div>
                    <div class="text">
                    	<div id="facebookbtn" class="logout nanumbold pie" onClick="facebook();"><? if($me[17]){ echo "인증완료"; }else{ echo "Facebook 인증하기"; }?></div>
                    </div>
                </div>
            </div> <!--// content -->
        
        </div> <!--// account -->
        
    	<div class="chgpw">
        
        	<div class="title">
            	<div class="img"></div>
                <div class="button Button2_red">Change Password
                	<div class="Button2_red_word">Change Password</div>
                 </div>
            </div>
            <div class="content">
                <div class="list">
                	<div class="row first">
                        <div class="subtitle nanumbold">현재 비밀번호</div>
                        <div class="password">
                        	<input id="p1" type="password" value="" class="pie">
                        </div>
                    </div>
                	<div class="row second">
                        <div class="subtitle nanumbold">새로운 비밀번호</div>
                        <div class="password">
                        	<input id="p2" type="password" value="" class="pie">
                        </div>
                    </div>
                	<div class="row">
                        <div class="subtitle nanumbold">새로운 비밀번호 확인</div>
                        <div class="password">
                        	<input id="p3" type="password" value="" class="pie">
                        </div>
                    </div>
                </div> <!--// list -->
            </div> <!--// content -->
        
        </div> <!--// account -->

        <div id="copyright">
        
            <div class="contents">
            
            	<div class="left">Funsumer © 2013</div>
            
            	<div class="right">
        
                    <ul class="terms" onClick="location.href='../legal/'">이용약관&nbsp;&nbsp;&middot;</ul>
                    <ul class="policy" onClick="location.href='../privacy/'">개인정보 취급방침&nbsp;&nbsp;&middot;</ul>
                    <ul class="ads" onClick="location.href='../ad/'">광고문의&nbsp;&nbsp;&middot;</ul>
                    <ul class="Carecenter" onClick="location.href='../support/'">고객센터&nbsp;&nbsp;&middot;</ul>
                
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
