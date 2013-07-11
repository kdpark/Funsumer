<? session_start(); ob_start();
	$id = $_SESSION['userid'];
	if(!$id)
	{
	    $id = $_COOKIE["usercookie"];
    }
    
    if(!$id)
    {
		// 로그아웃
	     echo(" <script> top.location.href='../index.php'; </script> ");
    }
    
    include "../dbconn.php";
	require("../util.php");
	
	header("Content-type: text/xml; charset=utf-8");
	header("Pragma: no-cache");
	header("Cache-Control: no-cache,must-revalidate");
	echo "<?xml version='1.0' encoding='utf-8' ?>";
	
?>

<result>
	<code>success</code>
    <data><![CDATA[
               
         {
         
<?
	$articleID = $_POST['articleID'];
	$sql = "select origin from article where id='$articleID'";
	$result = mysql_query($sql,$connect);
	$origin_ID = mysql_fetch_array($result);
	
	$sql = "select party, a_open, mem from article where id='$origin_ID[0]'";
	$result = mysql_query($sql,$connect);
	$row = mysql_fetch_array($result);
	
	if($row[0]==0){	//노트에 쓴 글일때
		if($row[1]!=0){	//친구공개일때
			$sql = "select*from friendship where mem1='$id' and mem2='$row[2]'";
			$result = mysql_query($sql,$connect);
			$ex = mysql_num_rows($result);
			if($ex){
				echo "Auth: 1";
			}
			else{
				echo "Auth: 0";
			}
		}
		else{
			echo "Auth: 1";
		}
	}
	else{	//파티에 쓴 글일때
		$sql = "select p_public from party where id='$row[0]'";
		$result = mysql_query($sql,$connect);
		$p = mysql_fetch_array($result);
		
		if($p[0]!=0){
			$sql = "select*from partyjoin where party_id='$row[0]' and member_id='$id'";
			$result = mysql_query($sql,$connect);
			$exa = mysql_num_rows($result);
		}
		
		if($p[0]==0 || $exa!=0){	//비공개파티 필터링
			if($row[1]!=0){
				if($exa!=0){
					echo "Auth: 1";
				}
				else{
					echo "Auth: 0";
				}
			}
			else{
				echo "Auth: 1";
			}
		}
		else{
			echo "Auth: 0";
		}
		
	}
	
	
	mysql_close();
?>
}
]]></data>
</result>