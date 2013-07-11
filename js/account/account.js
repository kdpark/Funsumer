$(document).ready(function() {

		// nav-menu EVENT.
		
		var SDDw = $(".SDD-wassup"), SDDn = $(".SDD-note"), SDDp = $(".SDD-party");
		var navw = $(".nav-wassup"), 	navn = $(".nav-note"), 	navp = $(".nav-party");
		
		navn.mouseenter(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")});
		navp.mouseenter(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")});
		navw.mouseenter(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_partyov.png)")});
		
		navn.mouseleave(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_note.png)")});
		navp.mouseleave(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_wassup.png)")});
		navw.mouseleave(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_party.png)")});
		
		navn.mousedown(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteck.png)")});
		navp.mousedown(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_wassupck.png)")});
		navw.mousedown(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_partyck.png)")});
		
		navn.mouseup(function() { 	SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")
													post_to_url('../../note/',{'mynoteid':me[4]});
												});
		navp.mouseup(function() { 	SDDp.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")
													post_to_url('../../wassup/',{});
												});
		navw.mouseup(function() { 	SDDw.css("background-image","url(../images/party/Header/header_menu_partyov.png)")
													post_to_url('../../party/',{'mynoteid':me[4]});
												});
												
		//	비밀번호 바꾸기 버튼 event
		
		$("#container > .account > .content > .list > .text > .changepw").mouseenter(function(e) {
			$(this).css("background-image","url(../../images/base/buttongray3bgov.png)");
		});
		$("#container > .account > .content > .list > .text > .changepw").mouseleave(function(e) {
			$(this).css("background-image","url(../../images/base/buttongray3bg.png)");
		});
		$("#container > .account > .content > .list > .text > .changepw").mousedown(function(e) {
			$(this).css("background-image","url(../../images/base/buttongray3bgck.png)");
		});
		$("#container > .account > .content > .list > .text > .changepw").mouseup(function(e) {
			$(this).css("background-image","url(../../images/base/buttongray3bgov.png)");
			if(document.getElementById('genderm').checked==true){
			gender=1;
			}
			else if(document.getElementById('genderw').checked==true){
				gender=2;
			}
			else{
				gender=0;
			}
			if($("#name").val()!=me[0] || ($("#elname").val()+" "+$("#efname").val())!=me[1] || ($("#birthy").val()+"-"+$("#birthm").val()+"-"+$("#birthd").val())!=me[6] || gender != me[10] || $("#univ").val()!= me[14]){
				if(confirm("변경사항을 저장하시겠습니까?")){
					xx(0);
					if(typeof pageYOffset != 'undefined'){
						$("#container > .account").css("display","none");
						$("#container > .chgpw").css("display","block").fadeTo(600,1)
					}	else {
						$("#container > .account").css("display","none");
						$("#container > .chgpw").css("display","block");
					}
				}
				else{
					
				}
			}
			else{
				if(typeof pageYOffset != 'undefined'){
					$("#container > .account").css("display","none");
					$("#container > .chgpw").css("display","block").fadeTo(600,1)
				}	else {
					$("#container > .account").css("display","none");
					$("#container > .chgpw").css("display","block");
				}
			}
			
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
            $(this).css("background-image","url(../../images/party/Container/button2bgov.png)");			
			if($("#container > .account").css("display")=="block"){
				xx(0);
			}
			else{
				xx(1);
			}
			
        });
		
		// 로그아웃 버튼
		
		$("#container > .account > .content > .list > .text > .logout").mouseenter(function(e) {
			$(this).css("background-image","url(../../images/base/buttongray3bgov.png)");
		});
		$("#container > .account > .content > .list > .text > .logout").mouseleave(function(e) {
			$(this).css("background-image","url(../../images/base/buttongray3bg.png)");
		});
		$("#container > .account > .content > .list > .text > .logout").mousedown(function(e) {
			$(this).css("background-image","url(../../images/base/buttongray3bgck.png)");
		});
		$("#container > .account > .content > .list > .text > .logout").mouseup(function(e) {
			$(this).css("background-image","url(../../images/base/buttongray3bgov.png)");
		});
			
});
function xx(ind){
	if(ind==0){	//계정
		if(document.getElementById('genderm').checked==true){
			gender=1;
		}
		else if(document.getElementById('genderw').checked==true){
			gender=2;
		}
		else{
			gender=0;
		}
		
		param = "opt=1&name="+$("#name").val()+"&ename="+$("#elname").val()+" "+$("#efname").val()+"&birth="+$("#birthy").val()+"-"+$("#birthm").val()+"-"+$("#birthd").val()+"&gender="+gender+"&univ="+$("#univ").val();			
		new ajax.xhr.Request("../../RequestAjax/writeadmin.php",param,nothingdo,'POST');
		alert('저장되었습니다');
	}
	else{	//비번
		if($("#p1").val()){
			if($("#p2").val() && $("#p2").val().length >= 4){
				if($("#p3").val() && $("#p3").val().length >= 4){
					if($("#p1").val()!=$("#p2").val()){
						if($("#p2").val()==$("#p3").val()){
							param = "opt=2&&p1="+$("#p1").val()+"&p2="+$("#p2").val();
							new ajax.xhr.Request("../../RequestAjax/writeadmin.php",param,somethingdo,'POST');
						}
						else{
							alert('변경될 비밀번호와 비밀번호 확인이 다릅니다. 다시 확인해주세요');
						}
					}
					else{
						alert('현재 비밀번호와 변경될 비밀번호가 같습니다');
					}
				}
				else{
					alert('변경될 비밀번호 확인을 입력하세요(4자 이상)');
				}
			}
			else{
				alert('변경될 비밀번호를 입력하세요(4자 이상)');
			}
		}
		else{
			alert('비밀번호를 입력하세요');
		}
	}
}
function nothingdo(){	
}
function somethingdo(req){
	if(req.readyState==4)
	{
		if(req.status == 200)
		{			
			var docXML = req.responseXML;
			var code = docXML.getElementsByTagName("code").item(0).firstChild.nodeValue;

			if(code =='success') {
				var dataJSON = docXML.getElementsByTagName("data").item(0).firstChild.nodeValue;
				data = eval("("+dataJSON+")");				
				
				if(data.ok==1){
					alert('변경되었습니다');
					location.href = '../../account';
				}
				else{
					alert('입력하신 현재 비밀번호가 일치하지 않습니다');
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



function facebook(){
	
	if(me[17]){
		alert('이미 인증되었습니다');
	}
	else{		
		window.open('../../facebookapi/?setting=1','','toolbar=no,menubar=no,location=no,height=1,width=1');
	}
	

}

