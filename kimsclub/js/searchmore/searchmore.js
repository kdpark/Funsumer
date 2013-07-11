function kimsclub_nondis() {
	$("#container > .headline > .pop").css("display","none")
}

$(document).ready(function() {

		// nav-menu EVENT.
		
		var SDDw = $(".SDD-wassup"), SDDn = $(".SDD-note"), SDDp = $(".SDD-party");
		var navw = $(".nav-wassup"), 	navn = $(".nav-note"), 	navp = $(".nav-party");
		
		navn.mouseenter(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")});
		navp.mouseenter(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_partyov.png)")});
		navw.mouseenter(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")});
		
		navn.mouseleave(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_note.png)")});
		navp.mouseleave(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_party.png)")});
		navw.mouseleave(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassup.png)")});
		
		navn.mousedown(function() { SDDn.css("background-image","url(../images/party/Header/header_menu_noteck.png)")});
		navp.mousedown(function() { SDDp.css("background-image","url(../images/party/Header/header_menu_partyck.png)")});
		navw.mousedown(function() { SDDw.css("background-image","url(../images/party/Header/header_menu_wassupck.png)")});
		
		navn.mouseup(function() { 	SDDn.css("background-image","url(../images/party/Header/header_menu_noteov.png)")
													location.href = '../../note' ;
												});
		navp.mouseup(function() { 	SDDp.css("background-image","url(../images/party/Header/header_menu_partyov.png)");
													location.href = '../../partyplay' ;
												});
		navw.mouseup(function() { 	SDDw.css("background-image","url(../images/party/Header/header_menu_wassupov.png)")
													location.href = '../../wassup' ;
												});
												
	// 친구요청버튼 EVENT
	
	$.each($("#container > .people > .contents > .cards > .button > .Button_gray"),function() {
		
		$(this).mouseleave(function() {
			$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
		});
		$(this).mousedown(function() {
			$(this).css("background-image","url(../images/party/Container/buttongraybgck.png)");
		});
		$(this).mouseup(function() {
			
			if(typeof pageYOffset != 'undefined'){
				$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
				$(this).html("요청 완료<div class=\"Button_gray_word\">요청 완료</div>");
				$(this).addClass("Button_gray_selected");
				$(this).children(".Button_gray_word").addClass("Button_gray_selected_word");
			}	else  {
				$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
				$(this).html("요청 완료<div class=\"Button_gray_word\">요청 완료</div>");
				$(this).addClass("Button_gray_selected_ie8");
				$(this).children(".Button_gray_word").addClass("Button_gray_selected_word_ie8");			
			} 			
		});
		
	});
    
	// 방문하기 버튼 EVENT
	
	$.each($("#container > .party > .contents > .cards > .button > .Button_gray"),function() {
		
		$(this).mouseleave(function() {
			$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");
		});
		$(this).mousedown(function() {
			$(this).css("background-image","url(../images/party/Container/buttongraybgck.png)");
		});
		$(this).mouseup(function() {
				$(this).css("background-image","url(../images/party/Container/buttongraybg.png)");	
		});
		
	});
	
});



















