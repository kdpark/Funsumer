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
	
$fbuserid = $_POST['userid'];  

include "../dbconn.php";  

$sql = "select*from member where facebook='$fbuserid' and id='$id'";
$result = mysql_query($sql,$connect);

$result_count = mysql_num_rows($result);
  
if($result_count<1) {  
    //facebook으로 로그인한 아이디가 DB에 없을 경우.  	
	$sql = "update member set facebook='$fbuserid' where id='$id'";
	mysql_query($sql,$connect);
	  
}  

?>