<? session_start();						
	$id = $_COOKIE["usercookie"];						
    if(!$id)
    {
	    $id = $_SESSION['userid'];	    
    }
    if(!$id)
    {
	    echo("<script> top.location.href='../'; </script>");     
    }
	
	$setting = $_GET['setting'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><head>  
 <meta http-equiv="content-type" content="text/html;  charset=utf-8" />
 <title>Esc to close</title>  

<script type="text/javascript" src="../js/jquery-1.7.1.min.js" charset="utf-8"></script>  
<script src="../js/ajax.js"></script>
<style>
@import url(http://fonts.googleapis.com/earlyaccess/nanumgothic.css);
html,body { 
			background-image: url(../images/note/directory_bg.png);
			font-size: 62.5%;
			padding: 1.4em;
			margin: 0;
		  }

div 	{ font-family: 'Nanum Gothic', sans-serif; font-weight: bold; text-shadow: 0 1px 1px #fff }

img 	{ border-radius: 4px }

.explain { width: auto; height: auto; font-size: 3em; color: #777; float: none; margin: 0 0 1em; display:none; }
.list 	{ width: auto; height: auto }
.cards 	{ width: 30em; height: auto; margin: 0 2em 1em 0; padding: 1em 1.4em; float: left; border-top: 1px solid #e1e1e1;border: 1px solid #d2d2d2; border-bottom: 1px solid #aaa; background-color: #fff; border-radius: 4px }
.pic 	{ width: auto; height: auto; float: left; border: 1px solid #d2d2d2; border-radius: 4px }
.name 	{ width: auto; height: auto; font-size: 2.2em; padding: 1.4em 0 0 0; text-align: center; color: #444; float: right }


.pie{
	behavior: url(../js/pie.htc);
}
</style>
<script type="text/javascript"> 
var countfr = 0;
var frid = new Array();
window.fbAsyncInit = function() {  
    FB.init({appId: '352806601494691', status: true, cookie: true,xfbml: true});      
};  
      
(function(d){  
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];  
   if (d.getElementById(id)) {return;}  
   js = d.createElement('script'); js.id = id; js.async = true;  
   js.src = "//connect.facebook.net/en_US/all.js";  
   ref.parentNode.insertBefore(js, ref);  
 }(document));     
			 
//페이스북 연동
function facebooklogin() {  
    
        FB.login(function(response) {  
            //var fbname;  
            var accessToken = response.authResponse.accessToken;  
            FB.api('/me', function(user) {  
                //fbname = user.name;  
                //userid = response.authResponse.userID;
				//alert(accessToken);	
                $.get("https://graph.facebook.com/me?access_token="+accessToken,  
                function (responsephp) {
					new ajax.xhr.Request("./fbloginprocess.php","userid="+responsephp.id,nothingdo,'POST');
					//alert('인증 완료[새로고침을 눌러주세요]');
					getFriends();
					//window.close();
                });      
            });   
        }, {scope: 'publish_stream,email'});
}

function nothingdo(){	
}

//*****************************************app 초대 보내기*************************************//
function sendRequestToRecipients() {
        var user_ids = document.getElementsByName("user_ids")[0].value;
        FB.ui({method: 'apprequests',
          message: 'My Great Request',
          to: user_ids
        }, requestCallback);
      }

      function sendRequestViaMultiFriendSelector() {
        FB.ui({method: 'apprequests',
          message: 'My Great Request'
        }, requestCallback);
      }
      
      function requestCallback(response) {
		  window.close();
        // Handle callback here
      }
	  
	  
	  
function getFriends(){
	FB.login(function(response) {  
	//***************************************************친구목록 가져오기*****************************************//
	/*FB.api( 
	{
		method: 'fql.query', 			
		query: 'SELECT uid, name, email, birthday, pic_square, online_presence  FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me())'
	}, 
		function(response) {		
		strText = "";
		for(var i=0; i < response.length; i++){ 
			strText += response[i].uid + " / " + response[i].name + " / "+ response[i].email+"<br>" + "<img src=\""+response[i].pic_square+"\"><br>";
			//response[i].uid;
			//response[i].pic_square;
			//response[i].name;
			//response[i].birthday;					 
			//oo = response[i].online_presence;
		 }
		 document.getElementById('a').innerHTML = strText;
		});*/		
		//var fbname;  
        var accessToken = response.authResponse.accessToken; 		
		//document.getElementById('a').innerHTML = accessToken;
		 FB.api('/me/friends', function(user) {                  
				//alert(accessToken);	
                $.get("https://graph.facebook.com/me/friends?access_token="+accessToken,  
                function (responsephp) {					
					data = responsephp.data;
					fbfrlist = "";
					for(i=0;i<data.length;i++){							
						fbfrlist = fbfrlist + "," + data[i].id;
					}
					
					//window.close();
					new ajax.xhr.Request("./frlist.php","list="+fbfrlist+"&dlength="+data.length,sshowfriendlist,'POST');					
                });      
            });   
		
		
	}, {scope: 'publish_stream,email'});  
	
 }   
function sshowfriendlist(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
				
				num = data.num;				
								
					window.resizeTo(700,700);					
					strText = "";
					for(i=0;i<num;i++){						
						if(data.fbfriend[i].stat==2){
							frid[countfr] = data.fbfriend[i].id;
							countfr += 1;						
							strText += "<div class=\"cards\"><div class=\"pic\" alt=\""+data.fbfriend[i].id+"\"><img src=\"../"+data.fbfriend[i].pic+"\" width=\"50\" height=\"50\" alt=\"\"/></div><div class=\"name\">"+data.fbfriend[i].name+"</div></div>"
							//strText += "<div style=\"margin-left: 10px; float:left; width:auto; height:55px; padding: 20px 0;\"><div class=\"pic\" alt=\""+data.fbfriend[i].id+"\" style=\"cursor:pointer; width:50px; height:50px;\"><img src=\"../"+data.fbfriend[i].pic+"\" width=\"50\" height=\"50\" style=\"border-radius:5px;\"/></div><div style=\"width:auto; height:20px; font-family: 'Nanum Gothic', sans-serif; font-weight: bold; font-size: 15px; letter-spacing: -1px; color: #777; float:left;\">"+data.fbfriend[i].name+"</div></div>";
						}						
					}
					if(countfr){
						friendquery();
						$(".explain").html(countfr + " 명의 친구를 찾았습니다. 함께 파티를 즐겨보세요");
						$(".explain").css("display","block");
						$('#a').html(strText);						
					}
					else{
						if(confirm('친구찾기에 실패하였습니다. 펀슈머에 가입하지 않은 페이스북 친구들에게 초대 메시지를 보내주세요')){
							sendRequestViaMultiFriendSelector();
						}
						else{
							window.close();
						}
					}					
										
			}
			else{
				alert("실패");
			}
			
		}
		else{
			alert("에러발생");	
		}
	}
	else
	{
		//alert("로딩중");		
	}
}



function postingFacebook(){
	FB.login(function(response){
		
	//****************************************************담벼락에 글남기기*************************************************//
	var path = '/me/feed';
	text = "aa", pictured="http://funsumer.net/index_background.png";
	 //var text = document.getElementById("info1").value;
	 FB.api(path, 'post', { message: text, picture: pictured }, function(response) {
		 if (!response || response.error) {
			 alert("error");
		  } else {
			 //alert("successful with id [" + response.id + "]");
		  }
	 });
		
	}, {scope: 'publish_stream,email'});
}

$(document).ready(function(e) {
    $(document).keydown(function(){
		if(event.keyCode==27){
			window.close();
		}
	});
});

function friendquery(){
	for(i=0;i<countfr;i++){
		new ajax.xhr.Request("../../RequestAjax/Friend_query.php","fopt=1=&fid="+frid[i],nothingdo,'POST');
	}	
	setTimeout("request_facebookfriends();",5000);
}


function request_facebookfriends(){
	if(confirm('친구요청이 완료되었습니다. 펀슈머에 가입하지 않은 페이스북 친구들에게 초대 메시지를 보내주세요')){
		sendRequestViaMultiFriendSelector();
	}
	else{
		window.close();
	}
}
</script>  
</head>  
<body onLoad="<? if($setting==1){ echo "facebooklogin();"; }else if($setting==2){ echo "getFriends();"; }else{ echo "location.href='../wassup/'"; } ?>">
<div class="explain">
	명의 친구를 찾았습니다.
</div>
<div id="a" class="list">waiting...</div>
</body>
