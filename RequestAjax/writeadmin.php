<? session_start();ob_start();
	$id = $_SESSION['userid'];
	if(!$id)
	{
	    $id = $_COOKIE["usercookie"];
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
	include "../dbconn.php";
	
	$opt = $_POST['opt'];
	$name = $_POST['name'];
	$ename = $_POST['ename'];
	$birth = $_POST['birth'];
	$gender = $_POST['gender'];
	$univ = $_POST['univ'];
	$p1 = $_POST['p1'];
	$p2 = $_POST['p2'];	
	
	if($opt==1){
		$sql = "update member set name='$name' where id='$id'";
		$result = mysql_query($sql,$connect);
		$sql = "update member set ename='$ename' where id='$id'";
		$result = mysql_query($sql,$connect);
		$sql = "update member set birth='$birth' where id='$id'";
		$result = mysql_query($sql,$connect);
		$sql = "select profilepic from member where id='$id'";
		$result = mysql_query($sql,$connect);
		$a = mysql_fetch_array($result);
		if($a[0]=="images/base/male160.png" || $a[0]=="images/base/female160.png"){
			if($gender==1){
				$sql = "update member set profilepic='images/base/male160.png' where id='$id'";
				mysql_query($sql,$connect);
			}
			else{
				$sql = "update member set profilepic='images/base/female160.png' where id='$id'";
				mysql_query($sql,$connect);
			}
		}
		$sql = "update member set gender='$gender' where id='$id'";
		$result = mysql_query($sql,$connect);
		$sql = "update member set university='$univ' where id='$id'";
		$result = mysql_query($sql,$connect);
	}
	else if($opt==2){
		$sql = "select*from member where id='$id'";
		$result = mysql_query($sql,$connect);
		$me = mysql_fetch_array($result);
		
		$sql1 = "select PASSWORD('$p1')";
		$result1 = mysql_query($sql1,$connect);
		$row = mysql_fetch_array($result1);
		
		if($row[0] == $me[password]){
			$sql2 = "update member set password=PASSWORD('$p2') where id='$id'";
			$result2 = mysql_query($sql2,$connect);
			
			echo "ok: 1";
		}
		else{
			echo "ok: 0";
		}
	}
		
	
	
	mysql_close();
	
?>
}
]]></data>
</result>