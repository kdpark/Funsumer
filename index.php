<?
session_start();
	$id = $_SESSION['userid'];
	if($id)
	{
		echo(" <script> top.location.href='login.php'; </script> ");
	}	
	$id = $_COOKIE["usercookie"];
	if($id)
	{
		echo(" <script> top.location.href='login.php'; </script> ");
	}
	$mobile = $_POST['mobile'];
	if(!$mobile) $mobile=0;
	$bgnum = 1;	// bgnum이라는 변수를 1~3까지 랜덤하게 골라준다.
	//jquery.js
	//index.js
	//placeholder.js
	$er = $_POST['er'];
	$ed = $_POST['ed'];
	$name = $_POST['name'];
	$name2 = $_POST['name2'];
	$name3 = $_POST['name3'];
	$var2 = $_POST['var2'];
?>
<!doctype html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="Author" content="Funsumer" />
	<meta name="viewport" content="width=960" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7, IE=9" />
      
    <title>FUNSUMER</title>

    <link rel="stylesheet" type="text/css" href="css/index/index.css" />
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    
    <script src="js/jquery.js"></script>
    <script src="js/index/index.js"></script>
    <script src="js/placeholder.js"></script>
    <script src="js/PKASDFJVNASJE.js"></script>
    <script type="text/javascript">
	var mobile = <?=$mobile?>;
	if(mobile==0){
		var UserAgent = navigator.userAgent;
		if (UserAgent.match(/iPhone|iPod|Android|Windows CE|BlackBerry|Symbian|Windows Phone|webOS|Opera Mini|Opera Mobi|POLARIS|IEMobile|lgtelecom|nokia|SonyEricsson/i) != null || UserAgent.match(/LG|SAMSUNG|Samsung/) != null)
		{
		  //location.href = "market://details?id=www.funsumer.net";
		  location.href="http://funsumer.net/mobile/";
		}
		else
		{
		
		}
	}
</script>
     <!--<script type="text/javascript">
	 var MBIZHDNLS = new Array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson');for (var word in MBIZHDNLS){ if (navigator.userAgent.match(MBIZHDNLS[word]) != null){ location.href = "http://funsumer.net/mobile";break;}}
    </script>-->
    
    <!--[if  lt IE 9]>
    <style>
   		.loginbutton input { border: none !important; box-shadow: 0 0px 3px #000 !important }
        html { overflow-x: hidden }
    </style>
        <link rel="stylesheet" type="text/css" href="../css/common/For_IE8_common.css">
        <script src="../js/IE8.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/note/For_IE8_note.css">
        <script src="../js/IE8.js"></script>
    <![endif]-->
    <style>
	#chromeinstall { display: none }
	</style>
    
    <script language="javascript">
	function CKJOANVLXJ(){	document.getElementById('name').value = '<? echo $name ?>'; document.getElementById('name2').value = '<? echo $name2 ?>'; document.getElementById('name3').value = '<? echo $name3 ?>';}
	function OAJDNVKA(){ document.getElementById('textfield').value='<? echo $ed ?>'; };		
	</script>
    
</head>

<body onLoad="<? if($er){ echo "chg('loginimg', 'loginspace', 'login');"; } else if($var2){ echo "chg('registerimg','registerspace','register');"; } ?><? if($var2){ echo "CKJOANVLXJ()"; } ?> document.loginform.textfield.focus()">
<div id='chromeinstall'>펀슈머에서 지원하지 않는 브라우저입니다. 더 나은 서비스를 위해 <a href="https://www.google.com/intl/ko/chrome/browser/features.html">Chrome</a>을 설치해 주세요.</div>

<div class="logo">
	<img src="images/index/logo.png" alt="" />
</div>

<div class="header">
	<img src="images/index/headerbg2.jpg" alt="" />
    <div class="explain"></div>
    
    <div class="login">
    <form name="loginform" method='post' action="login.php">
    	<div class="id"><input class="text" type="text" name="textfield" id="textfield" placeholder="Email"/></div>
        <div class="password"><input class="text" type="password" name="textfield2" id="textfield2" placeholder="Password" /></div>
        <div class="button"><input class="button" type="submit" value="로그인"/></div>
        <div class="whiteline"></div>
        
		<script>
            $('input[placeholder], textarea[placeholder]').placeholder();
        </script>
        
    </form> <!--// login form -->
        
    </div>

	<? if($er==1){ echo "<div class=\"error\">이메일과 비밀번호를 입력하세요.<div class=\"arrow\"></div></div><script>OAJDNVKA();</script>"; } else if($er==2){ echo "<div class=\"error\">이메일과 비밀번호를 확인하세요.<div class=\"arrow\"></div></div><script>OAJDNVKA();</script>"; } ?>

    <div class="join">
        <form name="regiform" method='post' action="register.php">
        <div onClick="location.href='/signup/'">아직 회원이 아니세요? 펀슈머에 가입해 보세요!</div>
        </form> <!--// join form -->
    </div>
    
    <div class="find">이메일 혹은 비밀번호를 잊어 버리셨나요?</div>
    
    <div class="find1">혹시 문의할 일이 있으신가요??</div>
    
</div> <!--// header -->

<div class="container">

	<div class="contents">
	
    	<div class="app">
        	<div class="contents">
                <div class="left">
                    <div class="icon"></div>
                </div>
                <div class="right">
                    <div class="ex"></div>
                    <div class="googleplay"><a href="https://play.google.com/store/apps/details?id=www.funsumer.net&feature=search_result#?t=W251bGwsMSwyLDEsInd3dy5mdW5zdW1lci5uZXQiXQ.."><img src="images/index/googleplay.png" height="70" alt="" /></a></div>
                </div>
            </div> <!--// contents -->
        </div> <!--// 0524 -->
	
    	<div class="explain">
        	<div class="pic">
            	<div class="overflow">
                    <div class="ex1"></div>
                    <div class="ex2"></div>
                    <div class="ex3"></div>
                </div> <!--// overflow -->
            </div> <!--// pic -->
        </div> <!--// explain -->
    </div> <!--// contents -->
    


    
    <div class="copyright">
    
        <p>
        <a href="./legal/" onFocus="blur()">이용약관</a> │ <a href="./privacy/" onFocus="blur()">개인정보 취급방침</a> │ <a href='./ad/'>광고문의</a> │ <a href='./support/' onFocus="blur()">고객센터</a><br>
        Copyright&nbsp; &copy; <a href="http://www.funsumer.net"> Funsumer </a> All rights reserved</p>
        
    </div>

</div> <!--// container -->

</body>
</html>