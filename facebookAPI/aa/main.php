<?php   
    session_start();  
	echo $_SESSION['fbtoken']."/";
	echo $_SESSION['name']."/";
	echo $_SESSION['id'].".";
	echo "<script> location.href='https://graph.facebook.com/me/friendlists?access_token=".$_SESSION['fbtoken']."' </script>";
?>  
 