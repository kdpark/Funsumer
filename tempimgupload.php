<? session_start();										
	$id = $_COOKIE["usercookie"];						
    if(!$id)
    {
	    $id = $_SESSION['userid'];	    
    }
	
    include "dbconn.php";
	?>

<?php

//********************************* Resize ******************************************//
function resizeImage($image,$width,$height,$scale,$result) {
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);	
	
	if($width > 493){
		$newImageWidth = ceil(493);
		$newImageHeight = ceil(($height*493)/$width);
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
function resizeImage_Profile($image,$width,$height,$scale,$result) {
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);	
	
	if($width > $height){
		$newImageHeight = ceil($result);
		$newImageWidth = ceil(($width*$result)/$height);
	}
	else{
		$newImageWidth = ceil($result);
		$newImageHeight = ceil(($height*$result)/$width);
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







$opt = $_POST['opt'];
$MAX_fIlE_SIZE = $_POST['MAX_fIlE_SIZE'];
$upload_check = $_POST['upload_check'];


$sql = "select NOW()";
$result = mysql_query($sql,$connect);
$nowar = mysql_fetch_array($result);
$fnmae = substr($nowar[0],0,4).substr($nowar[0],5,2).substr($nowar[0],8,2).substr($nowar[0],11,2).substr($nowar[0],14,2).substr($nowar[0],17,2);

if($opt==1){
	$up_path = "upload/temp/";
	$image_name = "Regisotr_temp_profile_".$fnmae;
}
else{
	$up_path = "upload/temp/";
	$image_name = $id."_Temp_Article_".$fnmae;	
}
$image_location = $up_path.$image_name;
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
			
			if(move_uploaded_file ($_FILES['imgupload']['tmp_name'], $image_location)){
				if($opt==1){
					$width = getWidth($image_location);
					$height = getHeight($image_location);
					$scale = 1;
					$uploaded = resizeImage_Profile($image_location,$width,$height,$scale,160);
					echo ("<script> parent.removepref(); parent.$('#picture').attr('src','../".$image_location."'); parent.$('#picture').css('width','255px'); parent.$('#picture').css('height','255px'); parent.$('#picture').attr('alt','".$image_location."'); parent.$('#imgiframe').attr('src','../imgiframe.php'); </script>");
				}
				else {
				$width = getWidth($image_location);
				$height = getHeight($image_location);
				$scale = 1;
				$uploaded = resizeImage($image_location,$width,$height,$scale);
					echo ("<script> parent.$('.cameraspace > .photopart > .photo > .photo1 > .img > img').attr('src','../".$image_location."'); parent.$('.cameraspace > .photopart > .photo > .photo1 > .img > img').attr('alt','".$image_location."'); parent.$('#imgiframe').attr('src','../imgiframe.php'); parent.$('.cameraspace > .photopart > .photo > .photo1 > .close').css('display','block'); </script>");
				}
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
