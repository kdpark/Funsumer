//POST****************************************************************************************************************************************//
function post_to_url(path, params, method) {
    method = method || "post"; // Set method to post by default, if not specified.
    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
    for(var key in params) {
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", key);
        hiddenField.setAttribute("value", params[key]);
        form.appendChild(hiddenField);
    }
    document.body.appendChild(form);
    form.submit();
} // POST to URL
var evnum=0;
$(document).ready(function() {		
		// nav-menu EVENT.
		
		$("#pass").focus(function(e) {
            $("#pass").val("");
        });
		
		var SDDw = $(".SDD-wassup"), SDDn = $(".SDD-note"), SDDp = $(".SDD-party");
		var navw = $(".nav-wassup"), 	navn = $(".nav-note"), 	navp = $(".nav-party");
		
		navn.mouseenter(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")});
		navw.mouseenter(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")});
		navp.mouseenter(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_partyov.png)")});
		
		navn.mouseleave(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_note.png)")});
		navw.mouseleave(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassup.png)")});
		navp.mouseleave(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_party.png)")});
		
		navn.mousedown(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteck.png)")});
		navw.mousedown(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassupck.png)")});
		navp.mousedown(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_partyck.png)")});
		
		navn.mouseup(function() { 	SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")
													location.href = '../../note' ;
												});
		navw.mouseup(function() { 	SDDw.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")
													location.href = '../../wassup' ;
												});
		navp.mouseup(function() { 	SDDp.css("background-image","url(../images/party/Header/header_menu_partyov.png)")
													location.href = '../../party' ;
												});
		
		// 빨간큰버튼 EVENT
		
		$(".Button2_red").mouseenter(function() {
            $(this).css("background-image","url(../../images/party/Container/button2bgov.png)")
        });
		$(".Button2_red").mouseleave(function() {
            $(this).css("background-image","url(../../images/party/Container/button2bg.png)")
        });
		$(".Button2_red").mousedown(function() {
            $(this).css("background-image","url(../../images/party/Container/button2bgck.png)")
        });
		$(".Button2_red").mouseup(function() {
            $(this).css("background-image","url(../../images/party/Container/button2bgov.png)")
        });
		
		// 사진 올리기 버튼
		
		$("#container > .signup > .content > .left  > .button").mouseenter(function(e) {
			$(this).css("background-image","url(../../images/base/buttongray3bgov.png)");
		});
		$("#container > .signup > .content > .left  > .button").mouseleave(function(e) {
			$(this).css("background-image","url(../../images/base/buttongray3bg.png)");
		});
		$("#container > .signup > .content > .left  > .button").mousedown(function(e) {
			$(this).css("background-image","url(../../images/base/buttongray3bgck.png)");
		});
		$("#container > .signup > .content > .left  > .button").mouseup(function(e) {
			$(this).css("background-image","url(../../images/base/buttongray3bgov.png)");
		});
			
		
	
		if(evcount!=0){
			for(i=0;i<evcount;i++){
				newul = document.createElement('UL');
				$(newul).html(ev[i]);
				$("#school").append(newul);
			}
			
			$.each($(".search > ul"),function() {
			
				$(this).mouseenter(function() {	$(this).css("background-color","#f2f2f2").css("color","#777");	});
				$(this).mouseleave(function() {	$(this).css("background-color","#ffffff").css("color","#999");	});
				$(this).mousedown(function() {	$(this).css("background-color","#dc5457").css("color","#ffffff"); $("#univ").val($(this).html()); });
				$(this).mouseup(function() {		$(this).css("background-color","#f2f2f2").css("color","#777"); });
			
			});
		}
		else{
			
		}
		
		$("#univ").focus(function(){
			$("#school").css("display","block");
		});
		$("#univ").focusout(function() {
            $("#school").css("display","none");
        });
		
});


function registorquery(){		
	if(typeof pageYOffset!='undefined'){	//CHROME
		email = $('#email').val();
		name = $('#name').val();
		pass = $('#pass').val();
		ename = $('#ename1').val() + " " + $('#ename2').val();
		birth = $('#year').val() + "-" + $('#month').val() + "-" + $('#day').val();
		univ = $('#univ').val();	
		if(document.getElementById('woman').checked==true){
			gender = 2;
		}
		else{
			gender = 1;
		}				
			
		
		if($("#email").val()=="" || $("#pass").val()=="" || $("#name").val()=="" || $("#ename1").val()=="" || $("#ename2").val()=="" || $("#year").val()=="" || $("#month").val()=="" || $("#day").val()=="" || $("#univ").val()==""){
			alert('모든 값을 입력해 주세요^^');
		}
		else{		
			if(document.getElementById('woman').checked == false && document.getElementById('man').checked == false){
				alert('성별을 선택해주세요');
			}
			else{
				
				if($("#pass").val().length < 4){
					alert('비밀번호는 4글자 이상으로 입력해주세요');
				}
				else{
					 format = /^((\w|[\-\.])+)@((\w|[\-\.])+)\.([A-Za-z]+)$/;
					 if($('#email').val().search(format) != -1){
						if($("#picture").attr("alt")==""){
							new ajax.xhr.Request("../../registor.php","email="+email+"&pass="+pass+"&name="+name+"&ename="+ename+"&birth="+birth+"&univ="+univ+"&gender="+gender,loginquery,'POST');						 
						}
						else{
							pic = $("#picture").attr("alt");						
							new ajax.xhr.Request("../../registor.php","email="+email+"&pass="+pass+"&name="+name+"&ename="+ename+"&birth="+birth+"&univ="+univ+"&gender="+gender+"&pic="+pic,loginquery,'POST');
						}
					 }
					else{
						 alert('email 형식이 올바르지 않습니다');
					 }
				}
			}
		}
	}//chrome
	else{	//************************************************************IE
		
		if(document.getElementById('woman').checked==true){
			gender = 2;
		}
		else{
			gender = 1;
		}
		ename = $('#ename1').val() + " " + $('#ename2').val();
		birth = $('#year').val() + "-" + $('#month').val() + "-" + $('#day').val();
		
		if($("#email").val()=="" || $("#email").val()=="이메일 주소" || $("#pass").val()=="" || $("#pass").val()=="●●●●" || $("#name").val()=="" || $("#name").val()=="ex) 홍길동" || $("#ename1").val()=="" || $("#ename1").val()=="ex) Gildong" || $("#ename2").val()=="" || $("#ename2").val()=="ex) Hong" || $("#year").val()=="" || $("#month").val()=="" || $("#day").val()=="" || $("#univ").val()=="" || $("#univ").val()=="학교..."){
			alert('모든 값을 입력해 주세요^^');
		}
		else{		
			if(document.getElementById('woman').checked == false && document.getElementById('man').checked == false){
				alert('성별을 선택해주세요');
			}
			else{
				
				if($("#pass").val().length < 4){
					alert('비밀번호는 4글자 이상으로 입력해주세요');
				}
				else{
					 format = /^((\w|[\-\.])+)@((\w|[\-\.])+)\.([A-Za-z]+)$/;
					 if($('#email').val().search(format) != -1){
						if($("#picture").attr("alt")==""){
							new ajax.xhr.Request("../../registor.php","email="+$("#email").val()+"&pass="+$("#pass").val()+"&name="+$("#name").val()+"&ename="+ename+"&birth="+birth+"&univ="+$("#univ").val()+"&gender="+gender,loginquery,'POST');						 
						}
						else{
							pic = $("#picture").attr("alt");						
							new ajax.xhr.Request("../../registor.php","email="+$("#email").val()+"&pass="+$("#pass").val()+"&name="+$("#name").val()+"&ename="+ename+"&birth="+birth+"&univ="+$("#univ").val()+"&gender="+gender+"&pic="+pic,loginquery,'POST');
						}
					 }
					else{
						 alert('email 형식이 올바르지 않습니다');
					 }
				}
			}
		}
		//alert($('#email').val() + " / " + $('#name').val() + " / " + $('#pass').val() + " / " + $('#ename1').val() + " / " + $('#ename2').val() + " / " + $('#year').val() + " / " + $('#month').val() + " / " + $('#day').val() + " / " + $('#univ').val() + " / ");
	}//IE
}

function loginquery(req){
	
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
				meid = data.ID;				
				evnum = data.evnum;
				if(result==1){
					alert('이미 존재하는 email입니다');
				}
				else{
					alert('Funsumer에 오신 것을 환영합니다!');			
					if($("#picture").attr("alt")==""){						
						new ajax.xhr.Request("../../reg_resize.php","opt=2&iid=1",locationmove,'POST');
					}
					else{
						new ajax.xhr.Request("../../reg_resize.php","opt=1&iid="+meid,locationmove,'POST');					
					}
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
function locationmove(req){	
	if(evnum==0){
		location.href = '../../party/';
	}
	else{
		post_to_url('../../event/',{'eventnumber':evnum});
	}
}

function uploadpic(){
	frm = document.getElementById('imgiframe');
	if(frm==null) return;
	
	fDoc = frm.contentWindow || frm.contentDocument;
	if(fDoc.document){
		fDoc = fDoc.document;
	}
	
	fDoc.WideUpload.opt.value = 1;
	fDoc.WideUpload.action = "tempimgupload.php";
	fDoc.WideUpload.imgupload.click();
}

function UploadSetting(){
	if(!/(\.gif|\.jpg|\.jpeg|\.png)$/i.test(fDoc.WideUpload.imgupload.value)){
		alert('지원하는 형식의 파일이 아닙니다');
	}
	else{
		fDoc.WideUpload.submit();
	}
}

function removepref(){
	if($('#picture').attr('alt')!=""){
		new ajax.xhr.Request("../../erase_upload_temp.php","er_file="+$('#picture').attr('alt'),nothingdo,'POST');
	}
}
