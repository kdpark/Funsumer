<? session_start();	
	$id = $_COOKIE["usercookie"];						
    if(!$id)
    {
	    $id = $_SESSION['userid'];	    
    }
    if(!$id)
    {
	    echo("
            <script> top.location.href='../index.php'; </script>
		");     
    }
	
	$mynoteid = $_POST['mynoteid'];
	$conorev = $_POST['conorev'];
	if(!$conorev) $conorev = 0;
    if(!$mynoteid)
    {
    	$mynoteid = $id;
    }
	include "../dbconn.php";

	if($mynoteid == $id){
		$isthismypage = 1;
	}
	else{
		$isthismypage = 0;
	}
	
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
	
	// user의 파티목록
	$sql = "select party_id from partyjoin where member_id='$user[id]' order by visit_count desc";
	$result = mysql_query($sql,$connect);
	$p_exa = mysql_num_rows($result);
	
	if($p_exa){
		for($i=0;$i<$p_exa;$i++){
			mysql_data_seek($result,$i);
			$getpinfo = mysql_fetch_array($result);
			$sql2 = "select p.pname, p.id, p.pic, p.p_public from party p where p.id='$getpinfo[0]'";
			$result2 = mysql_query($sql2,$connect);
			$pinfo = mysql_fetch_array($result2);
			$ppartyname[$i] = $pinfo[0];
			$ppartyid[$i] = $pinfo[1];
			$ppartypic[$i] = $pinfo[2];
			$ppublik[$i] = $pinfo[3];
			$sql1 = "select*from partyjoin where member_id='$id' and party_id='$ppartyid[$i]'";
			$rst = mysql_query($sql1,$connect);
			$or[$i] = mysql_num_rows($rst);
		}
		$j_ppartyname = json_encode($ppartyname);
		$j_ppartyid = json_encode($ppartyid);
		$j_ppartypic = json_encode($ppartypic);
		$j_ppublik = json_encode($ppublik);
		$j_or = json_encode($or);
	}
	
	$sql = "select university from member where id='$id'";
	$result = mysql_query($sql,$connect);
	$sch = mysql_fetch_array($result);
	
	$sql = "select*from event where target='$sch[0]' and present='1'";
	$result = mysql_query($sql,$connect);
	$rows = mysql_num_rows($result);
	$row = mysql_fetch_array($result);	
	$evnum = $row[1];
	if($me[14]=='휘경여자고등학교'){
		$evnum = 1;
	}
	
	$sql = "select pname, id, pic, p_public from party";
	$result = mysql_query($sql,$connect);
	$rows = mysql_num_rows($result);
	
	$count = 0;
	
	if($rows){
		for($i=0;$i<$rows;$i++){
			mysql_data_seek($result,$i);
			$pinfo = mysql_fetch_array($result);
			
			$ssql = "select*from partyjoin where party_id='$pinfo[1]' and member_id='$id'";
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
	
	
	$j_con_party_id = json_encode($con_party_id);
	$j_con_party_name = json_encode($con_party_name);
	$j_con_party_pic = json_encode($con_party_pic);
	//$j_frequency = json_encode($frequency);
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
        <link rel="stylesheet" type="text/css" href="../css/party/party.css">

        <script type="text/javascript" src="../js/common/Base.js"></script>
        <script type="text/javascript" src="../js/common/Fullscreen.js"></script>
        <script type="text/javascript" src="../js/party/party.js"></script>
        <script type="text/javascript" src="../js/common/Board.js"></script>
        <script type="text/javascript" src="../js/wassup/wvari.js"></script>
        <script language="javascript">
			var me = eval('(<?=$j_me?>)');
			var user = eval('(<?=$j_user?>)');
			var isthismypage = <?=$isthismypage?>;
			var mynoteid = <?=$mynoteid?>;			
			var conparty_id = eval('(<?=$j_con_party_id?>)');
			var conparty_name = eval('(<?=$j_con_party_name?>)');
			var conparty_pic = eval('(<?=$j_con_party_pic?>)');
			var concount = <?=$count?>;
			var conorev = <?=$conorev?>;
			var u_pname = eval('(<?=$j_ppartyname?>)');
			var u_pid = eval('(<?=$j_ppartyid?>)');
			var u_ppic = eval('(<?=$j_ppartypic?>)');
			var u_ppub = eval('(<?=$j_ppublik?>)');
			var or = eval('(<?=$j_or?>)');
			var u_pnum = <?=$p_exa?>;			
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
			#wrapbox { top: 80px }
		</style>
		
        <![endif]-->

</head>

<body onLoad="partyload();loadpartyinfo();alarm();invmeparty();reqfriend();">
<div id='chromeinstall'>펀슈머에서 지원하지 않는 브라우저입니다. 더 나은 서비스를 위해 <a href="https://www.google.com/intl/ko/chrome/browser/features.html">Chrome</a>을 설치해 주세요.</div>

<div id="body_gradient"></div>

<div id="fullscreen_bg"></div>
<div id="win_alarm">
    
</div>
<div id="win_add_party">
	<div class="container pie">
        <div class="partyname">
        <!--0429--> <div class="title">새로 만들 파티명을 입력해주세요.</div>
            <div class="top"></div>
            <div class="mid"><input type="text" placeholder="Party name ..."/></div>
            <div class="bot"></div>
        </div> <!--// partyname -->
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
<div id="header">
    <div class="nav pie">
        <ul class="logo"><img src="../images/party/Header/header_logo.png" height="16" alt="" style="cursor:pointer;" onClick="<? if($evnum!=0){ echo "post_to_url('../event/',{'eventnumber':$evnum});"; }else{ echo "post_to_url('../party/',{});"; } ?>" /></ul>
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
    
    	<div class="partylist">
        
        	<div class="title">
            	<div class="pic"><img src="../" alt="" class="pie" /></div>
                <div class="namediv nanumbold pie">
                    <div class="name"></div>
                    <div class="img"><img src="../images/wassup/arrowD.png"></div>
                </div>
                <div class="pop nanumbold pie">
                    <div class="content pie">
                        <div class="name"></div>
                        <div class="info"></div>
                    </div>
                </div> <!--// namediv -->
                
				<div id="check_party_div" class="button">
                    <div class="all <? if($conorev==0) echo "selected"; ?>">전체 컨텐츠</div>
                    <div class="my <? if($conorev==1) echo "selected"; ?>">내 파티목록</div>
                </div>
                <div id="nonminebutton" class="Button_red position" style="display:none">
                	<div class="Button_red_word"></div>
                </div>
            </div> <!--// title -->
            <div class="gradient"></div>
            <div class="list">
                
            </div> <!--// list -->
        	
        </div> <!--// partylist -->

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
