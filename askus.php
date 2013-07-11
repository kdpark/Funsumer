<!doctype html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="Author" content="Funsumer" />
	<meta name="viewport" content="width=960" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7, IE=9" />
    <script src="js/ajax.js"></script>
    <script src="js/jquery.js"></script>
    <script language="javascript">
	function writearticle(){
		new ajax.xhr.Request("./writeask.php","&content="+$("#txt").val(),endfunction,'POST');
	}
	function endfunction(req){
		if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
			
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
				
				result = data.Result;
				if(result==1){
					alert("접수 완료되었습니다");
					window.close();
				}
				else{
					
				}
			}
			else{
				alert("실패");
			}
			
		}
		else{
			alert("에러발생");	
		}
	}
	else
	{
		//alert("로딩중");		
	}

	}
	</script>
    <title>FUNSUMER</title>
   
</head>

<body>
<div style="margin-left:55px;margin-bottom:5px; font-size:12px;">문의내용</div>
<textarea id="txt" style="resize:none; height:240px;"></textarea>
<div><input type='button' value="접수하기" onClick="writearticle();"></div>
</body>
</html>