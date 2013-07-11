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
	
	// user의 파티목록
	$sql = "select party_id from partyjoin where member_id='$user[id]' order by visit_count desc";
	$result = mysql_query($sql,$connect);
	$p_exa = mysql_num_rows($result);
	
	if($p_exa){
		for($i=0;$i<$p_exa;$i++){
			mysql_data_seek($result,$i);
			$getpinfo = mysql_fetch_array($result);
			$sql2 = "select p.pname, p.id, p.pic from party p where p.id='$getpinfo[0]'";
			$result2 = mysql_query($sql2,$connect);
			$pinfo = mysql_fetch_array($result2);
			$ppartyname[$i] = $pinfo[0];
			$ppartyid[$i] = $pinfo[1];
			$ppartypic[$i] = $pinfo[2];
		}
		$j_ppartyname = json_encode($ppartyname);
		$j_ppartyid = json_encode($ppartyid);
		$j_ppartypic = json_encode($ppartypic);
	}
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Funsumer</title>

<script src="../js/ajax.js"></script>
<script src="../js/party/partypage-vari.js"></script>
<script src="../js/party/partypageScript.js"></script>
<script src="../js/party/partypage-ajax.js"></script>
<script language="javascript">
	var me = eval('(<?=$j_me?>)');
	var user = eval('(<?=$j_user?>)');
	var u_pname = eval('(<?=$j_ppartyname?>)');
	var u_pid = eval('(<?=$j_ppartyid?>)');
	var u_ppic = eval('(<?=$j_ppartypic?>)');
	var u_pnum = <?=$p_exa?>;

</script>
<link rel="stylesheet" type="text/css" href="../css/party/partypage.css">
</head>

<body onLoad="partyload();partyinvite_req();Friendinvite_req();">
<div class="header">
    <div class="header-logo">
        <img src="../images/main-all-logo2.png" alt="" style="cursor:pointer;" onclick="location.href='main-note.php'">
  </div>
    
    <div class="header-contents">
    	<div class="header-contents-contents" id="whatsup">
        	<img src="../images/main-all-header-whatsup.png" alt="" onClick="location.href='main-wassup.php'">
        </div>
        <div class="header-contents-contents header" id="mynote">
        	<img src="../images/main-all-header-note.png" alt="" onClick="post_to_url('main-note.php',{'mynoteid':'<? echo $user[id] ?>'})">
        </div>
        <div class="header-contents-contents" id="party">
        	<img src="../images/main-all-header-party.png" alt="" onClick="post_to_url('partypage.php',{'mynoteid':'<? echo $user[id] ?>'});">
        </div>

    </div>
    
  <div class="header-search pie">
    	<input type="text" id="sch" onKeyUp="searching();">
    	<img src="../images/main-all-search.png" alt="" height="19">
        <div id="sch_r" style="position:absolute; margin-top:20px; width:143px; border:1px solid black; z-index:100; background-color:#FFF;"></div>
    </div>
</div> <!--// header -->

<div class="menubar">
    <div class="menubar-icon">
        <img src="../images/main-all-message.png" alt="" width="22" height="22">
        <div id="message-numbers" class="message-numbers">
        	0
      	</div>
    </div>
    <div class="menubar-icon">
        <img src="../images/main-all-friend.png" alt="" width="22" height="22">
        <div id="fmessage-numbers" class="message-numbers">
        	0
      	</div>
    </div>
    <div class="menubar-icon">
        <img src="../images/main-all-setting.png" alt="" width="22" height="22" onclick="location.href='logout.php'">
    </div>
</div> <!--// container-menubar -->
<div class="container">   
	<div style="margin-left:30px; position:relative;"><img src="../<? echo $user[profilepic] ?>" width="150" height="150"></div> 
    <div style="margin-left:30px; position:relative;"><? echo $user[name] ?></div>
    <div id="Parties">
    	
    </div>
</div>
</body>
</html>
