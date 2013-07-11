<? session_start();ob_start();
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
	$req_party = $_POST['req_party'];
		
	$sql = "select distinct j.join_time, p.admin, m.name, m.profilepic, p.pic, p.widey, p.pname, p.p_public, p.p_permission from partyjoin j, party p, member m where j.party_id=$req_party and p.id=$req_party and m.id=p.admin order by j.id";
	$result = mysql_query($sql,$connect);
	$res_data = mysql_fetch_array($result);
	
	echo "Since: \"$res_data[0]\", ";
	echo "AdminID: \"$res_data[1]\", ";
	echo "AdminName: \"$res_data[2]\", ";
	echo "AdminPic: \"$res_data[3]\", ";
	echo "PPic: \"$res_data[4]\", ";
	echo "widey: \"$res_data[5]\", ";
	echo "pname: \"$res_data[6]\", ";
	
	$sql = "select*from partyjoin where member_id='$id' and party_id='$req_party'";
	$result = mysql_query($sql,$connect);
	
	$exa = mysql_num_rows($result);
	if($exa!=0){
		echo "joined: 1, ";
	}
	else{
		echo "joined: 0, ";
	}
	$pn = mysql_fetch_array($result);
	
	echo "pn: \"$pn[7]\", ";
	echo "p_public: \"$res_data[7]\", ";
	echo "p_permission: \"$res_data[8]\" ";
	
	//글갯수 / 회원수 / since / 내가 가입여부 / admin
	mysql_close();
?>
}
]]></data>
</result>