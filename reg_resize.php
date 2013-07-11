<? session_start();ob_start();
	$id = $_COOKIE["usercookie"];
    if(!$id)
    {
	    $id = $_SESSION['userid'];	    
    }
	
    include "dbconn.php";

//*********************************Profile**********************************//
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

?>

<?php
$iid = $_POST['iid'];
$opt = $_POST['opt'];
	
	if($opt==1){	
$sql = "select profilepic from member where id='$iid'";
$result = mysql_query($sql,$connect);
$row = mysql_fetch_array($result);
$image_location = $row[0];


for($i=0;$i<2;$i++){
	if($i==0){ $a=50; }else{ $a=38; }
	$pic_copy = $image_location."$a";//확장자 없이 파일이름까지만 사용한다.
	
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
	else{
		echo "a";
		break;
	}
?>
