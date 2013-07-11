<?
	session_start();	
	$id = $_COOKIE["usercookie"];						
    if(!$id)
    {
	    $id = $_SESSION['userid'];	    
    }
    if(!$id)
    {
	    echo("<script> top.location.href='../index.php'; </script>");
    }
	
	include "../dbconn.php";


	$eventnumber = $_POST['eventnumber'];
	if(!$eventnumber){
		echo("<script> top.location.href='../party/'; </script>");
	}
	//////////// 이름 얻기 : me 는 로그인한 세션의 정보
	$sql = "select * from member m where m.id='$id'";
	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result);
	$me = mysql_fetch_array($result);
	$j_me = json_encode($me);	
	
	if($eventnumber==3){
		$time = '2013-06-21 00:00:00';
	}
	else{
		$time = '2013-06-14 00:00:00';
	}
	$t = strtotime($time);     
	$interval = $t - time();
	
	$sql = "select target from event where event_num='$eventnumber'";
	$result = mysql_query($sql,$connect);
	$oo = mysql_fetch_array($result);
	
	$sql = "select*from member where university='$oo[0]' and gender='2'";
	$result = mysql_query($sql,$connect);
	$rows = mysql_num_rows($result);
	$counts = 0;
	
	$sqll = "select NOW();";
	$resultl = mysql_query($sqll,$connect);
	$current_now = mysql_fetch_array($resultl);
	$current_day = explode(" ",$current_now[0]);
	$devi_day = explode("-",$current_day[0]);
			
	for($i=0;$i<$rows;$i++){
		mysql_data_seek($result,$i);
		$row = mysql_fetch_array($result);
		
		$sqll = "select*from friend_vote where to_mem='$row[4]' and time > '2013-06-07'";
		$resultl = mysql_query($sqll,$connect);
		$vote = mysql_num_rows($resultl);
		$ii = $vote;
		
		if($row[4]!=1 && $ii!=0 && $row[4]!=3 && $row[4]!=5 && $row[4]!=2){
			$f_id[$counts] = $row[4];
			$f_name[$counts] = $row[0];
			$f_pic[$counts] = $row[11];
			
			$sqll = "select*from friend_vote where to_mem='$row[4]' and time > '2013-06-07'";
			$resultl = mysql_query($sqll,$connect);
			$vote = mysql_num_rows($resultl);
			$f_vote[$counts] = $vote;
			
			$sqll = "select time from friend_vote where from_mem='$id' and to_mem='$row[4]' order by time desc";
			$resultl = mysql_query($sqll,$connect);
			$a = mysql_num_rows($resultl);
			if($a){
				mysql_data_seek($resultl,0);	
				$dbtime = mysql_fetch_array($resultl);
				$db_time = explode("-",$dbtime[0]);
				
				if($dbtime[0]==$current_day[0]){
					$f_voted[$counts] = 0;
				}
				else{
					$f_voted[$counts] = 1;
				}				
			}//if
			else{
				$f_voted[$counts] = 1;
			}
			$counts++;
		}//if
	}//for
	
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
				
				$temp = $f_voted[$i];
				$f_voted[$i] = $f_voted[$j];
				$f_voted[$j] = $temp;
			}
		}		
	}
	
	$j_fid = json_encode($f_id);
	$j_fname = json_encode($f_name);
	$j_fpic = json_encode($f_pic);
	$j_fvote = json_encode($f_vote);
	$j_fvoted = json_encode($f_voted);
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
        <link rel="stylesheet" type="text/css" href="../css/event2/event2.css">

        <script type="text/javascript" src="../js/common/Base.js"></script>
        <script type="text/javascript" src="../js/event2/event2.js"></script>
        <script type="text/javascript" src="../js/wassup/wvari.js"></script>
        <script type="text/javascript" src="../js/common/board.js"></script>
        <script type="text/javascript" src="../js/common/Fullscreen.js"></script>
        <script type="text/javascript" src="../js/ajax.js"></script>
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
        <script language="javascript">
			var me = eval('(<?=$j_me?>)');
			
			var numbers = <?=$counts?>;
			var fid = eval('(<?=$j_fid?>)');
			var fname = eval('(<?=$j_fname?>)');
			var fpic = eval('(<?=$j_fpic?>)');
			var fvote = eval('(<?=$j_fvote?>)');
			var fvoted = eval('(<?=$j_fvoted?>)');
			var evnum = <?=$eventnumber?>;
		</script>

</head>

<body onload="DisplayVoteRanking();alarm();invmeparty();reqfriend();showCountdown(<? echo $interval; ?>);">
<div id="body_gradient"></div>

<div id="fullscreen_bg"></div>
<div id="win_alarm">
    
</div>
    <div id="header">
    
   		<div class="nav pie">
        	<ul class="logo"><img src="../images/party/Header/header_logo.png" height="16" alt="" /></ul>
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
                    <div class="pic"><img src="../<? echo $me[profilepic]; ?>" alt="" /></div>
                    <div class="button">
                        <div class="friends nanumbold"><a onClick="post_to_url('../../note/',{'friend':1});">친구목록</a></div>
                        <div class="partys nanumbold"><a onClick="post_to_url('../../party/',{});">파티목록</a></div>
                    </div> <!--// button -->
                </div> <!--// right -->

                <div class="explain">휘경여자고등학교의 얼짱을 뽑을 수 있는기회!<br>
우리학교의 최고의 얼짱,인기짱을 뽑아주세요!<br>
투표기간은 06.08 ~ 06.12 까지!
				</div>
                
            </div> <!--// info -->

            <div class="vs">
            

            </div> <!--// vs -->
            
            <div class="ranktitle">
            	 인기투표 현황 및 순위
            </div> <!--// ranktitle -->
            
            <div id="voterank" class="rank">
            
            	
            </div> <!--// rank -->
        	
        </div> <!--// partylist -->

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
