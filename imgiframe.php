<script language="javascript">
function UploadSetting(){
	parent.UploadSetting();	
}
</script>
<form id="WideUpload" name="WideUpload" enctype="multipart/form-data" method="post" action="imgupload.php">
	<input type='file' id='imgupload' name='imgupload' onChange="UploadSetting();">    
    <input type="hidden" name="partyidd" value="0" />
    <input type="hidden" name="opt" value="1"/>    
   	<input type="hidden" name="MAX_fIlE_SIZE" value="5242880"/>
    <input type="hidden" name="upload_check" value="true" />
</form>
