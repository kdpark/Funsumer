<?
	$er_file = $_POST['er_file'];
		
	
	 if( is_file($er_file) )
	 {
	  unlink($er_file);
	 }
?>
