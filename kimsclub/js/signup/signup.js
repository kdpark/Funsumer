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
			
		// 대학교 검색
		
		$.each($(".search > ul"),function() {
			
			$(this).mouseenter(function() {	$(this).css("background-color","#f2f2f2").css("color","#777")	});
			$(this).mouseleave(function() {	$(this).css("background-color","#ffffff").css("color","#999") 	});
			$(this).mousedown(function() {	$(this).css("background-color","#dc5457").css("color","#ffffff") 	});
			$(this).mouseup(function() {		$(this).css("background-color","#f2f2f2").css("color","#777") 	});
			
		})
});



















