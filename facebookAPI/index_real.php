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
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">  
<title>Login page</title>  

<script type="text/javascript" src="../js/jquery-1.7.1.min.js" charset="utf-8"></script>  
<script type="text/javascript">  

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

/*	 
FB.getLoginStatus(handleSessionResponse);
 function handleSessionResponse(response) { 
  if (!response.session) { 
   // Open login dialog box
   FB.login(handleSessionResponse);
   return; 
  } else{
   // already logged in
   alert('already logged in');
  }
 }			 
			 
*/

			 
//페이스북 연동
function facebooklogin() {  
    
        FB.login(function(response) {  
            var fbname;  
            var accessToken = response.authResponse.accessToken;  
            FB.api('/me', function(user) {  
                fbname = user.name;  
                userid = response.authResponse.userID  				
                $.post("./fbloginprocess.php", { "userid": user.id/*, "username": fbname, "fbaccesstoken":accessToken*/},  
                function (responsephp) {      				           
                   // location.replace('https://graph.facebook.com/me?access_token='+accessToken);					
					//alert('success');
					window.close();
                });      
            });   
        }, {scope: 'publish_stream,email,user_likes'});  
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
        // Handle callback here
      }
	  
	  
	  
function getFriends(){
	FB.login(function(response) {  
	//***************************************************친구목록 가져오기*****************************************//
	FB.api( 
	{
		method: 'fql.query', 			
		query: 'SELECT uid, name, email, birthday, pic_square, online_presence  FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me())'
	}, 
		function(response) {		
		//strText = "";
		for(var i=0; i < response.length; i++){ 
			//strText += response[i].uid + " / " + response[i].name + "<br>" + "<img src=\""+response[i].pic_square+"\"><br>";
			//response[i].uid;
			//response[i].pic_square;
			//response[i].name;
			//response[i].birthday;
			//response[i].email;		 
			//oo = response[i].online_presence;
		 }
		 //document.getElementById('a').innerHTML = strText;
		});		
	}, {scope: 'publish_stream,email,user_likes'});  
	
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
		
	}, {scope: 'publish_stream,email,user_likes'});
}

</script>  
</head>  
<body onLoad="<? if($setting==1){ echo "facebooklogin();"; }else if($setting==2){  }else{ echo "location.href='../wassup/'"; } ?>">
<div id="a"></div>
</body>
