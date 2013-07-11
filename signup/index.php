<? session_start();
	$id = $_COOKIE["usercookie"];
    if(!$id)
    {
	    $id = $_SESSION['userid'];	    
    }
	
	include "../dbconn.php";
	
	$sql = "select*from event where present='1' order by event_num";
	$result = mysql_query($sql,$connect);
	$rows = mysql_num_rows($result);
	
	$evcount = 0;

	for($i=0;$i<$rows;$i++){
		mysql_data_seek($result,$i);
		$row = mysql_fetch_array($result);
		
		if($i==0){
			$ev[$evcount]=$row[2];
			$evcount++;
		}//if
		else{
			if($ev[($evcount-1)]!=$row[2]){
				$ev[$evcount]=$row[2];
				$evcount++;
			}//if
		}//else
	}//for
	$j_ev = json_encode($ev);	
?>
<!doctype html>
<html>
<head>
        <meta http-equiv="content-type" content="text/html;  charset=utf-8" />
        <meta name="Author" content="Funsumer" />
        <meta name="viewport" content="width=960" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7, IE=9" />
		
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
          
        <title>FUNSUMER</title>
        
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <script type="text/javascript" src="../js/placeholder.js"></script>
        <script type="text/javascript" src="../js/Scrollbar/easing.js"></script>
        <script type="text/javascript" src="../js/Scrollbar/mousewheel.js"></script>

        <link rel="stylesheet" type="text/css" href="../css/common/Base.css">
        <link rel="stylesheet" type="text/css" href="../css/common/Fullscreen.css">
        <link rel="stylesheet" type="text/css" href="../css/common/Scrollview.css">
        <link rel="stylesheet" type="text/css" href="../css/signup/signup.css">

        <script type="text/javascript" src="../js/common/Base.js"></script>
        <script type="text/javascript" src="../js/signup/signup.js"></script>
        <script src="../js/ajax.js"></script>
        <script language="javascript">
			var evcount = <?=$evcount?>;
			var ev =  eval('(<?=$j_ev?>)');
		</script>
        <!--[if IE 9]>
        <link rel="stylesheet" type="text/css" href="../css/common/For_IE9_common.css">
		<link rel="stylesheet" type="text/css" href="../css/signup/For_IE9_signup.css">
        <![endif]-->
        
												        <!--// IE9 under-->        
        <!--[if  lt IE 9]>
        <link rel="stylesheet" type="text/css" href="../css/common/For_IE8_common.css">
        <script src="../js/IE8.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/signup/For_IE8_signup.css">
        <script src="../js/IE8.js"></script>
        <![endif]-->

</head>

<body>
<iframe src="../imgiframe.php" style="display:none;" id="imgiframe"></iframe>
<div id="body_gradient"></div>

<div id="fullscreen_bg"></div>

<div id="wrapbox">
    
    <div id="container">
    
    	<div class="signup z2">
        
        	<div class="title"><img src="../images/signup/title.png" alt="" /></div>
            
            <div class="content">
            
            	<div class="left pie">
                	<img id="picture" src="../images/signup/basepic.png" alt="" />
                	<div class="button nanumbold pie" onClick="uploadpic();">사진 올리기</div>
                </div>
            
            	<div class="right">                
                	
                    <div class="list nobor_u">
                        <div class="text"><input id="email" type="text" placeholder="이메일 주소" class="pie"></div>
                    </div>
                    <div class="list">
                        <div class="text">
                            <div class="text"> <input type="password" id="pass" value="●●●●" class="pie"></div>
                        </div>
                    </div>
                    <div class="list">
                        <div class="text"><input id="name" type="text" placeholder="ex) 홍길동" class="pie"></div>
                        <div class="name nanumbold">
                            <div class="first">
                                <div class="title">Family name</div>
                                <div><input id="ename2" type="text" placeholder="ex) Hong" class="pie"></div>
                            </div>
                            <div>
                                <div class="title">First name</div>
                                <div><input id="ename1" type="text" placeholder="ex) Gildong" class="pie"></div>
                            </div>
                        </div>
                    </div>
                    <div class="list z2">
                        <div class="birth nanumbold">
                            <div>
                            	<div class="input"><input id="year" type="text" class="year pie" placeholder="1992"></div>
                            	<div class="letter">년</div>
                            </div>
                            <div>
                            	<div class="input"><input id="month" type="text" class="month pie" placeholder="10"></div>
                                <div class="letter">월</div>
                            </div>
                            <div>
                            	<div class="input"><input id="day" type="text" class="day pie" placeholder="12"></div>
                                <div class="letter">일</div>
                            </div>
                         </div>
                        <div class="select nanumbold">
                            <ul><label><input id="woman" type="radio" name="sex" value="female">여성</label></ul>
                            <ul><label><input id="man" type="radio" name="sex" value="male">남성</label></ul>
                        </div>
                        <div class="text">
                        	<input type="text" id="univ" class="pie" placeholder="학교...">
                            <div id="school" class="search pie">
                            	<div class="nonlist">검색결과가 없습니다.</div>
                            	
                            </div>
                        </div>
                    </div>
                    <div class="list nobor_d z1">
                    	<div class="agree">
                        	<a href="../legal">이용약관</a>과 <a href="../privacy">개인정보취급방침</a>에 동의 합니다.
						</div>
                        <div class="button">
                            <div class="button Button2_red" onClick="registorquery();">동의하고 시작하기
                                <div class="Button2_red_word">동의하고 시작하기</div>
                             </div>
                        </div>
                    </div>
                </div> <!--// right -->
            </div> <!--// content -->
        
        </div> <!--// signup -->
        
        <div class="lineD z1"></div>

        <div id="copyright">
        
            <div class="contents">
            
            	<div class="left"><a href="http://www.funsumer.net">Funsumer</a> © 2013</div>
            
            	<div class="right">
        
                    <ul class="terms"><a href="../legal">이용약관</a></ul>
                    <ul class="policy"><a href="../privacy">개인정보 취급방침</a></ul>
                    <ul class="ads"><a href="../ad">광고문의</a></ul>
                    <ul class="Carecenter"><a href="../support">고객센터</a></ul>
                
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
