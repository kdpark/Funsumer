<? session_start();
	$id = $_SESSION['userid'];
	if(!$id)
	{
	    $id = $_COOKIE["usercookie"];
    }
    
    if(!$id)
    {
		// 로그아웃
	    echo(" <script> top.location.href='index.php'; </script> ");
    }
    
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
	//$aid : article id
	//$id : session
	//$opt : option
	include "dbconn.php";
	$aid = $_POST['aid'];
	
	$sql = "select point from article_like where mem='$id' and article='$aid'";
	$result = mysql_query($sql,$connect);
	$lk_exa = mysql_num_rows($result);
	if(!$lk_exa){	
		$sql = "insert into article_like(id, mem, article, point, time) values (NULL,'$id', '$aid', '1', NOW())";
		mysql_query($sql, $connect);
		
	}
	else{
		$sql = "delete from article_like where mem='$id' and article='$aid'";
		mysql_query($sql,$connect);
	}
	mysql_close();
	
?>
