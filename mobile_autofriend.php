<?
	$connect = mysql_connect("localhost", "user", "vjstbaj") or die("DB 서버에 연결할 수 없습니다");
	mysql_query("set names utf8");
	mysql_select_db("funsumer", $connect);
	
	$a = $_POST['a'];
	$mynoteid = $_POST['mynoteid'];	
	
	$sql = "select*from member where phone='$a'";
	$result = mysql_query($sql,$connect);
	$u = mysql_fetch_array($result);
	
	$sql = "select*from friendship where mem1='$mynoteid' and mem2='$u[4]'";
	$result = mysql_query($sql,$connect);
	$fr = mysql_num_rows($result);
	
	if($u[4]!=0 && $mynoteid!=$u[4]){
		if($fr){
			//already friend
		}
		else{
			$sql = "select*from friend_req where from_mem='$mynoteid' and to_mem='$u[4]'";
			$result = mysql_query($sql,$connect);
			$fr_m = mysql_num_rows($result);
			if($fr_m){
				//already send friend_req
			}
			else{
				$sql = "select*from friend_req where from_mem='$u[4]' and to_mem='$mynoteid'";
				$result = mysql_query($sql,$connect);
				$fr_u = mysql_num_rows($result);
				if($fr_u){
					//already receive friend_req
					$sql = "insert into friendship(id, mem1, mem2, time) values(NULL, '$mynoteid', '$u[4]', NOW())";
					mysql_query($sql,$connect);
					$sql = "insert into friendship(id, mem1, mem2, time) values(NULL, '$u[4]', '$mynoteid', NOW())";
					mysql_query($sql,$connect);
					$sql = "delete from friend_req where from_mem='$u[4]' and to_mem='$mynoteid'";
					mysql_query($sql,$connect);
				}
				else{
					$sql = "insert into friend_req(id, from_mem, to_mem, time) values(NULL, '$mynoteid', '$u[4]', NOW())";
					mysql_query($sql,$connect);
				}
			}		
		}
	}
	
	
	mysql_close();
?>
