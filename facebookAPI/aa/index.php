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
              
/*function facebooklogin() {  
    //페이스북 로그인 버튼을 눌렀을 때의 루틴.  
        FB.login(function(response) {  
            var fbname;  
            var accessToken = response.authResponse.accessToken;  
            FB.api('/me', function(user) {  
                fbname = user.name;  
                //response.authResponse.userID  				
                $.post("./fbloginprocess.php", { "userid": user.id, "username": fbname, "fbaccesstoken":accessToken},  
                function (responsephp) {  
                    //댓글을 처리한 다음 해당 웹페이지를 갱신 시키기 위해 호출.  
                    location.replace('./main.php');  
                });      
            });   
        }, {scope: 'publish_stream,user_likes'});  
}  */

function getFriends(){
	FB.login(function(response) {  
            
		/*	FB.api( 
         {
            method: 'fql.query', 
            query: 'SELECT uid, name, email, birthday, pic_square, online_presence  FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me())'
         }, 
        function(response) {		
		strText = "";
          for(var i=0; i < response.length; i++){ 
		  strText += response[i].uid + " / " + response[i].name + "<br>" + "<img src=\""+response[i].pic_square+"\"><br>";*/
             /*response[i].uid;
            response[i].pic_square;
            response[i].name;
             response[i].birthday;
             response[i].email;*/			 
             //oo = response[i].online_presence;
          /*}
		   document.getElementById('a').innerHTML = strText;
        } 
        );*/
		
		var path = '/me/feed';
         var text = document.getElementById("info1").value;
         FB.api(path, 'post', { message: text }, function(response) {
             if (!response || response.error) {
                 alert("error");
              } else {
                 alert("successful with id [" + response.id + "]");
              }
         });
		
			
			
        }, {scope: 'publish_stream,user_likes'});  
		
        
 }   


</script>  
</head>  
<body>
  
  
<div onclick="getFriends()" style="cursor: pointer;">  
    <img src="../images/index/logo.png">  
</div>  
<input type='text' id="info1">
<div id="a"></div>
</body>
