$(document).ready(function() {

		// nav-menu EVENT.
		
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
			if(typeof pageYOffset != 'undefined'){
				$("#container > .account").css("display","none");
				$("#container > .chgpw").css("display","block").fadeTo(600,1)
			}	else {
				$("#container > .account").css("display","none");
				$("#container > .chgpw").css("display","block");
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
            $(this).css("background-image","url(../../images/party/Container/button2bgov.png)")
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



















