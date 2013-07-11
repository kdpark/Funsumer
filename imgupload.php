<? session_start();										
	$id = $_COOKIE["usercookie"];						
    if(!$id)
    {
	    $id = $_SESSION['userid'];	    
    }
	
    include "dbconn.php";
//********************************Wide**************************************//
//wide
function resizeImage_Wide($image,$width,$height,$scale,$result) {
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);	
	
	if($width == $result){
		$newImageWidth = ceil($oriwidth);
		$newImageHeight = ceil($oriheight);
	}
	else{
		if($result==920){
			$newImageWidth = $result;
			$newImageHeight = (($height*$result)/$width);
			if($newImageHeight < 560){
				$newImageHeight = ceil(560);
			$newImageWidth = (($width*560)/$height);
			}
		}
		else{
			$newImageWidth = ceil($result);
			$newImageHeight = ceil(($height * $result)/$width);
		}
	}
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
		case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
	}
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	
	switch($imageType) {
		case "image/gif":
			imagegif($newImage,$image); 
			break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$image);  
			break;
	}
	
	chmod($image, 0777);
	return $image;
}
//*********************************Profile**********************************//
//profile
function resizeImage_Profile($image,$width,$height,$scale,$result) {
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);	
	
	if($resul == $width){
		$newImageWidth = ceil($oriwidth);
		$newImageHeight = ceil($oriheight);
	}
	else{	
		if($width > $height){
			$newImageHeight = ceil($result);
			$newImageWidth = ceil(($width*$result)/$height);
		}
		else{
			$newImageWidth = ceil($result);
			$newImageHeight = ceil(($height*$result)/$width);
		}
	}
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
		case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
	}
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	
	switch($imageType) {
		case "image/gif":
			imagegif($newImage,$image); 
			break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$image);  
			break;
	}
	
	chmod($image, 0777);
	return $image;
}
//*********************************Party******************************************//
//party
function resizeImage_Party($image,$width,$height,$scale,$result_w,$result_h) {
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);	
	
	if($result_w == $width && $result_h == $height){
		$newImageWidth = ceil($width);
		$newImageHeight = ceil($height);
	}
	else{		
		if($width > $height){
			$newImageHeight = ceil($result_h);
			if((($width*$result_h)/$height) < $result_w){
				$newImageWidth = ceil($result_w);	
				$newImageHeight = ceil(($height*$result_w)/$width);
			}
			else{
				$newImageWidth = ceil(($width*$result_h)/$height);
			}		
		}
		else{
			$newImageWidth = ceil($result_w);
			if((($height*$result_w)/$width) < $result_h){
				$newImageHeight = ceil($result_h);	
				$newImageWidth = ceil(($width*$result_h)/$height);
			}
			else{
				$newImageHeight = ceil(($height*$result_w)/$width);
			}		
		}
	}
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
		case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
	}
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	
	switch($imageType) {
		case "image/gif":
			imagegif($newImage,$image); 
			break;
		case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$image);  
			break;
	}
	
	chmod($image, 0777);
	return $image;
}


function getHeight($image) {
	$size = getimagesize($image);
	$height = $size[1];
	return $height;
}
//You do not need to alter these functions
function getWidth($image) {
	$size = getimagesize($image);
	$width = $size[0];
	return $width;
}

?>

<?php
$opt = $_POST['opt'];
$MAX_fIlE_SIZE = $_POST['MAX_fIlE_SIZE'];
$upload_check = $_POST['upload_check'];
$partyid = $_POST['partyidd'];

$sql = "select NOW()";
$result = mysql_query($sql,$connect);
$nowar = mysql_fetch_array($result);
$fnmae = substr($nowar[0],0,4).substr($nowar[0],5,2).substr($nowar[0],8,2).substr($nowar[0],11,2).substr($nowar[0],14,2).substr($nowar[0],17,2);

if($opt==1){	//WidePic
	$save_dir = "upload/widepic";
	$up_path = $save_dir."/";		
	$image_prefix = $id."_thumbpic";
	$image_name = $image_prefix.$fnmae; 
}
else if($opt==2){	//ProfilePic
	$save_dir = "upload/profilepic";
	$up_path = $save_dir."/";		
	$image_prefix = $id."_profilepic_";
	$image_name = $image_prefix.$fnmae; 
}
else if($opt==3){	//Party
	$save_dir = "upload/party";
	$up_path = $save_dir."/";		
	$image_prefix = $partyid."_partypic_";
	$image_name = $image_prefix.$fnmae; 
}

$image_location = $up_path.$image_name;
//$rimage_location = $image_location."_o";
$filename = basename($_FILES['imgupload']['name']);
$file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
$image_location = $image_location.".".$file_ext;



// 1.업로드 상태여부를 체크
if (isset($_POST['upload_check'])) {

	// 2.업로드된 파일의 존재여부 및 전송상태 확인
	if (isset($_FILES['imgupload']) && !$_FILES['imgupload']['error']) {

		// 3-1.허용할 이미지 종류를 배열로 저장
		$imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');

		// 3-2.imageKind 배열내에 $_FILES['upload']['type']에 해당되는 타입(문자열) 있는지 체크
		if (in_array($_FILES['imgupload']['type'], $imageKind)) {
		
			// 4.허용하는 이미지파일이라면 지정된 위치로 이동
			
			if($opt==1){	//Widepic
				$sql = "select widethumbpic from member where id='$id'";
				$result = mysql_query($sql,$connect);
				$row = mysql_fetch_array($result);
				
				if($row[0]!="index_background.jpg"){
					chmod($save_dir , 0777);
					if (file_exists($row[0])) {
						unlink($row[0]);
					}
					if (file_exists($row[0]."_o")) {
						unlink($row[0]."_o");
					}	
					if (file_exists($row[0]."_mobile")) {
						unlink($row[0]."_mobile");
					}				
				}
					
				if (move_uploaded_file ($_FILES['imgupload']['tmp_name'], $image_location)) {
					$sql = "update member set widethumbpic='$image_location' where id='$id'";
					mysql_query($sql,$connect);					
					mysql_close();
					$width = getWidth($image_location);
					$height = getHeight($image_location);
					$oriwidth = $width;
					$oriheight = $height;
					$scale = 1;
					
					$uploaded = resizeImage_Wide($image_location,$width,$height,$scale,920);
					
					for($i=0;$i<2;$i++){
						if($i==0){ $a=$oriwidth; }else if($i==1){ $a=600; }
										if($i!=1){
											$pic_copy = $image_location."_o";//확장자 없이 파일이름까지만 사용한다.
										}
										else{
											$pic_copy = $image_location."_mobile";//확장자 없이 파일이름까지만 사용한다.
										}
				
										if (!is_file($image_location)) {				
										   echo "Result: \"3\""; // 파일이 아니라 처리할 수 없어
										}
										 
										$size = @getimagesize($image_location);
										if (empty($size[2])) {	
										   echo "Result: \"4\""; // 이미지 파일이 아니야
										}
										
										if ($size[2] != 1 && $size[2] != 2 && $size[2] != 3) {			
										   echo "Result: \"5\""; // 지원하지 않는 이미지타입이야 gif/jpg/png만 가능
										}
										
										$extension = image_type_to_extension($size[2]);
										$path_copyfile .= $extension;
										
										switch($size[2]){
										
										  case 1 : //gif
										
											$im = @imagecreatefromgif($image_location);
										
											if ($im === false) {
												echo "Result: \"6\"";
												//이미지 리소스 가져오기 실패
											}
											
											$result_save = @imagegif($im, $pic_copy);
											$width = getWidth($pic_copy);
											$height = getHeight($pic_copy);
											$scale = 1;
											$uploaded = resizeImage_Wide($pic_copy,$width,$height,$scale,$a);
											break;
										
										  case 2 : //jpg
										
											$im = @imagecreatefromjpeg($image_location);
										
											if ($im === false) {
												echo "Result: \"7\"";	
											   //이미지 리소스 가져오기 실패
											}
											
											$result_save = @imagejpeg($im, $pic_copy);
											$width = getWidth($pic_copy);
											$height = getHeight($pic_copy);
											$scale = 1;
											$uploaded = resizeImage_Wide($pic_copy,$width,$height,$scale,$a);
											break;
										
										  case 3 : //png
										
											$im = @imagecreatefrompng($image_location);
										
											if ($im === false) {
										
											  echo "Result: \"8\"";
											  //이미지 리소스 가져오기 실패
											}
											
											$result_save = @imagepng($im, $pic_copy);
											$width = getWidth($pic_copy);
											$height = getHeight($pic_copy);
											$scale = 1;
											$uploaded = resizeImage_Wide($pic_copy,$width,$height,$scale,$a);
										
											break;
										}
										
										@imagedestroy($im);
										
										if ($result_save === false) {
										
										   echo "Result: \"9\"";
										   //이미지 복사 실패
										}
										
									
										}//for
					
				} //if , move_uploaded_file
			}
			else if($opt==2){	//profildpic
				$sql = "select profilepic from member where id='$id'";
				$result = mysql_query($sql,$connect);
				$row = mysql_fetch_array($result);
				
				if($row[0]!="images/base/male160.png" && $row[0]!= "images/base/female160.png"){
					chmod($save_dir , 0777);
					if (file_exists($row[0])) {
						unlink($row[0]);						
					}
					if (file_exists($row[0]."50")){
						unlink($row[0]."50");
					}
					if (file_exists($row[0]."38")){
						unlink($row[0]."38");
					}
					if (file_exists($row[0]."90")){
						unlink($row[0]."90");
					}
					if (file_exists($row[0]."_o")){
						unlink($row[0]."_o");
					}
				}
				
				if (move_uploaded_file ($_FILES['imgupload']['tmp_name'], $image_location)) {
					$sql = "update member set profilepic='$image_location' where id='$id'";
					mysql_query($sql,$connect);					
					mysql_close();
					$width = getWidth($image_location);
					$height = getHeight($image_location);
					$oriwidth = $width;
					$oriheight = $height;
					$scale = 1;
					$uploaded = resizeImage_Profile($image_location,$width,$height,$scale,160);
					
					for($i=0;$i<4;$i++){
						if($i==0){ $a=50; }else if($i==1){ $a=38; }else if($i==2){ $a=90; }else if($i==3){ $a=$oriwidth; }
										if($i!=3){
											$pic_copy = $image_location."$a";//확장자 없이 파일이름까지만 사용한다.
										}
										else{
											$pic_copy = $image_location."_o";//확장자 없이 파일이름까지만 사용한다.
										}
				
										if (!is_file($image_location)) {				
										   echo "Result: \"3\""; // 파일이 아니라 처리할 수 없어
										}
										 
										$size = @getimagesize($image_location);
										if (empty($size[2])) {	
										   echo "Result: \"4\""; // 이미지 파일이 아니야
										}
										
										if ($size[2] != 1 && $size[2] != 2 && $size[2] != 3) {			
										   echo "Result: \"5\""; // 지원하지 않는 이미지타입이야 gif/jpg/png만 가능
										}
										
										$extension = image_type_to_extension($size[2]);
										$path_copyfile .= $extension;
										
										switch($size[2]){
										
										  case 1 : //gif
										
											$im = @imagecreatefromgif($image_location);
										
											if ($im === false) {
												echo "Result: \"6\"";
												//이미지 리소스 가져오기 실패
											}
											
											$result_save = @imagegif($im, $pic_copy);
											$width = getWidth($pic_copy);
											$height = getHeight($pic_copy);
											$scale = 1;
											$uploaded = resizeImage_Profile($pic_copy,$width,$height,$scale,$a);
											break;
										
										  case 2 : //jpg
										
											$im = @imagecreatefromjpeg($image_location);
										
											if ($im === false) {
												echo "Result: \"7\"";	
											   //이미지 리소스 가져오기 실패
											}
											
											$result_save = @imagejpeg($im, $pic_copy);
											$width = getWidth($pic_copy);
											$height = getHeight($pic_copy);
											$scale = 1;
											$uploaded = resizeImage_Profile($pic_copy,$width,$height,$scale,$a);
											break;
										
										  case 3 : //png
										
											$im = @imagecreatefrompng($image_location);
										
											if ($im === false) {
										
											  echo "Result: \"8\"";
											  //이미지 리소스 가져오기 실패
											}
											
											$result_save = @imagepng($im, $pic_copy);
											$width = getWidth($pic_copy);
											$height = getHeight($pic_copy);
											$scale = 1;
											$uploaded = resizeImage_Profile($pic_copy,$width,$height,$scale,$a);
										
											break;
										}
										
										@imagedestroy($im);
										
										if ($result_save === false) {
										
										   echo "Result: \"9\"";
										   //이미지 복사 실패
										}
										
									
										}//for
				}
			}
			else if($opt==3){	//party Wide
				$sql = "select pic from party where id='$partyid'";
				$result = mysql_query($sql,$connect);
				$row = mysql_fetch_array($result);
				
				if($row[0]!="index_background.jpg" && $row[0]!='images/event/base.png'){
					chmod($save_dir , 0777);
					if (file_exists($row[0])) {
						unlink($row[0]);						
					}
					if (file_exists($row[0]."_s")){
						unlink($row[0]."_s");
					}
					if (file_exists($row[0]."_m")){
						unlink($row[0]."_m");
					}
					if (file_exists($row[0]."_o")){
						unlink($row[0]."_o");
					}
					if (file_exists($row[0]."_mobile")){
						unlink($row[0]."_mobile");
					}
				}
				if (move_uploaded_file ($_FILES['imgupload']['tmp_name'], $image_location)) {
					$sql = "update party set pic='$image_location' where id='$partyid'";
					mysql_query($sql,$connect);					
					mysql_close();
					$width = getWidth($image_location);
					$height = getHeight($image_location);
					$oriwidth = $width;
					$oriheight = $height;
					$scale = 1;
					$uploaded = resizeImage_Party($image_location,$width,$height,$scale,828,252);
					
					for($i=0;$i<4;$i++){
						if($i==0){ $a=129; $b=86; $c="_s"; }else if($i==1){ $a=284; $b=190; $c="_m"; }else if($i==2){ $a=$oriwidth; $b=$oriheight; $c='_o'; }else if($i==3){ $a=600; $b=400; $c='_mobile'; }
										$pic_copy = $image_location."$c";//확장자 없이 파일이름까지만 사용한다.
				
										if (!is_file($image_location)) {				
										   echo "Result: \"3\""; // 파일이 아니라 처리할 수 없어
										}
										 
										$size = @getimagesize($image_location);
										if (empty($size[2])) {	
										   echo "Result: \"4\""; // 이미지 파일이 아니야
										}
										
										if ($size[2] != 1 && $size[2] != 2 && $size[2] != 3) {			
										   echo "Result: \"5\""; // 지원하지 않는 이미지타입이야 gif/jpg/png만 가능
										}
										
										$extension = image_type_to_extension($size[2]);
										$path_copyfile .= $extension;
										
										switch($size[2]){
										
										  case 1 : //gif
										
											$im = @imagecreatefromgif($image_location);
										
											if ($im === false) {
												echo "Result: \"6\"";
												//이미지 리소스 가져오기 실패
											}
											
											$result_save = @imagegif($im, $pic_copy);
											$width = getWidth($pic_copy);
											$height = getHeight($pic_copy);
											$scale = 1;
											$uploaded = resizeImage_Party($pic_copy,$width,$height,$scale,$a,$b);
											break;
										
										  case 2 : //jpg
										
											$im = @imagecreatefromjpeg($image_location);
										
											if ($im === false) {
												echo "Result: \"7\"";	
											   //이미지 리소스 가져오기 실패
											}
											
											$result_save = @imagejpeg($im, $pic_copy);
											$width = getWidth($pic_copy);
											$height = getHeight($pic_copy);
											$scale = 1;
											$uploaded = resizeImage_Party($pic_copy,$width,$height,$scale,$a,$b);
											break;
										
										  case 3 : //png
										
											$im = @imagecreatefrompng($image_location);
										
											if ($im === false) {
										
											  echo "Result: \"8\"";
											  //이미지 리소스 가져오기 실패
											}
											
											$result_save = @imagepng($im, $pic_copy);
											$width = getWidth($pic_copy);
											$height = getHeight($pic_copy);
											$scale = 1;
											$uploaded = resizeImage_Party($pic_copy,$width,$height,$scale,$a,$b);
										
											break;
										}
										
										@imagedestroy($im);
										
										if ($result_save === false) {
										
										   echo "Result: \"9\"";
										   //이미지 복사 실패
										}
										
									
										}//for
										
				} //if , move_uploaded_file
			}
			
		} else { // 3-3.허용된 이미지 타입이 아닌경우
			
		}//if , inarray

	} //if , isset
	

	// 6.에러가 존재하는지 체크
	if ($_FILES['imgupload']['error'] > 0) {
		echo '<p>파일 업로드 실패 이유: <strong>';
	
		// 실패 내용을 출력
		switch ($_FILES['imgupload']['error']) {
			case 1:
				echo 'php.ini 파일의 upload_max_filesize 설정값을 초과함(업로드 최대용량 초과)';
				break;
			case 2:
				echo 'Form에서 설정된 MAX_FILE_SIZE 설정값을 초과함(업로드 최대용량 초과)';
				break;
			case 3:
				echo '파일 일부만 업로드 됨';
				break;
			case 4:
				echo '업로드된 파일이 없음';
				break;
			case 6:
				echo '사용가능한 임시폴더가 없음';
				break;
			case 7:
				echo '디스크에 저장할수 없음';
				break;
			case 8:
				echo '파일 업로드가 중지됨';
				break;
			default:
				echo '시스템 오류가 발생';
				break;
		} // switch
		
		echo '</strong></p>';
		
	} // if
	
	// 7.임시파일이 존재하는 경우 삭제
	if (file_exists ($_FILES['imgupload']['tmp_name']) && is_file($_FILES['imgupload']['tmp_name']) ) {
		unlink ($_FILES['imgupload']['tmp_name']);
	}
} // if
?>
